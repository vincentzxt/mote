<template>
	<view class="container">
		<uni-navbar :title="title" background-color="#ff76a8" color="#fff" status-bar fixed></uni-navbar>
		<view class="content">
			<view class="banner">
				<view class="pic">
					<image class="img" src="/static/picture.png" mode="scaleToFill"></image>
				</view>
				<view class="name">
					<text>用户名：{{userName}}</text>
				</view>
			</view>
			<view class="chPass" @tap="handleEditPassword">
				<view class="icon">
					<image class="edit" src="/static/edit.png" mode="scaleToFill"></image>
				</view>
				<view class="action">
					<text>修改密码</text>
					<image class="right" src="/static/right.png" mode="scaleToFill"></image>
				</view>
			</view>
			<view class="logout">
				<button class="btn" type="primary" @click="handleLogout">退出登陆</button>
			</view>
		</view>
		<cu-loading :show="loading"></cu-loading>
	</view>
</template>
<script>
import { api } from '@/config/common.js';
export default {
	data() {
		return {
			title: '用户中心',
			loading: false,
			userName: ''
		}
	},
	onShow() {
		let userInfo = uni.getStorageSync('userInfo')
		this.userName = userInfo.username
	},
	methods: {
		handleEditPassword() {
			uni.navigateTo({
				url: "./edit"
			})
		},
		handleLogout() {
			uni.setStorageSync('userInfo', {})
			uni.reLaunch({
				url: './login'
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
			.banner {
				display: flex;
				align-items: center;
				background-color: #ff76a8;
				color: #ffffff;
				padding: 40upx;
				.pic {
					.img {
						height: 200upx;
						width: 200upx;
					}
				}
				.name {
					font-size: 15pt;
					margin-left: 50upx;
				}
			}
			.chPass {
				border-radius: 20upx;
				box-shadow:2px 2px 5px #d7d8d8;
				margin: 20upx;
				padding: 50upx 30upx;
				background-color: #ffffff;
				display: flex;
				align-items: center;
				.icon {
					height: 100%;
					width: 15%;
					display: flex;
					align-items: center;
					justify-content: center;
					.edit {
						width: 50upx;
						height: 50upx;
					}
				}
				.action {
					width: 85%;
					display: flex;
					justify-content: space-between;
					align-items: center;
				}
				.right {
					width: 50upx;
					height: 50upx;
				}
			}
			.logout {
				margin: 100upx 50upx 0 50upx;
				.btn {
					background-color: #ff76a8;
					color: #FFFFFF;
					border-radius: 500upx;
					padding: 15upx;
				}
			}
		}
	}
</style>
