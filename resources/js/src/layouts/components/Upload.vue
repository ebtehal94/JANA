
<template>
  <div id="page-user-edit">
    <vx-card>
        <div class="vx-row">
         <div class="vx-col w-full">
            <div>
              <input type="file" class="hidden" ref="uploadImgInput" multiple @change="updateCurrImg" accept="image/*">
              <vs-button v-if="dataUploadedImages.length === 0" size="small" icon-pack="feather" icon="icon-upload" @click="$refs.uploadImgInput.click()">{{ $i18n.locale == 'en' ? 'Upload Image' : 'رفع صورة' }}</vs-button>
              <vs-button class="admin-add-btn" v-if="dataUploadedImages.length > 0"  color="success" size="small" icon-pack="feather" icon="icon-save" @click="submitImage(product_data.id)">{{ $i18n.locale == 'en' ? 'Save Uplaoded Images' : 'رفع الصور المحملة' }}</vs-button>
            </div>
          </div>

        </div>
      </vx-card>
  </div>
</template>

<script>
import '@desislavsd/vue-select/dist/vue-select.css'
import { vSelect } from '@desislavsd/vue-select'
import axios from "@/axios.js"
import moduleCollections from "@/store/collections-list/moduleCollections.js"



export default {
  components: {
    vSelect,
  },
  data() {
    return {
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
          this.dataUploadedImages           = input.target.files

          for (var i = 0; i < this.dataUploadedImages.length; i++) {
            const url = URL.createObjectURL(this.dataUploadedImages[i])
            this.dataUploadedImages[i].url = url
          }

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
    fetch_product_data(productId) {
      axios.get("/api/products/edit/" + productId)
        .then(res => {
                      //  this.filters             = res.data.filters
                       this.product_data        = res.data.product
                       this.product_images      = res.data.images
        })
        .catch(err => {
          if(err.response.status === 404) {
            this.product_not_found = true
            return
          }
          console.error(err) })
    },
    fetch_filters_data(){
      axios.get("/api/categories/filter/list")
      .then(res => {
        this.filters = res.data
      })
      .catch(err => {console.error(err) })
    },
    validateForm() {
      return !this.errors.any()
    },
    goBack(){
      this.$router.go(-1)
    },
    save_changes() {
      if(!this.validateForm) return
      let formData = new FormData();

        // formData.append('product', JSON.stringify(this.product_data))
        formData.append('title_en', this.product_data.title_en)
        formData.append('title_ar', this.product_data.title_ar)
        formData.append('desc_en', this.product_data.desc_en)
        formData.append('desc_ar', this.product_data.desc_ar)
        formData.append('code', this.product_data.code)
        formData.append('color', this.product_data.color)
        formData.append('size', this.product_data.size)

        if (this.product_data.category_id != null){
        formData.append('category_id', this.product_data.category_id)
        }
        if (this.product_data.collection_id != null){
        formData.append('collection_id', this.product_data.collection_id)
        }
        if (this.product_data.filter_id != null){
          formData.append('filter_id', this.product_data.filter_id)
        }

        if (this.dataUploadedImages){
          for( var i = 0; i < this.dataUploadedImages.length; i++ ){
            let file = this.dataUploadedImages[i];
            formData.append('images[' + i + ']', file);
          }
        }

      if(this.product_data.id !== null && this.product_data.id >= 0) {
        formData.append('id', this.product_data.id)
        this.$store.dispatch("dataList/updateItem", formData)
        .then((response) => {
          console.log(response)
          if( response[0].data.statusCode == 200 ){
            this.$vs.notify({
              color: 'success',
              title: 'Successfull',
              text: 'Product updated successfully'
            })
          }else if( response[0].data.statusCode == 402 ){
            this.$vs.notify({
              color: 'danger',
              title: 'Error',
              text: 'Product ID already exists'
            })
          }else{
            this.$vs.notify({
              color: 'danger',
              title: 'Error',
              text: 'Error updating'
            })
          }
        })
        .catch(err => { console.error(err) })
      }else{
        this.$store.dispatch("dataList/addItem", formData)
        .then((response) => {
          if( response.data.statusCode == 200 ){
            this.$vs.notify({
              color: 'success',
              title: 'Successfull',
              text: 'Product updated successfully'
            })
            this.$router.push({path: '/products/edit/' + response.data.product.id})
          }else if( response.data.statusCode == 402 ){
            this.$vs.notify({
              color: 'danger',
              title: 'Error',
              text: 'Product ID already exists'
            })
          }else{
            this.$vs.notify({
              color: 'danger',
              title: 'Error',
              text: 'Error updating'
            })
          }
        })
        .catch(err => { console.error(err) })
      }

    },
  },
  created() {
    if (this.$route.params.productId){
      this.fetch_product_data(this.$route.params.productId)
      this.fetch_filters_data()
    }

    if(!moduleCollections.isRegistered) {
      // this.$store.registerModule('dataList', moduleDataList)
      this.$store.registerModule('collectionsData', moduleCollections)
      moduleCollections.isRegistered = true

      this.$store.dispatch("collectionsData/fetchCollections")
    }
  }
}
</script>
