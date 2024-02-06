
<template>
  <div>

    <section class="section system-section">
      <div class="container pt-0">
        <div class="row system-section-box">
          <div class="col w-full mb-base">
            <div class="section-heading text-center">
              <h5 class="bold " style="font-size: 1.3rem; color: #4A4A4A">{{$t('SystemTitle')}}</h5>
              <p>{{$t('BasmatkDisc')}}</p>
            </div>
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
  data () {
    return {

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
.system-section{
  background: #fff !important;
}
.system-section .container{
  padding-bottom: 0 !important;
}
.system-section .system-section-box{
  width: 80%;
  margin-left: auto;
  margin-right: auto;
}
.system-section .section-heading{
  margin-top: 30px !important;
  margin-bottom: 30px !important;
}
.system-section .section-heading p{
  font-size: 1rem;
}

</style>

