<template>
    <div id="all-customers">
        <div >
            <vs-table ref="table" pagination  :data="customers">
                        <template slot-scope="{data}">
                            <tbody>
                            <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">

                                <vs-td class="img-container">
                                    <img v-if="display == 'pending'" :src="require('@assets/images/accounts.png')" class="product-img" />
                                    <img v-else :src="require('@assets/images/customers.png')" class="text-center  mx-auto" width="100px"/>
                                </vs-td>

                                <vs-td>
                                <p class="product-name font-medium truncate">{{ tr.name || $t('NA')}}</p>
                                </vs-td>

                                <vs-td>
                                    <div class="flex justify-center mt-2">
                                        <span>{{tr.mobile}}</span>
                                        <span class="px-1"> | </span>
                                        <span>{{tr.email}}</span>
                                    </div>
                                </vs-td>

                                <vs-td class="whitespace-no-wrap">
                                    <div class="mx-auto cursor-pointer flex justify-around action" style="width: 4rem">
                                            <vs-button @click.stop="gotoEdit(item.id)" color="rgb(255,255,255)" text-color="rgb(255,159,67)" size="small" radius icon-pack="feather" icon="icon-edit" class=" shadow"/>
                                            <vs-button @click.stop="openDeleteConfirm(item.id)" color="rgb(255,255,255)" text-color="#EA5455" size="small" radius icon-pack="feather" icon="icon-trash-2" class=" shadow"/>
                                    </div>
                                </vs-td>

                            </vs-tr>
                            </tbody>
                        </template>
                    </vs-table>


            <!-- <vs-pagination :data="customers" :total="10" :max="7" v-model="currentPage" @change="nextPage"/> -->
        
        </div>
        <div class="vx-row">
            <div class="vx-col">
                <export-excel
                :data = "customers"
                worksheet = "My Worksheet"
                type = "csv"
                name = "filename.xls">
                <vs-button
                    color="linear-gradient(to left,#E93F7D,#DA6653)"
                    gradient>
                    {{ $i18n.locale == 'en' ? 'Export' : 'تصدير' }}
                </vs-button>
                </export-excel>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "@/axios.js"
import moduleCustomerManagement from '@/store/customer-management/moduleCustomerManagement.js'
export default {
    components: {
        
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
      currentPage:1
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
        // getResults(page = 1) {
        //     axios.get('/api/customers/list/?page=' + page)
        //         .then(response => {
        //             this.customers = response.data.customers.data;
        //         });
        // },
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
      this.$store.dispatch("customerManagement/updateCustomer", {id:id, status:status})
        .then(()   => { this.showUpdateSuccess() })
        .then(()  => { this.$store.dispatch("customerManagement/fetchCustomers", {status: [0]})
        })
        .catch(err => { console.error(err.response)})
    },
    showUpdateSuccess() {
            this.$vs.notify({
            color: 'success',
            title: 'Successfull',
            text: 'تم بنجاح'
        })
    }
    
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
        .vs-con-table {

            .product-name {
            max-width: 23rem;
            }

            .vs-table--header {
            display: flex;
            flex-wrap: wrap-reverse;
            margin-left: 1.5rem;
            margin-right: 1.5rem;
            > span {
                display: flex;
                flex-grow: 1;
            }

            .vs-table--search{
                padding-top: 0;

                .vs-table--search-input {
                padding: 0.9rem 2.5rem;
                font-size: 1rem;

                &+i {
                    left: 1rem;
                }

                &:focus+i {
                    left: 1rem;
                }
                }
            }
            }

            .vs-table {
            border-collapse: separate;
            border-spacing: 0 1.3rem;
            padding: 0 1rem;


            tr{
                box-shadow: 0 4px 20px 0 rgba(0,0,0,.05);
                td{
                    padding: 10px;
                    &:first-child{
                    border-top-left-radius: .5rem;
                    border-bottom-left-radius: .5rem;
                    }
                    &:last-child{
                    border-top-right-radius: .5rem;
                    border-bottom-right-radius: .5rem;
                    }
                    &.img-container {
                    // width: 1rem;
                    // background: #fff;

                    span {
                        display: flex;
                        justify-content: flex-start;
                    }

                    .product-img {
                        height: 110px;
                    }
                    }
                }
                td.td-check{
                    padding: 20px !important;
                }
            }
            }

            .vs-table--thead{
            th {
                padding-top: 0;
                padding-bottom: 0;

                .vs-table-text{
                text-transform: uppercase;
                font-weight: 600;
                }
            }
            th.td-check{
                padding: 0 15px !important;
            }
            tr{
                background: none;
                box-shadow: none;
            }
            }

            .vs-table--pagination {
            justify-content: center;
            }
        }
    }
}

</style>
