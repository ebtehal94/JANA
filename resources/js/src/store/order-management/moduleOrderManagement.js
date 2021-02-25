/*=========================================================================================
  File Name: moduleOrderManagement.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


import state from './moduleOrderManagementState.js'
import mutations from './moduleOrderManagementMutations.js'
import actions from './moduleOrderManagementActions.js'
import getters from './moduleOrderManagementGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state: state,
  mutations: mutations,
  actions: actions,
  getters: getters
}
