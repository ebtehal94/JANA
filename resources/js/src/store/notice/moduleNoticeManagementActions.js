/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/order/pixinvent
==========================================================================================*/

import axios from "@/axios.js"

export default {
  addNotice({ commit }, notice) {
    return new Promise((resolve, reject) => {
      axios.post("/api/notices/create", notice)
        .then((response) => {
          commit('ADD_NOTICE', Object.assign(notice, {id: response.data.notice.id}))
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchNotices({ commit }) {
    return new Promise((resolve, reject) => {
      axios.post("/api/notices/list")
        .then((response) => {
          commit('SET_NOTICES', response.data.notices)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchNotice({ commit }, noticeId) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/notices/edit/${noticeId}`)
        .then((response) => {
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  updateNotice({ commit }, notice) {
    return new Promise((resolve, reject) => {
      axios.post(`/api/notices/update`, notice)
        .then((response) => {
          commit('UPDATE_NOTICES', response.data.notice)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  removeNotice({ commit }, noticeId) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/notices/delete/${noticeId}`)
        .then((response) => {
          commit('REMOVE_NOTICE', noticeId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  }
}
