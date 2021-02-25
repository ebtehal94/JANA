<!-- =========================================================================================
	File Name: ECommerceCheckout.vue
	Description: eCommerce Checkout page
	----------------------------------------------------------------------------------------
	Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
	Author: Pixinvent
	Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
    <div id="ecommerce-checkout-demo">
        <!-- Checkout -->
        <div class="vx-row" v-if="cartItems.length">

            <!-- LEFT COL: PAYMENT OPTIONS -->
            <div class="vx-col lg:w-2/3 w-full">
                <vx-card class="mb-base">
                    <h5 id="card-title" slot="no-body" class="text-white mb-3">
                        {{ $t('checkoutTitle') }}
                    </h5>
                    <p v-if="!isLoggedIn" class="text-center text-danger">*{{ $t('CheckoutForm') }}</p>

                    <div class="vx-row no-gutter justify-center items-center">

                        <div class="vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg">
                            <div class="">
                                <label>{{ $t('Name') }}</label>
                                <input class="w-full mt-4 checkout-input" name="name" type="text" v-model="user_data.name" :placeholder="$t('Name')" required>
                            </div>

                            <div class="vx-row mt-3" dir="ltr">
                              <div class="vx-col w-2/5">
                                  <label>{{ $t('CountryCode') }}</label>
                                  <input class="w-full mt-4 checkout-input" name="cc" type="text" v-model="user_data.cc" placeholder="966" required>
                              </div>
                              <div class="vx-col w-3/5">
                                  <label>{{ $t('Mobile') }}</label>
                                  <input class="w-full mt-4 checkout-input" name="mobile" type="text" v-model="user_data.mobile" placeholder="56xxxxxxx" required>
                              </div>
                            </div>

                            <div class="mt-3">
                                <label>{{ $t('Email') }}</label>
                                <input class="w-full mt-4 checkout-input" name="email" type="text" v-model="user_data.email" :placeholder="$t('Email')" required>
                            </div>

                            <div v-if="!isLoggedIn" class="mt-3">
                                <label>{{ $t('Password') }}</label>
                                <input class="w-full mt-4 checkout-input" name="password" type="password" v-model="user_data.password" :placeholder="$t('Password')">
                            </div>
                        </div>

                        <div class="vx-col w-full lg:w-1/2 d-theme-dark-bg px-4">
                            <!-- Map goes here -->

                            <gmap-autocomplete
                                @place_changed="setPlace"
                                ref="autocomplete"
                                :select-first-on-enter="true"
                                class="w-3/4 checkout-input zero-margin "
                            ></gmap-autocomplete>
                            <vs-button class="w-1/5 mb-2 mx-auto" color="primary" @click="usePlace">{{$t('Search')}}</vs-button>
                            <GmapMap ref="mapRef" class="w-full" style="height: 300px;" :zoom="16" :center="currentLocation">
                                <gmap-marker
                                    :position="currentLocation"
                                    :draggable="true"
                                    @dragend="updateCoordinates($event.latLng)"
                                ></gmap-marker>
                            </GmapMap>
                        </div>

                        <div class="pick-up mt-3">
                            <label for="other-details">{{ $t('OtherDetails') }}</label>
                            <textarea class="w-full mt-2" v-model="order_notes" id="other-details" cols="50" rows="15"></textarea>
                        </div>
                    </div>
                </vx-card>
            </div>

            <!-- RIGHT COL: PRICE -->
            <div class="vx-col lg:w-1/3 w-full">
                <vx-card :title="$t('PriceDetails')">

                    <div class="flex justify-between mb-2">
                        <span>{{ $t('Price') }} {{ cartItems.length }} {{ $t('Items') }}</span>
                        <span class="font-semibold">{{ getSubTotal }} {{ $t(country.currency) }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>{{ $t('DeliveryCharges') }}</span>
                        <span class="text-success">{{ country.delivery }} {{ $t(country.currency) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-grey">{{ $t('PromoCode') }}</span>
                        <!-- <span class="text-gray"><a href="#">{{ $t('GetCode') }}</a></span> -->
                        <span
                        v-if="!isCodeInputActive"
                        @click="isCodeInputActive = !isCodeInputActive"
                        class="font-medium text-primary cursor-pointer">لديك كود خصم؟</span>
                    </div>
            <div
            v-if="isCodeInputActive"
            class="flex justify-between mt-2">
                <div class="flex justify-between">
                  <vs-input
                    :success="discount.amount ? true:false"
                    :success-text="discount.amount ? 'تم تفعيل الكود بنجاح':''"
                    :danger="discount.errorMsg ? true:false"
                    :danger-text="discount.errorMsg ? discount.errorMsg:''"
                    :val-icon-success="discount.amount ? 'icon-check' : ''"
                    :val-icon-danger="discount.errorMsg ? 'icon-x' : ''"
                    placeholder="ادخل الكود"
                    val-icon-pack="feather"
                    size="small"
                    v-model="promoCode"
                    name="promoCode" />

                  <vs-button v-if="!getDiscountAmount"
                    @click="checkCode"
                    class="p-0 px-2 ml-4"
                    size="small"
                    :color="!discount.errorMsg ? 'success': 'danger'"
                    type="border"
                    icon-pack="feather"
                    icon="icon-search">
                    <span class="text-small">
                      تحقق
                    </span>
                  </vs-button>

                  <vs-button v-if="getDiscountAmount"
                    @click="removeCode"
                    class="p-0 px-2 ml-4"
                    size="small"
                    color="dark"
                    type="border"
                    icon-pack="feather"
                    icon="icon-x">
                    <span class="text-small">
                      إزالة
                    </span>
                  </vs-button>

                </div>
              <span v-if="getDiscountAmount" class="text-success">-{{getDiscountAmount}} {{ $t(country.currency) }}</span>
            </div>

                    <div class="flex justify-between">
                        <span>{{ $t('AmountPayable') }}</span>
                        <span class="font-semibold">{{ getTotalPrice }} {{ $t(country.currency) }}</span>
                    </div>

                    <vs-divider />

                    <span class="my-6">{{ $t('PaymentMethod') }}</span>
                    <div class="mt-3 flex justify-center items-center">
                        <c-pay class="mx-2 cursor-pointer" @click="payment" :fill="(paymentMethod != null && paymentMethod == 0) ? '#bd9c72' : '#ccc'"></c-pay>
                        <e-pay class="mx-2 cursor-pointer" @click="payment" :fill="(paymentMethod != null && paymentMethod == 1) ? '#bd9c72' : '#ccc'"></e-pay>
                    </div>

                    <div :class="['flex  mt-8 justify-center items-center', {'hidden': !paymentMethod}]">
                      <form id="form-container" method="post" action="/charge">
                        <!-- Tap element will be here -->
                        <div id="element-container"></div>
                        <div id="error-handler" role="alert" class="vx-row justify items-center justify-center font-bold text-danger"></div>
                        <div id="success" style=" display: none;;position: relative;float: left;">
                              <!-- Success! Your token is <span id="token"></span> -->
                              Card validated Successfully!
                        </div>
                        <!-- Tap pay button -->
                        <vs-button class="action-btn w-full mt-10 mb-2" @click="proccessCard">{{$t('CompletePayment')}}</vs-button>
                        <!-- <button id="tap-btn" class="action-btn w-full my-4">Submit</button> -->
                      </form>
                        <!-- <vs-button type="line" color="warning" ><img height="35rem" src="@assets/images/icons-p/emaster.svg" alt="brand image"></vs-button>
                        <vs-button type="line" color="warning" ><img src="@assets/images/icons-p/evisa.svg" alt="brand image"></vs-button>
                        <vs-button type="line" color="warning" ><img src="@assets/images/icons-p/epaypal.svg" alt="brand image"></vs-button> -->
                        <!-- <tap-checkout /> -->
                    </div>

                    <div>
                        <vs-button v-if="!paymentMethod" :disabled="isLoading" class="action-btn w-full my-4" @click="placeOrder">
                           {{ (isLoading) ?  $t('ordering') + '...' : $t('Checkout') }}
                        </vs-button>
                    </div>
                </vx-card>
            </div>
        </div>

        <!-- IF NO ITEMS IN CART -->
        <vx-card class="no-items" :title="$t('EmptyCart')" v-if="cartItems.length == 0">
          <vs-button class="mt-10" to="/all">{{ $t('ShopNow') }}</vs-button>
        </vx-card>
    </div>
</template>

<script>
import { FormWizard, TabContent } from 'vue-form-wizard'
import ItemListView from './components/ItemListView.vue'
import OrderSummary from './components/OrderSummary.vue'
import TapCheckout from './components/TapCheckout.vue'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import Register from './components/Register.vue'
import Login from './components/Login.vue'
import CPay from './components/CPay.vue'
import EPay from './components/EPay.vue'
import axios from "@/axios.js"

// Store Module
import moduleOrderManagement from '@/store/order-management/moduleOrderManagement.js'
import moduleUserManagement from '@/store/user-management/moduleUserManagement.js'


import Vue from 'vue'
import * as VueGoogleMaps from 'vue2-google-maps'

Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyClZzKQFLvHZJF2a4BD5aQt2SiGyLj_bSY',
    libraries: 'places',
  },
  installComponents: true
})

export default {
    components: {
        ItemListView,
        OrderSummary,
        TapCheckout,
        TabContent,
        FormWizard,
        Register,
        Login,
        CPay,
        EPay,
    },
    data() {
        return {
            paymentMethod: 1,
            cvv: '',
            country: {},
            products: [],
            delivery_address: '',
            user_data: {},
            order_notes: '',
            currentLocation : { lat : 0, lng : 0},
            place: null,
            promoCode: '',
            isCodeInputActive: false,
            isLoading: false,
        }
    },
    computed: {
        discount() {
        return this.$store.state.eCommerce.orderDetails.discount
        },
        isChosen() {
            return this.chosen ? false : true
        },
        countries () {
            return this.$store.state.CountriesList
        },
        cartItems() {
            return this.$store.state.eCommerce.cartItems.slice().reverse();
        },
        isInWishList() {
            return (itemId) => this.$store.getters['eCommerce/isInWishList'](itemId)
        },
        isLoggedIn() {
            return (localStorage.getItem("accessToken")) ? true : false
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
            return (this.getSubTotal + parseFloat(this.country.delivery))  - this.getDiscountAmount
        },
        activeUserInfo () {
            return this.$store.state.AppActiveUser
        }
    },
    methods: {
        callbackFunc(){
          return true
        },
        payment(value) {
            this.paymentMethod = value
            console.log(this.paymentMethod)
        },
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
        placeOrder(token) {
            if(!this.isLoggedIn) {
                this.$router.push('/register')
                // this.registerUser()
            } else {
              this.$vs.loading()
                this.isLoading = true

                this.cartItems.forEach(item => {
                    let product = {
                        product_id: item.id,
                        quantity: item.quantity,
                        price: this.getDetails(item.details).price
                    }

                    this.products.push(product)
                })

                const obj = {
                    country_id: (localStorage.getItem("country")) ? localStorage.getItem("country") : 1,
                    customer_id: this.activeUserInfo.id,
                    delivery_price: this.country.delivery,
                    delivery_method: 1,
                    location: {
                        address: 'N/A',
                        lat: this.currentLocation.lat,
                        lng: this.currentLocation.lng,
                    },
                    products_price: this.getSubTotal,
                    payment_amount: this.getTotalPrice,
                    payment_method: this.paymentMethod,
                    total_price: this.getTotalPrice,
                    promo_code: this.promo_code,
                    discount: this.discount.amount,
                    products: this.products,
                    comments: this.order_notes
                }

                this.$store.dispatch("orderManagement/addOrder", obj)
                .then(res => {
                  this.$vs.loading.close()
                    if (res.data.out_of_stock.length > 0) {
                        res.data.out_of_stock.forEach(product => {
                            this.$vs.notify({
                            color: 'danger',
                            title: 'Error',
                            text: `${product.title_en} is Out of Stock`
                            })
                        });
                    } else if( res.data.statusCode == 200 && res.data.out_of_stock.length == 0 && res.data.order_id > 0){
                        this.$vs.notify({
                        color: 'success',
                        title: 'Successfull',
                        text: 'Your Order Has Been Created'
                        })

                        // Reset cart
                        this.isLoading = false
                        this.$store.dispatch('eCommerce/resetCartItems')
                        // this.$router.push('/order-successfull')
                        if (token != null && token.length > 0){
                          this.ChargeCard(token, res.data.order_id, obj)
                        }else{
                          this.$router.push('/order-successfull')
                        }
                    } else {
                        this.$vs.notify({
                        color: 'danger',
                        title: 'Error',
                        text: `Error Placing Order`
                        })
                    }
                })
                .catch(err => {
                  this.$vs.loading.close()
                  console.error(err)
                })
            }
        },
        getDetails(details) {
            let detail = null
            Object.entries(details).forEach(([key, val]) => {
            if (key == this.country.short_code) {
                detail = val
            }
            });

            return detail
        },
        setPlace(place) {
          this.place = place
          this.usePlace()
        },
        usePlace(place) {
          if (this.place) {
            const pos = {
              lat: this.place.geometry.location.lat(),
              lng: this.place.geometry.location.lng(),
            };

            this.$refs.mapRef.$mapPromise.then((map) => {
              map.setCenter(pos)

              this.currentLocation = pos;

            })

            this.place = null;
          }
        },
        getHisCurrentLocation(){
          console.log('fetching location')
            navigator.geolocation.getCurrentPosition((position) => {
              this.currentLocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
              };
            });
          console.log(this.currentLocation)
          setTimeout(() => {
              this.$refs.mapRef.$mapPromise.then((map) => {
              map.setCenter(this.currentLocation)
              console.log(this.currentLocation)
              })
          }, 2000)
        },
        updateCoordinates(event) {
            const pos = {
                lat: event.lat(),
                lng: event.lng(),
            };

            this.$refs.mapRef.$mapPromise.then((map) => {
                map.setCenter(pos)
                this.currentLocation = pos;
            })
        },
        proccessCard(token) {
          this.$vs.loading()
          const that = this
          this.tap.createToken(that.card).then(function(result) {
            console.log(result);
            if (result.error) {
              // Inform the user if there was an error
              var errorElement = document.getElementById('error-handler');
              errorElement.textContent = result.error.message;
              that.$vs.loading.close()
            } else {
              // Send the token to your server
              var errorElement = document.getElementById('success');
              errorElement.style.display = "block";
              // var tokenElement = document.getElementById('token');
              // tokenElement.textContent = result.id;
              // that.tapTokenHandler(result)
              that.placeOrder(result.id)
            }
          });
        },
        ChargeCard(token, order_id, order) {
          console.log('reached charge card '+token)
          console.log('reached charge card '+order)
          var data = JSON.stringify({
                                      "amount": order.total_price,
                                      "currency": this.country.currency,
                                      "threeDSecure": true,
                                      "save_card": false,
                                      "description": "Otantik Home",
                                      // "statement_descriptor": "Sample",
                                      "metadata": {
                                        "udf1": "test 1",
                                        "udf2": "test 2"
                                      },
                                      "reference": {
                                        "transaction": "txn_0001",
                                        "order": order_id
                                      },
                                      "receipt": {
                                        "email": true,
                                        // "sms": true
                                      },
                                      "customer": {
                                        "first_name": this.user_data.name,
                                        // "middle_name": "test",
                                        // "last_name": "test",
                                        "email": this.user_data.email,
                                        "phone": {
                                          "country_code": this.user_data.cc,
                                          "number": this.user_data.mobile
                                        }
                                      },
                                      // "merchant": {
                                      //   "id": ""
                                      // },
                                      "source": {
                                        "id": token
                                      },
                                      "post": {
                                        "url": "http://otantik-home.com/order-post"
                                      },
                                      "redirect": {
                                        "url": "http://otantik-home.com/order-successfull"
                                      }
                                    });

                  // var xhr = new XMLHttpRequest();
                  // xhr.withCredentials = true;
                  //
                  // xhr.addEventListener("readystatechange", function () {
                  //   if (this.readyState === this.DONE) {
                  //     console.log(this.responseText);
                  //   }
                  // });

                  // xhr.open("POST", "https://api.tap.company/v2/charges");
                  // xhr.setRequestHeader("authorization", "Bearer sk_test_srAQlpDuh1OVRfKB2wviEMxm");
                  // xhr.setRequestHeader("content-type", "application/json");
                  //
                  // xhr.send(data);


                  // this.$store.commit("SET_BEARER", localStorage.getItem("accessToken"))
                  this.$store.commit("SET_PAYTABS_BEARER", 'sk_test_srAQlpDuh1OVRfKB2wviEMxm')

                    axios.post("https://api.tap.company/v2/charges", data
                        // {
                        //   headers: {
                        //              'Access-Control-Allow-Origin': '*',
                        //              'authorization': 'Bearer sk_test_srAQlpDuh1OVRfKB2wviEMxm',
                        //              'Content-type': 'application/json',
                        //            }
                        //  }
                       )
                    .then((response) => {
                      console.log(response)
                      console.log(response.data)
                        // if (response.data.statusCode == 200) {
                        //     this.$vs.notify({
                        //         color: 'success',
                        //         title: this.$t('Success'),
                        //         text: this.$t('OpSuccess')
                        //     })
                        //
                        //     this.$store.dispatch('booking/resetBookingForm')
                        //     this.$router.push('/my-bookings')
                        // } else if (response.data.statusCode == 402) {
                        //     this.$vs.notify({
                        //         color: 'danger',
                        //         title: this.$t('Error'),
                        //         text: $t('AlreadyBooked')
                        //     })
                        // } else {
                        //     this.$vs.notify({
                        //         color: 'danger',
                        //         title: this.$t('Error'),
                        //         text:this.$t('CantBook')
                        //     })
                        // }
                    })
                    .catch((error)   => { console.log(error) })


          // Insert the token ID into the form so it gets submitted to the server
          // var form = document.getElementById('payment-form');
          // var hiddenInput = document.createElement('input');
          // hiddenInput.setAttribute('type', 'hidden');
          // hiddenInput.setAttribute('name', 'tapToken');
          // hiddenInput.setAttribute('value', token.id);
          // form.appendChild(hiddenInput);
          // Submit the form
          // form.submit();
        }
    },
    mounted() {
      // let TapsBluebird = document.createElement('script')
      // TapsBluebird.setAttribute('src', 'https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.4/bluebird.min.js')
      // document.head.appendChild(TapsBluebird)
      //
      // let Tapjsli = document.createElement('script')
      // Tapjsli.setAttribute('src', 'https://secure.gosell.io/js/sdk/tap.min.js')
      // document.head.appendChild(Tapjsli)

      this.tap = Tapjsli('pk_test_LWUposliX57JBrwDcRjmZuIv');

      var elements = this.tap.elements({});

      var style = {
        base: {
          color: '#535353',
          lineHeight: '18px',
          fontFamily: 'sans-serif',
          fontSmoothing: 'antialiased',
          fontSize: '16px',
          '::placeholder': {
            color: 'rgba(0, 0, 0, 0.26)',
            fontSize:'15px'
          }
        },
        invalid: {
          color: 'red'
        }
      };
      // input labels/placeholders
      var labels = {
          cardNumber:this.$t("CardNumber"),
          expirationDate:"MM/YY",
          cvv:"CVV",
          cardHolder:this.$t("CardHolderName")
        };
      //payment options
      var paymentOptions = {
        currencyCode:["KWD","USD","SAR","BHD", "QAR"],
        labels : labels,
        TextDirection: this.$vs.rtl ? "rtl" : "ltr"
      }
      //create element, pass style and payment options
      this.card = elements.create('card', {style: style}, paymentOptions);
      //mount element
      this.card.mount('#element-container');
      //this.card change event listener
      const that = this

      this.card.addEventListener('change', function(event) {
        if(event.loaded){
          console.log("UI loaded :"+event.loaded);
          console.log("current currency is :"+that.card.getCurrency())
        }
        var displayError = document.getElementById('error-handler');
        if (event.error) {
          displayError.textContent = event.error.message;
        } else {
          displayError.textContent = '';
        }
      });


      // Handle form submission
      // var form = document.getElementById('form-container');
      // form.addEventListener('submit', function(event) {
      //   event.preventDefault();

      // });
    },created() {
      this.getHisCurrentLocation()
        // Register Module UserManagement Module
        if(!moduleUserManagement.isRegistered) {
            this.$store.registerModule('userManagement', moduleUserManagement)
            moduleUserManagement.isRegistered = true
        }

        if(!moduleOrderManagement.isRegistered) {
            this.$store.registerModule('orderManagement', moduleOrderManagement)
            moduleOrderManagement.isRegistered = true
        }

        const currentCountryID  = (localStorage.getItem("country")) ? localStorage.getItem("country") : 1
        const productIndex      = this.countries.findIndex((country) => country.id == currentCountryID)
        this.country           = this.countries[productIndex]

        if (this.isLoggedIn) {
            this.user_data = this.activeUserInfo
        }else{
          this.$router.push('/register')
        }
        // get user's current location
    },
}
</script>

<style lang="scss" scoped>
#ecommerce-checkout-demo {
    margin: 2rem 1rem;

    #card-title {
        background: #bd9c72;
        padding: 1rem;
        text-align: center;
    }

    .chosen-method {
        border-bottom: 2px solid rgb(277, 138, 99);
        padding-bottom: 1rem;
    }

    .item-view-primary-action-btn {
        color: red !important;
        width: 3rem;
        position: absolute;
        top: 1rem;
        right: 2rem;
    }

    .price {
        position: absolute;
        bottom: 1rem;
        right: 2rem;
    }
    .qty {
        position: absolute;
        bottom: 1rem;
    }

    .item-name {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
        -webkit-line-clamp: 2;
    }

    .no-borders {
        border: none;
        box-shadow: none;
    }

    .action-btn {
        border-radius: 0;
    }

    .pick-up {
        width: 100%;
    }

    #other-details {
        resize: none;
        padding: 0.5rem;
    }

    .checkout-input {
        border: 1px solid #000 !important;
        padding: 1rem;
    }

    .zero-margin {
        margin: 0 !important;
    }

    .vue-form-wizard {
        padding-bottom: 0;

        ::v-deep .wizard-header {
            padding: 0;
        }

        ::v-deep .wizard-tab-content {
            padding-right: 0;
            padding-left: 0;
            padding-bottom: 0;

            .wizard-tab-container{
              margin-bottom: 0 !important;
            }
        }
    }

    .form-row {
    width: 70%;
    float: left;
    background-color: #ededed;
    }

    #card-element {
    background-color: transparent;
    height: 40px;
    // border-radius: 4px;
    // border: 1px solid transparent;
    border: 1px solid #000 !important;
    padding: 1rem;
    box-shadow: 0 1px 3px 0 #e6ebf1;
    -webkit-transition: box-shadow 150ms ease;
    transition: box-shadow 150ms ease;
    }

    #card-element--focus {
      box-shadow: 0 1px 3px 0 #cfd7df;
    }

    #card-element--invalid {
      border-color: #fa755a;
    }

    #card-element--webkit-autofill {
      background-color: #fefde5 !important;
    }

    #submitbutton,#tap-btn{
    // align-items:flex-start;
    // background-attachment:scroll;background-clip:border-box;
    // background-color:rgb(50, 50, 93);background-image:none;
    // background-origin:padding-box;
    // background-position-x:0%;
    // background-position-y:0%;
    // background-size:auto;
    // border-bottom-color:rgb(255, 255, 255);
    // border-bottom-left-radius:4px;
    // border-bottom-right-radius:4px;border-bottom-style:none;
    // border-bottom-width:0px;border-image-outset:0px;
    // border-image-repeat:stretch;border-image-slice:100%;
    // border-image-source:none;border-image-width:1;
    // border-left-color:rgb(255, 255, 255);
    // border-left-style:none;
    // border-left-width:0px;
    // border-right-color:rgb(255, 255, 255);
    // border-right-style:none;
    // border-right-width:0px;
    // border-top-color:rgb(255, 255, 255);
    // border-top-left-radius:4px;
    // border-top-right-radius:4px;
    // border-top-style:none;
    // border-top-width:0px;
    // box-shadow:rgba(50, 50, 93, 0.11) 0px 4px 6px 0px, rgba(0, 0, 0, 0.08) 0px 1px 3px 0px;
    // box-sizing:border-box;color:rgb(255, 255, 255);
    cursor:pointer;
    // display:block;
    // float:left;
    // font-family:"Helvetica Neue", Helvetica, sans-serif;
    // font-size:15px;
    // font-stretch:100%;
    // font-style:normal;
    // font-variant-caps:normal;
    // font-variant-east-asian:normal;
    // font-variant-ligatures:normal;
    // font-variant-numeric:normal;
    // font-weight:600;
    // height:35px;
    // letter-spacing:0.375px;
    // line-height:35px;
    // margin-bottom:0px;
    // margin-left:12px;
    // margin-right:0px;
    // margin-top:28px;
    // outline-color:rgb(255, 255, 255);
    // outline-style:none;
    // outline-width:0px;
    // overflow-x:visible;
    // overflow-y:visible;
    // padding-bottom:0px;
    // padding-left:14px;
    // padding-right:14px;
    // padding-top:0px;
    // text-align:center;
    // text-decoration-color:rgb(255, 255, 255);
    // text-decoration-line:none;
    // text-decoration-style:solid;
    // text-indent:0px;
    // text-rendering:auto;
    // text-shadow:none;
    // text-size-adjust:100%;
    // text-transform:none;
    // transition-delay:0s;
    // transition-duration:0.15s;
    // transition-property:all;
    // transition-timing-function:ease;
    // white-space:nowrap;
    // width:150.781px;
    // word-spacing:0px;
    // writing-mode:horizontal-tb;
    // -webkit-appearance:none;
    // -webkit-font-smoothing:antialiased;
    // -webkit-tap-highlight-color:rgba(0, 0, 0, 0);
    // -webkit-border-image:none;

    }
}
</style>
