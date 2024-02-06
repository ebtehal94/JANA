
<template>
    <div id="personal-info" class="my-4">
      <div class="container">
        <div class="vx-row flex flex-wrap new-request">
          <div class="vx-col md:w-8/12 w-full column-border">
            <div class="vx-row w-full md:w-9/12">
              <h3 class="font-bold title pl-4 pb-4">{{$t('AccountAndSetting')}}</h3>
                
              <div>
                <h5 class="font-medium pl-4">{{$t('PersonalInfo')}}</h5>
              </div>
              <div class="bg-input">
                <icon name="account-name" class="icon"/>
                <vs-input
                  class="w-full text-base mt-2 "
                  :placeholder="$t('FullName')"
                  v-model="account_data.name"
                  v-validate="'required'"
                  icon-no-border
                  icon="icon"
                  name="name"/>

                <span v-if="!errors.has('name')&& account_data.name">
                  <icon name="confirm" class="icon left-icon"/>
                </span>
                <span v-else-if="errors.has('name')">
                  <icon name="cross" class="icon left-icon"/>
                </span>
              </div>

              <div class="bg-input">
                <icon name="email" class="icon"/>
                <vs-input
                  v-validate="'required|email|min:3'"
                  data-vv-validate-on="blur"
                  icon-no-border
                  icon="icon"
                  v-model="account_data.email"
                  :placeholder="$t('Email')"
                  class="w-full mt-2"
                  name="email"/>

                <span v-if="!errors.has('email') && account_data.email">
                  <icon name="confirm" class="icon left-icon"/>
                </span>
                <span v-else-if="errors.has('email')">
                  <icon name="cross" class="icon left-icon"/>
                </span>
              </div>
              <div class="vx-row flex bg-input">
                <icon name="mobile" class="icon phone-icon"/>
                <vs-input
                  :placeholder="$t('Moblie')"
                  type="number"
                  icon-no-border
                  icon="icon"
                  v-model="account_data.mobile"
                  v-validate="'required|min:7|max:10'"
                  class="w-4/5 mt-2"
                  name="mobile"/>

                  <vs-input
                  type="text"
                  v-model="account_data.cc"
                  disabled
                  dir="ltr"
                  icon-no-border
                  v-validate="'required'"
                  class="w-1/5 ml-4 mt-2"
                  placeholder="966+"/>

                  <span v-if="!errors.has('mobile') && account_data.mobile">
                    <icon name="confirm" class="icon left-phone-icon"/>
                  </span>
                  <span v-else-if="errors.has('mobile')">
                    <icon name="cross" class="icon left-phone-icon"/>
                  </span>
                </div>

                <div class="bg-input">
                  <icon name="nationality" class="icon"/>
                  <vs-input
                    class="w-full text-base mt-2 "
                    :placeholder="$t('Nationality')"
                    v-model="account_data.nationality"
                    v-validate="'required'"
                    icon-no-border
                    icon="icon"
                    name="nationality"/>

                  <span v-if="!errors.has('nationality') && account_data.nationality">
                    <icon name="confirm" class="icon left-icon"/>
                  </span>
                  <span v-else-if="errors.has('nationality')">
                    <icon name="cross" class="icon left-icon"/>
                  </span>
                </div>

                <div class="bg-input">
                  <icon name="birthdate" class="icon birth-icon"/>
                    <flat-pickr
                    class="w-full mt-2 birth-date"
                    v-model="account_data.birthdate"
                    :placeholder="$t('BirthDate')"/>
                  </div>

                  <div class="bg-input">
                    <icon name="id-number" class="icon"/>
                    <vs-input
                      :placeholder='$t("IDNumber")'
                      type="number"
                      icon-no-border
                      icon="icon"
                      v-model="account_data.IDNo"
                      v-validate="'required|min:6'"
                      class="w-full mt-2"
                      name="IDNo"/>

                    <span v-if="!errors.has('IDNo') && account_data.IDNo">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('IDNo')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                  </div>

                <div class="bg-input">
                  <icon name="job-title" class="icon"/>
                  <vs-input
                  class="w-full  mt-2 text-base"
                  :placeholder="$t('JobTitle')"
                  v-model="account_data.job_title"
                  v-validate="'required'"
                  icon-no-border
                  icon="icon"
                  name="job_title"/>
                  
                <span v-if="!errors.has('job_title') && account_data.job_title">
                  <icon name="confirm" class="icon left-icon"/>
                </span>
                <span v-else-if="errors.has('job_title')">
                  <icon name="cross" class="icon left-icon"/>
                </span>
              </div>

              <div class="vx-row flex  mt-8">
                  <vs-button
                    size="small"
                    class="mr-2 w-full mb-4 font-semibold text-sm rounded-full px-24"
                    color="#0E77FF"
                    @click="createAccount">
                      {{$i18n.locale == "en" ? "Save Changes" : "حفظ التعديلات"}}
                  </vs-button>
                  <vs-button
                    size="small"
                    class="ml-2 w-full mb-4 font-semibold text-sm rounded-full"
                    color="#ACACAC" type="border"
                    @click="goBack">
                      {{ $i18n.locale == 'en' ? 'Back' : 'رجوع' }}
                  </vs-button>
                  
              </div>
            </div>
          </div>
          <div class="vx-col md:w-4/12 md:pl-4">
            <Statistics/>
          </div>
        </div>
      </div>
    </div>
</template>



<script>
import axios from "@/axios.js"
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import Statistics from "./components/statistics.vue"
import icon from '@/layouts/components/icon.vue';
export default{
  components: {
      flatPickr,
      Statistics,
      icon
    },
    props:{

    },
  data () {
    return {
      account_data:{name:null, email: null,cc: '+966',mobile: null,nationality:null,birthdate:null,IDNo:null,job_title:null},
    }

  },
  computed: {
  
  },
  
  methods: {
    createAccount(){
        axios.post("/api/account/create",this.account_data)
        .then(res => {
          if( res.data.statusCode == 200 ){
            this.$vs.notify({
            color: 'success',
            title: 'Successfull',
            text: 'تم بنجاح'
            })
          }else{
            this.$vs.notify({
            color: 'danger',
            title: 'Error',
            text: 'حدث خطأ ما'
            })
          }
        })
        .catch(function (error) {
            console.log(error.response);
        });
    },
    goBack(){
      this.$router.go(-1)
    },
  },
  created(){

  }

}
</script>
<style lang="scss">
#personal-info{
    font-family: "Cairo", sans-serif !important;
    color:#696969;
}
.column-border{
  border-right: 1px solid #eee;
}
.title{
   color:#31323B; 
   font-size: .9rem;
}
  .bg-input{
    position: relative;
    .icon{
      position: absolute;
      top:9px;
      left: 10px;
      z-index:1;
      padding-right: 20px;
    }
    .phone-icon{
      top:15px;
      left: 9px;
    }
   .birth-icon{
     top:17px;
   }
    .left-icon{
      position: absolute;
      top:10px;
      left: 92%;
      z-index: 9999;
    }
    .left-phone-icon{
      position: absolute;
      top:19px;
      left: 70%;
      z-index: 999;
    }
  }
  .birth-date{
    border:1px solid #DBE2ED !important;
    padding:  0.5rem 0 0.5rem 2.5rem !important;
    font-size:.8rem;
  }
.vs-button.small {
    font-family: "Cairo", sans-serif !important;
    padding: 3px;
    font-weight: 400;
}
.vs-input--input.normal {
    border:1px solid #DBE2ED !important;
    padding: .4rem 1rem .4rem 2.5rem!important;
    border-radius: 25px !important;
    height: 40px;
}
.vs-input--placeholder {
    left: 10px !important;
}
</style>

