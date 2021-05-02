<template>
  <!-- CART DROPDOWN -->
  <vs-dropdown vs-custom-content vs-trigger-click class="cursor-pointer md:mr-2">
    <div class="text-right leading-tight p-2 leading-tight">
      <span class="flex items-center">
        <sup class="badge">{{ cartItems.length }}</sup>
        <img :src="require(`@assets/images/navbar/basket.svg`)" alt="Cart Icon" class="h-6 w-6">
        <span class="text-black cairo">{{ $t('Cart') }}</span>
      </span>
    </div>
      <vs-dropdown-menu class="cart-dropdown vx-navbar-dropdown" :class="{'dropdown-custom': cartItems.length}">

          <!-- IF CART HAVE ITEMS: HEADER -->
          <template v-if="cartItems.length">
              <div class="notification-header text-center p-5 bg-primary text-white">
                  <p class="opacity-75">{{ $t('InYourCart') }}</p>
              </div>

              <!-- CART ITEMS -->
              <component :is="scrollbarTag" ref="mainSidebarPs" class="scroll-area--cart-items-dropdowm p-0 mb-10" :settings="settings" :key="$vs.rtl">
              <ul class="bordered-items">
                  <li
                    v-for="item in cartItems"
                    :key="item.objectID"
                    class="vx-row no-gutter cart-item cursor-pointer"
                    @click="$router.push({name: 'ecommerce-item-detail-view', params: {item_id: item.objectID }}).catch(() => {})">

                      <!-- IMG COL -->
                      <div class="vx-col w-1/5 item-img-container bg-white flex items-center justify-center">
                          <img :src="productsLink + item.images[0]" alt="item" class="cart-dropdown-item-img p-4">
                      </div>

                      <!-- INFO COL -->
                      <div class="vx-col w-4/5 pr-4 pl-2 py-4 flex flex-col justify-center">
                          <span class="font-medium block cart-item-title truncate">{{ item.title.en }}</span>
                          <small class="truncate mb-2">{{ item.desc.en }}</small>
                          <div class="flex items-center justify-between">
                              <span class="text-sm font-medium">{{ item.quantity }} × {{ getDetails(item.details).price }} {{ currency }} </span>
                              <feather-icon icon="XIcon" svgClasses="h-4 w-4 cursor-pointer text-danger" class="hover:text-danger" @click.stop="removeItemFromCart(item)" />
                          </div>
                      </div>
                  </li>
              </ul>
              </component>
              <div
                class=" checkout-footer fixed bottom-0 rounded-b-lg text-primary font-semibold w-full p-2 text-center border border-b-0 border-l-0 border-r-0 border-solid d-theme-border-grey-light cursor-pointer"
                @click="$router.push('/cart').catch(() => {})">

                <span class="flex items-center justify-center">
                  <feather-icon icon="ShoppingCartIcon" svgClasses="h-4 w-4" />
                  <span class="ml-2">View Cart</span>
                </span>

              </div>
          </template>

          <!-- IF CART IS EMPTY -->
          <template v-else>
              <p class="p-4">Your Cart Is Empty.</p>
          </template>
      </vs-dropdown-menu>
  </vs-dropdown>
</template>

<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar'

export default {
  components: {
    VuePerfectScrollbar
  },
  data() {
    return {
      productsLink: 'https://janacard.s3.eu-central-1.amazonaws.com/products/',
      settings: { // perfectscrollbar settings
        maxScrollbarLength: 60,
        wheelSpeed: .60,
      },
      currency: 'QAR',
      short_code: (localStorage.getItem("country_code")) ? localStorage.getItem("country_code") : 'QTR'
    }
  },
  computed: {
    countries () {
      return this.$store.state.CountriesList
    },
    // CART DROPDOWN
    cartItems() {
        return this.$store.state.eCommerce.cartItems.slice().reverse();
    },
    scrollbarTag() {
      return this.$store.getters.scrollbarTag
    }
  },
  methods: {
    removeItemFromCart(item) {
        this.$store.dispatch('eCommerce/toggleItemInCart', item)
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
  created() {
    const currentCountryID  = (localStorage.getItem("country")) ? localStorage.getItem("country") : 1
    const productIndex      = this.countries.findIndex((country) => country.id == currentCountryID)
    this.currency           = this.countries[productIndex].currency
  }
}
</script>

<style lang="scss">
@import "@sass/vuexy/_variables.scss";
@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600&display=swap');

.cairo { font-family: 'Cairo', sans-serif; width: 6.2rem; }
.text-gray { color: #a7a5a4; }

.badge {
  color: #fff;
  background: $primary;
  border-radius: 10rem;
  position: absolute;
  top: 0;
  left: 1.2rem;
  font-size: 0.75rem;
  padding: 0.25rem 0.5rem 0 0.5rem;
  height: 1.5rem;
}
</style>