<template>
    <div id="response-container">
        <vx-card>
            <div class="vx-row">
                <div class="vx-col md:w-1/2 w-full mt-8">
                    
                    <label class="vs-input-label">{{ $t('Name') + ' '}} <span class="text-danger">*</span></label>
                    <vs-input class="w-full mb-4" v-model="question.name" v-validate="'required|alpha_spaces'" name="name" disabled />
                    <span class="text-danger text-sm" v-show="errors.has('name')">{{ errors.first('name') }}</span>

                    <label class="vs-input-label">{{ $t('Subject') + ' '}} <span class="text-danger">*</span></label>
                    <vs-input class="w-full mb-4" v-model="question.subject" v-validate="'required|alpha_spaces'" name="subject" disabled />
                    <span class="text-danger text-sm" v-show="errors.has('subject')">{{ errors.first('subject') }}</span>

                    <label class="vs-input-label d-block">{{ $t('Message') + ' '}} <span class="text-danger">*</span></label>
                    <textarea class="msg" name="message" v-model="question.message" cols="50" rows="10" disabled></textarea>
                    <span class="text-danger text-sm" v-show="errors.has('message')">{{ errors.first('message') }}</span>
                </div>
                <div class="vx-col md:w-1/2 w-full mt-8">
                    <label class="vs-input-label d-block">{{ $t('Response') + ' '}}</label>
                    <textarea class="msg" name="message" v-model="question.response" cols="50" rows="20"></textarea>
                    <span class="text-danger text-sm" v-show="errors.has('response')">{{ errors.first('response') }}</span>
                </div>
                <div class="vx-row">
                    <vs-button class="m-5" v-if="question.status == 0" color="primary" @click="update(question)">Respond</vs-button>
                    <div class="m-5" v-else>
                        <vs-chip transparent class="ag-grid-cell-chip" :color="statusOptions[question.status].color">
                            {{ $i18n.locale == 'en' ? statusOptions[question.status].label.en : statusOptions[question.status].label.ar }}
                        </vs-chip>
                    </div>
                </div>
            </div>
        </vx-card>
    </div>
</template>

<script>
import axios from "@/axios.js"

export default {
    data() {
        return {
            question: {},
             statusOptions: [
                { label: { en: 'Not Answered', ar: 'لم يتم الرد' }, color:'warning', value: 0 },
                { label: { en: 'Answered', ar: 'تم الرد' }, color:'#24c1a0', value: 1 },
            ],
        }
    },
    methods: {
        update(data) {
            if(data.user_id != null) {
                const obj = {
                    question_id: data.id,
                    response: data.response,
                    status: 1,
                }

                const question = new Promise((resolve, reject) => {
                    axios.post("/api/questions/update", obj)
                    .then((response) => {
                        resolve(response)
                    })
                    .catch((error) => { console.log(error.response) })
                }).then(res => {
                    if (res.data.statusCode == 200) {
                        this.$vs.notify({
                            color: 'success',
                            title: 'Successfull',
                            text: 'Status Updated Successfully'
                        })

                        this.$router.push({path: '/questions/'})
                    } else {
                        this.$vs.notify({
                            color: 'danger',
                            title: 'Error',
                            text: 'Something Went Wrong'
                        })
                    }
                })
                .catch(err => connsole.log(err))
            } else {
                this.$vs.notify({
                    color: 'warning',
                    title: 'User Not Registered',
                    text: 'This response will be sent as an email'
                })

                const mail = new Promise((resolve, reject) => {
                    axios.post("/api/questions/mail", this.question)
                    .then((response) => {
                        resolve(response)
                    })
                    .catch((error) => { console.log(error.response) })
                }).then(res => {
                    if (res.data.statusCode == 200) {
                        this.$vs.notify({
                            color: 'success',
                            title: 'Successfull',
                            text: 'Email Sent Successfully'
                        })

                        this.$router.push({path: '/questions/'})
                    } else {
                        this.$vs.notify({
                            color: 'danger',
                            title: 'Error',
                            text: 'Something Went Wrong'
                        })
                    }
                })
                .catch(err => console.log(err))
            }
        }
    },
    created() {
        const question = new Promise((resolve, reject) => {
            axios.get("/api/questions/list/" + this.$route.params.id)
            .then((response) => {
                resolve(response)
            })
            .catch((error) => { console.log(error.response) })
        }).then(res => this.question = res.data[0])
        .catch(err => connsole.log(err))
    },
}
</script>

<style lang="scss">
#response-container {
    margin: 2rem;

    .msg {
        resize: none;
        display: block;
        border-radius: .25rem;
        width: 100%;
        border-color: #ccc;
        padding: 1rem;
    }
}
</style>