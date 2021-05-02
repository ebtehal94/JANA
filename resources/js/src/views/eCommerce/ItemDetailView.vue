<!-- =========================================================================================
  File Name: ECommerceItemDetail.vue
  Description: eCommerce Item Detail page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="item-detail-page">

    <vs-alert color="danger" title="Error Fetching Product Data" :active.sync="error_occured">
      <span>{{ error_msg }}. </span>
      <span>
        <span>Check </span><router-link :to="{name:'ecommerce-shop'}" class="text-inherit underline">All Items</router-link>
      </span>
    </vs-alert>

    <div v-if="breadcrumbs!= null && breadcrumbs.length > 0" class="breadcrumbs mx-10 my-6">
      <p>
        <span v-for="(bc, i) in breadcrumbs" :key="bc.url">
          <a :href="bc.url">{{ $t(bc.title) }}</a>
          <span v-if="i != breadcrumbs.length - 1"> > </span>
        </span>
      </p>
    </div>

    <vx-card id="main-content" v-if="item_data" :key="item_data.objectID">
      <template slot="no-body">
        <!-- Item Main Info -->
        <div class="product-details p-3">
          <!-- <div v-if="item_data['status_'+ country.short_code] == 1" class="absolute mt-2 featured-product" color="primary">
            <span>{{ $t('FeaturedProduct') }}</span>
          </div> -->
          <div v-if="item_data['status_'+ country.short_code] == 2" class="absolute mt-2 featured-product out-of-stock" transparent color="danger">
            <span>{{ $t('OutOfStock') }}</span>
          </div>
          <!-- <div v-if="item_data['status_'+ country.short_code] == 3" class="absolute mt-2 featured-product out-of-stock" color="warning">
            <span>{{ $t('SpecialOffer') }}</span>
          </div> -->

          <div class="vx-row">
            <div class="vx-col md:w-3/5 w-full p-0">
              <product-images :product_images="item_data.images" />
            </div>
            <div class="vx-col md:w-2/5 p-4 mt-6">
              <h3>{{ $i18n.locale == 'en' ?  item_data.title.en : item_data.title.ar }}</h3>
              <p class="my-4 text-success">
                {{ (item_data.details[country.short_code].stock > 0) ? $t('Available') : $t('Notavailable') }}
              </p>
              <p>{{ $i18n.locale == 'en' ?  item_data.desc.en : item_data.desc.ar }}</p>
              <div class="vx-row my-4 p-4">
                <h3 class="font-bold text-primary">{{ item_data['price_'+ country.short_code] }} {{ $t(currency) }}</h3>
              </div>
              <p class="mt-8">{{$t('ProductDetails')}}</p>
              <table class="product-detail my-5">
                <tbody>
                  <tr v-if="item_data.code">
                      <th class="px-4">{{$t('ProductID')}}</th>
                      <td class="px-4">{{item_data.code}}</td>
                  </tr>
                  <tr v-if="item_data.color">
                      <th class="px-4">{{$t('ProductColor')}}</th>
                      <td class="px-4">{{$t(item_data.color) || item_data.color}}</td>
                  </tr>
                  <tr v-if="item_data.size">
                    <th class="px-4">{{$t('ProductSize')}}</th>
                    <td class="px-4">{{item_data.size}}</td>
                  </tr>
                  <tr v-if="item_data.collection">
                    <th class="px-4">{{$t('CollectionName')}}</th>
                    <td class="px-4">{{ $i18n.locale == 'en' ?  item_data.collection.en : item_data.collection.ar }}</td>
                  </tr>
                </tbody>
              </table>

              <!-- Quantity -->
              <div class="quantity">
                  <div class="price-details flex flex-wrap justify-center items-center px-2">
                    <feather-icon @click="toggleItemInWishList(item_data)" class="mx-auto" icon="HeartIcon" :svgClasses="[{'text-danger fill-current' : isInWishList(item_data.objectID)}, 'h-10 w-10 mx-auto']" />

                    <!-- <div class="vx-col w-1/2"> -->
                        <!-- Add To Cart Button -->
                        <vs-button
                        class="add-to-cart w-1/2 md:mt-0 mt-4 ml-4"
                        icon-pack="feather"
                        icon="icon-shopping-cart"
                        v-if="!isInCart(item_data.objectID)"
                        @click="toggleItemInCart(item_data)">
                        {{$t('AddToCart')}}
                        </vs-button>

                        <vs-button
                        v-else
                        class="add-to-cart w-1/2 md:mt-0 mt-2"
                        icon-pack="feather"
                        icon="icon-shopping-cart"
                        @click="$router.push({name: 'ecommerce-cart'}).catch(err => {})">
                        {{$t('ViewInCart')}}
                        </vs-button>
                        <!-- /Add To Cart Button -->
                    <!-- </div> -->

                    <div class="qty-container flex">
                        <button @click="increment()"><img class="responsive payment-img mx-1" src="@assets/images/icons-p/up.svg" alt="increment button"></button>
                        <input type="text" :value="quantity" disabled>
                          <button @click="decrement()"><img class="responsive payment-img mx-1" src="@assets/images/icons-p/down.svg" alt="decrement button"></button>
                    </div>
                  </div>
              </div>
              <!-- /Quantity -->

              <!-- extras -->
              <div class="mt-5">
                <div class="flex justify-between items-center">
                  <p>{{$t('Delivery')}}</p>
                  <p class="p-4">{{$t('DeliveryDetails')}}</p>
                  <a href="#">{{$t('MoreDetails')}}</a>
                </div>
                <div class="flex justify-between items-center">
                  <p>{{$t('PaymentMethods')}}</p>
                  <div class="flex p-4">
                    <img class="responsive payment-img mx-1" src="@assets/images/icons-p/payment/visa.svg" alt="social button">
                    <img class="responsive payment-img mx-1" src="@assets/images/icons-p/payment/paypal.svg" alt="social button">
                    <img class="responsive payment-img mx-1" src="@assets/images/icons-p/payment/master_card.svg" alt="social button">
                    <img class="responsive payment-img mx-1" src="@assets/images/icons-p/payment/cash_on_delivery.svg" alt="social button">
                  </div>
                  <a href="#">{{$t('MoreDetails')}}</a>
                </div>
                <div class="flex justify-between items-center">
                  <p>{{$t('Insurance')}}</p>
                  <img class="responsive payment-img mx-1" src="@assets/images/icons-p/payment/insurance.svg" alt="social button">
                  <a href="#">{{$t('MoreDetails')}}</a>
                </div>
              </div>
              <!-- extras -->
            </div>
          </div>
          </div>
      </template>

      <!--- Related products -->
      <div class="related-products mt-4">
        <ais-instant-search :search-client="searchClient" index-name="products" id="algolia-instant-search-demo">

          <ais-configure :hits-per-page.camel="12" :filters="'category_id:' + item_data.category_id +' AND price_'+short_code+' > 0'" />

          <h5>{{$t('ProductsMayLike')}}</h5>
          <ais-hits>
          <!-- <ais-hits :transform-items="relatedItems"> -->
            <div slot-scope="{ items }">
                <template>
                  <div v-if="items.length != 0" class="items-grid-view vx-row items-center justify-center">
                        <!-- <div class="vx-col pl-3 pr-3 w-1/5"> -->
                        <item-grid-view v-for="item in items" :key="item.objectID" :item="item">
                                <!-- SLOT: ACTION BUTTONS -->
                                <template slot="action-buttons">
                                  <div class="md:flex md:flex-wrap justify-center">

                                        <!-- ADD-TO/VIEW-IN CART -->
                                        <div
                                            class="item-view-secondary-action-btn bg-primary text-white p-2 flex flex-grow items-center justify-center cursor-pointer"
                                            @click="(!isInCart(item.objectID)) ? toggleItemInCart(item) : $router.push('/cart')">
                                            <feather-icon class="text-white" icon="ShoppingCartIcon" svgClasses="h-4 w-4" />

                                            <span class="text-xs font-semibold text-white" v-if="isInCart(item.objectID)">{{$t('ViewInCart')}}</span>
                                            <span class="text-xs font-semibold text-white" v-else>{{$t('AddToCart')}}</span>
                                        </div>
                                        <!-- <vs-button v-if="isInCart(item.objectID)" class="p-2 font-semibold" icon-pack="feather" icon="icon-shopping-cart" @click="cartButtonClicked(item)">
                                            {{$t('ViewInCart')}}
                                        </vs-button>

                                        <vs-button v-else class="p-2 font-semibold" icon-pack="feather" icon="icon-shopping-cart" @click="cartButtonClicked(item)">
                                            {{$t('AddToCart')}}
                                        </vs-button> -->

                                        <!--  ADD TO WISH LIST -->
                                        <div
                                            class="p-2 flex flex-grow items-center justify-center cursor-pointer"
                                            >
                                            <feather-icon @click="toggleItemInWishList(item)" icon="HeartIcon" :svgClasses="[{'text-danger fill-current' : isInWishList(item.objectID)}, 'h-7 w-7']" />
                                        <!-- </div> -->

                                        <!--  Share -->
                                        <!-- <div -->
                                            <!-- class="p-2 flex flex-grow items-center justify-center cursor-pointer"> -->
                                            <feather-icon icon="Share2Icon" class="h-10 w-10 mx-auto" />
                                        </div>
                                    </div>
                                </template>
                            </item-grid-view>
                        <!-- </div> -->
                    </div>
                    <div v-else>
                      <p class="text-center p-10">{{$t('NoRelatedItems')}}</p>
                    </div>
                </template>
            </div>
          </ais-hits>
        </ais-instant-search>
      </div>
    </vx-card>
  </div>
</template>

<script>
import 'swiper/dist/css/swiper.min.css'
import { swiper, swiperSlide } from 'vue-awesome-swiper'
import algoliasearch from 'algoliasearch/lite'
import StarRating from 'vue-star-rating'
import { AisConfigure, AisHits, AisInstantSearch } from 'vue-instantsearch'


export default{
  components: {
    ItemGridView: () => import("./components/ItemGridView.vue"),
    ProductImages: () => import("./components/ProductImages.vue"),
    swiper,
    swiperSlide,
    StarRating,
    AisConfigure,
    AisHits,
    AisInstantSearch,
  },
  data() {
    return {
      country: null,
      imagePopupActive: false,
      currentImage: 0,
      quantity: 1,
      indexInCart: null,
      category:'',
      currency: (localStorage.getItem("currency")) ? localStorage.getItem("currency") : 'QAR',
      short_code: (localStorage.getItem("country_code")) ? localStorage.getItem("country_code") : 'QTR',
      searchClient: algoliasearch(
        'SXG4PV0YAT',
        '42b8e7ea3e742f53ca29e378b2e53e38'
      ),
      algolia_index: algoliasearch(
        'SXG4PV0YAT',
        '42b8e7ea3e742f53ca29e378b2e53e38'
      ).initIndex("products"),
      item_data: null,
      error_occured: false,
      error_msg: "",

      productsLink: 'https://janacard.s3.eu-central-1.amazonaws.com/products/',

      // Related Products Swiper
      swiperOption: {
          slidesPerView: 5,
          spaceBetween: 55,
          breakpoints: {
              1600: {
                slidesPerView: 4,
                spaceBetween: 55,
              },
              1300: {
                slidesPerView: 3,
                spaceBetween: 55,
              },
              900: {
                  slidesPerView: 2,
                  spaceBetween: 55
              },
              640: {
                  slidesPerView: 1,
                  spaceBetween: 55
              }
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
          }
      },

      // Below is data which is common in any item
      // Algolia's dataSet don't provide this kind of data. So, here's dummy data for demo
      available_item_colors: ["#7367F0", "#28C76F", "#EA5455", "#FF9F43", "#1E1E1E"],
      opt_color: "#7367F0",
      is_hearted: false,

      // related_items: []
    }
  },
  computed: {
    breadcrumbs() {
      if(this.$route.meta.breadcrumb) {
        return this.$route.meta.breadcrumb.map(element => {
          if(element.title == 'ProductDetails') {
            this.algolia_index.getObject(this.$route.params.item_id, (err, content) => {
              if(!err) {
                element.title = content.title.ar
              }
            })
          }
          return element
        })
      }
    },
    countries () {
      return this.$store.state.CountriesList
    },
    item_qty() {
      const item = this.$store.getters['eCommerce/getCartItem'](this.item_data.objectID)
      return Object.keys(item).length ? item.quantity : 1
    },
    item_index() {
      return this.$store.getters['eCommerce/getItemIndex'](this.item_data.objectID)
    },
    itemColor() {
      return (obj) => {
        let style_obj = {}

        obj.style.forEach(p => { style_obj[p] = obj.color })

        return style_obj
      }
    },
    isInWishList() {
        return (itemId) => this.$store.getters['eCommerce/isInWishList'](itemId)
    },
    isInCart() {
      return (itemId) => this.$store.getters['eCommerce/isInCart'](itemId)
    },
    cartItems() {
      return this.$store.state.eCommerce.cartItems.slice().reverse();
    }
  },
  methods: {
    // relatedItems(items) {
    //   items = items.filter(item => item.id != this.item_data.id)
    //   return items.filter(item => {
    //     let product = false
    //     for (const [key, val] of Object.entries(item.details)) {
    //       if (key == this.short_code && val.status != 5) {
    //         product = true
    //       }
    //     }
    //
    //     return product
    //   })
    // },
    updateProductImage (index) {
      this.currentImage = index
    },
    total_price(price) {
      return price * this.quantity
    },
    toggleItemInWishList(item) {
      this.$store.dispatch('eCommerce/toggleItemInWishList', item)
    },
    toggleItemInCart(item) {
      item["quantity"] = this.quantity
      this.$store.dispatch('eCommerce/toggleItemInCart', item)
    },
    fetch_item_details(id) {
      this.algolia_index.getObject(id, (err, content) => {
        if(err) {
          this.error_occured = true
          this.error_msg = err.message
          console.error(err);
        }else {
          this.item_data = content
          this.isInCart(this.item_data.objectID) ? this.quantity = this.item_qty : this.quantity = 1
          this.isInCart(this.item_data.objectID) ? this.indexInCart = this.item_index : null
        }
      })

    },
    increment() {
      this.quantity++
    },
    decrement() {
      (this.quantity === 1) ? this.quantity = 1 : this.quantity--
    },
    updateItemQuantity(event, index) {
      const itemIndex = Math.abs(index + 1 - this.cartItems.length)
      this.$store.dispatch("eCommerce/updateItemQuantity", { quantity: event, index: itemIndex })
    },
  },
  created() {
    this.fetch_item_details(this.$route.params.item_id)
    const currentCountryID  = (localStorage.getItem("country")) ? localStorage.getItem("country") : 1
    this.country            = this.countries.find((country) => country.id == currentCountryID)
  }
}
</script>

<style lang="scss" scoped>

@import "@sass/vuexy/_variables.scss";

#item-detail-page {
  margin: 0 1rem;

  #main-content {
    border: none;
    border-radius: 0;
    box-shadow: none;
  }

  .product-images {
    margin: 0;
    width: 15rem;

    img {
      border: 1px solid #e2e2e2;
    }

    .active-image {
      border: 1px solid #ff8d0a;
    }
  }

  #main-img {
    // width: 600px;
    // height: 500px;
    margin: 1rem;
    // background-size: contain !important;
    // position: center center !important;
    // background-repeat: no-repeat !important;
    transition: 0.5s all ease-in-out;
  }

  #main-img:hover { transform: scale(1.2);  }

  .social-button {
    img {
      width: 1.5rem;
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

  table.product-detail {
    width: 100%;
    border-radius: 0.5rem;
  }

  table.product-detail, th, td {
    border: 1px solid #e2e2e2;
    border-spacing: 0;
  }

  table.product-detail {
    tbody {
      tr:first-child {
        th { border-top-left-radius: 0.5rem; }
        td { border-top-right-radius: 0.5rem; }
      }

      tr:last-child {
        th { border-bottom-left-radius: 0.5rem; }
        td { border-bottom-right-radius: 0.5rem; }
      }
    }
  }

  .quantity {
    border: 1px solid #e2e2e2;
    border-radius: 1rem;
    width: 100%;
    padding: 1rem;

    #qty {
      font-size: 1.5rem;
    }

    // .add-to-cart {
    //   // width: 23rem;
    // }

    .wishlist {
      border: 1px solid #e2e2e2;
      border-radius: 10rem;
      padding: 1rem;
    }

    .price-details {
      > div {
        padding: 0 0.5rem;
      }

      .qty-container {
        border-left: 1px solid #e2e2e2;
        border-right: 1px solid #e2e2e2;

        > button {
          background: transparent;
          border: none;
          margin: 0 0.5rem;

          > img {
            width: 1.5rem;
          }
        }

        > input {
          width: 4.5rem;
          height: 3rem;
          border-radius: 1rem;
          padding: 0.25rem;
          text-align: center;
          border: 1px solid #e2e2e2;
          background: #fff;
        }
      }
    }
  }

  .payment-img {
    width: 2.5rem;
  }

  .insurance {
    width: 2.5rem;
  }

  hr {
    width: 80%;
    margin: auto;
    border-top: 1px solid #e2e2e2;
  }

  .color-radio {
    height: 2.28rem;
    width: 2.28rem;

    > div {
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
  }

  .item-features {
    background-color: #f7f7f7;

    .theme-dark & {
      background-color: $theme-dark-secondary-bg;
    }
  }

  .product-sales-meta-list {
    .vs-list--icon {
      padding-left: 0;
    }
  }

  .related-product-swiper {
      // padding-right: 2rem;
      // padding-left: 2rem;

    .swiper-wrapper {
      padding-bottom: 2rem;

      > .swiper-slide {
        background-color: #f7f7f7;
        box-shadow: 0 4px 18px 0 rgba(0,0,0,0.1), 0 5px 12px 0 rgba(0,0,0,0.08) !important;

        .theme-dark & {
          background-color: $theme-light-dark-bg;
        }
      }
    }

    .swiper-button-next,
    .swiper-button-prev {
      transform: scale(.5);
      filter: hue-rotate(40deg);
    }

    .swiper-button-next {
      right: 0
    }

    .swiper-button-prev {
      left: 0;
    }
  }
}

@media only screen and (min-width: 992px) {
  .price-details {
    .qty-container {
      margin-top: 1rem;
      border-left: none !important;
      border-right: none !important;
    }
  }
}

@media only screen and (min-width: 320px) and (max-width: 768px) {
  .price-details {
    .qty-container {
      margin-top: 1rem;
      border-left: none !important;
      border-right: none !important;
    }
  }
}

@media only screen and (max-width: 600px) {
  #item-detail-page {
    .product-details {
      width: 100%;

      .images {
        display: block !important;
        .product-images {
          display: flex;
          justify-content: center;
          width: 100%;

          > img {
            width: 5rem;
            height: 5rem;
            margin: 0.5rem;
          }
        }

        #main-img {
          // width: 100%;
        }

        table.product-detail {
          width: 50%;
        }
      }
    }
  }
}
</style>
