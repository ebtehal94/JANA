<!-- =========================================================================================
    File Name: Login.vue
    Description: Login Page
    ----------------------------------------------------------------------------------------

========================================================================================== -->
<template>
  <div class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center" id="page-login">
    <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-4/5 sm:m-0 m-5">
      <div class="vx-row m-4">
        <i18n class="text-bold"/>
      </div>
      <vx-card class="rounded-corner shadow-none">
        <div slot="no-body">
          <div class="vx-row no-gutter justify-center items-center py-10">
            <div class="vx-col hidden lg:block lg:w-2/5 pl-1.5">
              <img src="@assets/images/logo/jana-plus.png" alt="jana" class="mx-auto" width="110">
            </div>

            <div class="vx-col sm:w-full md:w-full lg:w-1/2">
              <div class="p-8 login-tabs-container">
                <div class="vx-card__title mb-4">
                  <div class="separator">
                    <h4 class="mb-4 text-lg font-bold">{{ $i18n.locale == 'en' ? 'Reset Password' : 'إعادة تعيين كلمةالمرور' }}</h4>
                  </div>
                </div>

                <div class="bg-input">
                  <icon name="email" class="icon"/>
                  <vs-input
                      size="large"
                      v-validate="'required|email|min:3'"
                      data-vv-validate-on="blur"
                      name="email"
                      icon-no-border
                      icon="icon"
                      :placeholder="$t('email')"
                      v-model="email"
                      class="w-full text-base"/>
                  <span v-if="!errors.has('email') && email">
                    <icon name="confirm" class="icon left-icon"/>
                  </span>
                  <span v-else-if="errors.has('email')">
                    <icon name="cross" class="icon left-icon"/>
                  </span>
                </div>

                <div class="bg-input">
                  <icon name="password" class="icon"/>
                  <vs-input
                      size="large"
                      data-vv-validate-on="blur"
                      v-validate="'required|min:6'"
                      type="password"
                      name="password"
                      ref="password"
                      icon-no-border
                      icon="icon"
                      :placeholder="$t('password') "
                      v-model="password"
                      class="w-full mt-3" />
                  <span v-if="!errors.has('password') && password">
                    <icon name="confirm" class="icon left-icon"/>
                  </span>
                  <span v-else-if="errors.has('password')">
                    <icon name="cross" class="icon left-icon"/>
                  </span>
                </div>

                <div class="bg-input">
                  <icon name="password" class="icon"/>
                  <vs-input
                      size="large"
                      data-vv-validate-on="blur"
                      v-validate="'min:6|confirmed:password'"
                      data-vv-as="password"
                      type="password"
                      name="confirm_password"
                      icon-no-border
                      icon="icon"
                      :placeholder="$t('confirmPassword') "
                      v-model="confirm_password"
                      class="w-full mt-3" />
                  <span v-if="!errors.has('confirm_password') && password">
                    <icon name="confirm" class="icon left-icon"/>
                  </span>
                  <span v-else-if="errors.has('confirm_password')">
                    <icon name="cross" class="icon left-icon"/>
                  </span>
                </div>

                <div class="vx-row flex justify-between mt-10">
                    <vs-button
                      size="small"
                      class="mx-4 mb-4 font-semibold text-sm rounded-full"
                      color="#ACACAC" type="border"
                      to="/">
                      {{$t('BackToLogin')}}
                      </vs-button>

                      <vs-button
                      size="small"
                      class="mx-4 mb-4 font-semibold text-sm rounded-full px-28 "
                      color="linear-gradient(to left,#E93F7D,#DA6653)"
                      gradient
                      @click="forgotPassword()"
                      :disabled="email.length <= 0">
                      {{$t('Send')}}
                      </vs-button>
                </div>
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
import axios from "@/axios.js"
import icon from '../../layouts/components/icon.vue';
import I18n  from "@/layouts/components/navbar/components/I18n.vue"



export default{
  components:{
    icon,
    I18n
  },
  data () {
    return {
      email: '',
      password: '',
      confirm_password: '',
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
        axios.post("/api/auth/resetPassword", {token: this.$route.params.token,
                                                password: this.password,
                                                email: this.email})
            .then(res => {
              this.$vs.loading.close()
                  if( res.data.statusCode == 200 ){
                    this.$vs.notify({
                      color: 'success',
                      title: 'Successfull',
                      fixed: true,
                      position:'top-center',
                      title: 'تم بنجاح',
                      text: 'تمت اعادة تعيين كلمة المرور بنجاح'
                    })
                    this.$router.push({path: '/login'})
                  }else if ( res.data.statusCode == 400 ){
                    this.$vs.notify({
                      color: 'danger',
                      title: 'Error',
                      position:'top-center',
                      text: 'خطاء في البيانات المدخلة'
                    })
                  } else if ( res.data.statusCode == 401 ){
                    this.$vs.notify({
                      color: 'danger',
                      title: 'Error',
                      position:'top-center',
                      text: 'لقد انتهت الفترة المسموحة'
                    })
                  } else {
                    this.$vs.notify({
                      color: 'danger',
                      title: 'Error',
                      position:'top-center',
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
  .rounded-corner{
    border-radius: 25px;
  }
  .separator{
    display: flex;
    align-items: center;
    text-align: center;
  }
  .separator::before, .separator::after {
    content: '';
    flex: 1;
    border-bottom: 1px solid #e2e2e2;
  }
  .separator::before {
    margin-right: 1em;
  }
  .separator::after {
    margin-left: 1em;
  }
  .separator{
    h4{
      color: #999999;
    }
  }

  .bg-input{
    position: relative;
    .icon{
      position: absolute;
      top:14px;
      left: 20px;
      z-index: 9999;
      padding-right: 20px;
    }
    .phone-icon{
      position: absolute;
      top:14px;
      left: 28px;
    }
    .left-icon{
      position: absolute;
      top:18px;
      left: 90%;
      z-index: 9999;

    }
  }
  .register-btn{
    background:linear-gradient(#E93F7D,#DA6653) ;
    border-radius:30px ;
  }
  .login-btn{
    color: #DC6755;
  }
  .account{
    color: #ACACAC;
  }
</style>
