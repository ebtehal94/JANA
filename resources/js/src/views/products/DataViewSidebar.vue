<!-- =========================================================================================
  File Name: AddNewDataSidebar.vue
  Description: Add New Data - Sidebar component
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
  <!-- <vs-sidebar click-not-close position-right parent="body" default-index="1" color="primary" class="add-new-data-sidebar p-4" spacer v-model="isSidebarActiveLocal"> -->
  <vx-card>
    <div class="mt-6 flex items-center justify-between px-6">
        <h4>{{ Object.entries(this.data).length === 0 ? "ADD NEW" : "UPDATE" }} ITEM</h4>
        <feather-icon icon="XIcon" @click.stop="isSidebarActiveLocal = false" class="cursor-pointer"></feather-icon>
    </div>
    <vs-divider class="mb-0"></vs-divider>

      <div class="p-4">

      <!-- Product Images -->
        <template >
          <div class="carousel-example">
              <swiper :options="swiperOption" :dir="$vs.rtl ? 'rtl' : 'ltr'" :key="$vs.rtl">
                  <swiper-slide v-for="img in dataImg" :key="img.id" class="items-center">
                    <img :src="'https://otantik-home.s3.me-south-1.amazonaws.com/products/'+img.link" height="250px" width="100%" class="ml-auto">
                    <vs-button @click="openConfirm(img)" icon-pack="feather" icon="icon-trash" size="small" color="danger" type="flat">Delete</vs-button>
                  </swiper-slide>
                  <swiper-slide v-for="img in dataUploadedImages" :key="img.data" class="items-center">
                    <img :src="img" height="250px" width="100%" class="preview ml-auto">
                    <vs-button @click="openConfirm(img)" icon-pack="feather" icon="icon-trash" size="small" color="danger" type="flat">Delete</vs-button>
                  </swiper-slide>

                  <div class="swiper-pagination" slot="pagination"></div>
                  <div class="swiper-button-prev" slot="button-prev"></div>
                  <div class="swiper-button-next" slot="button-next"></div>
              </swiper>
              <div class="float-right">
                <input type="file" class="hidden" ref="uploadImgInput" multiple @change="updateCurrImg" accept="image/*">
                <vs-button size="small" icon-pack="feather" icon="icon-upload" @click="$refs.uploadImgInput.click()">Upload Image</vs-button>
              </div>
          </div>
        </template>

      </div>

      <vs-tabs :color="colorx">
        <vs-tab @click="colorx = 'success'" label="Arabic">
          <div class="con-tab-ejemplo px-2">
            <!-- NAME -->
            <vs-input label="Name" v-model="dataTitleAr" class="w-full" name="title_ar" v-validate="'required'" />
            <span class="text-danger text-sm" v-show="errors.has('title_ar')">{{ errors.first('title_ar') }}</span>

            <!-- Description -->
            <vs-textarea label="Description" v-model="dataDescAr" class="mt-2 w-full" name="desc_ar"/>
            <span class="text-danger text-sm" v-show="errors.has('desc_ar')">{{ errors.first('desc_ar') }}</span>
          </div>
        </vs-tab>

        <vs-tab @click="colorx = 'danger'" label="English">
          <div class="con-tab-ejemplo px-2">
            <!-- NAME -->
            <vs-input label="Name" v-model="dataTitleEn" class="w-full" name="title_en" v-validate="'required'" />
            <span class="text-danger text-sm" v-show="errors.has('title_en')">{{ errors.first('title_en') }}</span>

            <!-- Description -->
            <vs-textarea label="Description" v-model="dataDescEn" class="mt-2 w-full" name="desc_en"/>
            <span class="text-danger text-sm" v-show="errors.has('desc_en')">{{ errors.first('desc_en') }}</span>
          </div>
        </vs-tab>

      </vs-tabs>

      <!-- CATEGORY -->
      <vs-select v-model="dataCategory" label="Category" class="px-4 mt-2 w-full" name="category_id" v-validate="'required'">
        <vs-select-item :key="item.id" :value="item.id" :text="item.title" v-for="item in category_choices" />
      </vs-select>
      <span class="text-danger text-sm" v-show="errors.has('category_id')">{{ errors.first('category_id') }}</span>
<!--
      <vs-select v-model="dataCategory" label="Category" class="mt-2 w-full" name="category_id" v-validate="'required'">
        < :key="item.id" :value="item.id" :text="item.title" v-for="item in category_choices" />
      </vs-select>
      <span class="text-danger text-sm" v-show="errors.has('category_id')">{{ errors.first('category_id') }}</span> -->

      <!-- ORDER STATUS -->
      <vs-select v-model="dataStatus" label="Status" class="px-4 mt-4 w-full" name="status">
        <vs-select-item :key="item.value" :value="item.value" :text="item.text" v-for="item in product_status_choices" />
      </vs-select>

      <div class="flex justify-between mt-5 mb-10 px-4">
        <!-- PRICE -->
        <vs-input
          icon-pack="feather"
          icon="icon-dollar-sign"
          label="Price"
          v-model="dataPrice"
          v-validate="{ required: true, regex: /\d+(\.\d+)?$/ }"
          name="item-price" />
        <span class="text-danger text-sm" v-show="errors.has('item-price')">{{ errors.first('item-price') }}</span>

        <!-- Stock -->
        <vs-input
          icon-pack="feather"
          icon="icon-layers"
          label="Stock Available"
          v-model="dataStock"
          class="ml-2"
          v-validate="{ required: true, regex: /\d+(\.\d+)?$/ }"
          name="item-price" />
        <span class="text-danger text-sm" v-show="errors.has('item-stock')">{{ errors.first('item-stock') }}</span>
      </div>

      <!-- Upload -->
        <!-- <vs-upload data="dataImg" text="Upload Image" class="img-upload" ref="fileUpload" multiple /> -->

    <!-- </div> -->

    <div class="flex flex-wrap items-center p-6" slot="footer">
      <vs-button class="mr-6" @click="submitData" :disabled="!isFormValid">Submit</vs-button>
      <vs-button type="border" color="danger" @click="isSidebarActiveLocal = false">Cancel</vs-button>
    </div>
  </vx-card>
  <!-- </vs-sidebar> -->
</template>

<script>
// import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import axios from "@/axios.js"
import 'swiper/dist/css/swiper.min.css'
import { swiper, swiperSlide } from 'vue-awesome-swiper'


export default {
  props: {
    // product_id: {
    //   type: Boolean,
    //   required: true
    // },
    // data: {
    //   type: Object,
    //   default: () => {},
    // }
  },
  components: {
    // VuePerfectScrollbar,
    swiper,
    swiperSlide
  },
  data() {
    return {

      colorx:'success',
      activeConfirm: false,
      dataId: null,
      dataTitleAr: "",
      dataTitleEn: "",
      dataDescAr: "",
      dataDescEn: "",
      dataCategory: null,
      dataImg: null,
      dataUploadedImages: null,
      dataUploadedImagesForDisplay: [],
      ImageToDelete: null,
      dataStatus: 0,
      dataPrice: 0,
      dataStock: 0,
      category_choices: [],
      product_status_choices: [
        {text:'Active',value:0},
        {text:'Featured',value:1},
        {text:'Out of Stock',value:2},
        {text:'Hidden',value:3}
      ],
      settings: { // perfectscrollbar settings
          maxScrollbarLength: 60,
          wheelSpeed: .60,
      },
      swiperOption: {
          spaceBetween: 30,
          centeredSlides: true,
          autoplay: {
              delay: 3000,
              disableOnInteraction: true
          },
          pagination: {
              el: '.swiper-pagination',
              clickable: true
          },
          navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev'
          }
      }
    }
  // },
  // watch: {
    // isSidebarActive(val) {
    //   if(!val) return
    //   if(Object.entries(this.data).length === 0) {
    //     this.initValues()
    //     this.$validator.reset()
    //   }else {
    //     let { category, id, title_ar, title_en, desc_ar, desc_en, status, price, stock, images } = JSON.parse(JSON.stringify(this.data))
    //     this.dataId = id
    //     this.dataCategory = category.id
    //     this.dataImg = images
    //     this.dataTitleAr = title_ar
    //     this.dataTitleEn = title_en
    //     this.dataDescAr = desc_ar
    //     this.dataDescEn = desc_en
    //     this.dataStatus = status
    //     this.dataPrice = price
    //     this.dataStock = stock
    //     this.initValues()
    //   }
    //   // Object.entries(this.data).length === 0 ? this.initValues() : { this.dataId, this.dataName, this.dataCategory, this.dataStatus, this.dataPrice } = JSON.parse(JSON.stringify(this.data))
    // }
  },
  computed: {
    isFormValid() {
      return !this.errors.any() && this.dataTitleAr && this.dataTitleEn && this.dataCategory && (this.dataPrice > 0)
    },
  },
  methods: {
    initValues() {
      if(this.data.id) return
        this.dataId = null
        this.dataTitleAr = ""
        this.dataTitleEn = ""
        this.dataDescAr = ""
        this.dataDescEn = ""
        this.dataCategory = null
        this.dataStatus = 0
        this.dataPrice = 0
        this.dataStock = 0
        this.dataImg = null
        this.dataUploadedImages = null
    },
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
        axios.get("/api/products/deleteImage/"+this.ImageToDelete.id)
          .then((response) => {
            resolve(response)
          })
          .catch((error) => { reject(error) })
      })
    },
    submitData() {
      this.$validator.validateAll().then(result => {
          if (result) {
            let formData = new FormData();
            formData.append('title_ar', this.dataTitleAr)
            formData.append('title_en', this.dataTitleEn)
            formData.append('desc_ar', this.dataDescAr)
            formData.append('desc_en', this.dataDescEn)

            formData.append('category_id', this.dataCategory)
            formData.append('status', this.dataStatus)
            formData.append('price', this.dataPrice)
            formData.append('stock', this.dataStock)

            // formData.append('images', this.dataImg)
            if (this.dataUploadedImages){
              for( var i = 0; i < this.dataUploadedImages.length; i++ ){
                let file = this.dataUploadedImages[i];

                formData.append('images[' + i + ']', file);
              }
            }

            if(this.dataId !== null && this.dataId >= 0) {
              formData.append('id', this.dataId)
              this.$store.dispatch("dataList/updateItem", formData).catch(err => { console.error(err) })
            }else{
              this.$store.dispatch("dataList/addItem", formData).catch(err => { console.error(err) })
            }

            this.$vs.notify({
              color: 'success',
              title: 'Successfull',
              text: 'Product updated successfully'
            })


            this.$emit('closeSidebar')
            this.initValues()
          }
      })
    },
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
       const ItemIndex = this.dataImg.findIndex((p) => p.id == this.ImageToDelete.id)
       this.dataImg.splice(ItemIndex, 1)
       this.deleteImage()

       this.$vs.notify({
         color: 'danger',
         title: 'Deleted image',
         text: 'The selected image was successfully deleted'
       })
     },
    updateCurrImg(input) {
      if (input.target.files && input.target.files[0]) {
        var reader = new FileReader()
        reader.onload = e => {
          this.dataUploadedImages           = input.target.files

          // this.dataImg.push(input.target.files[0])
          // this.dataImg = input.target.files[0]
          // this.dataImg = e.target.result

        }
        reader.readAsDataURL(input.target.files[0])
      }
    }
  },
  created() {
      this.getCategories()
  }
}
</script>

<style lang="scss" scoped>
.add-new-data-sidebar {
  ::v-deep .vs-sidebar--background {
    z-index: 52010;
  }

  ::v-deep .vs-sidebar {
    z-index: 52010;
    width: 420px;
    max-width: 90vw;

    .img-upload {
      margin-top: 2rem;

      .con-img-upload {
        padding: 0;
      }

      .con-input-upload {
        width: 100%;
        margin: 0;
      }
    }
  }
}


.scroll-area--data-list-add-new {
    // height: calc(var(--vh, 1vh) * 100 - 4.3rem);
    height: calc(var(--vh, 1vh) * 100 - 16px - 45px - 82px);

    &:not(.ps) {
      overflow-y: auto;
    }
}
</style>
