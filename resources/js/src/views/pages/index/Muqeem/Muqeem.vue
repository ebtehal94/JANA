<!-- =========================================================================================
    File Name: Muqeem.vue
    Description: Muqeem Page  
========================================================================================== -->


<template>
    <div class="flex w-full vx-row no-gutter items-center justify-center" id="page-login">
      <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-2/4 xl:w-11/12 sm:m-0 m-5">
        <div class="vx-row m-4">
            <i18n class="text-bold"/>
        </div>
        <vx-card class="muqeem rounded-corner shadow-none my-4">
            <div class="vx-row no-gutter">  
                <vs-tabs alignment="right" class="vs-tabs-position-left tabs-shadow-none">
                    <vs-tab :label="$t('IssueVisa')">
                        <div>
                            <IssueVisa />
                        </div>
                    </vs-tab>
                    <vs-tab :label="$t('CancleVisa')">
                        <div>
                            <CancleVisa/>
                        </div>
                    </vs-tab>
                    <vs-tab :label="$t('ReprintVisa')">
                        <div>
                            <ReprintVisa/>
                        </div>
                    </vs-tab>
                    <vs-tab label="Ecosystem">
                        <div></div>
                    </vs-tab>
                </vs-tabs>
        
            </div>
        </vx-card>
      </div>
    </div>
  </template>
  
  
  
  <script>
  import icon from '../../../../layouts/components/icon.vue';
  import I18n  from "@/layouts/components/navbar/components/I18n.vue"
  import axios from "@/axios.js";

  import IssueVisa from './components/IssueVisa.vue'
  import CancleVisa from './components/CancleVisa.vue';
  import ReprintVisa from './components/ReprintVisa.vue';
  import CancleFinalExit from './components/CancleFinalExit.vue';

  export default{
    components: {
      icon,
      I18n,
      IssueVisa,
      CancleVisa,
      ReprintVisa,
      CancleFinalExit
      },
    data () {
      return {

      }
    },

    methods: {

    }
  
  }
  </script>
  
  <style lang="scss" scoped>
    #page-login{
        background-color: #E9ECF0;
    }
    .muqeem{
        background-color: #F8F8F8;
    }
    .rounded-corner{
      border-radius: 25px;
    }
    .vs-tabs--btn .activeChild button{
        color:#2a9eeb !important;
    }
    .vs-tabs--li.activeChild {
        border-left: 1px solid red !important;

    }
    .bg-input{
        position: relative;
        .icon{
        position: absolute;
        top:10px;
        left: 10px;
        z-index:1;
        padding-right: 20px;
        }
        .employee-icon{
        top:-3px
        }
        .left-icon{
        position: absolute;
        top:12px;
        left: 85%;
        z-index: 9999;
        }

  }
  .register-btn{
    border-radius:30px ;
  }
  .vs-con-input {
  .vs-inputx {
    border-radius: 10px !important;
    color:#000000
  }


}

.vs-con-input .vs-inputx:hover,
.vs-con-input .vs-inputx:focus {
    border-color: #2a9eeb !important;
}

  </style>
  