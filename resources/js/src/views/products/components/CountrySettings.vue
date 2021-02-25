
<template>
  <div id="page-user-edit">
    <vx-card class="mt-4" :title="$t(country.name_en)">
      <div class="vx-row">
        <div class="vx-col md:w-1/3 w-full">
          <label class="vs-input-label">{{$t('UnitPrice')}}</label>
          <vs-input class="w-full mb-4" v-model="country_data.price"/>
          <span class="text-danger text-sm"  v-show="errors.has('price')">{{ errors.first('price') }}</span>
        </div>
        <div class="vx-col md:w-1/3 w-full">
          <label class="vs-input-label">{{$t('Discount')}}</label>
          <vs-input class="w-full mb-4" v-model="country_data.discount"/>
          <span class="text-danger text-sm"  v-show="errors.has('discount')">{{ errors.first('discount') }}</span>
        </div>
        <div class="vx-col md:w-1/3 w-full">
          <label class="vs-input-label">{{$t('TotalPrice')}}</label>
          <vs-input class="w-full mb-4" v-model="totalPrice" disabled="true"/>
        </div>
        <div class="vx-col md:w-1/3 w-full">
          <label class="vs-input-label">{{$t('AvailableStock')}}</label>
          <vs-input class="w-full mb-4" v-model="country_data.stock"/>
          <span class="text-danger text-sm"  v-show="errors.has('stock')">{{ errors.first('stock') }}</span>
        </div>
        <!-- ORDER STATUS -->
        <div class="vx-col md:w-1/3 w-full">
          <label class="vs-input-label">{{$t('Status')}}</label>
          <v-select v-model="country_data.status" class="mb-4" as="label:value:value" :from="status_options" tagging></v-select>
        </div>
      </div>
    </vx-card>
    <!-- Save & Reset Button -->
    <div class="vx-row">
      <div class="vx-col w-full">
        <div class="mt-8 flex flex-wrap items-center justify-end">
          <vs-button class="ml-auto mt-2" @click="save_changes" :disabled="!validateForm">{{ $t('Save') +' '+ $t('CountrySettings')}}</vs-button>
          <vs-button class="ml-4 mt-2" type="border" color="warning" @click="goBack">{{ $t('Cancel')}}</vs-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import '@desislavsd/vue-select/dist/vue-select.css'
import { vSelect } from '@desislavsd/vue-select'
import axios from "@/axios.js"

// Store Module
export default {
  props: {
    country: {
      required: true
    },
    product_id: {
      required: false
    },
    saved_country_data: {
      required: false
    },
  },
  components: {
    vSelect
  },
  data() {
    return {
      country_data: (this.saved_country_data !== null) ? this.saved_country_data : {country_id: this.country.id, price: null, discount: null, status: null},
      status_options: [
        {label:this.$t('Active'), value:0},
        {label:this.$t('FeaturedProduct'), value:1},
        {label:this.$t('OutOfStock'), value:2},
        {label:this.$t('SpecialOffer'), value:3},
        {label:this.$t('LimitedEdition'), value:4},
        {label:this.$t('Hidden'), value:5},
      ],
    }
  },
  computed: {
    totalPrice (){
      if (this.country_data.price > 0) return this.country_data.price - (this.country_data.discount || 0)
    }
  },
  methods: {
    validateForm() {
      return !this.errors.any()
    },
    goBack(){
      this.$router.go(-1)
    },
    save_changes() {
      if(!this.validateForm) return

        axios.post("/api/products/countrySettings/update", {country_data: this.country_data,
                                                    product_id: this.product_id})
        .then(res => {
                      if( res.data.statusCode == 200 ){
                      this.$vs.notify({
                        color: 'success',
                        title: 'Successfull',
                        text: 'Product updated successfully'
                      })
                      // this.$router.go(-1)
                    }else{
                      this.$vs.notify({
                        color: 'danger',
                        title: 'Error',
                        text: 'Error updating employee'
                      })
                    }
                     })
        .catch(err => { console.error(err) })
    },
  },
  created() {
    console.log(this.country_data)
  }
}
</script>
