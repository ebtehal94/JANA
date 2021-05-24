<template>
    <div id="all-customers">
        <!-- ITEM VIEW - GRID/LIST -->
        <div class="vx-row">
            <div class="vx-col w-full" >
                <div class="float-right mr-4 mb-2 flex">
                    <export-excel
                        :data = "customers"
                        worksheet = "My Worksheet"
                        name = "filename.xls">
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
            <item-grid-view :customers="customers" :display="display"/> 
        </template>
        <!-- LIST VIEW -->
        <template v-else>
            <item-list-view :customers="customers" :display="display"/>
        </template>

    </div>
</template>

<script>
import axios from "@/axios.js"
import moduleCustomerManagement from '@/store/customer-management/moduleCustomerManagement.js'
export default {
    components: {
        ItemGridView: () => import('./components/ItemGridView.vue'),
        ItemListView: () => import('./components/ItemListView.vue'),
    },
    props:{
        display:{
            required:false
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
      ItemToDelete: null,
      currentItemView: 'item-grid-view',
    //   currentPage:1
    }
  },
    computed: {
      customers() {
        return this.$store.state.customerManagement.customers
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
    // nextPage(){
    //     this.currentPage++
    // },
    getResults(){
        var link = "customerManagement/fetchCustomers"
        if (this.display == 'pending'){
            this.$store.dispatch(link, {status: [0] ,search: this.search,from: this.fromDate, to: this.toDate}).catch(err => { console.error(err) })
        }else if (this.display == 'new_customer'){
            // axios.post("/api/customers/list/",{params:{filter: 'new_customer'}} )
            // .then((res) => {
            // (res.data)
            // })
            // .catch((error) => console.log(error))
            this.$store.dispatch(link, {filter: 'new_customer'}).catch(err => { console.error(err) })
        }else
        this.$store.dispatch(link,{search: this.search,from: this.fromDate, to: this.toDate}).catch(err => { console.error(err) })
    },
    // gotoEdit(id){
    //   // console.log('customers/edit/' + id)
    //   this.$router.push({path: 'customers/edit/' + id})
    // },
    // openDeleteConfirm(id) {
    //   this.ItemToDelete = id;
    //    this.$vs.dialog({
    //      type: 'confirm',
    //      color: 'danger',
    //      title: this.$t('Delete'),
    //      text: 'هل أنت متأكدأنك تريد حذف هذا العميل نهائياً؟',
    //      accept: this.deleteCustoemr
    //    })
    //  },
    // deleteCustoemr(){
    //   this.$store.dispatch("customerManagement/removeCustomer", this.ItemToDelete).catch(err => { console.error(err) })
    // },
    // updateStatus(id, status){
    //   this.$store.dispatch("customerManagement/updateCustomer", {id:id, status:status})
    //     .then(()   => { this.showUpdateSuccess() })
    //     .then(()  => { this.$store.dispatch("customerManagement/fetchCustomers", {status: [0]})
    //     })
    //     .catch(err => { console.error(err.response)})
    // },
    // showUpdateSuccess() {
    //         this.$vs.notify({
    //         color: 'success',
    //         title: 'Successfull',
    //         text: 'تم بنجاح'
    //     })
    // }
    
  },

    created() {
        if(!moduleCustomerManagement.isRegistered) {
            this.$store.registerModule('customerManagement', moduleCustomerManagement)
            moduleCustomerManagement.isRegistered = true
        }
        this.getResults()

    }
}
</script>

<style lang="scss" scoped>
#all-customers{
    .customers{
        margin-top: 2.5rem;
        height: 165px;
        img{
            margin-top: -4rem;
        }
        .action{
            margin-top: -1rem;
        }
        h4{
            font-size: .8rem;
            font-weight: bold;
            padding-top: 1rem;
        }
        h6{
            font-size:.6rem ;
            padding:8px 0 4px 0;
            color: #ACACAC;
        }
        span{
            font-size: .7rem;
            color: #ACACAC;
        }
        .code{
            color:#EA5455;
            font-weight: bold;
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
