<template>
    <div id="app-control">
         <vx-card class="mt-8 app-info">
            <div slot="no-body" class="tabs-container md:px-6 pt-6 md:pb-4">
                <div class="vx-row">
                    <div class="vx-col w-full">
                        <!-- Col Header -->
                        <div class="flex items-end">
                            <span class="leading-none font-semibold text-sm">صور السلايدر</span>
                        </div>

                        <!-- Col Content -->
                         <div class="vx-row flex mt-4 mx-0 slider-img">
                            <div class="vx-col w-full md:w-1/4 add-img ">

                            </div>
                            <div class="vx-col w-full md:w-1/4">
                                <img src="@assets/images/payment-methods.png" alt="Slider" class="w-full">
                            </div>
                            <div class="vx-col w-full md:w-1/4">
                                <img src="@assets/images/card.png" alt="Slider" class="w-full">
                            </div>
                            <div class="vx-col w-full md:w-1/4">
                                <img src="@assets/images/card.png" alt="Slider" class="w-full">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="vx-row mt-8">
                    <div class="vx-col w-full md:w-1/2">
                        <!-- Col Header -->
                        <div class="flex items-end">
                            <span class="leading-none font-semibold text-sm">الشروط والأحكام</span>
                        </div>
                        <div class="mt-4">
                            <vs-textarea 
                            placeholder="الوصف"
                            v-model="desc_ar" 
                            class="mt-2" 
                            name="desc_ar"/>
                        </div>
                    </div>
                    <div class="vx-col w-full md:w-1/2">
                        <div class="flex items-end">
                            <span class="leading-none font-semibold text-sm">عن التطبيق</span>
                        </div>
                        <div class="mt-4">
                            <vs-textarea 
                            placeholder="الوصف"
                            v-model="desc_ar" 
                            class="mt-2 w-full px-8" 
                            name="desc_ar"/>
                        </div>
                    </div>
                </div>
            </div>
        </vx-card>
    </div>
</template>

<script>

export default {
    components: {
        
    },

    data() {
        return {
            desc_ar:''
        }
    }
}
</script>

<style lang="scss" scoped>
#app-control{
    margin: 2rem 2.5rem;
    .app-info {
        padding: 2.5rem;
    }
    .vx-card{
        box-shadow: none;
    }
    .vx-row{
        margin: 0;
    }
    .vx-row > .vx-col {
        padding: 0 .6rem;
    }
    .slider-img{
        img{
            width: 100%;
        }
    }
    .add-img{
      border: 1px solid #b1b1b1;
      border-radius: 15px;
    }
    .vs-con-textarea{
        border-radius: 12px;
        height: 120px;
        .vs-textarea{
            height: 100%;
        }
    }
    
}  
</style>