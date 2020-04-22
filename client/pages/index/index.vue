<template>
	<view class="container">
		<uni-navbar :title="title" background-color="#ff76a8" color="#fff" status-bar fixed></uni-navbar>
		<view class="content">
			<view 
				class="card"
				:style="{'margin-top': index > 1 ? '20upx' : '0'}"
				v-for="(item, index) in list"
				:key="index"
				@tap="handleClick(item)">
				<view class="pic">
					<image class="img" :src="getImageUrl(item.Imageurl)" mode="scaleToFill"></image>
				</view>
				<view class="nickName">
					<text class="name">{{item.name}}</text>
					<text class="des">{{item.age}}岁/{{item.height}}CM</text>
				</view>
			</view>
		</view>
		<cu-loading :show="loading"></cu-loading>
	</view>
</template>
<script>
import { api } from '@/config/common.js'
import { getPicList } from '@/api/common.js'
import { orderByObject, checkLogin } from '@/utils/tools.js'
export default {
	data() {
		return {
			title: '模特展示',
			list: [],
			openid: '',
			userinfo: '',
			token: '',
			loading: false
		}
	},
	onShow() {
		this.getData()
	},
	onLoad() {
		if (!checkLogin()) {
			uni.reLaunch({
				url: '/pages/my/login'
			})
		}
	},
	methods: {
		getData() {
			this.loading = true
			getPicList(api.pic).then(res => {
				this.loading = false
				if (res.status == 200) {
					this.list = res.data.data
					this.list = this.list.sort(orderByObject("order"))
				}
			}).catch(error => {
				this.loading = false
				uni.showToast({
					icon: 'none',
					title: error,
				})
			})
		},
		getImageUrl(url) {
			return api.baseUrl + url
		},
		handleClick(item) {
			uni.navigateTo({
				url: './detail?item=' + JSON.stringify(item)
			})
		}
	}
}
</script>

<style lang="scss" scoped>
	.container {
		.content {
			display: flex;
			flex-wrap: wrap;
			margin-top: 20upx;
			.card {
				display: flex;
				flex-direction: column;
				align-items: center;
				background-color: #ffffff;
				width: 335upx;
				margin: 0upx 20upx;
				border-radius: 20upx;
				box-shadow:2px 2px 5px #d7d8d8;
				.pic {
					height: 335upx;
					.img {
						border-radius: 20upx 20upx 0 0;
						width:335upx;
						height:335upx;
					}
				}
				.nickName {
					height:100%;
					width:100%;
					display: flex;
					justify-content: center;
					align-items: center;
					padding:20upx;
					.name {
						color: #ff76a8;
						font-weight: 600;
						margin-right: 20upx;
					}
					.des {
						color: #aaaaaa;
						font-size: $uni-font-size-sm;
					}
				}
			}
		}
	}
</style>
