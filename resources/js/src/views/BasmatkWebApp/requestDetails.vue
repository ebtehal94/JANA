
<template>
    <div id="requests" class="my-4">
      <div class="container">
        <div class="vx-row flex flex-wrap">
          <div class="vx-col md:w-8/12 w-full column-border">
            <div class="vx-row w-full md:w-4/5">
                <h3 class="font-bold title pl-4">{{$t('Requests')}}</h3>
                <div class="vx-row">
                  <div class="vx-col pr-5 my-4">
                    <div class="flex justify-between">
                        <div>
                            <vs-chip>
                                <span>{{request_details.request_type}}</span>
                            </vs-chip>
                        </div>
                        <span class="request-date">{{request_details.date}}</span> 
                    </div>
                    <div class="w-4/5 mb-2">
                        <p class="request-message">{{request_details.message}}</p>
                    </div>
                    <vs-divider class="bg-divider"/>
                  </div>
                </div>
                <div class="vx-row flex request-details">
                  <div class="vx-col w-1/2">
                    <h3 class="pl-4">{{$t('RequestStatus')}}</h3>
                    <div class="vx-row flex">
                      <div class="vx-col w-1/2">
                      <div id="chart">
                        <apexchart type="radialBar" height="180" :options="chartOptions" :series="series"></apexchart>
                      </div>
                      </div>
                        <div class="vx-col w-1/2">
                          <ul class="ml-8 mt-1">
                            <li><a href="">مدير القسم</a></li>
                            <li><a href="">مدير الفرع</a></li>
                            <li><a href="">المدير التنفيذي</a></li>
                            <li><a href="">المدير العام</a></li>
                          </ul>
                        </div>
                      </div>
                  </div>
                  <div class="vx-col w-1/2">
                    <div class="period">
                      <h3 class="pl-4">{{$t('Period')}}</h3>
                      <p class="pl-8 pt-2 period-date">{{$t('StartFrom')}}<span class="pl-2"> {{request_details.start_date}}</span></p>
                      <p class="pl-8 period-date">{{$t('EndsIn')}}<span class="pl-2"> {{request_details.end_date}}</span></p>
                    </div>
                    <div class="notes pt-2">
                      <h3 class="pl-4">{{$t('Notes')}}</h3>
                      <p class="pl-8">{{request_details.notes}}</p>
                    </div>
                  </div>
                </div>
                <div class="vx-row attachments w-full pl-4 md:w-4/5">
                  <h4 class="font-semibold replies-title py-2">{{$t('Attachements')}}</h4>
                  <div class="vx-row flex">
                    <div class="vx-col w-full md:w-1/4 pr-4 mb-4" v-for="image in images"  :key="image.id">
                      <img :src="image.src"  alt=" " class="mx-auto w-full lg:responsive" width="80">
                    </div>
                  </div>
                  <vs-divider class="bg-divider"/>
                </div>
                <div class="vx-row w-full md:w-4/5">
                  <h4 class="font-semibold replies-title pl-4 py-2">{{$t('Replies')}}</h4>
                  <div class="vx-col pr-5 pt-2" v-for="item in replies" :key="item.id">
                    <div class="flex justify-between pl-4">
                        <div>
                          <div class="flex">
                            <span class="admin-image mr-2"><img src="@assets/images/admin.svg" alt=""/></span>
                            <p class="replay-hr">{{item.name}}<span> | {{$t('HRname')}}</span></p>
                          </div>
                          <div class="pl-8">
                            <p class="reply-details">{{item.reply_message}}</p>
                          </div>
                          <div class="flex pl-8 pb-1"> 
                            <span class="reply-details">{{item.time}}</span>
                            <span class="reply-details pl-2">{{item.date}}</span>  
                          </div>
                        </div>
                        <div class="images">
                          <img :src="item.image"  class="responsive"/>
                          <!-- <div v-else  class="text-center mx-auto">
                            <h3>لا توجد مرفقات</h3>
                          </div> -->
                        </div>
                    </div>
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

    },
  data () {
    return {
        request_details: {
          request_type:'إجازة طارئة',
          message: 'لذلك أرجو من سيادتكم الموافقة على طلب إجازة مرضية, للقيام بإجراءات العلاج , وعمل العملية بأسرع وقت ممكن, وأنا بحاجة ماسة للموافقة على طلبي',
          date:'2021/05/12 4:05 AM',
          start_date:'2021/04/15',
          end_date:'2021/04/15',
          notes:'لذلك أرجو من سيادتكم الموافقة على طلب إجازة مرضية, للقيام بإجراءات العلاج , وعمل العملية بأسرع وقت ممكن',
        },
        images:[
          {
            id: 2,
            src:require('@assets/images/id-card.png'),
          },
          {
            id: 2,
            src:require('@assets/images/id-card.png'),
          },
        ],
        replies:[
          {
            id: 1,
            reply_message: 'لقد تم قبول طلبك',
            time:'PM 8:04',
            date:'2021/05/12',
            name:'أحمد المسعودي',
            image:require('@assets/images/id-card.png'),
          },
          {
            id: 2,
            reply_message: 'لقد تم قبول طلبك',
            time:'PM 8:04',
            date:'2021/05/12',
            name:'أحمد المسعودي',
          },
        ],
        series: [70],
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
                  value: {
                    offsetY: -5,
                    color: '#0E77FF',
                    fontSize: '20px',
                    show: true,
                  }
                }
              }
            },
            labels: [''],
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
#requests{
    font-family: "Cairo", sans-serif !important;
    color:#696969;
}
.column-border{
  border-right: 1px solid #eee;
}
.title{
   color:#31323B; 
   font-size: .9rem;
}
.request-details h3{
  font-size: .8rem;
  font-weight: 600;
}
ul li{
  font-size: 1rem;
  position: relative;
  color:#0E77FF;
}
ul li:last-child{
  color: #696969;
}
ul li:before{
    position: absolute;  
    margin: 12px 0 0 -15px;    
    background: #0E77FF;
    content: "";
    top: 5px;
    vertical-align: middle;
    display: inline-block;
    width: 1px;
    height:24px;
}
ul li:last-child:before{
    display: none;
}
ul li a{
  font-size: .7rem;
  color:#0E77FF;
}
ul li:last-child a{
  color: #696969;
}
.period-date{
    font-size: .7rem;
}
.notes p{
    font-size: .7rem;
}
.request-message{
    font-size: .8rem;
    color:#5E5E5E;
}
.request-date{
    font-size: .7rem;
    display: inline-block;
    padding-right: 1rem;
}
.replies-title{
  font-size: .8rem;
}
.admin-image{
  display: block;
  height: 24px;
  width: 24px;
  background: #8F9BB4;
  border-radius: 50%;
  text-align: center;
}
.reply-details{
  color:#8F9BB4;
  font-size: .6rem;
}
.replay-hr{
  font-size: 0.7rem;
  color: #63697B;
  padding-top: 0px;
}
.bg-divider{
  margin: 2px 0px 0px  !important;
}
.con-vs-chip {
  padding:0 20px !important;
  min-height: 0 !important;
}
.vs-chip--text {
    margin-left: 0 !important;
}
</style>

