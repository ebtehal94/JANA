<!-- =========================================================================================
    File Name: DashboardEcommerce.vue
    Description: Dashboard - Ecommerce
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
    <div id="customers">
        <div class="vx-row my-2 justify-center md:justify-between ">
            <div class="vx-col  search-page__search-bar flex">
                <vs-input
                icon-no-border
                :placeholder="$t('SearchBar')" 
                icon-after vs-icon-after="true"
                v-model="searchQuery"
                class="sm:w-full md:w-full input-rounded-full"
                icon="icon-search"
                icon-pack="feather" />
            </div>
            <div class="vx-col cursor-pointer flex">
                <vs-button
                    class="sm:w-full md:w-full rounded-full text-xs font-bold shadow-none"
                    color="rgb(255, 255, 255)"
                    text-color="#DC6059"
                    icon-after vs-icon-after="true"
                    icon-pack="feather"
                    icon="icon-plus pl-4"
                    @click="addNewData">
                    {{ $t('CreateNewCustomer') }}
                </vs-button>
          </div>
        </div>

        <div class="vx-row">
            <div class="vx-col w-full">
                <vx-card class="mt-8 pt-0">
                    <vs-tabs class="tabs-shadow-none">
                        <vs-tab label="كل العملاء">
                            <AllCustomers :customers="customers"/>
                        </vs-tab>
                        <vs-tab label="الحسابات المعلقة">
                            <AllCustomers display="pending" :customers="customers" />
                            <!--<SuspendedAccounts pending=true :accounts="accounts"/>-->
                        </vs-tab>
                        <vs-tab label="عملاء جدد استخدموا كود الإحالات">
                            <AllCustomers display="new_customer" :customers="customers" />
                        </vs-tab>
                    </vs-tabs>
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "@/axios.js"
import moduleCustomerManagement from '@/store/customer-management/moduleCustomerManagement.js'
import AllCustomers from './AllCustomers.vue'
// import SuspendedAccounts from '@/layouts/components/SuspendedAccounts.vue'
export default{
    components: {
        AllCustomers,
        // SuspendedAccounts
    },
    data() {
        return {
            searchQuery: '',
            // customers:[
            //     {"id":1,"name":"عميلة بطاقات جنا","subtitle":"مرحبا بك ,كيف نستطيع خدمتك",src:require('@assets/images/customers.png'),"phone":"0512345678","Email":"jana@jana.com","code":"058765485","Refrral":"كود الإحالة"},
            //     {"id":2,"name":"عميلة بطاقات جنا","subtitle":"مرحبا بك ,كيف نستطيع خدمتك",src:require('@assets/images/customers.png'),"phone":"0512345678","Email":"jana@jana.com","code":"058765485","Refrral":"كود الإحالة"},
            //     {"id":3,"name":"عميلة بطاقات جنا","subtitle":"مرحبا بك ,كيف نستطيع خدمتك",src:require('@assets/images/customers.png'),"phone":"0512345678","Email":"jana@jana.com","code":"058765485","Refrral":"كود الإحالة"},
            //     {"id":4,"name":"عميلة بطاقات جنا","subtitle":"مرحبا بك ,كيف نستطيع خدمتك",src:require('@assets/images/customers.png'),"phone":"0512345678","Email":"jana@jana.com","code":"058765485","Refrral":"كود الإحالة"},
            //     {"id":5,"name":"عميلة بطاقات جنا","subtitle":"مرحبا بك ,كيف نستطيع خدمتك",src:require('@assets/images/customers.png'),"phone":"0512345678","Email":"jana@jana.com","code":"058765485","Refrral":"كود الإحالة"},
            //     {"id":6,"name":"عميلة بطاقات جنا","subtitle":"مرحبا بك ,كيف نستطيع خدمتك",src:require('@assets/images/customers.png'),"phone":"0512345678","Email":"jana@jana.com","code":"058765485","Refrral":"كود الإحالة"},
            //     {"id":7,"name":"عميلة بطاقات جنا","subtitle":"مرحبا بك ,كيف نستطيع خدمتك",src:require('@assets/images/customers.png'),"phone":"0512345678","Email":"jana@jana.com","code":"058765485","Refrral":"كود الإحالة"},
            //     {"id":8,"name":"عميلة بطاقات جنا","subtitle":"مرحبا بك ,كيف نستطيع خدمتك",src:require('@assets/images/customers.png'),"phone":"0512345678","Email":"jana@jana.com","code":"058765485","Refrral":"كود الإحالة"},
            // ],
           

        }
    },
    computed: {
      customers() {
        return this.$store.state.customerManagement.customers
      },
    },
    methods: {
        addNewData() {
        this.$router.push({path: '/customers/create'})
        },
    },
    created() {
        if(!moduleCustomerManagement.isRegistered) {
            this.$store.registerModule('customerManagement', moduleCustomerManagement)
            moduleCustomerManagement.isRegistered = true
        }
        var link = "customerManagement/fetchCustomers"
        if (this.display == 'pending'){
            this.$store.dispatch(link, {status: [0]}).catch(err => { console.error(err) })
        }else if (this.display == 'new_customer'){
            this.$store.dispatch(link, {filter: 'new_customer'}).catch(err => { console.error(err) })
        }else
        this.$store.dispatch(link).catch(err => { console.error(err) })
    }
}
</script>

<style lang="scss" scoped>
#customers {
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
    .vs-button{
        box-shadow: none;
    }
    .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large) {
        padding: 0 2rem;
        box-shadow: none;
    }
}
@media only screen and (max-width: 512px){
    .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large) {
        padding: .5rem 2rem !important;
        margin-top: 1rem;
    }
}

</style>
