/*=========================================================================================
  File Name: moduleOrderManagement.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


import state from './moduleOfferManagementState.js'
import mutations from './moduleOfferManagementMutations.js'
import actions from './moduleOfferManagementActions.js'
import getters from './moduleOfferManagementGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state: state,
  mutations: mutations,
  actions: actions,
  getters: getters
}
