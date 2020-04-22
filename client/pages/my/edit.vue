<template>
	<view class="container">
		<uni-navbar :title="title" :isBack="true" background-color="#ff76a8" color="#fff" status-bar fixed @clickLeft="handleNavbarClickLeft"></uni-navbar>
		<view class="content">
			<view class="new">
				<input class="text" type="text" password v-model="password" placeholder="请输入密码">
			</view>
			<view class="sure">
				<input class="text" type="text" password v-model="surePassword" placeholder="请再次输入密码">
			</view>
			<view class="submit">
				<button class="btn" type="primary" @click="handleModifyPassword">提交</button>
			</view>
		</view>
		<cu-loading :show="loading"></cu-loading>
	</view>
</template>
<script>
import { api } from '@/config/common.js';
import { modifyPassword } from '@/api/common.js';
export default {
	data() {
		return {
			title: '修改密码',
			username: '',
			password: '',
			surePassword: '',
			loading: false
		}
	},
	onLoad() {
		let userInfo = uni.getStorageSync('userInfo')
		this.username = userInfo.username
	},
	methods: {
		handleNavbarClickLeft() {
			uni.navigateBack({
				delta: 1
			})
		},
		handleModifyPassword() {
			if (!this.password) {
				uni.showToast({
					icon: 'none',
					title: '密码不能为空',
				})
				return
			}
			if (!this.surePassword) {
				uni.showToast({
					icon: 'none',
					title: '请确认修改的密码',
				})
				return
			}
			if (this.password !== this.surePassword) {
				uni.showToast({
					icon: 'none',
					title: '两次输入的密码不一致',
				})
				return
			}
			let reqData = {
				'username': this.username,
				'password': this.password
			}
			this.loading = true
			modifyPassword(api.login, reqData).then(res => {
				this.loading = false
				console.log(res.data)
				if (res.status == 200 && res.data == 0) {
					uni.showToast({
						icon: 'success',
						title: '密码修改成功'
					})
					setTimeout(()=>{
						uni.reLaunch({
							url: '/pages/my/login'
						})
					},500)
				} else {
					uni.showToast({
						icon: 'none',
						title: '密码修改失败',
					})
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
			.new {
				display: flex;
				border-radius: 20upx;
				box-shadow:2px 2px 5px #d7d8d8;
				margin: 20upx;
				padding: 50upx 30upx;
				background-color: #ffffff;
			}
			.sure {
				display: flex;
				border-radius: 20upx;
				box-shadow:2px 2px 5px #d7d8d8;
				margin: 20upx;
				padding: 50upx 30upx;
				background-color: #ffffff;
			}
			.submit {
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
