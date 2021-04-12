/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/order/pixinvent
==========================================================================================*/


export default {
  ADD_APPINFO(state, info) {
    state.appInfos.unshift(info)
  },
  SET_APPINFOS(state, appInfos) {
    state.appInfos = appInfos
  },
 // SET_USERS_ORDERS(state, payload) {
   // const userOrders = payload.orders.filter((order) => order.customer_id == payload.id)
   // state.orders = userOrders
 // },
  UPDATE_APPINFO(state, appInfo){
    const appInfoIndex = state.appInfos.findIndex((p) => p.id == appInfo.id)
    state.appInfos[appInfoIndex] = appInfo
  },
  REMOVE_APPINFO(state, appInfoID) {
      const appInfoIndex = state.appInfos.findIndex((u) => u.id == appInfoID)
      state.appInfos.splice(appInfoIndex, 1)
  },
}
