<template>
    <div>        
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

    </div>
</template>

<script>

export default {
    components: {


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
    /* fill: #0E69D3; */
    fill: #fff

}
</style>
