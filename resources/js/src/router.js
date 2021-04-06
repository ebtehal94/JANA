/*=========================================================================================
  File Name: router.js
  Description: Routes for vue-router. Lazy loading is enabled.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

import Vue from 'vue'
import Router from 'vue-router'
// import auth from "@/auth/authService";
// import acl from './acl/acl'


Vue.use(Router)

const router = new Router({
  mode: 'history',
  base: '/',
  scrollBehavior () {
    return { x: 0, y: 0 }
  },
  routes: [
    // {
    // // =============================================================================
    // // MAIN LAYOUT ROUTES
    // // =============================================================================
    //   path: '',
    // //   component: () => import('@/views/pages/ComingSoon.vue'),
    //
    //   component: () => import('./layouts/main/Main.vue'),
    //   children: [
    //     // =============================================================================
    //     // Theme Routes
    //     // =============================================================================
    //     {
    //         path: '/',
    //         name: 'dashboard',
    //       //   component: () => import('@/views/pages/ComingSoon.vue'),
    //         // component: () => import('./views/Dashboard.vue'),
    //         component: () => import('@/views/pages/Register.vue'),
    //         meta: {
    //           // breadcrumb: [
    //           //     { title: 'Home', url: '/' },
    //           //     { title: 'Register', active: true },
    //           // ],
    //           rule: 'public',
    //         }
    //       },
    //     //{
    //      // path: '/',
    //       //name: 'soon',
    //       //component: () => import('./views/home/Home.vue'),
    //     //   component: () => import('@/views/pages/ComingSoon.vue'),
    //       //meta: {
    //           //rule: 'public',
    //       //}
    //     //},
    //   ]
    // },
    {
      path: '',
      component: () => import('@/layouts/full-page/FullPage.vue'),
      children: [
        // =============================================================================
        // PAGES
        // =============================================================================
        {
          path: '/',
          name: 'page-register',
          component: () => import('@/views/pages/Register.vue'),
          meta: {
            rule: 'public',
          }
        },
        {
          path: '/login',
          name: 'page-login',
          component: () => import('@/views/pages/Login.vue'),
          meta: {
              rule: 'public',
          }
        },
        {
            path: '/pages/comingsoon',
            name: 'page-coming-soon',
            component: () => import('@/views/pages/ComingSoon.vue'),
            meta: {
                rule: 'public'
            }
        },
        {
            path: '/pages/error-404',
            name: 'page-error-404',
            component: () => import('@/views/pages/Error404.vue'),
            meta: {
                rule: 'public'
            }
        },
        {
            path: '/pages/error-500',
            name: 'page-error-500',
            component: () => import('@/views/pages/Error500.vue'),
            meta: {
                rule: 'public'
            }
        },
        {
            path: '/pages/not-authorized',
            name: 'page-not-authorized',
            component: () => import('@/views/pages/NotAuthorized.vue'),
            meta: {
                rule: 'public'
            }
        }
      ]
    },
    {
    // =============================================================================
    // MAIN LAYOUT ROUTES
    // =============================================================================
      path: '',
      // component: () => import('@/views/pages/ComingSoon.vue'),

      component: () => import('./layouts/main/Main.vue'),
      children: [
        // {
        //   path: '/test',
        //   name: 'test',
        //   component: () => import('./views/Test.vue'),
        //   meta: {
        //       rule: 'public',
        //   }
        // },
        {
          path: '/contact-us',
          name: 'contact',
          component: () => import('./views/home/Questions.vue'),
          meta: {
              rule: 'public',
          }
       },
        {
          path: '/about-us',
          name: 'about-us',
          component: () => import('./views/pages/About.vue'),
          meta: {
              rule: 'public',
          }
        },
        {
          path: '/privacy-policy',
          name: 'privacy-policy',
          component: () => import('./views/pages/PrivacyPolicy.vue'),
          meta: {
              rule: 'public',
          }
        },
        {
          path: '/terms-and-cond',
          name: 'terms-and-cond',
          component: () => import('./views/pages/Terms.vue'),
          meta: {
              rule: 'public',
          }
        },
        {
          path: '/dashboard',
          name: 'dashboard',
        //   component: () => import('@/views/pages/ComingSoon.vue'),
          component: () => import('./views/Dashboard.vue'),
          meta: {
            breadcrumb: [
                { title: 'Home', url: '/' },
                { title: 'Reports', active: true },
            ],
              rule: 'vendor',
          }
        },
        {
            path: '/financialOperations',
            name: 'financial-operations',
          //   component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('./views/FinancialOperations.vue'),
            meta: {
              breadcrumb: [
                  { title: 'Home', url: '/' },
                  { title: 'Operations', active: true },
              ],
                rule: 'admin',
            }
          },
          {
            path: '/offers',
            name: 'Offers',
          //   component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('./views/offers/Offers.vue'),
            meta: {
              breadcrumb: [
                  { title: 'Home', url: '/' },
                  { title: 'Offers', active: true },
              ],
                rule: 'vendor',
            }
          },
          {
            path: '/offers/create',
            name: 'create-offer',
          //   component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('./views/offers/CreateOffer.vue'),
            meta: {
              breadcrumb: [
                  { title: 'Home', url: '/' },
                  { title: 'Offers'},
                  { title: 'CreateOffer', active: true },
              ],
                rule: 'vendor',
            }
          },
          {
            path: '/offers/edit/:offersID',
            name: 'edit-offer',
            //   component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('./views/offers/CreateOffer.vue'),
            meta: {
              breadcrumb: [
                { title: 'Home', url: '/' },
                { title: 'Offers'},
                { title: 'Edit', active: true },
              ],
              rule: 'vendor',
            }
          },
          {
            path: '/customers',
            name: 'Customers',
          //   component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('./views/customers/Customers.vue'),
            meta: {
              breadcrumb: [
                  { title: 'Home', url: '/' },
                  { title: 'Customers', active: true },
              ],
                rule: 'admin',
            }
          },
          {
            path: '/customers/edit/:customerID',
            name: 'edit-customer',
            //   component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('./views/customers/CreateCustomer.vue'),
            meta: {
              breadcrumb: [
                { title: 'Home', url: '/' },
                { title: 'Customers'},
                { title: 'Edit', active: true },
              ],
              rule: 'admin',
            }
          },
          {
            path: '/customers/create',
            name: 'create-customer',
          //   component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('./views/customers/CreateCustomer.vue'),
            meta: {
              breadcrumb: [
                  { title: 'Home', url: '/' },
                  { title: 'Customers'},
                  { title: 'CreateCustomer', active: true },
              ],
                rule: 'admin',
            }
          },
          {
            path: '/stores',
            name: 'Stores',
          //   component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('./views/stores/Stores.vue'),
            meta: {
              breadcrumb: [
                  { title: 'Home', url: '/' },
                  { title: 'Stores', active: true },
              ],
                rule: 'vendor',
            }
          },
          {
            path: '/stores/create',
            name: 'create-Store',
          //   component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('./views/stores/CreateStore.vue'),
            meta: {
              breadcrumb: [
                  { title: 'Home', url: '/' },
                  { title: 'Stores'},
                  { title: 'CreateStore', active: true },
              ],
                rule: 'vendor',
            }
          },
          {
            path: '/stores/edit/:storeID',
            name: 'edit-customer',
            //   component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('./views/stores/CreateStore.vue'),
            meta: {
              breadcrumb: [
                { title: 'Home', url: '/' },
                { title: 'Stores'},
                { title: 'Edit', active: true },
              ],
              rule: 'admin',
            }
          },
        {
            path: '/Accounts',
            name: 'Accounts',
            // component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('@/views/Accounts.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Accounts', active: true },
                ],
                rule: 'admin'
            },
        },
        {
            path: '/CreateAdmin',
            name: 'create-Admin',
          //   component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('./views/CreateAdmin.vue'),
            meta: {
              breadcrumb: [
                  { title: 'Home', url: '/' },
                  { title: 'Accounts'},
                  { title: 'CreateAdmin', active: true },
              ],
                rule: 'admin',
            }
          },
          {
            path: '/AdminEdit',
            name: 'Edit-Admin',
          //   component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('./views/AdminEdit.vue'),
            meta: {
              breadcrumb: [
                  { title: 'Home', url: '/' },
                  { title: 'Accounts'},
                  { title: 'AdminEdit', active: true },
              ],
                rule: 'admin',
            }
          },
        {
            path: '/AppControl',
            name: 'AppControl',
            // component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('@/views/AppControl.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'AppControl', active: true },
                ],
                rule: 'admin'
            },
        },
        {
            path: '/Notification',
            name: 'Notification',
            // component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('@/views/Notification.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Notification', active: true },
                ],
                rule: 'admin'
            },
        },
        {
            path: '/products/edit/list-view',
            name: 'products-edit--list-view',
            component: () => import('@/views/products/list-view/DataListListView.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'ProductsList'},
                    { title: 'ListView', active: true },
                ],
                pageTitle: 'List View',
                rule: 'admin'
            },
        },
        {
            path: '/categories',
            name: 'categories',
            // component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('@/views/categories/CategoriesList.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Categories'},
                    { title: 'List', active: true },
                ],
                pageTitle: ' All Categories',
                rule: 'admin'
            },
        },
        {
            path: '/products/list',
            name: 'products-list',
            component: () => import('@/views/products/thumb-view/DataListThumbView.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'ProductsList'},
                    { title: 'ThumbView', active: true },
                ],
                pageTitle: 'Thumb View',
                rule: 'admin'
            },
        },
        {
            path: '/products/list-view',
            name: 'products-list-view',
            component: () => import('@/views/products/list-view/DataListListView.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'ProductsList'},
                    { title: 'ListView', active: true },
                ],
                pageTitle: 'List View',
                rule: 'admin'
            },
        },
        {
            path: '/products/createProduct',
            name: 'products-create',
            component: () => import('@/views/products/ProductCreate.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'ProductsList'},
                    { title: 'ThumbView', active: true },
                ],
                pageTitle: 'Thumb View',
                rule: 'admin'
            },
        },
        {
            path: '/products/edit/:productId',
            name: 'product-edit',
            component: () => import('@/views/products/ProductEdit.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Products' },
                    { title: 'Edit', active: true },
                ],
                pageTitle: 'Product Edit',
                rule: 'admin'
            },
        },
        {
            path: '/users',
            name: 'users-list',
            component: () => import('@/views/users/user-list/UserList.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Users' },
                    // { title: 'View', active: true },
                ],
                pageTitle: 'User List',
                rule: 'admin'
            },
        },
        {
            path: '/users/create',
            name: 'user-create',
            component: () => import('@/views/users/user-edit/UserEdit.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Users' },
                    { title: 'Create', active: true },
                ],
                pageTitle: 'Create User',
                rule: 'admin'
            },
        },
        {
            path: '/users/edit/:userId',
            name: 'user-edit',
            component: () => import('@/views/users/user-edit/UserEdit.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Users' },
                    { title: 'Edit', active: true },
                ],
                pageTitle: 'User Edit',
                rule: 'admin'
            },
        },
        {
            path: '/questions',
            name: 'questions',
            component: () => import('@/views/questions/ListQuestions.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Questions' },
                    { title: 'List', active: true },
                ],
                pageTitle: 'Questions List',
                rule: 'operator'
            },
        },
        {
            path: '/questions/:id/respond',
            name: 'questions-responde',
            component: () => import('@/views/questions/Respond.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Questions' },
                    { title: 'Respond', active: true },
                ],
                pageTitle: 'Questions Respond',
                rule: 'operator'
            },
        },
        {
            path: '/orders',
            name: 'orders-list',
            component: () => import('@/views/orders/list/OrdersList.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Orders' },
                    { title: 'List', active: true },
                ],
                pageTitle: 'Order List',
                rule: 'operator'
            },
        },
        {
            path: '/orders/edit/:orderId',
            name: 'order-edit',
            component: () => import('@/views/orders/edit/OrderEdit.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Orders' },
                    { title: 'Edit', active: true },
                ],
                pageTitle: 'Order Edit',
                rule: 'operator'
            },
        },
        {
            path: '/promocodes',
            name: 'promocodes',
            // component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('@/views/promo-codes/PromocodesList.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'PromoCodes'},
                    { title: 'List', active: true },
                ],
                pageTitle: 'Promo Codes',
                rule: 'operator'
            },
        },
        {
            path: '/promocodes/create',
            name: 'promocodes-create',
            component: () => import('@/views/promo-codes/RecordEdit.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'PromocodesList'},
                    { title: 'CreatePromocode', active: true },
                ],
                pageTitle: 'Create Promocode',
                rule: 'admin'
            },
        },
        {
            path: '/promocodes/edit/:promocodeId',
            name: 'promocode-edit',
            component: () => import('@/views/promo-codes/RecordEdit.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'PromoCodes' },
                    { title: 'Edit', active: true },
                ],
                pageTitle: 'Promocode Edit',
                rule: 'admin'
            },
        },
        {
            path: '/shop/:search',
              name: 'search',
              component: () => import('./views/eCommerce/Search.vue'),
              meta: {
                  breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Shop', url: '/all' },
                    { title: 'Search', active: true },
                  ],
                  pageTitle: 'Search',
                  rule: 'public'
              }
          },
        {
            path: '/all',
            name: 'ecommerce-shop',
            component: () => import('./views/eCommerce/Shop.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Shop', active: true },
                ],
                pageTitle: 'Shop',
                rule: 'public'
            }
        },
        {
          path: '/category/:category',
            name: 'category',
            component: () => import('./views/eCommerce/Shop.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Category', active: true },
                ],
                pageTitle: 'Shop',
                rule: 'public'
            }
        },
        {
          path: '/shop/:category/filter/:filter',
            name: 'filter',
            component: () => import('./views/eCommerce/Shop.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Category', url: '/all' },
                    { title: 'Filter', active: true },
                ],
                pageTitle: 'Shop',
                rule: 'public'
            }
        },
        {
            path: '/wish-list',
            name: 'ecommerce-wish-list',
            component: () => import('./views/eCommerce/WishList.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Wishlist', active: true },
                ],
                pageTitle: 'Wish List',
                rule: 'customer'
            }
        },
        {
            path: '/checkout',
            name: 'ecommerce-checkout',
            component: () => import('./views/eCommerce/Checkout.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Checkout', active: true },
                ],
                pageTitle: 'Checkout',
                rule: 'public'
            }
        },
        {
            path: '/cart',
            name: 'ecommerce-cart',
            component: () => import('./views/eCommerce/Cart.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Shop', url:'/eCommerce/shop'},
                    { title: 'Cart', active: true },
                ],
                pageTitle: 'Cart',
                rule: 'public'
            }
        },
        {
            path: '/user-profile',
            name: 'ecommerce-user-profile',
            component: () => import('./views/users/UserProfile.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Profile', active: true },
                ],
                pageTitle: 'Profile',
                rule: 'customer'
            }
        },
        {
            path: '/user-orders',
            name: 'ecommerce-user-orders',
            component: () => import('./views/users/UserOrders.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Profile', url: '/user-profile' },
                    { title: 'Orders', active: true },
                ],
                pageTitle: 'Orders',
                rule: 'customer'
            }
        },
        {
            path: '/inqueries',
            name: 'ecommerce-user-inqueries',
            component: () => import('./views/users/UserMessages.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Profile', url: '/user-profile' },
                    { title: 'Messages', active: true },
                ],
                pageTitle: 'Messages',
                rule: 'customer'
            }
        },
        {
            path: '/user-orders/:order_id',
            name: 'ecommerce-user-order',
            component: () => import('./views/users/UserOrder.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Shop', url:'/user-profile'},
                    { title: 'Orders', active: true },
                ],
                pageTitle: 'Order Details',
                rule: 'customer'
            }
        },
        {
            path: '/products/view/:item_id',
            name: 'ecommerce-item-detail-view',
            component: () => import('./views/eCommerce/ItemDetailView.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Products', url: '/all' },
                    { title: 'ProductDetails', active: true },
                ],
                parent: "ecommerce-item-detail-view",
                pageTitle: 'Product Details',
                rule: 'public'
            }
        },
        {
          path: '/order-successfull',
          name: 'order-successfull',
          component: () => import('./views/OrderSuccessfull.vue'),
          meta: {
            rule: 'customer',
          }
        },
      ]
    },
    // =============================================================================
    // FULL PAGE LAYOUTS
    // =============================================================================
    // Redirect to 404 page, if no match found
    {
      path: '*',
      redirect: '/pages/error-404'
    }
  ]
})

router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById('loading-bg')
  if (appLoading) {
    appLoading.style.display = 'none'
  }
})

router.beforeEach((to, from, next) => {
    //
    // if(!localStorage.getItem("accessToken") || !localStorage.getItem("userInfo") ) {
    //     router.push({ path: '/login' })
    //     // if (acl && acl.not.check(to.meta.rule) ){

    //     // }
    // }


    return next()
    // Specify the current path as the customState parameter, meaning it
    // will be returned to the application after auth
    // auth.login({ target: to.path });

});

export default router
