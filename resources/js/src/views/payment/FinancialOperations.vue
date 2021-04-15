<template>
    <div id="financial-operations">
        <div class="vx-row">
            <div class="vx-col w-full">
                <vx-card class="">
                    <vs-tabs class="tabs-shadow-none">
                        <vs-tab :label="$t('All')">
                            <paymentList />
                        </vs-tab>
                        <vs-tab :label="$t('ThisMonth')">
                            <paymentList display='this_month' />
                        </vs-tab>
                    </vs-tabs>
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>




import axios from "@/axios.js"
import paymentList from './paymentList.vue'
export default {
    
    components: {
     paymentList
    },
    data() {
        return {
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