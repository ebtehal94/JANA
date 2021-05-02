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
            <div class="text-center vx-col mt-5 w-1/2 md:w-1/4 sm:w-1/3 lg:w-1/4 xl:w-1/4 my-10" v-on="$listeners">
                <!-- <template slot=""> -->
                    <div v-if="item.details.status == 1" class="absolute mt-2 featured-product" color="primary">
                      <span>جديد</span>
                    </div>
                    <div v-if="item.details[country.short_code].stock == 0" class="absolute mt-2 featured-product out-of-stock" transparent color="danger">
                      <span>نفذت الكمية</span>
                    </div>

                    <!-- ITEM IMAGE -->
                    <div class="item-img-container justify-center mb-4 cursor-pointer" @click="navigate_to_detail_view" >
                        <img :src="productsLink + item.images[0]" :alt="item.title.en" class="grid-view-img responsive px-2">
                        <h6 class="prod-title truncate font-semibold mb-1 px-2 hover:text-primary cursor-pointer mt-4" @click="navigate_to_detail_view">{{ $i18n.locale == 'en' ? item.title.en : item.title.ar }}</h6>
                    </div>
                    <div class="px-4">
                        <!-- TITLE & DESCRIPTION -->
                        <div class="mt-4 background-white">
                            <!-- <p class="item-description truncate text-sm">{{ item.desc_en }}</p> -->
                        </div>
                        <div class="mt-4">
                            <h6 class="font-bold mb-2 text-dark"><span class="text-danger">{{ item['price_' + country.short_code]    }}</span> {{ $t(currency) }}</h6>
                        </div>

                    </div>

                    <!-- SLOT: ACTION BUTTONS -->
                    <slot name="action-buttons" />
                <!-- </template> -->
            </div>
</template>

<script>
export default{
    props: {
        item: {
            type: Object,
            required: true
        },
    },
    data(){
      return {
        productsLink: 'https://janacard.s3.eu-central-1.amazonaws.com/products/',
        currency: (localStorage.getItem("currency")) ? localStorage.getItem("currency") : 'QR',
        country: null
      }
    },
    methods: {
      navigate_to_detail_view() {
        this.$router.push({name: 'ecommerce-item-detail-view', params: {item_id: this.item.objectID }})
          .catch(() => {})
      },
    },
    computed: {
      countries () {
        return this.$store.state.CountriesList
      },
    },
    created() {
        const currentCountryID  = (localStorage.getItem("country")) ? localStorage.getItem("country") : 1
        this.country      = this.countries.find((country) => country.id == currentCountryID)

      // priceInCountry(details) {
      //   for (const detail of details) {
      //     if (detail.country_id == localStorage.getItem("country")) {
      //       return detail.price;
      //     }
      //   }
      // }
    }
}
</script>

<style lang="scss" scoped>
.product-with-golden-border {
    border-radius: 0;
    // padding: 0.5rem;
    box-shadow: none;
    .featured-product {
        font-size: 0.8rem;
        color: #fff;
        background-color: #5378bc;
        padding: 0.25rem 0.5rem;
        border-top-right-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
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
