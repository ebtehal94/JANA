<!-- =========================================================================================
    File Name: Main.vue
    Description: Main layout
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
  <div class="layout--main" :class="[layoutTypeClass, navbarClasses, footerClasses, {'no-scroll': isAppPage}]">


    <v-nav-menu
      :navMenuItems = "navMenuItems"
      title         = "Jana"
      parent        = ".layout--main" />

    <div id="content-area" :class="[contentAreaClass, {'show-overlay': bodyOverlay}]">
     <div id="content-overlay" />

    <!-- Navbar -->
    <template v-if="mainLayoutType === 'horizontal' && windowWidth >= 1200">
     <div id="header">
        <the-navbar-horizontal
        :navbarType= "navbarType"
        :class="[
          {'text-white' : isNavbarDark  && !isThemeDark},
          {'text-base'  : !isNavbarDark && isThemeDark},
        ]" />

        <div style="height: 62px" v-if="navbarType === 'static'"></div>

        <h-nav-menu
        :class="[
          {'text-white' : isNavbarDark  && !isThemeDark},
          {'text-base'  : !isNavbarDark && isThemeDark}
        ]"
        :navMenuItems="navMenuItems" />
     </div>
    </template>

    <template v-else>
      <the-navbar-vertical
        :navbarColor="navbarColor"
        :class="[
          {'text-white' : isNavbarDark  && !isThemeDark},
          {'text-base'  : !isNavbarDark && isThemeDark}
        ]" />
    </template>
    <!-- /Navbar -->

      <div class="content-wrapper">
          <div class="router-content pt-6" style="margin-top: 0;">
            <div class="vx-row mx-10">
              <div class="vx-col">
                <feather-icon class="sm:inline-flex xl:hidden cursor-pointer p-2 MenuIcon" icon="MenuIcon" @click.stop="showSidebar" />
              </div>
              <div class="vx-col hidden lg:block lg:block p-0">
                <!-- SM - OPEN SIDEBAR BUTTON -->

                <div  v-if="breadcrumbs!= null && breadcrumbs.length > 0" class="breadcrumbs mr-10  my-6">
                  <p class="text-white">
                    <span class="dashboard font-bold">{{$t('dashboard')}} </span>
                    <span class="sperate">|</span>
                    <span cl v-for="(bc, i) in breadcrumbs" :key="bc.url" class="text-sm">
                      <a :href="bc.url">{{ $t(bc.title) }}</a>
                      <span v-if="i != breadcrumbs.length - 1"> > </span>
                    </span>
                  </p>
                </div>
              </div>
               <vs-spacer />
              <div>
                <i18n class="mr-2 mt-1"/>
              </div>
              <div>
                <profile-drop-down />
              </div>
            </div>
            <div class="content-area__content">
              <!--<div style="height: 48px" v-if="!tipHidden"></div>-->

              <back-to-top bottom="5%" :right="$vs.rtl ? 'calc(100% - 2.2rem - 38px)' : '30px'" visibleoffset="500" v-if="!hideScrollToTop">
                <vs-button icon-pack="feather" icon="icon-arrow-up" class="shadow-lg btn-back-to-top" />
              </back-to-top>

              <transition :name="routerTransition" mode="out-in">
                <router-view
                  :key="$route.fullPath"
                  @changeRouteTitle="changeRouteTitle"
                  @setAppClasses="(classesStr) => $emit('setAppClasses', classesStr)" />
              </transition>
            </div>
          </div>
        </div>
      </div>
     <!-- <the-footer />-->
    </div>

</template>


<script>
import axios               from "@/axios.js"
import BackToTop           from 'vue-backtotop'
import HNavMenu            from '@/layouts/components/horizontal-nav-menu/HorizontalNavMenu.vue'
import navMenuItems        from '@/layouts/components/vertical-nav-menu/navMenuItems.js'
import TheNavbarHorizontal from '@/layouts/components/navbar/TheNavbarHorizontal.vue'
import TheNavbarVertical   from '@/layouts/components/navbar/TheNavbarVertical.vue'
import TheFooter           from '@/layouts/components/TheFooter.vue'
import themeConfig         from '@/../themeConfig.js'
import VNavMenu            from '@/layouts/components/vertical-nav-menu/VerticalNavMenu.vue'
import I18n                 from "@/layouts/components/navbar/components/I18n.vue"
import ProfileDropDown      from '@/layouts/components/navbar/components/ProfileDropDown.vue'

export default {
  components: {
    BackToTop,
    HNavMenu,
    TheFooter,
    TheNavbarHorizontal,
    TheNavbarVertical,
    VNavMenu,
    I18n,
    ProfileDropDown
  },
  data () {
    return {
      footerType        : themeConfig.footerType  || 'static',
      hideScrollToTop   : themeConfig.hideScrollToTop,
      isNavbarDark      : false,
      navbarColor       : themeConfig.navbarColor || '#fff',
      navbarType        : themeConfig.navbarType  || 'floating',
      navMenuItems,
      routerTransition  : themeConfig.routerTransition || 'none',
      routeTitle        : this.$route.meta.pageTitle,
      windowWidth       : window.innerWidth,
      showTip           : true,
      // filters           : []
    }
  },
  watch: {
    '$route' () {
      this.routeTitle = this.$route.meta.pageTitle
    },
    isThemeDark (val) {
      const color = this.navbarColor === '#fff' && val ? '#212121' : '#fff'
      this.updateNavbarColor(color)
    },
    '$store.state.mainLayoutType' (val) {
      this.setNavMenuVisibility(val)
    },
    windowWidth(newWidth, oldWidth) {
      if(newWidth <= 786) {
        this.showTip = true
      } else {
        this.showTip = false
      }
    }
  },
  computed: {
    filters () {
      return this.$store.state.eCommerce.filtersList
    },
    breadcrumbs() {
      if(this.$route.meta.breadcrumb && !this.$route.params.item_id) {
        return this.$route.meta.breadcrumb.map(element => {
          return element
        })
      }
    },
    bodyOverlay () { return this.$store.state.bodyOverlay },
    tipHidden () {
        return localStorage.getItem("tipHidden")
    },
    contentAreaClass () {
      if (this.mainLayoutType === 'vertical') {
        if      (this.verticalNavMenuWidth === 'default') return 'content-area-reduced'
        else if (this.verticalNavMenuWidth === 'reduced') return 'content-area-lg'
        else return 'content-area-full'
      } else return 'content-area-full'
    },
    footerClasses () {
      return {
        'footer-hidden': this.footerType === 'hidden',
        'footer-sticky': this.footerType === 'sticky',
        'footer-static': this.footerType === 'static'
      }
    },
    isAppPage () {
      return this.$route.meta.no_scroll
    },
    isThemeDark ()     { return this.$store.state.theme === 'dark' },
    layoutTypeClass () { return `main-${this.mainLayoutType}` },
    mainLayoutType ()  { return this.$store.state.mainLayoutType  },
    navbarClasses ()   {
      return {
        'navbar-hidden'   : this.navbarType === 'hidden',
        'navbar-sticky'   : this.navbarType === 'sticky',
        'navbar-static'   : this.navbarType === 'static',
        'navbar-floating' : this.navbarType === 'floating'
      }
    },
    verticalNavMenuWidth () { return this.$store.state.verticalNavMenuWidth },
    // windowWidth ()          { return this.$store.state.windowWidth }
  },
  methods: {
      showSidebar () {
      this.$store.commit('TOGGLE_IS_VERTICAL_NAV_MENU_ACTIVE', true)
    },
    getFilterFromID(filter_id){
      return (this.filters.find((filter) => filter.id == filter_id)) ? this.filters.find((filter) => filter.id == filter_id) : {title_en:this.$t('NA'), title_ar:this.$t('NA')}
    },
    fetch_item_details(id) {

      this.algolia_index.getObject(id, (err, content) => {
        if(!err) {
          this.item_data = content
        }
      })

    },
    changeRouteTitle (title) {
      this.routeTitle = title
    },
    updateNavbar (val) {
      if (val === 'static') this.updateNavbarColor(this.isThemeDark ? '#212121' : '#fff')
      this.navbarType = val
    },
    updateNavbarColor (val) {
      this.navbarColor = val
      if (val === '#fff') this.isNavbarDark = false
      else this.isNavbarDark = true
    },
    updateFooter (val) {
      this.footerType = val
    },
    setNavMenuVisibility (layoutType) {
      if ((layoutType === 'horizontal' && this.windowWidth >= 1200) || (layoutType === 'vertical' && this.windowWidth < 1200)) {
        this.$store.commit('TOGGLE_IS_VERTICAL_NAV_MENU_ACTIVE', false)
        this.$store.dispatch('updateVerticalNavMenuWidth', 'no-nav-menu')
      } else {
        this.$store.commit('TOGGLE_IS_VERTICAL_NAV_MENU_ACTIVE', true)
      }
    },
    toggleHideScrollToTop (val) {
      this.hideScrollToTop = val
    },
    onResize() {
      this.windowWidth = window.innerWidth
    }
  },
   mounted() {
    this.$nextTick(() => {
      window.addEventListener('resize', this.onResize);
    })
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.onResize);
  },
  created () {
    // axios.get('/api/filters/show')
    // .then(res => { this.filters = res.data })
    // .catch(err => console.log(err))

    const color = this.navbarColor === '#fff' && this.isThemeDark ? '#212121' : this.navbarColor
    this.updateNavbarColor(color)
    // if (this.$acl.check('captain')){
      this.$store.dispatch('updateMainLayout', 'vertical')
      this.setNavMenuVisibility('vertical')
    // }else{
    //   this.$store.dispatch('updateMainLayout', 'horizontal')
    //   this.setNavMenuVisibility('horizontal')
    // }
  },
}

</script>

<style lang="scss">
  .app-notify {
    background: #BD9C72;
  }

  #header {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 10 !important;
    background: #fff;
  }
  .MenuIcon{
    color: #fff;
  }
  .content-wrapper {
    .router-content{
      a{
        color: #fff;
      }
      .dashboard{
        font-size: 1.2rem;
      }
      .sperate{
        font-weight: 100;
        font-size: 1.5rem;
        padding: 0 .3rem;
      }
    }
    // margin-top: 17rem;

    .router-view {
      padding: 0 !important;

      .router-content {
        padding: 0 !important;
        margin: 0 !important;
      }
    }
  }


  @media only screen and (min-width: 992px) {
    .header-margin {
      margin-top: 10rem;
    }
  }
</style>
