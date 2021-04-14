<template>
  <div id="create-store">
    <vx-card class="store-info">
      <div slot="no-body" class="tabs-container md:px-6 pt-6 md:pb-4">
        <!-- Content Row -->
        <div class="vx-row">
          <div class="vx-col w-full md:w-1/2 pr-8 mt-4 justify-center items-center">
          <div class="center">
            <div class="upload">
              <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
              <vs-button v-if="dataUploadedImages.length === 0" class="mt-12 mx-auto" type="transparent" @click="$refs.uploadImgInput.click()">
              <img src="@assets/images/Uploader.png" alt="upload" width="90"/>
              </vs-button>
            </div>
            <div class="text-center text-xs mt-8">
              <p>تاريخ الإنضمام<span class="pl-4 date">15/4/2021</span></p>
              <p>تاريخ آخر عرض<span class="pl-4 date">15/4/2021</span></p>
            </div>
          </div>
            <!-- Col Header -->
              <div class="vx-card__title mt-5">
                <div class="separator">
                  <h4 class="mb-4 text-base">{{$i18n.locale == "en" ? "Method of connection" : "طريقة الاتصال"}}</h4>
                </div>
              </div>

              <div class="vx-row bg-input">
                <icon name="mobile" class="icon phone-icon"/>
                <vs-input
                :placeholder="$t('Mobile')"
                v-model="user.mobile"
                type="number"
                icon-no-border
                icon="icon"
                v-validate="'required|min:7'"
                class="w-3/4 mt-2 px-3"/>

                <vs-input
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
                :placeholder="$t('phone')"
                v-model="user.phone"
                type="number"
                icon-no-border
                icon="icon"
                v-validate="'required|min:7'"
                class="w-3/4 mt-2 px-3"/>

                <vs-input
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
                v-validate="'required|email|min:3'"
                data-vv-validate-on="blur"
                icon-no-border
                icon="icon"
                :placeholder="$t('Email')"
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
                data-vv-validate-on="blur"
                :placeholder="$t('password')"
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

            <div class="bg-input text-sm">
              <v-select class="w-full my-8 text-sm"
              v-model="store_data.status"
              :placeholder="$t('accountStatus')"
              label="text" :options="status_list"
              :reduce="text => text.id"
              :dir="$vs.rtl ? 'rtl' : 'ltr'" />

              <span v-if="!errors.has('status') && store_data.status">
                <icon name="confirm" class="icon left-icon"/>
              </span>
              <span v-else-if="errors.has('status')">
                <icon name="cross" class="icon left-icon"/>
              </span>
            </div>
          </div>

          <div class="vx-col sm:w-full md:w-1/2 lg:w-1/2">
            <!-- Col Header -->
            <div class="vx-card__title">
              <div class="separator">
                <h4 class="mb-4 text-base">{{$t('storeData')}}</h4>
              </div>
            </div>
            
            <div>
              <div class="bg-input">
                <icon name="store-name" class="icon"/>
                <vs-input
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
                <icon name="store-name" class="icon"/>
                <vs-input
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
                :placeholder="$t('CommercialRegisterNo')"
                v-model="store_data.cr_number"
                type="number"
                icon-no-border
                icon="icon"
                v-validate="'required|min:6'"
                class="w-full mt-2"/>

                <span v-if="!errors.has('cr_number') && store_data.cr_number && store_data.cr_number.length >= 6">
                  <icon name="confirm" class="icon left-icon"/>
                </span>
                <span v-else-if="errors.has('cr_number')">
                  <icon name="cross" class="icon left-icon"/>
                </span>

              </div>

              <div class="bg-input text-sm">
                <icon name="city" class="icon"/>
                <v-select class="w-full mt-2 text-sm"
                :placeholder="$t('Location')"
                v-model="store_data.city_id"
                v-validate="'required'"
                label="name_ar" :options="cities_list"
                :reduce="name_ar => name_ar.id"
                :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                <span v-if="!errors.has('city_id') && store_data.city_id">
                  <icon name="confirm" class="icon left-icon"/>
                </span>
                <span v-else-if="errors.has('city_id')">
                  <icon name="cross" class="icon left-icon"/>
                </span>
              </div>

              <div class="vx-card__title mt-4">
                <div class="separator">
                  <h4 class="mb-4 text-base">{{$t('branchData')}}</h4>
                </div>
              </div>
                <div v-for="branch, branchIndex in branches_data"  :key="branch.title +'-'+ branchIndex">
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
                    class="w-full mt-6 font-medium register-btn"
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
                class="w-full mt-6 font-medium register-btn rounded-full"
                color="linear-gradient(to left,#E93F7D,#DA6653)"
                gradient
                @click="save_changes">
                {{$i18n.locale == "en" ? "Save Change" : "حفظ التغيرات"}} 
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
import { CitiesList } from '../pages/extra/CitiesList.js'
// Store Module
import moduleStoreManagement from '@/store/store-management/moduleStoreManagement.js'

export default {
  components: {
    icon,
    vSelect
  },
  data() {
    return{
      store_data: {
        name_ar: null,
        name_en:null,
        cr_number:null,
        city_id:null,
        status:null,
      },
      cities_list:CitiesList,
      status_list: [
        {text:'غير نشط',value:0},
        {text:'نشط',value:1},
      ],
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
      user:{
        email: null,
        cc: '+966',
        mobile: null,
        phone:null,
        password: null,
      },
      branches_data: [
        {type: null, title: null, city_id: null, url: null}
        ],
      dataUploadedImages: [],

    }
  },
  computed: {
    validateForm() {
      return ( !this.errors.any() && this.user.email && this.user.password ) ;
    },
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
      this.branches_data.push({type: null, title: null, city_id: null, url: null})
    },
    updateCurrImg(input) {
       if (input.target.files && input.target.files[0]) {
         var reader = new FileReader()
         reader.onload = e => {
           this.dataUploadedImages= input.target.files[0]
           console.log(input.target.files[0])
         }
         reader.readAsDataURL(input.target.files[0])
       }
    },
    save_changes() {
      //if(!this.validateForm) return
    
      let formData = new FormData();
      formData.append('name_ar', this.store_data.name_ar)
      formData.append('name_en', this.store_data.name_en)
      formData.append('cr_number', this.store_data.cr_number)
      formData.append('city_id', this.store_data.city_id)
      formData.append('status', this.store_data.status)
      if (this.dataUploadedImages){
          formData.append('image', this.dataUploadedImages);
      }
      if (this.store_data.id != null && this.store_data.id > 0){
        var link = "storeManagement/updateStore"
      }else{
        var link = "storeManagement/addStore"
      }
      this.$store.dispatch(link, {store: formData,
      user: this.user,
      branch: this.branches_data})                                 
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
      .catch(err => { console.error(err) })
    },
  },
  created() {
    // Register Module UserManagement Module
    if(!moduleStoreManagement.isRegistered) {
      this.$store.registerModule('storeManagement', moduleStoreManagement)
      moduleStoreManagement.isRegistered = true
    }
    if (this.$route.params.storeID != null){
      this.$store.dispatch("storeManagement/fetchStore", this.$route.params.storeID).catch(err => { console.error(err) })
      .then((res) => {
        this.store_data = res.data.store
        this.user = res.data.store_data.user
        this.branches_data = res.data.store_data.branches
      })
      .catch((error) => console.log(error))
    }
  }
  
}
</script>

<style lang="scss" scoped>
#create-store {
    margin: 2rem 2.5rem;

    .store-info{
        padding: 2.5rem;
    }
    .center{
      text-align: -webkit-center;
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
  .upload{
    background: rgb(243, 243, 243);
    border-radius: 50%;
    width: 200px;
    height: 200px;
  }
  .bg-input{
    position: relative;
    .icon{
      position: absolute;
      top:10px;
      left: 15px;
      z-index:1;
      padding-right: 20px;
    }
    .phone-icon{
      position: absolute;
      top:13px;
      left: 25px;
    }
    .left-icon{
      position: absolute;
      top:13px;
      left: 92%;
      z-index: 9999;
    }
    .left-phone-icon{
      position: absolute;
      top:22px;
      left: 65%;
      z-index: 999;
    }
    .qr-icon{
      position: absolute;
      top:55%;
      left: 60%;
      z-index: 9999;
    }
  }
  .date{
    color: #ACACAC;
  }
  .vs-button.small:not(.includeIconOnly) {
    padding: 0.5rem 4rem 0.5rem 1.5rem;
    
  }
  .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large) {
      padding: .5rem 2rem;
  }
  .register-btn{
    border-radius: 30px;
  }
}

@media (min-width: 768px) and (max-width: 991.98px){
  #create-store {
    .upload{
      margin-left: 0rem !important;
    }
    .bg-input{
      .left-icon{
        left: 88%;
      }
      .left-phone-icon{
        left: 62%;
        top:20px;
      }
    }
  }
}
@media only screen and (min-width: 375px) and (max-width: 600px) {
  #create-store {
    .vx-card__title{
      margin-top: 1.5rem;
    }
    .upload{
      margin-left: 1rem !important;
    }
    .bg-input{
      .left-icon{
        left: 88%;
      }
      .left-phone-icon{
        left: 62%;
        top:20px;
      }
    }
  }
}

@media only screen and (min-width: 360px) and (max-width: 375px) {
  #create-store {
    .vx-card__title{
      margin-top: 1.5rem;
    }
  }
}


</style>