
<template>
    <div id="vacations" class="my-4">
      <div class="container">
        <div class="vx-row flex flex-wrap">
          <div class="vx-col w-full md:w-8/12  border-column">
            <div class="vx-row w-full md:w-4/5">
              <h3 class="font-bold title pl-4">{{$t('VacationsReport')}}</h3>
                <div class="vx-row flex vacation-information pl-4 pt-4">
                  <div class="vx-col flex">
                    <ul>
                        <li>{{$t('DateOfJoin')}}</li>
                        <li>{{$t('DateOfEarning')}}</li>
                        <li>{{$t('TotalYearlyVacationBalance')}}</li>
                        <li>{{$t('RemainingBalance')}}</li>
                    </ul>
                      <ul class="text-right ml-8 vacations-data">
                        <li>{{vacations_informaions.join_date}}</li>
                        <li>{{vacations_informaions.earning_date}}</li>
                        <li>{{vacations_informaions.total_yearly_vacation}} {{$t('Day')}}</li>
                        <li>{{vacations_informaions.remaining_balance}} {{$t('Days')}}</li>
                    </ul>
                  </div>
                  <div class="vx-col">
                    <div id="chart" class="chart">
                      <apexchart type="radialBar" height="180" :options="chartOptions" :series="series"></apexchart>
                    </div>
                  </div>
                </div>
                <vs-divider/>
                <div class="pl-4">
                  <p>{{$t('Reports')}}</p>
                </div>
                <div class="vx-row">
                  <div class="vx-col w-full pl-4" v-for="item in vacation_reports" :key="item.id">
                    <div class="flex vacation-report justify-between">
                      <div class="flex">
                        <h4 class="vacation-title font-medium">{{item.days}} <span style="font-size:.5rem;">{{$t('Days')}}</span></h4>
                        <p>{{item.vacation_type}}</p>
                        <vs-chip class="vacation-status">
                          <span>{{ $i18n.locale == 'en' ? 'Late': 'تأخير' }}</span>
                        </vs-chip>
                      </div>
                      <span>{{item.from}} - {{item.to}}</span>
                    </div>
                    <p class="vacation-disc">{{item.vacation_disc}}</p>
                    <vs-divider class="bg-divider"/>
                  </div>
                </div>
              </div>
            </div>
            <div class="vx-col md:w-4/12 md:pl-4">
              <Statistics/>
            </div>
        </div>
      </div>
    </div>
</template>



<script>
import axios from "@/axios.js"
import Statistics from "./components/statistics.vue"
import VueApexCharts from 'vue-apexcharts'
export default{
  components: {
      Statistics,
      apexchart:  VueApexCharts,
    },
    props:{
      fromDate:{
        required: false
      },
      toDate:{
        required: false
      }
    },
  data () {
    return {
      vacations_informaions:{join_date:'15/09/2019',earning_date:'15/09/2020',total_yearly_vacation:'21',remaining_balance:'9'},
      vacation_reports: [
       {
          id: 1,
          days: '4',
          vacation_type: 'إجازة عيد الأضحى المبارك',
          from:'2021/05/12',
          to:'2021/05/30',
          vacation_disc:'',
        },
        {
          id: 2,
          days: '3',
          vacation_type: 'إجازة مرضية طارئة',
          from:'2021/05/12',
          to:'2021/05/30',
          vacation_disc:'إجازة مرضية طارئة إجازة مرضية طارئة',
        },
        {
          id          : 3,
          days: '3',
          vacation_type: 'إجازة مرضية طارئة',
          from:'2021/05/12',
          to:'2021/05/30',
          vacation_disc:'إجازة مرضية طارئة إجازة مرضية طارئة',
        },
        {
          id          : 4,
          days: '1',
          vacation_type: 'غياب بدون عذر',
          from:'2021/05/12',
          to:'2021/05/30',
          vacation_disc:'',
        },
      ],
        series: [12.5],
          chartOptions: {
            chart: {
              height: 200,
              type: 'radialBar',
            },
            plotOptions: {
              radialBar: {
                 hollow: {
                  margin: 0,
                  size: '50%',
                  background: '#fff',
                },
                dataLabels: {
                  show: true,
                  name: {
                    offsetY: -3,
                    show: true,
                    color: '#ACACAC',
                    fontSize: '18px',
                    fontweight:'700'
                  },
                  value: {
                    formatter: function(val) {
                      return parseInt(val);
                    },
                    offsetY: 2,
                    color: '#0E77FF',
                    fontSize: '17px',
                    show: true,
                  }
                }
              }
            },
            labels: ['يوم'],
          },
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
#vacations{
    font-family: "Cairo", sans-serif !important;
    color:#696969;
}
.border-column{
  border-right: 1px solid #eee;
}
.title{
   color:#31323B; 
   font-size: .9rem;
}
ul{
    list-style: none;
}
.vacation-information ul li {
  font-size: .8rem;
}
.vacations-data li{
  color: #0E77FF;
}
.chart{
  margin-top: -2rem;
}
.bg-divider{
  margin: 2px 0  !important;
}
.vacation-report{ 
  p{
    font-size: .8rem;
    padding-top: .2rem;
    padding-left: .5rem;
  }
  span{
    font-size: .6rem;
    display: inline-block;
    padding-right: 1rem;
    padding-top: 5px;
  }
  .vacation-status {
    padding:0 20px !important;
    margin-left: 10px;
    margin-top: 5px;
    min-height: 20px !important;
    span{
      padding:0 ;
    }
  }
}
.vacation-disc{
  font-size: .7rem;
}

 .vs-chip--text {
    margin-left: 0 !important;
}

</style>

