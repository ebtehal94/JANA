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
      axios.post("/api/products/create", item,
        {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        })
        .then((response) => {
          if (response.data.product){
            commit('ADD_ITEM', Object.assign(item, {id: response.data.product.id}))
          }
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  // fetchDataListItems({ commit }) {
  //   let country = (localStorage.getItem("country")) ? localStorage.getItem("country") : 1
  //   return new Promise((resolve, reject) => {
  //     axios.get("/api/products/list/" + country)
  //       .then((response) => {
  //         commit('SET_PRODUCTS', response.data.products)
  //         resolve(response)
  //       })
  //       .catch((error) => { reject(error) })
  //   })
  // },
  fetchDataListItems({ commit }) {
    // let country = (localStorage.getItem("country")) ? localStorage.getItem("country") : 1
    return new Promise((resolve, reject) => {
      axios.get("/api/products/list")
        .then((response) => {
          commit('SET_PRODUCTS', response.data.products)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  // fetchEventLabels({ commit }) {
  //   return new Promise((resolve, reject) => {
  //     axios.get("/api/apps/calendar/labels")
  //       .then((response) => {
  //         commit('SET_LABELS', response.data)
  //         resolve(response)
  //       })
  //       .catch((error) => { reject(error) })
  //   })
  // },
  updateItem({ commit }, item) {
    return new Promise((resolve, reject) => {
      axios.post(`/api/products/update`, item,
        {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        })
        .then((response) => {
          if (response.data.product){
            commit('UPDATE_PRODUCT', response.data.product)
          }
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  removeItem({ commit }, itemId) {
    return new Promise((resolve, reject) => {
      axios.delete(`/api/products/delete/${itemId}`)
        .then((response) => {
          commit('REMOVE_ITEM', itemId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  // eventDragged({ commit }, payload) {
  //   return new Promise((resolve, reject) => {
  //     axios.post(`/api/apps/calendar/event/dragged/${payload.event.id}`, {payload: payload})
  //       .then((response) => {

  //         // Convert Date String to Date Object
  //         let event = response.data
  //         event.startDate = new Date(event.startDate)
  //         event.endDate = new Date(event.endDate)

  //         commit('UPDATE_EVENT', event)
  //         resolve(response)
  //       })
  //       .catch((error) => { reject(error) })
  //   })
  // },
}
