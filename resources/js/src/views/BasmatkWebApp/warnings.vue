
<template>
    <div id="warnings" class="my-4">
      <div class="container">
        <div class="vx-row flex flex-wrap">
          <div class="vx-col md:w-8/12 w-full column-border">
            <div class="vx-row w-full md:w-4/5">
                <div class="mb-8">
                    <h3 class="font-bold title pl-4">{{$t('Warnings')}}</h3>
                </div>
                <div class="vx-row">
                  <div class="vx-col pr-5" v-for="item in warnings" :key="item.id">
                    <div class="flex justify-between pl-4">
                        <div>
                          <h4 class="font-bold warnings-title">{{item.title}}</h4>
                          <div class="w-8/12">
                            <p class="warnings-message"><span>{{item.type}}:</span>{{item.message}}</p>
                          </div>
                        </div>
                        <div class="mt-1">
                          <vs-chip>
                            <span>{{ $i18n.locale == 'en' ? 'Late': 'تأخير' }}</span>
                          </vs-chip>
                        </div>
                    </div>
                    <div class="flex justify-between pl-4 pb-1">
                      <p class="hr-name"><span>{{$t('HRname')}} | </span>{{item.name}}</p>
                      <span class="warnings-date">{{item.date}}</span> 
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
export default{
  components: {
      Statistics
    },
    props:{

    },
  data () {
    return {
        warnings: [
        {
          id: 2,
          title: 'انذار تأخير في تسجيل الحضور',
          type:'إنذار تأخير',
          message: ' لديك إنذار تأخير في يوم الأربعاء في بصمة تسجيل الحضور نرجو عدم تكرار هذا الأمر',
          date:'2021/05/12 4:05 AM',
          name:'أحمد المسعودي',
        },
        {
          id          : 3,
          title: 'انذار تأخير في تسجيل الحضور',
          type:'إنذار تأخير',
          message: ' لديك إنذار تأخير في يوم الأربعاء في بصمة تسجيل الحضور نرجو عدم تكرار هذا الأمر',
          date:'2021/05/12 4:05 AM',
          name:'أحمد المسعودي',
        },
        {
          id          : 4,
          title: 'انذار تأخير في تسجيل الحضور',
          type:'إنذار تأخير',
          message: ' لديك إنذار تأخير في يوم الأربعاء في بصمة تسجيل الحضور نرجو عدم تكرار هذا الأمر',
          date:'2021/05/12 4:05 AM',
          name:'أحمد المسعودي',
        },
        {
          id          : 5,
          title: 'انذار تأخير في تسجيل الحضور',
          type:'إنذار تأخير',
          message: ' لديك إنذار تأخير في يوم الأربعاء في بصمة تسجيل الحضور نرجو عدم تكرار هذا الأمر',
          date:'2021/05/12 4:05 AM',
          name:'أحمد المسعودي',
        },
        {
          id          : 6,
          title: 'عنوان التنبيه',
          type:'تنبيه',
          message: 'لديك تنبيه في يوم الأربعاء في بصمة تسجيل الحضور نرجو عدم تكرار هذا الأمر',
          date:'2021/05/12 4:05 AM',
          name:'أحمد المسعودي',
        },
        {
          id          : 7,
          title: 'عنوان التنبيه',
          type:'تنبيه',
          message: 'لديك تنبيه في يوم الأربعاء في بصمة تسجيل الحضور نرجو عدم تكرار هذا الأمر',
          date:'2021/05/12 4:05 AM',
          name:'أحمد المسعودي',
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
#warnings{
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
.warnings-title{
    color:#31323B;
    font-size: .8rem;
}
.warnings-message{
    font-size: .8rem;
    line-height: 1.6;
}
.hr-name{
  padding-top: 2px;
  padding-left: 10px;
  font-size: .6rem;
  color:#696969
}
.warnings-date{
    font-size: .7rem;
    display: inline-block;
    padding-right: 1rem;
}
.bg-divider{
  margin: 2px 0  !important;
}

.con-vs-chip {
  padding:0 20px !important;
  min-height: 0 !important;
}
.vs-chip--text {
    margin-left: 0 !important;
}
</style>

