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
                        <span class="pl-3">
                            <svg id="increase" xmlns="http://www.w3.org/2000/svg" width="20" height="14.959" viewBox="0 0 26.927 14.959"><path id="increase-2" data-name="increase" d="M89.437,298.673H84.95a1.5,1.5,0,0,0,0,2.992h.678l-6.764,6.281-4.985-3.738a1.5,1.5,0,0,0-1.9.085l-7.48,6.732a1.5,1.5,0,0,0,2,2.224l6.565-5.909,5,3.749a1.5,1.5,0,0,0,1.915-.1l7.958-7.389v1.057a1.5,1.5,0,0,0,2.992,0v-4.488A1.5,1.5,0,0,0,89.437,298.673Z" transform="translate(-64.007 -298.673)" fill="#2ec114"/></svg>
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
                                <div>
                                    
                                </div>
                            </vs-tab>
                            <vs-tab label="عدد العروض المضافة من كل مورد">
                                <div class="vx-row mt-5"> 
                                    <div v-for="user in users" class="vx-col w-full sm:w-1/2 lg:w-1/5 mb-base" v-bind:key="user.id">
                                        <vx-card class="shadow">
                                            <h4 class="mb-3 text-base">{{user.name}}</h4>
                                        </vx-card>
                                    </div>
                                </div>
                            </vs-tab>
                            <vs-tab label="أكثر المناطق تستخدم العروض">
                                <vs-table :data="users">
                                    <template slot-scope="{data}">
                                        <tbody>
                                            <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                                <vs-td>
                                                    <p class="font-semibold text-base">{{ data[indextr].username }}</p>
                                                </vs-td>

                                                <vs-td>
                                                    <span class="pr-40 pl=24">|</span>
                                                    <span>{{ data[indextr].name }}</span>
                                                </vs-td>

                                                <vs-td>
                                                    <p class="text-base">{{ data[indextr].customer}}</p>
                                                </vs-td>

                                                <!--<vs-td>
                                                    <p class="text-base">{{ data[indextr].id }}</p>
                                                </vs-td>-->
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
import VueApexCharts from 'vue-apexcharts'
import algoliasearch from 'algoliasearch/lite'
import { AisConfigure, AisHits, AisInstantSearch } from 'vue-instantsearch'

export default{
    components: {
        VueApexCharts,
        AisConfigure,
        AisHits,
        AisInstantSearch,
    },
    data() {
        return {
        users: [
                {
                "id": 1,
                "name": "14 متجر",
                "username": "منطقة الرياض",
                "customer": "450 عميلة",
                },
                {
                "id": 2,
                "name": "14 متجر",
                "username": "منطقة الرياض",
                "customer": "450 عميلة",
                },
                {
                "id": 3,
                "name": "14 متجر",
                "username": "منطقة الرياض",
                "customer": "450 عميلة",
                },
                {
                "id": 4,
                "name": "14 متجر",
                "username": "منطقة الرياض",
                "customer": "450 عميلة",
                },
                {
                "id": 5,
                "name": "14 متجر",
                "username": "منطقة الرياض",
                "customer": "450 عميلة",
                }
 
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
        getOrdersInDetail() {
            const orders = new Promise((resolve, reject) => {
            axios.get("/api/orders/list")
                .then((response) => {
                    resolve(response)
                })
                .catch((error) => { reject(error) })
            }).then(res => {
                this.orders = res.data.filter(order => order.status == 0)
            })
        },
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
    .stat {
        p { font-size: .75rem; }

        h6 { font-size: .85rem; }

        h3 {
            font-size: 1.3rem;
            color: #747474;
            font-weight: bold;
        }
    }

    .sales {
        background: #bd9c72;

        p, h3, h6 { color: #fff; }
    }

    .low-stock {
        margin: 1rem;
        // width: 20rem;
        height: 21.5rem;
        overflow: hidden;
    }

    .product {
        .product-size {
            width: 7.5rem;
            height: 7.5rem;
        }
    }
    .vs-tabs--ul{
        -webkit-box-shadow: none;
        box-shadow: none;
    }
    .vs-tabs--li button.vs-tabs--btn{
        font-size: .9rem;
        font-weight: bold;
    }
    .vs-tr{
        border-bottom: 1.5px solid #eee;
    }
}
</style>
