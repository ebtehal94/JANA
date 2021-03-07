<template>
    <div id="all-offers">
        <div class="vx-row mt-5"> 
            <div v-for="item in usedOffers" class="vx-col w-full sm:w-1/2 lg:w-1/4 mb-base" v-bind:key="item.id">
                <vx-card class="usedOffers shadow">
                    <template slot="no-body">
                        <div class="ml-auto cursor-pointer flex justify-around action" style="width: 4.5rem">
                            <vs-button @click.stop="" color="warning" size="small" radius icon-pack="feather" icon="icon-edit"/>
                            <vs-button @click.stop="" color="danger" size="small" radius icon-pack="feather" icon="icon-trash-2"/>
                        </div>
                        <div class="item-image">
                            <img :src="item.src" class="responsive card-img-top"/>
                        </div>
                        <div class="p-3">
                            <div class="flex justify-between flex-wrap pt-2">
                                <h5>{{item.title}}</h5>
                                <span class="date">{{item.date}}</span>
                                <span class="status">{{item.status}}</span>
                            </div>
                            <p>{{item.subtitle}}</p>
                            <div class="flex justify-between">
                                <star-rating :rtl="$vs.rtl" :star-size="12" :rating="3" :read-only="true" :increment="1"></star-rating>
                                <ul>
                                    <li class="price linetThrough"><span>{{item.price}} SAR</span></li>
                                    <li class="disc-price"><span>{{item.disc_price}} SAR</span></li>
                                </ul>
                                <spn class="discount">{{item.discount}}</spn>
                            </div>
                        </div>
                        <div class="ml-auto cursor-pointer flex justify-center" v-if="display">
                            <vs-button color="#6FDD68" size="small">موافقة</vs-button>
                            <vs-button color="danger" size="small">رفض</vs-button>
                        </div>
                    </template>
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>
import StarRating from 'vue-star-rating'
export default {
    components: {
        StarRating
    },
        data() {
        return {
            usedOffers:[
                {"id":1,src:require('@assets/images/image-1.png'),"title":"أدوات منزلية","status":"نشط",
                "date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"350","disc_price":"297","discount":"15%"},
                {"id":2,src:require('@assets/images/image-2.png'),"title":"أدوات منزلية","status":"نشط",
                "date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"350","disc_price":"297","discount":"15%"},
                {"id":3,src:require('@assets/images/image-3.png'),"title":"أدوات منزلية",
                "status":"نشط","date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"350","disc_price":"297","discount":"15%"},
                {"id":4,src:require('@assets/images/image-4.png'),"title":"أدوات منزلية",
                "status":"نشط","date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"350","disc_price":"297","discount":"15%"},
                 {"id":5,src:require('@assets/images/image-4.png'),"title":"أدوات منزلية","status":"نشط",
                "date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"350","disc_price":"297","discount":"15%"},
                {"id":6,src:require('@assets/images/image-3.png'),"title":"أدوات منزلية","status":"نشط",
                "date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"350","disc_price":"297","discount":"15%"},
                {"id":7,src:require('@assets/images/image-2.png'),"title":"أدوات منزلية",
                "status":"نشط","date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"350","disc_price":"297","discount":"15%"},
                {"id":8,src:require('@assets/images/image-1.png'),"title":"أدوات منزلية",
                "status":"نشط","date":"15/04/2021","subtitle":"وصف مختصر وصف مختصر..","price":"350","disc_price":"297","discount":"15%"},
            ],
            disblay:false
        }
    }
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