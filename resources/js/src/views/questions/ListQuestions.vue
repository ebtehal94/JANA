<template>
    <div id="questions-container">
        <vs-table max-items="15" pagination :data="questions" search>
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
                    <vs-button v-if="data[indextr].status == 0" size="small" type="line" color="warning" @click="respond(data[indextr].id)">{{ $i18n.locale == 'en' ? 'Respond' : 'رد' }}</vs-button>
                </vs-td>
                </vs-tr>
            </template>
        </vs-table>
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
        }
    },
    methods: {
        respond(id) {
            this.$router.push({path: '/questions/' + id + '/respond'})
        },
        show() {
            this.getAllQuestions()
        },
        answered() {
            this.getAllQuestions()
            this.questions = this.questions.filter(q => q.status == 1)
        },
        unanswered() {
            this.questions = this.questions.filter(q => q.status == 0)
        },
        getAllQuestions() {
            const questions = new Promise((resolve, reject) => {
                axios.get("/api/questions/list")
                .then((response) => {
                    resolve(response)
                })
                .catch((error) => { console.log(error.response) })
            }).then(res => this.questions = res.data)
            .catch(err => connsole.log(err))
        }
    },
    created() {
        this.getAllQuestions()
    },
}
</script>

<style lang="scss" scoped>
#questions-container {
    margin: 2rem;
}
</style>