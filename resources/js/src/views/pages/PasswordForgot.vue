<!-- =========================================================================================
    File Name: Login.vue
    Description: Login Page
    ----------------------------------------------------------------------------------------
    Project Name: Basmtak
      Author: Ahmed Khairy
    Author URL: http://www.clouds-line.com
========================================================================================== -->


<template>
  <div class="h-screen flex w-full bg-img">
      <div class="vx-col w-4/5 sm:w-4/5 md:w-3/5 lg:w-3/4 xl:w-3/5 mx-auto self-center">
          <vx-card>
              <div slot="no-body" class="full-page-bg-color">
                  <div class="vx-row">
                      <div class="vx-col hidden sm:hidden md:hidden lg:block lg:w-1/2 mx-auto self-center">
                          <img src="@assets/images/pages/forgot-password.png" alt="login" class="mx-auto">
                      </div>
                      <div class="vx-col sm:w-full md:w-full lg:w-1/2 mx-auto self-center d-theme-dark-bg">
                          <div class="p-8">
                              <div class="vx-card__title mb-8">
                                  <h4 class="mb-4">{{$t('ResetPassword')}}</h4>
                                  <p>{{$t('ResetPasswordText1')}}</p>
                              </div>
                              <vs-input type="email" :label-placeholder="$t('Email')" v-model="email" class="w-full mb-8" />
                              <vs-button type="border" to="/login" class="px-4 w-full md:w-auto">{{$t('BackToLogin')}}</vs-button>
                              <vs-button @click="forgotPassword()" :disabled="email.length <= 0" class="float-right px-4 w-full md:w-auto mt-3 mb-8 md:mt-0 md:mb-0">{{$t('Send')}}</vs-button>
                          </div>
                      </div>
                  </div>
              </div>
          </vx-card>
      </div>
  </div>
</template>

<script>
// import LoginJwt from "./LoginJWT.vue"
import axios                from "@/axios.js"




export default{
  data () {
    return {
      email: '',
    }
  },
  computed: {
    remotePath (){
      return process.env.ASSET_PATH
    },
    validateForm() {
      return !this.errors.any() && this.email != '' && this.password != '';
    },
  },
  // components: {
  //   // LoginJwt
  // },
  methods: {
    checkLogin() {
      // If user is already logged in notify
      if (this.$store.state.auth.isUserLoggedIn()) {
        // Close animation if passed as payload
        // this.$vs.loading.close()
        this.$vs.notify({
          title: 'خطاء',
          text: 'لقد قمت بتسجيل الدخول مسبقاً',
          iconPack: 'feather',
          icon: 'icon-alert-circle',
          color: 'warning'
        })

        return false
      }
      return true
    },
    forgotPassword() {
      // Loading
      this.$vs.loading()

      return new Promise((resolve, reject) => {
        axios.post("/api/auth/forgotPassword", {email: this.email})
            // this.$store.dispatch('auth/loginJWT', payload)
            .then(res => {
              this.$vs.loading.close()
                  if( res.data.statusCode == 200 ){
                    this.$vs.notify({
                      color: 'success',
                      title: 'Successfull',
                      fixed: true,
                      position:'top-center',
                      title: 'تم بنجاح',
                      text: 'الرجاء التحقق من بريدك الالكتروني'
                    })
                  }else{
                    this.$vs.notify({
                      color: 'danger',
                      title: 'Error',
                      position:'top-center',
                      text: 'خطاء في البيانات المدخلة'
                    })
                  }
              })
             .catch((error) => {
               this.$vs.loading.close()
               this.$vs.notify({
                 color: 'danger',
                 title: 'خطاء',
                 text: error.message,
                 fixed: true,
                 position:'top-center'
               })

              })
         })



      // .catch(err => {                     this.$vs.notify({
      //                       color: 'danger',
      //                       title: 'Error',
      //                       position:'top-center',
      //                       text: 'خطاء في البيانات المدخلة'
      //                     })
      //  })
    },
    // resetPermissions(){
    //
    // },
    registerUser() {
      if (!this.checkLogin()) return
      this.$router.push('/register').catch(() => {})
    }
  },
  created(){
    if (!this.checkLogin()) {
      this.$router.push('/dashboard')
    }
  }

}
</script>

<style lang="scss">
#page-login {
  .social-login-buttons {
    .bg-facebook { background-color: #1551b1 }
    .bg-twitter { background-color: #00aaff }
    .bg-google { background-color: #4285F4 }
    .bg-github { background-color: #333 }
  }
}
</style>
