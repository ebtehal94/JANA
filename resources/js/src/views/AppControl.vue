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

                        <!-- Col Content -->
                         <div class="vx-row flex mt-4 mx-0 slider-img">
                            <div class="vx-col w-full md:w-1/4 add-img ">
                                <input type="file" class="hidden" ref="uploadImgInput" multiple @change="updateCurrImg" accept="image/*">
                                <vs-button v-if="dataUploadedImages.length === 0" class="text-gray mt-2 lg:mt-6 ml-10 lg:ml-16" icon-pack="feather" type="transparent" icon="icon-plus" @click="$refs.uploadImgInput.click()"/>
                                <h5 class="text-gray text-xs text-center">{{ $i18n.locale == 'en' ? 'Upload Image' : 'اضافة صورة' }}</h5>
                            </div>
                            <div class="vx-col w-full md:w-1/4">
                                <img src="@assets/images/payment-methods.png" alt="AppImage" class="w-full">
                                <vs-button style="position: absolute; bottom: 0; margin: 1rem;" @click="openConfirm(img)" icon-pack="feather" icon="icon-trash" size="small" color="danger" type="filled" />
                            </div>
                            <div class="vx-col w-full md:w-1/4">
                                <img src="@assets/images/card.png" alt="AppImage" class="w-full">
                            </div>
                            <div class="vx-col w-full md:w-1/4">
                                <img src="@assets/images/card.png" alt="AppImage" class="w-full">
                            </div>
                        </div>
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
                            v-model="appControl_data.terms_desc_ar" 
                            class="mt-2 p-2" 
                            height="120px"
                            name="terms_desc_ar"/>
                        </div>
                    </div>
                    <div class="vx-col w-full md:w-1/2">
                        <div class="flex items-end">
                            <span class="leading-none font-semibold text-sm">{{ $i18n.locale == 'en' ? 'Terms and Conditions (en)' : 'الشروط والأحكام باللغة الإنجليزية' }}</span>
                        </div>
                        <div class="mt-4">
                            <vs-textarea 
                            :placeholder="$t('desc_lable')"
                            v-model="appControl_data.terms_desc_en" 
                            class="mt-2 p-2" 
                            height="120px"
                            name="terms_desc_en"/>
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
                            v-model="appControl_data.about_desc_ar" 
                            class="mt-2 p-2" 
                            height="120px"
                            name="about_desc_ar"/>
                        </div>
                    </div>
                    <div class="vx-col w-full md:w-1/2">
                        <div class="flex items-end">
                            <span class="leading-none font-semibold text-sm">{{ $i18n.locale == 'en' ? 'About the Application (en)' : 'عن التطبيق باللغة الإنجليزية' }}</span>
                        </div>
                        <div class="mt-4">
                            <vs-textarea 
                            :placeholder="$t('desc_lable')"
                            v-model="appControl_data.about_desc_en" 
                            class="mt-2 p-2" 
                            height="120px"
                            name="about_desc_en"/>
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
export default {
    components: {

    },

    data() {
        return {
            appControl_data:{terms_desc_ar:null,terms_desc_en:null,about_desc_ar:null,about_desc_en:null},
            dataUploadedImages: [],
            dataUploadedImagesForDisplay: [],
            ImageToDelete: null,
        }
        
    },
    computed: {

    },
    methods: {
        updateCurrImg(input) {
            if (input.target.files && input.target.files[0]) {
                var reader = new FileReader()
                reader.onload = e => {
                this.dataUploadedImages= input.target.files
                console.log(input.target.files[0])
                }
                reader.readAsDataURL(input.target.files[0])
            }
        },
        save_changes(){
                // if(!this.validateForm) return
            let formData = new FormData();
            formData.append('terms_desc_ar', this.appControl_data.terms_desc_ar)
            formData.append('terms_desc_en', this.appControl_data.terms_desc_en)
            formData.append('about_desc_ar', this.appControl_data.about_desc_ar)
            formData.append('about_desc_en', this.appControl_data.about_desc_en)
            if (this.dataUploadedImages){
                for( var i = 0; i < this.dataUploadedImages.length; i++ ){
                let file = this.dataUploadedImages[i];
                formData.append('images[' + i + ']', file);
                }
            }

                if (this.appControl_data.id != null && this.appControl_data.id > 0){
                var link = "appControlManagement/updateAppinfo"
                }else{
                var link = "appControlManagement/addAppinfo"
                }
                this.$store.dispatch(link, formData)
                .then(res => {
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
        if(!moduleAppControlManagement .isRegistered) {
        this.$store.registerModule('appControlManagement', moduleAppControlManagement )
        moduleAppControlManagement .isRegistered = true

        this.$store.dispatch("appControlManagement/fetchAppinfo").catch(err => { console.error(err) })
        }
    }
    

}

</script>

<style lang="scss" scoped>
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
    }
    .add-img{
      border: 1px solid #b1b1b1;
      border-radius: 15px;
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