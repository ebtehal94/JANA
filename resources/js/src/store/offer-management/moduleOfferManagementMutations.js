/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/order/pixinvent
==========================================================================================*/


export default {
  ADD_OFFER(state, offer) {
    state.offers.unshift(offer)
  },
  SET_OFFERS(state, offers) {
    state.offers = offers
  },
  SET_INFO(state, data) {
    state.categories = data.categories
    if (data.stores){
      state.stores = data.stores
    }
  },
 // SET_USERS_ORDERS(state, payload) {
   // const userOrders = payload.orders.filter((order) => order.customer_id == payload.id)
   // state.orders = userOrders
 // },
  UPDATE_OFFER(state, offer){
    const offerIndex = state.offers.findIndex((p) => p.id == offer.id)
    state.offers[offerIndex] = offer
  },
  REMOVE_OFFER(state, offerID) {
      const offerIndex = state.offers.findIndex((u) => u.id == offerID)
      state.offers.splice(offerIndex, 1)
  },
}
