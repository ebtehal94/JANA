/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default {
  ADD_ITEM(state, category) {
    state.categories.unshift(category)
  },
  SET_ITEMS(state, data) {
    state.categories  = data
  },
  // SET_LABELS(state, labels) {
  //   state.eventLabels = labels
  // },
  UPDATE_ITEM(state, category) {
      const categoryIndex = state.categories.findIndex((p) => p.id == category.id)
      Object.assign(state.categories[categoryIndex], category)
  },
  REMOVE_ITEM(state, itemId) {
      const ItemIndex = state.categories.findIndex((p) => p.id == itemId)
      state.categories.splice(ItemIndex, 1)
  },
}
