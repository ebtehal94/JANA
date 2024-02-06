
<template>
  <div>
    <!-- Navbar -->
    <HelpCenterNavbar />
    
    <!-- Search Section -->
    <section class="section  search-section">
      <div class="container pt-0">
        <div class="">
          <div class="section-heading text-center">
            <h5 class="extra-bold blue_text" style="font-size: 1.7rem;"><span style="color: #4A4A4A">{{$t('HelpCenterTitle')}}</span> {{$t('HelpCenterTitle2')}}</h5>
            <p>{{$t('HelpCenterDisc')}}</p>
          </div>
          <div class="row search-bar">
            <div class="col-md-6">
              <vs-input icon-no-border icon-after vs-icon-after="true" :placeholder="$t('SearchBar')"  v-model="searchQuery" icon-pack="feather" icon="icon-search" size="large" class="w-full text-left" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Help Center -->
    <help-center :selectedPage="selectedPage" @pageChanged="selectedBox" />

    <!-- System Intro -->
    <system-intro v-if="selectedPage == 1"/>

    <!-- Categories -->
    <categories :selectedPage="selectedPage" :searchQuery="searchQuery"  @pageChanged="selectedQuestion(i)" v-else-if="selectedPage == 2"/>
    
    <!-- Questions List -->
    <CategoryQuestions :searchQuery="searchQuery" v-else-if="selectedPage == 4"/>

    <!--Find Section -->
    <find-section/>

    <!-- Footer -->
    <siteFooter />
  </div>
</template>



<script>
import './common-script.js'
import './site.js'

import I18n  from "./components/I18n.vue"
import HelpCenterNavbar from "./components/HelpCenterNavbar.vue"
import helpCenter from "./components/helpCenter.vue"
import SystemIntro from "./components/SystemIntro.vue"
import CategoryQuestions from "./components/CategoryQuestions.vue"
import Categories from "./components/Categories.vue"
import FindSection from "./components/FindSection.vue"
import siteFooter from "./components/siteFooter.vue"
export default{
  components: {
    I18n ,
    HelpCenterNavbar,
    helpCenter,
    SystemIntro,
    Categories,
    CategoryQuestions,
    FindSection,
    siteFooter
    },
    props:{
       kb:{
         type: Array
       },
       filteredKB:{
         type: Array
       }
      // selectedPage: {
      //   default: 2
      // }
    },
  data () {
    return {
      searchQuery: '',
      selectedPage: 2,
    }

  },
  computed: {

  },
  
  methods: {
    selectedBox(i){
      this.selectedPage = i
      window.scrollTo(0, 250);
    },
    selectedQuestion(i){
      this.category_id = i
      this.selectedPage = 4
      window.scrollTo(0, 250);
    }
  },
  created(){

  }

}
</script>
<style>
@import './css/indexMainTheme.css';
</style>

<style lang="scss">
.search-section{
  background: #fff;
  margin-top: 2rem;
}
.search-section .container{
  padding-bottom:0
}
.search-section .section-heading{
  margin-bottom:30px;
}
.search-section p{
  font-size:1.1rem
}
@media (min-width: 768px){
  .search-section p{
    font-size:1.3rem
  }
}
.search-bar{
  justify-content: center;
}
.search-bar .vs-input--input{
  border-radius: 30px;
  border: 0 !important;
  box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
}
.vs-input-primary .vs-input--input:focus{
  border: 0 !important;
}
.vs-input-primary.isFocus .vs-input--label, .vs-input-primary .vs-input--input:focus~.icon-inputx, .vs-input-primary .vs-input--input:focus~.vs-placeholder-label{
  color:rgba(0,0,0,.4) !important;
}
.search-bar .vs-input--icon{
  top:15px !important;
  padding-left: 5px !important;
  padding-right: 1rem !important;
}
.search-bar .vs-input--placeholder.large{
  padding-top: 1rem !important;
  padding-left: 1.5rem !important;
}

// .find-section .find-box{
//   width: 100%;
//   margin-left: auto;
//   margin-right: auto;
//   background: #f2f2f2;
//   border-radius: 10px;
// }
// @media (min-width: 768px){
//   .find-section .find-box{
//     margin-left: auto;
//     margin-right: auto;
//     width: 85%;
//   }
// }
// .find-section p{
//   color: #6A6A6A;
// }
// .find-section .dislike-icon{
//   padding-top: 8px;
// }
// .find-section span{
//   font-size: 12px;
//   font-weight: 500;
// }

</style>

