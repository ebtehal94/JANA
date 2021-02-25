<template>
  <div class="vx-row">
    <div class="vx-col w-full">
        <vx-card>
            <h5 id="card-title" slot="no-body" class="text-white mb-3">{{ $t('OrderDetails') }}</h5>
            <div class="flex justify-between mb-2">
                <span class="text-grey">{{ $t('CartTotal') }}</span>
                <span>{{getSubTotal}} {{ $t(country.currency) }}</span>
            </div>
            <div class="flex justify-between mb-2">
                <span class="text-grey">{{ $t('DeliveryPrice') }}</span>
                <span class="text-gray">{{ country.delivery }} {{ $t(country.currency) }}</span>
            </div>
            
            <br><br><br>
            <h5 class="font-bold flex justify-between font-semibold mt mt-5 mb-3">
                <span>{{ $t('Subtotal') }}</span>
                <span>{{getTotalPrice}} {{ $t(country.currency) }}</span>
            </h5>

            <div class="flex justify-between items-center">
                <vs-button class="action-btn w-full my-4 mr-1" color="primary" type="border" @click="$router.push('/all').catch(err => {})">{{ $t('BackToShop') }}</vs-button>
                <vs-button class="action-btn w-full my-4" @click="$router.push('/checkout').catch(err => {})">{{ $t('Checkout') }}</vs-button>
            </div>

        </vx-card>
    </div>
  </div>
</template>
<script>
import axios from "@/axios.js"


export default {
  props: {
    country: {
      type: Object
    }
  },
  data() {
    return {
      promoCode: '',
      isCodeInputActive: false,
      short_code: (localStorage.getItem("country_code")) ? localStorage.getItem("country_code") : 'QTR'
    }
  },
  computed: {
    discount() {
        return this.$store.state.eCommerce.orderDetails.discount
    },
    cartItems() {
        return this.$store.state.eCommerce.cartItems.slice().reverse();
    },
    orderDetails() {
        return this.$store.state.eCommerce.orderDetails
    },
    getSubTotal() {
      let subTotal = 0
      if ( this.cartItems && this.cartItems.length > 0) {
        this.cartItems.forEach((item, i) => {
          subTotal += item.quantity * this.getDetails(item.details).price
        });
      }
      return subTotal
    },
    getDiscountAmount() {
      if (!this.discount || !this.discount.type || !this.discount.amount) return 0

      if (this.discount.type == 0 ){
        return (this.discount.amount * this.getSubTotal) / 100
      }else if (this.discount.type == 1 ){
        return this.discount.amount
      }
    },
    getTotalPrice() {
      return (this.getSubTotal + parseFloat(this.country.delivery))  - this.getDiscountAmount;
    }
  },
  methods: {
    checkCode() {
      return new Promise((resolve, reject) => {
        axios.post("/api/promoCodes/check", { code: this.promoCode })
          .then((response) => {
            if (response.data.promoCode && response.data.statusCode == 200){
              this.$store.dispatch('eCommerce/updatePromoCode', response.data.promoCode)
            }else{
              this.$store.dispatch('eCommerce/updatePromoCode',{errorMsg: response.data.msg, amount: 0})

              this.$vs.notify({
                  title: 'Error',
                  text: response.data.msg,
                  color: 'warning',
                  iconPack: 'feather',
                  icon: 'icon-alert-circle'
              })
            }

          })
          .catch((error) => { reject(error) })
      })
    },
    removeCode() {
      return this.$store.dispatch('eCommerce/removePromoCode')
    },
    getDetails(details) {
      let detail = null
      Object.entries(details).forEach(([key, val]) => {
          if (key == this.short_code) {
              detail = val
          }
      });

      return detail
    },
  },
  created (){
    if (this.discount){
      this.isCodeInputActive = true
    }
  }
}
</script>
<style lang="scss" scoped>
@import "@sass/vuexy/_variables.scss";

  #card-title {
    background: $primary;
    padding: 1rem;
  }

  .action-btn {
    border-radius: 0;
  }
</style>