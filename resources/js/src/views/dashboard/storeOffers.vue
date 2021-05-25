<template>
    <div id="supplier-offers">
        <div class="vx-row">
            <div class="vx-col w-full" >
                <div class="float-right mr-4 mb-2 flex">
                    <export-excel
                        :data = "stores"
                        worksheet = "My Worksheet"
                        name = "Jana.xls">
                        <vs-button
                            color="linear-gradient(to left,#E93F7D,#DA6653)"
                            gradient
                            size="small"
                            class="text-base font-semibold">
                            {{ $i18n.locale == 'en' ? 'Export' : 'تصدير' }}
                        </vs-button>
                    </export-excel>
                </div>
            </div>
        </div>
        <div class="vx-row mt-5"> 
            <div v-for="item in stores" class="flex flex-col flex-wrap vx-col w-full sm:w-1/2 lg:w-1/5 mb-base px-2.5" v-bind:key="item.id">
                <vx-card class="offer shadow flex-1">
                    <img v-if="item.image" :src="imgLink + item.image"  class="text-center mx-auto" width="80px"/>
                    <img v-else :src="require('@assets/images/store.png')" class="text-center mx-auto" width="80px"/>
                    <h4 class="text-center">{{ $i18n.locale == 'en' ? (item.name_en || $t('NA')) : (item.name_ar  || $t('NA'))}}</h4>
                    
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
            stores:[],
            imgLink: 'https://janacard.s3.eu-central-1.amazonaws.com/stores/'
            // supplierOffers:[
            //     {"id":1,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-1.png')},
            //     {"id":2,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-1.png')},
            //     {"id":3,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-2.png')},
            //     {"id":4,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-3.png')},
            //     {"id":5,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-4.png')},
            //     {"id":6,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-2.png')},
            //     {"id":7,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-1.png')},
            //     {"id":8,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-3.png')},
            //     {"id":9,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-4.png')},
            //     {"id":10,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-2.png')}
            // ],
        }
    },
        computed: {

        },
        methods: {

        },
        created() {
            axios.get('/api/statistics/storeOffers')
            .then((res) => {
                this.stores = res.data.stores
            })
            .catch((error) => console.log(error))
        }
}
</script>

<style lang="scss" scoped>
#supplier-offers{
    .offer{
        margin-top: 2.5rem;
        img{
            margin-top: -3rem;
        }
        h4{
            font-size: .8rem;
            font-weight: bold;
            padding-top: .7rem;
        }
        span{
            font-size: .7rem;
            padding-top: .5rem;
        }
    }
}  
</style>