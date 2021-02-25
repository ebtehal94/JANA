<template>
    <div id="country-dropdown" class="text-primary flex items-center">
        <vs-dropdown vs-custom-content vs-trigger-click class="cursor-pointer">
            <!-- <div class="flex items-center">
                <span style="color: #000; font-family: 'Cairo', sans-serif;">
                    <img class="h-5 w-5 mr-2" :src="require(`@assets/images/navbar/pin.svg`)" alt="qt" />
                    {{ $t('country') }}
                </span>
            </div> -->
            <span class="cursor-pointer text-black flex items-center cairo p-2">
              <img class="h-5 w-5 mr-2" :src="require(`@assets/images/flags/`+ countryImgName(country.name_en.toLowerCase()) +`.svg`)" alt="country" />
              <!-- <img class="h-5 w-5 mr-2" :src="require(`@assets/images/navbar/pin.svg`)" alt="qt" /> -->
              {{ ($i18n.locale == 'en') ? country.name_en : country.name_ar }}
            </span>
            <vs-dropdown-menu class="w-48 i18n-dropdown vx-navbar-dropdown">
            <vs-dropdown-item @click="updateCountry(country.id)" v-for="country in countries"  :key="country.id+'-'+country.currency">
              <img class="h-5 w-5 mr-2" :src="require(`@assets/images/flags/`+ countryImgName(country.name_en.toLowerCase()) +`.svg`)" alt="kwd" />
              {{ ($i18n.locale == "en")? country.name_en : country.name_ar }}
            </vs-dropdown-item>
        </vs-dropdown-menu>
        </vs-dropdown>
    </div>
</template>

<script>
export default {
    data() {
        return {
            country: null
        }
    },
    computed: {
        countries () {
            return this.$store.state.CountriesList
        },
        cartItems() {
            return this.$store.state.eCommerce.cartItems.slice().reverse();
        },
        countryImgName(name_en) {
            return (name_en) => name_en.replace(/\s+/g, '')
        },
    },
     methods: {
        updateCountry(country_id) {
            if (this.cartItems.length > 0) {
                this.$vs.notify({
                    color: 'warning',
                    title: 'Warning',
                    text: 'Empty cart to switch countries'
                })
            } else {
                this.country = this.countries.find((country) => country.id == country_id)
                localStorage.setItem("country", country_id)
                localStorage.setItem("country_code", this.country.short_code)
                window.location.reload()
            }
        }
    },
    created() {
        const currentCountryID  = (localStorage.getItem("country")) ? localStorage.getItem("country") : 1
        localStorage.setItem("country",   currentCountryID)
        this.country            = this.countries.find((country) => country.id == currentCountryID)
        localStorage.setItem("country_code", this.country.short_code)
        localStorage.setItem("currency", this.country.currency)
    },
}
</script>

<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap');
</style>
