<template>
  <div id="notification">
    <vx-card class="notification-info">
      <div slot="no-body" class="tabs-container">
        <!-- Content Row -->
        <div class="vx-row">
          <div class="vx-col hidden lg:block lg:w-1/3 pl-8">
            <img src="@assets/images/Notifications.png" alt="Notice" class="mt-20" width="180">
          </div>
          <div class="vx-col sm:w-full md:w-full lg:w-3/5">
            <div class="vx-row">
                <div class="vx-col w-full md:w-1/2">
                  <!-- Col Header -->
                  <div class="flex items-end pt-4 pb-2">
                    <span class="leading-none font-semibold text-sm">{{$i18n.locale == "en" ? "Notice recipients" : "مستلمي الإشعار"}}</span>
                  </div>
                  <!-- Col Content -->
                  <div>
                      <div>
                            <v-select class="w-full mt-2 text-sm"
                            placeholder="حدد المستعملين"
                            v-model="customers"
                            v-validate="'required'"
                            label="text" :options="customers_list"
                            :reduce="text => text.value"
                            :dir="$vs.rtl ? 'rtl' : 'ltr'"
                            />
                      </div>
                    </div>
                </div>
                <div class="vx-col w-full md:w-1/2">
                    <!-- Col Header -->
                    <div class="flex items-end pt-4 pb-2">
                        <span class="leading-none font-semibold text-sm">{{$i18n.locale == "en" ? "Time" : "وقت الإرسال"}}</span>
                    </div>
                     <!-- Col Content -->
                  <div>
                    <flat-pickr
                    class="w-full mt-2 " 
                    v-model="date" 
                    placeholder="14-14-2021" 
                    v-validate="'required'" />
                    <span class="text-danger text-sm"  v-show="errors.has('date')">{{ errors.first('date') }}</span>
                  </div>
                </div>
            </div>

            <div class="vx-row mt-8">
                <div class="vx-col w-full">
                    <!-- Col Header -->
                    <div class="flex items-end">
                        <span class="leading-none font-semibold text-sm pb-2">{{$i18n.locale == "en" ? "Notice details" : "تفاصيل الإشعار"}}</span>
                    </div>
                    <div>
                      <vs-input
                        class="w-full text-base mt-2 "
                        :placeholder="$t('title')"
                        v-model="title"
                        v-validate="'required'"
                        name="title"/>

                      <div class="mt-4">
                        <vs-textarea 
                        :placeholder="$t('desc')"
                        v-model="desc" 
                        class="mt-2 p-2" 
                        height="130px"
                        name="desc"/>
                      </div>
                  </div>
                </div>
            </div>

            <!-- Save & Reset Button -->
            <div class="vx-row flex justify-center mt-10">
              <div class="vx-col sm:w-full md:w-1/2 lg:w-1/2 mb-4">
                <vs-button
                  class="w-full font-semibold text-base rounded-full"
                  color="linear-gradient(to left,#E93F7D,#DA6653)"
                  gradient
                  @click="registerUser">
                    {{$i18n.locale == "en" ? " Send" : "إرسال"}}
                </vs-button>
              </div>
              <div class="vx-col sm:w-full md:w-1/2 lg:w-1/2 mb-4">
                <vs-button
                  class="w-full font-semibold text-base rounded-full "
                  color="#ACACAC" type="border"
                  @click="goBack">
                    {{$i18n.locale == "en" ? "Close" : "خروج"}} 
                </vs-button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </vx-card>
  </div>
</template>

<script>
import vSelect from 'vue-select'
import icon from '@/layouts/components/icon.vue';
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';

// Store Module
import moduleUserManagement from '@/store/user-management/moduleUserManagement.js'

export default {
  components: {
    icon,
    vSelect,
    flatPickr 
  },
  data() {
    return {
     customers_list: [
        {text:'العميل الأول',value:1},
        {text:'العميل الثاني',value:2},
        {text:'العميل الثالث',value:3},
      ],
      customers:null,
      date:null,
      desc:null,
      title:null,
    }
  },
  computed: {
    validateForm() {
      return !this.errors.any() && ((!this.data_local.id && this.data_local.password) || this.data_local.id)
    },
  },
  methods: {
    goBack(){
      this.$router.go(-1)
    },
    save_changes() {
      if(!this.validateForm) return

      // Here will go your API call for updating data
      // You can get data in "this.data_local"
        //const obj = {
           // id: this.data_local.id,
           // name: this.data_local.name,
            //email: this.data_local.email,
           // mobile: this.data_local.mobile,
           // status: this.activeUserInfo.status,
           // rule: this.activeUserInfo.rule
       // }
       // if (this.data_local.password){
           // obj.password = this.data_local.password
      //  }

        this.$store.dispatch("userManagement/updateUser", obj)
        .then(res => {
                        if( res.data.statusCode == 200 ){
                        this.$vs.notify({
                        color: 'success',
                        title: 'Successfull',
                        text: 'User updated successfully'
                        })
                        window.location.reload()
                    }else{
                        this.$vs.notify({
                        color: 'danger',
                        title: 'Error',
                        text: 'Error updating user'
                        })
                    }
                        })
        .catch(err => { console.error(err) })


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

<style lang="scss" scoped>
#notification {
  margin: 2rem 2.5rem;

  .notification-info{
      padding: 2.5rem;
    }
    .flatpickr-input{
      border-radius:30px ;
    }
    .vs-textarea{
      height: 130px;
      border-radius: 20px;
    }
    .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large) {
      padding: .5rem 2rem;
    }
  .v-select .vs__dropdown-toggle .vs__search {
      font-size: .8rem;
  }
  .v-select .vs__dropdown-toggle .vs__selected-options {
    padding: 2px 1rem 2px 0;
  }
  
}

@media only screen and (min-width: 375px) and (max-width: 600px) {
  #notification {
    .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large) {
        padding: .5rem 4rem;
    }
  }
}

@media only screen and (min-width: 360px) and (max-width: 375px) {

}

@media only screen and (min-width: 320px)  and (max-width: 360px) {

}

@media only screen  and (max-width: 320px) {

}
</style>