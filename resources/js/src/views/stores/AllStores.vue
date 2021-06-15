<template>
    <div id="all-store">
        <!-- ITEM VIEW - GRID/LIST -->
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
                    <feather-icon
                        icon="GridIcon"
                        @click="currentItemView='item-grid-view'"
                        class="p-2 ml-4 shadow-drop rounded-lg d-theme-dark-bg cursor-pointer"
                        :svgClasses="{'text-primary stroke-current': currentItemView == 'item-grid-view'}" />
                    <feather-icon
                        icon="ListIcon"
                        @click="currentItemView='item-list-view'"
                        class="p-2 ml-4 shadow-drop rounded-lg d-theme-dark-bg cursor-pointer sm:inline-flex"
                        :svgClasses="{'text-primary stroke-current': currentItemView == 'item-list-view'}" />
                </div>
            </div>
        </div>
        
        <!-- GRID VIEW -->
        <template v-if="currentItemView == 'item-grid-view'">    
            <item-grid-view :stores="stores" :display="display"/> 
        </template>
        <!-- LIST VIEW -->
        <template v-else>
            <item-list-view :stores="stores" :display="display"/>
        </template>
    </div>
</template>

<script>
import moduleStoreManagement from '@/store/store-management/moduleStoreManagement.js'
export default {
    components: {
        ItemGridView: () => import('./components/ItemGridView.vue'),
        ItemListView: () => import('./components/ItemListView.vue'),
    },
    props:{
        display:{
            required: false
        },
        search:{
            required: false
        },
        fromDate:{
            required: false
        },
        toDate:{
           required: false 
        }

    },
    data() {
        return {
            imgLink: 'https://janacard.s3.eu-central-1.amazonaws.com/stores/',
            ItemToDelete:null,
            currentItemView: 'item-grid-view',
        }
    },
    computed: {
        stores() {
            return this.$store.state.storeManagement.stores
        },
    },
    watch:{
        search (val){
          this.getResults()
        },
        fromDate (val){
            this.getResults()
        },
        toDate (val){
            this.getResults()
        }
    },
    methods: {
        getResults(){
            var link = "storeManagement/fetchStores"
            if (this.display == 'pending'){
                this.$store.dispatch(link, {status: [0],search: this.search,from: this.fromDate, to: this.toDate}).catch(err => { console.error(err) })
            }else if (this.display == 'active'){
                this.$store.dispatch(link, {status: [1],search: this.search,from: this.fromDate, to: this.toDate}).catch(err => { console.error(err) })
            }else if (this.display == 'reject'){
                this.$store.dispatch(link, {status: [2],search: this.search,from: this.fromDate, to: this.toDate}).catch(err => { console.error(err) })
            }
            else
                this.$store.dispatch(link,{search: this.search, from: this.fromDate, to: this.toDate}).catch(err => { console.error(err) })
            // this.$store.dispatch("storeManagement/fetchStores",{search: this.search,from: this.fromDate, to: this.toDate})
            // .catch(err => { console.error(err) })
        },
    },
    created() {
        if(!moduleStoreManagement.isRegistered) {
            this.$store.registerModule('storeManagement', moduleStoreManagement)
            moduleStoreManagement.isRegistered = true
        }
        
        this.getResults()

    },
}
</script>

<style lang="scss" scoped>
#all-store{
    .store{
        margin-top: 2.5rem;
        img{
            margin-top: -4rem;
        }
        // .action{
        //    margin-top: -lrem;
        // }
        h4{
            font-size: .8rem;
            font-weight: bold;
            padding: 1rem 0 .4rem;
        }
        p{
            font-size:.6rem ;
            color: #ACACAC;
            padding-top: .2rem;
        }
        span{
            font-size: .6rem;
            color: #ACACAC;
        }
        .vs-button.small:not(.includeIconOnly) {
            padding: 0 .9rem;
            border-radius: 30px;
            margin-bottom: -1.9rem;
            margin-left: .5rem;
        }
        .vs-button.small{
            font-size: .6rem;
            font-weight: bold;
        }

    }
}
</style>
