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
  addOrder({ commit }, order) {
    return new Promise((resolve, reject) => {
      axios.post("/api/orders/create", order)
        .then((response) => {
          // commit('ADD_USER', Object.assign(order, {id: response.data.order.id}))
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchOrders({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get("/api/orders/list")
        .then((response) => {
          commit('SET_ORDERS', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchUserOrders({ commit }, userId) {
    return new Promise((resolve, reject) => {
      axios.get("/api/orders/list")
        .then((response) => {
          commit('SET_USERS_ORDERS', { orders: response.data, id: userId})
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchUserOrders({ commit }, userId) {
    return new Promise((resolve, reject) => {
      axios.get("/api/orders/list")
        .then((response) => {
          commit('SET_USERS_ORDERS', { orders: response.data, id: userId})
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchOrder({}, orderId) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/orders/edit/${orderId}`)
        .then((response) => {
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  updateOrder({ commit }, order) {
    return new Promise((resolve, reject) => {
      axios.post(`/api/orders/update`, order)
        .then((response) => {
          commit('UPDATE_ORDER', response.data.order)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  removeOrder({ commit }, orderId) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/orders/delete/${orderId}`)
        .then((response) => {
          commit('REMOVE_ORDER', orderId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  }
}
