
<template>
  <!-- <div class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center" id="page-login"> -->
    <div class="vx-col w-full">
      <vx-card>
        <div slot="no-body" class="full-page-bg-color">

          <div class="vx-row no-gutter justify-center items-center">
<!--
            <div class="vx-col hidden lg:block lg:w-1/2">
              <img src="@assets/images/pages/login.png" alt="login" class="mx-auto">
            </div> -->

            <div class="vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg mb-4 p-8">
                  <vs-input
                      v-validate="'required|email|min:3'"
                      data-vv-validate-on="blur"
                      :label="$t('Email')"
                      icon-no-border
                      icon="icon icon-mail"
                      icon-pack="feather"
                      v-model="email"
                      class="w-full mt-4" />
                  <span class="text-danger text-sm">{{ errors.first('email') }}</span>

                  <vs-input
                      data-vv-validate-on="blur"
                      v-validate="'required|min:6|max:10'"
                      type="password"
                      :label="$t('Password')"
                      icon-no-border
                      icon="icon icon-lock"
                      icon-pack="feather"
                      v-model="password"
                      class="w-full mt-4" />
                  <span class="text-danger text-sm">{{ errors.first('password') }}</span>

                  <div class="flex flex-wrap justify-between my-5">
                      <vs-checkbox v-model="checkbox_remember_me" class="mb-3">Remember Me</vs-checkbox>
                      <router-link to="/pages/forgot-password">Forgot Password?</router-link>
                  </div>

                  <vs-button :disabled="!validateForm" @click="loginJWT">Login</vs-button>
            </div>
          </div>
        </div>
      </vx-card>
    </div>
  <!-- </div> -->
</template>

<script>
export default{
  data () {
    return {
      email: '',
      password: '',
      checkbox_remember_me: false
    }
  },
  computed: {
    validateForm() {
      return !this.errors.any() && this.email != '' && this.password != '';
    },
  },
  methods: {
    // checkLogin() {
      // If user is already logged in notify
      // if (this.$store.state.auth.isUserLoggedIn()) {

        // Close animation if passed as payload
        // this.$vs.loading.close()
      //
      //   this.$vs.notify({
      //     title: 'Login Attempt',
      //     text: 'You are already logged in!',
      //     iconPack: 'feather',
      //     icon: 'icon-alert-circle',
      //     color: 'warning'
      //   })
      //
      //   return false
      // }
      // return true
    // },
    loginJWT() {
      const payload = {
        checkbox_remember_me: this.checkbox_remember_me,
        userDetails: {
          email: this.email,
          password: this.password
        }
      }

      return new Promise((resolve, reject) => {
            this.$store.dispatch('auth/loginJWT', payload)
            .then(res => {
              this.$vs.loading.close()
                        if( res.data.accessToken ){
                          this.$vs.notify({
                            color: 'success',
                            title: 'Successfull',
                            position:'top-center',
                            text: 'تم تسجيل الدخول بنجاح'
                          })
                          this.$acl.change(res.data.userData.rule)
                          this.$router.push('/cart')

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
                 position:'top-center'
               })

              })
         })

    },
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
