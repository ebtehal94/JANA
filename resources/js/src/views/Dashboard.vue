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
        <div class="vx-row">
            <!-- Stats -->
            <div class="vx-col w-full md:w-1/5">
                <vx-card class="stat sales">
                    <p class="text-right">{{ currency }}</p>
                    <h6>{{ $t('Sales') }}</h6>
                    <h3>{{ getSales() }}</h3>
                </vx-card>

                <vx-card class="stat">
                    <!-- <p class="text-right">SAR</p> -->
                    <h6>{{ $t('NewOrders') }}</h6>
                    <h3>{{ getNewOrders() }}</h3>
                </vx-card>

                <vx-card class="stat">
                    <!-- <p class="text-right">SAR</p> -->
                    <h6>{{ $t('Unfinished') }}</h6>
                    <h3>{{ Math.ceil(getUnfullfilled()) }} %</h3>
                </vx-card>
            </div>

            <!-- Chart -->
            <div class="vx-col w-2/5">
                <vx-card>
                    <vue-apex-charts type="bar" :options="options" :series="series"></vue-apex-charts>
                </vx-card>
            </div>

            <!-- Low Stock Products -->
            <div class="vx-col w-full md:w-2/5">
                <ais-instant-search :search-client="searchClient" index-name="products" id="algolia-instant-search-demo">

                  <ais-configure :hits-per-page.camel="8" :filters="'price_'+country.short_code+' > 0'" />

                <vx-card class="low-stock">
                    <div class="flex align-items text-danger">
                        <feather-icon icon="AlertCircleIcon" svgClasses="w-5 h-5 mr-2"></feather-icon>
                        <h6 class="font-bold text-danger">{{ $t('LowStock') }}</h6>
                    </div>
                    <ais-hits>
                    <!-- <ais-hits :transform-items="relatedItems"> -->
                    <div slot-scope="{ items }">
                        <template>
                            <div v-if="items.length != 0">
                                <div class="mt-2" v-for="item in items" :key="item.objectID">
                                    <template>
                                        <div class="product flex">
                                            <a class="cursor-pointer" @click="$router.push({path: '/products/edit/' + item.id})"><img class="product-size" :src="'https://otantik-home.s3.me-south-1.amazonaws.com/products/' + item.images[0]" alt="Product Image"></a>
                                            <div>
                                                <h6>{{ $i18n.locale == 'en' ? item.title.en : item.title.ar }}</h6>
                                                <h6 class="font-bold mt-10">{{ item['price_' + country.short_code]    }} {{ currency }}</h6>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <div v-else>
                                <p class="text-center p-10">Nothing to Show</p>
                            </div>
                        </template>
                    </div>
                    </ais-hits>
                </vx-card>
                </ais-instant-search>
            </div>
        </div>

        <div class="vx-row">
            <div class="vx-col w-full md:w-2/3">
                <vx-card>
                    <div class="flex align-items">
                        <feather-icon icon="ShoppingBagIcon" svgClasses="w-5 h-5 mr-2"></feather-icon>
                        <h6 class="font-bold">{{ $t('LatestOrders') }}</h6>
                    </div>
                    <div class="mt-3">
                        <vs-table max-items="5" pagination :data="orders">
                            <template slot-scope="{data}">
                                <vs-tr :key="indextr" v-for="(tr, indextr) in data" >
                                <vs-td :data="data[indextr].customer.name">
                                    <div class="flex items-center">
                                        <vs-avatar  class="flex-shrink-0 mr-2" size="10rem" />
                                        <div>
                                            <p>{{ data[indextr].customer.name }}</p>
                                            <p style="font-size: 0.75rem">{{ data[indextr].created_at.split(' ')[0] }}</p>
                                        </div>
                                    </div>
                                </vs-td>

                                <vs-td :data="data[indextr].code">
                                    {{data[indextr].code}}
                                </vs-td>

                                <vs-td :data="data[indextr].total_price">
                                    {{data[indextr].total_price}} {{ currency }}
                                </vs-td>

                                <vs-td :data="data[indextr].status">
                                    <vs-chip transparent class="ag-grid-cell-chip" :color="statusOptions[data[indextr].status].color">
                                    {{ statusOptions[data[indextr].status].label }}
                                    </vs-chip>
                                </vs-td>
                                </vs-tr>
                            </template>
                        </vs-table>
                    </div>
                </vx-card>
            </div>
            <div class="vx-col w-full md:w-1/3">
                <vx-card>
                    <div class="flex align-items">
                        <feather-icon icon="BellIcon" svgClasses="w-5 h-5 mr-2"></feather-icon>
                        <h6 class="font-bold">{{ $t('Questions') }}</h6>
                    </div>
                    <div v-if="questions.length != 0">
                        <div class="mt-3" v-for="question in questions" :key="question.id">
                            <div class="flex justify-center items-center">
                                <vs-avatar  class="flex-shrink-0 mr-2" size="50px" />
                                <div class="question">
                                    <h6 class="font-bold">{{ question.name }}</h6>
                                    <p>{{ question.subject }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <p class="mt-5 text-center">Nothing to show</p>
                    </div>
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
    margin: 2rem;

    .stat {
        margin: 1rem;

        p { font-size: .75rem; }

        h6 { font-size: .85rem; }

        h3 {
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
}
</style>
