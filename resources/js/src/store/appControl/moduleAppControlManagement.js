/*=========================================================================================
  File Name: moduleOrderManagement.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


import state from './moduleAppControlManagementState.js'
import mutations from './moduleAppControlManagementMutations.js'
import actions from './moduleAppControlManagementActions.js'
import getters from './moduleAppControlManagementGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state: state,
  mutations: mutations,
  actions: actions,
  getters: getters
}
