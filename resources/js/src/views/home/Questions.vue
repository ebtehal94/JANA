<template>
    <div id="contact-container">
        <vx-card>
            <template>
                <div class="contact-us vx-row">
                    <div class="vx-col w-1/2">
                        <h3>{{ $t('ContactUs') }}</h3>

                        <label class="vs-input-label">{{ $t('Name') + ' '}} <span class="text-danger">*</span></label>
                        <vs-input class="w-full mb-4" v-model="question.name" v-validate="'required|alpha_spaces'" name="name" />
                        <span class="text-danger text-sm" v-show="errors.has('name')">{{ errors.first('name') }}</span>

                        <label class="vs-input-label">{{ $t('Email') + ' '}} <span class="text-danger">*</span></label>
                        <vs-input class="w-full mb-4" v-model="question.email" v-validate="'required|email'" name="email" />
                        <span class="text-danger text-sm" v-show="errors.has('email')">{{ errors.first('email') }}</span>

                        <label class="vs-input-label">{{ $t('Subject') + ' '}} <span class="text-danger">*</span></label>
                        <vs-input class="w-full mb-4" v-model="question.subject" v-validate="'required|alpha_spaces'" name="subject" />
                        <span class="text-danger text-sm" v-show="errors.has('subject')">{{ errors.first('subject') }}</span>

                        <label class="vs-input-label d-block">{{ $t('Message') + ' '}} <span class="text-danger">*</span></label>
                        <textarea class="msg" name="message" v-model="question.message" cols="50" rows="10"></textarea>
                        <span class="text-danger text-sm" v-show="errors.has('message')">{{ errors.first('message') }}</span>

                        <vs-button class="mt-5" color="primary" @click="create(question)">Send</vs-button>
                    </div>
                    <div class="vx-col w-1/2">
                        <div class="m-10">
                            <p class="font-bold">ساعات العمل 8:00 - 4:00</p>

                            <div class="mt-5">
                                <h5 class="bold">العنوان</h5>
                                <p>الأردن، شارع 24، بجوار مول السالم</p>
                                <p>+999 12 533 37 97</p>
                                <p>info@clouds-line.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </vx-card>
    </div>
</template>

<script>
import axios from "@/axios.js"

export default {
    data() {
        return {
            question: { name: '', email: '', subject: '', message: '' }
        }
    },
    computed: {
        activeUserInfo () {
            return this.$store.state.AppActiveUser
        }
    },
    methods: {
        create(){
            if(this.activeUserInfo.id != 0) {
                this.question.user_id = this.activeUserInfo.id
            }

            const question = new Promise((resolve, reject) => {
                axios.post("/api/questions/create", this.question)
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

                    window.location.reload()
                } else {
                    this.$vs.notify({
                        color: 'danger',
                        title: 'Error',
                        text: 'Something Went Wrong'
                    })
                }
            })
            .catch(err => connsole.log(err))
        }
    },
}
</script>

<style lang="scss" scoped>
#contact-container {
    margin: 10rem;

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