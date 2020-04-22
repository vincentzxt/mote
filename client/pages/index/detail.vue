<template>
	<view class="container">
		<uni-navbar :title="title" :isBack="true" background-color="#ff76a8" color="#fff" status-bar fixed @clickLeft="handleNavbarClickLeft">
		</uni-navbar>
		<view class="content">
			<view class="card">
				<view class="pic">
					<image class="img" :src="getImageUrl(item.Imageurl)" mode="scaleToFill"></image>
				</view>
				<view class="describe">
					<view>
						<text class="title">昵称：</text>
						<text class="text">{{item.name}}</text>
					</view>
					<view class="mt10">
						<text class="title">年龄：</text>
						<text class="text">{{item.age}}</text>
					</view>
					<view class="mt10">
						<text class="title">身高：</text>
						<text class="text">{{item.height}}</text>
					</view>
					<view class="mt10">
						<text class="title">体重：</text>
						<text class="text">{{item.weight}}</text>
					</view>
					<view class="mt10">
						<text class="title">籍贯：</text>
						<text class="text">{{item.address}}</text>
					</view>
				</view>
			</view>
			<view class="picList">
				<view class="title">个人风采</view>
				<swiper class="list" :indicator-dots="true" :autoplay="true">
					<swiper-item v-for="(pic, index) in item.Imagearr" :key="index">
						<image class="img" :src="getImageUrl(pic)" mode="scaleToFill"></image>
					</swiper-item>
				</swiper>
			</view>
		</view>
	</view>
</template>
<script>
import { api } from '@/config/common.js';
export default {
	data() {
		return {
			title: '模特简介',
			item: []
		}
	},
	onLoad(options) {
		if (options) {
			this.item = JSON.parse(options.item)
			this.item.Imagearr.shift()
		}
	},
	methods: {
		handleNavbarClickLeft() {
			uni.navigateBack({
				delta: 1
			})
		},
		getImageUrl(url) {
			return api.baseUrl + url
		}
	}
}
</script>

<style lang="scss" scoped>
	.mt10 {
		margin-top: 10upx;
	}
	.container {
		.content {
			display: flex;
			flex-direction: column;
			.card {
				display: flex;
				background-color: #ffffff;
				margin: 0upx 10upx;
				box-shadow:2px 2px 5px #d7d8d8;
				.pic {
					padding: 30upx;
					border-radius: 500upx;
					.img {
						border-radius: 500upx;
						width:350upx;
						height:350upx;
					}
				}
				.describe {
					margin-left: 40upx;
					display: flex;
					flex-direction: column;
					justify-content: center;
					.title {
						color: #bbbbbb;
					}
					.text {
						color: #ff76a8;
					}
				}
			}
			.picList {
				background-color: #ff76a8;
				color: #ffffff;
				margin-top: 50upx;
				.title {
					padding: 20upx;
				}
				.list {
					height: 500upx;
				}
				.img {
					width: 100%;
				}
			}
		}
	}       
</style>
