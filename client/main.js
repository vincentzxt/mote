import Vue from 'vue'
import App from './App'
import uniNavBar from '@/components/uni-nav-bar/uni-nav-bar.vue'
import cuLoading from '@/components/custom/cu-loading.vue'

Vue.component('uni-navbar',uniNavBar)
Vue.component('cu-loading',cuLoading)

Vue.config.productionTip = false

App.mpType = 'app'
//统一提示方便全局修改

const login =function(){
	uni.reLaunch({
		url: '/pages/my/login/login'
	});
}
const msg = (title,  icon='none',duration=2000, mask=false)=>{
	if(Boolean(title) === false){
		return;
	}
	uni.showToast({
		title,
		duration,
		mask,
		icon
	});
} 
Vue.prototype.$api = {msg,login}; 

const app = new Vue({
    ...App
})
app.$mount()
