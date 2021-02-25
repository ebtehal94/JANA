<!-- =========================================================================================
  File Name: ECommerceShop.vue
  Description: eCommerce Shop Page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
    <div id="shop-page">
        <ais-instant-search
            :search-client="searchClient"
            index-name="products" id="algolia-instant-search-demo">

            <!-- AIS CONFIG -->
            <ais-configure :hits-per-page.camel="12" :filters="category ? 'category_id:' + category : ''" :numericFilters="'price_' + shortCode +' > 0'" />

            <div class="algolia-header mb-4">
                <div class="flex md:items-end items-center justify-between flex-wrap">
                    <!-- TOGGLE SIDEBAR BUTTON -->
                    <feather-icon
                        class="inline-flex lg:hidden cursor-pointer mr-4"
                        icon="MenuIcon"
                        @click.stop="toggleFilterSidebar" />

                    <p class="lg:inline-flex hidden font-semibold algolia-filters-label">{{$t('Filters')}}</p>

                    <div class="flex justify-between items-end flex-grow">
                        <!-- Stats -->
                        <!-- <ais-stats>
                            <p slot-scope="{ hitsPerPage, nbPages, nbHits, page, processingTimeMS, query }" class="font-semibold md:block hidden">
                                {{ nbHits }} results found in {{ processingTimeMS }}ms
                            </p>
                        </ais-stats> -->
                        <!-- SEARCH BAR -->

                        <!-- <div class="flex flex-wrap"> -->
                          <div class="search-filter w-2/3">
                            <ais-search-box>
                              <div slot-scope="{ currentRefinement, isSearchStalled, refine }">
                                <div class="relative">

                                  <!-- SEARCH INPUT -->
                                  <vs-input class="w-full vs-input-shadow-drop vs-input-no-border d-theme-input-dark-bg" placeholder="Search here" v-model="currentRefinement" @input="refine($event)" @keyup.esc="refine('')" size="large" />

                                  <!-- SEARCH LOADING -->
                                  <p :hidden="!isSearchStalled" class="mt-4 text-grey">
                                    <feather-icon icon="ClockIcon" svgClasses="w-4 h-4" class="mr-2 align-middle" />
                                    <span>Loading...</span>
                                  </p>

                                  <!-- SEARCH ICON -->
                                  <div slot="submit-icon" class="absolute top-0 right-0 py-4 px-6" v-show="!currentRefinement">
                                    <feather-icon icon="SearchIcon" svgClasses="h-6 w-6" />
                                  </div>

                                  <!-- CLEAR INPUT ICON -->
                                  <div slot="reset-icon" class="absolute top-0 right-0 py-4 px-6" v-show="currentRefinement">
                                    <feather-icon icon="XIcon" svgClasses="h-6 w-6 cursor-pointer" @click="refine('')" />
                                  </div>
                                </div>
                              </div>
                            </ais-search-box>
                          </div>
                            <!-- SORTING -->
                          <div class="sorting flex flex-wrap">
                            <ais-sort-by :items="[
                                { value: 'products', label: 'Featured' },
                                { value: 'products_price_asc', label: 'Lowest Price' },
                                { value: 'products_price_desc', label: 'Highest Price' },
                            ]">
                                <vs-select
                                    :value="currentRefinement"
                                    slot-scope="{ items, currentRefinement, refine }"
                                    @input="(val) => refine(val)"
                                    class="mr-4 vs-input-shadow-drop vs-select-no-border d-theme-input-dark-bg w-48">
                                    <vs-select-item v-for="item in items" :key="item.value" :value="item.value" :text="item.label" />
                                </vs-select>
                            </ais-sort-by>
                            <!-- ITEM VIEW - GRID/LIST -->
                            <div>
                                <feather-icon
                                    icon="GridIcon"
                                    @click="currentItemView='item-grid-view'"
                                    class="p-2 shadow-drop rounded-lg d-theme-dark-bg cursor-pointer"
                                    :svgClasses="{'text-primary stroke-current': currentItemView == 'item-grid-view'}" />
                                <feather-icon
                                    icon="ListIcon"
                                    @click="currentItemView='item-list-view'"
                                    class="p-2 ml-4 shadow-drop rounded-lg d-theme-dark-bg cursor-pointer hidden sm:inline-flex"
                                    :svgClasses="{'text-primary stroke-current': currentItemView == 'item-list-view'}" />
                            </div>
                          </div>
                    </div>
                </div>
            </div>

            <div id="algolia-content-container" class="relative clearfix">
                <vs-sidebar
                    class="items-no-padding vs-sidebar-rounded background-absolute"
                    parent="#algolia-content-container"
                    :click-not-close="clickNotClose"
                    :hidden-background="clickNotClose"
                    v-model="isFilterSidebarActive">

                    <div class="p-6 filter-container">


                        <!-- PRICE SLIDER -->
                        <!-- <h6 class="font-bold mb-3">Price Slider</h6>
                        <ais-range-input attribute="price">
                            <div slot-scope="{ currentRefinement, range, refine }">
                                <vs-slider
                                    class="algolia-price-slider"
                                    text-fixed="$"
                                    :min="range.min"
                                    :max="range.max"
                                    :value="toValue(currentRefinement, range)"
                                    @input="refine({min: $event[0], max: $event[1]})" />
                            </div>
                        </ais-range-input>

                        <vs-divider /> -->

                        <!-- CATEGORIES -->
                        <!-- <h6 class="font-bold mb-4">{{$t('Categories')}}</h6> -->
                        <!-- <ais-hierarchical-menu -->
                          <!-- :attributes="algoliaCategories">
                            <div slot-scope="{
                              items,
                              refine,
                            }"> -->

                        <!-- <div
                            class="m-4 pt-0"
                            v-for  = "item in categories"
                            :key   = "item.label"
                            >
                            <div @click="refineCat(item.label)"
                            :class="['btn-like-broder roundedcorner text-white text-center pt-0',
                             {'bg-golden text-white' : category.includes(item.label)},
                             {'softgray-bg text-dark' : !category.includes(item.label)}
                            ]">
                              <img :src="'/images/'+getIconPath(item.label)+'/'+item.icon+'.svg'" class="h-4 mt-3">
                              <span v-if="$i18n.locale == 'en'" class="ml-2 m-1"> {{item.label}} </span>
                              <span v-else class="ml-2 m-1"> {{item.label_ar}} </span>
                            </div>
                        </div> -->
                            <!-- </div>
                        </ais-hierarchical-menu> -->

                        <!-- <vs-divider /> -->

                        <!-- Brands -->
                        <h6 class="font-bold mb-4">{{$t('Filters')}}</h6>
                        <ais-refinement-list attribute="filter">
                            <div slot-scope="{
                              items,
                              isFromSearch,
                              refine,
                            }">
                                <ul>
                                    <li v-if="isFromSearch && !items.length">No results.</li>
                                    <li v-for="item in items" :key="item.value" class="mb-2 flex items-center justify-between" @click="refine(item.value)">
                                        <vs-checkbox v-if="$i18n.locale == 'en'" v-model="item.isRefined" class="ml-0">{{ item.label.split('|')[0] }}</vs-checkbox>
                                        <vs-checkbox v-else v-model="item.isRefined" class="ml-0">{{ item.label.split('|')[1] }}</vs-checkbox>
                                        <!-- <vs-checkbox v-model="item.isRefined" class="ml-0" @click="refine(item.value)">{{ item.label }}</vs-checkbox> -->
                                        <span>{{ item.count }}</span>
                                    </li>
                                </ul>
                            </div>
                        </ais-refinement-list>
                        <vs-divider />


                        <!-- MULTI RANGE -->
                        <h6 class="font-bold mb-3">{{$t('Price')}}</h6>
                        <ais-numeric-menu attribute="price" :items="numericItems">
                            <ul slot-scope="{ items, refine }">
                                <li
                                    v-for="item in items"
                                    :key="item.value"
                                    class="flex items-center cursor-pointer py-1"
                                    @click="refine(item.value)">

                                    <feather-icon icon="CircleIcon" :svgClasses="[{ 'text-primary fill-current': item.isRefined}, 'h-5 w-5']" />
                                    <span class="ml-2" :class="{'text-primary': item.isRefined}">{{ item.label }}</span>
                                </li>
                            </ul>
                        </ais-numeric-menu>

                        <vs-divider />

                        <!-- Rating -->
                        <!-- <h6 class="font-bold mb-3">Rating</h6>
                        <ais-rating-menu attribute="rating">
                            <ul slot-scope="{ items, refine, createURL }">
                                <li v-for="item in items" :key="item.value" class="mb-2">
                                    <div @click.prevent="refine(item.value)" class="flex justify-between items-center">
                                        <div class="flex items-center flex-wrap">
                                            <feather-icon icon="StarIcon" :svgClasses="[{'text-warning': full, 'text-grey': !full, 'ml-1' : index}, 'cursor-pointer stroke-current h-6 w-6']" v-for="(full, index) in item.stars" :key="index" />
                                            <span class="ml-2">&amp; up</span>
                                        </div>
                                        <span>({{ item.count }})</span>
                                    </div>
                                </li>
                            </ul>
                        </ais-rating-menu> -->

                        <!-- <vs-divider /> -->

                        <ais-clear-refinements class="flex justify-center">
                            <vs-button class="w-full" slot-scope="{ canRefine, refine }" @click.prevent="refine" :disabled="!canRefine">Remove Filters</vs-button>
                        </ais-clear-refinements>
                    </div>
                </vs-sidebar>

                <!-- RIGHT COL -->
                <div :class="{'sidebar-spacer-with-margin': clickNotClose}">


                    <!-- SEARCH RESULT -->
                    <!-- <ais-hits :transform-items="filterProductsByCountry"> -->
                    <ais-hits :transform-items="searchItems">
                        <div slot-scope="{ items }">

                            <!-- GRID VIEW -->
                            <template v-if="currentItemView == 'item-grid-view'">
                              <div class="items-grid-view vx-row items-center justify-center">
                                <!-- <div class="vx-col pl-3 pr-3 w-1/4" > -->
                                    <item-grid-view class="" v-for="item in items" :key="item.objectID" :item="item">
                                      <!-- <grid-item-view class="product vx-col mt-5 w-1/2 md:w-1/4 sm:w-1/3 lg:w-1/4 xl:w-1/4" v-for="item in items" :key="item.objectID" :item="item"></grid-item-view> -->

                                      <!-- SLOT: ACTION BUTTONS -->
                                      <template slot="action-buttons">
                                            <div class="flex flex-wrap justify-center">

                                                <!-- ADD-TO/VIEW-IN CART -->
                                                <div v-if="item.details[shortCode].stock > 0"
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
                                                    <feather-icon icon="HeartIcon" :svgClasses="[{'text-danger fill-current' : isInWishList(item.objectID)}, 'h-6 w-6']" />
                                                </div>

                                                <!--  Share -->
                                                <div
                                                    class="p-2 flex flex-grow items-center justify-center cursor-pointer">
                                                    <feather-icon icon="Share2Icon" class="h-6 w-6" />
                                                </div>
                                            </div>
                                        </template>
                                      </item-grid-view>
                                  <!-- </div> -->
                                </div>
                            </template>

                            <!-- LIST VIEW -->
                            <template v-else>
                                <div class="items-list-view mb-base" v-for="item in items" :key="item.objectID">

                                    <item-list-view :item="item">

                                        <!-- SLOT: ACTION BUTTONS -->
                                        <template slot="action-buttons">
                                            <div
                                                class="item-view-primary-action-btn p-3 rounded-lg flex flex-grow items-center justify-center cursor-pointer mb-3"
                                                @click="toggleItemInWishList(item)">
                                                <feather-icon icon="HeartIcon" :svgClasses="[{'text-danger fill-current' : isInWishList(item.objectID)}, 'h-4 w-4']" />
                                                <span class="text-sm font-semibold ml-2">WISHLIST</span>
                                            </div>
                                            <div v-if="item.details[shortCode].stock > 0"
                                                class="item-view-secondary-action-btn bg-primary p-3 rounded-lg flex flex-grow items-center justify-center text-white cursor-pointer"
                                                @click="cartButtonClicked(item)">
                                                <feather-icon icon="ShoppingBagIcon" svgClasses="h-4 w-4" />

                                                <span class="text-sm font-semibold ml-2" id="addToCartBtn" ref="addToCartBtn" v-if="isInCart(item.objectID)">VIEW IN CART</span>
                                                <span class="text-sm font-semibold ml-2" v-else>ADD TO CART</span>
                                            </div>
                                        </template>
                                    </item-list-view>

                                </div>
                            </template>
                        </div>
                    </ais-hits>

                    <!-- PAGINATION -->
                    <ais-pagination>
                        <div slot-scope="{
                                currentRefinement,
                                nbPages,
                                pages,
                                isFirstPage,
                                isLastPage,
                                refine,
                            }"
                        >

                        <vs-pagination

                            :total="nbPages"
                            :max="7"
                            :value="currentRefinement + 1"
                            @input="(val) => { refine(val - 1) }" />
                        </div>
                    </ais-pagination>

                    <!-- ALGOLIA LOGO -->
                    <!-- <img class="flex mt-4 mx-auto h-8" src="@assets/images/pages/eCommerce/Algolia-logo.png" alt="algolia-logo"> -->
                </div>
            </div>
        </ais-instant-search>
    </div>
</template>

<script>
import {
  AisClearRefinements,
  AisConfigure,
  // AisHierarchicalMenu,
  AisHits,
  AisInstantSearch,
  AisNumericMenu,
  AisPagination,
  // AisRangeInput,
  // AisRatingMenu,
  AisRefinementList,
  AisSearchBox,
  AisSortBy,
  // AisStats
} from 'vue-instantsearch'
import algoliasearch from 'algoliasearch/lite'

export default {
  components: {
    ItemGridView: () => import("./components/ItemGridView.vue"),
    ItemListView: () => import("./components/ItemListView.vue"),
    AisClearRefinements,
    AisConfigure,
    // AisHierarchicalMenu,
    AisHits,
    AisInstantSearch,
    AisNumericMenu,
    AisPagination,
    // AisRangeInput,
    // AisRatingMenu,
    AisRefinementList,
    AisSearchBox,
    AisSortBy,
    // AisStats
  },
  data() {
    return {
      searchClient: algoliasearch(
        'SXG4PV0YAT',
        '42b8e7ea3e742f53ca29e378b2e53e38'
      ),
      category:'',
      shortCode:'',
      search: '',
      isFilterSidebarActive: true,
      clickNotClose: true,
      currentItemView: 'item-grid-view',
      numericItems: [
        { label: 'جميع المنتجات' },
        { label: 'اقل من 10 ر.س', end: 10 },
        { label: ' 10 إلى 50 ر.س', start: 10, end: 50 },
        { label: ' 50 إلى 100 ر.س', start: 50, end: 100 },
        { label: 'اكثر من 100 ر.س', start: 100 },
      ],
      algoliaCategories: [
        'category',
        // 'hierarchicalCategories.lvl1',
        // 'hierarchicalCategories.lvl2',
        // 'hierarchicalCategories.lvl3',
      ],
    }
  },
  computed: {
    getIconPath() {
      return (label) => (label == this.category || this.$store.state.theme == 'light') ? 'icons-b':'icons-w';
    },
    categories () {
      return this.$store.state.CategoriesList
    },
    countries () {
      return this.$store.state.CountriesList
    },
    // GRID VIEW
    isInCart() {
      return (itemId) => this.$store.getters['eCommerce/isInCart'](itemId)
    },
    isInWishList() {
      return (itemId) => this.$store.getters['eCommerce/isInWishList'](itemId)
    },
    windowWidth() { return this.$store.state.windowWidth }
  },
  watch: {
    windowWidth() {
      this.setSidebarWidth()
    }
  },
  methods: {
    searchItems (items) {
      return items.filter(item => (item.title.en.indexOf(this.search) !== -1 || item.title.ar.indexOf(this.search) !== -1))
    },
    refineCat(cat){
      const ourCat = this.categories.find(d => d.label === cat)
      this.category = ourCat.label + '|' + ourCat.label_ar
      console.log(this.category)
      return true
    },
    getCategoryFullName () {
      return (cat) => this.categories.filter(category => {
        if (category.label.includes(cat))  {
          return category
        }
      })[0]
    },
    setSidebarWidth() {
      if (this.windowWidth < 992) {
        this.isFilterSidebarActive = this.clickNotClose = false
      } else {
        this.isFilterSidebarActive = this.clickNotClose = true
      }
    },

    // GRID VIEW - ACTIONS
    toggleFilterSidebar() {
      if (this.clickNotClose) return
      this.isFilterSidebarActive = !this.isFilterSidebarActive
    },
    toggleItemInWishList(item) {
      this.$store.dispatch('eCommerce/toggleItemInWishList', item)
    },
    additemInCart(item) {
      item['quantity'] = 1
      this.$store.dispatch('eCommerce/additemInCart', item)
    },
    cartButtonClicked(item) {
      this.isInCart(item.objectID) ? this.$router.push('/cart').catch(() => {}) : this.additemInCart(item)
    },
  },
  created() {
    this.setSidebarWidth()

    this.search = this.$route.params.search
    let categoryName = this.$route.params.category

    if (categoryName) {
      const cat = this.categories.find(d => d.cat === categoryName)
      this.category = cat.id
    }


    for (const el of this.countries) {
       if (localStorage.getItem("country") == el.id) {
           this.shortCode = el.short_code
        }
    }

  },
}

</script>


<style lang="scss">
#shop-page {
  margin: 2rem;
}

#algolia-instant-search-demo {
  .algolia-header {
    .algolia-filters-label {
      width: calc(260px + 2.4rem);
    }
  }

  #algolia-content-container {

    .vs-sidebar {
      position: relative;
      float: left;
      z-index: 0 !important;
    }
  }



  .algolia-search-input-right-aligned-icon {
    padding: 1rem 1.5rem;
  }

  .algolia-price-slider {
    min-width: unset;
  }

  .item-view-primary-action-btn {
    color: #2c2c2c !important;
    background-color: #f6f6f6;
    min-width: 50%;
  }

  .item-view-secondary-action-btn {
    min-width: 50%;
    border-radius: 5px;
    color: #fff !important;
  }
}

.theme-dark {
  #algolia-instant-search-demo {
    #algolia-content-container {
      .vs-sidebar {
        background-color: #212121;
      }
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
            width: 100%;
        }
    }
}

@media (max-width: 768px) {
  .search-filter {
    display: none;
  }
}

@media (min-width: 992px) {
  .vs-sidebar-rounded {
    .vs-sidebar {
      border-radius: .5rem;
    }

    .vs-sidebar--items {
      border-radius: .5rem;
    }
  }
}

@media (max-width: 992px) {
  #algolia-content-container {
    .vs-sidebar {
      position: absolute !important;
      float: none !important;
    }
  }
}

</style>
