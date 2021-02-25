/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default {
  ADD_ITEM(state, promocode) {
    console.log(promocode)
    state.promocodes.unshift(promocode)
  },
  SET_ITEMS(state, data) {
    state.promocodes  = data
  },
  UPDATE_ITEM(state, promocode) {
    const promocodeIndex = state.promocodes.findIndex((p) => p.id == promocode.id)
    Object.assign(state.promocodes[promocodeIndex], promocode)
  },
  REMOVE_ITEM(state, itemId) {
      const ItemIndex = state.promocodes.findIndex((p) => p.id == itemId)
      state.promocodes.splice(ItemIndex, 1)
  },
}
