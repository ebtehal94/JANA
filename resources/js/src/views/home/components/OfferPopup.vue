<template>
  <vs-popup class="holamundo" :title=" Object.entries(this.data).length === 0 ? $t('AddNew') : $t('Edit')" :active.sync="isPopupActiveLocal">
    <div class="vx-row w-full">
      <div class="vx-col md:w-1/2 w-full mt-10">
        <div class="vx-row px-8">
          <label class="vs-input-label">{{$t('TitleArabic') + ' '}}</label>
          <vs-input class="w-full mb-4" v-model="dataTitleAr" v-validate="'required|alpha_spaces'" name="name" />
          <span class="text-danger text-sm" v-show="errors.has('title_ar')">{{ errors.first('title_ar') }}</span>

          <label class="vs-input-label">{{ $t('DescEN') }}</label>
          <vs-textarea v-model="dataDescAr" class="mt-2 w-full px-8" name="desc_ar"/>
          <span class="text-danger text-sm" v-show="errors.has('desc_ar')">{{ errors.first('desc_ar') }}</span>

          <label class="vs-input-label">{{ $i18n.locale == 'en' ? 'Link' : 'رابط العرض' }}</label>
          <vs-input class="w-full mb-4" v-model="dataLink" v-validate="'required|alpha_spaces'" name="name" />
          <span class="text-danger text-sm" v-show="errors.has('link')">{{ errors.first('link') }}</span>
        </div>
      </div>

      <div class="vx-col md:w-1/2 w-full mt-10">
        <div class="vx-row px-8">
          <label class="vs-input-label">{{$t('TitleEnglish') + ' '}}</label>
          <vs-input class="w-full mb-4" v-model="dataTitleEn" v-validate="'required|alpha_spaces'" name="name" />
          <span class="text-danger text-sm" v-show="errors.has('title_ar')">{{ errors.first('title_ar') }}</span>

          <label class="vs-input-label">{{ $t('DescAR') }}</label>
          <vs-textarea v-model="dataDescEn" class="mt-2 w-full px-8" name="desc_en"/>
          <span class="text-danger text-sm" v-show="errors.has('desc_en')">{{ errors.first('desc_en') }}</span>

          <label class="vs-input-label d-block">{{ $i18n.locale == 'en' ? 'Expire Date' : 'تاريخ الإنتهاء' }}</label>
          <input class="date-input" type="date" v-model="date">
          <input class="date-input" type="time" v-model="time">
        </div>
      </div>
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
      dataDescAr: '',
      dataDescEn: '',
      dataLink: '',
      dataDeadline: '',
      date: '',
      time: '',
      datetime: [],
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
        this.dataDescEn = this.data.desc_en
        this.dataDescAr = this.data.desc_ar
        this.dataLink = this.data.link
        this.datetime = this.data.deadline.split(' ');
        this.date = this.datetime[0]
        this.time = this.datetime[1]
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
        const obj = {
          offer_id: this.dataId,
          title_ar: this.dataTitleAr,
          title_en: this.dataTitleEn,
          desc_ar: this.dataDescAr,
          desc_en: this.dataDescEn,
          link: this.dataLink,
          deadline: this.date + ' ' + this.time,
        }

        axios.post(`/api/pages/offer/update`, obj)
        .then((response) => {
          if (response.data.statusCode == 200){
            this.$vs.notify({
                color: 'success',
                title: 'Successfull',
                position:'top-center',
                text: 'تم تعديل المعلومات بنجاح'
            })

            window.location.reload()
          }
        }).catch(err => console.log(err.response))

        this.$emit('closePopup')
        this.initValues()
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

  .date-input {
    width: 100%;
    border: 1px solid #ccc;
    padding: .5rem !important;
    border-radius: .25rem !important;
  }

.scroll-area--data-list-add-new {
    // height: calc(var(--vh, 1vh) * 100 - 4.3rem);
    height: calc(var(--vh, 1vh) * 100 - 16px - 45px - 82px);

    &:not(.ps) {
      overflow-y: auto;
    }
}
</style>
