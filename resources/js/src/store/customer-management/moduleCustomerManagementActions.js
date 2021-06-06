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
          if(response.data.statusCode == 200){
          commit('ADD_CUSTOMER', Object.assign(customer, {id: response.data.customer.id}))
        }
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },

  fetchCustomers({ commit },obj) {
    return new Promise((resolve, reject) => {
      axios.post("/api/customers/list" , obj )
        .then((response) => {
          commit('SET_CUSTOMERS', response.data.customers)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchCustomer({ commit }, customerId) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/customers/edit/${customerId}`)
        .then((response) => {
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  updateCustomer({ commit }, customer) {
    return new Promise((resolve, reject) => {
      axios.post(`/api/customers/update`, customer)
        .then((response) => {
          if(response.data.statusCode == 200){
          commit('UPDATE_CUSTOMER', response.data.customer)
          }
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  removeCustomer({ commit }, customerId) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/customers/delete/${customerId}`)
        .then((response) => {
          commit('REMOVE_CUSTOMER', customerId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  }
}
