<template id="countdown-template">
  <div>
    <div
    :class="{ 'image-input' : $acl.check('admin') }"
    class="deal-container w-full m-0"
    :style="[ !imageData ? !sectionImage ? { 'background': 'linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)) no-repeat center center/cover' } : {'background': 'linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(' + s3Link + sectionImage + ') no-repeat center center/cover'} : { 'background': 'linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(' + imageData + ') no-repeat center center/cover' }]">
    <div class="countdown">
      <div class="block">
      <p class="digit">{{ days | two_digits }}</p>
      <p class="text">{{ $t('Countdown.days') }}</p>
      </div>
      <div class="block">
      <p class="digit">{{ hours | two_digits }}</p>
      <p class="text">{{ $t('Countdown.hours') }}</p>
      </div>
      <div class="block">
      <p class="digit">{{ minutes | two_digits }}</p>
      <p class="text">{{ $t('Countdown.minutes') }}</p>
      </div>
      <div class="block">
      <p class="digit seconds">{{ seconds | two_digits }}</p>
      <p class="text seconds">{{ $t('Countdown.seconds') }}</p>
      </div>
      <div class="deal-content">
        <offer-popup :popupActive="popupActive" @closePopup="toggleDataPopup" :data="offer" />

        <h1>{{ $i18n.locale == 'en' ? offer.title_en : offer.title_ar }}</h1>
        <p>{{ $i18n.locale == 'en' ? offer.desc_en : offer.desc_ar }}</p>
        <vs-button
        class="action-btn w-full my-4 mr-1"
        color="primary"
        @click="$router.push(offer.link).catch(err => {})"
        :disabled="$acl.check('admin')">{{ $t('ShopNow') }}</vs-button>
        <vs-button v-if="$acl.check('admin')" color="warning" size="small" icon-pack="feather" icon="icon-edit" @click="editOffer">{{ $t('Edit') }}</vs-button>
      </div>
      <div style="position: relative" v-if="$acl.check('admin')">
        <vs-button style="position: absolute; bottom: 0; margin: 1rem;" v-if="!imageData" color="warning" size="small" icon-pack="feather" icon="icon-edit" @click="chooseImage">{{ $t('EditImage') }}</vs-button>
        <vs-button style="float: left !important; margin: 1rem;" v-if="imageData && !updated" color="success" size="small" icon-pack="feather" icon="icon-save" @click="submitImage('CountDownImage')">{{ $t('Save') }}</vs-button>
        <input class="file-input" ref="fileInput" type="file" @input="onSelectFile">
      </div>
      </div>
    </div>

  </div>
</template>

<script>
import axios from "@/axios.js"
import OfferPopup from './OfferPopup.vue'

export default {
  props: {
    offer: {
      type: Object
    }
  },
  components: {
    OfferPopup,
  },
  data() {
    return {
      now: Math.trunc((new Date()).getTime() / 1000),
      imageData: null,
      imageFile: {},
      sectionImageData: [],
      sectionImage: '',
      s3Link: 'https://janacard.s3.eu-central-1.amazonaws.com/pages/',
      updated: false,
      popupActive: false,
    }
  },
  computed: {
    dateInMilliseconds() {
      return Math.trunc(Date.parse(this.offer.deadline) / 1000)
    },
    seconds() {
      return (this.dateInMilliseconds - this.now) % 60;
    },
    minutes() {
      return Math.trunc((this.dateInMilliseconds - this.now) / 60) % 60;
    },
    hours() {
      return Math.trunc((this.dateInMilliseconds - this.now) / 60 / 60) % 24;
    },
    days() {
      return Math.trunc((this.dateInMilliseconds - this.now) / 60 / 60 / 24);
    },
    dealsBackgroundImage() {
      return (imageName) => {
        return {
          'background': 'linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(' + require('@assets/images/sections/' + imageName) + ')',
          'background-size': 'cover',
          'background-position': 'center center',
          'background-repeat': 'no-repeat',
        }
      }
    }
  },
  methods: {
    chooseImage () {
      if(this.$refs.fileInput && !this.imageData)
        this.$refs.fileInput.click()
    },
    onSelectFile () {
      const input = this.$refs.fileInput
      const files = input.files
      if (files && files[0]) {
          const reader = new FileReader
          reader.onload = e => {
              this.imageData = e.target.result
              this.imageFile = files[0]
          }
          reader.readAsDataURL(files[0])
          this.$emit('input', files[0])
      }
    },
    submitImage() {
      let formData = new FormData();

      formData.append('name', 'CountDownImage')
      formData.append('page', 'index')
      formData.append('image', this.imageFile)

      if(this.sectionImageData.length > 0) {
          axios.post(`/api/pages/updateImage`, formData,
          {
              headers: {
                  'Content-Type': 'multipart/form-data'
              }
          })
          .then((response) => {
              if (response.data.statusCode){
                  this.updated = true

                  this.$vs.notify({
                      color: 'success',
                      title: 'Successfull',
                      position:'top-center',
                      text: 'تم حفظ الصور بنجاح'
                  })

                  // window.location.reload()
              }
          }).catch(err => console.log(err.response))
      } else {
          axios.post(`/api/pages/createImage`, formData,
          {
              headers: {
                  'Content-Type': 'multipart/form-data'
              }
          })
          .then((response) => {
              if (response.data.statusCode){
                  this.updated = true

                  this.$vs.notify({
                      color: 'success',
                      title: 'Successfull',
                      position:'top-center',
                      text: 'تم حفظ الصور بنجاح'
                  })

                  // window.location.reload()
              }
          }).catch(err => console.log(err.response))
      }
    },
    editOffer(){
      this.popupData = this.offer
      this.toggleDataPopup(true)
    },
    toggleDataPopup(val=false) {
      this.popupActive = val
    },
  },
  mounted() {
    window.setInterval(() => {
      this.now = Math.trunc((new Date()).getTime() / 1000);
    },1000);
  },
  filters: {
    two_digits: (value) => {
      if (value < 0) {
          return '00';
      }
      if (value.toString().length <= 1) {
          return `0${value}`;
      }
      return value;
    }
  },
  created() {
        axios.post("/api/pages/view", { page: 'index' })
        .then((response) => {
            this.sectionImageData = response.data.customImages.filter(customImage => {
                if (customImage.name.includes('CountDownImage'))  {
                    return customImage
                }
            })

            if (this.sectionImageData.length > 0)
                this.sectionImage = this.sectionImageData[0].link
        })
        .catch((error)   => { console.log(error) });
    },
}
</script>

<style lang="scss" scoped>
@import url(https://fonts.googleapis.com/css?family=Roboto+Condensed:400|Roboto:100);

.deal-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 20rem;
  position: relative;

  .countdown {
    display: flex;

    .block {
      display: flex;
      flex-direction: column;
      margin: 20px;

      .text {
        color: #fff;
        font-size: 15px;
        font-family: 'Roboto Condensed', serif;
        font-weight: 40;
        margin-top:10px;
        margin-bottom: 10px;
        text-align: center;
      }

      .digit {
        color: #ecf0f1;
        font-size: 50px;
        font-weight: 100;
        font-family: 'Roboto', serif;
        margin: 10px;
        text-align: center;
      }

      .seconds {
        color: #bd9c72;
      }
    }
  }

  .deal-content {
    margin: 0 2rem;

    h1 {
      color: #fff;
      margin-bottom: 1rem;
    }

    p {
      color: #fff;
      margin-bottom: 1rem;
    }

    .action-btn {
      border-radius: 0;
      box-shadow: none;
    }
  }

  .image-input {
    display: block;
    cursor: pointer;
    background-size: cover;
    background-position: center center;
  }

  .placeholder {
    background: transparent;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    font-size: 18px;
    font-family: Helvetica;
  }

  .file-input {
    display: none;
  }
}



@media only screen and (max-width: 600px) {
  .deal-container {
    display: block;

    .countdown {
      .block {
        margin: 0;
        .digit {
          color: #ecf0f1;
          font-size: 10px;
          margin: 0;
        }
      }
    }
  }
}
</style>
