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
                <div class="vx-col w-full">
                  <!-- Col Header -->
                  <div class="flex items-end pt-4 pb-2">
                    <span class="leading-none font-semibold text-sm">{{$i18n.locale == "en" ? "Notice recipients" : "مستلمي الإشعار"}}</span>
                  </div>
                  <!-- Col Content -->
                  <div>
                      <div>
                            <v-select class="w-full mt-2  text-sm"
                            :placeholder="$t('recipients')"
                            v-model="notice_data.customer_id"
                            v-validate="'required'"
                            label="name_ar" :options="customers_list"
                            :reduce="name_ar => name_ar.id"
                            :dir="$vs.rtl ? 'rtl' : 'ltr'"
                            />
                      </div>
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
                        v-model="notice_data.title_ar"
                        v-validate="'required'"
                        name="title_ar"/>

                      <div class="mt-4">
                        <vs-textarea 
                        :placeholder="$t('desc')"
                        v-model="notice_data.desc_ar" 
                        class="mt-2" 
                        height="130px"
                        name="desc_ar"/>
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
                  @click="sendNotice">
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
import axios from "@/axios.js"
import vSelect from 'vue-select'
import icon from '@/layouts/components/icon.vue';

// Store Module
// import moduleNoticeManagement from '@/store/notice/moduleNoticeManagement.js'

export default {
  components: {
    icon,
    vSelect,
  },
  data() {
    return {
      notice_data:{customer_id:null,title_ar:null,desc_ar:null},
      customers_list: [
        {name_ar:'المتاجر',id:1},
        {name_ar:'العروض', id:2},
      ],
    }
  },
  computed: {

  },
  methods: {
    sendNotice(){
        axios.post("/api/notices/create",this.notice_data)
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
  created() {
    //  if(!moduleNoticeManagement.isRegistered) {
    //    this.$store.registerModule('noticeManagement', moduleNoticeManagement)
    //    moduleNoticeManagement.isRegistered = true
    //  }
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
      padding: 1rem;
    }
    .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large) {
      padding: .5rem 2rem;
    }
  // .v-select .vs__dropdown-toggle .vs__search {
  //     font-size: .8rem;
  // }
  // .v-select {
  //   .vs__dropdown-toggle {
  //     .vs__selected-options {
  //     padding: 2px 1rem 2px 0;
  //   }
  //   }
  // }
  
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