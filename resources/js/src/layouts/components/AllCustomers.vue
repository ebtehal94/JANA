<template>
    <div id="supplier-offers">
        <div class="vx-row mt-5"> 
            <div v-for="item in supplierOffers" class="vx-col w-full sm:w-1/2 lg:w-1/4 mb-base px-2.5" v-bind:key="item.id">
                <vx-card class="offer shadow">
                    <img :src="item.src" class="text-center mx-auto" width="100px"/>
                        <div class="ml-auto cursor-pointer flex justify-around action" style="width: 4rem">
                            <vs-button @click.stop="" color="rgb(255,255,255)" text-color="rgb(255,159,67)" size="small" radius icon-pack="feather" icon="icon-edit"/>
                            <vs-button @click.stop="" color="rgb(255,255,255)" text-color="#EA5455" size="small" radius icon-pack="feather" icon="icon-trash-2"/>
                        </div>
                    <h4 class="text-center">{{item.name}}</h4>
                    <h6>{{item.subtitle}}</h6>
                    <div class="flex justify-between">
                        <span>{{item.phone}}</span>
                        <span> | </span>
                        <span>{{item.Email}}</span>
                    </div>
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
                {"id":1,"name":"عميلة بطاقات جنا","subtitle":"مرحبا بك ,كيف نستطيع خدمتك",src:require('@assets/images/customers.png'),"phone":"0512345678","Email":"jana@jana.com"},
                {"id":2,"name":"عميلة بطاقات جنا","subtitle":"مرحبا بك ,كيف نستطيع خدمتك",src:require('@assets/images/customers.png'),"phone":"0512345678","Email":"jana@jana.com"},
                {"id":3,"name":"عميلة بطاقات جنا","subtitle":"مرحبا بك ,كيف نستطيع خدمتك",src:require('@assets/images/customers.png'),"phone":"0512345678","Email":"jana@jana.com"},
                {"id":4,"name":"عميلة بطاقات جنا","subtitle":"مرحبا بك ,كيف نستطيع خدمتك",src:require('@assets/images/customers.png'),"phone":"0512345678","Email":"jana@jana.com"},
                {"id":5,"name":"عميلة بطاقات جنا","subtitle":"مرحبا بك ,كيف نستطيع خدمتك",src:require('@assets/images/customers.png'),"phone":"0512345678","Email":"jana@jana.com"},
                {"id":6,"name":"عميلة بطاقات جنا","subtitle":"مرحبا بك ,كيف نستطيع خدمتك",src:require('@assets/images/customers.png'),"phone":"0512345678","Email":"jana@jana.com"},
                {"id":7,"name":"عميلة بطاقات جنا","subtitle":"مرحبا بك ,كيف نستطيع خدمتك",src:require('@assets/images/customers.png'),"phone":"0512345678","Email":"jana@jana.com"},
                {"id":8,"name":"عميلة بطاقات جنا","subtitle":"مرحبا بك ,كيف نستطيع خدمتك",src:require('@assets/images/customers.png'),"phone":"0512345678","Email":"jana@jana.com"},
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
            padding-top: 1rem;
        }
        h6{
            font-size:.6rem ;
            padding:8px 0;
            color: #ACACAC;
            text-align: center;
        }
        span{
            font-size: .6rem;
            color: #ACACAC;
        }
    }
}  
</style>