<!-- =========================================================================================
    File Name: Login.vue
    Description: Login Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div class="flex w-full vx-row no-gutter items-center justify-center" id="page-login">
      <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-2/4 xl:w-11/12 sm:m-0 m-5">
        <!-- <div class="vx-row m-4">
            <i18n class="text-bold"/>
        </div> -->
        <vx-card class="muqeem-login rounded-corner shadow-none my-4">
          <div slot="no-body">
            <div class="vx-row no-gutter justify-center items-center md:p-10 lg:py-10">
              <div class="vx-col hidden xl:block xl:w-1/2 justify-center items-center">
                <img src="@assets/images/basmatk/muqeem/Mugeem-Login-logo.png" alt="Muqeem" class="mx-auto">
              </div>
              <div class="vx-col sm:w-full md:w-full xl:w-1/3">
                
                <vx-card class="p-4 login-tabs-container rounded-corner shadow-none">
                  <div class=" mb-4">     
                    <img src="@assets/images/basmatk/muqeem/muqeem-login.png" alt="Muqeem" width="35%" class="m-auto">
                  </div>
                  
                  <div class="vx-card__title mb-4">       
                    <h4 class="mb-2 mt-6 text-sm text-black">{{$t('MuqeemLogin')}}</h4>
                    <h4 class="muqeem-text font-bold mb-4">{{$t('ToMuqeem') }}</h4>      
                  </div>

                  <div class="bg-input">
                    <icon name="user-name" class="icon"/>
                    <vs-input
                        class="w-full text-base mt-2 "
                        :placeholder="$t('UserName')"
                        v-model="username"
                        v-validate="{
                                    required: true,
                                    min: 1,
                                    max:50,
                                    regex: /^[\u0621-\u064Aa-zA-Z\d\-_\s]+$/
                                    }"
                        name="username"
                        icon-no-border
                        icon="icon"/>
                    <span v-if="!errors.has('username') && username">
                        <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('username')">
                        <icon name="cross" class="icon left-icon"/>
                    </span>
                  </div>
  
                  <div class="bg-input">
                    <icon name="password" class="icon"/>
                    <vs-input
                        data-vv-validate-on="blur"
                        v-validate="'required|min:6|max:10'"
                        type="password"
                        name="password"
                        icon-no-border
                        icon="icon"
                        :placeholder="$t('password') "
                        v-model="password"
                        class="w-full mt-2" />
                    <span v-if="!errors.has('password') && password">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('password')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                  </div>
  
                  <div>
                        <vs-button
                            class="lg:w-2/4 mt-4 font-bold register-btn small text-xs"
                            color="#0C65D1"
                            @click="login">
                            {{$i18n.locale == "en" ? "Login  >>" : "تسجيل دخول  >>"}}
                        </vs-button>
                 </div>
                </vx-card>
            
            </div>
            </div>
          </div>
        </vx-card>
      </div>
    </div>
  </template>
  
  
  
  <script>
  import icon from '../../../../layouts/components/icon.vue';
  import I18n  from "@/layouts/components/navbar/components/I18n.vue"
  import axios from "@/axios.js";

  export default{
    components: {
      icon,
      I18n
      },
    data () {
      return {
        username: '',
        password: '',
      }
    },

    methods: {
      login() {
        return new Promise((resolve, reject) => {
        axios.post('https://MUQEEM-API-URL/api/authenticate')
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
    }
  
  }
  </script>
  
  <style lang="scss" scoped>
    #page-login{
        background-color: #E9ECF0;
    }
    .muqeem-login{
        background-color: #F8F8F8;
    }
    .rounded-corner{
      border-radius: 25px;
    }

    .muqeem-text{
        color: #0C65D1;
    }
    .bg-input{
        position: relative;
        .icon{
        position: absolute;
        top:10px;
        left: 10px;
        z-index:1;
        padding-right: 20px;
        }
        .employee-icon{
        top:-3px
        }
        .left-icon{
        position: absolute;
        top:12px;
        left: 85%;
        z-index: 9999;
        }

  }
  .register-btn{
    border-radius:30px ;
  }
  .vs-con-input {
  .vs-inputx {
    border-radius: 10px !important;
    color:#000000
  }


}

.vs-con-input .vs-inputx:hover,
.vs-con-input .vs-inputx:focus {
    border-color: #2a9eeb !important;
}

  </style>
  