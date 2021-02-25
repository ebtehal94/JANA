
<template>
  <div id="page-user-edit">
    <vx-card>
        <div class="vx-row">
          <div class="vx-col md:w-1/2 w-full mt-8">
            <div class="vx-row px-8">
              <label class="vs-input-label">{{ $i18n.locale == 'en' ? 'Code' : 'الكود' }} <span class="text-danger">*</span></label>
              <vs-input class="w-full mb-4" v-model="promo_data.code" v-validate="'required|alpha_spaces'" name="name" />
              <span class="text-danger text-sm" v-show="errors.has('code')">{{ errors.first('code') }}</span>

              <label class="vs-input-label">{{ $i18n.locale == 'en' ? 'Amount' : 'القيمة' }} <span class="text-danger">*</span></label>
              <vs-input class="w-full mb-4" v-model="promo_data.amount" v-validate="'required|alpha_spaces'" />
              <span class="text-danger text-sm" v-show="errors.has('amount')">{{ errors.first('amount') }}</span>

              <div class="w-full mt-2">
                <label class="vs-input-label">{{ $i18n.locale == 'en' ? 'Type' : 'النوع' }} <span class="text-danger">*</span></label>
                <v-select v-model="promo_data.type" class="mb-4" as="value:id:id" :from="types" tagging></v-select>
              </div>

              <label class="vs-input-label d-block">{{ $i18n.locale == 'en' ? 'Expire Date' : 'تاريخ الإنتهاء' }} <span class="text-danger">*</span></label>
              <input class="date-input" type="date" v-model="promo_data.expires_at">
            </div>
          </div>

          <div class="vx-col md:w-1/2 w-full mt-8">
            <div class="vx-row px-8">
              <label class="vs-input-label">{{ $i18n.locale == 'en' ? 'Min. Discount Price' : 'قيمة المشتريات الصغري' }} </label>
              <vs-input class="w-full mb-4" v-model="promo_data.min_price" v-validate="'required|alpha_spaces'" />
              <span class="text-danger text-sm" v-show="errors.has('min_price')">{{ errors.first('min_price') }}</span>

              <label class="vs-input-label">{{ $i18n.locale == 'en' ? 'Max. Discount Price' : 'قيمة المشتريات الكبري' }}</label>
              <vs-input class="w-full mb-4" v-model="promo_data.max_discount" v-validate="'required|alpha_spaces'" />
              <span class="text-danger text-sm" v-show="errors.has('max_discount')">{{ errors.first('max_discount') }}</span>

              <div class="w-full mt-2">
                <label class="vs-input-label">{{ $i18n.locale == 'en' ? 'Status' : 'الحالة' }} <span class="text-danger">*</span></label>
                <v-select v-model="promo_data.status" class="mb-4" as="value:id:id" :from="stats" tagging></v-select>
              </div>
            </div>
          </div>
        </div>

        <!-- Save & Reset Button -->
        <div class="vx-row">
          <div class="vx-col w-full">
            <div class="mt-8 flex flex-wrap items-center justify-end">
              <vs-button class="ml-auto mt-2" @click="save_changes" :disabled="!validateForm">{{ $t('Save') +' '+ $t('GeneralInfo')}}</vs-button>
              <vs-button class="ml-4 mt-2" type="border" color="warning" @click="goBack">{{ $t('Cancel')}}</vs-button>
            </div>
          </div>
        </div>
      </vx-card>
  </div>
</template>

<script>
import '@desislavsd/vue-select/dist/vue-select.css'
import { vSelect } from '@desislavsd/vue-select'

import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import modulePromocodes from "@/store/promo-codes/modulePromocodes.js"


export default {
  components: {
    vSelect,
    flatPickr
  },
  data() {
    return {
      promo_data: { id: null, code: null, type: null, amount: 0,
                      expires_at: null, status: null, min_price: 0, max_discount: 0},
      types: [
        { id: 0, value: 'Fixed Rate' },
        { id: 1, value: 'Precentage' }
      ],
      stats: [
        { id: 0, value: 'Expired' },
        { id: 1, value: 'Active' }
      ],
    }
  },
  computed: {

  },
  methods: {
    fetch_promocode_data(codeID) {
      this.$store.dispatch("PromocodesData/fetchPromocode", codeID)
      .then((res) => {
        this.promo_data = res.data
      }).catch((err) => console.log(err.response))
    },
    validateForm() {
      return !this.errors.any()
    },
    goBack(){
      this.$router.push({path: '/promocodes'})
    },
    save_changes() {
      if(!this.validateForm) return
      
      let formData = new FormData();
      formData.append('code', this.promo_data.code)
      formData.append('amount', this.promo_data.amount)
      formData.append('type', this.promo_data.type)
      formData.append('expires_at', this.promo_data.expires_at)
      formData.append('min_price', this.promo_data.min_price)
      formData.append('max_discount', this.promo_data.max_discount)
      formData.append('status', this.promo_data.status)

      if(this.promo_data.id !== null && this.promo_data.id >= 0) {
        formData.append('id', this.promo_data.id)
        this.$store.dispatch("PromocodesData/updateItem", formData)
        .catch(err => { console.error(err) })
      }else{
        this.$store.dispatch("PromocodesData/addItem", formData)
        .then((response) => {
          this.$router.push({path: '/promocodes/edit/' + response.data.promocode.id})
        })
        .catch(err => { console.error(err) })
      }

      this.$vs.notify({
        color: 'success',
        title: 'Successfull',
        text: 'Product updated successfully'
      })
    },
  },
  created() {
    if (this.$route.params.promocodeId){
      this.fetch_promocode_data(this.$route.params.promocodeId)
    }

    if(!modulePromocodes.isRegistered) {
      this.$store.registerModule('PromocodesData', modulePromocodes)
      modulePromocodes.isRegistered = true

      this.$store.dispatch("PromocodesData/fetchPromocodes")
    }
  }
}
</script>

<style lang="scss" scoped>
  .date-input {
    width: 100%;
    border: 1px solid #ccc;
    padding: .5rem !important;
    border-radius: .25rem !important;
  }
</style>
