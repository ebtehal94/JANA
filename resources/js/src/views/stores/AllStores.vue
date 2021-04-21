<template>
    <div id="all-store">
        <div class="vx-row mt-5">
            <div v-for="item in stores" class="vx-col w-full sm:w-1/2 lg:w-1/4 mb-base px-2.5" v-bind:key="item.id">
                <vx-card class="store shadow text-center">
                    <img v-if="item.image" :src="imgLink + item.image" alt="" class="text-center mx-auto" width="100px"/>
                        <div class="mx-auto -mt-4 cursor-pointer flex justify-around action" style="width: 4rem">
                            <vs-button @click.stop="gotoEdit(item.id)" color="rgb(255,255,255)" text-color="rgb(255,159,67)" size="small" radius icon-pack="feather" icon="icon-edit" class=" shadow"/>
                            <vs-button @click.stop="openDeleteConfirm(item.id)" color="rgb(255,255,255)" text-color="#EA5455" size="small" radius icon-pack="feather" icon="icon-trash-2" class=" shadow"/>
                        </div>
                    <h4 class="text-center">{{ $i18n.locale == 'en' ? (item.name_en || $t('NA')) : (item.name_ar  || $t('NA'))}}</h4>
                    <!-- <h4 class="text-center">{{item.name_en || $t('NA')}}</h4> -->
                    <!-- <div class="flex justify-between">
                        <span>{{item.phone}}</span>
                        <span> | </span>
                        <span>{{item.Email}}</span>
                    </div> -->
                    <!-- <p class="text-center">{{item.location}}</p>
                    <h6 class="text-center" v-if="!display">{{item.number}}</h6>
                    <div class="ml-auto mt-4 cursor-pointer flex justify-center" v-if="display == 'pending'">
                        <vs-button color="#6FDD68" size="small">موافقة</vs-button>
                        <vs-button color="danger" size="small">رفض</vs-button>
                    </div> -->
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    components: {

    },
    props:{
        display:{
            required: false
        },
        stores:{
            type: Array
        }

    },
    data() {
        return {
            imgLink: 'https://otantik-home.s3.me-south-1.amazonaws.com/stores/',
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
        this.$store.dispatch("storeManagement/removeStore", this.ItemToDelete).catch(err => { console.error(err) })
        },
  }
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
