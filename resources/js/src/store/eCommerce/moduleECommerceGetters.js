/*=========================================================================================
  File Name: moduleEcommerceGetters.js
  Description: Ecommerce Module Getters
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default {
    isInCart: state => itemId => {
        return state.cartItems.some((item) => item.objectID == itemId )
    },
    isInWishList: state => itemId => {
        return state.wishList.some((item) => item.objectID == itemId )
    },
    getCartItem: state => itemId => {
      const result = state.cartItems.filter((item) => item.objectID == itemId)
      return result.length ? result.pop() : []
    },
    getItemIndex: state => itemId => {
      const result = state.cartItems.findIndex((item) => item.objectID == itemId)
      return result
    },
    getDiscountAmount: state => itemId => {
      // const result = state.cartItems.filter((item) => item.objectID == itemId)
      return result.length ? result.pop() : []
    },
    isPromoCodeValid: state => promoCode => {
      if (!promoCode.amount){
        state.orderDetails.discount.errorMsg  = promoCode.errorMsg
        return false
      }

      let subTotal = 0

      if ( state.cartItems && state.cartItems.length > 0) {
        state.cartItems.forEach((item, i) => {
          subTotal += item.quantity * item.price
        });
      }

      if (promoCode.min_price > subTotal ){
        state.orderDetails.discount.errorMsg = 'يجب ان لا يقل اجمالي المبلغ عن ' + promoCode.min_price + ' ر.س'
        return false
      }

      return true
    }

}
