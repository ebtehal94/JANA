<template>
  <div class="dropdown-button-container mr-2">
    <vs-dropdown vs-custom-content vs-trigger-click class="cursor-pointer">
        <span class="cursor-pointer text-black flex items-center i18n-locale cairo p-2 text-white">
          <img class="h-5 w-5 mr-2" :src="require(`@assets/images/navbar/worldwide.svg`)" alt="qt" />
          {{ ($i18n.locale == 'en') ? 'العربية' : 'English' }}
        </span>
      <vs-dropdown-menu class="w-48 i18n-dropdown vx-navbar-dropdown">
        <vs-dropdown-item @click="updateLocale('ar')">
          العربية
        </vs-dropdown-item>
        <vs-dropdown-item @click="updateLocale('en')">
          English
        </vs-dropdown-item>
      </vs-dropdown-menu>
    </vs-dropdown>
  </div>
</template>

<script>
export default {
  computed: {
    remotePath (){
      return process.env.ASSET_PATH
    },
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

      // window.location.reload()
    },
  }
}
</script>

<style lang="scss">
@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600&display=swap');

.cairo { font-family: 'Cairo', sans-serif; }

.text-gray { color: #a7a5a4; }

.dropdown-button-container {
  display: flex;
  align-items: center;


  .btn-drop {
    border-radius: 15px;
    border-left: 1px solid rgba(255, 255, 255, .2);
  }
}
.btn-like-broder {
  border-color: #929292;
  border-style: solid;
  border-radius: 15px;
  border-width: 0.5px;
}
</style>
