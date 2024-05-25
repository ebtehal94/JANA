/*=========================================================================================
  File Name: router.js
  Description: Routes for vue-router. Lazy loading is enabled.
  ----------------------------------------------------------------------------------------
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
          path: '/register',
          name: 'page-register',
          component: () => import('@/views/pages/Register.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/login',
          name: 'page-login',
          component: () => import('@/views/pages/Login.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/',
          name: 'index',
          component: () => import('@/views/pages/index/index.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/try-register',
          name: 'try-register',
          component: () => import('@/views/pages/index/TryRegister.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/tow-steps-v',
          name: 'tow-steps-v',
          component: () => import('@/views/pages/index/TowStepsV.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/muqeem-login',
          name: 'muqeem-login',
          component: () => import('@/views/pages/index/Muqeem/Login.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/muqeem',
          name: 'muqeem',
          component: () => import('@/views/pages/index/Muqeem/Muqeem.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/issue-visa',
          name: 'issue-visa',
          component: () => import('@/views/pages/index/Muqeem/components/IssueVisa.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/cancle-visa',
          name: 'cancle-visa',
          component: () => import('@/views/pages/index/Muqeem/components/CancleVisa.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/reprint-visa',
          name: 'reprint-visa',
          component: () => import('@/views/pages/index/Muqeem/components/ReprintVisa.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/issue-final-exit',
          name: 'issue-final-exit',
          component: () => import('@/views/pages/index/Muqeem/components/IssueFinalExit.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/cancle-final-exit',
          name: 'cancle-final-exit',
          component: () => import('@/views/pages/index/Muqeem/components/CancleFinalExit.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/extend-passport',
          name: 'extend-passport',
          component: () => import('@/views/pages/index/Muqeem/components/ExtendPassportValidity.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/renew-passport',
          name: 'renew-passport',
          component: () => import('@/views/pages/index/Muqeem/components/RenewPassport.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/renew-iqama',
          name: 'renew-iqama',
          component: () => import('@/views/pages/index/Muqeem/components/RenewIqama.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/iqama-transfer',
          name: 'iqama-transfer',
          component: () => import('@/views/pages/index/Muqeem/components/IqamaTransfer.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/issue-iqama',
          name: 'issue-iqama',
          component: () => import('@/views/pages/index/Muqeem/components/IssueIqama.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/extend-visit-visa',
          name: 'extend-visit-visa',
          component: () => import('@/views/pages/index/Muqeem/components/ExtendVisitVisa.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/check-mol-approval',
          name: 'check-mol-approval',
          component: () => import('@/views/pages/index/Muqeem/components/CheckMOLApproval.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/change-occupation',
          name: 'change-occupation',
          component: () => import('@/views/pages/index/Muqeem/components/ChangeOccupation.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/probationary-period',
          name: 'probationary-period',
          component: () => import('@/views/pages/index/Muqeem/components/ProbationaryPeriod.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/knowledge-base',
          name: 'knowledge-base',
          component: () => import('@/views/pages/index/knowledgeBase.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/questions-list',
          name: 'questions-list',
          component: () => import('@/views/pages/index/QuestionsList.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/create-question',
          name: 'create-question',
          component: () => import('@/views/pages/index/CreateQuestion.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/edit-question/:questionID',
          name: 'edit-question',
          component: () => import('@/views/pages/index/CreateQuestion.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/category-questions',
          name: 'category-questions',
          component: () => import('@/views/pages/index/components/CategoryQuestions.vue'),
          meta: {
            rule: 'public'
          }
        },
        // {
        //   path: '/system-intro',
        //   name: 'system-intro',
        //   component: () => import('@/views/pages/index/components/SystemIntro.vue'),
        //   meta: {
        //     rule: 'public'
        //   }
        // }, 

        {
          path: '/forgot-password',
          name: 'page-forgot-password',
          component: () => import('./views/pages/PasswordForgot.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/reset-password/:token',
          name: 'page-reset-password',
          component: () => import('@/views/pages/PasswordReset.vue'),
          meta: {
            rule: 'public'
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
        },
        {
          path: '/terms',
          name: 'terms',
          component: () => import('@/views/pages/Terms.vue'),
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
              { title: 'Reports', active: true }
            ],
            rule: 'public'
          }
        },
        {
          path: '/main',
          name: 'main',
          component: () => import('@/views/BasmatkWebApp/main.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/reports',
          name: 'reports',
          component: () => import('@/views/BasmatkWebApp/reports.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/requests',
          name: 'requests',
          component: () => import('@/views/BasmatkWebApp/requests.vue'),
          meta: {
            rule: 'public'
          }
        },
        
        {
          path: '/request-details',
          name: 'request-details',
          component: () => import('@/views/BasmatkWebApp/requestDetails.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/new-request',
          name: 'new-request',
          component: () => import('@/views/BasmatkWebApp/newRequest.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/vacations',
          name: 'vacations',
          component: () => import('@/views/BasmatkWebApp/vacations.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/missing-checkouts',
          name: 'missing-checkouts',
          component: () => import('@/views/BasmatkWebApp/missingCheckouts.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/late-checkouts',
          name: 'late-checkouts',
          component: () => import('@/views/BasmatkWebApp/lateCheckouts.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/payroll',
          name: 'payroll',
          component: () => import('@/views/BasmatkWebApp/payroll.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/warnings',
          name: 'warnings',
          component: () => import('@/views/BasmatkWebApp/warnings.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/warnings-details',
          name: 'warnings-details',
          component: () => import('@/views/BasmatkWebApp/warningsDetails.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/account',
          name: 'account',
          component: () => import('@/views/BasmatkWebApp/account.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/personal-information',
          name: 'personal-information',
          component: () => import('@/views/BasmatkWebApp/personalInformation.vue'),
          meta: {
            rule: 'public'
          }
        },
        {
          path: '/documents',
          name: 'documents',
          component: () => import('@/views/BasmatkWebApp/documents.vue'),
          meta: {
            rule: 'public'
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
              { title: 'Operations', active: true }
            ],
            rule: 'admin'
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
              { title: 'Offers', active: true }
            ],
            rule: 'vendor'
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
              { title: 'CreateOffer', active: true }
            ],
            rule: 'vendor'
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
              { title: 'Edit', active: true }
            ],
            rule: 'vendor'
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
              { title: 'Customers', active: true }
            ],
            rule: 'admin'
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
              { title: 'CreateCustomer', active: true }
            ],
            rule: 'admin'
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
              { title: 'Edit', active: true }
            ],
            rule: 'admin'
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
              { title: 'Stores', active: true }
            ],
            rule: 'vendor'
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
              { title: 'CreateStore', active: true }
            ],
            rule: 'vendor'
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
              { title: 'Edit', active: true }
            ],
            rule: 'vendor'
          }
        },
        {
          path: '/admins',
          name: 'admins',
          // component: () => import('@/views/pages/ComingSoon.vue'),
          component: () => import('@/views/admins/admins.vue'),
          meta: {
            breadcrumb: [
              { title: 'Home', url: '/' },
              { title: 'Accounts', active: true }
            ],
            rule: 'admin'
          }
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
              { title: 'CreateAdmin', active: true }
            ],
            rule: 'admin'
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
              { title: 'Edit', active: true }
            ],
            rule: 'admin'
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
              { title: 'AppControl', active: true }
            ],
            rule: 'admin'
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

})

export default router
