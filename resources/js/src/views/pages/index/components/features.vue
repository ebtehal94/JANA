<template>
    <section class="section features-carousel mb-md-5">
      <div class="container pt-0">
        <div class="swiper-container" data-sw-show-items="4" data-sw-autoplay="3500" data-sw-loop="true" data-sw-nav-arrows=".features-nav" data-sw-breakpoints='{"1024": {"slidesPerView": 4,"spaceBetween": 40},"992": {"slidesPerView": 4,"spaceBetween": 15},"768": {"slidesPerView": 4.5,"spaceBetween": 15},"576": {"slidesPerView": 1.5,"spaceBetween": 10}}'>
          <div class="section-heading mb-4 text-center">
            <h5 class="extra-bold text-uppercase blue_text" style="font-size: 1.7rem;"><span style="color: #4A4A4A">{{$t('FeaturesTitle2')}}</span> {{$t('FeaturesTitle')}}</h5>
            <p>{{$t('FeaturesDisc')}}</p>
          </div>
          <swiper class="swiper-wrapper px-1" :options="swiperTwoOption" ref="mySwiperTwo" :dir="$vs.rtl ? 'rtl' : 'ltr'" :key="$vs.rtl">
            <swiper-slide class="swiper-slide px-2 px-sm-1">
              <vx-card class="border-0 text-left">
                <span>{{$t('Feature11')}}</span>
                <h5 class="mt-3">{{$t('Feature1')}}</h5>
                <hr>
                <p>{{$t('Feature1Disc')}}</p>
              </vx-card>
            </swiper-slide>
              <swiper-slide class="swiper-slide px-2 px-sm-1">
                <vx-card class="border-0 text-left">
                  <span>{{$t('Feature22')}}</span>
                  <h5 class="mt-3">{{$t('Feature2')}}</h5>
                  <hr>
                  <p>{{$t('Feature2Disc')}} </p>
                </vx-card>
              </swiper-slide>
              <swiper-slide class="swiper-slide px-2 px-sm-1">
                <vx-card class="border-0 text-left">
                  <span>{{$t('Feature33')}}</span>
                  <h5 class="mt-3">{{$t('Feature3')}}</h5>
                  <hr>
                  <p>{{$t('Feature3Disc')}}</p>
                </vx-card>
              </swiper-slide>
              <!-- <div class="swiper-pagination swiper-pagination-white" slot="pagination"></div> -->
              <!-- <div class="swiper-button-prev swiper-button-white" slot="button-prev"></div> -->
              <!-- <div class="swiper-button-next swiper-button-white" slot="button-next"></div> -->
          </swiper>
        </div>
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
.features-carousel{
  background: #fff !important
}
.features-carousel .swiper-wrapper .vx-card{
  background: #fff;
  position: relative;
  max-height: 230px;
  box-shadow: none;
  border-radius: 3px;
  cursor: pointer;
}
.features-carousel .swiper-wrapper .vx-card:hover{
  border-radius: 3px;
  box-shadow: 0 0.5rem 1rem rgb(22 28 45 / 15%) !important;
  transition:all .3s;
}
.features-carousel .swiper-wrapper span{
  font-size: .8rem;
  display: block;
  padding: 5px 10px;
  border-radius: 20px;
  background: #0083dd30;
  color:#0083dd;
  position: absolute;
  top:-10px
}
.features-carousel .swiper-wrapper .vx-card:hover span{
  background: #0083dd;
  color:#fff;
  transition:all .3s;
}
.features-carousel .swiper-wrapper h5{
  font-weight: 600;
}
.features-carousel .swiper-wrapper p{
  font-size: .8rem;
  line-height: 1.8;
}
.features-carousel hr{
  border-top: 3px solid #0083dd;
  width: 40%;
}
</style>
