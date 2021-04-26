<template>
    <div id="">
        <div class="vx-row">
            <div class="vx-col w-full">
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
            
            // users: [
            //     {"id": 1,"name": "14 متجر","username": "عميلة بطاقة جنى","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
            //     {"id": 2,"name": "14 متجر","username": "عميلة بطاقة جنى","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
            //     {"id": 3,"name": "14 متجر","username": "عميلة بطاقة جنى","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
            //     {"id": 4,"name": "14 متجر","username": " عميلة بطاقة جنى","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
            //     {"id": 5,"name": "14 متجر","username": "عميلة بطاقة جنى ","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
            //     {"id": 6,"name": "14 متجر","username": "عميلة بطاقة جنى ","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
            //     {"id": 7,"name": "14 متجر","username": "عميلة بطاقة جنى ","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
            //     {"id": 8,"name": "14 متجر","username": "عميلة بطاقة جنى ","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
            //     {"id": 9,"name": "14 متجر","username": "عميلة بطاقة جنى ","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
            //     {"id": 10,"name": "14 متجر","username": "عميلة بطاقة جنى ","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
            // ],
        }
    },
    computed: {

    },
    methods: {

    },

    created() {
        
        if (this.display == 'this_month'){
            axios.get('/api/payments/list',{filter:'this_month'})
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

}
</style>