<template>
    <div id="financial-operations">
        <div class="vx-row">
            <div class="vx-col w-full">
                <vx-card class="mt-8 pt-0">
                    <vs-tabs class="tabs-shadow-none">
                        <vs-tab :label="$t('ThisMonth')">
                            <vs-table :data="users">
                                    <template slot="thead">
                                        <vs-th >{{$t('customerName')}}</vs-th>
                                        <vs-th>{{$t('date')}}</vs-th>
                                        <vs-th>{{$t('amount')}}</vs-th>
                                        <vs-th class="text-right">{{$t('notes')}}</vs-th>
                                    </template>
                                <template slot-scope="{data}">
                                    <tbody>
                                        <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                            <vs-td>
                                                <p>{{ data[indextr].username }}</p>
                                            </vs-td>

                                            <vs-td>
                                                <p>{{ data[indextr].date}}</p>
                                            </vs-td>

                                            <vs-td>
                                                <!--<span class="pr-40 pl=24">|</span>-->
                                                <p>{{ data[indextr].amount}}</p>
                                            </vs-td>
    
                                            <vs-td>
                                                <p>{{ data[indextr].notes}}</p>
                                            </vs-td>
                                        </vs-tr>
                                    </tbody>
                                </template>
                            </vs-table> 
                        </vs-tab>
                        <vs-tab :label="$t('All')">
                            <vs-table :data="users">
                                <template slot="thead">
                                    <vs-th>{{$t('customerName')}}</vs-th>
                                    <vs-th>{{$t('date')}}</vs-th>
                                    <vs-th>{{$t('amount')}}</vs-th>
                                    <vs-th >{{$t('notes')}}</vs-th>
                                </template>
                                <template slot-scope="{data}">
                                    <tbody>
                                        <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                            <vs-td>
                                                <p>{{ data[indextr].username }}</p>
                                            </vs-td>

                                            <vs-td>
                                                <p>{{ data[indextr].date}}</p>
                                            </vs-td>

                                            <vs-td>
                                                <!--<span class="pr-40 pl=24">|</span>-->
                                                <p >{{ data[indextr].amount}}</p>
                                            </vs-td>

                                            <vs-td>
                                                <p>{{ data[indextr].notes}}</p>
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





export default {
    components: {
     
    },
    data() {
        return {
            users: [
                {"id": 1,"name": "14 متجر","username": "عميلة بطاقة جنى","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
                {"id": 2,"name": "14 متجر","username": "عميلة بطاقة جنى","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
                {"id": 3,"name": "14 متجر","username": "عميلة بطاقة جنى","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
                {"id": 4,"name": "14 متجر","username": " عميلة بطاقة جنى","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
                {"id": 5,"name": "14 متجر","username": "عميلة بطاقة جنى ","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
                {"id": 6,"name": "14 متجر","username": "عميلة بطاقة جنى ","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
                {"id": 7,"name": "14 متجر","username": "عميلة بطاقة جنى ","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
                {"id": 8,"name": "14 متجر","username": "عميلة بطاقة جنى ","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
                {"id": 9,"name": "14 متجر","username": "عميلة بطاقة جنى ","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
                {"id": 10,"name": "14 متجر","username": "عميلة بطاقة جنى ","date":"15/04/2020","amount": "143 ر.س","notes":"مقابل الإشتراك في التطبيق"},
            ],
        }
    },
    computed: {

    },
    methods: {

    },

    created() {

    },
}
</script>

<style lang="scss" scoped>
#financial-operations{
    margin:3rem;
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