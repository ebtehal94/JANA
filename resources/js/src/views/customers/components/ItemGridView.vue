<!-- =========================================================================================
  File Name: ItemGridView.vue
  Description: Item Component - Grid VIew
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
    <div id="all-customers">
        <div class="vx-row mt-5">
            <div v-for="item in customers" class="flex flex-col flex-wrap vx-col w-full sm:w-1/2 lg:w-1/4 mb-base px-2.5" :key="item.id">
                <vx-card class="customers shadow flex-1">
                    <img v-if="display == 'pending'" :src="require('@assets/images/accounts.png')" class="text-center mx-auto" width="100px"/>
                    <img v-else :src="require('@assets/images/customers.png')" class="text-center mx-auto" width="100px"/>
                        <div class="mx-auto cursor-pointer flex justify-around action" style="width: 4rem">
                            <vs-button @click.stop="gotoEdit(item.id)" color="rgb(255,255,255)" text-color="rgb(255,159,67)" size="small" radius icon-pack="feather" icon="icon-edit" class=" shadow"/>
                            <vs-button @click.stop="openDeleteConfirm(item.id)" color="rgb(255,255,255)" text-color="#EA5455" size="small" radius icon-pack="feather" icon="icon-trash-2" class=" shadow"/>
                        </div>
                    <h4 class="text-center font-bold">{{item.name || $t('NA')}}</h4>
                    <div class="flex justify-center mt-2">
                        <span>{{item.mobile}}</span>
                        <span class="px-1"> | </span>
                        <span>{{item.email}}</span>
                    </div>
                    <div class="mt-3 cursor-pointer flex items-cente justify-center" v-if="display == 'pending'">
                        <vs-button color="#6FDD68" size="small" @click="updateStatus(item.id, 1)">{{$i18n.locale == "en" ? "Accept" : "موافقة"}}</vs-button>
                        <vs-button color="danger" size="small" @click="updateStatus(item.id, 2)">{{$i18n.locale == "en" ? "Reject" : "رفض"}}</vs-button>
                    </div>
                </vx-card>
            </div>      
        </div>
    </div>

</template>

<script>
export default{
  props: {
    customers: {
      type: Array
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
            font-size: .9rem;
            padding-top: 1rem;
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
