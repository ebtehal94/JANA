
<template>
  <div id="shop-home-page">
    <!--Swiper-->
    <div class="w-full items-center justify-center">
      <div class="swiper-inner">
        <!-- swiper -->
        <swiper :options="mainSwiperOption" :dir="$vs.rtl ? 'rtl' : 'ltr'" :key="$vs.rtl">
            <swiper-slide v-for="img in getCustomImage('mainSectionImage')" :key="img.id" class="items-center">
              <img :src="s3Link + img.link" class="responsive swiper-img">

              <vs-button style="position: absolute; bottom: 0; margin: 1rem;" v-if="$acl.check('admin')" @click="openConfirm(img)" icon-pack="feather" icon="icon-trash" size="small" color="danger" type="filled">{{ $t('deleteImage') }}</vs-button>
            </swiper-slide>
            <div class="swiper-pagination" slot="pagination"></div>
        </swiper>
        <div v-if="$acl.check('admin')" class="float-right">
          <input type="file" class="hidden" ref="uploadImgInput" multiple @change="updateCurrImg" accept="image/*">
          <vs-button v-if="dataUploadedImages.length === 0" class="admin-add-btn" size="small" icon-pack="feather" icon="icon-upload" @click="$refs.uploadImgInput.click()">{{ $t('uploadImage') }}</vs-button>
          <vs-button class="admin-add-btn" v-if="dataUploadedImages.length > 0"  color="success" size="small" icon-pack="feather" icon="icon-save" @click="submitImage('mainSectionImage')">{{ $t('Save') }}</vs-button>
        </div>
      </div>
    </div>
    <!--Swiper-->

    <!-- Featured Products -->
    <handpicked-products />


    <!-- Shop By Brand -->
    <shop-by-brand />

    <!-- Recently Added, Most Ordered, Latest Products -->
    <div id="featured-products">
      <image-with-info class="upper-cell" title="NewGroups" section="newGroupsImage" />
      <image-with-info class="lower-cell" title="MostOrdered" section="mostOrderedImage" />
      <image-with-info class="upper-cell" title="LatestDeals" section="latestDealsImage" />
      <image-with-info class="lower-cell" title="LimitedEdition" section="LimitedEditionImage" />
    </div>

    <!-- Categories -->
    <div id="categories">
      <div class="separator">{{ $t('WebsiteSections') }}</div>
      <div class="grid-container">
        <div v-for="(category) in categories" :key="category.id + '-' + category.icon">
          <category :section="category.cat" :category="category" ></category>
        </div>
      </div>
    </div>

    <!--Countdown -->
    <countdown :offer="specialOffer" section="CountDownImage"></countdown>

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
    Category:               () => import("./components/Category.vue"),
    HandpickedProducts:     () => import("./components/HandpickedProducts.vue"),
    ShopByBrand:            () => import("./components/ShopByBrand.vue"),
    Countdown:              () => import("./components/Countdown.vue"),
    HomeFooter:             () => import("./components/HomeFooter.vue"),
    ImageWithInfo:          () => import("./components/ImageWithInfo.vue"),
    swiper,
    swiperSlide,
  },
  data() {
    return {
      s3Link: 'https://otantik-home.s3.me-south-1.amazonaws.com/pages/',
      updateKey: false,
      specialOffer: {},
      editorOption: {
        theme: 'bubble',
      },
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
    })
    .catch((error)   => { console.log(error) })

    // get offer info
    axios.get("/api/pages/offer/list")
    .then((response) => {
      if(Object.keys(response.data).length > 0 || response.data != '')
        this.specialOffer = response.data
      else {
        this.specialOffer = {
          id: 0,
          title_ar: 'عرض خاص',
          title_en: 'Special Offer',
          desc_ar: 'عرض خاص عرض خاص عرض خاص',
          desc_en: 'Special Offer Text Here',
          link: '/all',
          deadline: '0000-00-00 00:00:00'
        }
      }
    })
    .catch((error)   => { console.log(error) })
  }
}
</script>

<style lang="scss">

// @import "@sass/vuexy/_variables.scss";

#shop-home-page {
  margin: 0;

  .vs-popup--header{
    background-color: #FEFEFE;
  }
  .swiper-inner {
    // height: 550px;
    margin: 2rem 1.5rem;
    //
    // img.swiper-img {
    //   height: 550px;
    // }

    .admin-add-btn {
      // position: absolute;
      // top: 1rem;
      // left: 1rem;
      // z-index: 1;
    }
  }

  #featured-products {
    margin: 2rem 1.5rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    grid-gap: .25rem;
    height: 30rem;

    .upper-cell {
      grid-row: 1 / 2;
    }
    .lower-cell {
      grid-row: 2 / 3;
    }
  }

  }

  #categories {
    margin:  2rem 1.5rem;

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
}


@media only screen and (max-width: 600px) {
  #shop-home-page {
        .swiper-inner {
      // height: 300px;

      // img.swiper-img {
      //   height: 20rem;
      // }
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
