<template>
    <div id="ecommerce-cart-demo">
        <!-- IF CART HAVE ITEMS -->
        <div class="vx-row" v-if="cartItems.length">

            <!-- LEFT COL -->
            <div class="vx-col lg:w-2/3 w-full relative">
                <div class="items-list-view" v-for="(item, index) in cartItems" :key="item.objectID">
                    <item-list-view :item="item" class="mb-base">

                        <!-- SLOT: ITEM META -->
                        <template slot="item-meta">
                            <h6
                                class="item-name font-semibold mb-1 cursor-pointer hover:text-primary"
                                @click="$router.push({name: 'ecommerce-item-detail-view', params: {item_id: item.objectID }}).catch(() => {})">
                                {{ $i18n.locale == 'en' ?  item.title.en : item.title.ar }}
                            </h6>
                            <p class="item-description text-sm mb-3">{{ $i18n.locale == 'en' ?  item.desc.en.substring(0, 200) : item.desc.ar.substring(0, 200) }}</p>

                            <div class="qty-container flex justify-center items-center">
                                <button @click="increment(item.quantity, index)"><img class="responsive payment-img mx-1 cursor-pointer" src="@assets/images/icons-p/up.svg" alt="increment button"></button>
                                <input type="text" :value="item.quantity" disabled>
                                <button @click="decrement(item.quantity, index)"><img class="responsive payment-img mx-1 cursor-pointer" src="@assets/images/icons-p/down.svg" alt="decrement button"></button>
                            </div>
                        </template>

                        <!-- SLOT: ACTION BUTTONS -->
                        <template slot="action-buttons">
                            <!-- PRIMARY BUTTON: REMOVE -->
                            <div class="item-view-primary-action-btn p-3 rounded-lg flex flex-grow items-center justify-center cursor-pointer mb-3" @click="removeItemFromCart(item)">
                                <feather-icon icon="Trash2Icon" svgClasses="h-10 w-10" />
                            </div>

                            <h5 class="font-bold text-center price">
                            {{ getDetails(item.details).price }} {{ $t(country.currency) }}
                            </h5>
                        </template>
                    </item-list-view>
                </div>
            </div>

            <!-- RIGHT COL -->
            <div class="vx-col md:w-1/3 w-full">
                <order-summary :country="country" />
            </div>
        </div>

        <!-- IF NO ITEMS IN CART -->
        <vx-card class="no-items" :title="$t('EmptyCart')" v-else>
            <vs-button @click="$router.push('/').catch(() => {})">
            {{ $t('ShopNow') }}
            </vs-button>
        </vx-card>
    </div>
</template>

<script>
import ItemListView from './components/ItemListView.vue'
import OrderSummary from './components/OrderSummary.vue'

export default {
    data() {
        return {
            country: {},
            short_code: (localStorage.getItem("country_code")) ? localStorage.getItem("country_code") : 'QTR'
        }
    },
    computed: {
        countries () {
            return this.$store.state.CountriesList
        },
        cartItems() {
            return this.$store.state.eCommerce.cartItems.slice().reverse();
        },
        isInWishList() {
            return (itemId) => this.$store.getters['eCommerce/isInWishList'](itemId)
        }
    },
    methods: {

        // TAB 1
        removeItemFromCart(item) {
            this.$store.dispatch('eCommerce/toggleItemInCart', item)
        },
        wishListButtonClicked(item) {
            // Toggle in Wish List
            if (this.isInWishList(item.objectID)) this.$router.push('/wish-list').catch(() => {})
            else {
                this.toggleItemInWishList(item)
                this.removeItemFromCart(item)
            }
        },
        toggleItemInWishList(item) {
            this.$store.dispatch('eCommerce/toggleItemInWishList', item)
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
        increment(qty, index) {
            qty++
            const itemIndex = Math.abs(index + 1 - this.cartItems.length)
            this.$store.dispatch("eCommerce/updateItemQuantity", { quantity: qty, index: itemIndex })
        },
        decrement(qty, index) {
            (qty === 1) ? qty = 1 : qty--
            const itemIndex = Math.abs(index + 1 - this.cartItems.length)
            this.$store.dispatch("eCommerce/updateItemQuantity", { quantity: qty, index: itemIndex })
        },
    },
    components: {
        ItemListView,
        OrderSummary,
    },created() {
        const currentCountryID  = (localStorage.getItem("country")) ? localStorage.getItem("country") : 1
        const productIndex      = this.countries.findIndex((country) => country.id == currentCountryID)
        this.country            = this.countries[productIndex]
    },
}
</script>

<style lang="scss" scoped>
#ecommerce-cart-demo {
    margin: 2rem 1rem;

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
        border: 1px solid #e2e2e2;
    }

    .item-name {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
        -webkit-line-clamp: 2;
    }

    .no-items {
        border: none;
        border-radius: 0;
        box-shadow: none;
    }

    .qty-container {
        position: absolute;
        bottom: 1rem;

        > button {
          background: transparent;
          border: none;
          margin: 0 0.5rem;

          > img {
            width: 1.5rem;
          }
        }

        > input {
          width: 3rem;
          height: 1.5rem;
          border-radius: 1rem;
          padding: 0.25rem;
          text-align: center;
          border: 1px solid #e2e2e2;
          background: #fff;
        }
    }
}
</style>
