/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default {
  ADD_USER(state, user) {
    state.users.unshift(user)
  },
  SET_USERS(state, users) {
    state.users = users
  },
  UPDATE_USER(state, user) {
      const userIndex = state.users.findIndex((p) => p.id == user.id)
      //  Object.assign(state.users[userIndex], user)
       state.users[userIndex] = user
  },
  REMOVE_USER(state, userID) {
      const userIndex = state.users.findIndex((u) => u.id == userID)
      state.users.splice(userIndex, 1)
  },
}
