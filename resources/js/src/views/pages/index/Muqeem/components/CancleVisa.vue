
<template>

        <vx-card class="rounded-corner shadow-none">
          <div slot="no-body">
            <div class="vx-row no-gutter justify-center items-center">
              <div class="vx-col sm:w-full md:w-full lg:w-2/4">
                <vx-card class="p-4 login-tabs-container rounded-corner shadow-none">
                    <div class="vx-row mb-8">
                        <div class="vx-col w-full lg:w-1/3">
                            <!-- Col Header -->
                            <div class="flex items-end mb-4">
                                <span class="font-semibold">{{$i18n.locale == "en" ? "Iqama Information" : "بيانات الإقامة  "}}</span>
                            </div>
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
                        <div class="vx-col w-full lg:w-1/3">
                            <!-- Col Header -->
                            <div class="flex items-end mb-4">
                                <span class="font-semibold">{{$i18n.locale == "en" ? "Visa Information" : "  بيانات التأشيرة "}}</span>
                            </div>
                            <!-- Col Content -->
                            <div class="bg-input">
                              <vs-input
                              :placeholder="$t('VisaNumber')"
                              v-model="erVisaNumber"
                              v-validate="{
                                          required: true,
                                          regex: /^[0-9]{1,250}$/
                                          }"
                              type="string"
                              name="Visa_number"
                              class="w-full mt-2"/>

                              <span v-if="!errors.has('Visa_number') && erVisaNumber">
                                <icon name="confirm" class="icon left-icon"/>
                              </span>
                              <span v-else-if="errors.has('Visa_number')">
                                <icon name="cross" class="icon left-icon"/>
                              </span>
                            
                            </div>
                            
                        </div>
                    </div>

                  <div class="vx-row flex justify-end justify-items-end mt-10">
                        <vs-button
                            class="mx-4 lg:w-2/4 mt-4 font-bold register-btn small text-xs"
                            color="#0C65D1"
                            @click="save_data">
                            {{$i18n.locale == "en" ? "Continue" : "متابعة"}}
                        </vs-button>

                        <vs-button
                            class="lg:w-2/4 mt-4 font-bold register-btn small text-xs text-black"
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

  </template>
  
  
  
  <script>
  import icon from '../../../../../layouts/components/icon.vue';
  import axios from "@/axios.js";

  export default{
    components: {
      icon,
      },
    data () {
      return {
        iqamaNumber: '',
        erVisaNumber: '',
      }
    },

    methods: {
        save_data() {
        return new Promise((resolve, reject) => {
        axios.post('https://MUQEEM-API-URL/api/v1/exit-reentry/cancel')
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
    .rounded-corner{
      border-radius: 25px;
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
  .register-btn{
    border-radius:30px ;
  }
  .vs-con-input {
  .vs-inputx {
    border-radius: 30px !important;
    color:#000000
  }
}
  </style>
  