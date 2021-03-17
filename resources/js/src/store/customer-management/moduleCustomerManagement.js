/*=========================================================================================
  File Name: moduleOrderManagement.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


import state from './moduleCustomerManagementState.js'
import mutations from './moduleCustomerManagementMutations.js'
import actions from './moduleCustomerManagementActions.js'
import getters from './moduleCustomerManagementGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state: state,
  mutations: mutations,
  actions: actions,
  getters: getters
}
