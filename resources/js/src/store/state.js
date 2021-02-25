/*=========================================================================================
  File Name: state.js
  Description: Vuex Store - state
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

import navbarSearchAndPinList from '@/layouts/components/navbar/navbarSearchAndPinList'
import themeConfig, { colors } from '@/../themeConfig.js'


// /////////////////////////////////////////////
// Variables
// /////////////////////////////////////////////

const userDefaults = {
  id         : 0,          // From Auth
  name : 'John Doe', // From Auth
  cc : '967', // From Auth
  mobile : '054*****', // From Auth
  email : 'demo@demo.demo', // From Auth
  about       : 'Dessert chocolate cake lemon drops jujubes. Biscuit cupcake ice cream bear claw brownie brownie marshmallow.',
  photoURL    : require('@assets/images/portrait/small/avatar-s-11.jpg'), // From Auth
  status      : 'online',
  rule    : 'visitor',
  rule_id    : 2,
  displayName:'sssss',
  userRole    : "admin"
}

let currency = 'QAR';

const CategoriesList = [
  {id: 1, name_ar: 'أطقم القهوة', name_en: 'Coffee Sets', cat: 'CoffeeSets', icon: 'Coffee',image: 'Coffee.jpg'},
  {id: 2, name_ar: 'أطقم الشاي', name_en: 'Tea Sets', cat: 'TeaSets', icon: 'Tea', image: 'Tea.jpg'},
  {id: 3, name_ar: 'أطقم التقديم', name_en: 'Serving Sets', cat: 'ServingSets', icon: 'Serving', image: 'Serving.jpg'},
  {id: 4, name_ar: 'أطقم الكاسات', name_en: 'Glass Cup Sets', cat: 'GlassCupSets', icon: 'Glass', image: 'Glass.jpg'},
  {id: 5, name_ar: 'صواني التقديم', name_en: 'Serving Trays Sets', cat: 'ServingTrays', icon: 'Serving', image: 'Serving.jpg'},
  {id: 6, name_ar: 'اكسسوارات المنزل', name_en: 'Home Accessories', cat: 'Accessories', icon: 'Home', image: 'Home.jpg'},
]


const CountriesList = [
  {id: 1, name_ar: 'قطر', name_en: 'Qatar', currency: 'QAR', delivery: '25.00', short_code: 'QTR', image_path: 'tea.jpg', contact: { address_ar: 'قطر', address_en: 'Qatar', phone: '+9741234567', email: 'qatar@otantik.com' }},
    {id: 2, name_ar: 'البحرين', name_en: 'Bahrain', currency: 'BHD', delivery: '1.50', short_code: 'BHN', image_path: 'tea.jpg', contact: { address_ar: 'البحرين', address_en: 'Bahrain', phone: '+9731234567', email: 'bahrain@otantik.com' }},
  {id: 3, name_ar: 'عمان', name_en: 'Oman', currency: 'OMR', delivery: '3.00', short_code: 'OMN', image_path: 'tea.jpg', contact: { address_ar: 'عمان', address_en: 'Oman', phone: '+96898636985', email: 'oman@otantik.com' }},
  {id: 4, name_ar: 'الكويت', name_en: 'Kuwait', currency: 'KWT', delivery:'5.00', short_code: 'KWT', image_path: 'tea.jpg', contact: { address_ar: 'الكويت', address_en: 'Kuwait', phone: '+9651234567', email: 'kuwait@otantik.com' }},
  {id: 5, name_ar: 'الأردن', name_en: 'Jordan', currency: 'JDN', delivery: '3.00', short_code: 'JDN', image_path: 'tea.jpg', contact: { address_ar: 'الأردن', address_en: 'Jordan', phone: '+9621234567', email: 'jordan@otantik.com' }},
  {id: 6, name_ar: 'السعودية', name_en: 'Saudi Arabia', currency: 'SAR', delivery: '0.00', short_code: 'KSA', image_path: 'tea.jpg', contact: { address_ar: 'السعودية', address_en: 'Saudi Arabia', phone: '+9661234567', email: 'ksa@otantik.com' }},
]

// Check if device is touch device
// This is used to remove perfect scrollbar from touch devices
// Using Dynamic components
const is_touch_device = () => {
  const prefixes = ' -webkit- -moz- -o- -ms- '.split(' ')
  const mq = function (query) {
    return window.matchMedia(query).matches
  }

  if (('ontouchstart' in window) || window.DocumentTouch) {
    return true
  }

  // include the 'heartz' as a way to have a non matching MQ to help terminate the join
  // https://git.io/vznFH
  const query = ['(', prefixes.join('touch-enabled),('), 'heartz', ')'].join('')
  return mq(query)
}


// /////////////////////////////////////////////
// State
// /////////////////////////////////////////////

const state = {
  AppActiveUser           : userDefaults,
  CategoriesList          : CategoriesList,
  CountriesList           : CountriesList,
  bodyOverlay             : false,
  isVerticalNavMenuActive : true,
  is_touch_device         : is_touch_device(),
  mainLayoutType          : themeConfig.mainLayoutType || 'vertical',
  navbarSearchAndPinList,
  reduceButton            : themeConfig.sidebarCollapsed,
  verticalNavMenuWidth    : 'default',
  verticalNavMenuItemsMin : false,
  scrollY                 : 0,
  starredPages            : navbarSearchAndPinList['pages'].data.filter((page) => page.is_bookmarked),
  theme                   : themeConfig.theme || 'light',
  themePrimaryColor       : colors.primary,
  windowWidth: null,
  filters: []
}

export default state
