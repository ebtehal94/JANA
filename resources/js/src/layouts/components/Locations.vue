<template>
    <div id="locations">
        <div class="vx-row">
            <div class="vx-col w-full">
                <vs-table :data="locations">
                    <template slot-scope="{data}">
                        <tbody>
                            <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                <vs-td>
                                    <p class="name font-bold">{{ data[indextr].username }}</p>
                                </vs-td>

                                <vs-td>
                                    <span class="">|</span>
                                </vs-td>

                                <vs-td>
                                    <p class="text-right">{{ data[indextr].name }}</p>
                                </vs-td>

                                <vs-td>
                                    <p class="text-right">{{ data[indextr].customer}}</p>
                                </vs-td>
                            </vs-tr>
                        </tbody>
                    </template>
                </vs-table>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "@/axios.js"
export default{

    components: {

    },
    props:{
        offers:{
            type: Array
        }
    },
    data() {
        return {
            locations: [
                {"id": 1,"name": "14 متجر","username": "منطقة الرياض","customer": "450 عميلة"},
                {"id": 2,"name": "14 متجر","username": "منطقة الرياض","customer": "450 عميلة"},
                {"id": 3,"name": "14 متجر","username": "منطقة الرياض","customer": "450 عميلة"},
                {"id": 4,"name": "14 متجر","username": "منطقة الرياض","customer": "450 عميلة"},
                {"id": 5,"name": "14 متجر","username": "منطقة الرياض","customer": "450 عميلة"}
            ],
        }
    },
    computed: {
 
    },
    methods: {

    },
    created() {
            axios.get('/api/locations/list')
            .then((res) => {
           // this.locations = res.data.locations
            })
            .catch((error) => console.log(error))
    }
}
</script>

<style lang="scss" scoped>
#locations {
    .vx-card{
        box-shadow: none;
    }
    .vx-row{
        margin: 0;
    }
    .vx-row > .vx-col {
        padding: 0 .6rem;
    }

    .vs-table--tbody-table tr {
        border-bottom: 1.5px solid #eee;
    }
    .vs-con-table td {
        font-size: .8rem;
        color:#ACACAC
    }
}
</style>
