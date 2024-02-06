<template>
  <div>
    <h3 class="font-bold title">{{$t('Statistics')}}</h3>
      <div class="vx-row statistics flex mt-4  justify-between ">
        <template>
          <div class="vx-col w-1/2 bg-icon">
            <icon name="arrow" class="arrow-icon"/>
            <flat-pickr
            class="w-11/12 mt-2"
            :config="configFromdateTimePicker"
            v-model="fromDate"
            :placeholder="$t('SelectTime')"
            @on-change="onFromChange" />
          </div>
          <div class="vx-col w-1/2 bg-icon">
            <icon name="arrow" class="arrow-icon"/>       
            <flat-pickr
            class="w-11/12 mt-2 ml-2"
            :config="configTodateTimePicker"
            v-model="toDate"
            :placeholder="$t('SelectTime')"
            @on-change="onToChange" />
          </div>
        </template>
      </div>

      <h3 class="font-semibold state-title py-4 ">{{$t('AttendanceStats')}}</h3>
      <div class="vx-row flex justify-betwee md:pr-4">
                <div class="vx-col w-full md:w-1/2">
                  <vx-card class="statistic-card">
                    <div class="flex justify-between">
                      <div class="truncate">
                        <h4 class="font-semibold">85.14 <small class="font-medium">{{$t('Minute')}}</small></h4> 
                        <span class="">{{$t('TotalDelay')}}</span>
                      </div>
                      <div class="px-2 feather-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send ">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                      </div>
                    </div>
                  </vx-card>
                </div>
                <div class="vx-col w-full md:w-1/2">
                  <vx-card class="statistic-card ml-4">
                    <div class="flex justify-between items-center">
                      <div class="truncate">
                        <h4 class="font-semibold">85.14 <small class="font-medium">{{$t('Minute')}}</small></h4> 
                        <span class="text-sm">{{$t('TheOvertime')}}</span>
                      </div>
                      <div>
                        <img src="@assets/images/decrease-2.svg">
                      </div>
                    </div>
                  </vx-card>
                </div>
      </div>

      <div class="vx-row flex justify-betwee mt-4 md:pr-4">
                <div class="vx-col w-full md:w-1/2">
                  <vx-card class="statistic-card">
                    <div class="flex justify-between items-center">
                      <div class="truncate">
                        <h4 class="font-semibold">85.14 <small class="font-medium">{{$t('Minute')}}</small></h4> 
                        <span class="">{{$t('TotalAbsence')}}</span>
                      </div>
                      <div>
                        <img src="@assets/images/increase.svg">
                      </div>
                    </div>
                  </vx-card>
                </div>
                <div class="vx-col w-full md:w-1/2">
                  <vx-card class="statistic-card ml-4">
                    <div class="flex justify-between items-center">
                      <div class="truncate">
                        <h4 class="font-semibold">85.14 <small class="font-medium">{{$t('Minute')}}</small></h4> 
                        <span class="">{{$t('EarlyLeave')}}</span>
                      </div>
                      <div>
                        <img src="@assets/images/decrease-2.svg">
                      </div>
                    </div>
                  </vx-card>
                </div>
      </div>

              <h3 class="font-semibold state-title py-4 ">{{$t('OrdersState')}}</h3>
              <div class="vx-row flex justify-betwee md:pr-4">
                <div class="vx-col w-full md:w-1/2">
                  <vx-card class="statistic-card">
                    <div class="flex justify-between items-center">
                      <div class="truncate">
                        <h4 class="font-semibold">10 <small class="font-medium">{{$t('Order')}}</small></h4> 
                        <span class="">{{$t('TotalOrders')}}</span>
                      </div>
                      <div>
                        <img src="@assets/images/increase.svg">
                      </div>
                    </div>
                  </vx-card>
                </div>
                <div class="vx-col w-full md:w-1/2">
                  <vx-card class="statistic-card ml-4">
                    <div class="flex justify-between items-center">
                      <div class="truncate">
                        <h4 class="font-semibold">2 <small class="font-medium">{{$t('Order')}}</small></h4> 
                        <span class="">{{$t('Pending')}}</span>
                      </div>
                      <div>
                        <img src="@assets/images/decrease-2.svg">
                      </div>
                    </div>
                  </vx-card>
                </div>
              </div>

              <div class="vx-row flex justify-betwee mt-4 md:pr-4">
                <div class="vx-col w-full md:w-1/2">
                  <vx-card class="statistic-card">
                    <div class="flex justify-between items-center">
                      <div class="truncate">
                        <h4 class="font-semibold">6 <small class="font-medium">{{$t('Order')}}</small></h4> 
                        <span class="">{{$t('RejectedOrders')}}</span>
                      </div>
                      <div>
                        <img src="@assets/images/increase.svg">
                      </div>
                    </div>
                  </vx-card>
                </div>
                <div class="vx-col w-full md:w-1/2">
                  <vx-card class="statistic-card ml-4">
                    <div class="flex justify-between items-center">
                      <div class="truncate">
                        <h4 class="font-semibold">18 <small class="font-medium">{{$t('Order')}}</small></h4> 
                        <span class="">{{$t('Approved')}}</span>
                      </div>
                      <div>
                        <img src="@assets/images/decrease-2.svg">
                      </div>
                    </div>
                  </vx-card>
                </div>
              </div>

  </div>
</template>



<script>
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import icon from '@/layouts/components/icon.vue';
export default{
  components: {
      flatPickr,
      icon
    },
    props:{

    },
  data () {
    return {
      fromDate: '',
      toDate: '',
      configFromdateTimePicker: {
        maxDate: null
      },
      configTodateTimePicker: {
        minDate: null
      },

    }

  },
  computed: {

  },
  
  methods: {
    onFromChange(selectedDates, dateStr, instance) {
      this.$set(this.configTodateTimePicker, 'minDate', dateStr);
    },
    onToChange(selectedDates, dateStr, instance) {
      this.$set(this.configFromdateTimePicker, 'maxDate', dateStr);
    },
  },
  created(){

  }

}
</script>


<style lang="scss">
 .statistics .bg-icon{
    position: relative;
    .arrow-icon{
      position: absolute;
      top:9px;
      right: 25px;
      z-index:1;
    }
  }
.flatpickr-input{
  border-radius:20px !important;
  padding: .4rem 0 .4rem 1rem !important;
  border: 1px solid rgba(0, 0, 0, 0.1) !important;
  font-family: "Cairo", sans-serif !important;
  font-size: .7rem;
}
.state-title{
  color: #ACACAC;
  font-size: .9rem;
}
.vx-card .vx-card__collapsible-content .vx-card__body{
  padding:5px 10px !important;
}
.statistic-card {
    background: #fff !important;
    border: 0.1px solid #efefef;
    border-radius: 15px;
  h4{
    font-size: 1.2rem;
    margin-bottom: -10px;
  }
  small{
    font-size: .6rem;
  }
  span{
    font-size: .8rem;
  }
  .feather-icon {
    border-radius: 50%;
    width: 42px;
    height: 42px;
    justify-content: center;
    margin-top: 7px;
    background: rgba(2,119,214,0.12);
  }
  .feather-send{
    color: #0277D6;
  }
}


</style>

