<template>
    <div>
        <!-- Start Now -->
        <section class="section start-now pb-2">
        <div class="col-md-8 mx-auto d-none d-md-block">
            <img src="@assets/images/basmatk/Rectangle-80.png" width="100%" style="opacity:.5;">
        </div>
        <div class="container">
            <div class="col-md-6 mt-md-n15 mt-lg-n16 mt-xl-n17 mx-auto screenshots d-none d-md-block">
              <div class="col-md-10 mx-auto">    
                <div data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" style="position:  relative; z-index: 1;">
                  <swiper :options="swiperOneOption" ref="mySwiperOne" :dir="$vs.rtl ? 'rtl' : 'ltr'" :key="$vs.rtl">
                      <swiper-slide>
                      <img class="responsive" src="@assets/images/screenshots/dash/1.png" alt="banner">
                      </swiper-slide>
                      <swiper-slide>
                      <img class="responsive" src="@assets/images/screenshots/dash/3.png" alt="banner">
                      </swiper-slide>
                      <swiper-slide>
                      <img class="responsive" src="@assets/images/screenshots/dash/4.png" alt="banner">
                      </swiper-slide>
                      <swiper-slide>
                      <img class="responsive" src="@assets/images/screenshots/dash/2.png" alt="banner">
                      </swiper-slide>
                      <swiper-slide>
                      <img class="responsive" src="@assets/images/screenshots/dash/5.png" alt="banner">
                      </swiper-slide>
                      <!-- <div class="swiper-pagination" slot="pagination"></div> -->
                      <!-- <div class="swiper-button-prev swiper-button-white" slot="button-prev"></div> -->
                      <!-- <div class="swiper-button-next swiper-button-white" slot="button-next"></div> -->
                  </swiper>
                </div>
            </div>  
            <img src="@assets/images/basmatk/macbook-white.png" alt="" width="100%" style="position:absolute; top: 0; right: 0rem; "/>
            </div>
            <div class="section-heading mb-6 text-center mt-md-n5">
              <h5 class="bold text-uppercase text-contrast" style="font-size: 1.7rem;">{{$t('StartNowSectionTitle')}}</h5>
              <p class="text-contrast m-0">{{$t('	StartNowSectionDisc')}}</p>
            </div>
            <div class="col-xl-9 mx-auto">
              <div class="row gap-y justify-content-center">
                <div class="col-md-2">
                    <vx-card class="border-0 text-center align-items-center mb-4" @click="toSlideOne(0)">
                    <span class="main-steps">01</span>
                    <p>{{$t('StartNowNav1')}}</p>
                    </vx-card>
                </div>
                <div class="col-md-2">
                    <vx-card class="border-0  text-center align-items-center mb-4 p-0" @click="toSlideOne(1)">
                    <span class="main-steps">02</span>
                    <p>{{$t('StartNowNav2')}}</p>
                    </vx-card>
                </div>
                <div class="col-md-3">
                    <vx-card class="border-0  text-center align-items-center mb-4" @click="toSlideOne(2)">
                    <span class="main-steps main-steps-3">03</span>
                    <p>{{$t('StartNowNav3')}}</p>
                    </vx-card>
                </div>
                <div class="col-md-2">
                    <vx-card class="border-0 text-center align-items-center mb-4" @click="toSlideOne(3)">
                    <span class="main-steps">04</span>
                    <p>{{$t('StartNowNav4')}}</p>
                    </vx-card>
                </div>
                <div class="col-md-2">
                    <vx-card class="border-0 text-center align-items-center mb-4" @click="toSlideOne(4)">
                    <span class="main-steps">05</span>
                    <p>{{$t('StartNowNav5')}}</p>
                    </vx-card>
                </div>
            </div>
            </div>
              <div class="row text-center justify-content-center">
                <div class="start-pagination d-none d-md-block" slot="pagination"></div>
            </div>
        </div>
        </section>

        
        <!-- Mobile App -->
        <section class="section mobile-app">
        <div class="container ">
            <div class="section-heading text-center">
            <h5 class="text-uppercase text-contrast" style="font-size: 1.7rem;">{{$t('StartNowSection2Title')}}</h5>
            <h3 class=" text-contrast" style="font-size: 1.7rem;">{{$t('	StartNowSection2Disc')}}</h3>
            </div>
            <div class="row gap-y justify-content-center">
            <div class="col-md-6 col-lg-4 col-xl-3">
                <vx-card class="app-feat-left border-0 shadow text-center align-items-center mb-4 mx-md-auto mx-lg-0">
                <img src="@assets/images/emp_icons/fingerprint.svg" width="28" height="28" class="stroke-primary mx-auto mb-2">
                <p class="my-0 bold lead text-dark">{{$t('MobileAppF1')}}</p>
                <p class="small">{{$t('MobileAppF1Disc')}}</p>
                </vx-card>
                <vx-card class="app-feat-left border-0 shadow text-center align-items-center mb-4 mx-md-auto mx-lg-0">
                <img src="@assets/images/emp_icons/notification.svg" width="28" height="28" class="stroke-primary mx-auto mb-2">
                <p class="my-0 bold lead text-dark">{{$t('MobileAppF3')}}</p>
                <p class="small">{{$t('MobileAppF3Disc')}}</p>
                </vx-card>
            </div>
            <div class="col-lg-4 col-xl-5 d-md-none d-lg-block">
                <div class="align-items-center">
                <img src="@assets/images/screenshots/app/app-screenshot.png" alt="" class="img-responsive mx-auto app-screenshot" data-aos="fade-down" width="70%">
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <vx-card class="app-feat-right border-0 shadow text-center align-items-center mb-4 mx-md-auto mx-lg-0">
                <img src="@assets/images/emp_icons/reports.svg" width="28" height="28" class="stroke-primary mx-auto mb-2">
                <p class="my-0 bold lead text-dark">{{$t('MobileAppF2')}}</p>
                <p class="small">{{$t('MobileAppF2Disc')}}</p>
                </vx-card>
                <vx-card class="app-feat-right border-0 shadow text-center align-items-center mx-md-auto mx-lg-0">
                <img src="@assets/images/emp_icons/vacations.svg" width="28" height="28" class="stroke-primary m-auto mb-2">
                <p class="my-0 bold lead text-dark">{{$t('MobileAppF4')}}</p>
                <p class="small">{{$t('MobileAppF4Disc')}}</p>
                </vx-card>
            </div>
            </div>
            <div class="row justify-content-center mt-5">
            <a href="/register" :alt="$t('TryForAWeek')" class="font-semibold btn btn-rounded btn-lg btn-info shadow px-4 text-capitalize bg-white blue_text" >{{$t('TryForAWeek')}}<img class="pl-2" src="@assets/images/basmatk/chevrons-left.svg" width="22px"></a>
            </div>
        </div>
            <div class="custom-shape-divider-top-1625989520">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
            </svg>
        </div>
        </section>
    <!-- Dashboard -->
    <section class="section dashboard">
      <div class="container">
        <div class="section-heading mb-5 text-center">
          <h5 class="semibold text-uppercase text-contrast" style="font-size: 1.7rem;">{{$t('DashboardSectionTitle')}}</h5>
          <p class="text-contrast" style="font-size: 1.1rem;">{{$t('DashboardSectionDisc')}}</p>
        </div>
        <div class="row gap-y justify-content-md-center">
          <div class="col-md-7">
            <div class="d-none d-lg-block">
              <span class="items task-management" @click="toSlide(0)">{{$t('TaskManagment')}}</span>
              <span class="items branches" @click="toSlide(1)">{{$t('Branches')}}</span>
              <span class="items employees" @click="toSlide(2)">{{$t('Employees')}}</span>
              <span class="right-items document" @click="toSlide(3)">{{$t('Documents')}}</span>
              <span class="reports" @click="toSlide(4)">{{$t('Reports')}}</span>
              <span class="right-items settings" @click="toSlide(5)">{{$t('Settings')}}</span> 
              <div  style="position:relative">
                <img src="@assets/images/basmatk/test.png" alt="" width="100%"/>
              </div>
            </div>
              <img class="d-block d-lg-none" src="@assets/images/basmatk/dashboard-item.png" alt="" width="100%"/>
          </div>
          <div class="col-md-5 d-none d-md-block slider-section">
            <div class="col-md-9 mx-auto d-none d-md-block screenshots-slider">    
              <div data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" >
                <swiper :options="swiperOption" ref="mySwiper" :dir="$vs.rtl ? 'rtl' : 'ltr'" :key="$vs.rtl">
                  <swiper-slide>
                    <img  class="responsive" src="@assets/images/screenshots/dash/8.png" alt="banner">
                  </swiper-slide>
                  <swiper-slide>
                    <img  class="responsive" src="@assets/images/screenshots/dash/3.png" alt="banner">
                  </swiper-slide>
                  <swiper-slide>
                    <img class="responsive" src="@assets/images/screenshots/dash/5.png" alt="banner">
                  </swiper-slide>
                  <swiper-slide>
                    <img class="responsive" src="@assets/images/screenshots/dash/9.png" alt="banner">
                  </swiper-slide>
                  <swiper-slide>
                    <img class="responsive" src="@assets/images/screenshots/dash/6.png" alt="banner">
                  </swiper-slide>
                  <swiper-slide>
                    <img class="responsive" src="@assets/images/screenshots/dash/7.png" alt="banner">
                  </swiper-slide>
                  <!-- <div class="swiper-pagination" slot="pagination"></div> -->
                  <!-- <div class="swiper-button-prev swiper-button-white" slot="button-prev"></div> -->
                  <!-- <div class="swiper-button-next swiper-button-white" slot="button-next"></div> -->
                </swiper>
              </div>
            </div>  
              <img src="@assets/images/basmatk/macbook-white.png" alt="" width="100%"  style="position:relative "/>
              <div class="row text-center justify-content-center absolute pagination" style="">
                <div class="swiper-pagination" slot="pagination"></div>
              </div>
          </div>
        </div>
        <div class="row justify-content-md-center mt-3">
          <div class="col-md-6 text-center">
            <p class="text-contrast" style="font-size: 1.1rem;">{{$t('DashboardSectionDisc2')}}</p>
          </div>
        </div>
      </div>
    </section>
    <!-- App Download -->
    <section class="section text-contrast app-download">
      <!-- <div class="shape-wrapper">
        <img src="@assets/images/smartphone-free-mockup.jpg" width="100%">
      </div> -->
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6 col-lg-6 pr-lg-7  download-disc">
              <h2 class="text-contrast align-items-center mt-0 mb-2">{{$t('DownloadHeader')}}</h2>
              <p class="text-light text-contrast align-items-center w-full xl:w-2/3"  style="font-size:1.2rem">{{$t('DownloadDisc')}}</p>
              <div class="mt-5">
                <a href="https://apps.apple.com/do/app/%D8%A8%D8%B5%D9%85%D8%AA%D9%83/id1504189608" target="_blank" class="bold download-btn btn btn-rounded btn-info shadow px-4 text-capitalize bg-white">APP STORE<img class="pl-2 pb-2" src="@assets/images/basmatk/app-store.svg" width="22px"></a>
              </div>
              <div class="mt-3">
                <a href="https://play.google.com/store/apps/details?id=com.basmtak&hl=en&gl=US"  target="_blank" class="bold download-btn btn btn-rounded btn-info shadow px-4 text-capitalize bg-white">PLAY STORE<img class="pl-2 pb-2" src="@assets/images/basmatk/play-store.svg" width="22px"></a>
              </div>
              <div class="mt-3">
                <a href="https://m.apkpure.com/ar/basmtak/com.basmtak"  target="_blank" class="bold download-btn btn btn-rounded btn-info shadow px-4 text-capitalize bg-white">APKPURE<img class="pl-2 pb-2" src="@assets/images/basmatk/apkpure.svg" width="22px"></a>
              </div>
              <div class="row mt-4 mt-md-5 d-none d-md-block">
                <a href="/register" :alt="$t('TryForAWeek')" class="font-semibold btn btn-rounded btn-lg btn-info shadow px-4 text-capitalize bg-white blue_text" >{{$t('TryForAWeek')}}<img class="pl-2" src="@assets/images/basmatk/chevrons-left.svg" width="22px"></a>
              </div>
            </div>
            <div class="col-md-6 col-lg-5 pb-7 pb-md-5 pt-3">
              <img src="@assets/images/basmatk/app-download.png" width="80%">
            </div>
          </div>
      </div>
      <div class="custom-shape-divider-bottom-1626156558">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
          <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
        </svg>
      </div>
    </section>

    </div>
</template>

<script>
import { swiper, swiperSlide } from 'vue-awesome-swiper'
import 'swiper/dist/css/swiper.min.css'
export default {
    components: {
    swiper,
    swiperSlide ,

    },
    data () {
    return {
      swiperOneOption:{
          autoplay: {
              delay: 2500,
              disableOnInteraction: true
          },
          pagination: {
            el: '.start-pagination',
            clickable: true,
          },
      },
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
          // effect: 'fade',
        },
    }

  },
  computed: {

  },
  methods: {
    toSlideOne(i) {
      this.$refs.mySwiperOne.swiper.slideTo(i, 0);
      window.scrollTo(0, 1350);
    },
    toSlide(i) {
      this.$refs.mySwiper.swiper.slideTo(i, 0)
    },
  }
}
</script>

<style>
/* Start Now ======================================================== */
.start-now{
   background-color: #0E69D3;
   position: relative;
   
}
.start-now .vx-card{
  background-color: #3791FA;
  color:#fff;
  border-radius: 1rem;
}

.start-now .vx-card:hover{
    background-color: #fff;
    border-color:#fff;
    color:#555555 ;
    cursor: pointer;
    transition: .2s;
}

.start-now .vx-card p{
  font-size: 12px;
  font-weight: 600;
  margin: 0;
}
.start-now .vx-card .main-steps{
    background: #0E77FF ;
    border-radius: 50%;
    padding: 5px 7px;
    position: absolute;
    top: -15px;
    right:45%;
    font-size: 15px;
}
.start-now .vx-card:hover .main-steps{
    background-color: #fff;
    color:#555555 ;
    cursor: pointer;
    transition: .2s;
}
.start-now .swiper-pagination-bullet{
  width: 10px;
  height: 10px;
  margin-right: 5px;
}
 .swiper-pagination-bullet-active{
  background:#fff !important;
  background-color: #fff !important;
  width: 13px;
  height: 13px;
}
.custom-shape-divider-top-1625989520 {
    position: absolute;
    top: -10px;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    transform: rotate(180deg);
    z-index:1
}

.custom-shape-divider-top-1625989520 svg {
    position: relative;
    display: block;
    width: calc(105% + 1.3px);
    height: 124px;
}

.custom-shape-divider-top-1625989520 .shape-fill {
    fill: #0E69D3;
}
@media (min-width: 768px){
  .start-now .container{
    padding-bottom: 0 !important;
  }
  .start-now .vx-card{
    border-radius: 2rem;
  }
  .start-now .vx-card .main-steps{
    right:40%;
  }
  .start-now .vx-card .main-steps-3{
    right:43%;
  }
}
/* Mobile App ======================================================== */
.mobile-app{
  background-color: #0E77FF;
  /* clip-path: ellipse(94% 100% at 50% 0%);
  z-index: 1;  */
}
.mobile-app .section-heading{
  margin-top: 6rem !important;
  margin-bottom: 6rem !important;
}
.mobile-app .vx-card{
  background: #fff;
}
.mobile-app .app-screenshot{
  width:100%;
}
@media (min-width: 1200px){
  .mobile-app .app-screenshot{
    width:70%;
  }
}
@media (min-width: 768px){
  .mobile-app{
    clip-path: ellipse(94% 100% at 50% 0%);
    z-index: 1; 
}
  .mobile-app .vx-card{
    width: 85%;
  }
}
@media (min-width:992px){
    .mobile-app .app-feat-left:hover{
      margin-left: 2rem !important;
      transition: .3s;
      box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;

    }
    .mobile-app .app-feat-right:hover{
      margin-left: -2rem !important;
      transition: .3s;
      box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }
}
/* Dashboard ====================================================== */
.dashboard{
 background-color: #0E69D3;
}
.dashboard .section-heading{
  margin-top: 1.5rem !important;
}
.dashboard .screenshots-slider{
  position: absolute; 
  top:17%; 
  right:12%; 
  z-index: 1;
}
@media (min-width: 768px){
  .dashboard{
    margin-top: -13rem;
    padding-bottom: 7rem;
  }
  .dashboard .section-heading{
    margin-top: 9rem !important;
  }
  .dashboard  .slider-section{
    margin-left: -8rem !important;
  }
  .dashboard .pagination{
    right: 2rem;
    top:2rem;
  }
}
@media (min-width: 992px){
  .dashboard .pagination{
  top:3rem; 
  }

}
@media (min-width: 1200px){
  .dashboard .pagination{
  top:5rem; 
  }
}
.items{
  position: absolute;
  z-index: 1;
  padding: 7px 20px 5px 0px;
  color: #ffff;
  font-weight:600;
  cursor: pointer;
}
.items:hover{
  background: #FFAF25;
  height: 38px;
  padding: 7px 15px 5px 20px;
  border-bottom-right-radius: 20px;
  border-top-right-radius: 20px;
  border-bottom-left-radius: 6px;
  border-top-left-radius: 6px;
  transition: .2s;
}
.task-management {
    left: 37%;
    top: 11%;
}
.task-management:hover{
  width: 118px;
  left: 35%;
}
.employees{
  top:34%;
  left:48%;
}
.employees:hover{
  left: 45%;
  width: 100px;
}
.reports{
  position: absolute;
  bottom:35%;
  right:35%;
  z-index: 1;
  padding: 7px 20px 5px 0px;
  color: #ffff;
  font-weight:600;
  cursor: pointer;
}
.branches{
  left: 18%;
  top:32%;
}
.branches:hover{
  height: 38px;
  width:80px; 
  left:14%;
  padding: 7px 15px 5px 20px;
  border-bottom-right-radius: 6px;
  border-top-right-radius: 6px;
  border-bottom-left-radius: 20px;
  border-top-left-radius: 20px;
  transition: .2s;
}
.right-items{
    position: absolute;
    z-index: 1;
    padding: 7px 20px 5px 0px;
    color: #ffff;
    font-weight:600;
    cursor: pointer;
}
.right-items:hover{
  background: #FFAF25;
  padding: 7px 15px 5px 20px;
  border-bottom-right-radius: 6px;
  border-top-right-radius: 6px;
  border-bottom-left-radius: 20px;
  border-top-left-radius: 20px;
  transition: .2s;
}
.document{
  bottom:35%;
  left:24%;
}
.document:hover{
  width:100px;
  left:21%;
  bottom:34%;
  height: 38px;
}
.settings{
  left:36%;
  bottom:14%;
}
.settings:hover{
  width:85px;
  left:33%;
  bottom:13%;
  height: 36px;
}
@media (max-width: 1200px){
      .items:hover{
    padding: 5px 15px 5px 15px;
    height: 33px;
  }
  .task-management{
    left: 36%;
    top: 10%;
  }
  .task-management:hover{
    width: 100px;
    padding: 5px 0px 5px 15px;
  }
  .employees{
    top:33%;
    left:45%;
  }
  .reports{
    bottom:34%;
    right:34%;
  }
  .branches{
    top:31%;
  }
  .branches:hover{
      left: 11%;
      height: 35px;
  }
  .document{
    bottom:34%;
    left:23%;
  }
  .document:hover{
      left:17%;
      height: 33px;
  }
  .settings{
      left:34%;
      bottom:13%;
  }
  .settings:hover{
      left:30%;
      height: 31px;
  }
}
/* Download App =================================================== */
.app-download{
  background: #0872FA;
}
.app-download .download-disc{
  justify-content: center;
  text-align: center;
 
}
/* @media (max-width: 576px){
  .app-download .download-disc{
    justify-content: center;
    text-align: center;
  }  
} */
@media (min-width: 768px){
  .app-download{
    clip-path: ellipse(90% 100% at 50% 100%);
    margin-top: -10rem;
  }
  .app-download .download-disc{
    justify-content:flex-start;
    text-align: left !important;
    padding-left: 4rem !important;
    /* text-align: center; */
  } 

}
.app-download .download-btn{
  color:#0e77ff;
  font-size: .9rem;
  padding: .7rem 2rem .5rem 2rem;
  /* padding-bottom: .5rem; */
  width:160px;
}
.custom-shape-divider-bottom-1626156558 {
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
}

.custom-shape-divider-bottom-1626156558 svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 136px;
}

.custom-shape-divider-bottom-1626156558 .shape-fill {
    fill: #FFFFFF;
}
</style>
