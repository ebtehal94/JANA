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
        <!-- account -->
        <div v-if="!isLoggedIn" class="vx-row">

            <!-- LEFT COL: NEW ADDRESS -->
            <div class="vx-col w-full">
                <vx-card :title="$t('userTitle')" :subtitle="$t('userSubtitle')" class="mb-base no-borders">
                    <vs-tabs alignment="fixed">
                    <vs-tab :label="$t('registerLabel')">
                        <register />
                    </vs-tab>
                    <vs-tab :label="$t('loginLabel')">
                        <login />
                    </vs-tab>
                    </vs-tabs>
                </vx-card>
            </div>
        </div>

        <!-- Checkout -->
        <div v-else class="vx-row">

            <!-- LEFT COL: PAYMENT OPTIONS -->
            <div class="vx-col lg:w-2/3 w-full">
                <vx-card class="mb-base">
                    <h5 id="card-title" slot="no-body" class="text-white mb-3">{{ $t('checkoutTitle') }}</h5>

                    <vs-tabs alignment="center" color="primary" icons-and-text>
                    <vs-tab :label="$t('DeliveryLabel')">
                        <div class="vx-row no-gutter justify-center items-center">

                        <div class="vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg">
                        <div class="mt-3">
                            <label>{{ $t('Name') }}</label>
                            <input class="w-full mt-4 checkout-input" name="name" type="text" v-model="user_data.name" required>
                        </div>

                        <div class="mt-3">
                            <label>{{ $t('Mobile') }}</label>
                            <input class="w-full mt-4 checkout-input" name="mobile" type="text" v-model="user_data.mobile" placeholder="56xxxxxxx" required>
                        </div>

                        <div class="mt-3">
                            <label>{{ $t('Email') }}</label>
                            <input class="w-full mt-4 checkout-input" name="email" type="text" v-model="user_data.email" placeholder="mail@email.com" required>
                        </div>
                        </div>

                        <div class="vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg px-4">
                             <!-- Map goes here -->
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
                            <textarea class="w-full mt-2" id="other-details" cols="50" rows="15"></textarea>
                        </div>
                    </div>
                    </vs-tab>

                    <vs-tab :label="$t('PickupLabel')">
                        <div class="vx-row no-gutter justify-center items-center">

                        <div class="vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg">
                        <div class="mt-3">
                            <label>{{ $t('ReciverName') }}</label>
                            <input class="w-full mt-4 checkout-input" name="name" type="text" v-model="user_data.name" required>
                        </div>

                        <div class="mt-3">
                            <label>{{ $t('Mobile') }}</label>
                            <input class="w-full mt-4 checkout-input" name="mobile" type="text" v-model="user_data.mobile" placeholder="56xxxxxxx" required>
                        </div>

                        <div class="mt-3">
                            <label>{{ $t('Email') }}</label>
                            <input class="w-full mt-4 checkout-input" name="email" type="text" v-model="user_data.email" placeholder="mail@email.com" required>
                        </div>
                        </div>

                        <div class="vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg px-4">
                             <!-- Map goes here -->
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
                            <textarea class="w-full mt-2" id="other-details" cols="50" rows="15"></textarea>
                        </div>
                    </div>
                    </vs-tab>
                    </vs-tabs>
                </vx-card>

                <vx-card>
                    <h5 id="card-title" slot="no-body" class="text-white mb-3">{{ $t('PaymentMethods') }}</h5>

                    <div>
                        <div class="mt-3 flex justify-center">
                            <span class="cursor-pointer mx-4" @click="cash"><img src="@assets/images/icons-p/cash-pay.svg" alt="brand image"> دفع نقدي</span>
                            <span class="cursor-pointer mx-4" @click="epay"><img src="@assets/images/icons-p/epay.svg" alt="brand image"> دفع إلكتروني</span>
                        </div>

                        <div class="flex  mt-3 justify-center items-center" v-if="paymentMethod == 1">
                            <span class="cursor-pointer mx-2" @click="isChosen"><img src="@assets/images/icons-p/emaster.svg" alt="brand image"></span>
                            <span class="cursor-pointer mx-2" @click="isChosen"><img src="@assets/images/icons-p/evisa.svg" alt="brand image"></span>
                            <span class="cursor-pointer mx-2" @click="isChosen"><img src="@assets/images/icons-p/epaypal.svg" alt="brand image"></span>
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

                    <vs-divider />

                    <div class="flex justify-between">
                        <span>{{ $t('AmountPayable') }}</span>
                        <span class="font-semibold">{{ getTotalPrice }} {{ $t(country.currency) }}</span>
                    </div>
                    <div>
                        <vs-button class="action-btn w-full my-4" @click="placeOrder">{{ $t('Checkout') }}</vs-button>
                    </div>
                </vx-card>
            </div>
        </div>

        <!-- IF NO ITEMS IN CART -->
        <vx-card class="no-items" :title="$t('EmptyCart')" v-if="cartItems.length == 0">
            <p>Your Order has been successful. Thank you!</p>
        </vx-card>  
    </div>
</template>

<script>
import { FormWizard, TabContent } from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import ItemListView from './components/ItemListView.vue'
import OrderSummary from './components/OrderSummary.vue'
import Login from './components/Login.vue'
import Register from './components/Register.vue'

// Store Module
import moduleOrderManagement from '@/store/order-management/moduleOrderManagement.js'

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
    data() {
        return {
            paymentMethod: null,
            cvv: '',
            country: {},
            products: [],
            delivery_address: '',
            user_data: {},
            chosen: false,
            currentLocation : { lat : 0, lng : 0},
            place: null,
        }
    },
    computed: {
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

            if (this.discount.type == 1 ){
                return (this.discount.amount * this.getSubTotal) / 100
            }else if (this.discount.type == 2 ){
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
        cash() {
            this.paymentMethod = 0
        },
        epay() {
            this.paymentMethod = 1
        },
        placeOrder() {
            this.cartItems.forEach(item => {
                let product = {
                    product_id: item.id,
                    quantity: item.quantity,
                    price: this.getDetails(item.details).price
                }

                this.products.push(product)
            })

            const obj = {
                country_id: this.country.id,
                customer_id: this.activeUserInfo.id,
                delivery_price: this.country.delivery,
                delivery_method: (this.delivery_address == '') ? 1 : 0,
                location: {
                    address: this.delivery_address,
                    lat: null,
                    lng: null,
                },
                products_price: this.getSubTotal,
                payment_amount: this.getTotalPrice,
                payment_method: this.paymentMethod,
                total_price: this.getTotalPrice,
                promo_code: null,
                products: this.products
            }

            this.$store.dispatch("orderManagement/addOrder", obj)
            .then(res => {
                if( res.data.statusCode == 200 ){
                    this.$vs.notify({
                    color: 'success',
                    title: 'Successfull',
                    text: 'Your Order Has Been Sent'
                    })
                    
                    // Reset cart
                    this.$store.dispatch('eCommerce/resetCartItems')
                    this.$router.push('/cart')

                } else {
                    this.$vs.notify({
                    color: 'danger',
                    title: 'Error',
                    text: 'Error placing order'
                    })
                }
            })
            .catch(err => { console.error(err.response) })
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
        getHisCurrentLocation(){
            navigator.geolocation.getCurrentPosition((position) => {

                this.currentLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
            });
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
    },
    components: {
        ItemListView,
        OrderSummary,
        FormWizard,
        TabContent,
        Login,
        Register
    },created() {
        // Register Module UserManagement Module
        if(!moduleOrderManagement.isRegistered) {
            this.$store.registerModule('orderManagement', moduleOrderManagement)
            moduleOrderManagement.isRegistered = true
        }

        const currentCountryID  = (localStorage.getItem("country")) ? localStorage.getItem("country") : 1
        const productIndex      = this.countries.findIndex((country) => country.id == currentCountryID)
        this.country           = this.countries[productIndex]
        this.user_data = this.activeUserInfo

        // get user's current location
        this.getHisCurrentLocation()
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
}
</style>
