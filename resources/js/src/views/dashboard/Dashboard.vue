<!-- =========================================================================================
    File Name: DashboardEcommerce.vue
    Description: Dashboard - Ecommerce
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
    <div id="dashboard">
        <statistics />
        <div class="vx-row">
            <div class="vx-col w-full">
                <vx-card class="mt-8 pt-0">
                    <vs-tabs  class="tabs-shadow-none">
                        <vs-tab :label="$t('UsedOffers')">
                            <mostRedeemed :offers='offers' />
                        </vs-tab>
                        <vs-tab v-if="$acl.check('admin')" :label="$t('SuppliersOffers')">
                            <storeOffers :stores="stores"/>
                        </vs-tab>
                        <vs-tab v-if="$acl.check('admin')" :label="$t('Areas')">
                            <Cities :cities='cities'/>
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
import mostRedeemed from './mostRedeemed.vue'
import storeOffers from './storeOffers.vue'
import statistics from './statistics.vue'
import Cities from './Cities.vue'
export default{
    components: {
        StarRating,
        storeOffers,
        statistics,
        mostRedeemed,
        Cities
    },
    props:{
        offers:{
            type: Array
        },
        stores:{
            type: Array
        },
        cities:{
            type: Array
        }
    },
    data() {
        return {
            // users: [
            //     {"id": 1,"name": "14 متجر","username": "منطقة الرياض","customer": "450 عميلة"},
            //     {"id": 2,"name": "14 متجر","username": "منطقة الرياض","customer": "450 عميلة"},
            //     {"id": 3,"name": "14 متجر","username": "منطقة الرياض","customer": "450 عميلة"},
            //     {"id": 4,"name": "14 متجر","username": "منطقة الرياض","customer": "450 عميلة"},
            //     {"id": 5,"name": "14 متجر","username": "منطقة الرياض","customer": "450 عميلة"}
            // ],
        }
    },
    computed: {
 
    },
    methods: {

    },
    created() {
        
    }
}
</script>

<style lang="scss" scoped>
#dashboard {
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
    .name {
        color: #434343;
    }
    .vs-tabs--li button.vs-tabs--btn{
        font-size: .9rem;
        font-weight: 700;
    }
}
</style>
