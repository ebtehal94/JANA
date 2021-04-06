/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/order/pixinvent
==========================================================================================*/


export default {
  ADD_STORE(state, store) {
    state.stores.unshift(store)
  },
  SET_STORES(state, stores) {
    state.stores = stores
  },
 // SET_USERS_ORDERS(state, payload) {
   // const userOrders = payload.orders.filter((order) => order.customer_id == payload.id)
   // state.orders = userOrders
 // },
  UPDATE_STORE(state, store){
    const storeIndex = state.stores.findIndex((p) => p.id == store.id)
    state.stores[storeIndex] = store
  },
  REMOVE_STORE(state, storeID) {
      const storeIndex = state.stores.findIndex((u) => u.id == storeID)
      state.stores.splice(storeIndex, 1)
  },
}
