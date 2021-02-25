<template>
    <div id="Handpicked-Products">
    <ais-instant-search :search-client="searchClient" index-name="products" id="algolia-instant-search-demo">
        <!-- AIS CONFIG -->
        <ais-configure :hits-per-page.camel="10" :filters="'status_'+short_code+' = 1 AND price_'+short_code+' > 0'" />
        <!-- <ais-configure :hits-per-page.camel="10"/> -->
        <div class="section-title">
            <h5 class="side-title">{{ $t('Handpicked') }}</h5>
            <hr>
        </div>
        <ais-hits>
        <!-- <ais-hits :transform-items="filterProductsByCountry"> -->
            <div slot-scope="{ items }">
                <template>
                    <div class="vx-row items-center justify-start p-10 match-height">
                      <!-- <item-grid-view v-for="item in items" :key="item.objectID" :item="item"> -->
                        <!-- <item-grid-view class="product text-center pl-3 pr-3 w-1/2 md:w-1/5" v-for="item in items" :key="item.objectID" :item="item"> -->
                        <item-grid-view class="product text-center pl-3 pr-3 w-1/2 md:w-1/4 sm:w-1/2 lg:w-1/5 xl:w-1/5" v-for="item in items" :key="item.objectID" :item="item">
                                <!-- SLOT: ACTION BUTTONS -->
                                <template slot="action-buttons">
                                    <div class="flex flex-wrap justify-center">

                                        <!-- ADD-TO/VIEW-IN CART -->
                                        <div
                                            class="item-view-secondary-action-btn bg-primary text-white p-2 flex flex-grow items-center justify-center cursor-pointer"
                                            @click="cartButtonClicked(item)">
                                            <feather-icon class="text-white" icon="ShoppingCartIcon" svgClasses="h-4 w-4" />

                                            <span class="text-xs font-semibold text-white" v-if="isInCart(item.objectID)">{{$t('ViewInCart')}}</span>
                                            <span class="text-xs font-semibold text-white" v-else>{{$t('AddToCart')}}</span>
                                        </div>

                                        <!--  ADD TO WISH LIST -->
                                        <div
                                            class="p-2 flex flex-grow items-center justify-center cursor-pointer"
                                            @click="toggleItemInWishList(item)">
                                            <feather-icon icon="HeartIcon" :svgClasses="[{'text-danger fill-current' : isInWishList(item.objectID)}, 'h-7 w-7']" />
                                        </div>

                                        <!--  Share -->
                                        <div
                                            class="p-2 flex flex-grow items-center justify-center cursor-pointer">
                                            <feather-icon icon="Share2Icon" class="h-10 w-10" />
                                        </div>
                                    </div>
                                </template>
                            </item-grid-view>
                    </div>
                </template>
            </div>
        </ais-hits>
    </ais-instant-search>
    </div>
</template>

<script>
import { AisConfigure, AisHits, AisInstantSearch } from 'vue-instantsearch'
import algoliasearch from 'algoliasearch/lite'

export default {
    data() {
        return {
            quantity: 1,
            searchClient: algoliasearch(
                'SXG4PV0YAT',
                '42b8e7ea3e742f53ca29e378b2e53e38'
            ),
            short_code: (localStorage.getItem("country_code")) ? localStorage.getItem("country_code") : 'QTR'
        }
    },
    components: {
        ItemGridView: () => import("./ItemGridView.vue"),
        AisConfigure,
        AisHits,
        AisInstantSearch
    },
    computed: {
        isInCart() {
            return (itemId) => this.$store.getters['eCommerce/isInCart'](itemId)
        },
        isInWishList() {
            return (itemId) => this.$store.getters['eCommerce/isInWishList'](itemId)
        },
    },
    methods: {
        navigate_to_detail_view() {
            this.$router.push({name: 'ecommerce-item-detail-view', params: {item_id: this.item.objectID }}).catch(() => {})
        },
        additemInCart(item) {
          item['quantity'] = 1
          this.$store.dispatch('eCommerce/additemInCart', item)
        },
        cartButtonClicked(item) {
            this.isInCart(item.objectID) ? this.$router.push('/cart').catch(() => {}) : this.additemInCart(item)
        },
        toggleItemInWishList(item) {
            this.$store.dispatch('eCommerce/toggleItemInWishList', item)
        },
        filterProductsByCountry(items) {
            return items.filter(item => {
                let product = false
                for (const [key, val] of Object.entries(item.details)) {
                    if (key == this.short_code && val.status == 1) {
                        product = true
                    }
                }

                return product
            })
        }
    },
}
</script>

<style lang="scss" scoped>
#Handpicked-Products {
    margin: 1rem 0.5rem;

    h5.side-title {
        color: #fff;
        background-color: #bd9c72;
        width: 11rem;
        padding: 0.5rem 1rem;
    }

    hr {
        border-top: 2px solid #bd9c72;
    }
}

@media only screen and (max-width: 600px) {
    .items-grid-view {
        margin: 0 !important;
        padding: 0 !important;

        // .product {
        //     width: 50%;
        // }
    }
}

@media only screen and (min-width: 768px) {
    .items-grid-view {
        margin: 0 !important;
        padding: 0 !important;

        // .product {
        //     width: 20%;
        // }
    }
}
</style>
