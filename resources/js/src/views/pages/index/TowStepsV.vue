<!-- =========================================================================================
    File Name: Login.vue
    Description: Login Page
========================================================================================== -->


<template>
    <div class="flex w-full vx-row no-gutter items-center justify-center bg-white">
      <div class="vx-col">

          <vs-button
          class="mt-8 ml-2 font-bold home-btn"
          size="small"
          type="transparent"
          to="/">
          {{$i18n.locale == "en" ? "Back to Home" : "عودة للصفحة الرئيسية >>"}}
          </vs-button>

       <div>
        <vx-card class="shadow-none">
          <div slot="no-body">
            <div class="vx-row no-gutter justify-center items-center">           
                <div class="vx-col sm:w-full md:w-full lg:w-3/4">
                        <div class="vx-row">
                          <div class="vx-col w-full mt-4">
                            <img src="@assets/images/basmatk/Login-confirm.png" width="30%" class="m-auto">
                          </div>
                        </div>
                        <div class="p-8 login-tabs-container text-center">
                          <div class="vx-card__title">
                              <h4 class="mb-4 text-lg font-extrabold">{{$t('tryTitle1')}}<span class="try-text font-extrabold"> {{$t('tryTitle2')}}</span></h4>
                              <span class="text-black text-sm">{{$i18n.locale == "en" ? "We sent the activation code to the number " : " ارسلنا رمز التفعيل للرقم"}}<span class="text-black">(user_data.mobile)</span></span>
                              <a class="edit-btn p-0 text-sm font-semibold" href="https://basmtak.com/myAccount">{{$i18n.locale == "en" ? "(ُEdit)" : "(تعديل)"}}</a>
                          </div>
                          <div class=" mt-4 "><span class="text-black text-xs">قد يصلك الرمز خلال 00:30 ثانية</span></div>
                          <div  class="mt-2 justify-center" style="display: flex; flex-direction: row;">
                            <v-otp-input
                              v-model="otp"
                              ref="otpInput"
                              input-classes="otp-input"
                              :num-inputs="4"
                              :should-auto-focus="true"
                              :is-input-num="true"
                              separator=""
                            />
                        </div>
                        
                        <div class="text-right">
                          <a class="text-black p-0 text-xs underline resend-btn" href="" @click="resendCode()">{{$i18n.locale == "en" ? "ِResend Code" : "اعادة ارسال الرمز"}}</a>
                        </div>
                      
                        
                        <div class=" mb-3 text-center">
                              <vs-button
                                class="lg:w-1/2 mt-10 font-bold register-btn"
                                color="#0C65D1"
                                @click="activateCode()">
                                {{$i18n.locale == "en" ? "Start Your Free Account Now" : "ابدأ حسابك المجاني الآن >>"}}
                              </vs-button>
                        </div>
                      </div>
                </div>

            </div>
          </div>
        </vx-card>
      </div>
      </div>
    </div>
  </template>
  
  
  
  <script>
  import axios from "@/axios.js";
  import icon from '../../../layouts/components/icon.vue';
  import I18n  from "@/layouts/components/navbar/components/I18n.vue"
  import TryRegister from "./TryRegister.vue"
  export default{
    components:{
      icon,
      I18n,
      TryRegister
    },
    data () {
      return {
        otp: '',
      }
    },
    computed: {

    },
    methods: {
      activateCode() {
        return new Promise((resolve, reject) => {
        axios.post('/api/otp/', {otp: this.otp})
          .then((response) => {
            this.$vs.loading.close()
            if( res.data.statusCode == 200 ){
                this.$vs.notify({
                  color: 'success',
                  title: "Successfull",
                  text: 'تم النحقق بنجاح',
                  fixed: 'true',
                  position: "top-center"
                })
              }
            resolve(response)
          })
            .catch((error) => {
              this.$vs.loading.close()
              this.$vs.notify({
                color: 'danger',
                title: 'Error',
                text: 'حدث خطاء ما',
                position:'top-center'
              })
             })
      })
      },

      resendCode() {
        return new Promise((resolve, reject) => {
        axios.post('/api/otp/resend')
          .then((response) => {
            this.$vs.loading.close()
            if( res.data.statusCode == 200 ){
                this.$vs.notify({
                  color: 'success',
                  title: "Successfull",
                  text: 'تم النحقق بنجاح',
                  fixed: 'true',
                  position: "top-center"
                })
              }
            resolve(response)
          })
            .catch((error) => {
              this.$vs.loading.close()
              this.$vs.notify({
                color: 'danger',
                title: 'Error',
                text: 'حدث خطاء ما',
                position:'top-center'
              })
             })
      })
      }

    },
  
  }
  </script>
  
  <style lang="scss" scoped>
  .home-btn{
    color: #ACACAC;
    border-radius: 30px;
    border: 1px solid #ACACAC;

  }
  
.try-text{
  color: #1b76b3;
}

  .register-btn{
    border-radius:30px ;
  }
  .edit-btn{
    color: red;
  }

  .welcome-text {
    font-size: 44px;
    color: #000000;
}

.resend-btn{
  margin-right: 8rem;
}

  .otp-input {
    width: 40px;
    height: 40px;
    padding: 5px;
    font-size: 20px;
    border-radius: 4px;
    border: 1px solid rgba(0, 0, 0, 0.3);
    text-align: center;
    &.error {
      border: 1px solid red !important;
    }
  }
  .otp-input::-webkit-inner-spin-button,
  .otp-input::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }


  
  </style>
  