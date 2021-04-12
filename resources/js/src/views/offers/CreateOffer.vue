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
              class="w-full mt-4 vs-input-no-shdow-focus"
              :placeholder="$t('OfferTitle')" 
              v-model="offer_data.title_ar" 
              v-validate="'required|alpha_spaces'" 
              name="title_ar" />

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
                class="w-full mt-4 vs-input-no-shdow-focus"
                :placeholder="$t('OfferTitle')" 
                v-model="offer_data.title_en" 
                v-validate="'required|alpha_spaces'" 
                name="title_en" />

                <span v-if="!errors.has('title_en') && offer_data.title_en">
                  <icon name="confirm" class="icon left-icon"/>
                </span>
                <span v-else-if="errors.has('title_en')">
                  <icon name="cross" class="icon left-icon"/>
                </span>
              </div>
              <div class="bg-input">
                <vs-textarea 
                :placeholder="$t('OfferDesc')"
                v-model="offer_data.desc_en" 
                class="mt-2 w-full" 
                height="100px"
                name="desc_en"/>
                <span v-if="!errors.has('desc_en') && offer_data.desc_en">
                  <icon name="confirm" class="icon left-icon"/>
                </span>
                <span v-else-if="errors.has('desc_en')">
                  <icon name="cross" class="icon left-icon"/>
                </span>
              </div>

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
                <div class="bg-input text-sm">
                    <v-select class="w-full mt-2 text-sm"
                      :placeholder="$t('Category')"
                      v-model="offer_data.category_id"
                      v-validate="'required'"
                      label="text" :options="category_list"
                      :reduce="text => text.value"
                      :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                    <span v-if="!errors.has('category_id') && offer_data.category_id">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('category_id')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                </div>

                <div class="bg-input text-sm">
                    <v-select class="w-full mt-2 text-sm"
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
                <vs-button v-if="dataUploadedImages.length === 0" class="text-gray mt-4" icon-pack="feather"  type="transparent" icon="icon-plus" @click="$refs.uploadImgInput.click()"/>
                <h5 class="text-gray text-xs text-center">{{ $i18n.locale == 'en' ? 'Upload Image' : 'اضافة صورة' }}</h5>
              </div>
              <div class="vx-col w-full md:w-1/3">
                <img src="@assets/images/payment-methods.png" alt="" class="mx-auto lg:responsive" width="120">
              </div>
              <div class="vx-col w-full md:w-1/3">
                <img src="@assets/images/card.png" alt="" class="mx-auto lg:responsive" width="120">
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
                  class="w-full mt-4 -m-4 vs-input-no-shdow-focus"
                  :placeholder="$t('Price')" 
                  v-model="offer_data.price_before" 
                  v-validate="'required'" 
                  name="price_before" />
                  <span class="text-danger text-sm"  v-show="errors.has('price_before')">{{ errors.first('price_before') }}</span>
            </div>

            <div class="vx-col w-full">
                <!-- Col Header -->
                <div class="flex items-end">
                  <span class="leading-none font-semibold text-xs">{{$i18n.locale == "en" ? "After discount" : "السعر بعد الخصم"}}</span>
                </div>

                <!-- Col Content -->

                  <vs-input 
                  class="w-full mt-4 -m-2 vs-input-no-shdow-focus"
                  :placeholder="$t('Price')" 
                  v-model="offer_data.price" 
                  v-validate="'required'" 
                  name="price" />
                  <span class="text-danger text-sm"  v-show="errors.has('price')">{{ errors.first('price') }}</span>

            </div>

            <div class="vx-col w-full">
                <!-- Col Header -->
                <div class="flex items-end">
                  <span class="leading-none font-semibold text-xs">{{$i18n.locale == "en" ? "Offer expiration date" : "تاريخ انتهاء العرض"}}</span>
                </div>

                <!-- Col Content -->
                  <flat-pickr
                  class="w-full mt-4" 
                  v-model="offer_data.expiry" 
                  placeholder="14-14-2021" 
                  v-validate="'required'" />
                  <span class="text-danger text-sm"  v-show="errors.has('expiry')">{{ errors.first('expiry') }}</span>
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
                <div class="bg-input text-sm">
                    <v-select class="w-full mt-2 text-sm"
                      :placeholder="$t('ChooseStore')"
                      v-model="offer_data.store_id"
                      v-validate="'required'"
                      label="text" :options="category_list"
                      :reduce="text => text.value"
                      :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                    <span
                      v-if="!errors.has('store_id') && offer_data.store_id">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('store_id')">
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
              @click="createOffer">
                {{$i18n.locale == "en" ? "Create Offer" : "إنشاء العرض"}}
            </vs-button>

            <vs-button
              size="small"
              class="mx-4 font-semibold text-sm rounded-full px-24"
              color="#ACACAC" type="border"
              @click="goBack">
                {{ $i18n.locale == 'en' ? 'Close' : 'خروج' }} 
            </vs-button>
        </div>


      </div>

    </vx-card>
  </div>
</template>

<script>
import vSelect from 'vue-select'
import icon from '@/layouts/components/icon.vue'
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';

// Store Module
import moduleOfferManagement from '@/store/offer-management/moduleOfferManagement.js'

export default {
  components: {
    icon,
    vSelect,
    flatPickr
  },
  data() {
    return {
      offer_data: {title_ar:null,title_en: null, category_id: null, desc_ar:null,desc_en:null,status:null,price_before:null,price:null,expiry:null,store_id:null},
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
    }
  },
  computed: {

  },
  methods:{
    updateCurrImg(input) {
       if (input.target.files && input.target.files[0]) {
         var reader = new FileReader()
         reader.onload = e => {
           this.dataUploadedImages= input.target.files
           console.log(input.target.files[0])
         }
         reader.readAsDataURL(input.target.files[0])
       }
    },
    createOffer(){
        // if(!this.validateForm) return
      let formData = new FormData();
      formData.append('title_ar', this.offer_data.title_ar)
      formData.append('title_en', this.offer_data.title_en)
      formData.append('desc_ar', this.offer_data.desc_ar)
      formData.append('desc_en', this.offer_data.desc_en)
      formData.append('category_id', this.offer_data.category_id)
      formData.append('status', this.offer_data.status)
      formData.append('price_before', this.offer_data.price_before)
      formData.append('price', this.offer_data.price)
      formData.append('expiry', this.offer_data.expiry)
      formData.append('store_id', this.offer_data.store_id)
      if (this.dataUploadedImages){
        for( var i = 0; i < this.dataUploadedImages.length; i++ ){
          let file = this.dataUploadedImages[i];
          formData.append('images[' + i + ']', file);
        }
      }

        if (this.offer_data.id != null && this.offer_data.id > 0){
          var link = "offerManagement/updateOffer"
        }else{
          var link = "offerManagement/addOffer"
        }
        this.$store.dispatch(link, formData)
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
    // Register Module OfferManagement Module
    if(!moduleOfferManagement.isRegistered) {
      this.$store.registerModule('offerManagement', moduleOfferManagement)
      moduleOfferManagement.isRegistered = true
    }
    if (this.$route.params.offerID != null){
      this.$store.dispatch("offerManagement/fetchOffer", this.$route.params.offerID).catch(err => { console.error(err) })
      .then((res) => {
        this.offer_data = res.data.offer
      })
      .catch((error) => console.log(error))
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
      text-align: center;
      text-align: -webkit-center;
    }
    .vs-input--input:focus{
      -webkit-box-shadow: none !important;
      box-shadow: none !important;
    }
   .vs-input--input{
    .normal {
          font-size: .8rem !important;
      }
   }
    .vs-button.small:not(.includeIconOnly) {
      padding: 0.4rem 5rem;
    }
    .flatpickr-input{
      border-radius:30px ;
      font-size: .9rem;
    }


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
@media (min-width: 375px) and (max-width: 600px){
   #create-offer{
     .offer-info {
      .bg-input{
        .left-icon{
            left: 88%;
        }
      }
     }
   }
}

@media only screen and (min-width: 320px)  and (max-width: 360px) {

}

@media only screen  and (max-width: 320px) {

}
</style>