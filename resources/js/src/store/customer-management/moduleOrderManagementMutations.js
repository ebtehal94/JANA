/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/order/pixinvent
==========================================================================================*/


export default {
  ADD_USER(state, order) {
    state.orders.unshift(order)
  },
  SET_ORDERS(state, orders) {
    state.orders = orders
  },
  SET_USERS_ORDERS(state, payload) {
    const userOrders = payload.orders.filter((order) => order.customer_id == payload.id)
    state.orders = userOrders
  },
  UPDATE_ORDER(state, order){
    const orderIndex = state.orders.findIndex((p) => p.id == order.id)
    state.orders[orderIndex] = order
  },
  REMOVE_ORDER(state, orderID) {
      const orderIndex = state.orders.findIndex((u) => u.id == orderID)
      state.orders.splice(orderIndex, 1)
  },
}
