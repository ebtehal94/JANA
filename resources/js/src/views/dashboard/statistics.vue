<template>
    <div id="statistics">
        <div class="vx-row flex justify-center my-4">
            <div v-if="$acl.check('admin')" class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4">
                <vx-card class="stat">
                    <h6 class="pt-2.5" @click="goToCustomer">{{ $t('customerNumber') }} {{statistics.all_customers}}</h6>
                    <vs-divider/>
                    <h3 class="text-primary">
                        {{statistics.new_customers}}  {{ $t('newCustomer') }}
                        <span class="pl-3">
                            <svg id="increase" xmlns="http://www.w3.org/2000/svg" width="20" height="14.959" viewBox="0 0 26.927 14.959"><path id="increase-2" data-name="increase" d="M89.437,298.673H84.95a1.5,1.5,0,0,0,0,2.992h.678l-6.764,6.281-4.985-3.738a1.5,1.5,0,0,0-1.9.085l-7.48,6.732a1.5,1.5,0,0,0,2,2.224l6.565-5.909,5,3.749a1.5,1.5,0,0,0,1.915-.1l7.958-7.389v1.057a1.5,1.5,0,0,0,2.992,0v-4.488A1.5,1.5,0,0,0,89.437,298.673Z" transform="translate(-64.007 -298.673)" fill="#2ec114"/></svg>
                        </span>
                    </h3>
                </vx-card>
            </div>
            <div v-if="$acl.check('admin')" class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4">
                <vx-card class="stat">
                    <h6 class="pt-2.5" @click="goToStore">{{ $t('storeNumber') }} {{statistics.all_stores}}</h6>
                    <vs-divider/>
                    <h3 class="text-gray-400">{{statistics.new_stores}} {{ $t('newStore') }}
                        <span class="pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="14.959" viewBox="0 0 26.927 14.959"><path id="decrease" d="M89.438,313.632H84.95a1.5,1.5,0,1,1,0-2.992h.678l-6.764-6.281L73.879,308.1a1.5,1.5,0,0,1-1.9-.085L64.5,301.28a1.5,1.5,0,0,1,2-2.223l6.565,5.909,5-3.749a1.5,1.5,0,0,1,1.915.1l7.958,7.389v-1.057a1.5,1.5,0,0,1,2.992,0v4.488A1.5,1.5,0,0,1,89.438,313.632Z" transform="translate(-64.007 -298.673)" fill="#f35162"/></svg>
                        </span>
                    </h3>
                </vx-card>
            </div>
            <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4">
                <vx-card class="stat">
                    <h6 class="pt-2.5" @click="goToOffer">{{ $t('offerNumber') }} {{statistics.all_offers}}</h6>
                    <vs-divider/>
                    <h3 class="text-primary">{{statistics.new_offers}} {{ $t('newOffer') }}</h3>
                </vx-card>
            </div>
            <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4">
                <vx-card class="stat">
                    <h6 class="pt-2.5">{{ $t('activeOffers') }}</h6>
                    <h3 class="text-black text-4xl pt-4">{{statistics.active_offers}}
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
    </div>
</template>

<script>
    import axios from "@/axios.js"
    export default {
        components: {

        },
        props:{

        },
        data() {
            return {
                statistics: {new_customers: null, all_customers: null, new_stores:null, all_stores: null, new_offers:null, all_offers:null, active_offers:null},
            }
        },
        computed: {

        },
        methods: {
            goToCustomer(){
                this.$router.push({path: 'customers'})
            },
            goToStore(){
                this.$router.push({path: 'stores'})
            },
            goToOffer(){
                this.$router.push({path: 'offers'})
            }
        },
        created() {
            axios.get('/api/statistics/dashboard')
            .then((res) => {
            this.statistics = res.data.statistics
            })
            .catch((error) => console.log(error))
        }


    }

</script>

<style lang="scss" scoped>
#statistics {
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

        h6 { font-size: .85rem;
             cursor: pointer;}

        h3 {
            font-size: 1.1rem;
            color: #747474;
            font-weight: bold;
        }
    }

    @media (max-width: 992px){
        .stat{
            margin-bottom: 1.3rem;
        }
    }
}
</style>
