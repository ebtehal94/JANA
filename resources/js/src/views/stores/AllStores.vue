<template>
    <div id="all-store">
        <div class="vx-row mt-5">
            <div v-for="item in stores" class="vx-col w-full sm:w-1/2 lg:w-1/4 mb-base px-2.5" v-bind:key="item.id">
                <vx-card class="store shadow text-center">
                    <img v-if="item.image" :src="imgLink + item.image" alt="" class="text-center mx-auto" width="100px"/>
                    <img v-else :src="require('@assets/images/store.png')" class="text-center mx-auto" width="100px"/>
                        <div class="mx-auto -mt-4 cursor-pointer flex justify-around action" style="width: 4rem">
                            <vs-button @click.stop="gotoEdit(item.id)" color="rgb(255,255,255)" text-color="rgb(255,159,67)" size="small" radius icon-pack="feather" icon="icon-edit" class=" shadow"/>
                            <vs-button @click.stop="openDeleteConfirm(item.id)" color="rgb(255,255,255)" text-color="#EA5455" size="small" radius icon-pack="feather" icon="icon-trash-2" class=" shadow"/>
                        </div>
                    <h4 class="text-center">{{ $i18n.locale == 'en' ? (item.name_en || $t('NA')) : (item.name_ar  || $t('NA'))}}</h4>
                    <!-- <div class="flex justify-between">
                        <span>{{item.phone}}</span>
                        <span> | </span>
                        <span>{{item.Email}}</span>
                    </div> -->
                    <!-- <p class="text-center">{{item.location}}</p>
                    <h6 class="text-center">{{item.number}}</h6>-->
                </vx-card>
            </div>
        </div>
        <div class="vx-row">
            <div class="vx-col">
                <export-excel
                :data = "stores"
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
import moduleStoreManagement from '@/store/store-management/moduleStoreManagement.js'
export default {
    components: {

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
            ItemToDelete:null
        }
    },
    computed: {
        stores() {
            return this.$store.state.storeManagement.stores
        },
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
    },
    created() {
     if(!moduleStoreManagement.isRegistered) {
        this.$store.registerModule('storeManagement', moduleStoreManagement)
        moduleStoreManagement.isRegistered = true
      }
        this.$store.dispatch("storeManagement/fetchStores",{search:this.query}).catch(err => { console.error(err) })
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
        h6{
            font-size: .6rem;
            color: #F91D1D;
            padding-top: .4rem;
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
