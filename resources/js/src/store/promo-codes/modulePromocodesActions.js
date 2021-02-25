/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

import axios from "@/axios.js"

export default {
  addItem({ commit }, item) {
    return new Promise((resolve, reject) => {
      axios.post("/api/promocodes/create", item)
        .then((response) => {
          commit('ADD_ITEM', response.data.promocode)
          resolve(response)
        })
        .catch((error) => { reject(error.response) })
    })
  },
  fetchPromocodes({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get("/api/promocodes/list")
        .then((response) => {
          commit('SET_ITEMS', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchPromocode({  }, id) {
    return new Promise((resolve, reject) => {
      axios.get("/api/promocodes/" + id)
        .then((response) => {
          console.log(response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  updateItem({ commit }, item) {
    return new Promise((resolve, reject) => {
      axios.post(`/api/promocodes/update`, item)
        .then((response) => {
          commit('UPDATE_ITEM', response.data.promocode)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  removeItem({ commit }, itemId) {
    return new Promise((resolve, reject) => {
      axios.delete(`/api/promocodes/${itemId}`)
        .then((response) => {
          commit('REMOVE_ITEM', itemId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
}
