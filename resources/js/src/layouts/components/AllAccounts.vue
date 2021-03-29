<template>
    <div id="all-admins">
        <div class="vx-row mt-5"> 
            <div v-for="item in accounts" class="vx-col w-full sm:w-1/2 lg:w-1/4 mb-base px-2.5" v-bind:key="item.id">
                <vx-card class="account shadow">
                    <img :src="item.src" class="text-center mx-auto" width="100px"/>
                        <div class="ml-auto cursor-pointer flex justify-around action" style="width: 4rem">
                            <vs-button @click="EditNewData" color="rgb(255,255,255)" text-color="rgb(255,159,67)" size="small" radius icon-pack="feather" icon="icon-edit" class=" shadow"/>
                            <vs-button @click.stop="" color="rgb(255,255,255)" text-color="#EA5455" size="small" radius icon-pack="feather" icon="icon-trash-2" class=" shadow"/>
                        </div>
                    <h4 class="text-center">{{item.name}}</h4>
                    <div class="flex justify-between">
                        <span>{{item.phone}}</span>
                        <span> | </span>
                        <span>{{item.Email}}</span>
                    </div>
                    <h6 class="text-center">{{item.title}}</h6>
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>

export default {
        props:{
            accounts:{
                type: Array
            },
        },
        data() {
        return {

        }
        
    },
    computed: {

    },
    methods: {
         EditNewData() {
        this.$router.push({path: '/AdminEdit'})
        },
    },
}
</script>

<style lang="scss" scoped>
#all-admins{
    .account{
        margin-top: 2.5rem;
        img{
            margin-top: -4rem;
        }
        .action{
            position: absolute;
            top:3rem;
            right: 4rem;     
        }
        h4{
            font-size: .8rem;
            font-weight: bold;
            padding: 1rem 0 .5rem;
        }
        h6{
            font-size:.6rem ;
            padding-top:4px;
            color: #ACACAC;
        }
        span{
            font-size: .6rem;
            color: #ACACAC;
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