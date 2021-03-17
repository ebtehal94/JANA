/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/order/pixinvent
==========================================================================================*/


export default {
  ADD_CUSTOMER(state, customer) {
    state.customers.unshift(customer)
  },
  SET_CUSTOMERS(state, customers) {
    state.customers = customers
  },
 // SET_USERS_ORDERS(state, payload) {
   // const userOrders = payload.orders.filter((order) => order.customer_id == payload.id)
   // state.orders = userOrders
 // },
  UPDATE_CUSTOMER(state, customer){
    const customerIndex = state.customers.findIndex((p) => p.id == customer.id)
    state.customers[customerIndex] = customer
  },
  REMOVE_CUSTOMER(state, customerID) {
      const customerIndex = state.customers.findIndex((u) => u.id == customerID)
      state.customers.splice(customerIndex, 1)
  },
}
