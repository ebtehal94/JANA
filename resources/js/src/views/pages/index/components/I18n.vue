<template>
  <vs-dropdown vs-custom-content vs-trigger-click class="cursor-pointer btn btn-rounded btn-solid px-3 mr-4">
    <span class="cursor-pointer flex items-center i18n-locale">
      <img class="h-4 w-5" :src="i18n_locale_img" :alt="$i18n.locale" />
      <span class="hidden sm:block ml-2">{{ getCurrentLocaleData.lang }}</span>
    </span>
    <vs-dropdown-menu class="w-48 i18n-dropdown vx-navbar-dropdown always-on-top">
      <vs-dropdown-item @click="updateLocale('ar')"><img class="h-4 w-5 mr-1" src="@assets/images/flags/ar.png" alt="ar" /> &nbsp;Arabic</vs-dropdown-item>
      <vs-dropdown-item @click="updateLocale('en')"><img class="h-4 w-5 mr-1" src="@assets/images/flags/en.png" alt="en" /> &nbsp;English</vs-dropdown-item>
    </vs-dropdown-menu>
  </vs-dropdown>
</template>

<script>
export default {
  computed: {
    // remotePath (){
    //   return process.env.ASSET_PATH
    // },
    i18n_locale_img() {
        const locale = this.$i18n.locale;
        if (locale == "en")      return require(`@assets/images/flags/en.png`)
        else                     return require(`@assets/images/flags/ar.png`)
    },
    getCurrentLocaleData() {
        const locale = this.$i18n.locale;
        if (locale == "en")      return { flag: "us", lang: 'English'    }
        else                     return { flag: "ar", lang: 'Arabic'     }
    },
  },
  methods: {
    updateLocale(locale) {
      this.$i18n.locale = locale;
      localStorage.setItem("locale", locale)

      if (locale == "ar"){
        this.$vs.rtl = true
      }else{
        this.$vs.rtl = false
      }
    },
  }
}
</script>

<style lang="scss" scoped>
  .always-on-top {
    z-index: 99999;
  }
</style>
