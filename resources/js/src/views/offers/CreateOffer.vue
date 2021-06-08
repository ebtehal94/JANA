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
              <!-- <span class="text-danger text-sm"  v-show="errors.has('title_ar')">{{ errors.first('title_ar') }}</span> -->
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
                <!-- <span class="text-danger text-sm"  v-show="errors.has('title_en')">{{ errors.first('title_en') }}</span> -->
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

        <div class="vx-row my-4">
          <div class="vx-col w-full md:w-1/2">
            <!-- Col Header -->
            <div class="flex items-end pt-4">
              <span class="leading-none font-semibold text-sm">{{$i18n.locale == "en" ? "Offer properties" : "خصائص العرض"}}</span>
            </div>

            <!-- Col Content -->

                <div class="bg-input text-sm">
                    <v-select class="w-full mt-4 text-sm"
                      :placeholder="$t('Category')"
                      v-model="offer_data.category_id"
                      v-validate="'required'"
                      label="title_ar" :options="categories"
                      :reduce="title_ar => title_ar.id"
                      :dir="$vs.rtl ? 'rtl' : 'ltr'" 
                      name="category"/>

                    <!-- <span v-if="!errors.has('category') && offer_data.category_id">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('category')">
                      <icon name="cross" class="icon left-icon"/>
                    </span> -->
                </div>

                <div class="bg-input text-sm">
                    <v-select class="w-full mt-2 text-sm"
                      :placeholder="$t('accountStatus')"
                      v-model="selected"
                      v-validate="'required'"
                      name="status"
                      label="text" :options="status_list"
                      :reduce="text => text.id"
                      :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                    <!-- <span
                      v-if="!errors.has('status') && offer_data.status">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('status')">
                      <icon name="cross" class="icon left-icon"/>
                    </span> -->
                </div>
          </div>

          <div class="vx-col w-full md:w-1/2">
            <!-- Col Header -->
            <div class="flex items-end pt-4">
              <span class="leading-none font-semibold text-sm">{{$i18n.locale == "en" ? "Offer images" : "صور العرض"}}</span>
            </div>

            <!-- Col Content -->
            <div class="vx-row flex mt-8 mx-0 offer-images">
              <div v-for="img in dataUploadedImages" :key="img.data" class="items-center vx-col w-full md:w-1/3 mb-4 cardBox">
                <img :src="img.url" class="mx-auto w-full lg:responsive" width="120">
              </div>
              <div class="vx-col w-full mb-4">
                <input type="file" class="hidden" ref="uploadImgInput" multiple @change="updateCurrImg" accept="image/*">
                <vs-button v-if="dataUploadedImages.length === 0" size="small" color="linear-gradient(to left,#E93F7D,#DA6653)"
                gradient class="rounded-full mt-6" icon-pack="feather" icon="icon-upload" @click="$refs.uploadImgInput.click()">{{ $i18n.locale == 'en' ? 'Upload Image' : 'رفع صورة' }}</vs-button>
                <!-- <vs-button v-if="dataUploadedImages.length === 0" class="text-gray p-0 mt-6" icon-pack="feather"  type="transparent" icon="icon-plus" @click="$refs.uploadImgInput.click()"/>
                <h5 class="text-gray text-xs text-center">{{ $i18n.locale == 'en' ? 'Upload Image' : 'اضافة صورة' }}</h5> -->
              </div>
              <!-- <div class="vx-col w-full md:w-1/3 mb-4">
                <img src="@assets/images/payment-methods.png" alt="Offer-image" class="mx-auto w-full lg:responsive" width="120">
              </div>
              <div class="vx-col w-full md:w-1/3 mb-4">
                <img src="@assets/images/card.png" alt="Offer-image" class="mx-auto w-full lg:responsive relative" width="120">
              </div> -->
            </div>
          </div>
        </div>

        <div class="vx-row my-4">
          <div class="vx-col w-full md:w-1/2 flex pt-4">
            <div class="vx-col w-full">
                <!-- Col Header -->
                <div class="flex items-end ">
                  <span class="leading-none font-semibold text-xs">{{$i18n.locale == "en" ? "Before discount" : "السعر قبل الخصم"}}</span>
                </div>

                <!-- Col Content -->

                  <vs-input
                  class="w-full mt-4 -m-4 vs-input-no-shdow-focus"
                  :placeholder="$t('Price')"
                  v-model="offer_data.price_before"
                  name="price_before" />
                  <!-- <span class="text-danger text-sm"  v-show="errors.has('price_before')">{{ errors.first('price_before') }}</span> -->
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
                  name="price" />
                  <!-- <span class="text-danger text-sm"  v-show="errors.has('price')">{{ errors.first('price') }}</span> -->

            </div>

            <div class="vx-col w-full">
                <!-- Col Header -->
                <div class="flex items-end">
                  <span class="leading-none font-semibold text-xs">{{$i18n.locale == "en" ? "Discount" : "الخصم"}}</span>
                </div>

                <!-- Col Content -->
                  <vs-input
                  class="w-full mt-4 vs-input-no-shdow-focus"
                  v-model="offer_data.discount_perc"
                  :placeholder="$t('DiscountPerc')"
                  v-validate="'max_value:100'"
                  name="discount_perc"/>
                  <span class="text-danger text-sm"  v-show="errors.has('discount_perc')">{{ errors.first('discount_perc') }}</span>
            </div>

          </div>

          <div v-if="$acl.check('admin')" class="vx-col w-full md:w-1/2 pt-4">
            <!-- Col Header -->
            <div class="flex items-end">
              <span class="leading-none font-semibold text-xs">{{$i18n.locale == "en" ? "The Store" : "المتجر"}}</span>
            </div>

            <div class="bg-input text-sm">
                <v-select class="w-full mt-4 text-sm"
                  :placeholder="$t('ChooseStore')"
                  v-model="offer_data.store_id"
                  v-validate="'required'"
                  label="name_ar" :options="stores"
                  :reduce="name_ar => name_ar.id"
                  :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                <!-- <span
                  v-if="!errors.has('store_id') && offer_data.store_id">
                  <icon name="confirm" class="icon left-icon"/>
                </span>
                <span v-else-if="errors.has('store_id')">
                  <icon name="cross" class="icon left-icon"/>
                </span> -->
             </div>
          </div>
        </div>

         <div class="vx-row my-4">
          <div class="vx-col w-full md:w-1/2 flex pt-2">
            <div class="vx-col w-1/2">
                <!-- Col Header -->
                <div class="flex items-end">
                  <span class="leading-none font-semibold text-xs">{{$i18n.locale == "en" ? "Offer expiration date" : " تاريخ انتهاءالعرض"}}</span>
                </div>

                <!-- Col Content -->
                  <flat-pickr
                  class="w-full mt-4"
                  v-model="offer_data.expiry"
                  placeholder="14-14-2021"
                  v-validate="'required'" />
                  <!-- <span class="text-danger text-sm"  v-show="errors.has('expiry')">{{ errors.first('expiry') }}</span> -->
            </div>
            <div class="vx-col w-1/2 ml-4">
                <!-- Col Header -->
                <div class="flex items-end">
                  <span class="leading-none font-semibold text-xs">{{$i18n.locale == "en" ? "Barcode" : "كود الخصم"}}</span>
                </div>

                <!-- Col Content -->
                  <vs-input
                  class="w-full mt-4 vs-input-no-shdow-focus"
                  v-model="offer_data.code"
                  :placeholder="$t('DiscountCode')"/>
                  <!-- <span class="text-danger text-sm"  v-show="errors.has('expiry')">{{ errors.first('expiry') }}</span> -->
            
          </div>
          </div>
        </div>

        <!-- Save & Reset Button -->
        <div class="vx-row flex justify-center mt-10">
            <vs-button
              size="small"
              class="mx-4 mb-4 font-semibold text-sm rounded-full"
              color="linear-gradient(to left,#E93F7D,#DA6653)"
              gradient
              @click="createOffer">
                {{$i18n.locale == "en" ? "Create Offer" : "إنشاء العرض"}}
            </vs-button>

            <vs-button
              size="small"
              class="mx-4 mb-4 font-semibold text-sm rounded-full px-24"
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
import axios from "@/axios.js"
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
    flatPickr,
    // swiper,
    // swiperSlide,
  },
  data() {
    return {
      offer_data: {title_ar:null,title_en: null, category_id: null, desc_ar:null,desc_en:null,status:0,price_before:null,price:null,expiry:null,store_id:null,discount_perc:null,code:null},
      // categories:[],
      status_list: [
        {text:'غير نشط',id:0},
        {text:'نشط',id:1},
      ],
      selected:{text:'غير نشط',id:0},
      dataUploadedImages: [],
      ImageToDelete: null,
      imgLink: 'https://janacard.s3.eu-central-1.amazonaws.com/offers/',
      offer_images:[],
    }
  },
  computed: {
    categories() {
        return this.$store.state.offerManagement.categories
    },
    stores() {
        return this.$store.state.offerManagement.stores
    },
    validateForm() {
      return ( !this.errors.any()) ;
    }
  },
  methods:{
      updateCurrImg(input) {
      if (input.target.files && input.target.files[0]) {
        var reader = new FileReader()
        reader.onload = e => {
          this.dataUploadedImages = input.target.files

          for (var i = 0; i < this.dataUploadedImages.length; i++) {
            const url = URL.createObjectURL(this.dataUploadedImages[i])
            this.dataUploadedImages[i].url = url
          }
        }
        reader.readAsDataURL(input.target.files[0])
      }
    },
    // updateCurrImg(input) {
    //    if (input.target.files && input.target.files[0]) {
    //      var reader = new FileReader()
    //      reader.onload = e => {
    //        this.dataUploadedImages= input.target.files
    //        console.log(input.target.files[0])
    //      }
    //      reader.readAsDataURL(input.target.files[0])
    //    }
    // },
    openConfirm(img) {
      this.ImageToDelete = img;
       this.$vs.dialog({
         type: 'confirm',
         color: 'danger',
         title: `Delete Image`,
         text: 'Are you sure you want to permenantly delete this image?',
         accept: this.acceptAlert
       })
     },
     acceptAlert() {
       this.deleteImage()

       this.$vs.notify({
         color: 'danger',
         title: 'Deleted image',
         text: 'The selected image was successfully deleted'
       })
     },
     deleteImage(img) {
       return new Promise((resolve, reject) => {
         axios.get("/api//offers/{offer_id}/deleteImage/{image_id}")
           .then((response) => {
             resolve(response)
           })
           .catch((error) => { reject(error) })
       })
     },
    createOffer(){
        if(!this.validateForm) return
      let formData = new FormData();
      formData.append('title_ar', this.offer_data.title_ar)
      formData.append('title_en', this.offer_data.title_en)
      formData.append('desc_ar', this.offer_data.desc_ar)
      formData.append('desc_en', this.offer_data.desc_en)
      formData.append('category_id', this.offer_data.category_id)
      formData.append('status', this.offer_data.status)
      formData.append('price_before', (this.offer_data.price_before > 0) ? this.offer_data.price_before : '' )
      formData.append('price', (this.offer_data.price > 0) ? this.offer_data.price : '')
      formData.append('discount_perc', (this.offer_data.discount_perc > 0) ? this.offer_data.discount_perc : '')
      formData.append('expiry', this.offer_data.expiry)
      formData.append('code', this.offer_data.code)
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
        this.$vs.loading()
        this.$store.dispatch(link, formData)
        .then(res => {
          this.$vs.loading.close()
          if( res.data.statusCode == 200 ){
            this.$vs.notify({
            color: 'success',
            title: 'Successfull',
            text: 'تم بنجاح'
            })
            this.$router.go(-1)
          } 
          else{
            this.$vs.notify({
            color: 'danger',
            title: 'Error',
            text: 'حدث خطأ ما'
            })
          }
        })
        .catch(err => { console.error(err)
          this.$vs.loading.close()
        })
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
    // if (this.$route.params.offerID != null){
    //   this.$store.dispatch("offerManagement/fetchOffer", this.$route.params.offerID).catch(err => { console.error(err) })
    //   .then((res) => {
    //     this.offer_data = res.data.offer
    //   })
    //   .catch((error) => console.log(error))
    // }

    this.$store.dispatch("offerManagement/fetchInfo").catch(err => { console.error(err) })
    .then((res) => {
      // this.categories = res.data.categories
    })
    .catch((error) => console.log(error))

  }
}
</script>

<style lang="scss" scoped>
#create-offer {
    margin: 2rem 2.5rem;
    .cardBox{
      position: relative;
    }

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
      }
      .vs-con-textarea{
          border-radius: 15px;
      }
      .vs-input--placeholder.normal {
          font-size: .8rem !important;
      }
    }
    .offer-images{
      img{
        width: 100%;
        position: relative;
      }
      .delete-img{
        float: right;
        margin-top: -4rem;
        z-index: 999;
        // position: absolute;
        // top:0;
        // left: 0;
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

    .vs-button.small:not(.includeIconOnly) {
      padding: 0.5rem 5rem;
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
    .offer-images{
      .delete-img{
        margin-top: -9rem;
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
    .offer-images{
      .delete-img{
        margin-top: -8rem;
      }
    }
  }
}
@media (max-width: 992px) and (min-width: 600px){
  #create-offer{
    .offer-images{
      .delete-img{
        margin-top: -2.6rem;
      }
    }
  }
}

@media only screen  and (min-width: 768px) {
  #create-offer{
    .offer-info {
      .bg-input{
        .left-icon{
            left: 90%;
        }
      }
     }
  }
}
</style>
