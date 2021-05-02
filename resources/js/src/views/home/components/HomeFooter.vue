<template>
    <div id="Home-Footer">
        <div
        :class="{ 'image-input' : $acl.check('admin') }"
        class="email-list"
        :style="[ !imageData ? !sectionImage ? { 'background': 'linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)) no-repeat center center/cover' } : {'background': 'linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(' + s3Link + sectionImage + ') no-repeat center center/cover'} : { 'background': 'linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(' + imageData + ') no-repeat center center/cover' }]">
            <p>{{ $i18n.locale == 'en' ? 'Subscribe to our email list for more offers' : 'إشترك في المزيد من العروض' }}</p>
            <div class="email-form">
                <vs-input
                      v-validate="'required|email|min:3'"
                      data-vv-validate-on="blur"
                      placeholder="ضع الإيميل الخاص بك"
                      v-model="email"
                      class="w-full" />
                  <span class="text-danger text-sm">{{ errors.first('email') }}</span>
                <vs-button class="email-btn" disabled>إشترك</vs-button>
            </div>
            <div v-if="$acl.check('admin')">
                <vs-button v-if="!imageData" color="warning" size="small" icon-pack="feather" icon="icon-edit" @click="chooseImage">{{ $t('EditImage') }}</vs-button>
                <vs-button v-if="imageData && !updated" color="success" size="small" icon-pack="feather" icon="icon-save" @click="submitImage()">{{ $t('Save') }}</vs-button>
                <input class="file-input" ref="fileInput" type="file" @input="onSelectFile">
            </div>
        </div>

        <div class="brands">
            <template >
                <div class="carousel-example">
                    <swiper :options="swiperOption" :dir="$vs.rtl ? 'rtl' : 'ltr'" :key="$vs.rtl">
                        <swiper-slide v-for="img in footerImages" :key="img.id" class="items-center">
                          <img :src="s3Link +img.link" width="100%" class="ml-auto">
                          <vs-button v-if="$acl.check('admin')" @click="openConfirm(img)" icon-pack="feather" icon="icon-trash" size="small" color="danger" type="flat">{{ $i18n.locale == 'en' ? 'Delete' : 'حذف' }}</vs-button>
                        </swiper-slide>
                        <swiper-slide v-for="img in dataUploadedImages" :key="img.data" class="items-center">
                          <img :src="img.url" width="100%" class="preview ml-auto">
                        </swiper-slide>
                    </swiper>
                </div>
            </template>
            <div>
                <input type="file" class="hidden" ref="uploadImgInput" multiple @change="updateCurrImg" accept="image/*">
                <vs-button v-if="$acl.check('admin') && dataUploadedImages.length === 0" size="small" icon-pack="feather" icon="icon-upload" @click="$refs.uploadImgInput.click()">{{ $i18n.locale == 'en' ? 'Upload Image' : 'رفع صورة' }}</vs-button>
                <vs-button class="admin-add-btn" v-if="dataUploadedImages.length > 0"  color="success" size="small" icon-pack="feather" icon="icon-save" @click="submitLogoImage()">{{ $i18n.locale == 'en' ? 'Save Uplaoded Images' : 'رفع الصور المحملة' }}</vs-button>
            </div>
        </div>

        <div class="footer-image">
            <img v-if="sectionFooterImage" :src="s3Link + sectionFooterImage" alt="footer image">
            <div v-if="$acl.check('admin')">
                <vs-button v-if="!footerImage" color="warning" size="small" icon-pack="feather" icon="icon-edit" @click="chooseFooterImage">{{ $t('EditImage') }}</vs-button>
                <vs-button v-if="footerImage && !updatedFooter" color="success" size="small" icon-pack="feather" icon="icon-save" @click="submitFooterImage()">{{ $t('Save') }}</vs-button>
                <input class="file-input" ref="fileFooterInput" type="file" @input="onSelectFooterFile">
            </div>
        </div>
    </div>
</template>

<script>
import axios from "@/axios.js"
import LogoCarousel from './LogoCarousel.vue'

import 'swiper/dist/css/swiper.min.css'
import { swiper, swiperSlide } from 'vue-awesome-swiper'

export default {
    data() {
        return {
            email: '',
            imageData: null,
            footerImage: null,
            imageFile: {},
            imageFooterFile: {},
            sectionImageData: [],
            sectionFooterImageData: [],
            sectionImage: '',
            sectionFooterImage: '',
            updated: false,
            updatedFooter: false,
            dataUploadedImages: [],
            s3Link: 'https://janacard.s3.eu-central-1.amazonaws.com/pages/',
            footerImages: [],
            swiperOption: {
                slidesPerView: 5,
                spaceBetween: 30,
                centeredSlides: true,
                autoplay: {
                    delay: 5000,
                },
            },
        }
    },
    components: {
        LogoCarousel,
        swiper,
        swiperSlide,
    },
    computed: {
        validateForm() {
            return !this.errors.any() && this.email != '';
        }
    },
    methods: {
        chooseImage () {
            if(this.$refs.fileInput && !this.imageData)
                this.$refs.fileInput.click()
        },
        chooseFooterImage () {
            if(this.$refs.fileFooterInput && !this.footerImage)
                this.$refs.fileFooterInput.click()
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
        onSelectFooterFile () {
            const input = this.$refs.fileFooterInput
            const files = input.files
            if (files && files[0]) {
                const reader = new FileReader
                reader.onload = e => {
                    this.footerImage = e.target.result
                    this.imageFooterFile = files[0]
                }
                reader.readAsDataURL(files[0])
                this.$emit('input', files[0])
            }
        },
        submitImage() {
            let formData = new FormData();

            formData.append('name', 'EmailImage')
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

                }
                reader.readAsDataURL(input.target.files[0])
            }
        },
        submitLogoImage() {
            let formData = new FormData();

            formData.append('name', 'FooterLogoImage')
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
                    this.footerImages.push(image)
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
        submitFooterImage() {
            let formData = new FormData();

            formData.append('name', 'FooterImage')
            formData.append('page', 'index')
            formData.append('image', this.imageFooterFile)

            if(this.sectionImageData.length > 0) {
                axios.post(`/api/pages/updateImage`, formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((response) => {
                    if (response.data.statusCode){
                        this.updatedFooter = true

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
                        this.updatedFooter = true

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
        }
    },
    created() {
        axios.post("/api/pages/view", { page: 'index' })
        .then((response) => {
            this.footerImages = response.data.customImages.filter(customImage => {
                if (customImage.name.includes('FooterLogoImage'))  {
                    return customImage
                }
            })

            this.sectionFooterImageData = response.data.customImages.filter(customImage => {
                if (customImage.name.includes('FooterImage'))  {
                    return customImage
                }
            })

            this.footerImages = response.data.customImages.filter(customImage => {
                if (customImage.name.includes('FooterLogoImage'))  {
                    return customImage
                }
            })

            if (this.sectionImageData.length > 0)
                this.sectionImage = this.sectionImageData[0].link

            if (this.sectionFooterImageData.length > 0)
                this.sectionFooterImage = this.sectionFooterImageData[0].link
        })
        .catch((error)   => { console.log(error) });
    },
}
</script>

<style lang="scss">
#Home-Footer {
    margin: 1rem 0;
    margin-top: 10rem;

    .email-list {
        padding: 2rem 1rem;

        > p {
            color: #fff;
        }

        > .email-form {
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 50%;

            .email-btn {
                margin-left: 1rem;
                border-radius: 5rem;
                padding: 0.5rem;
                width: 10rem;
            }
        }
    }

    .brands {
        background: #f4f4f4;
        padding: 2rem;
    }

    .footer-image {
        img {
            width: 100%;
        }
    }
}

@media only screen and (max-width: 600px) {
    #Home-Footer {
        .email-list {
            > .email-form {
            display: block;
            width: 100%;

            .email-btn {
                border-radius: 5rem;
                padding: 0.5rem;
                width: 22rem;
                margin: 1rem auto;
            }
        }
        }
    }
}
</style>
