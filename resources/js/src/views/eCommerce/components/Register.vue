
<template>
  <!-- <div class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center" id="page-login"> -->
    <div class="vx-col w-full">
      <vx-card>
        <div slot="no-body" class="full-page-bg-color">

          <div class="vx-row no-gutter justify-center items-center">

            <div class="vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg p-8">
              <vs-input
                class="w-full mt-4"
                :label="$t('Name')"
                v-model="data_local.name"
                v-validate="'required|alpha_spaces'"
                icon-no-border
                icon="icon icon-user"
                icon-pack="feather"
                name="name" />
              <span class="text-danger text-sm"  v-show="errors.has('name')">{{ errors.first('name') }}</span>


              <vs-input
                :label="$t('Mobile')"
                placeholder="56xxxxxxx"
                v-model="data_local.mobile"
                type="number"
                icon-no-border
                icon="icon icon-phone"
                icon-pack="feather"
                v-validate="'required|min:9|max:9'"
                class="w-full mt-4" />
              <span class="text-danger text-sm"  v-show="errors.has('mobile')">{{ errors.first('mobile') }}</span>
            </div>

            <div class="vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg p-8">
                  <vs-input
                      v-validate="'required|email|min:3'"
                      data-vv-validate-on="blur"
                      :label="$t('Email')"
                      icon-no-border
                      icon="icon icon-mail"
                      icon-pack="feather"
                      v-model="data_local.email"
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
                      v-model="data_local.password"
                      class="w-full mt-4" />
                  <span class="text-danger text-sm">{{ errors.first('password') }}</span>

                <!-- </div> -->

            </div>

            <div class="flex flex-wrap justify-between mb-3">
              <vs-button @click="registerUser" :disabled="!validateForm">Register</vs-button>
            </div>
          </div>
        </div>
      </vx-card>
    </div>
  <!-- </div> -->
</template>

<script>
// Store Module
import moduleUserManagement from '@/store/user-management/moduleUserManagement.js'

export default{
  data () {
    return {
      data_local: { 
        name: null, 
        email: null, 
        mobile: null, 
        password: null, 
        rule: 'customer', 
        status: 1
      },
    }
  },
  computed: {
    validateForm() {
      return !this.errors.any() && ((!this.data_local.id && this.data_local.password) || this.data_local.id)
    },
  },
  methods: {
    registerUser() {
      if(!this.validateForm) return

      const obj = {
        name: this.data_local.name,
        email: this.data_local.email,
        mobile: this.data_local.mobile,
        status: this.data_local.status,
        rule: this.data_local.rule
      }

      if (this.data_local.password){
        obj.password = this.data_local.password
      }

      this.$store.dispatch("userManagement/addUser", obj)
        .then(res => {
          if( res.data.statusCode == 200 ){
            this.$vs.notify({
              color: 'success',
              title: 'Successfull',
              text: 'User created successfully'
            })
            this.loginJWT()
          } else {
            this.$vs.notify({
              color: 'danger',
              title: 'Error',
              text: 'Error creating user'
            })
          }
        })
        .catch(err => { console.error(err) })
    },
    loginJWT() {
      const payload = {
        checkbox_remember_me: this.checkbox_remember_me,
        userDetails: {
          email: this.data_local.email,
          password: this.data_local.password
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
          } else {
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
  },
  created() {
    // Register Module UserManagement Module
    if(!moduleUserManagement.isRegistered) {
      this.$store.registerModule('userManagement', moduleUserManagement)
      moduleUserManagement.isRegistered = true
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
