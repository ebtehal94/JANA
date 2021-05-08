<template>
    <div id="stores">
        <div class="vx-row my-2 justify-center md:justify-between ">
            <div class="vx-col search-page__search-bar flex">
                <vs-input 
                icon-no-border 
                :placeholder="$t('SearchBar')"  
                v-model="search"
                icon-after vs-icon-after="true"  
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
                    {{ $t('CreateNewStore') }}
                </vs-button>
            </div>
        </div>
        <div class="vx-row ml-2 justify-center md:justify-start">
            <flat-pickr
            class="s:w-3/5 md:w-2/12 mt-2"
            v-model="fromDate"
            :placeholder="$t('From')"/>
            
            <flat-pickr
            class="s:w-3/5 md:w-2/12 md:ml-4 mt-2"
            v-model="toDate"
            :placeholder="$t('To')"/>
        </div>
        <div class="vx-row">
            <div class="vx-col w-full">
                <vx-card class="mt-8 pt-0">
                    <vs-tabs class="tabs-shadow-none">
                        <vs-tab :label="$t('AllStores')">
                            <AllStores :search="search" :fromDate="fromDate" :toDate="toDate" />
                        </vs-tab>
                    </vs-tabs>
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>
import AllStores from './AllStores.vue'
import moduleStoreManagement from '@/store/store-management/moduleStoreManagement.js'
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
export default {
    components: {
        AllStores,
        flatPickr
    },
    props:{
        display:{
            required: false
        },
       
    },
    data() {
        return {
            search:'',
            fromDate: '',
            toDate: '',
        }
    },
    computed: {
        // stores() {
        //     return this.$store.state.storeManagement.stores
        // },
    },
    methods: {
        addNewData() {
            this.$router.push({path: '/stores/create'})
        },
    },

    // created() {
    //  if(!moduleStoreManagement.isRegistered) {
    //     this.$store.registerModule('storeManagement', moduleStoreManagement)
    //     moduleStoreManagement.isRegistered = true
    //   }
    //     this.$store.dispatch("storeManagement/fetchStores",{search:this.query}).catch(err => { console.error(err) })
    // },
}
</script>

<style lang="scss" scoped>
#stores{
    margin:3rem;
    .vs-con-table .vs-con-tbody{
        padding: 2rem 0;
    }
    th{
        text-align: center;
    
        .vs-table-text{
            justify-content: center;
        }
    }
    .vs-table--tbody-table tr {
        border-bottom: 1.5px solid #eee;
    }
    .vs-con-table td {
        font-size: .8rem;
        color: #acacaa;
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