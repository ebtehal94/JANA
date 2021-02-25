<template>
  <div class="relative">
    <div class="nav-menu-wrapper">
      <vs-navbar class="navbar-custom nav-height" :color="navbarColor">
        <ul class="flex flex-wrap w-full justify-center items-center">
          <li
          class  = "menu-item"
          v-for  = "(item, index) in navMenuItems"
          :key   = "index"
          :class = "{'mr-2': !(navMenuItems.length === index+1)}">

          <!-- If header -->
          <template v-if="item.header && $acl.check(item.rule)">
              <h-nav-menu-header :header="item" class="menu-header relative" />
          </template>

          <!-- If it's group -->
          <template v-else-if="item.submenu">
              <h-nav-menu-group
              class="menu-group relative"
              bottom
              :key        ="`group-${index}`"
              :group      ="item"
              :groupIndex ="index"
              :open       ="checkGrpChildrenActive(item)" />
          </template>

          <!-- If it's link -->
          <div v-else-if="item.url && $acl.check(item.rule) && (!item.maxRule || (item.maxRule && $acl.not.check(item.maxRule)))" class="menu-link">
              <h-nav-menu-item
              class       = "relative cursor-pointer"
              :to         = "item.slug !== 'external' ? item.url : null"
              :href       = "item.slug === 'external' ? item.url : null"
              :icon       = "item.icon"
              :target     = "item.target"
              :isDisabled = "item.isDisabled"
              :slug       = "item.slug">
                  <p class="truncate font-bold">{{ $t(item.i18n) || item.name }}</p>

              </h-nav-menu-item>
          </div>

          <!-- :icon       = "item.icon"   -->
          <div v-else-if="item.cat && $acl.not.check('captain')" class="">
              <h-nav-menu-item
              class       = "cursor-pointer"
              :cat        = "item.cat">
                  <p class="font-bold">{{ $t(item.i18n) || item.i18n }}</p>
              </h-nav-menu-item>
          </div>
          </li>
      </ul>
    </vs-navbar>
    <div id="shop-info" class="flex justify-center items-center" :color="lastNavbarColor">
      <div class="info flex justify-center items-center">
        <span class="mt-2 mx-1"><img :src="require(`@assets/images/icons/shipping.svg`)" alt="icon"></span>
        {{ $t('DeliveryFree') }}
      </div>
      <div class="info flex justify-center items-center">
        <span class="mt-2 mx-1"><img :src="require(`@assets/images/icons/credit-card.svg`)" alt="icon"></span>
        {{ $t('SecurePayment') }}
      </div>
      <div class="info flex justify-center items-center">
        <span class="mt-2 mx-1"><img :src="require(`@assets/images/icons/money.svg`)" alt="icon"></span>
        {{ $t('PayOnDelivery') }}
      </div>
      <div class="info flex justify-center items-center">
        <span class="mt-2 mx-1"><img :src="require(`@assets/images/icons/return.svg`)" alt="icon"></span>
        {{ $t('EasyRefund') }}
      </div>
    </div>
    </div>
  </div>
</template>

<script>
import axios from "@/axios.js"

import HNavMenuGroup  from './HorizontalNavMenuGroup.vue'
import HNavMenuHeader from './HorizontalNavMenuHeader.vue'
import HNavMenuItem   from './HorizontalNavMenuItem.vue'

export default {
  props: {
    // navbarColor  : { type: String, default: "#fff", },
    navMenuItems : { type: Array,  required: true   }
  },
  components: {
    HNavMenuGroup,
    HNavMenuHeader,
    HNavMenuItem
  },
  data() {
    return {
      s3Link: 'https://otantik-home.s3.me-south-1.amazonaws.com/icons/',
      scroll: false,
      menuWithFilters: [],
    }
  },
  computed: {
    isDisplayed () {
      return this.$route.name == 'home'
    },
    navbarColor () {
      return  '#a7a5a4' /*this.$store.state.theme === 'dark' ? '#212121' : '#fff'*/
    },
    lastNavbarColor () {
      return  '#efefef' /*this.$store.state.theme === 'dark' ? '#212121' : '#fff'*/
    },
    categories () {
      return this.$store.state.CategoriesList
    },
    isScrolled () {  return this.scroll }
  },
  methods: {
    checkGrpChildrenActive (group) {
      const path        = this.$route.fullPath
      let active        = false
      const routeParent = this.$route.meta ? this.$route.meta.parent : undefined

      if (group.submenu) {
        group.submenu.forEach((item) => {
          if (active) return true
          if ((path === item.url || routeParent === item.slug) && item.url) active = true
          else if (item.submenu) this.checkGrpChildrenActive(item)
        })
      }

      return active
    },
    handleScroll (event) {
      (window.pageYOffset > 160) ? this.scroll = true : this.scroll = false
    },
    capitalizeSlug(title){
      title = title.replace(/\s+/g, '')
      const splitStr = title.toLowerCase().split(' ')

      for (var i = 0; i < splitStr.length; i++) {
       splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
      }
      title = splitStr.join(' ')

      return title
    }
  },
  created () {
    window.addEventListener('scroll', this.handleScroll);

    // Adding sub menus
    this.navMenuItems.forEach((element) => {
      if(element.cat) {
        this.categories.forEach((c) => {
          if(c.cat == element.cat) {
            axios.get('/api/categories/' + c.id + '/filter/list')
            .then(res => {
              if (res.data.length > 0) {
                element.submenu = []

                res.data.forEach(f => {
                  element.submenu.push({
                    url: '/shop/' + element.cat + '/filter/' + f.id,
                    name: f.title_en,
                    slug: f.title_en.replace(/\s+/g, ''),
                    i18n: this.capitalizeSlug(f.title_en),
                    ar: f.title_ar,
                    en: f.title_en,
                  })

                  this.$store.commit('ADD_FILTER_TO_FILTERS_LIST', { id: f.id, title_en: f.title_en, title_ar: f.title_ar, slug: this.capitalizeSlug(f.title_en) })
                })
              } else {
                delete element.submenu
              }
            })
            .catch(err => console.log(err))
          }
        })
      }
    })

    this.menuWithFilters = this.navMenuItems
  },
  destroyed () {
    window.removeEventListener('scroll', this.handleScroll);
  },
}
</script>

<style lang="scss">
@import "@sass/vuexy/components/horizontalNavMenu.scss";

  .sticky {
    position: fixed !important;
    top: 0 !important;
    // width: 100%;
  }

  .navbar-custom {
    box-shadow: none;
    border-bottom: 1px solid #efefef;
    padding-bottom: 1rem;
    padding-top: .5rem;
    z-index: 10;
  }

  .no-display {
    display: none !important;
  }

  .nav-height {
    height: 2.5rem;
  }

.nav-menu-wrapper {
  ul.flex.flex-wrap.w-full.justify-start.items-center {
    width: 68rem !important;
  }


  #shop-info {
    .info {
      color: #000;
      background: #a7a5a4;
      border: 1px solid #efefef;
      margin: 0rem;
      padding: 0rem;
      width: 50rem;
      height: 2rem;
      text-align: center;
    }

    .info:first-child, .info:last-child { width: 100%; margin: 0.125rem 0 ; }
  }
}
</style>
