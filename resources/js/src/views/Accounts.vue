<!-- =========================================================================================
    File Name: DashboardEcommerce.vue
    Description: Dashboard - Ecommerce
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
    <div id="admin-account">
        <div class="vx-row my-2 justify-center md:justify-between ">
            <div class="vx-col search-page__search-bar flex">
                <vs-input 
                icon-no-border 
                placeholder="اكتب كلمة للبحث" 
                icon-after vs-icon-after="true"
                v-model="searchQuery" 
                class="sm:w-1/2 md:w-full  input-rounded-full" 
                icon="icon-search" 
                icon-pack="feather" />
            </div>
            <div class="vx-col cursor-pointer flex">
                <vs-button
                    class="sm:w-1/2 md:w-full  rounded-full text-xs font-bold shadow-none"
                    color="rgb(255, 255, 255)"
                    text-color="#DC6059"
                    icon-after vs-icon-after="true"
                    icon-pack="feather"
                    icon="icon-plus pl-4"
                    @click="addNewData">
                    {{ $t('CreateNewAdmin') }}
                </vs-button>
          </div>
        </div>
        
        <div class="vx-row">
            <div class="vx-col w-full">
                <vx-card class="mt-8 pt-0">
                    <vs-tabs class="tabs-shadow-none">
                        <vs-tab :label="$t('AllAccounts')">
                            <AllAccounts :accounts="accounts" />
                        </vs-tab>
                    </vs-tabs>
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "@/axios.js"
import AllAccounts from '@/layouts/components/AllAccounts.vue'
export default{
    components: {
        AllAccounts
    },
    data() {
        return {
            accounts:[
                {"id":1,"name":"محمد ناصر علي",src:require('@assets/images/admin.png'),"phone":"0512345678","Email":"jana@jana.com","title":"مدير العلاقات العامة"},
                {"id":2,"name":"محمد ناصر علي",src:require('@assets/images/admin.png'),"phone":"0512345678","Email":"jana@jana.com","title":"مدير العلاقات العامة"},
                {"id":3,"name":"محمد ناصر علي",src:require('@assets/images/admin.png'),"phone":"0512345678","Email":"jana@jana.com","title":"مدير العلاقات العامة"}
            ],
            searchQuery: '',
            
        }
    },
    computed: {

    },
    methods: {
         addNewData() {
        this.$router.push({path: '/CreateAdmin'})
        },
    },
    created() {

    }
}
</script>

<style lang="scss" scoped>
#admin-account {
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
    .vs-con-input{
        .vs-input--placeholder {
            font-size: .8rem;
            color: #ACACAC;
            font-weight: 400;
            padding-right: 3rem !important;
        }
    }
    .vs-button{
        box-shadow: none;
    }
    .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large) {
        padding: 0 2rem;
        box-shadow: none;
    }
    
}
@media only screen and (min-width: 360px) and (max-width: 767px) {
    .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large) {
        padding: .5rem 2rem !important;
        margin-top: 1rem;
    }
}
</style>
