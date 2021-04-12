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
  addAppinfo({ commit }, appinfo) {
    return new Promise((resolve, reject) => {
      axios.post("/api/appinfos/create", appinfo,
        {
          headers: {
            'Content-Type': 'multipart/form-data'
        }
        })
        .then((response) => {
          commit('ADD_APPINFO', Object.assign(appinfo, {id: response.data.appinfo.id}))
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchAppinfos({ commit }) {
    return new Promise((resolve, reject) => {
      axios.post("/api/appinfos/list")
        .then((response) => {
          commit('SET_APPINFOS', response.data.appinfos)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchAppinfo({ commit }, appinfoId) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/appinfos/edit/${appinfoId}`)
        .then((response) => {
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  updateAppinfo({ commit }, appinfo) {
    return new Promise((resolve, reject) => {
      axios.post(`/api/appinfos/update`, appinfo,
        {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        })
        .then((response) => {
          commit('UPDATE_APPINFOS', response.data.appinfo)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  removeOffer({ commit }, offerId) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/offers/delete/${offerId}`)
        .then((response) => {
          commit('REMOVE_OFFER', offerId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  }
}
