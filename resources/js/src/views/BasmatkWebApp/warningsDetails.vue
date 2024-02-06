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
                <div class="vx-col pr-5">
                  <div class="flex justify-between">
                    <div class="flex">
                      <h4 class="font-bold warning-title pl-4">{{warning_details.title}}</h4>
                      <div class="pl-2">
                        <vs-chip>
                          <span>{{warning_details.type}}</span>
                        </vs-chip>
                      </div>
                    </div>
                    <span class="warning-date">{{warning_details.date}}</span> 
                  </div>
                  <div class="flex justify-between pl-4">
                    <div class="w-9/12">
                      <p class="warning-message pt-2"><span>{{warning_details.type}}:</span>{{warning_details.message}}</p>
                      <div class="pb-1">
                        <p class="hr-name"><span>{{$t('HRname')}} | </span>{{warning_details.name}}</p>
                      </div>
                    </div>
                    <div class="images">
                      <img :src="warning_details.image"  class="responsive"/>
                    </div>
                  </div>
                  <vs-divider class="bg-divider"/>
                </div>
              </div>
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
        warning_details: 
        {
          id: 1,
          title: 'انذار تأخير في تسجيل الحضور',
          type:' تأخير',
          message: ' لديك إنذار تأخير في يوم الأربعاء في بصمة تسجيل الحضور نرجو عدم تكرار هذا الأمر إنذار تأخير في يوم الأربعاء في بصمة تسجيل الحضور نرجو عدم تكرار هذا الأمر',
          date:'2021/05/12 4:05 AM',
          name:'أحمد المسعودي',
          image:require('@assets/images/id-card.png'),
        },
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
          {
            id: 3,
            reply_message: 'لقد تم قبول طلبك',
            time:'PM 8:04',
            date:'2021/05/12',
            name:'أحمد المسعودي',
          },
        ]

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
.warning-title{
    color:#31323B;
    font-size: .8rem;
}
.warning-message{
    font-size: .7rem;
    line-height: 1.6;
    color:#5E5E5E;
}
.warning-date{
    font-size: .7rem;
    display: inline-block;
}
.hr-name{
  padding-top: 2px;
  font-size: .6rem;
  color:#5E5E5E;
  font-weight: 200;
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
