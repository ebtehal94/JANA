
<template>
  <div>  
    <!-- Help Center --> 
    <section class="section help-center">
      <div class="container pt-0">
        <div class="row help-center-box-container">
          <div class="col w-full md:w-1/3  mb-base">
            <vx-card class="text-center cursor-pointer help-center-box" @click="$emit('pageChanged', 1)">
              <img src="@assets/images/basmatk/system.svg" width="90" height="90" class="image">
              <h4 class="mb-2">{{$t('HelpCenterBox1Title')}}</h4>
              <p>{{ $t('HelpCenterBox1Disc')}}</p>
            </vx-card>
          </div>
          <div class="col w-full md:w-1/3  mb-base center-box">
            <vx-card class="text-center cursor-pointer help-center-box" @click="$emit('pageChanged', 2)">
              <img src="@assets/images/basmatk/FAQ.svg" width="90" height="90" class="image">
              <h4 class="mb-2">{{$t('HelpCenterBox2Title')}}</h4>
              <p>{{ $t('HelpCenterBox2Disc')}}</p>
            </vx-card>
          </div>
          <div class="col w-full md:w-1/3  mb-base">
            <vx-card class="text-center cursor-pointer help-center-box" @click="$emit('pageChanged', 3)">
              <img src="@assets/images/basmatk/technical-support.svg" width="90" height="90" class="image">
              <h4 class="mb-2">{{$t('HelpCenterBox3Title')}}</h4>
              <p>{{ $t('HelpCenterBox3Disc')}}</p>
            </vx-card>
          </div>
        </div>
      </div>
    </section>

  </div>
</template>



<script>

export default{
  components: {

    },
    props:{
      selectedPage: {
        default: 2
      }
    },
  data () {
    return {
      // searchQuery: '',
      
    }

  },
  computed: {

  },
  
  methods: {

  },
  created(){

  }

}
</script>

<style lang="scss">

.help-center{
  background: #fff;
}
.help-center .container{
  padding-bottom:0
}
.help-center-box-container{
  width:100%;
  margin: 4rem auto 0;
}
@media (min-width: 1200px){
  .help-center-box-container{
    width:80%;
  }
}
.help-center-box{
  background: #fff !important;
  border-bottom: 0.1px solid #DFDFDF;
  border-radius: 12px !important;
  border-right: .1px solid #dfdfdf;
  border-left: .1px solid #dfdfdf;
  border-top: .1px solid #dfdfdf24
}
.help-center-box:hover{
    border: 0 !important;
    box-shadow: rgba(14, 119, 255, 15%) 0px 8px 24px;
    // box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
}
 .center-box{
  margin-left: 0;
  margin-right: 0;
}

@media (min-width: 992px){
  .center-box{
    margin-left: 1.5rem !important;
    margin-right: 1.5rem !important;
  }
}
.help-center-box h4{
  font-size: 1.1rem;
  font-weight: 700;
  color:#333;
}
.help-center-box p{
  font-size: .8rem;
  font-weight: 500;
  color:#A1A1A1;
  margin: 1rem 1.2rem;
}
.help-center-box .image{
    margin-left: auto;
    margin-right: auto;
    margin-top: -3rem;
    margin-bottom: 1rem;
}

</style>

