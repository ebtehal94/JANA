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
                            <AllOffers display="most_used" :offers="offers"/>
                        </vs-tab>
                        <vs-tab :label="$t('SuppliersOffers')">
                            <SupplierOffers/>
                        </vs-tab>
                        <vs-tab :label="$t('Areas')">
                            <Areas/>
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
import SupplierOffers from '@/layouts/components/SupplierOffers.vue'
import statistics from '@/layouts/components/statistics.vue'
import Areas from '@/layouts/components/Areas.vue'
export default{
    components: {
        StarRating,
        AllOffers,
        SupplierOffers,
        statistics,
        Areas
    },
    props:{
        offers:{
            type: Array
        }
    },
    data() {
        return {
            // AllOffers:[
            //     {"id":1,src:require('@assets/images/image-1.png'),"title":"أدوات منزلية","status":"نشط",
            //     "date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"297","discount":"15%"},
            //     {"id":2,src:require('@assets/images/image-2.png'),"title":"أدوات منزلية","status":"نشط",
            //     "date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"297","discount":"15%"},
            //     {"id":3,src:require('@assets/images/image-3.png'),"title":"أدوات منزلية",
            //     "status":"نشط","date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"297","discount":"15%"},
            //     {"id":4,src:require('@assets/images/image-4.png'),"title":"أدوات منزلية",
            //     "status":"نشط","date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"297","discount":"15%"},
            //      {"id":5,src:require('@assets/images/image-4.png'),"title":"أدوات منزلية","status":"نشط",
            //     "date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"297","discount":"15%"},
            //     {"id":6,src:require('@assets/images/image-3.png'),"title":"أدوات منزلية","status":"نشط",
            //     "date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"297","discount":"15%"},
            //     {"id":7,src:require('@assets/images/image-2.png'),"title":"أدوات منزلية",
            //     "status":"نشط","date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"297","discount":"15%"},
            //     {"id":8,src:require('@assets/images/image-1.png'),"title":"أدوات منزلية",
            //     "status":"نشط","date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"297","discount":"15%"},
            // ],
            supplierOffers:[
                {"id":1,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-1.png')},
                {"id":2,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-1.png')},
                {"id":3,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-2.png')},
                {"id":4,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-3.png')},
                {"id":5,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-4.png')},
                {"id":6,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-2.png')},
                {"id":7,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-1.png')},
                {"id":8,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-3.png')},
                {"id":9,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-4.png')},
                {"id":10,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-2.png')}
            ],
            users: [
                {"id": 1,"name": "14 متجر","username": "منطقة الرياض","customer": "450 عميلة"},
                {"id": 2,"name": "14 متجر","username": "منطقة الرياض","customer": "450 عميلة"},
                {"id": 3,"name": "14 متجر","username": "منطقة الرياض","customer": "450 عميلة"},
                {"id": 4,"name": "14 متجر","username": "منطقة الرياض","customer": "450 عميلة"},
                {"id": 5,"name": "14 متجر","username": "منطقة الرياض","customer": "450 عميلة"}
            ],
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
