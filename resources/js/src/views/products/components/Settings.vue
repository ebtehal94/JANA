
<template>
  <div id="page-user-edit">
    <vx-card>
        <div class="vx-row">
          <!-- Product Images -->
          <div class="vx-col w-full">
              <template >
                <div class="carousel-example">
                    <swiper :options="swiperOption" :dir="$vs.rtl ? 'rtl' : 'ltr'" :key="$vs.rtl">
                        <swiper-slide v-for="img in product_images" :key="img.id" class="items-center">
                          <img :src="'https://otantik-home.s3.me-south-1.amazonaws.com/products/'+img.link" height="150px" width="100%" class="ml-auto">
                          <vs-button @click="openConfirm(img)" icon-pack="feather" icon="icon-trash" size="small" color="danger" type="flat">{{ $i18n.locale == 'en' ? 'Delete' : 'حذف' }}</vs-button>
                        </swiper-slide>
                        <swiper-slide v-for="img in dataUploadedImages" :key="img.data" class="items-center">
                          <img :src="img.url" height="150px" width="100%" class="preview ml-auto">
                        </swiper-slide>

                        <div class="swiper-button-prev" slot="button-prev"></div>
                        <div class="swiper-button-next" slot="button-next"></div>
                    </swiper>
                </div>
              </template>
          </div>

          <div class="vx-col w-full">
            <div>
              <input type="file" class="hidden" ref="uploadImgInput" multiple @change="updateCurrImg" accept="image/*">
              <vs-button v-if="dataUploadedImages.length === 0" size="small" icon-pack="feather" icon="icon-upload" @click="$refs.uploadImgInput.click()">{{ $i18n.locale == 'en' ? 'Upload Image' : 'رفع صورة' }}</vs-button>
              <vs-button class="admin-add-btn" v-if="dataUploadedImages.length > 0"  color="success" size="small" icon-pack="feather" icon="icon-save" @click="submitImage(product_data.id)">{{ $i18n.locale == 'en' ? 'Save Uplaoded Images' : 'رفع الصور المحملة' }}</vs-button>
            </div>
          </div>

          <!-- Name & Description -->
          <div class="vx-col md:w-1/2 w-full mt-8">
            <div class="vx-row px-8">
              <label class="vs-input-label">{{$t('TitleArabic') + ' '}} <span class="text-danger">*</span></label>
              <vs-input class="w-full mb-4" v-model="product_data.title_ar" v-validate="'required|alpha_spaces'" name="name" />
              <span class="text-danger text-sm" v-show="errors.has('title_ar')">{{ errors.first('title_ar') }}</span>

              <label class="vs-input-label">{{ $t('DescAR') }}</label>
              <vs-textarea v-model="product_data.desc_ar" class="mt-2 w-full px-8" name="desc_ar"/>
              <span class="text-danger text-sm" v-show="errors.has('desc_ar')">{{ errors.first('desc_ar') }}</span>
            </div>
          </div>

          <div class="vx-col md:w-1/2 w-full mt-8">
            <div class="vx-row px-8">
              <label class="vs-input-label">{{$t('TitleEnglish') + ' '}} <span class="text-danger">*</span></label>
              <vs-input class="w-full mb-4" v-model="product_data.title_en" v-validate="'required|alpha_spaces'" name="name" />
              <span class="text-danger text-sm" v-show="errors.has('title_en')">{{ errors.first('title_en') }}</span>

              <label class="vs-input-label">{{ $t('DescEN') }}</label>
              <vs-textarea v-model="product_data.desc_en" class="mt-2 w-full px-8" name="desc_en"/>
              <span class="text-danger text-sm" v-show="errors.has('desc_en')">{{ errors.first('desc_en') }}</span>
            </div>
          </div>

          <div class="vx-col md:w-1/2 w-full px-8">
            <div>
              <div class="w-full mt-2">
                <label class="vs-input-label">{{$t('Category')}}</label>
                <v-select v-model="product_data.category_id" class="mb-4" as="name_ar:id:id" :from="categories"></v-select>
              </div>

              <div class="w-full mt-4">
                <label class="vs-input-label">{{ $t('Filter') }}</label>
                <v-select v-model="product_data.filter_id" class="mb-4" as="title_ar:id:id" :from="category_filters(product_data.category_id)" tagging></v-select>
              </div>
            </div>
          </div>

          <div class="vx-col md:w-1/2 w-full px-8">
            <div>
              <div class="w-full mt-2">
                <label class="vs-input-label">{{ $t('Collection') }}</label>
                <v-select v-model="product_data.collection_id" class="mb-4" as="title_ar:id:id" :from="collections"></v-select>
              </div>

              <div class="w-1/3 mt-2 px-4">
                <label class="vs-input-label">{{ $t('ProductID') }}</label>
                <vs-input v-model="product_data.code" v-validate="'required|alpha_spaces'" name="code" />
              </div>
              <div class="w-1/3 mt-2 px-4">
                <label class="vs-input-label">{{ $t('ProductColor') }}</label>
                <vs-input v-model="product_data.color" v-validate="'required|alpha_spaces'" name="color" />
              </div>
              <div class="w-1/3 mt-2 px-4">
                <label class="vs-input-label">{{ $t('ProductSize') }}</label>
                <vs-input v-model="product_data.size" v-validate="'required|alpha_spaces'" name="size" />
              </div>
            </div>
          </div>

        </div>

        <!-- Save & Reset Button -->
        <div class="vx-row">
          <div class="vx-col w-full">
            <div class="mt-8 flex flex-wrap items-center justify-end">
              <vs-button class="ml-auto mt-2" @click.stop="save_changes" :disabled="!validateForm">{{ $t('Save') }}</vs-button>
              <vs-button class="ml-4 mt-2" type="border" color="warning" @click="goBack">{{ $t('Cancel')}}</vs-button>
            </div>
          </div>
        </div>
      </vx-card>
  </div>
</template>

<script>
import '@desislavsd/vue-select/dist/vue-select.css'
import { vSelect } from '@desislavsd/vue-select'
import axios from "@/axios.js"
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import 'swiper/dist/css/swiper.min.css'
import { swiper, swiperSlide } from 'vue-awesome-swiper'
import moduleCollections from "@/store/collections-list/moduleCollections.js"
import moduleDataList from "@/store/data-list/moduleDataList.js"


export default {
  components: {
    vSelect,
    swiper,
    swiperSlide,
    flatPickr
  },
  data() {
    return {
      product_data: { id: null, title_en: null, title_ar: null, desc_en: null, color: null, size:null, code:null, desc_ar: null, category_id: null, collection_id: null, filter_id: null},
      product_images:[],
      filters:[],
      dataUploadedImages: [],
      dataUploadedImagesForDisplay: [],
      ImageToDelete: null,
      swiperOption: {
        slidesPerView: 5,
        spaceBetween: 30,
        centeredSlides: false,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
      },
    }
  },
  computed: {
    categories () {
      return this.$store.state.CategoriesList
    },
    category_filters() {
      return (category_id) => this.filters.filter(filter => filter.category_id == category_id)
    },
    collections () {
      return this.$store.state.collectionsData.collections
    },
  },
  methods: {
    getCategories() {
      return new Promise((resolve, reject) => {
        axios.get("/api/categoriesList")
          .then((response) => {
            this.category_choices = response.data
            resolve(response)
          })
          .catch((error) => { reject(error) })
      })
    },
    deleteImage(image) {
      return new Promise((resolve, reject) => {
        axios.get("/api/products/" + this.product_data.id + "/deleteImage/" + this.ImageToDelete.id)
          .then((response) => {
            resolve(response)
          })
          .catch((error) => { console.log(error.response) })
      })
    },
    openConfirm(img) {
      // img.product_id = this.product_data.id
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
      //  const ItemIndex = this.dataImg.findIndex((p) => p.id == this.ImageToDelete.id)
      //  this.dataImg.splice(ItemIndex, 1)
       this.deleteImage()

       this.$vs.notify({
         color: 'danger',
         title: 'Deleted image',
         text: 'The selected image was successfully deleted'
       })

       window.location.reload()
     },
    updateCurrImg(input) {
      if (input.target.files && input.target.files[0]) {
        var reader = new FileReader()
        reader.onload = e => {
          this.dataUploadedImages           = input.target.files

          for (var i = 0; i < this.dataUploadedImages.length; i++) {
            const url = URL.createObjectURL(this.dataUploadedImages[i])
            this.dataUploadedImages[i].url = url
          }

          // this.dataImg.push(input.target.files[0])
          // this.dataImg = input.target.files[0]
          // this.dataImg = e.target.result

        }
        reader.readAsDataURL(input.target.files[0])
      }
    },
    submitImage(id) {
        let formData = new FormData();

        formData.append('product_id', id)

        if (this.dataUploadedImages){
          for( var i = 0; i < this.dataUploadedImages.length; i++ ){
            let file = this.dataUploadedImages[i];
            formData.append('images[' + i + ']', file);
          }
        }

        axios.post(`/api/products/addImages`, formData,
        {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        })
        .then((response) => {
          this.dataUploadedImages = null

           this.$vs.notify({
              color: 'success',
              title: 'Successfull',
              position:'top-center',
              text: 'تم حفظ الصور بنجاح'
            })

            window.location.reload()
        }).catch((error) => console.log(error.response))

    },
    fetch_product_data(productId) {
      axios.get("/api/products/edit/" + productId)
        .then(res => {
                      //  this.filters             = res.data.filters
                       this.product_data        = res.data.product
                       this.product_images      = res.data.images
        })
        .catch(err => {
          if(err.response.status === 404) {
            this.product_not_found = true
            return
          }
          console.error(err) })
    },
    fetch_filters_data(){
      axios.get("/api/categories/filter/list")
      .then(res => {
        this.filters = res.data
      })
      .catch(err => {console.error(err) })
    },
    validateForm() {
      return !this.errors.any()
    },
    goBack(){
      this.$router.go(-1)
    },
    save_changes() {
      if(!this.validateForm) return
      let formData = new FormData();

        // formData.append('product', JSON.stringify(this.product_data))
        formData.append('title_en', this.product_data.title_en)
        formData.append('title_ar', this.product_data.title_ar)
        formData.append('desc_en', this.product_data.desc_en)
        formData.append('desc_ar', this.product_data.desc_ar)
        formData.append('code', this.product_data.code)
        formData.append('color', this.product_data.color)
        formData.append('size', this.product_data.size)

        if (this.product_data.category_id != null){
        formData.append('category_id', this.product_data.category_id)
        }
        if (this.product_data.collection_id != null){
        formData.append('collection_id', this.product_data.collection_id)
        }
        if (this.product_data.filter_id != null){
          formData.append('filter_id', this.product_data.filter_id)
        }

        if (this.dataUploadedImages){
          for( var i = 0; i < this.dataUploadedImages.length; i++ ){
            let file = this.dataUploadedImages[i];
            formData.append('images[' + i + ']', file);
          }
        }

      if(this.product_data.id !== null && this.product_data.id >= 0) {
        formData.append('id', this.product_data.id)
        this.$store.dispatch("dataList/updateItem", formData)
        .then((response) => {
          console.log(response)
          if( response[0].data.statusCode == 200 ){
            this.$vs.notify({
              color: 'success',
              title: 'Successfull',
              text: 'Product updated successfully'
            })
          }else if( response[0].data.statusCode == 402 ){
            this.$vs.notify({
              color: 'danger',
              title: 'Error',
              text: 'Product ID already exists'
            })
          }else{
            this.$vs.notify({
              color: 'danger',
              title: 'Error',
              text: 'Error updating'
            })
          }
        })
        .catch(err => { console.error(err) })
      }else{
        this.$store.dispatch("dataList/addItem", formData)
        .then((response) => {
          if( response.data.statusCode == 200 ){
            this.$vs.notify({
              color: 'success',
              title: 'Successfull',
              text: 'Product updated successfully'
            })
            this.$router.push({path: '/products/edit/' + response.data.product.id})
          }else if( response.data.statusCode == 402 ){
            this.$vs.notify({
              color: 'danger',
              title: 'Error',
              text: 'Product ID already exists'
            })
          }else{
            this.$vs.notify({
              color: 'danger',
              title: 'Error',
              text: 'Error updating'
            })
          }
        })
        .catch(err => { console.error(err) })
      }

    },
  },
  created() {
    if (this.$route.params.productId){
      this.fetch_product_data(this.$route.params.productId)
      this.fetch_filters_data()
    }

    if(!moduleCollections.isRegistered) {
      // this.$store.registerModule('dataList', moduleDataList)
      this.$store.registerModule('collectionsData', moduleCollections)
      moduleCollections.isRegistered = true

      this.$store.dispatch("collectionsData/fetchCollections")
    }
  }
}
</script>
