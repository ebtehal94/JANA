
<template>
  <ais-instant-search
      :search-client="algolia_index"
      index-name="products" id="algolia-instant-search-demo">
    <ais-hierarchical-menu :attributes="['category']" >
        <div slot-scope="{
          items,
          refine,
        }">
          <vs-row vs-type="flex" vs-justify="center" class="mt-6 md:mt-16 relative md:absolute">
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="1" vs-sm="4"
                  class="ml-2"
                  v-for  = "item in items"
                  :key   = "item.value">
                  <div @click="refine(item.value)"
                  :class="['btn-like-broder p-2 roundedcorner mt-10 text-dark-always p-2 w-full flex',
                   {'bg-golden text-dark-always' : item.isRefined},
                   {'softgray-bg text-dark' : !item.isRefined}
                  ]">
                  <!-- <vs-button class="roundedcorner mt-10 text-dark-always p-2 w-full flex text-white"
                    :color="item.isRefined ? '#FFFB7D' : '#2d2d2d'"
                    :gradient-color-secondary="item.isRefined ? 'rgb(247, 183, 35)' : 'rgb(110, 110, 110)'"
                    :type="item.isRefined ? 'gradient' : 'filled'"> -->
                    <img :src="'/images/'+getIconPath(item.isRefined)+'/'+getCategoryIcon(item.label.split('|')[0])+'.svg'" class="h-6 m-1">
                    <span v-if="$i18n.locale == 'en'" class="ml-2"> {{ item.label.split('|')[0] }} </span>
                    <span v-else class="ml-2"> {{ item.label.split('|')[1] }} </span>
                  </div>
            </vs-col>
          </vs-row>
        </div>
    </ais-hierarchical-menu>

    <br/>
    <!-- Product Feature/Meta Row -->
    <div class="pb-12 text-center softgray-bg md:the-second-container roundedcorner md:px-24 md:mt-24">
      <!-- <ais-refinement-list
          attribute="filter">
          <div slot-scope="{
            items,
            isFromSearch,
            refine,
          }">
            <vs-row vs-type="flex" vs-justify="center" class="mt-4">
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="1" vs-sm="4"
                class="ml-2"
                v-for  = "item in items"
                :key   = "item.value">
                  <div v-if="isFromSearch && !items.length">No results.</div>
                  <div @click="refine(item.value)"
                  :class="['btn-like-broder p-2 roundedcorner mt-10 text-dark-always p-2 w-full flex',
                   {'bg-golden text-dark-always' : item.isRefined},
                   {'softgray-bg text-dark' : !item.isRefined}
                  ]">
                    <span v-if="$i18n.locale == 'en'" class="ml-2"> {{ item.label.split('|')[0] }} </span>
                    <span v-else class="ml-2"> {{ item.label.split('|')[1] }} </span>
                  </div>
              </vs-col>
            </vs-row>
          </div>
      </ais-refinement-list> -->

      <!-- AIS CONFIG -->
      <ais-configure :hits-per-page.camel="8" />

  <!-- SEARCH RESULT -->
      <ais-hits>
          <div slot-scope="{ items }">

              <!-- GRID VIEW -->
              <template>
                  <div class="md:pt-24 mt-16 items-grid-view vx-row items-center justify-center p-10 match-height">
                      <div class="vx-col lg:w-1/4 sm:w-1/2 w-full pl-6 pr-6" v-for="item in items" :key="item.objectID">

                          <item-grid-view :item="item">

                              <!-- SLOT: ACTION BUTTONS -->
                              <template slot="action-buttons">
                                  <div class="flex flex-wrap">

                                      <!-- PRIMARY BUTTON: ADD TO WISH LIST -->
                                      <div
                                          class="dark-and-white-bg p-3 flex flex-grow items-center justify-center cursor-pointer dark-and-white-text "
                                          @click="toggleItemInWishList(item)">
                                          <feather-icon icon="HeartIcon" :svgClasses="[{'text-danger fill-current' : isInWishList(item.objectID)}, 'h-4 w-4']" />

                                          <span class="text-sm font-semibold ml-1">{{$t('Wishlist')}}</span>
                                      </div>

                                      <!-- SECONDARY BUTTON: ADD-TO/VIEW-IN CART -->
                                      <div
                                          class="item-view-secondary-action-btn bg-primary p-3 flex flex-grow items-center justify-center text-white cursor-pointer"
                                          @click="cartButtonClicked(item)">
                                          <feather-icon class="text-dark-always" icon="ShoppingCartIcon" svgClasses="h-4 w-4" />

                                          <span class="text-xs font-semibold text-dark-always" v-if="isInCart(item.objectID)">{{$t('ViewInCart')}}</span>
                                          <span class="text-xs font-semibold text-dark-always" v-else>{{$t('AddToCart')}}</span>
                                      </div>
                                  </div>
                              </template>
                          </item-grid-view>

                      </div>
                  </div>
              </template>

          </div>
      </ais-hits>
    </div>

  </ais-instant-search>
</template>

<script>
import {
  AisClearRefinements,
  AisConfigure,
  AisHierarchicalMenu,
  AisHits,
  AisInstantSearch,
  // AisNumericMenu,
  // AisPagination,
  // AisRangeInput,
  // AisRatingMenu,
  AisRefinementList,
  // AisSearchBox,
  AisSortBy,
  // AisStats
} from 'vue-instantsearch'

import algoliasearch from 'algoliasearch/lite'


export default{
    // props: {
        // item: {
        //     type: Object,
        //     required: true
        // },
    // },
    components: {
      ItemGridView: ()      => import("./ItemGridView.vue"),
      AisClearRefinements,
      AisConfigure,
      AisHierarchicalMenu,
      AisHits,
      AisInstantSearch,
      AisRefinementList,
      AisSortBy,

    },
    data(){
      return {
        algolia_index: algoliasearch(
          'SXG4PV0YAT',
          '8eef2c401974b661a6c0fa482ee65849'
        ),
        productsLink: 'https://janacard.s3.eu-central-1.amazonaws.com/products/',
      }
    },
    computed: {
      getCategoryIcon () {
        return (cat) => this.categories.filter(category => {
          if (category.label.includes(cat))  {
            return category.icon
          }
        })[0].icon
      },
      categories () {
        return this.$store.state.CategoriesList
      },
      getIconPath() {
        return (isSelected) => (isSelected || this.$store.state.theme == 'light') ? 'icons-b':'icons-w';
      },
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
    }
}
</script>

<style lang="scss" scoped>
  .grid-view-item {
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
