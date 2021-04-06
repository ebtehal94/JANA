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
                                <img src="@assets/images/payment-methods.png" alt="Slider" class="w-full">
                            </div>
                            <div class="vx-col w-full md:w-1/4">
                                <img src="@assets/images/card.png" alt="Slider" class="w-full">
                            </div>
                            <div class="vx-col w-full md:w-1/4">
                                <img src="@assets/images/card.png" alt="Slider" class="w-full">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="vx-row mt-8">
                    <div class="vx-col w-full md:w-1/2">
                        <!-- Col Header -->
                        <div class="flex items-end">
                            <span class="leading-none font-semibold text-sm">{{ $i18n.locale == 'en' ? 'Terms and Conditions' : 'الشروط و الأحكام' }}</span>
                        </div>
                        <div class="mt-4">
                            <vs-textarea 
                            :placeholder="$t('desc_lable')"
                            v-model="terms_desc" 
                            class="mt-2 p-2" 
                            height="120px"
                            name="terms_desc"/>
                        </div>
                    </div>
                    <div class="vx-col w-full md:w-1/2">
                        <div class="flex items-end">
                            <span class="leading-none font-semibold text-sm">{{ $i18n.locale == 'en' ? 'About the Application' : 'عن التطبيق' }}</span>
                        </div>
                        <div class="mt-4">
                            <vs-textarea 
                            :placeholder="$t('desc_lable')"
                            v-model="about_desc" 
                            class="mt-2 p-2" 
                            height="120px"
                            name="about_desc"/>
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

export default {
    components: {

    },

    data() {
        return {
            terms_desc:'',
            about_desc:'',
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
            this.dataUploadedImages = input.target.files

                const url = URL.createObjectURL(this.dataUploadedImages[i])
                this.dataUploadedImages[i].url = url

            // this.dataImg.push(input.target.files[0])
            // this.dataImg = input.target.files[0]
            // this.dataImg = e.target.result

            }
            reader.readAsDataURL(input.target.files[0])
        }
        },
            submitImage(id) {
            let formData = new FormData();

            formData.append('product_id', id)

            if (this.dataUploadedImages){
            for( var i = 0; i < this.dataUploadedImages.length; i++ ){
                let file = this.dataUploadedImages[i];
                formData.append('images[' + i + ']', file);
            }
            }

            axios.post(`/api/products/addImages`, formData,
            {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
            })
            .then((response) => {
            this.dataUploadedImages = null

            this.$vs.notify({
                color: 'success',
                title: 'Successfull',
                position:'top-center',
                text: 'تم حفظ الصور بنجاح'
                })

                window.location.reload()
            }).catch((error) => console.log(error.response))

        },
        goBack(){
        this.$router.go(-1)
        },
        save_changes(){

        },
    },
    created() {

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