/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default {
  ADD_ITEM(state, collection) {
    state.collections.unshift(collection)
  },
  SET_ITEMS(state, data) {
    state.collections  = data
  },
  UPDATE_ITEM(state, collection) {
      const collectionIndex = state.collections.findIndex((p) => p.id == collection.id)
      Object.assign(state.collections[collectionIndex], collection)
  },
  REMOVE_ITEM(state, itemId) {
      const ItemIndex = state.collections.findIndex((p) => p.id == itemId)
      state.collections.splice(ItemIndex, 1)
  },
}
