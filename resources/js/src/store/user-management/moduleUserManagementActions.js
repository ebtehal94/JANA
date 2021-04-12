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
  addUser({ commit }, user) {
    return new Promise((resolve, reject) => {
      axios.post("/api/users/create", user,
      {
        headers: {
          'Content-Type': 'multipart/form-data'
      }
      })
        .then((response) => {
          commit('ADD_USER', Object.assign(user, {id: response.data.user.id}))
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchUsers({ commit }) {
    return new Promise((resolve, reject) => {
      axios.post("/api/users/list")
        .then((response) => {
          commit('SET_USERS', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchUser({}, userId) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/users/edit/${userId}`)
        .then((response) => {
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  updateUser({ commit }, user) {
    return new Promise((resolve, reject) => {
      axios.post(`/api/users/update`, user,
      {
        headers: {
          'Content-Type': 'multipart/form-data'
      }
      })
        .then((response) => {
          commit('UPDATE_USER', response.data.user)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  removeUser({ commit }, userId) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/users/delete/${userId}`)
        .then((response) => {
          commit('REMOVE_USER', userId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  }
}
