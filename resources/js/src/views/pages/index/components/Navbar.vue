<template>

        <nav class="st-nav navbar main-nav navigation fixed-top" id="main-nav">
          <div class="container">
              <a href="" class="navbar-brand mr-0 mr-md-2">
                <img src="@assets/images/logo/logo.png" alt="basmtak" class="logo logo-sticky d-block d-md-none">
                <img src="@assets/images/logo/logo-light-2.png" alt="Dashcore" class="logo d-none d-md-block">
              </a>
              <ul class="st-nav-menu nav navbar-nav">
                  <li class="st-nav-section st-nav-primary nav-link"><a class="st-root-link nav-link" href="#"> {{$t('NavHome')}}</a>
                      <a class="st-root-link item-products nav-link" @click="scrollToFeat" > {{$t('NavFeatures')}} </a>
                      <a class="st-root-link item-products nav-link" @click="scrollStartNow"> {{$t('NavStartNow')}} </a>
                      <a class="st-root-link item-blog nav-link" @click="scrollClients">{{$t('NavClients')}} </a>
                      <a class="st-root-link item-shop nav-link" @click="scrollFAQ">{{$t('NavFaq')}}</a>
                      <!-- <a class="st-root-link item-company nav-link" @click="scrollPricing"> {{$t('NavPricing')}}</a> -->
                  </li>
                  <li class="st-nav-section nav-item" v-if="!isLoggedIn">
                      <a class="btn btn-rounded btn-solid mr-md-3 mb-sm-2 mb-md-0 px-4" href="login" target="_blank">
                          <i class="fas fa-sign-in-alt d-inline d-md-inline mr-md-0 mr-lg-2"></i>
                          <span class="d-md-none d-lg-inline bold">{{$t('NavLogin')}}</span>
                      </a>
                      <a class="btn btn-rounded btn-outline  px-3 mr-4 register-btn" href="register" target="_blank">
                          <i class="fas fa-user-plus d-inline d-md-inline mr-md-0 mr-lg-2"></i>
                          <span class="d-md-none d-lg-inline">{{$t('NavRegister')}}</span>
                      </a>
                  </li>
                  <li class="st-nav-section nav-item" v-if="isLoggedIn">
                      <a class="btn btn-rounded btn-outline mr-3 px-3" href="dashboard" target="_blank">
                          <i class="fas fa-sign-in-alt d-inline d-md-inline mr-md-0 mr-lg-2">{{$t('NavDashboard')}}</i>
                      </a>
                  </li>
  
                  <li class="st-nav-section nav-item">
                    <i18n />
                  </li>
  

              </ul>
          </div>
          <div class="st-dropdown-root">
              <div class="st-dropdown-bg">
                  <div class="st-alt-bg"></div>
              </div>
  
          </div>
      </nav>

   </template>
   
   <script>
   import I18n  from "./I18n.vue"


   export default {
    components: {
        I18n
   },
    data () {
        return {
            isLoggedIn: false,
        }
    },
     computed: {
   
     },
     methods: {
        scrollToFeat() {
        window.scrollTo(0, 750);
        },
        scrollStartNow() {
        window.scrollTo(0, 1400);
        },

        scrollClients() {
        window.scrollTo(0, 4000);
        },
        scrollFAQ() {
        window.scrollTo(0, 4650);
        },
        scrollPricing() {
        window.scrollTo(0, 5150);
        },
     }
   }
   </script>
   
   <style>
  @media (max-width: 575px){
    .st-nav .st-nav-menu{
      flex: none !important;
    }
    .register-btn{
      margin-left:1rem !important;
    }
  }
   </style>
   