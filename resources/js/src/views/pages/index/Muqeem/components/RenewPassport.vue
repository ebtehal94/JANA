
<template>
    <div class="flex w-full vx-row no-gutter items-center justify-center" id="page-login">
      <div class="vx-col sm:w-11/12 md:w-1/2 lg:w-2/4 xl:w-11/12 sm:m-0 m-5">
        <!-- <div class="vx-row m-4">
            <i18n class="text-bold"/>
        </div> -->
        <vx-card class="muqeem-login rounded-corner shadow-none my-4">
          <div slot="no-body">
            <div class="vx-row no-gutter justify-center items-center p-10">
              <div class="vx-col sm:w-full md:w-full lg:w-2/4">
                <vx-card class="p-4 login-tabs-container rounded-corner shadow-none">
                    <div class="vx-row">
                        <!-- Col Header -->
                        <div class="flex items-end mb-2 ml-4">
                          <span class="font-semibold">{{$i18n.locale == "en" ? "Iqama Information" : "بيانات الإقامة  "}}</span>
                        </div>
                    </div>
                    <div class="vx-row mb-6">
                        <div class="vx-col w-full lg:w-1/3">

                            <!-- Col Content -->
                            <div class="bg-input">
                                <vs-input
                                    class="w-full text-base mt-2 "
                                    :placeholder="$t('iqamaNum')"
                                    v-model="iqamaNumber"
                                    v-validate="{
                                                required: true,
                                                regex: /^2[0-9]{9}$/
                                                }"
                                    name="iqama_number"/>
                                <span v-if="!errors.has('iqama_number') && iqamaNumber">
                                    <icon name="confirm" class="icon left-icon"/>
                                </span>
                                <span v-else-if="errors.has('iqama_number')">
                                    <icon name="cross" class="icon left-icon"/>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="vx-row">
                        <!-- Col Header -->
                        <div class="flex items-end mb-2 ml-4">
                            <span class="font-semibold">{{$i18n.locale == "en" ? "Passport Information" : "بيانات جواز السفر"}}</span>
                        </div>
                    </div>

                    <div class="vx-row mb-6">
                        <div class="vx-col w-full lg:w-1/3">
                            <!-- Col Content -->
                            <div class="bg-input">
                                <vs-input
                                    class="w-full text-base mt-2 "
                                    :placeholder="$t('passportNum')"
                                    v-model="passportNumber"
                                    v-validate="{
                                                required: true,
                                                regex: /^[A-Za-z0-9]{1,15}$/
                                                }"
                                    name="passport_number"/>
                                <span v-if="!errors.has('passport_number') && passportNumber">
                                    <icon name="confirm" class="icon left-icon"/>
                                </span>
                                <span v-else-if="errors.has('passport_number')">
                                    <icon name="cross" class="icon left-icon"/>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="vx-row">
                        <!-- Col Header -->
                        <div class="flex items-end mb-2 ml-4">
                            <span class="font-semibold">{{$i18n.locale == "en" ? "New Passport Information" : "  بيانات جواز السفر الجديد"}}</span>
                        </div>
                    </div>

                    <div class="vx-row">
                        <div class="vx-col w-full lg:w-1/3">
                            <!-- Col Content -->
                            <div class="bg-input">
                                <vs-input
                                    class="w-full text-base mt-2 "
                                    :placeholder="$t('NewpassportNum')"
                                    v-model="newPassportNumber"
                                    v-validate="{
                                                required: true,
                                                regex: /^[A-Za-z0-9]{1,15}$/
                                                }"
                                    name="new_passport_number"/>
                                <span v-if="!errors.has('new_passport_number') && newPassportNumber">
                                    <icon name="confirm" class="icon left-icon"/>
                                </span>
                                <span v-else-if="errors.has('new_passport_number')">
                                    <icon name="cross" class="icon left-icon"/>
                                </span>
                            </div>
                        </div>

                        <div class="vx-col w-full lg:w-1/3">
                            <!-- Col Content -->
                            <div class="bg-input">
                              <v-select
                                class="w-full mt-2"
                                :placeholder='$t("PassportLocation")'
                                v-model="newPassportIssueLocation"
                                v-validate="'required'"
                                label="text" :options="PassportLocation"
                                :reduce="text => text.value"
                                :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                            </div>
                        </div>
                    </div>

                    <div class="vx-row">
                        <div class="vx-col w-full lg:w-1/3">
                            <!-- Col Content -->
                            <flat-pickr
                            class="w-full mt-4"
                            v-model="newPassportIssueDate"
                            :placeholder="$t('NewPassportIssueDate')"
                            v-validate="'required'"
                            name="newPassportIssueDate"/>
                        </div>

                        <div class="vx-col w-full lg:w-1/3">
                            <!-- Col Content -->
                            <flat-pickr
                            class="w-full mt-4"
                            v-model="newPassportExpiryDate"
                            :placeholder="$t('NewExpairyDate')"
                            :config="configFromdateTimePicker"
                            v-validate="'required'"
                            name="NewExpairyDate"/>
                        </div>
                    </div>

                  <div class="vx-row flex justify-end justify-items-end mt-10">
                        <vs-button
                            class="mx-4 lg:w-2/4 mt-4 font-bold small text-xs rounded-full"
                            color="#0C65D1"
                            @click="save_data">
                            {{$i18n.locale == "en" ? "Continue" : "متابعة"}}
                        </vs-button>

                        <vs-button
                            class="lg:w-2/4 mt-4 font-bold small text-xs text-black rounded-full"
                            color="#E9ECF0"
                            @click="goBack">
                            {{$i18n.locale == "en" ? "Cancle" : "الغاء"}}
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
  import icon from '../../../../../layouts/components/icon.vue';
  import I18n  from "@/layouts/components/navbar/components/I18n.vue"
  import flatPickr from 'vue-flatpickr-component'
  import 'flatpickr/dist/flatpickr.css'
  import vSelect from 'vue-select';
  import axios from "@/axios.js";

  export default{
    components: {
      icon,
      I18n,
      flatPickr,
      vSelect,
      },
    data () {
      return {
        iqamaNumber: '',
        passportNumber: '',
        newPassportNumber: '',
        newPassportIssueLocation: null,
        PassportLocation:[],
        newPassportIssueDate: '',
        newPassportExpiryDate: '',
        configFromdateTimePicker: {
            minDate: new Date(),
            maxDate: null
        },
      }
    },

    methods: {
      save_data() {
        return new Promise((resolve, reject) => {
        axios.post('https://MUQEEM-API-URL/api/v1/update-information/renew')
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

      goBack () {
      this.$router.go(-1)
    }
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

        .left-icon{
        position: absolute;
        top:12px;
        left: 85%;
        z-index: 9999;
        }

  }

  .vs-con-input {
  .vs-inputx {
    border-radius: 30px !important;
    color:#000000
  }
}
  .flatpickr-input{
      border-radius:30px !important;
    }
  </style>
  