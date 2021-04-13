/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/order/pixinvent
==========================================================================================*/


export default {
  ADD_NOTICE(state, notice) {
    state.notices.unshift(notice)
  },
  SET_NOTICES(state, notices) {
    state.notices = notices
  },
 // SET_USERS_ORDERS(state, payload) {
   // const userOrders = payload.orders.filter((order) => order.customer_id == payload.id)
   // state.orders = userOrders
 // },
  UPDATE_NOTICE(state, notice){
    const noticeIndex = state.notices.findIndex((p) => p.id == notice.id)
    state.notices[noticeIndex] = notice
  },
  REMOVE_NOTICE(state, noticeID) {
      const noticeIndex = state.notices.findIndex((u) => u.id == noticeID)
      state.notices.splice(noticeIndex, 1)
  },
}
