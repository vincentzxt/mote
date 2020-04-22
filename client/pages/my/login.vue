<template>
	<view class="container">
		<uni-navbar :title="title" background-color="#ff76a8" color="#fff" status-bar fixed></uni-navbar>
		<view class="content">
			<view class="username">
				<text>帐号：</text>
				<input class="text" type="text" v-model="username" placeholder="请输入帐号">
			</view>
			<view class="password">
				<text>密码：</text>
				<input class="text" type="text" password v-model="password" placeholder="请输入密码">
			</view>
			<view class="login">
				<button class="btn" type="primary" @click="handleLogin">登陆</button>
			</view>
		</view>
		<cu-loading :show="loading"></cu-loading>
	</view>
</template>
<script>
import { api } from '@/config/common.js'
import { login } from '@/api/common.js'
export default {
	data() {
		return {
			title: '用户登陆',
			username: '',
			password: '',
			loading: false
		}
	},
	onLoad() {
	},
	methods: {
		handleLogin() {
			if (!this.username || !this.password) {
				uni.showToast({
					icon: 'none',
					title: '用户名或密码不能为空'
				})
				return
			}
			if (this.username.length > 20 || this.password.length > 20) {
				uni.showToast({
					icon: 'none',
					title: '用户名或密码长度不能超过20个字符'
				})
				return
			}
			let reqData = {
				'username': this.username,
				'password': this.password
			}
			this.loading = true
			login(api.login, reqData).then(res => {
				this.loading = false
				if (res.status == 200) {
					if (!res.data.data) {
						uni.showToast({
							icon: 'none',
							title: '用户名不存在或密码错误',
						})
					} else {
						let userInfo = {
							uid: res.data.data.id,
							username: res.data.data.username
						}
						uni.setStorageSync('userInfo', userInfo)
						uni.reLaunch({
							url: '/pages/index/index'
						})
					}
				}
			}).catch(error => {
				this.loading = false
				uni.showToast({
					icon: 'none',
					title: error,
				})
			})
		}
	}
}
</script>

<style lang="scss" scoped>
	.container {
		.text {
			color: $uni-border-color;
		}
		.content {
			display: flex;
			flex-direction: column;
			.username {
				display: flex;
				border-radius: 20upx;
				box-shadow:2px 2px 5px #d7d8d8;
				margin: 20upx;
				padding: 50upx 30upx;
				background-color: #ffffff;
			}
			.password {
				display: flex;
				border-radius: 20upx;
				box-shadow:2px 2px 5px #d7d8d8;
				margin: 20upx;
				padding: 50upx 30upx;
				background-color: #ffffff;
			}
			.login {
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
