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
  addOffer({ commit }, offer) {
    return new Promise((resolve, reject) => {
      axios.post("/api/offers/create", offer,
        {
          headers: {
            'Content-Type': 'multipart/form-data'
        }
        })
        .then((response) => {
          commit('ADD_OFFER', Object.assign(offer, {id: response.data.offer.id}))
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchInfo({ commit }) {
    return new Promise((resolve, reject) => {
      axios.post("/api/offers/getInfo")
        .then((response) => {
          commit('SET_INFO', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchOffers({ commit }, status) {
    return new Promise((resolve, reject) => {
      axios.post("/api/offers/list/", status)
        .then((response) => {
          commit('SET_OFFERS', response.data.offers)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchOffers({ commit }, filter) {
    return new Promise((resolve, reject) => {
      axios.post("/api/offers/list/", filter)
        .then((response) => {
          commit('SET_OFFERS', response.data.offers)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchOffer({ commit }, offerId) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/offers/edit/${offerId}`)
        .then((response) => {
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  updateOffer({ commit }, offer) {
    return new Promise((resolve, reject) => {
      axios.post(`/api/offers/update`, offer,
        {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        })
        .then((response) => {
          commit('UPDATE_OFFER', response.data.offer)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  removeOffer({ commit }, offerId) {
    return new Promise((resolve, reject) => {
      axios.delete(`/api/offers/delete/${offerId}`)
        .then((response) => {
          commit('REMOVE_OFFER', offerId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  }
}
