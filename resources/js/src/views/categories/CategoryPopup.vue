<!-- =========================================================================================
  File Name: AddNewDataPopup.vue
  Description: Add New Data - Popup component
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
  <vs-popup class="holamundo" :title=" this.data.hasOwnProperty('id') ? $t('Edit') : this.data.hasOwnProperty('category_id') ? $t('NewFilter') : $t('Edit')" :active.sync="isPopupActiveLocal">
    <div class="vx-row ml-2">
      <vs-input class="w-1/3 mt-4 ml-2" :label="$t('TitleEnglish')" v-model="dataTitleEn" v-validate="'required|alpha_spaces'" name="title" />
      <span class="text-danger text-sm p-4"  v-show="errors.has('title')">{{ errors.first('title') }}</span>
      <br/>
      <vs-input class="w-1/3 mt-4 ml-2" :label="$t('TitleArabic')" v-model="dataTitleAr" v-validate="'required|alpha_spaces'" name="title" />
      <span class="text-danger text-sm p-4  mx-4"  v-show="errors.has('title')">{{ errors.first('title') }}</span>
    </div>

    <div class="vx-row">
      <div class="vx-col w-full">
        <div class="mt-8 flex flex-wrap items-center justify-end">
          <vs-button class="mr-6" @click="submitData" :disabled="!isFormValid">{{ $t('Save') }}</vs-button>
          <vs-button type="border" color="danger" @click="isPopupActiveLocal = false">{{ $t('Cancel') }}</vs-button>
        </div>
      </div>
    </div>

    <div class="flex flex-wrap items-center p-6" slot="footer">
    </div>
  </vs-popup>
</template>

<script>
import axios from "@/axios.js"
import moduleDataList from "@/store/categories-list/moduleDataList.js"



export default {
  props: {
    popupActive: {
      type: Boolean,
      required: true
    },
    data: {
      type: Object,
      default: () => {},
    }
  },
  // components: {
  //   flatPickr,
  // },
  data() {
    return {
      dataId: null,
      dataTitleEn: '',
      dataTitleAr: '',
      dataImg: null,
      categoryId: null,
      // dataOffdays: [],
      // dataTitle: '',
      // dataFrom: '',
      // dataTo: '',
      // configdateTimePicker: {
      //   enableTime: true,
      //   enableSeconds: false,
      //   noCalendar: true
      // },
    }
  },
  watch: {
    popupActive(val) {
      if(!val) return
      if(Object.entries(this.data).length === 0) {
        // this.initValues()
        return
      }else {
        // let { id, offdays, title, from, to } = JSON.parse(JSON.stringify(this.data))
        this.dataId = this.data.id
        this.dataTitleEn = this.data.title_en
        this.dataTitleAr = this.data.title_ar
        this.dataImg = this.data.img
        this.categoryId = this.data.category_id
        this.filterId = this.data.filter_id
        // this.initValues()
      }
      // Object.entries(this.data).length === 0 ? this.initValues() : { this.dataId, this.dataName, this.dataCategory, this.dataStatus, this.dataPrice } = JSON.parse(JSON.stringify(this.data))
    }
  },
  computed: {
    isFormValid() {
      return !this.errors.any()
    },
    isPopupActiveLocal: {
      get() {
        return this.popupActive
      },
      set(val) {
        if(!val) {
          this.$emit('closePopup')
          // this.$validator.reset()
          // this.initValues()
        }
      }
    }
  },
  methods: {
    updateCurrImg(){
    },
    initValues(){
      if(this.data.id) return
      return
      // return new Promise((resolve, reject) => {
      //   axios.get("/api/accounts/defaults/"+ this.$store.state.AppActiveUser.account_id)
      //     .then((response) => {
      //       this.dataId = null
      //       this.dataTitle = null
      //       this.dataOffdays = response.data.offdays
      //       this.dataFrom = response.data.from
      //       this.dataTo   = response.data.to
      //       this.$validator.reset()
      //       resolve(response)
      //     })
      //     .catch((error) => { reject(error) })
      // })
    },
    submitData() {
      this.$validator.validateAll().then(result => {
          if (result) {
            // let formData = new FormData();
            const obj = {
              id: this.dataId,
              title_en: this.dataTitleEn,
              title_ar: this.dataTitleAr,
              // image: this.dataImg,
            }
            
            if (this.filter_id !== null && this.filterId >= 0 && this.categoryId !== null && this.categoryId >= 0) {
              obj['category_id'] = this.categoryId
              this.$store.dispatch("categoriesData/updateFilter", obj).catch(err => { console.log(err.response) })
            } else if (this.categoryId !== null && this.categoryId >= 0 && this.filterId == null) {
              obj['category_id'] = this.categoryId
              this.$store.dispatch("categoriesData/addFilter", obj).catch(err => { console.log(err.response) })
            } else if(this.dataId !== null && this.dataId >= 0) {
              this.$store.dispatch("categoriesData/updateItem", obj).catch(err => { console.log(err.response) })
            } else {
              this.$store.dispatch("categoriesData/addItem", obj).catch(err => { console.log(err.response) })
            }


            this.$vs.notify({
              color: 'success',
              title: 'Successfull',
              text: 'Department updated successfully'
            })


            this.$emit('closePopup')
            this.initValues()
            window.location.reload()
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
     }
  },
  created() {
    if(!moduleDataList.isRegistered) {
      this.$store.registerModule('categoriesData', moduleDataList)
      moduleDataList.isRegistered = true

      // this.$store.dispatch("collectionsData/fetchCollections")
    }
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
    width: 400px;
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
