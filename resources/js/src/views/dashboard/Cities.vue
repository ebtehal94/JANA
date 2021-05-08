<template>
    <div id="locations">
        <div class="vx-row">
            <div class="vx-col w-full">
                <vs-table max-items="10" pagination :data="cities">
                    <template slot-scope="{data}">
                        <tbody>
                            <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                                <vs-td>
                                    <p class="name font-bold">{{ data[indextr].name_ar }}</p>
                                </vs-td>

                                <vs-td>
                                    <span class="">|</span>
                                </vs-td>

                                <vs-td>
                                    <p class="text-right">{{ data[indextr].stores}} {{$i18n.locale == "en" ? "Store" : "متجر"}}</p>
                                </vs-td>

                                <vs-td>
                                    <p class="text-right">{{ data[indextr].customers}} {{$i18n.locale == "en" ? "Customer" : "عميلة"}}</p>
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
    props:{

    },
    data() {
        return {
            cities: [],

        }
    },

    methods: {
        
    },
   created() {
        axios.get('/api/statistics/offersByCity')
        .then((res) => {
            console.log(res.data)
        this.cities = res.data.cities
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
