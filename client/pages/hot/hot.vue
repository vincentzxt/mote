<template>
	<view class="container">
		<uni-navbar :title="title" background-color="#ff76a8" color="#fff" status-bar fixed></uni-navbar>
		<view class="content">
			<view 
				class="card"
				v-for="(item, index) in list"
				:key="index"
				@tap="handleClick(item)">
				<view class="icon">
					<image class="huangguan" :src="getHuangGuanImageUrl(index)" mode="scaleToFill"></image>
				</view>
				<view class="pic">
					<image class="img" :src="getImageUrl(item.Imageurl)" mode="scaleToFill"></image>
				</view>
				<view class="info">
					<text class="name">{{item.name}}</text>
					<text class="des">{{item.age}}岁/{{item.height}}CM/{{item.address}}</text>
				</view>
			</view>
			
		</view>
		<cu-loading :show="loading"></cu-loading>
	</view>
</template>
<script>
import { api } from '@/config/common.js'
import { getPicList } from '@/api/common.js'
import { orderByObject } from '@/utils/tools.js'
export default {
	data() {
		return {
			title: '热度排名',
			list: [],
			openid: '',
			loading: false,
			jin: '/static/huangguan-jin.png',
			yin: '/static/huangguan-yin.png',
			tong: '/static/huangguan-tong.png'
		}
	},
	onShow() {
		this.getData()
	},
	methods: {
		getData() {
			this.loading = true
			getPicList(api.pic).then(res => {
				this.loading = false
				if (res.status == 200) {
					this.list = res.data.data
					this.list.sort(orderByObject("hot"))
				}
			}).catch(error => {
				this.loading = false
				uni.showToast({
					icon: 'none',
					title: error,
				})
			})
		},
		getHuangGuanImageUrl(id) {
			switch(id) {
				case 0:
					return this.jin
				case 1:
					return this.yin
				case 2:
					return this.tong
			}
		},
		getImageUrl(url) {
			return api.baseUrl + url
		},
		handleClick(item) {
			uni.navigateTo({
				url: '/pages/index/detail?item=' + JSON.stringify(item)
			})
		}
	}
}
</script>

<style lang="scss" scoped>
	.container {
		.content {
			display: flex;
			flex-direction: column;
			margin-top: 20upx;
			.card {
				display: flex;
				background-color: #ffffff;
				border-radius: 20upx;
				margin: 10upx;
				box-shadow:2px 2px 5px #d7d8d8;
				.icon {
					margin: 0 30upx;
					display: flex;
					justify-content: center;
					align-items: center;
					.huangguan {
						width:100upx;
						height:100upx;
					}
				}
				.pic {
					padding: 20upx;
					.img {
						border-radius: 500upx;
						width:150upx;
						height:150upx;
					}
				}
				.info {
					display: flex;
					flex-direction: column;
					justify-content: center;
					padding:20upx;
					.name {
						color: #ff76a8;
						font-weight: 600;
						margin-right: 20upx;
					}
					.des {
						margin-top: 20upx;
						color: #aaaaaa;
						font-size: $uni-font-size-sm;
					}
				}
			}
		}
	}
</style>
