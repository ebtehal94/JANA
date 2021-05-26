<!-- =========================================================================================
    File Name: Login.vue
    Description: Login Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
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
                    <h4 class="mb-4 text-lg font-bold">{{$t('accountData')}}</h4> 
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
                      v-validate="'required|min:6|max:10'"
                      type="password"
                      name="password"
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

                <div class="flex flex-wrap justify-between my-5">
                  <vs-checkbox v-model="checkbox_remember_me" class="mb-3 account  text-sm checkbox" siza="small">{{ $i18n.locale == 'en' ? 'Remember Me' : 'تذكرني' }}</vs-checkbox>
                  <router-link to="/pages/forgot-password" class="account  text-sm">{{ $i18n.locale == 'en' ? 'Forgot Password?' : 'نسيت كلمة المرور؟' }}</router-link>
                </div>
                <div class=" mb-3">
                    <vs-button
                      class="w-full mt-10 font-medium register-btn text-lg"
                      color="linear-gradient(to left,#E93F7D,#DA6653)"
                      gradient
                      @click="loginJWT">
                      {{$t('Login')}} 
                      </vs-button>
                </div>
                <div class="w-full text-center">
                    <span class="account pl-0.5 text-sm">{{ $i18n.locale == 'en' ? "Don't have an account ?" : 'ليس لديك حساب؟' }}</span>
                    <vs-button 
                    class="login-btn p-0 text-sm"
                    size="small" 
                    type="transparent" 
                    to="/">
                      {{ $i18n.locale == 'en' ? 'Create Account' : ' أنشئ حسابك الآن' }}  
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
import icon from '../../layouts/components/icon.vue';
import I18n  from "@/layouts/components/navbar/components/I18n.vue"
export default{
  components: { 
    icon,
    I18n 
    },
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
    }
  },
  methods: {
    checkLogin() {
      return true
    },
    loginJWT() {

      if (!this.checkLogin()) return
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
                        if( res.data.statusCode == 200 ){
                          this.$vs.notify({
                            color: 'success',
                            title: 'Successfull',
                            position:'top-center',
                            text: 'تم تسجيل الدخول بنجاح'
                          })
                          this.$acl.change(res.data.userData.rule)
                          if(this.$acl.check('admin')){
                            this.$store.dispatch('updateMainLayout', 'vertical')
                            this.$router.push('/dashboard')
                          }else {
                              this.$router.push('/')
                            }
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
    registerUser() {
      if (!this.checkLogin()) return
      this.$router.push('/register').catch(() => {})
    }
  }

}
</script>

<style lang="scss" scoped>
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

  .vs-checkbox-primery{
    .checkbox_x {
      border-radius: 50%;
    }
  }
</style>