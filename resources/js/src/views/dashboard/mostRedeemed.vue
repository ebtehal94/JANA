<template>
    <div id="all-offers">
        <div class="vx-row mt-5">
            <div v-for="item in offers" class="flex flex-col flex-wrap vx-col w-full sm:w-1/2 lg:w-1/4 mb-base" v-bind:key="item.id">
                <vx-card class="offers shadow flex-">
                    <template slot="no-body">
                        <div class="item-image">
                            <img v-if="item.main_image" :src="imgLink + item.main_image.link "  class="responsive card-img-top"/>
                            <img v-else :src="require('@assets/images/offer.png')" class="text-center mx-auto"/>
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
                    </template>
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "@/axios.js"
import StarRating from 'vue-star-rating'
export default {
    components: {
        StarRating
    },
    props:{

    },
    data() {
        return {
            offers:[],
            //redeems:[],
            imgLink: 'https://otantik-home.s3.me-south-1.amazonaws.com/offers/',

        }
    },
    computed: {

    },
    methods: {

    },
    created() {
            axios.get('/api/statistics/mostRedeemed')
            .then((res) => {
                this.offers = res.data.offers
            })
            .catch((error) => console.log(error))
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
    }
}
</style>
