<!-- =========================================================================================
    File Name: ItemListView.vue
    Description: Item Component - List VIew
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
    <div id="all-store">
        <div class="mt-5">
            <vs-table ref="table" pagination  :data="stores">
                    <template slot-scope="{data}">
                        <tbody>
                            <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                <vs-td class="img-container">
                                    <img v-if="tr.image" :src="imgLink + tr.image" alt="store-image" class="text-center" width="100px"/>
                                    <img v-else :src="require('@assets/images/store.png')" alt="store-image" class="text-center" width="100px"/>
                                </vs-td>

                                <vs-td>
                                <h4 class="font-bold">{{ $i18n.locale == 'en' ? (tr.name_en || $t('NA')) : (tr.name_ar  || $t('NA'))}}</h4>
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
    stores: {
      type: Array,
    },
  },
    data() {
        return {
            imgLink: 'https://janacard.s3.eu-central-1.amazonaws.com/stores/',
            ItemToDelete:null
        }
    },

  methods: {
        gotoEdit(id){
            this.$router.push({path: 'stores/edit/' + id})
        },
        openDeleteConfirm(id) {
            this.ItemToDelete = id;
            this.$vs.dialog({
                type: 'confirm',
                color: 'danger',
                title: this.$t('Delete'),
                text: 'هل أنت متأكدأنك تريد حذف هذا المتجر نهائياً؟',
                accept: this.deleteStore
            })
        },
        deleteStore(){
            this.$store.dispatch("storeManagement/removeStore", this.ItemToDelete)
            .then(()   => { this.showDeleteSuccess() })
            .catch(err => { console.error(err) })
        },
        showDeleteSuccess() {
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
#all-store{
        h4{
            font-size: .9rem;
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
