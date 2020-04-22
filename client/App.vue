<script>
	import Vue from 'vue'
	export default {
		data() {
			return {
			}
		},
		onLaunch: function() {
			uni.getSystemInfo({
				success: (res) => {
					Vue.prototype.$headerHeight = res.statusBarHeight + 44
					Vue.prototype.$headerIsSearchHeight = res.statusBarHeight + 104
					Vue.prototype.$mainHeight = res.screenHeight - res.statusBarHeight - 97
					Vue.prototype.$mainIsSearchHeight = res.screenHeight - res.statusBarHeight - 157
				}
			})
			//uni.removeStorageSync('userInfo')
		},
		methods: {
		}
	}
</script>

<style lang="scss">
	page {
		font-size: $uni-font-size-base;
		color: $uni-text-color;
		background-color: $uni-bg-color;
	}
	/*每个页面公共css */
</style>
