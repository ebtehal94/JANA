<!-- =========================================================================================
    File Name: ItemListView.vue
    Description: Item Component - List VIew
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
    <vx-card class="list-view-item overflow-hidden" v-on="$listeners">

        <template slot="no-body">
            <div class="vx-row item-details no-gutter">

                <!-- IMG COL -->
                <div class="vx-col sm:w-1/4 w-full item-img-container flex items-center justify-center cursor-pointer" @click="navigate_to_detail_view">
                    <img :src="productsLink+ item.images[0]" :alt="item.title.en" class="grid-view-img p-4">
                </div>

                <!-- ITEM NAME & DESC COL -->
                <div class="vx-col sm:w-1/2">
                    <div class="p-4 pt-6">
                        <slot name="item-meta">
                            <h6 class="item-name font-semibold mb-1 hover:text-primary cursor-pointer" @click="navigate_to_detail_view">{{ $i18n.locale == 'en' ? item.title.en : item.title.ar }}</h6>
                            <p class="item-description text-sm">{{ $i18n.locale == 'en' ? item.desc.en : item.desc.ar }}</p>
                            <h6 class="font-bold mb-2 text-dark"><span class="text-danger">{{ priceInCountry(item.details) }}</span> {{$t(currency)}}</h6>
                        </slot>
                    </div>
                </div>

                <!-- PURCHASE COL -->
                <div class="vx-col sm:w-1/4 w-full flex items-center">
                    <div class="p-4 flex flex-col w-full">
                        <!-- SLOT: ACTION BUTTONS -->
                        <slot name="action-buttons" />
                    </div>
                </div>
            </div>
        </template>

    </vx-card>
</template>

<script>
export default{
    props: {
        item: {
            type: Object,
            required: true
        }
    },
    data(){
      return {
        productsLink: 'https://otantik-home.s3.me-south-1.amazonaws.com/products/',
        currency: (localStorage.getItem("currency")) ? localStorage.getItem("currency") : 'QAR',
        short_code: (localStorage.getItem("country_code")) ? localStorage.getItem("country_code") : 'QTR'
      }
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
        toggleItemInWishList(item) {
            this.$store.dispatch('eCommerce/toggleItemInWishList', item)
        },
        additemInCart(item) {
            item['quantity'] = 1
            this.$store.dispatch('eCommerce/additemInCart', item)
        },
        cartButtonClicked(item) {
            this.isInCart(item.objectID) ? this.$router.push('/checkout').catch(() => {}) : this.additemInCart(item)
        },
        navigate_to_detail_view() {
          this.$router.push({name: 'ecommerce-item-detail-view', params: {item_id: this.item.objectID }})
            .catch(() => {})
        },
        priceInCountry(details) {
            let price = null
            Object.entries(details).forEach(([key, val]) => {
                if (key == this.short_code) {
                    price = val.price
                }
            });

            return price
        }
    }
}
</script>

<style lang="scss" scoped>
.list-view-item {
    .item-name, .item-description {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .item-name {
        -webkit-line-clamp: 2;
    }

    .item-description {
        -webkit-line-clamp: 5;
    }

    .grid-view-img {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        transition: .35s;
    }

    &:hover {
        transform: translateY(-5px);
        box-shadow: 0px 4px 25px 0px rgba(0,0,0,.25);

        .grid-view-img{
            opacity: 0.9;
        }
    }
}
</style>
