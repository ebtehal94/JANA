
<template>
  <div>
    <!-- Navbar -->
    <HelpCenterNavbar />

     <section class="section mt-12 questions-list">
      <div class="container pt-0">
        <div class="row">
            <div class="col flex">
                <h2 class="font-bold list-title">{{$i18n.locale == "en" ? "Questions List" : "قائمة الأسئلة"}}</h2>
                <vs-button
                size="small"
                class="mx-4 mb-4 font-semibold rounded-full px-6 list-button"
                color="#00CA77"
                @click="newQuestion()">
                    {{$i18n.locale == "en" ? "New Question" : "سؤال جديد"}}
                </vs-button>
            </div>
        </div>
        <div class="row">
          <div class="col-md-9 mb-8 text-left ">
            <div class="accordion accordion-clean" id="common-faqs-accordion" v-for="item in faq" :key="item.id">
              <div class="ml-auto cursor-pointer flex justify-around action" style="width: 4rem">
                <a @click.stop="gotoEdit(item.id)"><img src="@assets/images/basmatk/edit.svg" width="24" height="24"></a>
                <a @click.stop="openDeleteConfirm(item.id)"><img src="@assets/images/basmatk/delete.svg" width="24" height="24"></a>
              </div>
              <div class="card mb-3">
                <vs-collapse-item>
                  <div class="card-header" slot="header">
                    <a href="" class="card-title btn">{{ $i18n.locale == 'en' ? item.title_en : item.title_ar}}</a>
                  </div>
                  <div id="q1" class="collapse show">
                    <div class="card-body mb-0">{{ $i18n.locale == 'en' ? item.answer_en: item.answer_ar}}</div>
                  </div>
                </vs-collapse-item>
              </div>
            </div>  
          </div>
          
          <div class="col-md-3">
            <vx-card class="text-center liked-box mt-2 mb-12">
              <img src="@assets/images/basmatk/like-img.svg" width="70" height="70" class="image">
              <h4 class="mb-2"><span>{{question_like.likes}}</span> {{$i18n.locale == "en" ? "Person " : "شخصاَ"}} </h4>
              <p>{{ $t('LikeDisc')}}</p>
            </vx-card>
            <vx-card class="text-center liked-box">
              <img src="@assets/images/basmatk/dislike-img.svg" width="70" height="70" class="image">
              <h4 class="mb-2"><span>{{question_like.dislikes}}</span> {{$i18n.locale == "en" ? "Person " : "شخصاَ"}} </h4>
              <p>{{ $t('LikeDisc')}}</p>
            </vx-card>
          </div>

        </div>

      </div>
    </section>


    <!-- Footer -->
    <siteFooter />
  </div>
</template>



<script>
import axios from "@/axios.js"
import './common-script.js'
import './site.js'

import I18n  from "./components/I18n.vue"
import HelpCenterNavbar from "./components/HelpCenterNavbar.vue"
import siteFooter from "./components/siteFooter.vue"
export default{
  components: {
    I18n ,
    HelpCenterNavbar,
    siteFooter
    },
    props:{

    },
  data () {
    return {
      faq: [
       {
          id: 1,
          title_ar: ' ماهو نظام بصمتك؟',
          title_en:'',
          answer_ar:'هو نظام موارد بشرية متكامل يوفر علـى الموظف و إدارتة عناء المعاملات الورقية من خلال لوحة تحكم شاملة و تطبيق جوال يحتوي علي العديد من المميزات: 1-إدخال بيانات الشركة. 2-إضافة فروع الشركة. 3-إنشاء الأقسام و المجموعات الإدراية. 4-إضافة الموظفين..',
          answer_en:'',

        },
        {
          id: 2,
          title_ar : 'هل يعمل التطبيق في جميع أجهزة الجوال؟',
          title_en:'',
          answer_ar:'نعم يعمل في جميع أجهزة الجوال الذكية ( اندرويد ، IOS ، هواوي ).',
          answer_en:'',
        },
        {
          id          : 3,
          title_ar : 'هل يعمل التطبيق في جميع أجهزة الجوال؟',
          title_en:'',
          answer_ar:'نعم يعمل في جميع أجهزة الجوال الذكية ( اندرويد ، IOS ، هواوي ).',
          answer_en:'',
        },
        {
          id          : 4,
          title_ar : 'هل يعمل التطبيق في جميع أجهزة الجوال؟',
          title_en:'',
          answer_ar:'نعم يعمل في جميع أجهزة الجوال الذكية ( اندرويد ، IOS ، هواوي ).',
          answer_en:'',
          likes:'',
          dislikes:'',
        },
        {
          id          : 5,
          title_ar : 'هل يعمل التطبيق في جميع أجهزة الجوال؟',
          title_en:'',
          answer_ar:'نعم يعمل في جميع أجهزة الجوال الذكية ( اندرويد ، IOS ، هواوي ).',
          answer_en:'',
        },
        {
          id          : 6,
          title_ar : 'هل يعمل التطبيق في جميع أجهزة الجوال؟',
          title_en:'',
          answer_ar:'نعم يعمل في جميع أجهزة الجوال الذكية ( اندرويد ، IOS ، هواوي ).',
          answer_en:'',

        },
      ],
      ItemToDelete: null,
      // questions:[],
      question_like: {likes:905 ,dislikes:15}
    }

  },
  computed: {
  
  },
  
  methods: {
    newQuestion(){
      this.$router.push({path: '/create-question'})
    },
    gotoEdit(id){
      this.$router.push({path: '/edit-question/'+id})
    },
    openDeleteConfirm(id) {
      this.ItemToDelete = id;
      this.$vs.dialog({
        type: 'confirm',
        color: 'danger',
        title: this.$t('Delete'),
        text: 'هل أنت متأكد أنك تريد حذف هذا السؤال نهائياً؟',
        accept: this.deleteQuestion
      })
    },
    deleteQuestion(){
      axios.delete("/api/question/delete/"+ this.ItemToDelete)
      .then(()   => { this.showDeleteSuccess() })
      .catch(err => { console.error(err) })
    },
    showDeleteSuccess() {
      this.$vs.notify({
        color: 'success',
        title: 'Successfull',
        text: 'تم بنجاح'
      })
    },

  },
  created(){
        // axios.get('/api/questions/list')
        // .then((res) => {
        //     console.log(res.data)
        // this.questions = res.data.questions
        // })
        // .catch((error) => console.log(error)),

        // axios.get('/api/questionslike')
        // .then((res) => {
        //     console.log(res.data)
        // this.qquestions_like = res.data.questions_like
        // })
        // .catch((error) => console.log(error)),

  }

}
</script>
<style>
@import './css/indexMainTheme.css';
</style>

<style lang="scss">
.questions-list{
  width: 100%;
}
@media (min-width: 768px){
  .questions-list{
    width: 90% !important;
    margin-left: auto;
    margin-right: auto;
  }
}
.questions-list .list-title{
    font-size: 1.5rem;
    color: #5e5e5e;
}
.questions-list .vs-button.small {
    padding: 6px;
    font-size: .6rem;
}
.questions-list .accordion {
  position: relative;
}
.questions-list .action{
  position: absolute;
  top: 1rem;
  right: 2.5rem;
  z-index:1;
}
.questions-list .card{
  border-radius: 10px;
  border:.1px solid #C7C7C7 !important;
}
.questions-list .card-title{
  color:#0E77FF;
  font-size: .7rem;
  font-weight: bold;
  padding-left:0rem
}
@media (min-width: 768px){
  .questions-list .card-title{
    font-size: .9rem;
    padding-left:1rem
  }
}
.questions-list .card-body {
  color: #6a6a6a;
  font-weight: 500;
}
.questions-list .vs-icon {
    color: #0E77FF !important;
    font-size: 1.5rem !important;
    background: #0e77ff1f;
    border-radius: 50%;
}

.liked-box{
  background: #fff !important;
  border-bottom: 0.1px solid #DFDFDF;
  border-radius: 12px !important;
  border-right: .1px solid #dfdfdf;
  border-left: .1px solid #dfdfdf;
  border-top: .1px solid #dfdfdf24;
}

.liked-box h4{
  font-size: .9rem;
  font-weight: 700;
  color:#333;
}
.liked-box p{
  font-size: .7rem;
  font-weight: 500;
  color:#A1A1A1;
  margin: 1rem 1.5rem;
}
.liked-box .image{
    margin-left: auto;
    margin-right: auto;
    margin-top: -2rem;
    margin-bottom: 1rem;
}
.vx-card .vx-card__collapsible-content .vx-card__body {
    padding: .5rem !important;
}
</style>

