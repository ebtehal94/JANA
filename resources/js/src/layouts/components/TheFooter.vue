<!-- =========================================================================================
    File Name: TheFooter.vue
    Description: Footer component
    Component Name: TheFooter
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="footer-container">
    <div class="separator">
      <img src="@assets/images/logo/logo-2.png" alt="Otantik" width="75">
    </div>
    <div class="footer-sections flex mt-6 p-3">
      <div class="w-full md:w-1/3 ml-20">
        <h6 class="bold mb-3">{{$t('AboutCompany')}}</h6>
        <div class="links">
          <a href="/about-us">{{$t('AboutOtantik')}}</a>
          <a href="/privacy-policy">{{$t('PrivacyPolicy')}}</a>
          <a href="/terms-and-cond">{{$t('TermsAndCond')}}</a>
        </div>
      </div>
      <div class="w-full md:w-1/3 ml-20">
        <h6 class="bold mb-3">{{$t('WebsiteSections')}}</h6>
        <div class="links">
          <a href="/all">{{$t('Shopping')}}</a>
          <a href="/all">{{$t('Products')}}</a>
          <a href="/#categories">{{$t('OtherSections')}}</a>
        </div>
      </div>
      <!-- <div>
        <h6 class="mb-5">{{$t('Contact')}}</h6>
        <div class="social">
          <a href="https://www.instagram.com/" target="_blank">
            <img class="responsive payment-img mx-1" src="@assets/images/icons-p/instagram.svg">
          </a>
          <a href="https://www.facebook.com/" target="_blank">
            <img class="responsive payment-img mx-1" src="@assets/images/icons-p/facebook-footer.svg">
          </a>
        </div>
      </div> -->
    </div>
    <footer class="the-footer flex-wrap justify-between" :class="classes">
        <span>COPYRIGHT &copy; {{ new Date().getFullYear() }} <a href="#" target="_blank" rel="nofollow">{{$t('Otantik')}}</a>, {{$t('CopyRights')}}</span>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'the-footer',
  props: {
    classes: {
      type: String
    }
  },
  data() {
    return {
      country: {},
    }
  },
  computed: {
    countries () {
      return this.$store.state.CountriesList
    },
  },
  created() {
    const currentCountryID  = (localStorage.getItem("country")) ? localStorage.getItem("country") : 1
    this.country = this.countries.find((country) => country.id == currentCountryID)
  },
}
</script>

<style lang="scss" scoped>
#footer-container {
  .separator {
    display: flex;
    align-items: center;
    text-align: center;
  }
  .separator::before, .separator::after {
    content: '';
    flex: 1;
    border-bottom: 1px solid #e2e2e2;
  }
  .separator::before {
    margin-right: 2em;
  }
  .separator::after {
    margin-left: 2em;
  }

  .footer-sections {
    // display: flex;
    // justify-content: space-around;
    // align-items: left;

    h6, p {
      font-weight: bold;
    }

    h6 { color: #363434; }

    p { color: #000; }

    .links {
      > a {
        display: block;
        color: #000;
        // font-weight: bold;
      }
    }

    .social {
      > a {
        > img {
          width: 2rem;
        }
      }
    }
  }
}

@media only screen and (max-width: 600px) {
  .footer-sections {
    display: block !important;

    > div {
      margin: 2.5rem 1rem;
    }
  }
}
</style>
