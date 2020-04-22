export const orderByObject = (prop) => {
	return (obj1, obj2) => {
		var val1 = obj1[prop]
		var val2 = obj2[prop]
		if (val1 > val2) {
			return -1
		} else if (val1 < val2) {
			return 1
		} else {
			return 0
		}
	}
}

export const checkLogin = () => {
	let userInfo = uni.getStorageSync('userInfo')
	if (userInfo) {
		return 1
	} else {
		return 0
	}
}