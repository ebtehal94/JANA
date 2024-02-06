<template>
    <section class="bg-white clients">
      <div class="container">
          <div class="vx-row flex justify-center text-center">
            <h5 class=" bold text-uppercase  mb-4">{{$t('SuccessPartners')}}</h5>
          </div>
          <swiper class="vx-row flex flex-wrap justify justify-center items-center px-1" :options="swiperTwoOption" ref="mySwiperTwo" :dir="$vs.rtl ? 'rtl' : 'ltr'" :key="$vs.rtl">
              <swiper-slide class="vx-col w-1/2 md:w-1/6 px-2 justify justify-center items-center">
                <img class="responsive" src="@assets/images/clients/1.jpg" alt="banner">
              </swiper-slide>
              <swiper-slide class="vx-col w-1/2 md:w-1/6 px-2 justify justify-center items-center">
                <img class="responsive" src="@assets/images/clients/2.jpg"  alt="banner">
              </swiper-slide>
              <swiper-slide class="vx-col w-1/2 md:w-1/6 px-2 justify justify-center items-center">
                <img class="responsive" src="@assets/images/clients/3.jpg"  alt="banner">
              </swiper-slide>
              <swiper-slide class="vx-col w-1/2 md:w-1/6 px-2 justify justify-center items-center">
                <img class="responsive" src="@assets/images/clients/4.jpg"  alt="banner">
              </swiper-slide>
               <swiper-slide class="vx-col w-1/2 md:w-1/6 px-2 justify justify-center items-center">
                <img class="responsive" src="@assets/images/clients/5.jpg"  alt="banner">
              </swiper-slide>
               <swiper-slide class="vx-col w-1/2 md:w-1/6 px-2 justify justify-center items-center">
                <img class="responsive" src="@assets/images/clients/6.jpg"  alt="banner">
              </swiper-slide>
               <swiper-slide class="vx-col w-1/2 md:w-1/6 px-2 justify justify-center items-center">
                <img class="responsive" src="@assets/images/clients/7.jpg"  alt="banner">
              </swiper-slide>
               <swiper-slide class="vx-col w-1/2 md:w-1/6 px-2 justify justify-center items-center">
                <img class="responsive" src="@assets/images/clients/8.jpg"  alt="banner">
              </swiper-slide>
              <!-- <div class="swiper-pagination swiper-pagination-white" slot="pagination"></div> -->
              <div class="swiper-button-prev swiper-button-white" slot="button-prev"></div>
              <div class="swiper-button-next swiper-button-white" slot="button-next"></div>
            </swiper>
      </div> 
    </section>
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
          swiperTwoOption: {
          slidesPerView: 4,
          centeredSlides: true,
          spaceBetween: 30,
          loop: true,
          // slidesOffsetBefore: 0,
          // centeredSlides: true,
          autoplay: {
              delay: 1500,
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

  }
}
</script>

<style>
.clients h5{
  font-size: 2rem ;
  color: #4A4A4A 
}
@media (min-width: 768px){
  .clients .container{
    padding-top: 0 !important;
  }
}
</style>
