<!-- =========================================================================================
    File Name: DashboardEcommerce.vue
    Description: Dashboard - Ecommerce
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
    <div id="offers">
        <div class="vx-row my-2 justify-center md:justify-between ">
            <div class="vx-col search-page__search-bar flex">
                <vs-input 
                icon-no-border 
                :placeholder="$t('SearchBar')" 
                icon-after vs-icon-after="true"
                v-model="search" 
                class="sm:w-full md:w-full input-rounded-full" 
                icon="icon-search" 
                icon-pack="feather"
                @keyup.enter="getResults" />
            </div>
            <div class="vx-col cursor-pointer flex">
                <vs-button
                    class="sm:w-full md:w-full rounded-full text-xs font-bold shadow-none"
                    color="rgb(255, 255, 255)"
                    text-color="#DC6059"
                    icon-after vs-icon-after="true"
                    icon-pack="feather"
                    icon="icon-plus pl-4"
                    @click="addNewData">
                    {{ $t('CreateNewOffer') }}
                </vs-button>
          </div>
        </div>
        
        <div class="vx-row">
            <div class="vx-col w-full">
                <vx-card class="mt-8 pt-0">
                    <vs-tabs class="tabs-shadow-none">
                        <vs-tab :label="$t('AllOffers')">
                            <AllOffers :offers="offers"/>
                        </vs-tab>
                        <vs-tab :label="$t('PendingOffers')">
                            <AllOffers display ='pending' :offers="offers"/>
                        </vs-tab>
                        <vs-tab :label="$t('ActiveOffers')">
                            <AllOffers display="active" :offers="offers"/>
                        </vs-tab>
                    </vs-tabs>
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "@/axios.js"
import StarRating from 'vue-star-rating'
import AllOffers from './AllOffers.vue'
export default{
    components: {
        StarRating,
        AllOffers,
    },
    props:{
    //   offers:{
    //       type: Array
    //   },
      display:{
          required: false
      }
    },
    data() {
        return {
            search: '', 
            offers:[]   
        }
    },
    methods: {
        getResults(){
            // console.log('searching')
            axios.post("/api/offers/list/", {search:this.search})
            .then((response) => {
            this.offers = response.data.offers

            })
            .catch((error) => console.log(error))

        },
        addNewData() {
            this.$router.push({path: '/offers/create'})
        },
    },
    // created() {
    //     if(!moduleOfferManagement.isRegistered) {
    //     this.$store.registerModule('offerManagement', moduleOfferManagement)
    //     moduleOfferManagement.isRegistered = true
    //   }
    //   this.$store.dispatch("offerManagement/fetchOffers").catch(err => { console.error(err) })
    // },
}
</script>

<style lang="scss" scoped>
#offers {
    margin: 0 3rem 3rem 3rem;
    .vx-card{
        box-shadow: none;
    }
    .vx-row{
        margin: 0;
    }
    .vx-row > .vx-col {
        padding: 0 .6rem;
    }
    .vs-input--placeholder {
        font-size: small;
        color: #ACACAC;
        font-weight: 400;
        padding-right: 3rem !important;
    }
    .vs-button{
        box-shadow: none;
    }
    .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large) {
        padding: 0 2rem;
        box-shadow: none;
    }
}
@media only screen and (max-width: 512px){
    .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large) {
        padding: .5rem 2rem !important;
        margin-top: 1rem;
    }
}
</style>
