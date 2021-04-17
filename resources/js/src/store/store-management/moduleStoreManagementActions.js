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
  addStore({ commit }, store) {
    return new Promise((resolve, reject) => {
      axios.post("/api/store/create", store,
        {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        })
        .then((response) => {
          commit('ADD_STORE', Object.assign(store, {id: response.data.store.id}))
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchStores({ commit }) {
    return new Promise((resolve, reject) => {
      axios.post("/api/store/list")
        .then((response) => {
          commit('SET_STORES', response.data.stores)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchStore({ commit }, storeId) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/store/edit/${storeId}`)
        .then((response) => {
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  updateStore({ commit }, store) {
    return new Promise((resolve, reject) => {
      axios.post(`/api/store/update`, store,
        {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        })
        .then((response) => {
          commit('UPDATE_STORE', response.data.store)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  removeStore({ commit }, storeId) {
    return new Promise((resolve, reject) => {
      axios.delete(`/api/store/delete/${storeId}`)
        .then((response) => {
          commit('REMOVE_STORE', storeId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  }
}
