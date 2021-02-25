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
      axios.post("/api/categories/create", item)
        .then((response) => {
          commit('ADD_ITEM', Object.assign(item, {id: response.data.category.id}))
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  addFilter({}, item) {
    return new Promise((resolve, reject) => {
      axios.post("/api/categories/filter/create", item)
        .then((response) => {
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchDataListItems({ commit }) {
  return new Promise((resolve, reject) => {
    axios.get("/api/categories/list")
      .then((response) => {
        commit('SET_ITEMS', response.data)
        resolve(response)
      })
      .catch((error) => { reject(error) })
  })
  },
  updateItem({ commit }, item) {
    return new Promise((resolve, reject) => {
      axios.post(`/api/categories/update`, item)
        .then((response) => {
          commit('UPDATE_ITEM', response.data.category)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  updateFilter({}, item) {
    return new Promise((resolve, reject) => {
      axios.post(`/api/categories/filter/update`, item)
        .then((response) => {
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  removeItem({ commit }, itemId) {
    return new Promise((resolve, reject) => {
      axios.delete(`/api/categories/delete/${itemId}`)
        .then((response) => {
          commit('REMOVE_ITEM', itemId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  removeFilter({ }, data) {
    return new Promise((resolve, reject) => {
      axios.delete(`/api/categories/${data.category_id}/filter/delete/${data.filter_id}`)
        .then((response) => {
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
}
