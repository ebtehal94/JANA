
<template>
  <div id="page-product-edit">
    <vs-alert color="danger" title="Product Not Found" :active.sync="product_not_found">
      <span>Product record with id: {{ $route.params.productId }} not found. </span>
      <span>
        <span>Check </span><router-link :to="{name:'page-product-list'}" class="text-inherit underline">All Products</router-link>
      </span>
    </vs-alert>
    <!-- <vx-card> -->
    <vs-tabs :position="isSmallerScreen ? 'top' : 'left'" class="tabs-shadow-none" id="product-tabs" :key="isSmallerScreen">
      <!-- GENERAL -->
      <vs-tab icon-pack="feather" icon="icon-info" :label="!isSmallerScreen ? $t('GeneralInfo') : ''">
        <div class="tab-general md:ml-4 md:mt-0 mt-4 ml-0">
          <settings/>
        </div>
      </vs-tab>
      <vs-tab v-for="country in countries"  :key="country.id" icon-pack="feather" icon="icon-settings" :label="!isSmallerScreen ? $t(country.name_en) : ''">
        <div class="tab-social-links md:ml-4 md:mt-0 mt-4 ml-0">
          <country-settings :country="country" :product_id="$route.params.productId" :saved_country_data="(countries_data.find((searchCountry) => searchCountry.id == country.id)) ? countries_data.find((searchCountry) => searchCountry.id == country.id).details : null"/>
        </div>
      </vs-tab>
    </vs-tabs>
    <!-- </vx-card> -->
  </div>
</template>

<script>
import axios              from "@/axios.js"
import Settings           from './components/Settings.vue'
import CountrySettings    from './components/CountrySettings.vue'
// import moduleDataList from "@/store/data-list/moduleDataList.js"

// Store Module
import moduleDataList from "@/store/data-list/moduleDataList.js"
export default {
  components: {
    Settings,
    CountrySettings,
  },
  data() {
    return {
      product_not_found: false,
      countries_data: [],
      // data_local: { id: null, name: null, title: null, email: null, mobile: null, from: null,
      //               to: null, allowance: null, no_location: false, status:1, account_id: null, custom_id: null,
      //                  location_id: null, department_id:null, daily_notifications: false, biometrics:true, offdays: [] },
      // product_data: { id: null, name_en: null, name_ar: null, desc_en: null,
      //                 desc_ar: null, category_id: null, filter_id: null, images: null },


      // countries_data: [],
    }
  },
  computed: {
    isSmallerScreen() {
      return this.$store.state.windowWidth < 768
    },
    countries () {
      return this.$store.state.CountriesList
    },
    // get_country_data (id) {
    //   return
    // },
  // methods: {
  //   goBack(){
  //     this.$router.go(-1)
  //   },
  },
  methods: {
    fetch_counntries_data(productId) {
      if (productId){
        axios.post("/api/products/countriesSettings/view", {product_id: productId})
          .then((response) => {
            this.countries_data = response.data.countries_data
          })
      }
    }
  },
  created() {
    if(!moduleDataList.isRegistered) {
      this.$store.registerModule('dataList', moduleDataList)
      moduleDataList.isRegistered = true
    }
    this.fetch_counntries_data(this.$route.params.productId)
  }
}
</script>
