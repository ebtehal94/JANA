/*=========================================================================================
  File Name: moduleEcommerceActions.js
  Description: Ecommerce Module Actions
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
import axios from "@/axios.js"

export default {
    toggleItemInWishList({ commit }, item) {
        commit('TOGGLE_ITEM_IN_WISH_LIST', item)
    },
    toggleItemInCart({ getters, commit, dispatch }, item) {
        getters.isInCart(item.objectID) ? commit('REMOVE_ITEM_FROM_CART', item) : dispatch("additemInCart", item)
    },
    additemInCart({ commit }, item) {

        // Below properties should be added as per requirement from back-end
        // This is added just for demo purpose
        // item["quantity"] = 1
        // item["discount_in_percentage"] = Math.floor(Math.random() * 20) + 4
        // item["offers_count"] = Math.floor(Math.random() * 4) + 1
        // item["delivery_date"] = new Date(new Date().getTime() + (Math.random()*10*24*60*60*1000)).toDateString().slice(0, -4)

        commit('ADD_ITEM_IN_CART', item)
    },
    updateItemQuantity({ commit }, payload){
      commit('UPDATE_ITEM_QUANTITY', payload)
    },
    updateOrderDetails({ commit }, order){
      commit('UPDATE_ORDER_DETAILS', order)
    },
    updateFiltersList({ commit }, filters){
      commit('UPDATE_FILTERS_LIST', filters)
    },
    updatePromoCode({ getters, commit, dispatch }, promoCode){
      commit('UPDATE_ORDER_PROMO_CODE', promoCode)
      getters.isPromoCodeValid(promoCode) ? commit('UPDATE_ORDER_DISCOUNT', promoCode) : commit('REMOVE_ORDER_DISCOUNT')
    },
    removePromoCode({ getters, commit, dispatch }){
      commit('REMOVE_ORDER_DISCOUNT')
      commit('UPDATE_ORDER_PROMO_CODE', {})
    },
    resetCartItems({ commit }) {
      commit('RESET_CART_ITEMS')
    },
    fetchProductInfo({}, productId) {
      return new Promise((resolve, reject) => {
        axios.get(`/api/products/edit/${productId}`)
          .then((response) => {
            resolve(response)
          })
          .catch((error) => { reject(error) })
      })
    },
    fetchCollections({commit}) {
      return new Promise((resolve, reject) => {
        axios.get(`/api/collections/list`)
          .then((response) => {
            commit('SET_COLLECTIONS', response.data)
            resolve(response)
          })
          .catch((error) => { reject(error) })
      })
    }
}
