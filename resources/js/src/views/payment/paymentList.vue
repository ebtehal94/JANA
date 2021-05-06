<template>
    <div id="">
        <div class="vx-row">
            <div class="vx-col w-full">
                <!-- <div>
                    <export-excel
                    :data   = "payments"
                    worksheet = "My Worksheet"
                    type    = "csv"
                    name    = "filename.xls">
                    <vs-button
                        color="linear-gradient(to left,#E93F7D,#DA6653)"
                        gradient
                        class="export">
                        {{ $i18n.locale == 'en' ? 'Export' : 'تصدير' }}
                    </vs-button>
                    </export-excel>
                </div> -->
                <vs-table max-items="10" pagination :data="payments">
                    <template slot="thead">
                        <vs-th >{{$t('CustomerNumber')}}</vs-th>
                        <vs-th>{{$t('CardNumber')}}</vs-th>
                        <vs-th>{{$t('amount')}}</vs-th>
                        <vs-th class="text-right">{{$t('ref')}}</vs-th>
                    </template>
                        <template slot-scope="{data}">
                            <tbody>
                                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                    <vs-td>
                                        <p>{{ data[indextr].customer_id }}</p>
                                    </vs-td>

                                    <vs-td>
                                        <p>{{ data[indextr].card_number}}</p>
                                    </vs-td>

                                    <vs-td>
                                        <!--<span class="pr-40 pl=24">|</span>-->
                                        <p>{{ data[indextr].amount}}</p>
                                    </vs-td>
    
                                    <vs-td>
                                        <p>{{ data[indextr].ref}}</p>
                                    </vs-td>
                                </vs-tr>
                            </tbody>
                        </template>
                </vs-table> 
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
        display:{
            required: false
        }
    },
    data() {
        return {
            payments: [],
            
        }
    },
    computed: {

    },
    methods: {

        },

    created() {
        
        if (this.display == 'this_month'){
             axios.get('/api/payments/list', {params:{filter:'this_month'}})
            .then((res) => {
            this.payments = res.data.payments
            })
            .catch((error) => console.log(error)) 
            
        }else{
            axios.get('/api/payments/list')
            .then((res) => {
            this.payments = res.data.payments
            })
            .catch((error) => console.log(error))
        }
       
    },
}
</script>

<style lang="scss" scoped>
#financial-operations{
    .vs-con-table .vs-con-tbody{
        padding: 2rem 0;
    }
    th .vs-table-text {
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    }

    .vs-table--thead{
      th {

        .vs-table-text{
            justify-content: center;
            -webkit-box-pack: center;
        }
      }
    }
    .vs-table--tbody-table tr {
        border-bottom: 1.5px solid #eee;
    }
    .vs-con-table td {
        font-size: .8rem;
        color: #acacaa;
    }
    // .export{
    //     border-radius:30px ;
    // }
    .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large){
        padding: .4rem 2rem;
        margin-left: 85%;
    }
}
@media only screen and (min-width: 375px) and (max-width: 600px) {
    #financial-operations{
        .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large){
            margin-left: 70%;
        }
    }
}
@media only screen and (min-width: 360px) and (max-width: 375px) {
    #financial-operations{
        .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large){
            margin-left: 55%;
        }
    }
}
</style>