
<template>
  <div>
    <!-- Navbar -->
    <!-- <HelpCenterNavbar /> -->
    
    <!-- Search Section -->
    <!-- <section class="section search-section">
      <div class="container pt-0">
        <div class="">
          <div class="section-heading text-center">
            <h5 class="extra-bold blue_text" style="font-size: 1.7rem;"><span style="color: #4A4A4A">{{$t('HelpCenterTitle')}}</span> {{$t('HelpCenterTitle2')}}</h5>
            <p>{{$t('HelpCenterDisc')}}</p>
          </div>
          <div class="row search-bar">
            <div class="col-md-6">
              <vs-input icon-no-border icon-after vs-icon-after="true" :placeholder="$t('SearchBar')"  v-model="knowledgeBaseSearchQuery" icon-pack="feather" icon="icon-search" size="large" class="w-full text-left" />
            </div>
          </div>
        </div>
      </div>
    </section> -->

    <!-- Help Center -->
    <!-- <help-center/> -->

    <section class="faq text-left">
      <div class="container bring-to-front pt-12 pb-10">
        <div class="vx-row faq-box">
          <div class="vx-col w-full">
            <div class="accordion accordion-clean" id="common-faqs-accordion" v-for="item in filteredFAQ" :key="item.id">
              <div class="card mb-3">
                <vs-collapse-item>
                  <div class="card-header" slot="header">
                    <a  class="card-title btn">{{ $i18n.locale == 'en' ? item.title_en.toUpperCase() : item.title_ar.toUpperCase()}}</a>
                  </div>
                  <div id="q1" class="collapse show">
                    <div class="card-body mb-0">{{ $i18n.locale == 'en' ? item.answer_en.toUpperCase() : item.answer_ar.toUpperCase()}}</div>
                  </div>
                </vs-collapse-item>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--Find Section -->
    <!-- <find-section/> -->

    <!-- Footer -->
    <!-- <siteFooter /> -->

  </div>
</template>



<script>
// import './common-script.js'
// import './site.js'

// import I18n  from "./components/I18n.vue"
// import HelpCenterNavbar from "./components/HelpCenterNavbar.vue"
// import helpCenter from "./components/helpCenter.vue"
// import FindSection from "./components/FindSection.vue"
// import siteFooter from "./components/siteFooter.vue"
export default{
  components: {
    // I18n ,
    // HelpCenterNavbar,
    // helpCenter,
    // FindSection,
    // siteFooter
    },
    props:{
      searchQuery:{
        required:true
      },
    },
  data () {
    return {
      // questions:[],
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
      ]
    }

  },
  computed: {
    filteredFAQ () {
      return this.faq.filter((item) => item.title_ar.toLowerCase().includes(this.searchQuery.toLowerCase())|| item.title_en.toLowerCase().includes(this.searchQuery.toLowerCase()))
    }
  },
  
  methods: {

  },
  created(){
        // axios.get('/api/questions/list')
        // .then((res) => {
        //     console.log(res.data)
        // this.questions = res.data.questions
        // })
        // .catch((error) => console.log(error))
  }

}
</script>
<style>
/* @import './css/indexMainTheme.css'; */
</style>

<style lang="scss">
.faq{
  background-color: #fff !important;
}
.faq .faq-box{
  width: 80%;
  margin-left: auto;
  margin-right: auto;
  background-color: #fff !important; 
}
.faq .faq-box .card{
  border-radius: 10px;
  border:.1px solid #C7C7C7 !important;
}
.faq .faq-box .card-title{
  color:#0E77FF;
  font-size: .8rem;
  font-weight: bold;
  padding-left:0rem
}
@media (min-width: 768px){
  .faq .faq-box .card-title{
    font-size: .9rem;
    padding-left:1rem
  }
}

.faq .faq-box .vs-icon {
    color: #0E77FF !important;
    font-size: 1.5rem !important;
    background: #0e77ff1f;
    border-radius: 50%;
}
.faq .faq-box .card-body {
  color: #6a6a6a;
  font-weight: 500;
}

</style>

