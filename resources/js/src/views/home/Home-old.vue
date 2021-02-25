
<template>
  <div id="shop-home-page">
    <!--Swiper-->
    <div class="w-full items-center justify-center">
      <div class="swiper-inner">
        <!-- swiper -->
        <swiper :options="mainSwiperOption" :dir="$vs.rtl ? 'rtl' : 'ltr'" :key="$vs.rtl">
            <swiper-slide v-for="img in getCustomImage('mainSectionImage')" :key="img.id" class="items-center">
              <!--<router-link tag="div" :to="img.url" class="vx-logo cursor-pointer mx-auto flex items-center">-->
                <img :src="'/images/pages/index/'+img.link" class="responsive swiper-img">
               <!--</router-link>-->
              <vs-button v-if="$acl.check('admin')" @click="openConfirm(img)" icon-pack="feather" icon="icon-trash" size="small" color="danger" type="filled">حذف الصورة</vs-button>
            </swiper-slide>
            <div class="swiper-pagination" slot="pagination"></div>
        </swiper>
        <div v-if="$acl.check('admin')" class="float-right">
          <input type="file" class="hidden" ref="uploadImgInput" multiple @change="updateCurrImg" accept="image/*">
          <vs-button v-if="dataUploadedImages.length === 0" class="admin-add-btn" size="small" icon-pack="feather" icon="icon-upload" @click="$refs.uploadImgInput.click()">اضافة صور</vs-button>
          <!--<vs-input v-if="dataUploadedImages.length > 0" class="my-2" icon-pack="feather" icon="icon-shopping-cart" icon-after vs-icon-after="true" label-placeholder="رابط المنتج" v-model="mainImageURL" />-->
          <vs-button class="admin-add-btn" v-if="dataUploadedImages.length > 0"  color="success" size="small" icon-pack="feather" icon="icon-save" @click="submitImage('mainSectionImage')">حفظ الصور</vs-button>
        </div>
      </div>
    </div>
    <!--Swiper-->

    <!-- Recently Added, Most Ordered, Latest Products -->
    <div id="featured-products">
      <div class="section new-groups" :style="sectionBackgroundImage(getImage('newGroupsImage'))">
        <div class="content">
          <h1>{{ $t('NewGroups') }}</h1>
          <vs-button class="action-btn w-full my-4 mr-1" color="primary" @click="$router.push('/all').catch(err => {})">{{ $t('ShopNow') }}</vs-button>
        </div>
        <div v-if="$acl.check('admin')" class="float-right">
          <input type="file" class="hidden" ref="uploadImgInputNG" multiple @change="updateCurrImg" accept="image/*">
          <vs-button class="admin-add-btn" color="success" size="small" icon-pack="feather" icon="icon-upload" @click="$refs.uploadImgInputNG.click()">تغيير الصورة</vs-button>
          <vs-button v-if="dataUploadedImages.length > 0" color="success" size="small" icon-pack="feather" icon="icon-save" @click="submitImage('newGroupsImage')">حفظ الصور</vs-button>
        </div>
      </div>

      <div class="section most-ordered" :style="sectionBackgroundImage(getImage('mostOrderedImage'))">
        <div class="content">
          <h1>{{ $t('MostOrdered') }}</h1>
          <vs-button class="action-btn w-full my-4 mr-1" color="primary" @click="$router.push('/all').catch(err => {})">{{ $t('ShopNow') }}</vs-button>
        </div>
        <div v-if="$acl.check('admin')" class="float-right">
          <input type="file" class="hidden" ref="uploadImgInputMO" multiple @change="updateCurrImg" accept="image/*">
          <vs-button class="admin-add-btn" color="success" size="small" icon-pack="feather" icon="icon-upload" @click="$refs.uploadImgInputMO.click()">تغيير الصورة</vs-button>
          <vs-button v-if="dataUploadedImages.length > 0" color="success" size="small" icon-pack="feather" icon="icon-save" @click="submitImage('mostOrderedImage')">حفظ الصور</vs-button>
        </div>
      </div>

      <div class="section latest" :style="sectionBackgroundImage(getImage('latestDealsImage'))">
        <div class="content">
          <h1>{{ $t('LatestDeals') }}</h1>
          <vs-button class="action-btn w-full my-4 mr-1" color="primary" @click="$router.push('/all').catch(err => {})">{{ $t('ShopNow') }}</vs-button>
        </div>
        <div v-if="$acl.check('admin')" class="float-right">
          <input type="file" class="hidden" ref="uploadImgInputLD" multiple @change="updateCurrImg" accept="image/*">
          <vs-button class="admin-add-btn" color="success" size="small" icon-pack="feather" icon="icon-upload" @click="$refs.uploadImgInputLD.click()">تغيير الصورة</vs-button>
          <vs-button v-if="dataUploadedImages.length > 0" color="success" size="small" icon-pack="feather" icon="icon-save" @click="submitImage('latestDealsImage')">حفظ الصور</vs-button>
        </div>
      </div>
    </div>

    <!-- Categories -->
    <div id="categories">
      <div class="separator">{{ $t('WebsiteSections') }}</div>
      <div class="grid-container">
        <div v-for="(category, index) in categories"  :key="category.id + '-' + category.icon" class="item" :style="sectionBackgroundImage(getImage(category.cat))">
          <div>
            <vs-button id="category-btn" class="w-full my-4 mr-1" color="primary" @click="$router.push({name: 'category', params: {category: category.cat }}).catch(() => {})">{{ ($i18n.locale == "en")? category.name_en : category.name_ar }}</vs-button>
            <div v-if="$acl.check('admin')" class="float-right">
              <input type="file" class="hidden" ref="uploadCatImgInput" multiple @change="updateCurrImg" accept="image/*">
              <vs-button class="admin-add-btn" color="success" size="small" icon-pack="feather" icon="icon-upload" @click="$refs.uploadCatImgInput[index].click()">تغيير الصورة</vs-button>
              <vs-button v-if="dataUploadedImages.length > 0" color="success" size="small" icon-pack="feather" icon="icon-save" @click="submitImage(category.cat)">حفظ الصور</vs-button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Featured Products -->
    <handpicked-products />


    <!-- Shop By Brand -->
    <shop-by-brand />

    <!--Countdown -->
    <countdown date="2020-08-31 23:59:59"></countdown>

    <!-- footer -->
    <home-footer />
  </div>
</template>

<script>
import axios from "@/axios.js"
import 'swiper/dist/css/swiper.min.css'
import { swiper, swiperSlide } from 'vue-awesome-swiper'


export default{
  components: {
    ItemGridView:           () => import("./components/ItemGridView.vue"),
    FeaturedProducts:       () => import("./components/FeaturedProducts.vue"),
    Categories:             () => import("./components/Categories.vue"),
    HandpickedProducts:     () => import("./components/HandpickedProducts.vue"),
    ShopByBrand:            () => import("./components/ShopByBrand.vue"),
    Countdown:              () => import("./components/Countdown.vue"),
    HomeFooter:             () => import("./components/HomeFooter.vue"),
    swiper,
    swiperSlide,
  },
  data() {
    return {
      /*algolia_index: algoliasearch(
        'SXG4PV0YAT',
        '42b8e7ea3e742f53ca29e378b2e53e38'
      ),*/
      editorOption: {
        theme: 'bubble',
      },
      s3Link: 'https://otantik-home.s3.me-south-1.amazonaws.com/pages/',
      customImages:[],
      mainSectionText: ``,

      middleSectionText: ``,

      mainImageURL:'',
      dataUploadedImages: [],
      mainSwiperOption: {
           spaceBetween: 30,
           centeredSlides: true,
           autoplay: {
               delay: 2500,
               disableOnInteraction: false
           },
           pagination: {
               el: '.swiper-pagination',
               clickable: true
           },
           navigation: {
               nextEl: '.swiper-button-next',
               prevEl: '.swiper-button-prev'
           }
       },

      // Related Products Swiper
      swiperOption: {
          slidesPerView: 5,
          spaceBetween: 55,
          breakpoints: {
              1600: {
                slidesPerView: 4,
                spaceBetween: 55,
              },
              1300: {
                slidesPerView: 3,
                spaceBetween: 55,
              },
              900: {
                  slidesPerView: 2,
                  spaceBetween: 55
              },
              640: {
                  slidesPerView: 1,
                  spaceBetween: 55
              }
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
          }
      },


        related_items: []
    }
  },
  computed: {
    categories () {
      return this.$store.state.CategoriesList
    },
    getImage() {
      return (section) => {
        if (this.getCustomImage(section)[this.getCustomImage(section).length - 1]) {
          return this.getCustomImage(section)[this.getCustomImage(section).length - 1].link
        } else {
          return ''
        }
      }
    },
    sectionBackgroundImage() {
      return (imageName) => {
        if (imageName != '') {
          return {
            'background': 'linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(' + s3Link + imageName + ') no-repeat center center/cover'
          }
        }

        return {
          'background': 'linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5))',
          'background-size': 'cover',
          'background-position': 'center center',
          'background-repeat': 'no-repeat',
        }
      }
    },
    getCustomImage () {
      return (section) => this.customImages.filter(customImage => {
        if (customImage.name.includes(section))  {
          return customImage
        }
      })
    },
    windowWidth() { return this.$store.state.windowWidth }
  },
  methods: {
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
       const ItemIndex = this.customImages.findIndex((p) => p.id == this.ImageToDelete.id)
       this.customImages.splice(ItemIndex, 1)
       this.deleteImage()

       this.$vs.notify({
         color: 'danger',
         title: 'Deleted image',
         text: 'The selected image was successfully deleted'
       })
     },
     deleteImage(image) {
       return new Promise((resolve, reject) => {
         axios.get("/api/pages/deleteImage/"+this.ImageToDelete.id)
           .then((response) => {
             resolve(response)
           })
           .catch((error) => { reject(error) })
       })
     },
     updateCurrImg(input) {
       console.log('test')
       if (input.target.files && input.target.files[0]) {
         var reader = new FileReader()
         reader.onload = e => {
           this.dataUploadedImages           = input.target.files
           console.log(input.target.files[0])

         }
         reader.readAsDataURL(input.target.files[0])
       }
     },
     submitImage(name) {
            let formData = new FormData();
            formData.append('name', name)
            //  formData.append('url', this.mainImageURL)
             formData.append('page', 'index')
             if (this.dataUploadedImages){
               for( var i = 0; i < this.dataUploadedImages.length; i++ ){
                 let file = this.dataUploadedImages[i];
                 formData.append('images[' + i + ']', file);
               }
             }

             axios.post(`/api/pages/addImages`, formData,
               {
                 headers: {
                     'Content-Type': 'multipart/form-data'
                 }
               })
               .then((response) => {
                 if (response.data.images){
                   for( var i = 0; i < response.data.images.length; i++ ){
                     let image = response.data.images[i];
                     this.customImages.push(image)
                   }

                   this.$vs.notify({
                     color: 'success',
                     title: 'Successfull',
                     position:'top-center',
                     text: 'تم حفظ الصور بنجاح'
                   })

                    window.location.reload()
                  }
               })

     },
     saveText(text){
       if (text == 'mainSectionText'){
         axios.post("/api/pages/edit", { name: 'mainSectionText', value: this.mainSectionText})
       .then((response) => {
         this.$vs.notify({
           color: 'success',
           title: 'Successfull',
           position:'top-center',
           text: 'تم حفظ التعديلات بنجاح'
         })
        })
      } else if (text == 'middleSectionText'){
        axios.post("/api/pages/edit", { name: 'middleSectionText', value: this.middleSectionText})
      .then((response) => {
        this.$vs.notify({
          color: 'success',
          title: 'Successfull',
          position:'top-center',
          text: 'تم حفظ التعديلات بنجاح'
        })
       })
     }
   }
 },
  created() {
    axios.post("/api/pages/view", { page: 'index' })
    .then((response) => {
      this.customImages = response.data.customImages
      // this.mainSectionText = response.data.mainSectionText[0]
      // this.middleSectionText = response.data.middleSectionText[0]
    })
    .catch((error)   => { console.log(error) });
  }
}
</script>

<style lang="scss">

@import "@sass/vuexy/_variables.scss";

#shop-home-page {
  margin: 0;

  .swiper-inner {
    height: 550px;

    img.swiper-img {
      height: 550px;
    }

    .admin-add-btn {
      position: absolute;
      top: 1rem;
      left: 1rem;
      z-index: 1;
    }
  }

  #featured-products {
    margin: 2rem .5rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    grid-gap: .25rem;
    height: 30rem;

    .section {
      position: relative;

      .content {
        position: absolute;
        bottom: 0;
        left: 0;
        padding: 1rem;

        h1 {
          color: #fff;
        }

        .action-btn {
          border-radius: 0;
        }
      }
    }

    .new-groups {
      grid-row: 1 / 3;
    }
    .most-ordered {
      grid-row: 1 / 2;
    }
    .latest {
      grid-row: 2 / 3;
    }
  }

  #categories {
    margin:  2rem 0.5rem;

    #category-btn {
      border-radius: 0;
      box-shadow: none;
    }

    .separator {
      display: flex;
      align-items: center;
      text-align: center;
      font-weight: bold;
      font-size: 1.2rem;
      margin-bottom: 1rem;
    }
    .separator::before, .separator::after {
      content: '';
      flex: 1;
      border-bottom: 1px solid #bd9c72;
    }
    .separator::before {
      margin-right: 1em;
    }
    .separator::after {
      margin-left: 1em;
    }

    .grid-container {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      grid-gap: 1rem;
      width: 100%;
    }

    .item {
      padding: 3rem;
      text-align: center;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 20rem;
    }
  }
}


@media only screen and (max-width: 600px) {
  #shop-home-page {
    .swiper-inner {
      height: 300px;

      img.swiper-img {
        height: 20rem;
      }
    }

    #featured-products {
      margin: 1rem .5rem;
    }

    #categories{
      .grid-container {
        display: grid;
        grid-template-columns: 1fr;
        width: 100%;
      }
    }
  }
}
</style>
