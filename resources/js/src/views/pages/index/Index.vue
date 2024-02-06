
<template>
  <div>
    <nav class="st-nav navbar main-nav navigation fixed-top" id="main-nav">
        <div class="container">
            <a href="" class="navbar-brand mr-0 mr-md-2">
              <img src="@assets/images/logo/logo.png" alt="basmtak" class="logo logo-sticky d-block d-md-none">
              <img src="@assets/images/logo/logo-light-2.png" alt="Dashcore" class="logo d-none d-md-block">
            </a>
            <ul class="st-nav-menu nav navbar-nav">
                <!-- <li class="st-nav-section nav-item">
                    <a href="" class="navbar-brand">
                        <img src="@assets/images/logo/logo.png" alt="basmtak" class="logo logo-sticky d-block d-md-block">
                        <img src="@assets/images/logo/logo-light.png" alt="Dashcore" class="logo d-none d-md-block">
                    </a>
                </li> -->
                <li class="st-nav-section st-nav-primary nav-link"><a class="st-root-link nav-link" href="#"> {{$t('NavHome')}}</a>
                    <a class="st-root-link item-products nav-link" @click="scrollToFeat" > {{$t('NavFeatures')}} </a>
                    <a class="st-root-link item-products nav-link" @click="scrollStartNow"> {{$t('NavStartNow')}} </a>
                    <a class="st-root-link item-blog nav-link" @click="scrollClients">{{$t('NavClients')}} </a>
                    <a class="st-root-link item-shop nav-link" @click="scrollFAQ">{{$t('NavFaq')}}</a>
                    <a class="st-root-link item-company nav-link" @click="scrollPricing"> {{$t('NavPricing')}}</a>
                </li>
                <li class="st-nav-section nav-item" v-if="!isLoggedIn">
                    <a class="btn btn-rounded btn-solid mr-md-3 mb-sm-2 mb-md-0 px-4" href="login" target="_blank">
                        <i class="fas fa-sign-in-alt d-inline d-md-inline mr-md-0 mr-lg-2"></i>
                        <span class="d-md-none d-lg-inline bold">{{$t('NavLogin')}}</span>
                    </a>
                    <a class="btn btn-rounded btn-outline  px-3 mr-4 register-btn" href="register" target="_blank">
                        <i class="fas fa-user-plus d-inline d-md-inline mr-md-0 mr-lg-2"></i>
                        <span class="d-md-none d-lg-inline">{{$t('NavRegister')}}</span>
                    </a>
                </li>
                <li class="st-nav-section nav-item" v-if="isLoggedIn">
                    <a class="btn btn-rounded btn-outline mr-3 px-3" href="dashboard" target="_blank">
                        <i class="fas fa-sign-in-alt d-inline d-md-inline mr-md-0 mr-lg-2">{{$t('NavDashboard')}}</i>
                    </a>
                </li>

                <li class="st-nav-section nav-item">
                  <i18n />
                </li>

                <!-- <dark-mode/> -->

                <!-- Mobile Navigation -->
                <!-- <li class="st-nav-section st-nav-mobile nav-item">
                    <button class="st-root-link navbar-toggler" type="button"><span class="icon-bar"></span> <span
                            class="icon-bar"></span> <span class="icon-bar"></span></button>
                    <div class="st-popup">
                        <div class="st-popup-container"><a class="st-popup-close-button">Close</a>
                            <div class="st-dropdown-content-group">
                                <h4 class="text-uppercase regular">Pages</h4><a class="regular text-primary"
                                                                                href="about.html"><i
                                    class="far fa-building mr-2"></i> About </a><a class="regular text-success"
                                                                                   href="contact.html"><i
                                    class="far fa-envelope mr-2"></i> Contact </a><a class="regular text-warning"
                                                                                     href="pricing.html"><i
                                    class="fas fa-hand-holding-usd mr-2"></i> Pricing </a><a class="regular text-info"
                                                                                             href="faqs.html"><i
                                    class="far fa-question-circle mr-2"></i> FAQs</a>
                            </div>
                            <div class="st-dropdown-content-group border-top bw-2">
                                <h4 class="text-uppercase regular">Components</h4>
                                <div class="row">
                                    <div class="col mr-4"><a target="_blank" href="components/alert.html">Alerts</a> <a
                                            target="_blank" href="components/badge.html">Badges</a> <a target="_blank"
                                                                                                       href="components/button.html">Buttons</a>
                                        <a target="_blank" href="components/color.html">Colors</a> <a target="_blank"
                                                                                                      href="components/accordion.html">Accordion</a>
                                        <a target="_blank" href="components/cookie-law.html">Cookielaw</a></div>
                                    <div class="col mr-4"><a target="_blank" href="components/overlay.html">Overlay</a> <a
                                            target="_blank" href="components/progress.html">Progress</a> <a target="_blank"
                                                                                                            href="components/lightbox.html">Lightbox</a>
                                        <a target="_blank" href="components/tab.html">Tabs</a> <a target="_blank"
                                                                                                  href="components/tables.html">Tables</a>
                                        <a target="_blank" href="components/typography.html">Typography</a></div>
                                </div>
                            </div>
                            <div class="st-dropdown-content-group bg-light b-t"><a href="login.html">Sign in <i
                                    class="fas fa-arrow-left"></i></a></div>
                        </div>
                    </div>
                </li> -->
            </ul>
        </div>
        <div class="st-dropdown-root">
            <div class="st-dropdown-bg">
                <div class="st-alt-bg"></div>
            </div>

        </div>
    </nav>
    
    <!--- Header --->
    <header class="section header text-contrast app-landing-header main-header" dir="rtl">
      <img src="@assets/images/basmatk/header-2.png" class="absolute main-img-header-1">
      <!-- <div class="shape-wrapper"> -->
        <!-- <div class="shape shape-background shape-main gradient gradient-blue-navy"></div>
        <div class="shape shape-background shape-left gradient gradient-navy-blue"></div> -->
      <!-- </div> -->
        <div class="container overflow-hidden">
          <div class="row gap-y align-items-center text-left">
            <div class="col-md-6 col-lg-6  header-desc">
              <!-- <p class="lead d-flex align-items-center my-0"><i class="fas fa-award font-md mr-3"></i>{{$t('HeaderF1')}}</p> -->
              <h1 class="extra-bold text-contrast d-flex align-items-center mt-0 mb-2" >{{$t('HeaderF3')}}</h1>
              <h2 class="text-light text-contrast align-items-center">{{$t('HeaderF2')}}</h2>
              <!-- <p class="lead w-1/2 md:w-full"> {{$t('HeaderF4')}} </p> -->
              <div class="try-btn">
                <a href="/register" :alt="$t('TryForAWeek')" class="font-semibold btn btn-rounded btn-lg btn-info shadow px-4 text-capitalize bg-white blue_text" >{{$t('TryForAWeek')}}<img class="pl-2" src="@assets/images/basmatk/chevrons-left.svg" width="22px"></a>
              </div>
              <div class="flex mt-4 video-promo">
                <div>
                  <img class="logo-light" src="@assets/images/logo/logo-light.svg" alt="">
                  <a @click="popupActive=true" class="btn btn-lg btn-info shadow px-5  bg-white blue_text"><img src="@assets/images/basmatk/Polygon 2.svg" width="18px"></a>
                  <vs-popup fullscreen title="Basmatk" :active.sync="popupActive">
                    <iframe src="https://www.youtube-nocookie.com/embed/jjo5_1KTgbY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  </vs-popup>
                </div>
                <div class="pl-3">
                  <span>{{$t('PromoText1')}}</span>
                  <p class="m-0 bold" @click="popupActive=true" style="cursor: pointer;">{{$t('PromoText2')}}</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-5 app-screen">
              <div data-aos="fade-left">
                <img src="@assets/images/basmatk/app.png" width="100%">
                <!-- <iframe class="" src="https://www.youtube-nocookie.com/embed/jjo5_1KTgbY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
              </div>
            </div>
          </div>
        </div>
    </header>

    <!-- features -->
    <features />

    <!-- Start Now -->
    <start-now />

    <!-- Clients -->
    <clients />

    <!-- F&Q -->
    <questions />
 
    <!-- Pricing Tables -->
    <pricing-table />

    <!-- Footer -->
    <siteFooter />
  </div>
</template>



<script>
import AOS from "aos";
import "aos/dist/aos.css";
import { swiper, swiperSlide } from 'vue-awesome-swiper'
import 'swiper/dist/css/swiper.min.css'
import './common-script.js'
import './site.js'

import I18n  from "./components/I18n.vue"
import features from "./components/features.vue"
import startNow from "./components/startNow.vue"
import clients from "./components/clients.vue"
import questions  from "./components/questions.vue"
import pricingTable  from "./components/pricingTable.vue"
import siteFooter from "./components/siteFooter.vue"

export default{
  components: {
    AOS,
    swiper,
    swiperSlide ,
    I18n ,
    features,
    startNow,
    clients,
    questions,
    pricingTable,
    siteFooter
    },
  data () {
    return {
        popupActive: false,
        swiperOption: {
          // centeredSlides: true,
          spaceBetween: 30,
          autoplay: {
              delay: 2500,
              disableOnInteraction: true
          },
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
          },
          effect: 'fade',
        },
          swiperTwoOption: {
          slidesPerView: 4,
          centeredSlides: true,
          spaceBetween: 30,
          loop: true,
          // slidesOffsetBefore: 0,
          // centeredSlides: true,
          autoplay: {
              delay: 2500,
              disableOnInteraction: true
          },
          // pagination: {
          //   el: '.swiper-pagination',
          //   clickable: true,
            // type: 'fraction'
          // },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
          },
          breakpoints: {
            1024: {
              slidesPerView: 4,
              spaceBetween: 20
              },
            768: {
              slidesPerView: 2,
              spaceBetween: 30
              },
            640: {
              slidesPerView: 1,
              spaceBetween: 20
              }
          }
        }
    }

  },
  computed: {

  },
  
  methods: {
 
 
    scrollToFeat() {
      window.scrollTo(0, 750);
    },
    scrollStartNow() {
      window.scrollTo(0, 1400);
    },

    scrollClients() {
      window.scrollTo(0, 4000);
    },
    scrollFAQ() {
      window.scrollTo(0, 4650);
    },
       scrollPricing() {
      window.scrollTo(0, 5150);
    },
  },
  created(){
    AOS.init({ disable: "phone" });
      // this.$refs.mySwiperTwo.swiper.slideTo(2, 0)
  }

}
</script>
<style>
@import './css/indexMainTheme.css';
</style>

<style lang="scss">
@media (max-width: 575px){
  .st-nav .st-nav-menu{
    flex: none !important;
  }
  .register-btn{
    margin-left:1rem !important;
  }
}
/* Header ========================================================== */
.main-header .header-desc{
  margin-top: 6rem !important;
  padding-left:2rem !important;
}
.main-header h1{
  margin-top: 5rem;
}
.main-header h2{
   font-size:1.5rem;
}
.main-header .try-btn{
  margin-top: 3rem !important;
}
@media (min-width: 768px){
  .main-header .header-desc{
    margin-top: 0 !important;
  }
  .main-header h2{
    font-size:2rem;
  }
  .main-header .try-btn{
    margin-top: 6rem !important;
  }
}
 .main-header .app-screen{
   margin-top: 7rem !important;
 }
.main-img-header-1{
  top:0;
  left:0;
  width:100%;
  height: 100%;
  object-fit: cover;
}
.main-header .video-promo a {
  position: relative;
  cursor: pointer;
  padding-left: 3rem !important;
  padding-right: 3rem !important;
}
.main-header .video-promo .logo-light {
  position: absolute;
  z-index: 1;
  width: 80px;
  left: 3rem;
  bottom: 1.5rem;
}
.vs-popup--content{
  height: 100%;
}
iframe {
  width: 100%;
  height: 100%;
}
@media (min-width: 1600px){
  .main-header{
    height: 1150px; 
  }
  .main-header .app-screen{
    margin-top: 10rem !important;
    margin-left: 5rem !important;
  }
}


</style>

