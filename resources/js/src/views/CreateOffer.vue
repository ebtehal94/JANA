<template>
  <div id="create-offer">
    <vx-card class="offer-info">
      <div slot="no-body" class="tabs-container md:px-6 pt-6 md:pb-4">
        <!-- Content Row -->
        <div class="vx-row">
          <div class="vx-col w-full md:w-1/2">
            <!-- Col Header -->
            <div class="flex items-end">
              <span class="leading-none font-semibold text-sm">{{$i18n.locale == "en" ? "Offer data (ar)" : " بيانات العرض باللغة العربية"}}</span>
            </div>

            <!-- Col Content -->
            <div class="bg-input">
              <vs-input 
              class="w-full mt-4"
              :placeholder="$t('OfferTitle')" 
              v-model="offer_data.title_ar" 
              v-validate="'required|alpha_spaces'" 
              name="title" />

              <span v-if="!errors.has('title_ar') && offer_data.title_ar">
                <icon name="confirm" class="icon left-icon"/>
              </span>
              <span v-else-if="errors.has('title_ar')">
                <icon name="cross" class="icon left-icon"/>
              </span>
            </div>

            <div class="bg-input">
              <vs-textarea 
              :placeholder="$t('OfferDesc')"
              v-model="offer_data.desc_ar" 
              class="mt-2 w-full" 
              height="100px"
              name="desc_ar"/>
              
              <span v-if="!errors.has('desc_ar') && offer_data.desc_ar">
                <icon name="confirm" class="icon left-icon"/>
              </span>
              <span v-else-if="errors.has('desc_ar')">
                <icon name="cross" class="icon left-icon"/>
              </span>
            </div>
          </div>

          <div class="vx-col w-full md:w-1/2">
            <!-- Col Header -->
            <div class="flex items-end">
              <span class="leading-none font-semibold text-sm">{{$i18n.locale == "en" ? "Offer data (en)" : " بيانات العرض باللغة الإنجليزية"}}</span>
            </div>

            <!-- Col Content -->
            <div>
              <div class="bg-input">
                <vs-input 
                class="w-full mt-4"
                :placeholder="$t('OfferTitle')" 
                v-model="offer_data.title_en" 
                v-validate="'required|alpha_spaces'" 
                name="title_en" />

                <span v-if="!errors.has('title') && offer_data.title_en">
                  <icon name="confirm" class="icon left-icon"/>
                </span>
                <span v-else-if="errors.has('title_en')">
                  <icon name="cross" class="icon left-icon"/>
                </span>
              </div>

              <vs-textarea 
              :placeholder="$t('OfferDesc')"
              v-model="offer_data.desc_en" 
              class="mt-2 w-full" 
              height="100px"
              name="desc_en"/>
              <span class="text-danger text-sm" v-show="errors.has('desc_en')">{{ errors.first('desc_en') }}</span>

            </div>
          </div>
        </div>

        <div class="vx-row my-6">
          <div class="vx-col w-full md:w-1/2">
            <!-- Col Header -->
            <div class="flex items-end">
              <span class="leading-none font-semibold text-sm">{{$i18n.locale == "en" ? "Offer properties" : "خصائص العرض"}}</span>
            </div>

            <!-- Col Content -->
            <div>
                <div class="bg-input">
                    <v-select class="w-full mt-2"
                      :placeholder="$t('Category')"
                      v-model="offer_data.category"
                      v-validate="'required'"
                      label="text" :options="category_list"
                      :reduce="text => text.value"
                      :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                    <span
                      v-if="!errors.has('category') && offer_data.category">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('category')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                </div>

                <div class="bg-input">
                    <v-select class="w-full mt-2"
                      :placeholder="$t('accountStatus')"
                      v-model="offer_data.status"
                      v-validate="'required'"
                      label="text" :options="status_list"
                      :reduce="text => text.value"
                      :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                    <span
                      v-if="!errors.has('status') && offer_data.status">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('status')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                </div>
                
            </div>
          </div>

          <div class="vx-col w-full md:w-1/2">
            <!-- Col Header -->
            <div class="flex items-end">
              <span class="leading-none font-semibold text-sm">{{$i18n.locale == "en" ? "Offer images" : "صور العرض"}}</span>
            </div>

            <!-- Col Content -->
            <div class="vx-row flex mt-4 mx-0">
              <div class="vx-col w-full md:w-1/3 add-img">
                <input type="file" class="hidden" ref="uploadImgInput" multiple @change="updateCurrImg" accept="image/*">
                <vs-button v-if="dataUploadedImages.length === 0" class="text-gray mt-4 ml-8" icon-pack="feather" type="transparent" icon="icon-plus" @click="$refs.uploadImgInput.click()"/>
                <h5 class="text-gray text-xs text-center">{{ $i18n.locale == 'en' ? 'Upload Image' : 'اضافة صورة' }}</h5>
              </div>
              <div class="vx-col w-full md:w-1/3">
                <img src="@assets/images/payment-methods.png" alt="" class="mx-auto" width="120">
              </div>
              <div class="vx-col w-full md:w-1/3">
                <img src="@assets/images/card.png" alt="" class="mx-auto" width="120">
              </div>
            </div>
          </div>
        </div>

        <div class="vx-row my-6">
          <div class="vx-col w-full md:w-1/2 flex">
            <div class="vx-col w-full">
                <!-- Col Header -->
                <div class="flex items-end">
                  <span class="leading-none font-semibold text-xs">{{$i18n.locale == "en" ? "Before discount" : "السعر قبل الخصم"}}</span>
                </div>

                <!-- Col Content -->

                  <vs-input
                  class="w-full mt-4 -m-4"
                  :placeholder="$t('Price')" 
                  v-model="offer_data.after_discount" 
                  v-validate="'required|alpha_spaces'" 
                  name="after_discount" />
                  <span class="text-danger text-sm"  v-show="errors.has('after_discount')">{{ errors.first('after_discount') }}</span>
            </div>

            <div class="vx-col w-full">
                <!-- Col Header -->
                <div class="flex items-end">
                  <span class="leading-none font-semibold text-xs">{{$i18n.locale == "en" ? "After discount" : "السعر بعد الخصم"}}</span>
                </div>

                <!-- Col Content -->

                  <vs-input 
                  class="w-full mt-4 -m-2"
                  :placeholder="$t('Price')" 
                  v-model="offer_data.before_discount" 
                  v-validate="'required|alpha_spaces'" 
                  name="before_discount" />
                  <span class="text-danger text-sm"  v-show="errors.has('before_discount')">{{ errors.first('before_discount') }}</span>

            </div>

            <div class="vx-col w-full">
                <!-- Col Header -->
                <div class="flex items-end">
                  <span class="leading-none font-semibold text-xs">{{$i18n.locale == "en" ? "Offer expiration date" : "تاريخ انتهاء العرض"}}</span>
                </div>

                <!-- Col Content -->

                  <vs-input 
                  class="w-full mt-4"
                  placeholder="14/14/2021" 
                  v-model="offer_data.date" 
                  v-validate="'required|alpha_spaces'" 
                  name="date" />
                  <span class="text-danger text-sm"  v-show="errors.has('date')">{{ errors.first('date') }}</span>
            </div>
          </div>

          <div class="vx-col w-full md:w-1/2">
            <!-- Col Header -->
            <div class="flex items-end">
              <span class="leading-none font-semibold text-xs">{{$i18n.locale == "en" ? "The Store" : "المتجر"}}</span>
            </div>

            <!-- Col Content -->
            <div>
             <div>
                <div class="bg-input">
                    <v-select class="w-full mt-2"
                      placeholder="اختر المتجر"
                      v-model="offer_data.category"
                      v-validate="'required'"
                      label="text" :options="category_list"
                      :reduce="text => text.value"
                      :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                    <span
                      v-if="!errors.has('category') && offer_data.category">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('category')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                 </div>
            </div>
            </div>
          </div>
        </div>
        
        <!-- Save & Reset Button -->
        <div class="vx-row flex justify-center mt-10">
            <vs-button
              size="small"
              class="mx-4 font-semibold text-sm rounded-full"
              color="linear-gradient(to left,#E93F7D,#DA6653)"
              gradient
              @click="registerUser">
                إنشاء العرض
            </vs-button>

            <vs-button
              size="small"
              class="mx-4 font-semibold text-sm rounded-full px-24"
              color="#ACACAC" type="border"
              @click="registerUser">
                خروج 
            </vs-button>
        </div>


      </div>

    </vx-card>
  </div>
</template>

<script>
import vSelect from 'vue-select'
import icon from '@/layouts/components/icon.vue'


// Store Module
import moduleUserManagement from '@/store/user-management/moduleUserManagement.js'

export default {
  components: {
    icon,
    vSelect
  },
  data() {
    return {
      offer_data: {title_ar:null,title_en: null, category: null, desc_ar:null,desc_en:null, mobile: null, password: null,status:null,store:null,before_discount:null,after_discount:null},
      category_list:[
        {text:'القسم الأول',value:1},
        {text:'القسم الثاني',value:2},
        {text:'القسم الثالث',value:3},
        {text:'القسم الرابع',value:4}
      ],
      status_list: [
        {text:'غير نشط',value:1},
        {text:'نشط',value:2},
      ],
      stores_list: [
        {text:'المتجر الأول',value:1},
        {text:'المتجر الثاني',value:2},
        {text:'المتجر الثالث',value:3},
        {text:'المتجر الرابع',value:4}
      ],
      dataUploadedImages: [],
      dataUploadedImagesForDisplay: [],
      ImageToDelete: null,
    }
  },
  computed: {

  },
  methods:{
    updateCurrImg(input) {
      if (input.target.files && input.target.files[0]) {
        var reader = new FileReader()
        reader.onload = e => {
          this.dataUploadedImages = input.target.files

            const url = URL.createObjectURL(this.dataUploadedImages[i])
            this.dataUploadedImages[i].url = url

          // this.dataImg.push(input.target.files[0])
          // this.dataImg = input.target.files[0]
          // this.dataImg = e.target.result

        }
        reader.readAsDataURL(input.target.files[0])
      }
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
#create-offer {
    margin: 2rem 2.5rem;

    .offer-info {
        padding: 2.5rem;
    .bg-input{
      position: relative;
      .left-icon{
        position: absolute;
        top:13px;
        left: 92%;
        z-index: 9999;
      }
      .v-select{
        .vs__dropdown-toggle{
          padding: 3rem;
        }
      }
    }
      .vs-con-textarea{
          border-radius: 15px;
      }
      .vs-input--placeholder.normal {
          font-size: .8rem !important;
      }
    }
    .add-img{
      border: 1px solid #eee;
      border-radius: 15px;
    }
   .vs-input--input{
    .normal {
          font-size: .8rem !important;
      }
   }
    .vs-button.small:not(.includeIconOnly) {
      padding: 0.4rem 5rem;
    }


}

@media only screen and (min-width: 375px) and (max-width: 600px) {

}

@media only screen and (min-width: 360px) and (max-width: 375px) {
  #create-offer {
    .vs--searchable{
      .vs__dropdown-toggle{
        padding: 0;
      }
    }
  }
}

@media only screen and (min-width: 320px)  and (max-width: 360px) {

}

@media only screen  and (max-width: 320px) {

}
</style>