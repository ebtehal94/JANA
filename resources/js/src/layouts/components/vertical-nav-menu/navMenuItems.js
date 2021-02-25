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
    url: '/all',
    name: 'Products',
    slug: 'products',
    icon: 'GridIcon',
    i18n:'AllProducts',
    rule: 'public',
    maxRule: 'captain',
  },
  {
    url: null,
    cat: 'TeaSets',
    name: 'TeaSets',
    // icon: 'coffe',
    i18n:'TeaSets',
    maxRule: 'captain',
    submenu: []
  },
  {
    cat: 'CoffeeSets',
    name: 'CoffeeSets',
    // icon: 'coffee',
    i18n:'CoffeeSets',
    maxRule: 'captain',
    submenu: []
  },
  {
    cat: 'ServingSets',
    name: 'ServingSets',
    // icon: 'nuts',
    i18n:'ServingSets',
    maxRule: 'captain',
    submenu: []
  },
  {
    cat: 'ServingTrays',
    name: 'ServingTrays',
    // icon: 'spices',
    i18n:'ServingTrays',
    maxRule: 'captain',
    submenu: []

  },
  {
    cat: 'Accessories',
    name: 'Accessories',
    // icon: 'sweets',
    i18n:'Accessories',
    maxRule: 'captain',
    submenu: []

  },
  {
    url: '/dashboard',
    name: 'Dashboard',
    slug: 'dashboard',
    icon: 'BarChart2Icon',
    i18n:'Reports',
    rule: 'operator',
  },
  {
    url: '/users',
    name: "Admins & Users",
    slug: "users-list",
    icon: "UserIcon",
    i18n: "AdminsAndUsers",
    rule: "admin",
  },
  {
    url: '/products/list',
    name: "Products",
    slug: "products-list",
    icon: "ShoppingCartIcon",
    i18n: "Products",
    rule: "admin"
  },
  {
    url: '/categories',
    name: "Categories",
    slug: "categories",
    icon: "GridIcon",
    i18n: "Categories",
    rule: "admin"
  },
  {
    url: '/collections',
    name: "Collections",
    slug: "collections",
    icon: "GridIcon",
    i18n: "Collections",
    rule: "admin"
  },
  {
    url: '/comingsoon2',
    name: "General Settings",
    slug: "settings",
    icon: "SettingsIcon",
    i18n: "GeneralSettings",
    rule: "admin"
  },
  {
    url: '/orders',
    name: "Orders",
    slug: "orders-list",
    icon: "PackageIcon",
    rule: 'operator',
    i18n: "Orders"
  },
  {
    url: '/questions',
    name: "Quots & Questions",
    slug: "questions",
    icon: "InboxIcon",
    rule: 'operator',
    i18n: "QuotsAndQuotations"
  },
  {
    url: '/promocodes',
    name: "Promotional Codes",
    slug: "promo-codes",
    icon: "TagIcon",
    rule: 'operator',
    i18n: "PromoCodes"
  }
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
