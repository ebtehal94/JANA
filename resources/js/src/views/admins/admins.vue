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
                :placeholder="$t('SearchBar')" 
                icon-after vs-icon-after="true"
                v-model="search" 
                class="sm:w-full md:w-full input-rounded-full" 
                icon="icon-search" 
                icon-pack="feather" />
            </div>
            <div class="vx-col cursor-pointer flex">
                <vs-button
                    class="sm:w-full md:w-full  rounded-full text-xs font-bold shadow-none"
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
                            <AllAccounts :search="search"/>
                        </vs-tab>
                    </vs-tabs>
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>
import AllAccounts from './AllAccounts.vue'

// Store Module
import moduleUserManagement from '@/store/user-management/moduleUserManagement.js'
export default{
    components: {
        AllAccounts
    },
    data() {
        return {
            search: '',
            
        }
    },
    computed: {
        // users() {
        //     return this.$store.state.userManagement.users
        // },
    },
    methods: {
        addNewData() {
            this.$router.push({path: '/admins/create'})
        },
    },
    created() {
        // if(!moduleUserManagement.isRegistered) {
        //     this.$store.registerModule('userManagement', moduleUserManagement)
        //     moduleUserManagement.isRegistered = true
        // }

        // this.$store.dispatch("userManagement/fetchUsers").catch(err => { console.error(err) })
        },

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
@media only screen and (max-width: 512px){
    .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large) {
        padding: .5rem 2rem !important;
        margin-top: 1rem;
    }
}
</style>
