
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
                        <div class="flex items-end mb-4 ml-2">
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

                        <div class="vx-col w-full lg:w-1/3">
                            <!-- Col Content -->
                            <div class="bg-input">
                              <v-select
                                class="w-full mt-2"
                                :placeholder='$t("IqamaDuration")'
                                v-model="iqamaDuration"
                                v-validate="'required'"
                                label="text" :options="duration"
                                :reduce="text => text.value"
                                :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                              <span
                                v-if="!errors.has('iqama-duration') && iqamaDuration">
                                <icon name="confirm" class="icon left-icon"/>
                              </span>
                              <span v-else-if="errors.has('iqama-duration')">
                                <icon name="cross" class="icon left-icon"/>
                              </span>
                            </div>
                        </div>

                        <div class="vx-col w-full lg:w-1/3">
                            <!-- Col Content -->
                            <div class="bg-input">
                              <v-select
                                class="w-full mt-2"
                                :placeholder='$t("PassportIssueCity")'
                                v-model="passportIssueCity"
                                v-validate="'required'"
                                label="text" :options="passport_issue_city"
                                :reduce="text => text.value"
                                :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                              <span
                                v-if="!errors.has('passport-issue-city') && passportIssueCity">
                                <icon name="confirm" class="icon left-icon"/>
                              </span>
                              <span v-else-if="errors.has('passport-issue-city')">
                                <icon name="cross" class="icon left-icon"/>
                              </span>
                            </div>
                        </div>
                    </div>

                    <div class="vx-row">
                        <!-- Col Header -->
                        <div class="flex items-end mb-4 ml-2">
                            <span class="font-semibold">{{$i18n.locale == "en" ? "Personal Information" : " البيانات الشخصية"}}</span>
                        </div>
                    </div>
                    <div class="vx-row mb-6">
                        <div class="vx-col w-full lg:w-1/3">
                            <!-- Col Content -->
                            <div class="bg-input">
                              <v-select
                                class="w-full mt-2"
                                :placeholder='$t("MaritalStatus")'
                                v-model="maritalStatus"
                                v-validate="'required'"
                                label="text" :options="marital_status"
                                :reduce="text => text.value"
                                :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                              <span
                                v-if="!errors.has('marital-status') && maritalStatus">
                                <icon name="confirm" class="icon left-icon"/>
                              </span>
                              <span v-else-if="errors.has('marital-status')">
                                <icon name="cross" class="icon left-icon"/>
                              </span>
                            </div>
                        </div>

                        <div class="vx-col w-full lg:w-1/3">
                            <!-- Col Content -->
                            <div class="bg-input">
                              <v-select
                                class="w-full mt-2"
                                :placeholder='$t("BirthCountry")'
                                v-model="lkBirthCountry"
                                v-validate="'required'"
                                label="text" :options="birth_country"
                                :reduce="text => text.value"
                                :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                              <span
                                v-if="!errors.has('birth-country') && lkBirthCountry">
                                <icon name="confirm" class="icon left-icon"/>
                              </span>
                              <span v-else-if="errors.has('birth-country')">
                                <icon name="cross" class="icon left-icon"/>
                              </span>
                            </div>
                        </div>

                        <div class="vx-col w-full lg:w-1/3">
                            <!-- Col Content -->
                            <div class="bg-input">
                                    <vs-input
                                        class="w-full text-base mt-2 "
                                        :placeholder="$t('trFirstName')"
                                        v-model="trFirstName"
                                        v-validate="'required'"
                                        name="tr-first-name"/>
                                    <span v-if="!errors.has('tr-first-name') && trFirstName">
                                        <icon name="confirm" class="icon left-icon"/>
                                    </span>
                                    <span v-else-if="errors.has('tr-first-name')">
                                        <icon name="cross" class="icon left-icon"/>
                                    </span>
                            </div>
                        </div>
                    </div>

                    <div class="vx-row">
                        <div class="vx-col w-full lg:w-1/3">
                            <!-- Col Content -->
                            <div class="bg-input">
                                    <vs-input
                                        class="w-full text-base mt-2 "
                                        :placeholder="$t('trFatherName')"
                                        v-model="trFatherName"
                                        name="tr-father-name"/>
                                    <span v-if="!errors.has('tr-father-name') && trFatherName">
                                        <icon name="confirm" class="icon left-icon"/>
                                    </span>
                                    <span v-else-if="errors.has('tr-father-name')">
                                        <icon name="cross" class="icon left-icon"/>
                                    </span>
                            </div>
                        </div>

                        <div class="vx-col w-full lg:w-1/3">
                            <!-- Col Content -->
                            <div class="bg-input">
                                    <vs-input
                                        class="w-full text-base mt-2 "
                                        :placeholder="$t('trGrandFatherName')"
                                        v-model="trGrandFatherName"
                                        name="tr-grandfather-name"/>
                                    <span v-if="!errors.has('tr-grandfather-name') && trGrandFatherName">
                                        <icon name="confirm" class="icon left-icon"/>
                                    </span>
                                    <span v-else-if="errors.has('tr-grandfather-name')">
                                        <icon name="cross" class="icon left-icon"/>
                                    </span>
                            </div>
                        </div>

                        <div class="vx-col w-full lg:w-1/3">
                            <!-- Col Content -->
                            <div class="bg-input">
                                    <vs-input
                                        class="w-full text-base mt-2 "
                                        :placeholder="$t('trFamilyName')"
                                        v-model="trFamilyName"
                                        name="tr-family-name"/>
                                    <span v-if="!errors.has('tr-family-name') && trFamilyName">
                                        <icon name="confirm" class="icon left-icon"/>
                                    </span>
                                    <span v-else-if="errors.has('tr-family-name')">
                                        <icon name="cross" class="icon left-icon"/>
                                    </span>
                            </div>
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
  import vSelect from 'vue-select';
  import axios from "@/axios.js";

  export default{
    components: {
      icon,
      I18n,
      vSelect,
      },

    data () {
      return {
        iqamaNumber: '',
        iqamaDuration: null,
        lkBirthCountry: null,
        maritalStatus: null,
        passportIssueCity:null,
        trFirstName: '',
        trFatherName: '',
        trGrandFatherName: '',
        trFamilyName: '',
        duration:[
            {text:'3' ,value:1},
            {text:'6' ,value:2},
            {text:'9' ,value:3},
            {text:'12' ,value:4},
            {text:'15' ,value:5},
            {text:'18' ,value:6},
            {text:'21' ,value:7},
            {text:'24' ,value:8},
            ],
        birth_country: [],
        marital_status: [],
        passport_issue_city: [],
      }
    },

    methods: {
      save_data() {
        return new Promise((resolve, reject) => {
        axios.post('https://MUQEEM-API-URL/api/v1/iqama/issue')
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
        .icon{
        position: absolute;
        top:10px;
        left: 10px;
        z-index:1;
        padding-right: 20px;
        }
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

.v-select .vs__dropdown-toggle .vs__selected-options {
    padding: 2px 0rem 2px 0 !important;
}
.vs__dropdown-menu  {
    .vs__dropdown-option--highlight {
      background:  #2a9eeb !important;
    }
  }

  .flatpickr-input{
      border-radius:30px !important;
    }
  </style>
  