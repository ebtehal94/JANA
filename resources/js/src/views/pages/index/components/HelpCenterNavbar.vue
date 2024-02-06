<template>
 <div>
     <!-- Help Center Navbar -->
     <nav class="st-nav navbar main-nav navigation" id="main-nav">
        <div class="container">
            <a href="" class="navbar-brand mr-md-2">
              <img src="@assets/images/logo/logo.png" alt="basmtak" class="logo logo-sticky">
              <!-- <img src="@assets/images/logo/logo-light-2.png" alt="Dashcore" class="logo d-none d-md-block"> -->
            </a>
            <ul class="st-nav-menu nav navbar-nav">
                <li class="st-nav-section nav-item" v-if="!isLoggedIn">
                    <a class="btn btn-rounded btn-solid mr-md-3" href="login" target="_blank">
                        <i class="fas fa-sign-in-alt d-inline d-md-inline mr-md-0 mr-lg-2"></i>
                        <span class="d-md-none d-lg-inline bold">{{$t('NavLogin')}}</span>
                    </a>
                    <a class="btn btn-rounded btn-solid  px-3 mr-4 register-btn" href="register" target="_blank" style="color: #ffffff; background-color: #0083dd; border-color: #0083dd;">
                        <i class="fas fa-user-plus d-inline d-md-inline mr-md-0 mr-lg-2"></i>
                        <span class="d-md-none d-lg-inline">{{$t('NavRegister')}}</span>
                    </a>
                </li>
                <li class="st-nav-section nav-item" v-if="isLoggedIn">
                    <a class="btn btn-rounded btn-outline mr-3 px-3" href="dashboard" target="_blank">
                        <i class="fas fa-sign-in-alt d-inline d-md-inline mr-md-0 mr-lg-2">{{$t('NavDashboard')}}</i>
                    </a>
                </li>

                <li class="st-nav-section nav-item ">
                  <i18n />
                </li>

                <!-- <dark-mode/> -->
            </ul>
        </div>
        <div class="st-dropdown-root">
            <div class="st-dropdown-bg">
                <div class="st-alt-bg"></div>
            </div>

        </div>
    </nav>
 </div>
</template>

<script>
import I18n  from "./I18n.vue"
export default {
  components: {
    I18n 
  },
  computed: {
  },
  methods: {

  }
}
</script>

<style>
@media (max-width: 575px){
  .st-nav .st-nav-menu{
    flex: none !important;
  }
  .register-btn{
    margin-left:1.8rem !important;
  }
}
</style>
