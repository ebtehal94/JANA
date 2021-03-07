<!-- =========================================================================================
    File Name: DashboardEcommerce.vue
    Description: Dashboard - Ecommerce
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
    <div id="customers">
        <div class="vx-row my-2 justify-between">
            <div class="vx-col search-page__search-bar flex">
                <vs-input icon-no-border placeholder="اكتب كلمة للبحث" v-model="searchQuery" class="w-full input-rounded-full" icon="icon-search" icon-pack="feather" />
            </div>
            <div class="vx-col cursor-pointer flex">
                <vs-button
                    class="w-full rounded-full font-simebold"
                    color="rgb(255, 255, 255)"
                    text-color="#DC6059"
                    icon-after vs-icon-after="true"
                    icon-pack="feather"
                    icon="plus"
                    @click="addNewData">
                    {{ $t('AddNew') }}
                </vs-button>
          </div>
        </div>
        
        <div class="vx-row">
            <div class="vx-col w-full">
                <vx-card class="mt-8 pt-0">
                    <vs-tabs>
                        <vs-tab label="كل العملاء">
                            <AllCustomers/>
                        </vs-tab>
                        <vs-tab label="الحسابات المعلقة">
                            <AllOffers />
                        </vs-tab>
                        <vs-tab label="عملاء جدد استخدموا كود الإحالات">
                        </vs-tab>
                    </vs-tabs>
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "@/axios.js"
import StarRating from 'vue-star-rating'
import AllCustomers from '@/layouts/components/AllCustomers.vue'
export default{
    components: {
        StarRating,
        AllCustomers,
    },
    props:[
       //display
    ],
    data() {
        return {
            searchQuery: '',
            usedOffers:[],
            
        }
    },
    computed: {

    },
    methods: {

    },
    created() {

    }
}
</script>

<style lang="scss" scoped>
#customers {
    margin: 0 3rem 3rem 3rem;
    .vx-card{
        box-shadow: none;
    }
    .vx-row{
        margin: 0;
    }
    .vx-row > .vx-col {
        padding: 0 .6rem;
    }
    .vs-input--placeholder {
        font-size: small;
        color: #ACACAC;
        font-weight: 400;
        padding-right: 3rem !important;
    }
    .vs-button{
        box-shadow: none;
    }
    .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large) {
        padding: 0 2rem;
        box-shadow: none;
    }
}
</style>
