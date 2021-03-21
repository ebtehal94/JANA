<template>
  <div
    class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center"
    id="page-login">
    <!-- Store -->
    <div class="vx-col sm:w-full md:w-full lg:w-3/4 xl:w-4/5 sm:m-0 m-4">
      <div class="vx-row m-4">
        <i18n class="font-bold"/>
      </div>
      <vx-card class="rounded-corner shadow-none">
        <div slot="no-body">
          <div class="vx-row no-gutter justify-center items-center py-8">
            <div class="vx-col hidden lg:block w-full lg:block lg:w-2/5 pl-1.5 bg-logo">
              <img src="@assets/images/logo/logo-3.png" alt="jana" class="mx-auto" width="130">

              <div class="w-full bg-footer text-center" v-if="page_num < 4">
                <span @click="goToPage(1)" class="steps-btn inline-block font-semibold" :class="{ active : page_num == 1}">1</span>
                <span @click="goToPage(2)" class="steps-btn inline-block font-semibold" :class="{ active : page_num == 2}">2</span>
                <span @click="goToPage(3)" class="steps-btn inline-block font-semibold" :class="{ active : page_num == 3}">3</span>

                <!-- <span class="account pl-0.5 font-light text-sm">
                  {{$i18n.locale == "en" ? "You have an account" : "لديك حساب"}}
                </span>
                  <vs-button
                  class="login-btn p-0 text-sm"
                  size="small"
                  type="transparent"
                  to="/login">
                  {{ $t('loginLabel')}}
                </vs-button> -->
              </div>
            </div>

            <div class="vx-col sm:w-full md:w-full lg:w-1/2" v-if="page_num === 1">
              <div class="p-8 login-tabs-container">
                <div class="vx-card__title">
                  <div class="separator">
                    <h4 class="mb-4 text-lg font-extrabold">{{$t('storeData')}}</h4>
                  </div>
                </div>

                <div>
                  <div class="bg-input">
                    <icon name="name" class="icon"/>
                    <vs-input
                      size="large"
                      class="w-full text-base"
                      :placeholder="$t('storeNameAr')"
                      v-model="store_data.name_ar"
                      v-validate="'required'"
                      icon-no-border
                      icon="icon"
                      name="name_ar"/>

                    <span v-if="!errors.has('name_ar') && store_data.name_ar">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('name_ar')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                  </div>

                  <div class="bg-input">
                    <icon name="name" class="icon"/>
                    <vs-input
                      size="large"
                      class="w-full text-base mt-2 "
                      :placeholder="$t('storeNameEn')"
                      v-model="store_data.name_en"
                      v-validate="'required'"
                      icon-no-border
                      icon="icon"
                      name="name_en"/>

                    <span v-if="!errors.has('name_en') && store_data.name_en">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('name_en')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                  </div>

                  <div class="bg-input">
                    <icon name="com-number" class="icon"/>
                    <vs-input
                      size="large"
                      :placeholder='$t("CommercialRegisterNo")'
                      v-model="store_data.cr_number"
                      type="number"
                      icon-no-border
                      icon="icon"
                      v-validate="'required|min:6'"
                      class="w-full mt-2"/>

                    <span
                      v-if="!errors.has('cr_number') && store_data.cr_number && store_data.cr_number.length >= 6">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('cr_number')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>

                  </div>
                  <div class="bg-input">
                    <icon name="city" class="icon"/>
                    <v-select class="w-full mt-2"
                      :placeholder='$t("mainLocation")'
                      v-model="store_data.city_id"
                      v-validate="'required'"
                      label="name_ar" :options="cities_list"
                      :reduce="name_ar => name_ar.id"
                      :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                    <span
                      v-if="!errors.has('city_id') && store_data.city_id">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('city_id')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                 </div>

                  <div class=" mb-3">
                    <vs-button
                      class="w-full mt-10 font-medium register-btn text-lg"
                      color="linear-gradient(to left,#E93F7D,#DA6653)"
                      gradient
                      @click="changeNumber(2)">
                      {{$i18n.locale == "en" ? "Next" : " التالي"}}
                    </vs-button>
                  </div>
                </div>
              </div>
            </div>


            <div class="vx-col sm:w-full md:w-full lg:w-1/2" v-if="page_num === 2">
              <div class="p-8 login-tabs-container">
                <div class="vx-card__title">
                  <div class="separator">
                    <h4 class="mb-4 text-lg font-extrabold">{{$t('branchData')}}</h4>
                  </div>
                </div>

                <div v-for="branch,branchIndex in branches_data"  :key="branch.name">
                  <div class="mt-8" v-if="branchIndex > 0">
                    <div class="separator">
                      <h4 class="mb-4 text-lg font-extrabold">{{$t('additionalBranch')}}</h4>
                      <span class="ml-4" @click="openBranchDeleteConfirm(branchIndex)">
                        <icon name="cross" class="icon left-icon"/>
                      </span>
                    </div>
                  </div>
                  <div class="bg-input">
                    <icon name="store-type" class="icon"/>
                    <v-select class="w-full mt-2"
                    v-model="branch.type"
                    :placeholder="$t('storeActivity')"
                    label="text" :options="stores"
                    :reduce="text => text.value"
                    :dir="$vs.rtl ? 'rtl' : 'ltr'"/>

                    <span v-if="!errors.has('type') && branch.type">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('type')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                  </div>

                  <div class="bg-input">
                    <icon name="city" class="icon"/>
                    <v-select class="w-full mt-2"
                     v-model="branch.city_id"
                     :placeholder="$t('Location')"
                     label="name_ar" :options="cities_list"
                     :reduce="name_ar => name_ar.id"
                     :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                    <span v-if="!errors.has('city_id') && branch.city_id">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('city_id')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                  </div>

                  <div class="bg-input">
                    <icon name="name" class="icon"/>
                    <vs-input
                    size="large"
                    class="w-full text-base mt-2 "
                    :placeholder="$t('branchName')"
                    v-model="branch.title"
                    v-validate="'required'"
                    icon-no-border
                    icon="icon"
                    :name="branchIndex+'title'"/>

                    <span v-if="!errors.has(branchIndex+'title') && branch.title">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has(branchIndex+'title')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                  </div>

                  <!-- <div class="bg-input">
                    <icon name="location" class="icon"/>
                      <vs-input
                        size="large"
                        class="w-full text-base mt-2 "
                        placeholder="اسم الفرع"
                        v-model="branch.title"
                        v-validate="'required'"
                        icon-no-border
                        icon="icon"
                        name="somename"/>

                      <span v-if="!errors.has('title') && branch.title">
                        <icon name="confirm" class="icon left-icon"/>
                      </span>
                      <span v-else-if="errors.has('title')">
                        <icon name="cross" class="icon left-icon"/>
                      </span>
                  </div> -->

                  <div class="bg-input">
                    <icon name="location" class="icon"/>
                      <vs-input
                        size="large"
                        class="w-full text-base mt-2 "
                        :placeholder="$t('geographicalLocation')"
                        v-model="branch.location"
                        v-validate="'required'"
                        icon-no-border
                        icon="icon"
                        :name="branchIndex+'location'"/>

                      <span v-if="!errors.has(branchIndex+'location') && branch.location">
                        <icon name="confirm" class="icon left-icon"/>
                      </span>
                      <span v-else-if="errors.has(branchIndex+'location')">
                        <icon name="cross" class="icon left-icon"/>
                      </span>
                  </div>

                  <div class="bg-input">
                    <icon name="URL" class="icon"/>
                      <vs-input
                        size="large"
                        class="w-full text-base mt-2 "
                        :placeholder="$t('website')"
                        v-model="branch.url"
                        v-validate="'url:require_protocol'"
                        icon-no-border
                        icon="icon"
                        :name="branchIndex+'url'"/>

                      <span v-if="!errors.has(branchIndex+'url') && branch.url">
                        <icon name="confirm" class="icon left-icon"/>
                      </span>
                      <span v-else-if="errors.has(branchIndex+'url')">
                        <icon name="cross" class="icon left-icon"/>
                      </span>
                  </div>

                </div>
                <div class="bg-input">
                    <vs-button
                    class="w-full mt-10 font-medium register-btn"
                    color="#f0f0f0"
                    gradient
                    @click="addBranch">
                    <span class="text-dark font-bold">
                      {{$i18n.locale == "en" ? "Add Branch (Optional)" : " إضافة فرع (إختياري)"}}
                    </span>
                  </vs-button>
                </div>

                <div class=" mb-3">
                  <vs-button
                  class="w-full mt-10 font-medium register-btn"
                  color="linear-gradient(to left,#E93F7D,#DA6653)"
                  gradient
                  @click="changeNumber(3)">
                   {{$i18n.locale == "en" ? "Next" : " التالي"}}
                  </vs-button>
                </div>
              </div>
            </div>


            <div class="vx-col sm:w-full md:w-full lg:w-1/2" v-if="page_num === 3">
              <div class="p-8 login-tabs-container">
                <div class="vx-card__title">
                  <div class="separator">
                    <h4 class="mb-4 text-lg font-extrabold">{{$t('conactAndSafety')}}</h4>
                  </div>
                </div>

              <div>
                <div class="vx-row bg-input">
                  <icon name="mobile" class="icon phone-icon"/>
                  <vs-input
                    size="large"
                    :placeholder="$t('mobile')"
                    v-model="user.mobile"
                    type="number"
                    icon-no-border
                    icon="icon"
                    v-validate="'required|min:7'"
                    class="w-3/4 mt-2 px-3"/>

                  <vs-input
                  size="large"
                  v-model="user.cc"
                  type="text"
                  disabled
                  dir="ltr"
                  icon-no-border
                  v-validate="'required'"
                  class="w-1/5 mt-2"
                  placeholder="966+"/>

                  <span v-if="!errors.has('mobile') && user.mobile">
                    <icon name="confirm" class="icon left-phone-icon"/>
                  </span>
                  <span v-else-if="errors.has('mobile')">
                    <icon name="cross" class="icon left-phone-icon"/>
                  </span>
                </div>

                <div class="vx-row bg-input">
                  <icon name="phone" class="icon phone-icon"/>
                  <vs-input
                    size="large"
                    :placeholder="$t('phone')"
                    v-model="user.phone"
                    type="number"
                    icon-no-border
                    icon="icon"
                    v-validate="'required|min:7'"
                    class="w-3/4 mt-2 px-3"/>

                  <vs-input
                    size="large"
                    v-model="user.cc"
                    type="text"
                    disabled
                    dir="ltr"
                    icon-no-border
                    v-validate="'required'"
                    class="w-1/5 mt-2"
                    placeholder="966+"/>

                  <span v-if="!errors.has('phone') && user.phone">
                    <icon name="confirm" class="icon left-phone-icon"/>
                  </span>
                  <span v-else-if="errors.has('phone')">
                    <icon name="cross" class="icon left-phone-icon"/>
                  </span>
                </div>

                <div class="bg-input">
                  <icon name="email" class="icon"/>
                  <vs-input
                    size="large"
                    v-validate="'required|email|min:3'"
                    data-vv-validate-on="blur"
                    icon-no-border
                    icon="icon"
                    :placeholder="$t('email')"
                    v-model="user.email"
                    class="w-full mt-2"/>

                   <span v-if="!errors.has('email') && user.email">
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
                    :placeholder="$t('password') "
                    v-validate="'required|min:6'"
                    type="password"
                    ref="password"
                    name="password"
                    icon-no-border
                    icon="icon"
                    v-model="user.password"
                    class="w-full mt-2"/>

                  <span v-if="!errors.has('password') && user.password">
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
                    :placeholder="$t('confirmPassword')"
                    v-validate="'min:6|confirmed:password'"
                    type="password"
                    name="confirm_password"
                    data-vv-as="password"
                    icon-no-border
                    icon="icon"
                    v-model="user.confirm_password"
                    class="w-full mt-2"/>

                  <span v-if="!errors.has('confirm_password') && user.confirm_password">
                    <icon name="confirm" class="icon left-icon"/>
                  </span>
                  <span v-else-if="errors.has('confirm_password')">
                    <icon name="cross" class="icon left-icon"/>
                  </span>
                </div>

                  <div class=" mb-3">
                    <vs-button
                      class="w-full mt-10 font-medium register-btn"
                      color="linear-gradient(to left,#E93F7D,#DA6653)"
                      gradient
                      @click="registerUser">
                       {{$i18n.locale == "en" ? "Create Account" : "إنشاء الحساب"}}
                      </vs-button>
                  </div>
              </div>
            </div>
          </div>

          <div class="vx-col sm:w-full md:w-full lg:w-1/2 text-center" v-if="page_num === 4">
            <h2 class="text-grey">{{$i18n.locale == "en" ? "Successfull" : "تم التسجيل بنجاح"}}</h2>
            <h2 class="text-grey mt-10">{{$i18n.locale == "en" ? "We will contact you as soon as possible" : "سيتم التواصل معكم في اقرب وقت ممكن"}}</h2>
          </div>
          </div>
        </div>
      </vx-card>
    </div>
  </div>
</template>

<script>
import moduleUserManagement from "@/store/user-management/moduleUserManagement.js";
import icon from '../../layouts/components/icon.vue';
import vSelect from 'vue-select';
import I18n  from "@/layouts/components/navbar/components/I18n.vue"
import { CitiesList } from './extra/CitiesList.js'



export default {
  components: {
     icon ,
     vSelect,
     I18n
     },
  data() {
    return {
        cities_list: CitiesList,
        // cities_list: [
        //   {text:'الدمام',value:1},
        //   {text:'الخبر',value:2},
        //   {text:'الجبيل',value:3},
        //   {text:'الاحساء',value:4},
        //   {text:'بقيق',value:5},
        //   {text:'ينبع',value:6},
        //   {text:'املج',value:7},
        //   {text:'محافظة بدر',value:8},
        //   {text:'الباحة',value:9},
        //   {text:'الرياض',value:10},
        //   {text:'جدة',value:11},
        //   {text:'مكة',value:12},
        //   {text:'المدينة',value:13},
        //   {text:'خميس مشيط',value:14},
        //   {text:'جازان',value:15},
        //   {text:'القصيم (عنيزة-بريدة)',value:16},
        //   {text:'حائل',value:17},
        //   {text:'عرعر',value:18},
        //   {text:'الجوف',value:19},
        // ],
        stores: [
          {text:' المراكز الصحية والعيادات ' ,value:1},
          {text:' المطاعم والمقاهي' ,value:2},
          {text:' الملابس والاحذية والحقائب' ,value:3},
          {text:' المنتجات الغذائية ' ,value:4},
          {text:' المكتبات' ,value:5},
          {text:' الاجهزة التقنية ' ,value:6},
          {text:' الاواني والمستلزمات المطبخ ' ,value:7},
          {text:' مراكز التجميل' ,value:8},
          {text:' الفنادق والشاليهات والمنتجعات' ,value:9},
          {text:' تذاكر طيران ' ,value:10},
          {text:' خدمات السيارات' ,value:11},
          {text:' مراكز ومعاهد التدريب والتعليم ' ,value:12},
          {text:' النوادي الرياضية' ,value:13},
          {text:' محلات النظارات والساعات ' ,value:14},
          {text:' الصيدليات ' ,value:15},
          {text:'المراكز الرياضية ' ,value:16},
          {text:' مواقع الاونلاين' ,value:17},
          {text:' الاثاث ' ,value:18},
          {text:' الهدايا والورد' ,value:19},
          {text:'الدعاية والاعلان والمطبوعات ' ,value:20},
          {text:'مستلزمات تنظيم الحفلات والمناسبات' ,value:21},
          {text:'استديوهات التصوير' ,value:22},
          {text:' شركات الشحن ' ,value:23},
          {text:'اقمشة ومستلزمات الخياطة ' ,value:24},
          {text:' المشاتل ' ,value:25},
          {text:' العطور والتجميل' ,value:26},
          {text:' مستلزمات تجهيز الصالونات ومراكز التجميل' ,value:27},
        ],
      store_data: {
        name_ar: null,
        name_en:null,
        cr_number:null,
        city_id:null
      },
      user:{
        email: null,
        cc: '+966',
        mobile: null,
        phone:null,
        password: null,
        confirm_password: null,
      },
      branches_data: [{type: null, title: null, city_id: null, location: null, url: null}],
      page_num:1,
      disabled: true
    }
  },
  computed: {
    validateForm() {
      return ( !this.errors.any() && this.user.email && this.user.password ) ;
    }
  },
  methods: {
    openBranchDeleteConfirm(index) {
      this.ItemToDelete = index;
       this.$vs.dialog({
         type: 'confirm',
         color: 'danger',
         title: `حذف الفرع`,
         text: 'هل انت متأكد من رغبتك بحذف هذا الفرع',
         accept: this.deleteBranch
       })
     },
     deleteBranch() {
       if (this.branches_data.length > 1){
         // const branchIndex = this.branches_data.findIndex((u) => u.type == this.ItemToDelete)
         this.branches_data.splice(this.ItemToDelete, 1)
           this.$vs.notify({
             color: 'success',
             title: 'تم الحذف',
             text: 'تم حذف الفرع بنجاح',
           })
       }else {
         this.$vs.notify({
           color: 'danger',
           title: 'خطاء',
           text: 'يجب ابقاء فرع واحد على الاقل',
         })
       }
     },
    addBranch() {
      this.branches_data.push({type: null, title: null, city_id: null, location: null, url: null})
    },
  changeNumber(num){
    if((num == 2)
    && !this.errors.any()
    && this.store_data.name_ar
    && this.store_data.name_en
    && this.store_data.cr_number
    && this.store_data.city_id)
    {
      return this.page_num = num
    }
   else if((num == 3)
    && !this.errors.any()
    && this.branches_data[0].type
    && this.branches_data[0].title
    && this.branches_data[0].city_id
    ){
      return this.page_num = num
    }else{
      console.log(this.store_data)
      console.log(this.branches_data)
      this.$vs.notify({
      color: 'danger',
      title: 'خطاء',
      text: 'الرجاء اكمال جميع الحقول المطلوبة',
      position: 'bottom-center'
      })
    }
  },
  goToPage(num){
    if(num < this.page_num){
      return this.page_num = num
    }else{
      this.changeNumber(num)
    }
  },
  registerUser() {
      if(!this.validateForm) return
      this.$vs.loading()
      // const obj = {
      //     name_ar: this.store_data.name_ar,
      //     name_en: this.store_data.name_en,
      //     cr_number:this.store_data.cr_number,
      //     name:this.store_data.name,
      //     email: this.store_data.email,
      //     password: this.store_data.password,
      //     cc: this.store_data.cc,
      //     mobile: this.store_data.mobile,
      //     status: this.store_data.status
      // }
      // if (this.store_data.password){
          // obj.password = this.store_data.password
      // }
      return new Promise((resolve, reject) => {
            this.$store.dispatch('auth/registerUserJWT', {  store: this.store_data,
                                                            branches: this.branches_data,
                                                            user: this.user,
                                                            } )
          .then(res => {
            this.$vs.loading.close()
          if( res.data.statusCode == 200 ){
              this.$vs.notify({
                color: 'success',
                title: 'تم التسجيل بنجاح',
                text: 'سيتم التواصل معكم في أقرب وقت ممكن',
                fixed: 'true',
                position: 'bottom-center'
              })
              localStorage.setItem('isRegistered', true)
              this.page_num = 4
              // this.$acl.change('customer')
              // if(this.cartItems.length > 0) {
              //   this.$router.push('/checkout')
              // } else {
              //   this.$router.push('/')
              // }
          } else if( res.data.statusCode == 402 ){
            this.$vs.notify({
            color: 'danger',
            title: 'خطاء',
            text: 'رقم الجوال مسجل بالفعل'
            })
          }else if( res.data.statusCode == 403 ){
            this.$vs.notify({
            color: 'danger',
            title: 'خطاء',
            text: 'هذا البريد الالكتروني مسجل بالفعل'
            })
          } else {
              this.$vs.notify({
              color: 'danger',
              title: 'Error',
              text: 'حدث خطاء ما'
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
    }
  },
  created() {
      // Register Module UserManagement Module
      if(!moduleUserManagement.isRegistered) {
        this.$store.registerModule('userManagement', moduleUserManagement)
        moduleUserManagement.isRegistered = true
      }

      if (localStorage.getItem('isRegistered')){
        this.page_num = 4
      }
  }
};
</script>

<style lang="scss" scoped>
  .rounded-corner{
    border-radius: 25px;
  }
  .bg-logo{
    position: relative;
  }
  .bg-footer{
    position: absolute;
    bottom:-6rem;
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
      z-index:1;
      padding-right: 20px;
    }
    .phone-icon{
      position: absolute;
      top:20px;
      left: 28px;
    }
    .left-icon{
      position: absolute;
      top:18px;
      left: 92%;
      z-index: 9999;
    }
    .left-phone-icon{
      position: absolute;
      top:24px;
      left: 65%;
      z-index: 999;
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
 .vs__selected-options {
    padding: 0 10px;
}
.steps-btn{
    width: 18px;
    height: 18px;
    line-height: 18px;
    font-size: 12px;
    border-radius: 50%;
    text-align: center;
    background: #EAEAEA;
    color: #fff;
    cursor: pointer;
}
.steps-btn:hover{
  background: linear-gradient(#E93F7D,#DA6653) ;
}
.active{
   background: linear-gradient(#E93F7D,#DA6653) ;
}
    .vs__dropdown-menu{
      margin-top: 2rem;
      background: #eee;
      z-index: 9999;
    }

@media (max-width: 992px) and (min-width: 600px){
.bg-input{
  .left-icon{
      left: 95%;
    }
  }
}
@media (min-width: 375px) and (max-width: 600px){
  .bg-input{
  .left-icon{
      left: 88%;
    }
  }
  @media (max-width: 375px){
    .left-phone-icon{
      left: 63%;
    }
  }
}

</style>
