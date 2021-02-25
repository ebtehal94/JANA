/*=========================================================================================
  File Name: moduleEcommerceMutations.js
  Description: Ecommerce Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

export default {
  TOGGLE_ITEM_IN_WISH_LIST(state, item) {
    const index = state.wishList.findIndex(i => i.objectID == item.objectID)
    if (index < 0) {
      state.wishList.push(item)
    } else {
      state.wishList.splice(index, 1)
    }
    localStorage.setItem("wishList", JSON.stringify(state.wishList));
  },
  REMOVE_ITEM_FROM_CART(state, item) {
    const index = state.cartItems.findIndex(i => i.objectID == item.objectID)
    if (index > -1) { state.cartItems.splice(index, 1) }
    localStorage.setItem("cartItems", JSON.stringify(state.cartItems));
  },
  ADD_ITEM_IN_CART(state, item) {
    state.cartItems.push(Object.assign({}, item))
    localStorage.setItem("cartItems", JSON.stringify(state.cartItems));
  },
  UPDATE_ITEM_QUANTITY(state, payload) {
    state.cartItems[payload.index].quantity = payload.quantity
    localStorage.setItem("cartItems", JSON.stringify(state.cartItems));
  },
  UPDATE_FILTERS_LIST(state, filters) {
    state.filtersList = filters
    localStorage.setItem("filtersList", JSON.stringify(state.filtersList));
  },

  UPDATE_ORDER_DETAILS(state, orderDetails) {
    state.orderDetails = orderDetails
    localStorage.setItem("orderDetails", JSON.stringify(state.orderDetails));
  },
  UPDATE_ORDER_DISCOUNT(state, discount) {
    state.orderDetails.discount = discount
    localStorage.setItem("orderDetails", JSON.stringify(state.orderDetails));
  },
  REMOVE_ORDER_DISCOUNT(state) {
    state.orderDetails.discount.amount = 0
    state.orderDetails.discount.code = ''
    localStorage.setItem("orderDetails", JSON.stringify(state.orderDetails));
  },
  UPDATE_ORDER_PROMO_CODE(state, promoCode) {
    state.orderDetails.promoCode = promoCode
    localStorage.setItem("orderDetails", JSON.stringify(state.orderDetails));
  },
  RESET_CART_ITEMS(state) {
    state.cartItems = []
    localStorage.setItem("cartItems", JSON.stringify(state.cartItems));
  },
  SET_COLLECTIONS(state, collections) {
    state.collections = collections
    localStorage.setItem("collections", JSON.stringify(state.collections));
  }
}
