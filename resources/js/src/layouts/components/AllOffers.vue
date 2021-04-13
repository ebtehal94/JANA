<template>
    <div id="all-offers">
        <div class="vx-row mt-5"> 
            <div v-for="item in offers" class="vx-col w-full sm:w-1/2 lg:w-1/4 mb-base" v-bind:key="item.id">
                <vx-card class="usedOffers shadow">
                    <template slot="no-body">
                        <div class="ml-auto cursor-pointer flex justify-around action" style="width: 4.5rem">
                            <vs-button @click.stop="gotoEdit(item.id)" color="warning" size="small" radius icon-pack="feather" icon="icon-edit"/>
                            <vs-button @click.stop="openDeleteConfirm(item.id)" color="danger" size="small" radius icon-pack="feather" icon="icon-trash-2"/>
                        </div>
                        <div class="item-image">
                            <img :src="'/images/offers/'+item.link" class="responsive card-img-top"/>
                        </div>
                        <div class="p-3">
                            <div class="flex justify-between flex-wrap pt-2">
                                <h5>{{item.title_ar}}</h5>
                                <span class="date">{{item.expiry}}</span>
                                <span class="status">{{item.status}}</span>
                            </div>
                            <p>{{item.subtitle}}</p>
                            <div class="flex justify-between">
                                <star-rating :rtl="$vs.rtl" :star-size="12" :rating="3" :read-only="true" :increment="1"></star-rating>
                                <ul>
                                    <li class="price linetThrough"><span>{{item.price_before}} SAR</span></li>
                                    <li class="disc-price"><span>{{item.price}} SAR</span></li>
                                </ul>
                                <span class="discount">{{item.discount_perc}}</span>
                            </div>
                        </div>
                        <div class="-ml-6 cursor-pointer flex justify-center" v-if="display == 'pending'">
                            <vs-button color="#6FDD68" size="small" @click="updateStatus(item.id, 1)">موافقة</vs-button>
                            <vs-button color="danger" size="small" @click="updateStatus(item.id, 0)">رفض</vs-button>
                        </div>
                    </template>
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>
import moduleOfferManagement from '@/store/offer-management/moduleOfferManagement.js'
import StarRating from 'vue-star-rating'
export default {
    components: {
        StarRating
    },
    props:{
        display:{
            type: String
        }
    },
    data() {
        return {
            // AllOffers:[
            //     {"id":1,src:require('@assets/images/image-1.png'),"title":"أدوات منزلية","status":"نشط",
            //     "date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"350","disc_price":"297","discount":"15%"},
            //     {"id":2,src:require('@assets/images/image-2.png'),"title":"أدوات منزلية","status":"نشط",
            //     "date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"350","disc_price":"297","discount":"15%"},
            //     {"id":3,src:require('@assets/images/image-3.png'),"title":"أدوات منزلية",
            //     "status":"نشط","date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"350","disc_price":"297","discount":"15%"},
            //     {"id":4,src:require('@assets/images/image-4.png'),"title":"أدوات منزلية",
            //     "status":"نشط","date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"350","disc_price":"297","discount":"15%"},
            //      {"id":5,src:require('@assets/images/image-4.png'),"title":"أدوات منزلية","status":"نشط",
            //     "date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"350","disc_price":"297","discount":"15%"},
            //     {"id":6,src:require('@assets/images/image-3.png'),"title":"أدوات منزلية","status":"نشط",
            //     "date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"350","disc_price":"297","discount":"15%"},
            //     {"id":7,src:require('@assets/images/image-2.png'),"title":"أدوات منزلية",
            //     "status":"نشط","date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"350","disc_price":"297","discount":"15%"},
            //     {"id":8,src:require('@assets/images/image-1.png'),"title":"أدوات منزلية",
            //     "status":"نشط","date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"350","disc_price":"297","discount":"15%"},
            // ],
            ItemToDelete: null,
        }
    },
    computed: {
        offers() {
            return this.$store.state.offerManagement.offers
        },
    },
    methods: {
        gotoEdit(id){
        this.$router.push({path: 'offers/edit/' + id})
        },
        openDeleteConfirm(id) {
            this.ItemToDelete = id;
            this.$vs.dialog({
                type: 'confirm',
                color: 'danger',
                title: this.$t('Delete'),
                text: 'هل أنت متأكد أنك تريد حذف هذا العرض نهائياً؟',
                accept: this.deleteOffer
            })
        },
        deleteOffer(){
         this.$store.dispatch("offerManagement/removeOffer", this.ItemToDelete).catch(err => { console.error(err) })
        },
        updateStatus(id, status){
            this.$store.dispatch("offerManagement/updateOffer", {id:id, status:status}).catch(err => { console.error(err) })
        }
    },
    created() {
        if(!moduleOfferManagement.isRegistered) {
            this.$store.registerModule('offerManagement', moduleOfferManagement)
            moduleOfferManagement.isRegistered = true
        }
        var link = "offerManagement/fetchOffers"
        if (this.display == 'pending'){
            this.$store.dispatch(link, {status: [0]}).catch(err => { console.error(err) })
        }else if (this.display == 'active'){
            this.$store.dispatch(link, {status: [1]}).catch(err => { console.error(err) })
        }else if (this.display == 'most_used'){
            this.$store.dispatch(link, {filter: 'most_used'}).catch(err => { console.error(err) })
        }else
        this.$store.dispatch(link).catch(err => { console.error(err) })
    },

}
</script>

<style lang="scss" scoped>
#all-offers{
    .usedOffers{
        .action{
            position: absolute;
            top:10px;
            right: 2px;     
        }
        h5{
            font-size: .7rem;
            color: #5E5E5E;
        }
        .status{
            background: #47DC51;
            font-weight: 600;
            font-size: .6rem;
            color: #fff;
            padding: 1px 12px;
            border-radius: 20px;
        }
        .date{
            font-size: 9px;
            padding-left: 10px;
            color: #ACACAC;

        }
        p{
            font-size:.7rem ;
            padding:8px 0;
            color: #ACACAC;
        }
        ul{
            padding-right: 4px;
            padding-top: 6px;
        
            .price{
                font-size: .4rem;
                color: #ACACAC;
            }
            .disc-price{
                font-size: .5rem; 
            }
            .linetThrough{
                text-decoration: line-through;
                text-decoration-color: red;
            }
        }
        .discount{
            color: #F91D1D;
            font-weight: bold;
            font-size: 1.5rem;
        }
        .vs-button.small:not(.includeIconOnly) {
            padding: .2rem .9rem;
            border-radius: 30px;
            margin-bottom: -7px;
            margin-left: .5rem;
        }
        .vs-button.small{
            font-size: .6rem;
            font-weight: bold;
        }
    }
}
</style>