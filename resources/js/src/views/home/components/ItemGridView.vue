<!-- =========================================================================================
	File Name: ItemGridView.vue
	Description: Item Component - Grid VIew
	----------------------------------------------------------------------------------------
	Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
	Author: Pixinvent
	Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
    <!-- <div class="item-grid-view vx-row match-height">
        <div class="vx-col" :class="gridColumnWidth" v-for="item in items" :key="item.objectID"> -->
            <vx-card class="product-with-golden-border mb-base overflow-hidden" v-on="$listeners">
                <template slot="no-body">
                    <div v-if="getDetails(item.details).status == 1" class="absolute mt-2 featured-product" color="primary">
                      <span>{{$t('FeaturedProduct')}}</span>
                    </div>
                    <div v-if="getDetails(item.details).status == 2" class="absolute mt-2 featured-product out-of-stock" transparent color="danger">
                      <span>{{$t('OutOfStock')}}</span>
                    </div>

                    <!-- ITEM IMAGE -->
                    <div class="item-img-container h-48 mb-4">
                        <product-popup :popupActive="popupActive" @closePopup="toggleDataPopup" :data="item" />
                        <div class="img-content-container">
                            <img :src="productsLink + item.images[0]" :alt="item.title.en" class="grid-view-img">
                            <div class="quick-view">
                                <button @click="quickView">{{ $t('QuickView') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="item-details px-4">
                        <!-- TITLE & DESCRIPTION -->
                        <!-- <p class="text-left">{{ $i18n.locale == 'en' ? category.name_en : category.name_ar }}</p> -->
                        <div>
                            <h6 class="truncate font-semibold mt-4 mb-2 hover:text-primary cursor-pointer" @click="navigate_to_detail_view">{{ $i18n.locale == 'en' ? item.title.en : item.title.ar }}</h6>
                            <!-- <p class="item-description truncate text-sm">{{ item.desc_en }}</p> -->
                        </div>
                        <div>
                            <h6 class="font-bold mb-2 text-dark"><span class="text-danger">{{ getDetails(item.details).price }}</span> {{$t(currency)}}</h6>
                        </div>

                    </div>

                    <!-- SLOT: ACTION BUTTONS -->
                    <slot name="action-buttons" />
                </template>
            </vx-card>
</template>

<script>
export default{
    props: {
        item: {
            type: Object,
            required: true
        },
    },
    components: {
        ProductPopup: () => import("./ProductPopup.vue"),
    },
    data(){
      return {
        productsLink: 'https://janacard.s3.eu-central-1.amazonaws.com/products/',
        currency: (localStorage.getItem("currency")) ? localStorage.getItem("currency") : 'QAR',
        short_code: (localStorage.getItem("country_code")) ? localStorage.getItem("country_code") : 'QTR',
        popupActive: false,
      }
    },
    computed: {
        categories () {
            return this.$store.state.CategoriesList
        },
        category() {
            return this.categories.find((cat) => cat.id == this.item.category_id)
        }

    },
    methods: {
      navigate_to_detail_view() {
        this.$router.push({name: 'ecommerce-item-detail-view', params: {item_id: this.item.objectID }})
          .catch(() => {})
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
      quickView(){
        this.popupData = this.item
        this.toggleDataPopup(true)
      },
      toggleDataPopup(val=false) {
        this.popupActive = val
      },
    }
}
</script>

<style lang="scss" scoped>
.product-with-golden-border {
    border-radius: 0;
    padding: 0.5rem;
    box-shadow: none;

    .item-img-container {
        .overlay {
            position: fixed;
            z-index: 9998;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, .5);
        }

        .modal {
            position: relative;
            // width: 600px;
            z-index: 9999;
            margin: 0 auto;
            padding: 1rem;
            background-color: #fff;
        }
    }

    .img-content-container {
        position: relative;

        > img {
            width: 100%;
            height: 12rem;
            opacity: 1;
        }

        > .quick-view {
            transition: .5s ease;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;

            > button {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                border: none;
                color: #fff;
                background: #9a805d;
                opacity: 0.5;
                padding: 0.5rem 1rem;
                cursor: pointer;
                display: none;
            }
        }
    }

    .img-content-container:hover {
        > .quick-view {
            background: rgba(53, 52, 52, 0.733);

            > button { display: block; }
            > button:hover { opacity: 1; }
        }
    }

    .featured-product {
        font-size: 1rem;
        color: #fff;
        background-color: #5378bc;
        padding: 0.25rem 0.5rem;
        border-top-left-radius: 0.5rem;
        border-bottom-left-radius: 0.5rem;
        right: 0;
    }

    .featured-product.out-of-stock {
        background-color: red;
        opacity: 0.5;
    }

    .grid-view-img {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        transition: .35s;
    }

    /*&:hover {
        transform: translateY(-5px);
        box-shadow: 0px 4px 25px 0px rgba(0,0,0,.25);

        .grid-view-img{
            opacity: 0.9;
        }
    }*/

}
</style>
