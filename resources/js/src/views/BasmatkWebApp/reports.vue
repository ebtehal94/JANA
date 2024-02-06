
<template>
    <div id="payroll" class="my-4">
      <div class="container">
        <div class="vx-row flex flex-wrap">
          <div class="vx-col md:w-8/12 w-full column-border">
            <div class="vx-row w-full md:w-4/5">
              <div class="flex justify-between ">
                  <h3 class="font-bold title pl-4">{{$t('RepoertsAndRecords')}}</h3>
                  <flat-pickr
                  class="w-3/12"
                  v-model="fromDate"
                  :placeholder="$t('SelectYear')" />
                </div>
                <div class="pl-4 pt-2">
                    <ul class="flex list-none">
                        <li class="mr-2" v-for="item in months" :key="item.name"><a href="" class="btn">{{item.name}}</a></li>
                    </ul>
                </div>
                <vs-divider/>
                <div class="vx-row">
                  <div class="vx-col pr-5" v-for="item in faq" :key="item.id">
                    <vs-divider position="left">
                      <div class="flex justify-between text-white px-4 bg-date">
                        <span>{{item.day}}</span>
                        <span class="pl-2">2021/05/12</span>
                      </div>
                    </vs-divider>
                    <div class="flex salary-report justify-between pl-4">
                      <div class="flex">
                        <vs-chip>
                         <span class="bg-shift">{{ $i18n.locale == 'en' ? 'First Shift': 'الفترة الأولى' }}</span>
                        </vs-chip>
                        <p class="">{{$i18n.locale == "en" ? "Check-in Time" : "وقت الحضور"}}</p>
                        <img src="@assets/images/time-status.svg" alt="" class="mx-2">
                        <span class="shift-time">{{item.time}}</span>
                      </div>
                      <div class="flex">
                        <div>
                          <p class="">{{$i18n.locale == "en" ? "Check-out Time" : "وقت الإنصراف"}}</p>
                        </div>
                        <div>
                          <img src="@assets/images/time-status.svg" alt="" class="mx-2">
                        </div>
                        <div>
                          <span class="shift-time">{{item.time}}</span>
                        </div>
                      </div>
                    </div>
                    <vs-divider class="pl-4 bg-divider"/>
                    <div class="flex salary-report justify-between pl-4">
                      <div class="flex">
                        <vs-chip>
                         <span class="bg-shift">{{ $i18n.locale == 'en' ? 'Second Shift': 'الفترة الثانية' }}</span>
                        </vs-chip>
                        <p class="">{{$i18n.locale == "en" ? "Check-in Time" : "وقت الحضور"}}</p>
                        <img src="@assets/images/time-status.svg" alt="" class="mx-2">
                        <span class="shift-time">{{item.time}}</span>
                      </div>
                      <div class="flex">
                        <div>
                          <p class="">{{$i18n.locale == "en" ? "Check-out Time" : "وقت الإنصراف"}}</p>
                        </div>
                        <div>
                          <img src="@assets/images/time-status.svg" alt="" class="mx-2">
                        </div>
                        <div>
                          <span class="shift-time">{{item.time}}</span>
                        </div>
                      </div>
                    </div>
                    <vs-divider class="pl-4 bg-divider"/>
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
export default{
  components: {
      flatPickr,
      Statistics
    },
    props:{

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
          day: 'الجمعة',
          status: ' مقابل راتب شهر يناير',
          time:'8:54 صباحا',
        },
        {
          id: 2,
          day: 'السبت',
          status: ' مقابل راتب شهر يناير',
          time:'8:54 صباحا',
        },
        {
          id          : 3,
          day: 'الأحد',
          status: ' مقابل راتب شهر يناير',
          time:'8:54 صباحا',

        },
        {
          id          : 4,
          day: 'الإتنين',
          status: ' مقابل راتب شهر يناير',
          time:'8:54 صباحا',
        },
        {
          id          : 5,
          day: 'الثلاثاء',
          status: ' مقابل راتب شهر يناير',
          time:'8:54 صباحا',
        },
      ],
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
.column-border{
  border-right: 1px solid #eee;
}
.title{
   color:#31323B; 
   font-size: .9rem;
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
.bg-date{
  background: #0E77FF;
  border-radius: 10px;
  padding-top: 3px;
  padding-bottom: 3px;
}
.bg-date span{
  font-size: .7rem;
}
.salary-report .bg-shift{
  font-size: .7rem;
}
.salary-report p{
    font-size: .9rem;
    padding-left: .5rem;
    font-weight: 500;
}
.salary-report .shift-time{
  font-size: .9rem;
  padding-top: 1px;
}
.con-vs-chip {
  border-radius: 10px !important;
}
</style>

