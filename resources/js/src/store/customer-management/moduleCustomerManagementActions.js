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
  addCustomer({ commit }, customer) {
    return new Promise((resolve, reject) => {
      axios.post("/api/customers/create", customer)
        .then((response) => {
          commit('ADD_CUSTOMER', Object.assign(customer, {id: response.data.customer.id}))
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchCustomers({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get("/api/customers/list")
        .then((response) => {
          commit('SET_CUSTOMERS', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchCustomer({}, customerId) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/users/edit/${customerId}`)
        .then((response) => {
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  updateCustomer({ commit }, customer) {
    return new Promise((resolve, reject) => {
      axios.post(`/api/users/update`, customer)
        .then((response) => {
          commit('UPDATE_CUSTOMER', response.data.customer)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  removeCustomer({ commit }, customerId) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/users/delete/${customerId}`)
        .then((response) => {
          commit('REMOVE_CUSTOMER', customerId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  }
}
