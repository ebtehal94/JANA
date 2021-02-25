<template id="image-input">
    <div :class="{ 'image-input' : $acl.check('admin') }"
    class="section"
    :style="[ !imageData ? !sectionImage ? { 'background': 'linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)) no-repeat center center/cover' } : {'background': 'linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(' + s3Link + sectionImage + ') no-repeat center center/cover'} : { 'background': 'linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(' + imageData + ') no-repeat center center/cover' }]"
    @click="chooseImage">
        <div class="content">
            <h1>{{ $t(title) }}</h1>
            <vs-button :disabled="$acl.check('admin')" class="action-btn w-full my-4 mr-1" color="primary" @click="$router.push('/all').catch(err => {})">{{ $t('ShopNow') }}</vs-button>
        </div>
        <div v-if="$acl.check('admin')">
            <span v-if="!imageData" class="placeholder">Click to Change Image</span>
            <vs-button style="float: left !important; margin: 1rem;" v-if="imageData && !updated" color="success" size="small" icon-pack="feather" icon="icon-save" @click="submitImage(section)">{{ $t('Save') }}</vs-button>
            <input class="file-input" ref="fileInput" type="file" @input="onSelectFile">
        </div>
    </div>
</template>

<script>
import axios from "@/axios.js"

export default {
    props: {
        section: String,
        title: String,
    },
    data() {
        return {
            imageData: null,
            imageFile: {},
            sectionImageData: [],
            sectionImage: '',
            s3Link: 'https://otantik-home.s3.me-south-1.amazonaws.com/pages/',
            updated: false,
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
        submitImage(section) {
            let formData = new FormData();

            formData.append('name', section)
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
        }
    },
    created() {
        axios.post("/api/pages/view", { page: 'index' })
        .then((response) => {
            this.sectionImageData = response.data.customImages.filter(customImage => {
                if (customImage.name.includes(this.section))  {
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

<style lang="scss">
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
</style>
