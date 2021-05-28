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
        },
        {
            path: '/support',
            name: 'support',
            component: () => import('@/views/pages/Support.vue'),
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
        {
          path: '/dashboard',
          name: 'dashboard',
        //   component: () => import('@/views/pages/ComingSoon.vue'),
          component: () => import('./views/dashboard/Dashboard.vue'),
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
            component: () => import('./views/payment/FinancialOperations.vue'),
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
            name: 'offers',
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
            path: '/offers/edit/:offerID',
            name: 'edit-offer',
            //   component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('./views/offers/EditOffer.vue'),
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
            name: 'customers',
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
            path: '/stores',
            name: 'stores',
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
            name: 'create-store',
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
            name: 'edit-store',
            //   component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('./views/stores/CreateStore.vue'),
            meta: {
              breadcrumb: [
                { title: 'Home', url: '/' },
                { title: 'Stores'},
                { title: 'Edit', active: true },
              ],
              rule: 'vendor',
            }
          },
        {
            path: '/accounts',
            name: 'accounts',
            // component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('@/views/admins/Accounts.vue'),
            meta: {
                breadcrumb: [
                    { title: 'Home', url: '/' },
                    { title: 'Accounts', active: true },
                ],
                rule: 'admin'
            },
        },
        {
            path: '/admins/create',
            name: 'create-admin',
          //   component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('./views/admins/CreateAdmin.vue'),
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
            path: '/admins/edit/:userID',
            name: 'Edit-Admin',
          //   component: () => import('@/views/pages/ComingSoon.vue'),
            component: () => import('./views/admins/CreateAdmin.vue'),
            meta: {
              breadcrumb: [
                  { title: 'Home', url: '/' },
                  { title: 'Accounts'},
                  { title: 'Edit', active: true },
              ],
                rule: 'admin',
            }
          },
        {
            path: '/appControl',
            name: 'appControl',
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
            path: '/notification',
            name: 'notification',
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
