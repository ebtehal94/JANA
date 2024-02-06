<template>
    <div id="late-checkouts" class="my-4">
      <div class="container">
        <div class="vx-row flex flex-wrap">
            <div class="vx-col md:w-8/12 w-full column-border">
              <div class="vx-row w-full md:w-4/5">
              <div class="flex justify-between ">
                <h3 class="font-bold title pl-4">{{$t('LateCheckouts')}}</h3>
                <div class="w-3/12 bg-icon">
                  <icon name="arrow" class="arrow-icon"/>   
                  <flat-pickr
                  class="w-full"
                  v-model="yearDate"
                  :placeholder="$t('SelectYear')" />
                </div>
              </div>
                <div class="pl-4 pt-2">
                  <ul class="flex">
                    <li class="mr-2" v-for="item in months" :key="item.name"><a href="" class="btn">{{item.name}}</a></li>
                  </ul>
                </div>
                <vs-divider/>
                <div class="vx-row">
                  <div class="vx-col pr-5" v-for="item in checkouts" :key="item.id">
                    <div class="flex bg-header pl-4">
                      <div class="flex justify-between text-white px-3 bg-date">
                        <span>{{item.day}}</span>
                        <span class="pl-2">2021/05/12</span>
                      </div>
                      <vs-divider class="bg-header-divider"/>
                      <div>
                        <vs-button color="danger" type="filled" @click.stop="openDeleteConfirm">{{$i18n.locale == "en" ? "Remove Delay" : "إزالة التأخير"}}</vs-button>
                      </div>
                    </div>
                    <div class="flex checkouts-report justify-between pl-4">
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
                    <div class="flex checkouts-report justify-between pl-4">
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
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import icon from '@/layouts/components/icon.vue';
export default{
  components: {
    Statistics,
    flatPickr,
    icon
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
        checkouts: [
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
          day: 'الجمعة',
          status: ' مقابل راتب شهر يناير',
          time:'8:54 صباحا',
        },
      ],
      yearDate:''
    }

  },
  computed: {
  
  },
  
  methods: {
      openDeleteConfirm(id) {
        // this.ItemToDelete = id;
        this.$vs.dialog({
          type: 'confirm',
          color: 'danger',
          title: this.$t('RemoveDelay'),
          text: 'هل تريد بتأكيد إرسال طلب إزالة تأخير الى مدير الموارد البشرية؟',
          // accept: this.deleteOffer
        })
      },

  },
  created(){

  }

}
</script>
<style lang="scss">
#late-checkouts{
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
.bg-header{
  padding-bottom: 7px;
  padding-top: 5px;
}
.bg-header-divider{
  width: 73% ;
}
.vs-button{
  padding: 5px 12px !important;
  border-radius: 15px !important;
}
.bg-divider{
  margin: 2px 0  !important;
}
.bg-date{
  background: #0E77FF;
  border-radius: 10px;
  padding-top: 5px;
  // padding-bottom: 3px;
}
.bg-date span{
  font-size: .6rem;
}
.checkouts-report .bg-shift{
  font-size: .7rem;
}
.checkouts-report p{
    font-size: .9rem;
    padding-left: .5rem;
    font-weight: 500;
}
.checkouts-report .shift-time{
  font-size: .9rem;
  padding-top: 1px;
}
.con-vs-chip {
  border-radius: 10px !important;
}
</style>

