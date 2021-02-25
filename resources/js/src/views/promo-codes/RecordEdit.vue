
<template>
  <div id="page-product-edit">
   <div class="m-5">
     <settings/>
   </div>
  </div>
</template>

<script>
import axios              from "@/axios.js"
import Settings           from './components/Settings.vue'

// Store Module
import modulePromocodes from "@/store/promo-codes/modulePromocodes.js"
export default {
  components: {
    Settings,
  },
  data() {
    return {
      product_not_found: false,
    }
  },
  computed: {
    isSmallerScreen() {
      return this.$store.state.windowWidth < 768
    },
  },
  methods: {

  },
  created() {
    if(!modulePromocodes.isRegistered) {
      this.$store.registerModule('PromocodesData', modulePromocodes)
      modulePromocodes.isRegistered = true

      this.$store.dispatch("PromocodesData/fetchPromocodes")
    }
  }
}
</script>
