<template>
    <div id="inqueries">
        <h3>Messeges</h3>
        <vs-table class="mt-5" max-items="15" pagination :data="questions">
            <template slot="thead">
                <vs-th>{{ $i18n.locale == 'en' ? 'Name' : 'الإسم' }}</vs-th>
                <vs-th>{{ $i18n.locale == 'en' ? 'Subject' : 'الموضوع' }}</vs-th>
                <vs-th>{{ $i18n.locale == 'en' ? 'Status' : 'الحالة' }}</vs-th>
                <vs-th>{{ $i18n.locale == 'en' ? 'Action' : 'إدارة' }}</vs-th>
            </template>
            <template slot-scope="{data}">
                <vs-tr :key="indextr" v-for="(tr, indextr) in data" >
                <vs-td :data="data[indextr].name">
                    {{ data[indextr].name }}
                </vs-td>

                <vs-td :data="data[indextr].subject">
                    {{ data[indextr].subject }}
                </vs-td>

                <vs-td :data="data[indextr].status">
                    <vs-chip transparent class="ag-grid-cell-chip" :color="statusOptions[data[indextr].status].color">
                    {{ $i18n.locale == 'en' ? statusOptions[data[indextr].status].label.en : statusOptions[data[indextr].status].label.ar }}
                    </vs-chip>
                </vs-td>

                <vs-td :data="data[indextr].id">
                    <feather-icon v-if="data[indextr].status == 1" icon="EyeIcon" svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer" @click="showResponse(data[indextr])" />
                    <p v-else>Pending admin's answer</p>
                </vs-td>
                </vs-tr>
            </template>
        </vs-table>

        <!-- Modal -->
        <div class="modal-vue">
            <div class="overlay" v-if="showModal" @click="showModal = false"></div>
            <div class="modal" v-if="showModal">
                <h3>{{ modalInfo.subject }}</h3>
                <h6>{{ modalInfo.updated_at }}</h6>
                <p>{{ modalInfo.response }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "@/axios.js"

export default {
    data() {
        return {
            questions: [],
            statusOptions: [
                { label: { en: 'Not Answered', ar: 'لم يتم الرد' }, color:'warning', value: 0 },
                { label: { en: 'Answered', ar: 'تم الرد' }, color:'#24c1a0', value: 1 },
            ],
            showModal: false,
            modalInfo: {},
        }
    },
    computed: {
        activeUserInfo () {
            return this.$store.state.AppActiveUser
        }
    },
    methods: {
        showResponse(data) {
            this.showModal = true
            this.modalInfo = data
        }
    },
    created() {
        const questions = new Promise((resolve, reject) => {
            axios.get("/api/questions/list")
            .then((response) => {
                resolve(response)
            })
            .catch((error) => { console.log(error.response) })
        }).then(res => this.questions = res.data.filter(q => q.user_id == this.activeUserInfo.id))
        .catch(err => connsole.log(err))
    },
}
</script>

<style lang="scss">
#inqueries {
    margin: 5rem;

    .modal-vue .overlay {
        position: fixed;
        z-index: 100000;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
    }

    .modal-vue .modal {
        position: relative;
        width: 50rem;
        z-index: 100001;
        margin: 0 auto;
        padding: 20px 30px;
        background-color: #fff;
    }

    .modal-vue .close{
        position: absolute;
        top: 10px;
        right: 10px;
    }
}
</style>