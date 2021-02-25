<!-- =========================================================================================
  File Name: TheNavbar.vue
  Description: Navbar component
  Component Name: TheNavbar
  ----------------------------------------------------------------------------------------
  Item Name: BinAfif - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
<div id="navbar" class="relative">
  <div v-if="showTip" class="navbar-full flex justify-center items-center">
    <p class="text-white py-3">{{$t('Welcome')}}</p>
    <vs-icon icon="cancel" color="#fff" size="small" class="ml-32 cursor-pointer" @click="hideTip"></vs-icon>
  </div>
  <div id="sub-nav">
    <div class="flex justify-center items-center">
      <div class="box flex justify-center w-22 items-center">
        <span>
          <profile-drop-down />
        </span>
        <span>
          <country />
        </span>
        <span class="mx-2">
          <i18n />
        </span>
      </div>
      <div class="box flex items-center">
        <router-link tag="div" to="/" class="vx-logo cursor-pointer mx-auto flex items-center">
          <logo class="w-10 mr-10 fill-current text-primary" />
          <span class="vx-logo-text text-primary">{{$t('AppName')}}</span>
        </router-link>
      </div>
      <div class="box flex justify-center items-center ml-20">
        <search-bar />
        <div class="flex justify-center items-center">
          <vs-icon class="mx-5" icon="favorite_border" size="small"></vs-icon>
          <cart-drop-down />
        </div>
      </div>
    </div>
  </div>
  <hr>
</div>
</template>

<script>
// import Bookmarks            from './components/Bookmarks.vue'
import NotificationDropDown from './components/NotificationDropDown.vue'
import ProfileDropDown      from './components/ProfileDropDown.vue'
import I18n                 from "./components/I18n.vue"
import DarkMode             from "./components/DarkMode.vue"
import Logo                 from '../Logo.vue'
import CartDropDown         from "./components/CartDropDown.vue"
import Currency             from "./components/Currency.vue"
import Country              from "./components/Country.vue"
import SearchBar            from './components/SearchBar.vue'


export default {
  name: 'the-navbar-horizontal',
  props: {
    logo: { type: String },
    navbarType: { type: String, required: true }
  },
  data() {
    return {
      showTip: true
    }
  },
  components: {
    Logo,
    CartDropDown,
    I18n,
    DarkMode,
    // Bookmarks,
    SearchBar,
    NotificationDropDown,
    ProfileDropDown,
    Currency,
    Country
  },
  computed: {
    navbarColor () {
      return '#74716f' /*color*/
    },
    isThemedark () { return this.$store.state.theme },
    navbarStyle () { return this.navbarType === 'static' ? {transition: 'all .25s ease-in-out'} : {}},
    navbarClasses () {
      return this.scrollY > 5 && this.navbarType === 'static' ? null : 'd-theme-dark-light-bg shadow-none'
    },
    scrollY () { return this.$store.state.scrollY },
    verticalNavMenuWidth () { return this.$store.state.verticalNavMenuWidth },
    windowWidth () { return this.$store.state.windowWidth }
  },
  methods: {
    hideTip() {
      localStorage.setItem("tipHidden", true)
      this.showTip = false
    }
  },
  created(){
      if (localStorage.getItem("tipHidden")) {
        this.showTip = false
      }
  }
}

</script>

<style lang="scss" scoped>
  .text-shade { color: #a7a5a4; }

  .w-22 { width: 22rem !important; }

  .navbar-full {
    background: #74716f;

    p {
      text-align: center !important;
    }
  }

  .box {
    width: 300px;
    height: 100px;
  }

  .btn-drop {
    border-radius: 15px;
    border-left: 1px solid rgba(255, 255, 255, .2);
  }

  .border-down-primary{
    border-bottom: 4px solid rgba(255, 100, 0, 1);
  }

  hr {
    border-top: 1px solid #a7a5a4;
  }
</style>
