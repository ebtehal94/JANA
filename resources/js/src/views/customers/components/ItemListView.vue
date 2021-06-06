<!-- =========================================================================================
    File Name: ItemListView.vue
    Description: Item Component - List VIew
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
    <div id="all-customers">
        <div class="mt-5">
            <vs-table ref="table" pagination  :data="customers">
                <template slot-scope="{data}">
                    <tbody>
                        <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                            <vs-td class="img-container">
                                <img v-if="display == 'pending'" :src="require('@assets/images/accounts.png')" class="text-center mx-auto" width="100px" />
                                <img v-else :src="require('@assets/images/customers.png')" class="text-center mx-auto" width="100px"/>
                            </vs-td>

                            <vs-td>
                                <h4 class="font-bold">{{ tr.name || $t('NA')}}</h4>
                            </vs-td>

                            <vs-td>
                                <div class="flex justify-center mt-2">
                                    <span>{{tr.mobile}}</span>
                                    <span class="px-1"> | </span>
                                    <span>{{tr.email}}</span>
                                </div>
                            </vs-td>

                            <vs-td>
                                <div class="mt-3 cursor-pointer flex items-cente justify-center" v-if="display == 'pending'">
                                    <vs-button color="#6FDD68" size="small" @click="updateStatus(tr.id, 1)">{{$i18n.locale == "en" ? "Accept" : "موافقة"}}</vs-button>
                                    <vs-button color="danger" size="small" @click="updateStatus(tr.id, 0)">{{$i18n.locale == "en" ? "Reject" : "رفض"}}</vs-button>
                                </div>
                            </vs-td>

                            <vs-td class="whitespace-no-wrap">
                                <div class="mx-auto cursor-pointer flex justify-around action" style="width: 5rem">
                                    <vs-button @click.stop="gotoEdit(tr.id)" color="rgb(255,255,255)" text-color="rgb(255,159,67)" size="small" radius icon-pack="feather" icon="icon-edit" class=" shadow"/>
                                    <vs-button @click.stop="openDeleteConfirm(tr.id)" color="rgb(255,255,255)" text-color="#EA5455" size="small" radius icon-pack="feather" icon="icon-trash-2" class=" shadow"/>
                                </div>
                            </vs-td>

                        </vs-tr>
                    </tbody>
                </template>
             </vs-table>     
        </div>
    </div>
</template>

<script>
export default{
  props: {
    customers: {
      type: Array,
    },
    display:{
        required:false
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
      this.$store.dispatch("customerManagement/removeCustomer", this.ItemToDelete)
        .then(()   => { this.showDeleteSuccess() })
        .catch(err => { console.error(err) })
    },
    showDeleteSuccess() {
            this.$vs.notify({
            color: 'success',
            title: 'Successfull',
            text: 'تم بنجاح'
        })
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

  }
}
</script>

<style lang="scss" scoped>
#all-customers{
        h4{
            font-size: .9rem;
        }
        span{
            font-size: .9rem;
            color: #ACACAC;
        }
        .vs-button.small:not(.includeIconOnly) {
            border-radius: 30px;
            margin-left: .5rem;
        }
        .vs-button.small{
            font-size: .6rem;
            font-weight: bold;
        }
        .vs-con-table {
            .vs-table {
            border-collapse: separate;
            border-spacing: 0 1.3rem;
            padding: 0 1rem;
                tr{
                    box-shadow: 0 4px 20px 0 rgba(0,0,0,.05);
                    td{
                        padding: 10px;
                        
                    }
                    td.td-check{
                        padding: 20px !important;
                    }
                }
            }
        }
}
</style>
