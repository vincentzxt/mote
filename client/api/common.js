import http from '@/utils/http.js'

export const login = (url, data) => {
  return http.request({
    url: url + '/index',
		data: JSON.stringify(data),
		method: 'post'
  })
}

export const modifyPassword = (url, data) => {
  return http.request({
    url: url + '/modifyPassword',
		data: JSON.stringify(data),
		method: 'post'
  })
}

export const getPicList = (url) => {
  return http.request({
    url: url + '/index',
		method: 'get'
  })
}