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
                    <vs-tabs alignment="fixed" class="tabs-shadow-none">
                        <vs-tab :label="$t('UsedOffers')">
                            <mostRedeemed  :offers="offers"/>
                        </vs-tab>
                        <vs-tab :label="$t('SuppliersOffers')">
                            <storeOffers :stores="stores"/>
                        </vs-tab>
                        <vs-tab :label="$t('Areas')">
                            <Cities/>
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
import AllOffers from '@/layouts/components/AllOffers.vue'
import mostRedeemed from '@/layouts/components/mostRedeemed.vue'
import storeOffers from '@/layouts/components/storeOffers.vue'
import statistics from '@/layouts/components/statistics.vue'
//import Locations from '@/layouts/components/Locations.vue'
import Cities from '@/layouts/components/Cities.vue'
export default{
    components: {
        StarRating,
        AllOffers,
        storeOffers,
        statistics,
        //Locations,
        mostRedeemed,
        Cities
    },
    props:{
        offers:{
            type: Array
        },
        stores:{
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
    .stat {
        p { font-size: .75rem; }

        h6 { font-size: .85rem; }

        h3 {
            font-size: 1.3rem;
            color: #747474;
            font-weight: bold;
        }
    }

    @media (max-width: 992px){
        .stat{
            margin-bottom: 1.3rem;
        }
    }
    .vs-table--tbody-table tr {
        border-bottom: 1.5px solid #eee;
    }
    .vs-con-table td {
        font-size: .8rem;
        color:#ACACAC
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
