/*=========================================================================================
  File Name: moduleEcommerceState.js
  Description: Ecommerce Module State
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default {
    cartItems: (localStorage.getItem("cartItems")) ? JSON.parse(localStorage.getItem("cartItems") || "[]") : [],
    filtersList: (localStorage.getItem("filtersList")) ? JSON.parse(localStorage.getItem("filtersList") || "[]") : [],
    wishList: (localStorage.getItem("wishList")) ? JSON.parse(localStorage.getItem("wishList") || "[]") : [],
    orderDetails: (localStorage.getItem("orderDetails")) ? JSON.parse(localStorage.getItem("orderDetails") || "{}")
                    : {
                      discount: {code:'', amount: 0, errorMsg: '', type: 0},
                      promoCode: {code:'', amount: 0, errorMsg: '', type: 0},
                    },
    collections: (localStorage.getItem("collections")) ? JSON.parse(localStorage.getItem("collections") || "[]") : []

}
