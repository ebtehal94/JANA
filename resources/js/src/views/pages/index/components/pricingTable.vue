<template>
 <section class="section block pricing-table">
      <div class="container py-5">
        <div class="section-heading text-center">
          <h5 class="extra-bold text-uppercase blue_text" style="font-size: 1.7rem;">{{$t('PricingTitle')}}</h5>
          <p>{{$t('PricingDisc')}}</p>
        </div>
        <div class="row gap-y align-items-center">
          <div class="col-xl-8 mx-lg-auto">
            <div class="row ml-0 ml-xl-0 ">
              <div class="col-lg-4 ml-md-n6 mb-3 d-none d-lg-block">
                <vx-card class="pricing basic-plan" style="opacity:.4;">
                  <h2 class=" basic-title mb-4 text-center font-semibold">{{$t('PricingPlan1Title')}}</h2>
                  <h3 class="second-title text-left">{{$t('PricingPlaneDetails')}}</h3>
                  <hr>
                  <div class="row">         
                    <div class="col-6 text-left">
                      <ul class="list-unstyled pricing-list">
                        <li class="mb-2">{{$t('PricingPlan2Feat1')}}</li>
                        <li class="mb-2">{{$t('PricingPlan2Feat2')}}</li>
                        <li class="mb-2">{{$t('PricingPlan2Feat3')}}</li>
                        <li class="mb-2">{{$t('PricingPlan2Feat4')}}</li>
                        <li class="mb-2">{{$t('PricingPlan2Feat5')}}</li>
                        <li class="mb-2">{{$t('PricingPlan2Feat6')}}</li>
                      </ul>
                    </div>
                    <div class="col-6 text-right">
                      <ul class="list-unstyled pricing-list">
                        <li class="mb-2"><span class="value unlimited">{{$t('Unlimited')}}</span></li>
                        <li class="mb-2"><span class="value unlimited">{{$t('Unlimited')}}</span></li>
                        <li class="mb-2"><span class="value unlimited">{{$t('Unlimited')}}</span></li>
                        <li class="mb-2"><span class="value unlimited">{{$t('Unlimited')}}</span></li>
                        <li class="mb-2"><span class="value limited">{{$t('Limited')}}</span></li>
                        <li class="mb-2"><span class="value">{{$t('Subscription')}}</span></li>
                      </ul>
                      <!-- <div class="pricing-value mr-3">1845.00<span class="price"> {{$t('Pricing')}} </span></div> -->
                    </div>
                  </div>
                  <hr> 
                  <div class="row">
                    <div class="col-6 text-left">
                      <div>
                        <h4 class="basic-value">3<sup>.7</sup><span style="font-size:.6rem;">{{$t('Pricing')}}</span></h4> 
                      </div>
                    </div>
                    <div class="col-6 text-right">
                      <ul class="list-unstyled text-center">
                        <li class="mb-2 small">{{$t('Monthly')}}</li>
                        <li class="mb-2 small">{{$t('ForEmployee')}}</li>
                      </ul>
                    </div>
                  </div>
                  <div class="row">
                    <div class="w-full mx-3">
                      <a href="/register" class="btn gray-btn mt-3 w-full">{{$t('ChoosePlan')}}</a>
                    </div>
                  </div>
                </vx-card>
              </div>
              <div class="col-lg-4 mb-3" style="z-index:1">
                <vx-card class="pricing basic-plan border-0" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                  <h2 class=" basic-title mb-4 text-center font-semibold">{{$t('PricingPlan1Title')}}</h2>
                  <h3 class="second-title text-left">{{$t('PricingPlaneDetails')}}</h3>
                  <hr>
                  <div class="row">         
                    <div class="col-6 text-left">
                      <ul class="list-unstyled pricing-list">
                        <li class="mb-2">{{$t('PricingPlan2Feat1')}}</li>
                        <li class="mb-2">{{$t('PricingPlan2Feat2')}}</li>
                        <li class="mb-2">{{$t('PricingPlan2Feat3')}}</li>
                        <li class="mb-2">{{$t('PricingPlan2Feat4')}}</li>
                        <li class="mb-2">{{$t('PricingPlan2Feat5')}}</li>
                        <li class="mb-2">{{$t('PricingPlan2Feat6')}}</li>
                      </ul>
                    </div>
                    <div class="col-6 text-right">
                      <ul class="list-unstyled pricing-list">
                        <li class="mb-2"><span class="value unlimited">{{$t('Unlimited')}}</span></li>
                        <li class="mb-2"><span class="value unlimited">{{$t('Unlimited')}}</span></li>
                        <li class="mb-2"><span class="value unlimited">{{$t('Unlimited')}}</span></li>
                        <li class="mb-2"><span class="value unlimited">{{$t('Unlimited')}}</span></li>
                        <li class="mb-2"><span class="value limited">{{$t('Limited')}}</span></li>
                        <li class="mb-2"><span class="value">{{$t('Subscription')}}</span></li>
                      </ul>
                      <!-- <div class="pricing-value mr-3">1845.00<span class="price"> {{$t('Pricing')}} </span></div> -->
                    </div>
                  </div>
                  <hr> 
                  <div class="row">
                    <div class="col-6 text-left">
                      <div>
                        <h4 class="basic-value">3<sup>.7</sup><span style="font-size:.6rem;">{{$t('Pricing')}}</span></h4> 
                      </div>
                    </div>
                    <div class="col-6 text-right">
                      <ul class="list-unstyled text-center">
                        <li class="mb-2 small">{{$t('Monthly')}}</li>
                        <li class="mb-2 small">{{$t('ForEmployee')}}</li>
                      </ul>
                    </div>
                  </div>
                  <div class="row">
                    <div class="w-full mx-3">
                      <a href="/register" class="btn green-btn mt-3 w-full">{{$t('ChoosePlan')}}</a>
                    </div>
                  </div>
                </vx-card>
              </div>
              <div class="col-lg-4 ml-md-0 mr-lg-n6 mb-3 d-none d-lg-block">
                <vx-card class="pricing basic-plan"  style="opacity:.4;">
                  <h2 class="basic-title mb-4 text-center font-semibold">{{$t('PricingPlan1Title')}}</h2>
                  <h3 class="second-title text-left">{{$t('PricingPlaneDetails')}}</h3>
                  <hr>
                  <div class="row">         
                    <div class="col-6 text-left">
                      <ul class="list-unstyled pricing-list">
                        <li class="mb-2">{{$t('PricingPlan2Feat1')}}</li>
                        <li class="mb-2">{{$t('PricingPlan2Feat2')}}</li>
                        <li class="mb-2">{{$t('PricingPlan2Feat3')}}</li>
                        <li class="mb-2">{{$t('PricingPlan2Feat4')}}</li>
                        <li class="mb-2">{{$t('PricingPlan2Feat5')}}</li>
                        <li class="mb-2">{{$t('PricingPlan2Feat6')}}</li>
                      </ul>
                    </div>
                    <div class="col-6 text-right">
                      <ul class="list-unstyled pricing-list">
                        <li class="mb-2"><span class="value unlimited">{{$t('Unlimited')}}</span></li>
                        <li class="mb-2"><span class="value unlimited">{{$t('Unlimited')}}</span></li>
                        <li class="mb-2"><span class="value unlimited">{{$t('Unlimited')}}</span></li>
                        <li class="mb-2"><span class="value unlimited">{{$t('Unlimited')}}</span></li>
                        <li class="mb-2"><span class="value limited">{{$t('Limited')}}</span></li>
                        <li class="mb-2"><span class="value">{{$t('Subscription')}}</span></li>
                      </ul>
                      <!-- <div class="pricing-value mr-3">1845.00<span class="price"> {{$t('Pricing')}} </span></div> -->
                    </div>
                  </div>
                  <hr> 
                  <div class="row">
                    <div class="col-6 text-left">
                      <div>
                        <h4 class="basic-value">3<sup>.7</sup><span style="font-size:.6rem;">{{$t('Pricing')}}</span></h4> 
                      </div>
                    </div>
                    <div class="col-6 text-right">
                      <ul class="list-unstyled text-center">
                        <li class="mb-2 small">{{$t('Monthly')}}</li>
                        <li class="mb-2 small">{{$t('ForEmployee')}}</li>
                      </ul>
                    </div>
                  </div>
                  <div class="row">
                    <div class="w-full mx-3">
                      <a href="/register" class="btn gray-btn mt-3 w-full">{{$t('ChoosePlan')}}</a>
                    </div>
                  </div>
                </vx-card>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-8 mx-lg-auto">
            <div class="py-4 px-4 pricing">
              <h2 class="mb-4 text-center font-semibold">{{$t('ChooseEmployee')}}</h2>
                <div class="row">
                  <div class="col justify-center flex">
                    <a href=""><img src="@assets/images/basmatk/minus.svg"></a>
                    <input class="mx-2 text-center counter" type="text" value="1">
                    <a href=""><img src="@assets/images/basmatk/plus.svg"></a>
                  </div>
                </div>
                <h3 class="second-title text-left">{{$t('pricingFeatures')}}</h3>
              <hr>
              <div class="row">         
                <div class="col-6 text-left">
                  <ul class="list-unstyled pricing-list">
                    <li class="">
                      <input class="styled-checkbox" id="styled-checkbox-1" type="checkbox" value="value1">
                      <label for="styled-checkbox-1">{{$t('PricingPlan1Feat1')}}</label>
                    </li>
                    <li class="">
                      <input class="styled-checkbox" id="styled-checkbox-2" type="checkbox" value="value2">
                      <label for="styled-checkbox-2">{{$t('PricingPlan1Feat2')}}</label>
                    </li>
                    <li class="">
                      <input class="styled-checkbox" id="styled-checkbox-3" type="checkbox" value="value3">
                      <label for="styled-checkbox-3">{{$t('PricingPlan1Feat3')}}</label>
                    </li>
                    <li class="">
                      <input class="styled-checkbox" id="styled-checkbox-4" type="checkbox" value="value4">
                      <label for="styled-checkbox-4">{{$t('PricingPlan1Feat4')}}</label>
                    </li>
                    <li class="">
                      <input class="styled-checkbox" id="styled-checkbox-5" type="checkbox" value="value5">
                      <label for="styled-checkbox-5">{{$t('PricingPlan1Feat5')}}<span class="value new ml-2">{{$t('New')}}</span></label>
                    </li>
                  </ul>
                </div>
                <div class="col-6 text-right">
                  <ul class="list-unstyled ">
                    <li class="bottom-margin"><span class="value">+2 {{$t('Pricing')}}</span></li>
                    <li class="bottom-margin"><span class="value">+2 {{$t('Pricing')}}</span></li>
                    <li class="bottom-margin"><span class="value">+2 {{$t('Pricing')}}</span></li>
                    <li class="bottom-margin"><span class="value">+2 {{$t('Pricing')}}</span></li>
                    <li class="bottom-margin"><span class="value">+2 {{$t('Pricing')}}</span></li>
                  </ul>
                  <!-- <div class="pricing-value mr-3">1845.00<span class="price"> {{$t('Pricing')}} </span></div> -->
                </div>
              </div>
              <hr> 
              <div class="row">
                <div class="col-6 text-left">
                  <ul class="list-unstyled ">
                    <li class="mb-2 blue_text">{{$t('Total')}}</li>
                    <li class="mb-2 small">{{$t('Tax')}}</li>
                  </ul>
                </div>
                <div class="col-6 text-right">
                  <div>
                    <h4 class="basic-value">1854.00 <span style="font-size:.6rem;">{{$t('Pricing')}}</span></h4> 
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="w-full mx-3">
                  <a href="/register" class="btn blue-btn normal mt-3 w-full">{{$t('continue')}}</a>
                </div>
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
.pricing-table{
  background: #fff !important;
}
.pricing-table .section-heading{
  margin-bottom: 3rem !important;
}
.pricing{
  border:1px solid #C2C2C2;
  border-radius: 12px;
  color:#C2C2C2;
  font-weight: 600;
}
.pricing h2, .second-title{
  font-size:.9rem;
  color:#C2C2C2;
}
.pricing .counter{
  width: 20%;
  border-radius: 20px;
  border: 1px solid #c2c2c2;
  color: #666;
}
.pricing hr{
  border-top:1.2px solid #C2C2C2;
}
.pricing .pricing-list{
  font-size: .7rem;
}
.bottom-margin{
  margin-bottom: 3px;
}
.styled-checkbox {
  position: absolute;
  opacity: 0;
}
.styled-checkbox + label {
  position: relative;
  cursor: pointer;
  padding: 0;
}
.styled-checkbox + label:before {
  content: "";
  margin-right: 10px;
  display: inline-block;
  vertical-align: text-top;
  width: 17px;
  height: 16px;
  background: white;
  border:1px solid #c2c2cc;
  border-radius: 50%;
}
.styled-checkbox label:before {
  background: #006BCD;
}
.styled-checkbox:checked + label:before {
  background: #006BCD;
}

.styled-checkbox:checked + label:after {
  content: "✓";
  position: absolute;
  left: 5px;
  top: 0px;
  color: #fff;
  font-size: 11px;
}
.pricing .value{
  font-size: .6rem;
  color: #666;
  background: #E8E8E8;
  padding: 0 .8rem;
  border-radius: 20px;
}
.pricing .new{
  color:#fff;
  background:#00CA77;
}
.pricing .btn{
  color:#fff;
  font-size: 1rem;
}
.pricing .blue-btn{
  background: #0083dd !important;
}
.pricing .green-btn{
  background: #00CA77 !important;
  color:#fff;
  font-size: 1rem;
}
.pricing .total-price{
  color: #5D5D5D;
  font-weight: 500;
}
.basic-plan{
  background: #fff;
}
.basic-plan .basic-title{
  color: #666;
}
.basic-plan .unlimited{
  color:#039459;
  background:#00ca7745;
}
.basic-plan .limited{
  background: #fa79005c;
  color: #FA7800;
}
.basic-plan .pricing-list{
  font-size: 9px;
}
.basic-plan .basic-value{
  font-size: 2.5rem;
  color:#5D5D5D;
}
.basic-plan .green-btn{
  background: #00CA77 !important;
}
.basic-plan .gray-btn{
  background:#E8E8E8 !important;
}
</style>
