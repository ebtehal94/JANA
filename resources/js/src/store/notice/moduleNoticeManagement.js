/*=========================================================================================
  File Name: moduleOrderManagement.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


import state from './moduleNoticeManagementState.js'
import mutations from './moduleNoticeManagementMutations.js'
import actions from './moduleNoticeManagementActions.js'
import getters from './moduleNoticeManagementGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state: state,
  mutations: mutations,
  actions: actions,
  getters: getters
}
