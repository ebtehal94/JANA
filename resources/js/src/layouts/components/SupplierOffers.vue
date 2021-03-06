<template>
    <div id="supplier-offers">
        <div class="vx-row mt-5"> 
            <div v-for="item in supplierOffers" class="vx-col w-full sm:w-1/2 lg:w-1/5 mb-base px-2.5" v-bind:key="item.id">
                <vx-card class="offer shadow">
                    <img :src="item.src" class="text-center mx-auto" width="80px"/>
                    <h4 class="text-center">{{item.name}}</h4>
                    <span class="block text-center">{{item.number}}</span>
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    components: {
        
    },
        data() {
        return {
            supplierOffers:[
                {"id":1,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-1.png')},
                {"id":2,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-1.png')},
                {"id":3,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-2.png')},
                {"id":4,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-3.png')},
                {"id":5,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-4.png')},
                {"id":6,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-2.png')},
                {"id":7,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-1.png')},
                {"id":8,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-3.png')},
                {"id":9,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-4.png')},
                {"id":10,"name":"اكسترا ستور","number":"27 عرض",src:require('@assets/images/img-2.png')}
            ],
        }
    }
}
</script>

<style lang="scss" scoped>
#supplier-offers{
    .offer{
        margin-top: 2.5rem;
        img{
            margin-top: -3rem;
        }
        h4{
            font-size: .8rem;
            font-weight: bold;
            padding-top: .7rem;
        }
        span{
            font-size: .7rem;
            padding-top: .5rem;
        }
    }
}  
</style>