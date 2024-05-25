<template>
    <div>
        
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

    }

  },
  computed: {

  },
  methods: {

  }
}
</script>

<style>

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
