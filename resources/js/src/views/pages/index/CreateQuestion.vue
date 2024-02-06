
<template>
  <div>
    <!-- Navbar -->
    <HelpCenterNavbar />

     <section class="section mt-12 create-question">
      <div class="container pt-0">
        <div class="row">
          <div class="col-md-6 text-left">

            <div class="items-end">
              <span class="leading-none font-semibold text-sm">{{$i18n.locale == "en" ? "Question and answer details (Explanation)" : "تفاصيل السؤال و الجواب (الشرح)"}}</span>
            </div>

            <div class="text-sm">
              <v-select class="w-full mt-4 text-sm"
              :placeholder="$t('Category')"
              v-model="QA_data.category_id"
              v-validate="'required'"
              label="title_ar" :options="categories"
              :reduce="title_ar => title_ar.id"
              :dir="$vs.rtl ? 'rtl' : 'ltr'"
              name="category"/>
            </div>
        
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mt-4 text-left">
            <div class="text-sm">
              <vs-input
              class="w-full text-base mt-2 "
              :placeholder="$t('QuestionAr')"
              v-model="QA_data.title_ar"
              v-validate="'required'"
              name="title"/>
            </div>
          </div>

          <div class="col-md-6 mt-4">
            <div class="text-sm">
              <vs-input
              class="w-full text-base mt-2 "
              :placeholder="$t('QuestionEn')"
              v-model="QA_data.title_en"
              v-validate="'required'"
              name="title"/>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mt-4">
            <div class="">
              <quill-editor v-model="QA_data.answer_ar"></quill-editor>
            </div>
          </div>

          <div class="col-md-6 mt-4">
             <div class="text-right">
              <quill-editor v-model="QA_data.answer_en"></quill-editor>
            </div>
          </div>
        </div>

        <div class="row flex justify-end mt-10">
            <vs-button
              size="small"
              class="mx-4 mb-4 font-semibold text-sm rounded-full px-16"
              color="#0E77FF"
              @click="createQuestion">
                {{$i18n.locale == "en" ? "Save" : "حفظ"}}
            </vs-button>

            <vs-button
              size="small"
              class="mr-4 mb-4 font-semibold text-sm rounded-full px-16"
              color="#ACACAC" type="border"
              @click="goBack">
                {{ $i18n.locale == 'en' ? 'Close' : 'خروج' }}
            </vs-button>
        </div>
      </div>
    </section>


    <!-- Footer -->
    <siteFooter />
  </div>
</template>



<script>
import axios from "@/axios.js"
import vSelect from 'vue-select'
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'
import { quillEditor } from 'vue-quill-editor'

import './common-script.js'
import './site.js'

import I18n  from "./components/I18n.vue"
import HelpCenterNavbar from "./components/HelpCenterNavbar.vue"
import siteFooter from "./components/siteFooter.vue"
export default{
  components: {
    vSelect,
    quillEditor,
    I18n ,
    HelpCenterNavbar,
    siteFooter
    },
    props:{

    },
  data () {
    return {
      QA_data: {category_id: null, title_ar:null, title_en: null,answer_ar:null,answer_en:null },
      categories:[
        {title_ar:'تهيئة النظام',id:1},
        {title_ar:'ربط الأجهزة',id:2},
        {title_ar:'التطبيق',id:3},
        {title_ar:'الإشتراك',id:4},
        {title_ar:'الرئيسية',id:5},
        {title_ar:'الموظفين ',id:6},
        {title_ar:' المالية',id:7},
        {title_ar:' التحكم و الإعدادت',id:8},
        {title_ar:'المهام',id:9},
        {title_ar:'الطلبات',id:10},
      ],
      // categories: []
    }

  },
  computed: {
  
  },
  
  methods: {
    createQuestion(){
      if (this.QA_data.id != null && this.QA_data.id > 0){
      axios.post("/api/question/update",this.QA_data)
        .then(res => {
          if( res.data.statusCode == 200 ){
            this.$vs.notify({
            color: 'success',
            title: 'Successfull',
            text: 'تم بنجاح'
            })
          }else{
            this.$vs.notify({
            color: 'danger',
            title: 'Error',
            text: 'حدث خطأ ما'
            })
          }
        })
        .catch(function (error) {
            console.log(error.response);
        });
      }else{
        axios.post("/api/question/create",this.QA_data)
        .then(res => {
          if( res.data.statusCode == 200 ){
            this.$vs.notify({
            color: 'success',
            title: 'Successfull',
            text: 'تم بنجاح'
            })
          }else{
            this.$vs.notify({
            color: 'danger',
            title: 'Error',
            text: 'حدث خطأ ما'
            })
          }
        })
        .catch(function (error) {
            console.log(error.response);
        });
      }

    },
    goBack(){
      this.$router.go(-1)
    },

  },
  created(){

  }

}
</script>
<style>
@import './css/indexMainTheme.css';
</style>

<style lang="scss">
.create-question{
  width: 100%;
  background: #fff;
}
@media (min-width: 768px){
  .create-question{
    width: 90% !important;
    margin-left: auto;
    margin-right: auto;
  }
}
// .v-select .vs__dropdown-toggle {
//     border-radius: 17px !important;
//     padding: 0 0 4px 0 !important;
//     background: none !important;
//     border: 1px solid rgba(60, 60, 60, 0.26) !important;
// }
// .v-select .vs__dropdown-toggle .vs__actions {
//     padding: 0px 20px 0 3px !important;
// }
// .v-select .vs__dropdown-toggle .vs__selected-options {
//     padding: 2px 0rem 2px .5rem !important;
// }
.create-question .vs-input--input.normal {
    padding: .4rem 1rem !important;
    border-radius: 17px !important;
    height: 45px;
}
.create-question .vs-input--placeholder {
    padding-left: 1rem !important;
    padding-right: 1rem !important;
    padding-top: 0.8rem !important;
    font-weight: 500 !important;
}
.vs-input-primary .vs-input--input:focus {
    border: 1px solid rgba(0, 0, 0, 0.2) !important;
    box-shadow: none !important;
}
.ql-toolbar.ql-snow {
    border-radius: 15px 15px 0 0 !important;
}
.ql-container.ql-snow {
    border-radius: 0 0 15px 15px !important;
    height: 200px !important;
}
.create-question .vs-button.small {
    padding: 10px;
}
</style>

