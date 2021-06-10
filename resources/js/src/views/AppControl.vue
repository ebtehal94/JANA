<template>
    <div id="app-control">
         <vx-card class="mt-8 app-info">
            <div slot="no-body" class="tabs-container md:px-6 pt-6 md:pb-4">
                <div class="vx-row">
                    <div class="vx-col w-full">
                        <!-- Col Header -->
                        <div class="flex items-end">
                            <span class="leading-none font-semibold text-sm">{{ $i18n.locale == 'en' ? 'Slider Images' : 'صور السلايدر' }}</span>
                        </div>

                        <div class="vx-row flex mt-4 mx-0 slider-img">
                          <div class="vx-col w-full md:w-1/4 add-img ">
                              <input type="file" class="hidden" ref="uploadImgInput" multiple @change="updateCurrImg" accept="image/*">
                              <vs-button  class="text-gray mt-2 lg:mt-6 p-0" icon-pack="feather" type="transparent" icon="icon-plus" @click="$refs.uploadImgInput.click()"/>
                              <h5 class="text-gray text-xs text-center mb-4">{{ $i18n.locale == 'en' ? 'Upload Image' : 'اضافة صورة' }}</h5>
                          </div>
                          <div class="vx-col w-full md:w-1/4  mb-12 cardBox" v-for="image in appControl_images"  :key="image.link">
                            <vs-button class="cardTag text-danger mt-0" @click="openConfirm(image.id)" icon-pack="feather" icon="icon-trash-2" color="danger" type="flat" />
                            <img :src="imgLink + image.link"  alt=" " class="mx-auto w-full lg:responsive" width="120">
                          </div>
                          <div v-for="image in dataUploadedImages" :key="image.link" class="items-center vx-col w-full md:w-1/4 mb-12 cardBox">
                            <vs-button class="cardTag text-danger mt-0" @click="openConfirm(image.id)" icon-pack="feather" icon="icon-trash-2" color="danger" type="flat" />
                            <img :src="image.url" class="mx-auto w-full lg:responsive" width="120">
                          </div>
                          <!-- <div class="vx-col w-full mb-4">
                            <input type="file" class="hidden" ref="uploadImgInput" multiple @change="updateCurrImg" accept="image/*">
                            <vs-button v-if="dataUploadedImages.length === 0" size="small" color="linear-gradient(to left,#E93F7D,#DA6653)"
                            gradient class="rounded-full" icon-pack="feather" icon="icon-upload" @click="$refs.uploadImgInput.click()">{{ $i18n.locale == 'en' ? 'Upload Image' : 'رفع صورة' }}</vs-button>
                          </div> -->
                        </div>

                        <!-- Col Content -->
                         <!-- <div class="vx-row flex mt-4 mx-0 slider-img">
                            <div class="vx-col w-full md:w-1/4 add-img ">
                                <input type="file" class="hidden" ref="uploadImgInput" multiple @change="updateCurrImg" accept="image/*">
                                <vs-button v-if="dataUploadedImages.length === 0" class="text-gray mt-2 lg:mt-6 p-0" icon-pack="feather" type="transparent" icon="icon-plus" @click="$refs.uploadImgInput.click()"/>
                                <h5 class="text-gray text-xs text-center mb-4">{{ $i18n.locale == 'en' ? 'Upload Image' : 'اضافة صورة' }}</h5>
                            </div>
                            <div class="vx-col w-full md:w-1/4">
                                <img src="@assets/images/payment-methods.png" alt="AppImage" class="w-full">
                            </div>
                            <div class="vx-col w-full md:w-1/4">
                                <img src="@assets/images/card.png" alt="AppImage" class="w-full">
                            </div>
                            <div class="vx-col w-full md:w-1/4">
                                <img src="@assets/images/card.png" alt="AppImage" class="w-full">
                            </div>
                        </div> -->
                    </div>
                </div>

                <div class="vx-row mt-8">
                    <div class="vx-col w-full md:w-1/2"> 
                        <!-- Col Header -->
                        <div class="flex items-end">
                            <span class="leading-none font-semibold text-sm">{{ $i18n.locale == 'en' ? 'Terms and Conditions (ar)' : 'الشروط والأحكام باللغة العربية' }}</span>
                        </div>
                        <div class="mt-4">
                            <vs-textarea
                            :placeholder="$t('desc_lable')"
                            v-model="appControl_data.terms_ar"
                            class="mt-2"
                            height="120px"
                            name="terms_ar"/>
                        </div>
                    </div>
                    <div class="vx-col w-full md:w-1/2">
                        <div class="flex items-end">
                            <span class="leading-none font-semibold text-sm">{{ $i18n.locale == 'en' ? 'Terms and Conditions (en)' : 'الشروط والأحكام باللغة الإنجليزية' }}</span>
                        </div>
                        <div class="mt-4">
                            <vs-textarea
                            :placeholder="$t('desc_lable')"
                            v-model="appControl_data.terms_en"
                            class="mt-2"
                            height="120px"
                            name="terms_en"/>
                        </div>
                    </div>
                </div>

                <div class="vx-row mt-8">
                    <div class="vx-col w-full md:w-1/2">
                        <!-- Col Header -->
                        <div class="flex items-end">
                            <span class="leading-none font-semibold text-sm">{{ $i18n.locale == 'en' ? 'About the Application (ar)' : ' عن التطبيق باللغة العربية' }}</span>
                        </div>
                        <div class="mt-4">
                            <vs-textarea
                            :placeholder="$t('desc_lable')"
                            v-model="appControl_data.about_ar"
                            class="mt-2"
                            height="120px"
                            name="about_ar"/>
                        </div>
                    </div>
                    <div class="vx-col w-full md:w-1/2">
                        <div class="flex items-end">
                            <span class="leading-none font-semibold text-sm">{{ $i18n.locale == 'en' ? 'About the Application (en)' : 'عن التطبيق باللغة الإنجليزية' }}</span>
                        </div>
                        <div class="mt-4">
                            <vs-textarea
                            :placeholder="$t('desc_lable')"
                            v-model="appControl_data.about_en"
                            class="mt-2 "
                            height="120px"
                            name="about_en"/>
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
                    @click.stop="save_changes">
                        {{ $i18n.locale == 'en' ? 'Save Changes' : ' حفظ التغيرات' }}
                    </vs-button>

                    <vs-button
                    size="small"
                    class="mx-4 mb-4 font-semibold text-sm rounded-full px-28 close"
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
import moduleAppControlManagement from '@/store/appControl/moduleAppControlManagement.js'
import axios from "@/axios.js"

export default {
    components: {

    },

    data() {
        return {
            appControl_data:{terms_ar:null,terms_en:null,about_ar:null,about_en:null},
            appControl_images: [],
            dataUploadedImages: [],
            dataUploadedImagesForDisplay: [],
            ImageToDelete: null,
            imgLink: 'https://janacard.s3.eu-central-1.amazonaws.com/slider/',
        }

    },
    computed: {

    },
    methods: {
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
        //     if (input.target.files && input.target.files[0]) {
        //         var reader = new FileReader()
        //         reader.onload = e => {
        //         this.dataUploadedImages= input.target.files
        //         console.log(input.target.files[0])
        //         }
        //         reader.readAsDataURL(input.target.files[0])
        //     }
        // },
        openConfirm(id) {
          this.ImageToDelete = id;
           this.$vs.dialog({
             type: 'confirm',
             color: 'danger',
             title: `Delete Image`,
             text: 'Are you sure you want to permenantly delete this image?',
             accept: this.deleteImage
           })
         },
         deleteImage() {
           return new Promise((resolve, reject) => {
             axios.delete("/api/app/settings/deleteImage/"+ this.ImageToDelete)
               .then((response) => {
                 if (response.data.statusCode == 200){
                   this.$vs.notify({
                     color: 'success',
                     title: 'Deleted',
                     text: 'The selected image was successfully deleted'
                   })
                   const imageIndex = this.appControl_images.findIndex((u) => u.id == this.ImageToDelete)
                   this.appControl_images.splice(imageIndex, 1)
                   resolve(response)
                 }else{
                   this.$vs.notify({
                     color: 'danger',
                     title: 'Error',
                     text: 'Error'
                   })
                 }
               })
               .catch((error) => { reject(error) })
           })
            
         },
        save_changes(){
                // if(!this.validateForm) return
            let formData = new FormData();
            formData.append('terms_ar', this.appControl_data.terms_ar)
            formData.append('terms_en', this.appControl_data.terms_en)
            formData.append('about_ar', this.appControl_data.about_ar)
            formData.append('about_en', this.appControl_data.about_en)
            if (this.dataUploadedImages){
                for( var i = 0; i < this.dataUploadedImages.length; i++ ){
                let file = this.dataUploadedImages[i];
                formData.append('images[' + i + ']', file);
                }
            }

            axios.post("/api/app/settings/update", formData,
              {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
              })
              .then((res) => {
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
        axios.post("/api/app/settings/list")
          .then((res) => {
            this.appControl_data = res.data.settings
            this.appControl_images = res.data.images
          })
          .catch((error) => { reject(error) })

    }


}

</script>

<style lang="scss" scoped>
.cardBox{
  position: relative;
  
}
.cardTag{
  position: absolute;
  right: 0;
  top: -2.5rem;
  z-index: 999;
}

#app-control{
    margin: 2rem 2.5rem;
    .app-info {
        padding: 2.5rem;
    }
    .vx-card{
        box-shadow: none;
    }
    .vx-row{
        margin: 0;
    }
    .slider-img{
        img{
            width: 100%;
            position: relative;
        }
        .delete-img{
            position: absolute;
            top:50px;
            right: 50px;
            z-index: 999;
        }
    }
    .add-img{
    //   border: 1px solid #b1b1b1;
    //   border-radius: 15px;
      text-align: center;
      text-align: -webkit-center;
    }
    .vs-con-textarea{
        border-radius: 13px;
    }
    .vs-button.small:not(.includeIconOnly) {
      padding: 0.4rem 5rem;
    }
    @media only screen and (min-width: 360px) and (max-width: 767px) {
         .slider-img{
             img{
                margin-top: 1rem;
             }
             .vs-button.small:not(.includeIconOnly) {
                 margin-top: 1rem;
             }
        }
    }
}
</style>
