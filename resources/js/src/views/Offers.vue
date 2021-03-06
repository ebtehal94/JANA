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
        <div class="vx-row my-4">
            <div class="search-page__search-bar flex items-center">
                <vs-input icon-no-border placeholder="Search" v-model="searchQuery" class="w-full input-rounded-full" icon="icon-search" icon-pack="feather" />
            </div>
        </div>
        
        <div class="vx-row">
            <div class="vx-col w-full">
                <vx-card class="mt-8 pt-0">
                    <vs-tabs>
                        <vs-tab label="كل العروض">
                            <AllOffers />
                        </vs-tab>
                        <vs-tab label="العروض المعلقة">
                            <AllOffers />
                        </vs-tab>
                        <vs-tab label="العروض النشطة">
                        </vs-tab>
                        <vs-tab label="العروض المتوقفة">
                        </vs-tab>
                    </vs-tabs>
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "@/axios.js"
import algoliasearch from 'algoliasearch/lite'
import { AisConfigure, AisHits, AisInstantSearch } from 'vue-instantsearch'
import StarRating from 'vue-star-rating'
import AllOffers from '@/layouts/components/AllOffers.vue'
export default{
    components: {
        AisConfigure,
        AisHits,
        AisInstantSearch,
        StarRating,
        AllOffers,
    },
    data() {
        return {
            usedOffers:[
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
            currency: '',
            sales: 0,
            newOrders: 0,
            unfullfilled: 0,
            short_code: (localStorage.getItem("country_code")) ? localStorage.getItem("country_code") : 'QTR',
            searchClient: algoliasearch(
                'SXG4PV0YAT',
                '42b8e7ea3e742f53ca29e378b2e53e38'
            ),
            orders: [],
            statusOptions: [
              { label: 'New', color:'#24c1a0', value: 0 },
              { label: 'In Progress', color:'warning', value: 1 },
              { label: 'Ready For Pickup', color:'danger', value: 2 },
              { label: 'On The Way', color:'warning', value: 3 },
              { label: 'Delivered', color:'success', value: 4 },
              { label: 'Cancelled', color:'dark', value: 5 },
            ],
            questions: [],
            options: {
                chart: {
                id: 'vuechart-example'
                },
                xaxis: {
                categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
                }
            },
            series: [{
                name: 'series-1',
                data: [30, 40, 45, 50, 49, 60, 70, 91]
            }]
        }
    },
    computed: {
      countries () {
            return this.$store.state.CountriesList
        },
    },
    methods: {
        getSales() {
            const sales = new Promise((resolve, reject) => {
                axios.get("/api/orders/sales/count")
                .then((response) => {
                    resolve(response)
                })
                .catch((error) => { console.log(error.response) })
            })

            sales.then(res => {
                this.sales = res.data
            }).catch(err => console.log(err))

            return this.sales
        },
        getNewOrders() {
            const newOrders = new Promise((resolve, reject) => {
                axios.get("/api/orders/sales/new")
                .then((response) => {
                    resolve(response)
                })
                .catch((error) => { console.log(error.response) })
            })

            newOrders.then(res => {
                this.newOrders = res.data
            }).catch(err => console.log(err))

            return this.newOrders
        },
        getUnfullfilled() {
            const unfullfilled = new Promise((resolve, reject) => {
                axios.get("/api/orders/sales/unfullfilled")
                .then((response) => {
                    resolve(response)
                })
                .catch((error) => { console.log(error.response) })
            })

            unfullfilled.then(res => {
                this.unfullfilled = res.data
            }).catch(err => console.log(err))

            return this.unfullfilled
        },
        // relatedItems(items) {
        //     return items.filter(item => {
        //         let product = false
        //         for (const [key, val] of Object.entries(item.details)) {
        //             if (key == this.short_code && val.stock <= 5) {
        //                 product = true
        //             }
        //         }
        //
        //         return product
        //     })
        // },
        getQuestions() {
            const questions = new Promise((resolve, reject) => {
                axios.get("/api/questions/list")
                .then((response) => {
                    resolve(response)
                })
                .catch((error) => { console.log(error.response) })
            }).then(res => {
                this.questions = res.data.filter(q => q.status != 1)
            }).catch(err => connsole.log(err))
        }
    },
    created() {
      const currentCountryID = (localStorage.getItem("country")) ? localStorage.getItem("country") : 1
        this.country = this.countries.find((country) => country.id == currentCountryID)
        this.currency = this.country.currency
        this.getOrdersInDetail()
        this.getQuestions()
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
