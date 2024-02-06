<template>
 <!-- FAQ -->
    <section class="section faq text-left">
      <div class="container bring-to-front">
        <div class="row ">
          <div class="col mb-2">
            <h2>{{$t('FaqTitle')}}  <span class="bold">{{$t('FaqTitle2')}}</span></h2>
            <p class="lead">{{$t('FaqDisc')}} </p>
            <p class="text-muted">{{$t('FaqDisc2')}}</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="accordion accordion-clean" id="common-faqs-accordion">
              <div class="card mb-3">
                <vs-collapse-item>
                  <div class="card-header" slot="header">
                    <a href="" class="card-title btn">{{$t('Faq1')}} </a>
                  </div>
                  <div id="q1" class="collapse show">
                    <div class="card-body mb-0">{{$t('Faq1ans1')}}</div>
                  </div>
                </vs-collapse-item>
              </div>
              <div class="card mb-3">
                <vs-collapse-item>
                  <div class="card-header" slot="header">
                    <a href="" class="card-title btn">{{$t('Faq2')}} </a>
                  </div>
                  <div id="q2" class="collapse show">
                    <div class="card-body mb-0">{{$t('Faq2ans1')}}</div>
                  </div>
                </vs-collapse-item>
              </div>
              <div class="card mb-3">
                <vs-collapse-item>
                <div class="card-header" slot="header">
                  <a href="" class="card-title btn">{{$t('Faq3')}}</a>
                </div>
                <div id="q3" class="collapse show">
                  <div class="card-body"> {{$t('Faq3ans1')}} </div>
                </div>
                </vs-collapse-item>
              </div>
              <div class="card mb-3">
                <vs-collapse-item>
                <div class="card-header" slot="header">
                  <a href="" class="card-title btn">{{$t('Faq4')}}</a>
                </div>
                <div id="q4" class="collapse show">
                  <div class="card-body"> {{$t('Faq4ans1')}} </div>
                </div>
                </vs-collapse-item>
              </div>
              <div class="card mb-3">
                <vs-collapse-item>
                  <div class="card-header" slot="header">
                    <a href="" class="card-title btn">{{$t('Faq5')}} </a>
                  </div>
                  <div id="q5" class="collapse show">
                    <div class="card-body mb-0">{{$t('Faq5ans1')}}</div>
                  </div>
                </vs-collapse-item>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="accordion accordion-clean" id="common-faqs-accordion">
              <div class="card mb-3">
                <vs-collapse-item>
                  <div class="card-header" slot="header">
                    <a href="" class="card-title btn">{{$t('Faq6')}} </a>
                  </div>
                  <div id="q6" class="collapse show">
                    <div class="card-body mb-0">{{$t('Faq6ans1')}}</div>
                  </div>
                </vs-collapse-item>
              </div>
              <div class="card mb-3">
                <vs-collapse-item>
                  <div class="card-header" slot="header">
                    <a href="" class="card-title btn">{{$t('Faq7')}} </a>
                  </div>
                  <div id="q7" class="collapse show">
                    <div class="card-body mb-0">{{$t('Faq7ans1')}}</div>
                  </div>
                </vs-collapse-item>
              </div>
              <div class="card mb-3">
                <vs-collapse-item>
                <div class="card-header" slot="header">
                  <a href="" class="card-title btn">{{$t('Faq8')}}</a>
                </div>
                <div id="q8" class="collapse show">
                  <div class="card-body"> {{$t('Faq8ans1')}} </div>
                </div>
                </vs-collapse-item>
              </div>
              <div class="card mb-3">
                <vs-collapse-item>
                <div class="card-header" slot="header">
                  <a href="" class="card-title btn">{{$t('Faq9')}}</a>
                </div>
                <div id="q9" class="collapse show">
                  <div class="card-body"> {{$t('Faq9ans1')}} </div>
                </div>
                </vs-collapse-item>
              </div>
              <div class="card mb-3">
                <vs-collapse-item>
                <div class="card-header" slot="header">
                  <a href="" class="card-title btn">{{$t('Faq10')}}</a>
                </div>
                <div id="q10" class="collapse show">
                  <div class="card-body"> {{$t('Faq10ans1')}} </div>
                </div>
                </vs-collapse-item>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

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
.faq{
  background-color: #f8f8f8;
}
.faq .card-title{
  color:#0E77FF;
}
</style>
