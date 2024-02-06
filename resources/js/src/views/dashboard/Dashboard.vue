
<template>
    <div id="payroll" class="mt-12">
      <div class="container">
        <div class="vx-row flex flex-wrap">
            <div class="vx-col w-full md:w-8/12  payroll-column">
            <div class="vx-row w-full md:w-4/5">
                <h3 class="font-bold title pl-4">{{$t('Payroll')}}</h3>
                <div class="flex justify-between pl-4">
                  <h2 class="font-medium"><span style="font-size:.8rem;">{{$i18n.locale == "en" ? "Your salary" : "راتبك"}}</span> 4500.00 <span style="font-size:.6rem;">{{$t('Pricing')}}</span></h2>
                    <flat-pickr
                    class="w-4/12 mt-2"
                    :config="configFromdateTimePicker"
                    v-model="fromDate"
                    :placeholder="$t('SelectTime')"
                    @on-change="onFromChange" />
                  <div class="mx-4 text-white px-6 bg-balance text-center">
                    <span>{{$i18n.locale == "en" ? "Your Balance" : "رصيدك"}}</span>
                    <h4 class="font-medium"> 760.00 <span style="font-size:.5rem;">{{$t('Pricing')}}</span></h4>
                  </div>
                </div>
                <vs-divider/>
                <div class="pl-4">
                  <p>{{$t('Reports')}}</p>
                </div>
                <div class="vx-row">
                  <div class="vx-col w-full" v-for="item in faq" :key="item.id">
                    <div class="flex salary-report justify-between pl-4">
                      <div class="flex">
                        <h4 class="salary-title font-medium">+{{item.salary}} <span style="font-size:.6rem;">{{$t('Pricing')}}</span></h4>
                        <p>{{item.status}}</p>
                        <!-- <vs-chip transparent  :color="statusOptions[params.value].color">
                          <span>{{ $i18n.locale == 'en' ? statusOptions[params.value].label_en : statusOptions[params.value].label_ar }}</span>
                        </vs-chip> -->
                      </div>
                      <span>{{item.date}}</span>
                    </div>
                    <vs-divider class="bg-divider"/>
                  </div>
                </div>
              </div>
            </div>
            <div class="vx-col w-full md:w-4/12 md:pl-4">
              <h3 class="font-bold title pl-4">{{$t('Statistics')}}</h3>
              <div class="vx-row mt-4 ml-2 justify-between ">
                <template>
                    <flat-pickr
                    class="w-5/12 mt-2"
                    :config="configFromdateTimePicker"
                    v-model="fromDate"
                    :placeholder="$t('SelectTime')"
                    @on-change="onFromChange" />
                    
                    <flat-pickr
                    class="w-5/12 mt-2 ml-4"
                    :config="configTodateTimePicker"
                    v-model="toDate"
                    :placeholder="$t('SelectTime')"
                    @on-change="onToChange" />
                </template>
              </div>

              <h3 class="font-semibold state-title py-4 ">{{$t('AttendanceStats')}}</h3>
              <div class="vx-row flex justify-betwee md:pr-4">
                <div class="vx-col w-full md:w-1/2">
                  <vx-card class="statistic-card">
                    <div class="flex justify-between">
                      <div class="truncate">
                        <h4 class="font-semibold">85.14 <small class="font-normal">{{$t('Minute')}}</small></h4> 
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
                        <h4 class="font-semibold">85.14 <small class="font-normal">{{$t('Minute')}}</small></h4> 
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
                        <h4 class="font-semibold">85.14 <small class="font-normal">{{$t('Minute')}}</small></h4> 
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
                        <h4 class="font-semibold">85.14 <small class="font-normal">{{$t('Minute')}}</small></h4> 
                        <span class="text-sm">{{$t('EarlyLeave')}}</span>
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
                        <h4 class="font-semibold">10 <small class="font-normal">{{$t('Order')}}</small></h4> 
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
                        <h4 class="font-semibold">2 <small class="font-normal">{{$t('Order')}}</small></h4> 
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
                        <h4 class="font-semibold">6 <small class="font-normal">{{$t('Order')}}</small></h4> 
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
                        <h4 class="font-semibold">18 <small class="font-normal">{{$t('Order')}}</small></h4> 
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
        
        </div>
      </div>
    </div>
</template>



<script>
import axios from "@/axios.js"
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
export default{
  components: {
      flatPickr,
    },
    props:{

    },
  data () {
    return {
      configFromdateTimePicker: {
        maxDate: null
      },
      configTodateTimePicker: {
        minDate: null
      },
      faq: [
       {

          id: 1,
          salary: '4500.00',
          status: ' مقابل راتب شهر يناير',
          date:'2021/05/12 4:05 AM',
          answer_ar:'هو نظام موارد بشرية متكامل يوفر علـى الموظف و إدارتة عناء المعاملات الورقية من خلال لوحة تحكم شاملة و تطبيق جوال يحتوي علي العديد من المميزات: 1-إدخال بيانات الشركة. 2-إضافة فروع الشركة. 3-إنشاء الأقسام و المجموعات الإدراية. 4-إضافة الموظفين..',
          answer_en:'',
        },
        {
          id: 2,
          salary: '1500.00',
          status: ' مقابل راتب شهر يناير',
          date:'2021/05/12 4:05 AM',
          answer_ar:'نعم يعمل في جميع أجهزة الجوال الذكية ( اندرويد ، IOS ، هواوي ).',
          answer_en:'',
        },
        {
          id          : 3,
          salary: '4500.00',
          status: ' مقابل راتب شهر يناير',
          date:'2021/05/12 4:05 AM',
          answer_ar:'نعم يعمل في جميع أجهزة الجوال الذكية ( اندرويد ، IOS ، هواوي ).',
          answer_en:'',
        },
        {
          id          : 4,
          salary: '4500.00',
          status: ' مقابل راتب شهر يناير',
          date:'2021/05/12 4:05 AM',
          answer_ar:'نعم يعمل في جميع أجهزة الجوال الذكية ( اندرويد ، IOS ، هواوي ).',
          answer_en:'',
        },
        {
          id          : 5,
          salary: '4500.00',
          status: ' مقابل راتب شهر يناير',
          date:'2021/05/12 4:05 AM',
          answer_ar:'نعم يعمل في جميع أجهزة الجوال الذكية ( اندرويد ، IOS ، هواوي ).',
          answer_en:'',
        },
        {
          id          : 6,
          salary: '4500.00',
          status: ' مقابل راتب شهر يناير',
          date:'2021/05/12 4:05 AM',
          answer_ar:'نعم يعمل في جميع أجهزة الجوال الذكية ( اندرويد ، IOS ، هواوي ).',
          answer_en:'',
        },
      ],
      statusOptions: [
              { label_en: 'New', label_ar: 'جديد',color:'#24c1a0', value: 0 },
              { label_en: 'In Progress',label_ar: 'قيد الانتظار', color:'warning', value: 1 },
              { label_en: 'Ready For Pickup', label_ar: 'جاهز للتوصيل',color:'danger', value: 2 },
              { label_en: 'On The Way', label_ar: 'قيد التوصيل',color:'warning', value: 3 },
              { label_en: 'Delivered', label_ar: 'تم التوصيل',color:'success', value: 4 },
              { label_en: 'Cancelled', label_ar: 'ملغي',color:'dark', value: 5 },
      ],
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
#payroll{
    font-family: "Cairo", sans-serif !important;
    color:#696969;
}
.payroll-column{
  border-right: 1px solid #eee;
}
.title{
   color:#31323B; 
   font-size: .9rem;
}
.bg-divider{
  margin: 2px 0  !important;
}
.bg-balance{
  background: #0cc958;
  border-radius: 18px;
}
.bg-balance span{
  font-size: .7rem;
}
.bg-balance h4{
  margin-top: -6px;
}
.salary-report p{
    font-size: .8rem;
    padding-top: .2rem;
    padding-left: .5rem;
    font-weight: 500;
}
.salary-report span{
    font-size: .7rem;
    display: inline-block;
    padding-right: 1rem;
    padding-top: 5px;
}
.flatpickr-input{
  border-radius:20px !important;
  padding: .4rem 0 .4rem 1rem !important;
  border: 1px solid rgba(0, 0, 0, 0.1) !important;
  font-family: "Cairo", sans-serif !important;
  font-size: .7rem;

}
.state-title{
  color: #838383;
  font-size: .9rem;
}
.statistic-card{
  background: #fff !important;
  border: 0.1px solid #efefef;
  border-radius: 15px;
}
.vx-card .vx-card__collapsible-content .vx-card__body{
  padding:5px 10px !important;
}
.statistic-card h4{
  font-size: 1.2rem;
  margin-bottom: -10px;
}
.statistic-card small{
  font-size: .6rem;
}
.statistic-card span{
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
.statistic-card .feather-send{
  color: #0277D6;
}
</style>

