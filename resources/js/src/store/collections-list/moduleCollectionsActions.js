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
      axios.post("/api/collections/create", item)
        .then((response) => {
          commit('ADD_ITEM', Object.assign(item, {id: response.data.collection.id}))
          resolve(response)
        })
        .catch((error) => { reject(error.response) })
    })
  },
  fetchCollections({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get("/api/collections/list")
        .then((response) => {
          commit('SET_ITEMS', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  updateItem({ commit }, item) {
    return new Promise((resolve, reject) => {
      axios.post(`/api/collections/update`, item)
        .then((response) => {
          commit('UPDATE_ITEM', response.data.collection)
          resolve(response)
        })
        .catch((error) => { reject(error.response) })
    })
  },
  removeItem({ commit }, itemId) {
    return new Promise((resolve, reject) => {
      axios.delete(`/api/collections/delete/${itemId}`)
        .then((response) => {
          commit('REMOVE_ITEM', itemId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
}
