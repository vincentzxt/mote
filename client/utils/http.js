import axios from '@/js-sdk/uni-axios'
import { api } from '@/config/common.js'
import {uniPopup} from '@/components/uni-popup/uni-popup.vue';

// 创建自定义接口服务实例
const http = axios.create({
    baseURL: api.baseUrl,
    timeout: 6000,
    // #ifdef H5
    withCredentials: true,
    // #endif
})

// 拦截器 在请求之前拦截
http.interceptors.request.use(config => {
	//config.headers.post.content-type = 'application/x-www-form-urlencoded'
	//let userInfo = uni.getStorageSync('userInfo')
	//if (userInfo.token) {
	//	config.headers.Authorization = 'Bearer ' + userInfo.token
//	}
    // code...
    // 获取本地存储的Cookie
    // const cookie = uni.getStorageSync('cookie')
    // 设置Cookie
    // config.headers.Cookie = cookie
    return config
})

// 拦截器 在请求之后拦截
http.interceptors.response.use(response => {
    // code...
    // 获取cookie
    // let headerStr = JSON.stringify(response.headers)
    // let cookie = (/(?:Set-Cookie).+;/.exec(headerStr)[0]).replace(/Set-Cookie|:|"/g, "")
    // if (cookie) {
        // uni.setStorage({
            // key: 'cookie',
            // data: cookie.split(';')[0]
        // })
    // }
	// 
	const url =response.config.url; 
	
	if(url.includes("GetUserInfo")== false && url.includes("RefreshToken")== false && url.includes("ContactUnit/Query")== false && url.includes("BseProduct/Query")== false  && url.includes("QueryProductCategory")== false){
		if (response.status == 200){
			if(response.data.returnCode == '401'){		
				uni.reLaunch({
					url: '/pages/my/login/login'
				});
			}
			if(response.data.returnCode == '402'){
				uni.reLaunch({
					url: '/pages/my/login/login'
				});
			}
			
			if(response.data.returnCode == '403'){
				// uni.reLaunch({
				// 	url: '/pages/my/recharge/recharge'
				// });
				// this.$refs.popup.open();
				uni.showModal({
					title: '续费提醒',
					content:'您的服务已到期，购买继续使用!',
					confirmText:'续费',
					showCancel:false,
					success: e => {
						if (e.confirm) {
							try {
								setTimeout(() => {
								uni.reLaunch({
									url: '/pages/my/recharge/recharge'
								});
								}, 300);
							} catch (e) {}
						}
					}
				});
			}
		}
	}
    return response;
}, error => {
    return Promise.reject(error.message)
})

export default http