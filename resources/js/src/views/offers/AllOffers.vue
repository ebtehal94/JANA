<template>
    <div id="all-offers">
        <div class="vx-row mt-5">
            <div v-for="item in offers" class="flex flex-col flex-wrap vx-col w-full sm:w-1/2 lg:w-1/4 mb-base" v-bind:key="item.id">
                <vx-card class="offers shadow flex-1">
                    <template slot="no-body">
                        <div class="ml-auto cursor-pointer flex justify-around action" style="width: 4.5rem">
                            <vs-button @click.stop="gotoEdit(item.id)" color="warning" size="small" radius icon-pack="feather" icon="icon-edit"/>
                            <vs-button @click.stop="openDeleteConfirm(item.id)" color="danger" size="small" radius icon-pack="feather" icon="icon-trash-2"/>
                        </div>
                        <div class="item-image">
                            <img v-if="item.images[0]" :src="imgLink + item.images[0].link "  class="responsive card-img-top"/>
                            <img v-else :src="require('@assets/images/offer.png')" class="text-center mx-auto card-img-top" width="150px"/>
                        </div>
                        <div class="p-3">
                            <div class="flex justify-between flex-wrap pt-2">
                                <h5>{{ $i18n.locale == 'en' ? item.title_en : item.title_ar }}</h5>
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
                            <vs-button color="#6FDD68" size="small" @click="updateStatus(item.id, 1)">{{$i18n.locale == "en" ? "Accept" : "موافقة"}}</vs-button>
                            <vs-button color="danger" size="small" @click="updateStatus(item.id, 0)">{{$i18n.locale == "en" ? "Reject" : "رفض"}}</vs-button>
                        </div>
                    </template>
                </vx-card>
            </div>
        </div>
        <div class="vx-row">
            <div class="vx-col">
                <export-excel
                :data = "offers"
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
import moduleOfferManagement from '@/store/offer-management/moduleOfferManagement.js'
import StarRating from 'vue-star-rating'

export default {
    components: {
        StarRating,
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
            ItemToDelete: null,
            imgLink: 'https://janacard.s3.eu-central-1.amazonaws.com/offers/',

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
                accept: this.deleteOffer(id),
                acceptText: "Delete"
            })
        },
        deleteOffer(id){
         this.$store.dispatch("offerManagement/removeOffer", id).catch(err => { console.error(err) })
        },
        updateStatus(id, status){
            this.$store.dispatch("offerManagement/updateOffer", {id, status})
            .then(()   => { this.showUpdateSuccess() })
            .then(()  => {
            this.$store.dispatch("offerManagement/fetchOffers", {status: [0]})
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
        if(!moduleOfferManagement.isRegistered) {
            this.$store.registerModule('offerManagement', moduleOfferManagement)
            moduleOfferManagement.isRegistered = true
        }
        var link = "offerManagement/fetchOffers"

        if (this.display == 'pending'){
            this.$store.dispatch(link, {status: [0],search: this.search,from: this.fromDate, to: this.toDate}).catch(err => { console.error(err) })
        }else if (this.display == 'active'){
            this.$store.dispatch(link, {status: [1],search: this.search,from: this.fromDate, to: this.toDate}).catch(err => { console.error(err) })
        }
        // }else if (this.display == 'most_used'){
        //     this.$store.dispatch(link, {filter: 'most_used'}).catch(err => { console.error(err) })
        // }
        else
            this.$store.dispatch(link,{search: this.search, from: this.fromDate, to: this.toDate}).catch(err => { console.error(err) })
    },

}
</script>

<style lang="scss" scoped>
#all-offers{
    .offers{
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
        .export{
            margin-left: 85%;
        }
    }
}
</style>
