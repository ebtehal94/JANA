<template>
    <div>

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
</style>
