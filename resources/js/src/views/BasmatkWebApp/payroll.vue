
<template>
    <div id="payroll" class="my-4">
      <div class="container">
        <div class="vx-row flex flex-wrap">
          <div class="vx-col w-full md:w-8/12  payroll-column">
            <div class="vx-row w-full md:w-4/5">
                <h3 class="font-bold title pl-4">{{$t('Payroll')}}</h3>
                <div class="flex justify-between pl-4">
                  <h2 class="font-medium"><span style="font-size:.8rem;">{{$i18n.locale == "en" ? "Your salary" : "راتبك"}}</span> 4500.00 <span style="font-size:.6rem;">{{$t('Pricing')}}</span></h2>
                  <div class="w-3/12 bg-icon">
                    <icon name="arrow" class="arrow-icon"/>   
                    <flat-pickr
                    class="w-full"
                    v-model="yearDate"
                    :placeholder="$t('SelectYear')" />
                  </div>
                  <div class="mx-4 text-white px-6 bg-balance text-center">
                    <span>{{$i18n.locale == "en" ? "Your Balance" : "رصيدك"}}</span>
                    <h4 class="font-medium"> 760.00 <span style="font-size:.5rem;">{{$t('Pricing')}}</span></h4>
                  </div>
                </div>
                <div class="pl-4 pt-4">
                    <ul class="flex list-none">
                        <li class="mr-2" v-for="item in months" :key="item.name"><a href="" class="btn">{{item.name}}</a></li>
                    </ul>
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
            <div class="vx-col md:w-4/12 md:pl-4">
              <Statistics/>
            </div>
        
        </div>
      </div>
    </div>
</template>



<script>
import axios from "@/axios.js"
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import Statistics from "./components/statistics.vue"
import icon from '@/layouts/components/icon.vue';
export default{
  components: {
    Statistics,
    flatPickr,
    icon
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
       months:[
            {name:'يناير'},
            {name:'فبراير'},
            {name:'مارس'},
            {name:'ابريل'},
            {name:'مايو'},
            {name:'يونيو'},
            {name:'يوليو'},
        ],
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
      yearDate:'',
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
.bg-icon{
    position: relative;
    .arrow-icon{
      position: absolute;
      top:2px;
      right: 15px;
      z-index:1;
    }
}
ul{
    list-style: none;
}
ul li a{
    border: 1px solid #eee;
    font-size: 13px;
    border-radius: 6px;
    padding: 0 8px;
    color: #696969;
}
ul li a:hover{
    color: #fff;
    background: #0E77FF;
    border: 1px solid #0E77FF;
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

