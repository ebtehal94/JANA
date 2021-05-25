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
                v-model="search"
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
        <div class="vx-row ml-2 justify-center md:justify-start">
            <template>
                <flat-pickr
                class="s:w-3/5 md:w-2/12 mt-2"
                :config="configFromdateTimePicker"
                v-model="fromDate"
                :placeholder="$t('From')"
                @on-change="onFromChange" />
                
                <flat-pickr
                class="s:w-3/5 md:w-2/12 sm:ml-4 mt-2"
                :config="configTodateTimePicker"
                v-model="toDate"
                :placeholder="$t('To')"
                @on-change="onToChange" />
            </template>
        </div>
        <div class="vx-row">
            <div class="vx-col w-full">
                <vx-card class="mt-8 pt-0">
                    <vs-tabs class="tabs-shadow-none">
                        <vs-tab :label="$t('AllCustomers')">
                            <AllCustomers :search="search" :fromDate="fromDate" :toDate="toDate"/>
                        </vs-tab>
                        <vs-tab :label="$t('PendingCustomers')">
                            <AllCustomers display="pending" :search="search" :fromDate="fromDate" :toDate="toDate" />
                        </vs-tab>
                        <vs-tab :label="$t('NewCustomers')">
                            <AllCustomers display="new_customer" :search="search" :fromDate="fromDate" :toDate="toDate" />
                        </vs-tab>
                    </vs-tabs>
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "@/axios.js"
import AllCustomers from './AllCustomers.vue';
import list from './list.vue';
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import List from './list.vue';

export default{
    components: {
        AllCustomers,
        flatPickr,
        list,
        List
    },
   props:{
        // customers:{
        //   type: Array
        // },
        display:{
            required: false
        }
    },
    data() {
        return {
            search: '',
            fromDate: '',
            toDate: '',
            configFromdateTimePicker: {
              maxDate: null
            },
            configTodateTimePicker: {
              minDate: null
            }
        }
    },

    methods: {
        onFromChange(selectedDates, dateStr, instance) {
            this.$set(this.configTodateTimePicker, 'minDate', dateStr);
        },
        onToChange(selectedDates, dateStr, instance) {
            this.$set(this.configFromdateTimePicker, 'maxDate', dateStr);
        },
        addNewData() {
        this.$router.push({path: '/customers/create'})
        },
    },

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
    .flatpickr-input{
      border-radius:20px ;
      padding: .7rem 0 .8rem 1rem;
    //   font-size: .9rem;
    }
}
@media only screen and (max-width: 512px){
    .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large) {
        padding: .5rem 2rem !important;
        margin-top: 1rem;
    }
}

</style>
