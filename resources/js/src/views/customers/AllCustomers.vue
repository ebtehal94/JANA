<template>
    <div id="all-customers">
        <div class="p-2">
        <div class="vx-row mt-5">
            <div v-for="item in customers" class="flex flex-col flex-wrap vx-col w-full sm:w-1/2 lg:w-1/4 mb-base px-2.5" v-bind:key="item.id">
                <vx-card class="customers shadow flex-1">
                    <img v-if="display == 'pending'" :src="require('@assets/images/accounts.png')" class="text-center mx-auto" width="100px"/>
                    <img v-else :src="require('@assets/images/customers.png')" class="text-center mx-auto" width="100px"/>
                        <div class="mx-auto cursor-pointer flex justify-around action" style="width: 4rem">
                            <vs-button @click.stop="gotoEdit(item.id)" color="rgb(255,255,255)" text-color="rgb(255,159,67)" size="small" radius icon-pack="feather" icon="icon-edit" class=" shadow"/>
                            <vs-button @click.stop="openDeleteConfirm(item.id)" color="rgb(255,255,255)" text-color="#EA5455" size="small" radius icon-pack="feather" icon="icon-trash-2" class=" shadow"/>
                        </div>
                    <h4 class="text-center">{{item.name || $t('NA')}}</h4>
                    <!-- <h6 class="text-center" v-if="display">{{item.subtitle}}</h6> -->
                    <!-- <div class="flex justify-center my-1">
                        <span class="pr-2">{{item.Refrral}}</span>
                        <span class="code">{{item.code}}</span>
                    </div> -->
                    <div class="flex justify-center mt-2">
                        <span>{{item.mobile}}</span>
                        <span class="px-1"> | </span>
                        <span>{{item.email}}</span>
                    </div>
                    <div class="mt-3 cursor-pointer flex items-cente justify-center" v-if="display == 'pending'">
                        <vs-button color="#6FDD68" size="small" @click="updateStatus(item.id, 1)">{{$i18n.locale == "en" ? "Accept" : "موافقة"}}</vs-button>
                        <vs-button color="danger" size="small" @click="updateStatus(item.id, 0)">{{$i18n.locale == "en" ? "Reject" : "رفض"}}</vs-button>
                    </div>
                </vx-card>
            </div>


            <!-- <vs-pagination :data="customers" :total="10" :max="7" v-model="currentPage" @change="handlePageChange"/> -->
        </div>
        </div>
    </div>
</template>

<script>
import { AgGridVue } from "ag-grid-vue"
import '@sass/vuexy/extraComponents/agGridStyleOverride.scss'
import axios from "@/axios.js"
import moduleCustomerManagement from '@/store/customer-management/moduleCustomerManagement.js'
export default {
    components: {
        AgGridVue,
    },
    props:{
        display:{
            required:false
        },
    },
  data() {
    return {
      ItemToDelete: null,
      currentPage:1
    }
  },
    computed: {
      customers() {
        return this.$store.state.customerManagement.customers
      },
    },
  methods: {
    gotoEdit(id){
      // console.log('customers/edit/' + id)
      this.$router.push({path: 'customers/edit/' + id})
    },
    openDeleteConfirm(id) {
      this.ItemToDelete = id;
       this.$vs.dialog({
         type: 'confirm',
         color: 'danger',
         title: this.$t('Delete'),
         text: 'هل أنت متأكدأنك تريد حذف هذا العميل نهائياً؟',
         accept: this.deleteCustoemr
       })
     },
    deleteCustoemr(){
      this.$store.dispatch("customerManagement/removeCustomer", this.ItemToDelete).catch(err => { console.error(err) })
    },
    updateStatus(id, status){
      this.$store.dispatch("customerManagement/updateCustomer", {id:id, status:status}).catch(err => { console.error(err) })
    },
  },

    created() {
        if(!moduleCustomerManagement.isRegistered) {
            this.$store.registerModule('customerManagement', moduleCustomerManagement)
            moduleCustomerManagement.isRegistered = true
        }
        var link = "customerManagement/fetchCustomers"
        if (this.display == 'pending'){
            // axios.post("/api/customers/list/",{status: [0]} )
            // .then((res) => {
            // console.log( res.data)
            // })
            // .catch((error) => console.log(error))
            this.$store.dispatch(link, {status: [0] ,search:''}).catch(err => { console.error(err) })
        }else if (this.display == 'new_customer'){
            // axios.post("/api/customers/list/",{params:{filter: 'new_customer'}} )
            // .then((res) => {
            // (res.data)
            // })
            // .catch((error) => console.log(error))
            this.$store.dispatch(link, {filter: 'new_customer'}).catch(err => { console.error(err) })
        }else
        this.$store.dispatch(link,{search:''}).catch(err => { console.error(err) })
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
