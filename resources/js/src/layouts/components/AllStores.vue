<template>
    <div id="all-store">
        <div class="vx-row mt-5"> 
            <div v-for="item in stores" class="vx-col w-full sm:w-1/2 lg:w-1/4 mb-base px-2.5" v-bind:key="item.id">
                <vx-card class="store shadow">
                    <img :src="item.src" class="text-center mx-auto" width="100px"/>
                        <div class="ml-auto cursor-pointer flex justify-around action" style="width: 4rem">
                            <vs-button @click.stop="" color="rgb(255,255,255)" text-color="rgb(255,159,67)" size="small" radius icon-pack="feather" icon="icon-edit" class=" shadow"/>
                            <vs-button @click.stop="" color="rgb(255,255,255)" text-color="#EA5455" size="small" radius icon-pack="feather" icon="icon-trash-2" class=" shadow"/>
                        </div>
                    <h4 class="text-center">{{item.name}}</h4>
                    <div class="flex justify-between">
                        <span>{{item.phone}}</span>
                        <span> | </span>
                        <span>{{item.Email}}</span>
                    </div>
                    <p class="text-center">{{item.location}}</p>
                    <h6 class="text-center">{{item.number}}</h6>
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
        stores:{
            type:Array
        }
    },
    data() {
        return {

        }
    }
}
</script>

<style lang="scss" scoped>
#all-store{
    .store{
        margin-top: 2.5rem;
        img{
            margin-top: -3rem;
        }
        .action{
            position: absolute;
            top:4rem;
            right: 4.2rem;     
        }
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
    }
}  
</style>