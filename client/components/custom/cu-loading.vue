<template>
  <view class="mask" :class= "mask == 'true' || mask == true ? 'mask-show' : ''" @click="Mclose" v-if="show" @touchmove.stop.prevent="preventTouchMove">
    <view class="loader loading">
    </view>
		<view class="title">{{text}}</view>
  </view>
</template>

<script scoped="true">
export default {
  name: "cu-loading",
	props: {
		show: false
	},
  data() {
    return {
			text: '加载中...',
			mask: true,
			click: true
		};
  },
	methods:{
		preventTouchMove(){
			return;
		},
		Mclose(){
			if(this.click == 'false' || this.click == false){
				this.show = false
			}
		},
		open(){
			this.show = true
    },
    close(){
      this.show = false
    }
	}
};
</script>

<style lang="scss" scoped>
.mask {
  position: fixed;
  z-index: 99999;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  height: 100vh;
  width: 100vw;
  display: flex;
	flex-direction:column;
  justify-content: center;
  align-items: center;
	flex-wrap: wrap;
}
.mask.mask-show{
	background: rgba(178, 178, 178, 0.1);
}
.title{
	color: #ff76a8;
	font-size: 28upx;
}

.loader {
  position: relative;
  width: 60upx;
  height: 60upx;
  border-radius: 50%;
  margin: 30upx;
  display: inline-block;
  vertical-align: middle;
}
.loading {
  border: 8upx dotted rgba(233, 233, 233, 1);
  -webkit-transition: all 1s ease;
  transition: all 1s ease;
  -webkit-animation: dotted-spin 1s linear infinite;
  animation: dotted-spin 1s linear infinite;
  border-bottom-width: 1upx;
  border-bottom-color: rgba(233, 233, 233, 0.3);
  border-left-width: 2upx;
  border-left-color: rgba(233, 233, 233, 0.5);
  border-top-width: 3upx;
  border-right-width: 4upx;
  border-top-color: rgba(233, 233, 233, 0.7);
}

@-webkit-keyframes dotted-spin {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(-360deg);
    transform: rotate(-360deg);
  }
}
@keyframes dotted-spin {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(-360deg);
    transform: rotate(-360deg);
  }
}
</style>
