<template>
    <div id="brand-Products">
        <ais-instant-search :search-client="searchClient" index-name="products" id="algolia-instant-search-demo">
            <!-- AIS CONFIG -->
            <ais-configure :hits-per-page.camel="12" :filters="'collection_id: ' + collection_id +' AND price_'+short_code+' > 0'" />

            <h5 class="mx-5">{{ $t('ShopByBrand') }}</h5>

            <div>
                <div id="collections">
                    <button
                    v-for="collection in collections"
                    :key="collection.id"
                    class="collection cursor-pointer"
                    :class="{ 'active-collection' : collection_id == collection.id }"
                    @click="changeCollection(collection.id)">{{ ($i18n.locale == 'en') ? collection.title_en : collection.title_ar }}</button>
                </div>
            </div>

            <ais-hits>
                <div slot-scope="{ items }">
                    <template>
                        <div class="vx-row items-center justify-start p-10 match-height">
                                <item-grid-view class="product text-center pl-3 pr-3 w-1/2 md:w-1/5" v-for="item in items" :key="item.objectID" :item="item">
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
import { AisConfigure, AisHits, AisInstantSearch, AisMenu } from 'vue-instantsearch'
import algoliasearch from 'algoliasearch/lite'

export default {
    components: {
        ItemGridView: () => import("./ItemGridView.vue"),
        AisConfigure,
        AisHits,
        AisInstantSearch,
        AisMenu
    },
    data(){
      return {
        currentTab: '',
        short_code: (localStorage.getItem("country_code")) ? localStorage.getItem("country_code") : 'QTR',
        searchClient: algoliasearch(
            'SXG4PV0YAT',
            '42b8e7ea3e742f53ca29e378b2e53e38'
        ),
        collection_id: JSON.parse(localStorage.getItem("collections"))[0].id,
      }
    },
    computed: {
        isInCart() {
            return (itemId) => this.$store.getters['eCommerce/isInCart'](itemId)
        },
        isInWishList() {
            return (itemId) => this.$store.getters['eCommerce/isInWishList'](itemId)
        },
        collections() {
            return this.$store.state.eCommerce.collections
        }
    },
    methods: {
        changeCollection(id) {
           this.collection_id = id
        },
        activeTab (value) {
            this.currentTab = value;
        },
         navigate_to_detail_view() {
            this.$router.push({name: 'ecommerce-item-detail-view', params: {item_id: this.item.objectID }}).catch(() => {})
        },
        additemInCart(item) {
            item['quantity'] = 1
            this.$store.dispatch('eCommerce/additemInCart', item)
        },
        cartButtonClicked(item) {
            this.isInCart(item.objectID) ? this.$router.push('/checkout').catch(() => {}) : this.additemInCart(item)
        },
        toggleItemInWishList(item) {
            this.$store.dispatch('eCommerce/toggleItemInWishList', item)
        },
    },
    created() {
        this.$store.dispatch('eCommerce/fetchCollections')
    },
}
</script>

<style lang="scss">
.ais-Menu-item--selected {
    color: red;
}

#brand-Products {
    margin: 1rem 0.5rem;

    .section-title {
        margin-bottom: 2rem;
    }

    h5 {
        margin: 2rem 0;
    }

    hr {
        border-top: 2px solid #bd9c72;
    }

    #collections {
        border-bottom: 2px solid #bd9c72;

        button.collection {
            border: none;
            padding: 0.5rem 1rem;
            background: #fff;
            font-size: 1rem;
        }

        button.collection.active-collection {
            color: #fff;
            background: #bd9c72;
        }
    }
}

@media only screen and (max-width: 600px) {
    .items-grid-view {
        margin: 0 !important;
        padding: 0 !important;

        .product {
            width: 50%;
        }
    }
}

@media only screen and (min-width: 768px) {
    .items-grid-view {
        margin: 0 !important;
        padding: 0 !important;

        .product {
            width: 20%;
        }
    }
}
</style>
