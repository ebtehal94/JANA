/*=========================================================================================
  File Name: sidebarItems.js
  Description: Sidebar Items list. Add / Remove menu items from here.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default [
  {
    url: '/dashboard',
    name: 'Dashboard',
    slug: 'dashboard',
    icon: 'reportIcon',
    i18n:'Reports',
    rule: 'vendor',
  },
  {
    url: '/financialOperations',
    name: "financial-operations",
    slug: "operations",
    icon: "operationsIcon",
    i18n: "Operations",
    rule: "admin"
  },
  {
    url: '/Offers',
    name: 'Offres',
    slug: 'offers',
    icon: 'offersIcon',
    i18n:'Offers',
    rule: 'vendor',
  },
  // {
  //   url: '/stores/edit/activeUserInfo.id',
  //   name: "General Settings",
  //   slug: "settings",
  //   icon: "storeIcon",
  //   i18n: "GeneralSettings",
  //   rule: "vendor"
  // },
  {
    url: '/Customers',
    name: 'Customers',
    slug: 'Customers',
    icon: 'customerIcon',
    i18n:'Customers',
    rule: 'admin',
  },
  {
    url: '/Stores',
    name: 'Stores',
    slug: 'Stores',
    icon: 'storeIcon',
    i18n:'Stores',
    rule: 'admin',
  },
  {
    url: '/admins',
    name: 'admins',
    slug: 'Accounts',
    icon: 'adminsIcon',
    i18n:'Accounts',
    rule: 'admin',
  },
  {
    url: '/AppControl',
    name: 'AppControl',
    slug: 'AppControl',
    icon: 'appsIcon',
    i18n:'AppControl',
    rule: 'admin',
  },
  {
    url: '/Notification',
    name: 'Notification',
    slug: 'Notification',
    icon: 'noticeIcon',
    i18n:'Notification',
    rule: 'admin',
  },


//   {
//   header: "Shop",
//   icon: "ShoppingCartIcon",
//   i18n: "Shop",
//   items: [
//     {
//       url: '/eCommerce/shop',
//       name: "Shop",
//       slug: "ecommerce-shop",
//       i18n: "Shop",
//     },
//     {
//       url: '/eCommerce/item/',
//       name: "Item Details",
//       slug: "ecommerce-item-detail-view",
//       i18n: "ItemDetails",
//     },
//     {
//       url: '/eCommerce/wish-list',
//       name: "Wish List",
//       slug: "ecommerce-wish-list",
//       i18n: "WishList",
//     },
//     {
//       url: '/eCommerce/checkout',
//       name: "Checkout",
//       slug: "ecommerce-checkout",
//       i18n: "Checkout",
//     },
//   ]
// },

]
