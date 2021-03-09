<template>
    <div id="stores">
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
                        <vs-tab label="كل المتاجر">
                            <AllStores :stores="stores" />
                        </vs-tab>
                        <vs-tab label="الحسابات المعلقة">
                            <SuspendedStore :stores="stores"/>
                        </vs-tab>
                    </vs-tabs>
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>
import AllStores from '@/layouts/components/AllStores.vue'
import SuspendedStore from '@/layouts/components/SuspendedStore.vue'
export default {
    components: {
        AllStores,
        SuspendedStore
    },
    data() {
        return {
            searchQuery:'',
            stores:[
                {"id":1,"name":"اكسترا ستور","number":"14 عرض تم استخدامها 18 مرة",src:require('@assets/images/img-1.png'),"phone":"0512345678","Email":"jana@jana.com","location":"الشرقية-شارع الملك عبدالله"},
                {"id":2,"name":"اكسترا ستور","number":"14 عرض تم استخدامها 18 مرة",src:require('@assets/images/img-2.png'),"phone":"0512345678","Email":"jana@jana.com","location":"الشرقية-شارع الملك عبدالله"},
                {"id":3,"name":"اكسترا ستور","number":"14 عرض تم استخدامها 18 مرة",src:require('@assets/images/img-3.png'),"phone":"0512345678","Email":"jana@jana.com","location":"الشرقية-شارع الملك عبدالله"},
                {"id":4,"name":"اكسترا ستور","number":"14 عرض تم استخدامها 18 مرة",src:require('@assets/images/img-4.png'),"phone":"0512345678","Email":"jana@jana.com","location":"الشرقية-شارع الملك عبدالله"},
                {"id":5,"name":"اكسترا ستور","number":"14 عرض تم استخدامها 18 مرة",src:require('@assets/images/img-2.png'),"phone":"0512345678","Email":"jana@jana.com","location":"الشرقية-شارع الملك عبدالله"},
                {"id":6,"name":"اكسترا ستور","number":"14 عرض تم استخدامها 18 مرة",src:require('@assets/images/img-1.png'),"phone":"0512345678","Email":"jana@jana.com","location":"الشرقية-شارع الملك عبدالله"},
                {"id":7,"name":"اكسترا ستور","number":"14 عرض تم استخدامها 18 مرة",src:require('@assets/images/img-3.png'),"phone":"0512345678","Email":"jana@jana.com","location":"الشرقية-شارع الملك عبدالله"},
                {"id":8,"name":"اكسترا ستور","number":"14 عرض تم استخدامها 18 مرة",src:require('@assets/images/img-4.png'),"phone":"0512345678","Email":"jana@jana.com","location":"الشرقية-شارع الملك عبدالله"}
            ],
        }
    },
    computed: {

    },
    methods: {

    },

    created() {

    },
}
</script>

<style lang="scss" scoped>
#stores{
    margin:3rem;
    .vs-con-table .vs-con-tbody{
        padding: 2rem 0;
    }
    th{
        text-align: center;
    
        .vs-table-text{
            justify-content: center;
        }
    }
    .vs-table--tbody-table tr {
        border-bottom: 1.5px solid #eee;
    }
    .vs-con-table td {
        font-size: .8rem;
        color: #acacaa;
    }
    .con-ul-tabs{
        .vs-tabs--ul{
            box-shadow: none;
        }
    }
}
</style>