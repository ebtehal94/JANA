<template>
 <!-- Footer -->
 <div>
    <footer class="site-footer section block">
      <div class="container py-4">
        <div class="row pt-3 text-left">
          <div class="col-lg-4 col-md-6">
            <div class="footer-title">
              <h2>{{$t('BasmatkApp')}}</h2>
            </div>
            <p class="pl-3">{{$t('BasmatkDisc')}}</p>
            <!-- <p class="mt-2 mb-0 text-secondary small">{{$t('FooterALLRAS')}} <a href="http://clouds-line.com/" class="d-inline">خط الغيوم للإتصالات وتقنية المعلومات</a>   2020 ©</p> -->
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="footer-title text-md-center">
              <h2>{{$t('MainLink')}}</h2>
            </div>
            <nav class="nav justify-content-md-center">
              <ul class="list-none">
                <li><a class="nav-item nav-link text-contrast" href="/knowledge-base">{{$t('FooterExplantionLibrary')}}</a></li>
                <li><a class="nav-item nav-link text-contrast" href="#">{{$t('FooterTermsAndConditions')}}</a></li>
                <li><a class="demo-2 nav-item nav-link text-contrast" href="#">{{$t('FooterContactUs')}}</a></li>
                <!-- <li><a class="nav-item nav-link text-contrast" href="http://clouds-line.com/">{{$t('FooterCloudsLine')}}</a></li> -->
              </ul>
            </nav>
          </div>
          <!-- <div class="col-lg-2 col-md-6">
            <div class="footer-title"> 
              <h2>{{$t('FooterContactUs')}}</h2>
            </div>
            <nav class="nav justify-content-md-start">
              <li><a href="tel:+966557710822" dir="ltr" class="nav-item nav-link text-contrast">+966 55 771 0822</a></li>
              <br>
              <li><a href="tel:+966550022547" dir="ltr" class="nav-item nav-link text-contrast">+966 55 002 2547</a></li>
              <br>
              <li><a href="tel:+966559360235" dir="ltr" class="nav-item nav-link text-contrast">+966 55 936 0235</a></li>
            </nav>
          </div> -->
          <div class="col-lg-4 col-md-6 social-section">
            <div class="footer-title"> 
              <h2>{{$t('FooterContactUs')}}</h2>
            </div>
             <nav class="nav justify-content-md-start">
              <li><a href="tel:920033421" dir="ltr" class="nav-item nav-link text-contrast font-semibold">920033421</a></li>
            </nav>
            <div class="social-title pl-2 pt-3"> <h4 class="text-contrast">{{$t('ContactSoicalMedia')}}</h4></div>
            <a href="https://www.instagram.com/basmtakApp/" target="_blank" class="px-2">
              <feather-icon icon="InstagramIcon" svgClasses="h-4 w-3 mx-2" class="social-icon"/>
            </a>
            <a href="https://twitter.com/basmtakApp" target="_blank" class="px-2">
              <feather-icon icon="TwitterIcon" svgClasses="h-4 w-3 mx-2" class="social-icon"/>
            </a>
            <a href="https://www.youtube.com/channel/UCF278H86-cQ4HzRyMfF02IQ" target="_blank" class="px-2">
              <feather-icon icon="YoutubeIcon" svgClasses="h-4 w-3 mx-2" class="social-icon"/>
            </a>
            <a href="https://www.facebook.com/BasmtakApp/" target="_blank" class="px-2">
              <feather-icon icon="FacebookIcon" svgClasses="h-4 w-3 mx-2" class="social-icon"/>
            </a>              
          </div>
        </div>
        <hr>
        <p class="mt-2 mb-0 text-contrast pl-3 text-left">{{$t('FooterALLRAS')}} <a href="http://clouds-line.com/" class="d-inline text-contrast">{{$t('CopyRight')}}</a>   2020 ©</p>
      </div>
    </footer>
 </div>
</template>

<script>
export default {
  computed: {

  },
  methods: {

  }
}
</script>

<style>
 .site-footer {
  background-color: #0E77FF;
  color:#fff;
  font-size: .9em; 
  }
  .site-footer h4 {
    margin-bottom: 15px; 
  }
  .site-footer ul{
    list-style: none;
  }
  .site-footer .footer-title h2{
    font-size: 1.5rem;
    font-weight: 800;
    color: #fff;
    padding-left: 1rem;
   }
  .site-footer hr{
    border-top: 2px solid #fff;
    width: 90%;
    margin-right: 1rem;
    margin-left: 1rem;
  }
.social-title h4{
  font-size:1rem;
}
/* .social-section a{
     background: #fff;
    border-radius: 50%;
     padding: 7px 0px 3px 0px;
    text-align: center;
} */
.social-icon{
  color:#fff;
  background-color: #23275A;
  border-radius: 50%;
  padding: 5px 0px;
}
.social-icon:hover{
  color:#23275A;
  background-color: #fff; 
}
</style>
