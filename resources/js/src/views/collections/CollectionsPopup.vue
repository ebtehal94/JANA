<!-- =========================================================================================
  File Name: AddNewDataPopup.vue
  Description: Add New Data - Popup component
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
  <vs-popup class="holamundo" :title=" Object.entries(this.data).length === 0 ? $t('AddNewCollection') : $t('EditCollection')" :active.sync="isPopupActiveLocal">
    <div class="vx-row ml-2">
      <vs-input class="w-1/3 mt-4 ml-2" label="Title (English)" v-model="dataTitleEn" v-validate="'required|alpha_spaces'" name="title" />
      <span class="text-danger text-sm p-4"  v-show="errors.has('title')">{{ errors.first('title') }}</span>
      <br/>
      <vs-input class="w-1/3 mt-4 ml-2" label="Title (Arabic)" v-model="dataTitleAr" v-validate="'required|alpha_spaces'" name="title" />
      <span class="text-danger text-sm p-4  mx-4"  v-show="errors.has('title')">{{ errors.first('title') }}</span>

    </div>

    <div class="vx-row">
      <div class="vx-col w-full">
        <div class="mt-8 flex flex-wrap items-center justify-end">
          <!-- <vs-button class="ml-auto mt-2" @click="updateDepartment()">{{ $t('Save')}}</vs-button> -->
          <vs-button class="mr-6" @click="submitData" :disabled="!isFormValid">Save</vs-button>
          <vs-button type="border" color="danger" @click="isPopupActiveLocal = false">Cancel</vs-button>
        </div>
      </div>
    </div>

    <div class="flex flex-wrap items-center p-6" slot="footer">
    </div>
  </vs-popup>
</template>

<script>
import axios from "@/axios.js"
import moduleCollections from "@/store/collections-list/moduleCollections.js"

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
      }
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
    initValues(){
      if(this.data.id) return
      return
    },
    submitData() {
      this.$validator.validateAll().then(result => {
          if (result) {
            // let formData = new FormData();
            const obj = {
              id: this.dataId,
              title_en: this.dataTitleEn,
              title_ar: this.dataTitleAr,
              sort: 1
            }

            if(this.dataId !== null && this.dataId >= 0) {
              this.$store.dispatch("collectionsData/updateItem", obj).catch(err => { console.error(err) })
            }else {
              this.$store.dispatch("collectionsData/addItem", obj).catch(err => { console.error(err) })
            }
            
            this.$vs.notify({
              color: 'success',
              title: 'Successfull',
              text: 'Department updated successfully'
            })


            this.$emit('closePopup')
            this.initValues()
          }
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
    if(!moduleCollections.isRegistered) {
      this.$store.registerModule('collectionsData', moduleCollections)
      moduleCollections.isRegistered = true

      // this.$store.dispatch("collectionsData/fetchCollections")
    }
  },
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
