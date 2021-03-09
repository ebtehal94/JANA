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
        <div class="vx-row flex justify-center my-4">
            <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4">
                <vx-card class="stat">
                    <h6 class="pt-2.5">عدد الأعضاء 1547</h6>
                    <vs-divider/>
                    <h3 class="text-primary">
                        17 عضو جديد
                        <span class="pl-3">
                            <svg id="increase" xmlns="http://www.w3.org/2000/svg" width="20" height="14.959" viewBox="0 0 26.927 14.959"><path id="increase-2" data-name="increase" d="M89.437,298.673H84.95a1.5,1.5,0,0,0,0,2.992h.678l-6.764,6.281-4.985-3.738a1.5,1.5,0,0,0-1.9.085l-7.48,6.732a1.5,1.5,0,0,0,2,2.224l6.565-5.909,5,3.749a1.5,1.5,0,0,0,1.915-.1l7.958-7.389v1.057a1.5,1.5,0,0,0,2.992,0v-4.488A1.5,1.5,0,0,0,89.437,298.673Z" transform="translate(-64.007 -298.673)" fill="#2ec114"/></svg>
                        </span>
                    </h3>
                </vx-card>
            </div>
            <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4">
                <vx-card class="stat">
                    <h6 class="pt-2.5">عدد المتاجر 1547</h6>
                    <vs-divider/>
                    <h3 class="text-gray-400">0 متجر جديد
                        <span class="pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="14.959" viewBox="0 0 26.927 14.959"><path id="decrease" d="M89.438,313.632H84.95a1.5,1.5,0,1,1,0-2.992h.678l-6.764-6.281L73.879,308.1a1.5,1.5,0,0,1-1.9-.085L64.5,301.28a1.5,1.5,0,0,1,2-2.223l6.565,5.909,5-3.749a1.5,1.5,0,0,1,1.915.1l7.958,7.389v-1.057a1.5,1.5,0,0,1,2.992,0v4.488A1.5,1.5,0,0,1,89.438,313.632Z" transform="translate(-64.007 -298.673)" fill="#f35162"/></svg>
                        </span>
                    </h3>
                </vx-card>
            </div>
            <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4">
                <vx-card class="stat">
                    <h6 class="pt-2.5">عدد العروض  1547</h6>
                    <vs-divider/>
                    <h3 class="text-primary">18 عرض مستخدم</h3>
                </vx-card>
            </div>
            <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4">
                <vx-card class="stat">
                    <h6 class="pt-2.5">العروض النشطة حاليا</h6>
                    <h3 class="text-black text-4xl pt-4">46
                        <span class="pl-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 29.881 21.419">
                            <g id="decrease" transform="matrix(-0.966, -0.259, 0.259, -0.966, 26.009, 21.419)">
                                <path id="decrease-2" data-name="decrease" d="M89.438,313.632H84.95a1.5,1.5,0,1,1,0-2.992h.678l-6.764-6.281L73.879,308.1a1.5,1.5,0,0,1-1.9-.085L64.5,301.28a1.5,1.5,0,0,1,2-2.223l6.565,5.909,5-3.749a1.5,1.5,0,0,1,1.915.1l7.958,7.389v-1.057a1.5,1.5,0,0,1,2.992,0v4.488A1.5,1.5,0,0,1,89.438,313.632Z" transform="translate(-64.007 -298.673)" fill="#2ec114"/>
                            </g>
                            </svg>
                        </span>
                    </h3>
                </vx-card> 
            </div>
        </div>
        
        <div class="vx-row">
            <div class="vx-col w-full">
                <vx-card class="mt-8 pt-0">
                    
                        <vs-tabs alignment="fixed">
                            <vs-tab label="أكثر العروض استخداما">
                                <AllOffers />
                            </vs-tab>
                            <vs-tab label="عدد العروض المضافة من كل مورد">
                                <SupplierOffers/>
                            </vs-tab>
                            <vs-tab label="أكثر المناطق تستخدم العروض">
                                <vs-table :data="users">
                                    <template slot-scope="{data}">
                                        <tbody>
                                            <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                                <vs-td>
                                                    <p class="name font-bold">{{ data[indextr].username }}</p>
                                                </vs-td>

                                                <vs-td>
                                                    <span class="">|</span>
                                                </vs-td>

                                                <vs-td>
                                                    <p class="text-right">{{ data[indextr].name }}</p>
                                                </vs-td>

                                                <vs-td>
                                                    <p class="text-right">{{ data[indextr].customer}}</p>
                                                </vs-td>
                                            </vs-tr>
                                        </tbody>
                                    </template>
                                </vs-table>
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
export default{
    components: {
        StarRating,
        AllOffers,
        SupplierOffers
    },
    data() {
        return {
            AllOffers:[
                {"id":1,src:require('@assets/images/image-1.png'),"title":"أدوات منزلية","status":"نشط",
                "date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"297","discount":"15%"},
                {"id":2,src:require('@assets/images/image-2.png'),"title":"أدوات منزلية","status":"نشط",
                "date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"297","discount":"15%"},
                {"id":3,src:require('@assets/images/image-3.png'),"title":"أدوات منزلية",
                "status":"نشط","date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"297","discount":"15%"},
                {"id":4,src:require('@assets/images/image-4.png'),"title":"أدوات منزلية",
                "status":"نشط","date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"297","discount":"15%"},
                 {"id":5,src:require('@assets/images/image-4.png'),"title":"أدوات منزلية","status":"نشط",
                "date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"297","discount":"15%"},
                {"id":6,src:require('@assets/images/image-3.png'),"title":"أدوات منزلية","status":"نشط",
                "date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"297","discount":"15%"},
                {"id":7,src:require('@assets/images/image-2.png'),"title":"أدوات منزلية",
                "status":"نشط","date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"297","discount":"15%"},
                {"id":8,src:require('@assets/images/image-1.png'),"title":"أدوات منزلية",
                "status":"نشط","date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"297","discount":"15%"},
            ],
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
