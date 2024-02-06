
<template>
    <div id="requests" class="my-4">
      <div class="container">
        <div class="vx-row flex flex-wrap">
          <div class="vx-col md:w-8/12 w-full column-border">
            <div class="vx-row w-full md:w-4/5">
                <div class="flex">
                    <h3 class="font-bold title pl-4">{{$t('Requests')}}</h3>
                    <vs-button
                    size="small"
                    class="mx-4 mb-4 rounded-full px-4"
                    color="#00CA77"
                    @click="newQuestion()">
                    {{$i18n.locale == "en" ? "Create New Request" : "إنشاء طلب جديد"}}
                    </vs-button>
                </div>
                <div class="pl-4 pt-2">
                    <ul class="flex text-center">
                        <li class="" v-for="item in requests_type" :key="item.id">
                          <button class="btn"><img :src="item.graphic" alt="graphic"  width="25" height="25" class="mx-auto text-grey"></button>
                          <span>{{ $i18n.locale == 'en' ? item.title_en: item.title_ar}}</span>
                        </li>
                    </ul>
                </div>
                <vs-divider/>
                <div class="vx-row">
                  <div class="vx-col pr-5 my-4" v-for="item in requests" :key="item.id">
                    <div class="flex justify-between">
                        <div>
                            <vs-chip>
                                <span>{{item.request_type}}</span>
                            </vs-chip>
                        </div>
                        <span class="request-date">{{item.date}}</span> 
                    </div>
                    <div class="w-7/12 mb-2">
                        <p class="request-message">{{item.message}}</p>
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
      requests_type: [
        {
          id          : 1,
          title_ar       : 'كل الطلبات',
          title_en       : 'All requests',
          graphic     :require('@assets/images/basmatk/graphic-10.svg'),
          url         :'/knowledge-base-category'
        },
        {
          id          : 2,
          title_ar       : 'طلبات الإجازة',
          title_en       : 'Vacation requests',
          graphic     : require('@assets/images/request-2.svg'),
          url         :'/knowledge-base-category'
        },
        {
          id          : 3,
          title_ar       : 'تسجيلات منسية',
          title_en       : 'Missing checkouts',
          graphic     : require('@assets/images/request-3.svg'),
          url         :'/knowledge-base-category'
        },
        {
          id          : 4,
          title_ar       : 'طلبات السلف',
          title_en       : 'Advance Requests',
          graphic     : require('@assets/images/request-4.svg'),
          url         :'/knowledge-base-category'
        },
        {
          id          : 5,
          title_ar       : 'طلبات الإستئذان',
          title_en       : '',
          graphic     : require('@assets/images/request-5.svg'),
          url         :'/knowledge-base-category'
        },
        {
          id          : 6,
          title_ar       : 'إضافي دوام',
          title_en       : 'ُEmployees',
          graphic     : require('@assets/images/request-6.svg'),
          url         :'/knowledge-base-category'
        },
        {
          id          : 7,
          title_ar       : 'إزالة تأخير',
          title_en      : 'Finance',
          graphic     : require('@assets/images/request-7.svg'),
          url         :'/knowledge-base-category'
        },

        {
          id          : 10,
          title_ar       : 'طلبات أخرى',
          title_en       : 'Requests',
          graphic     : require('@assets/images/request-8.svg'),
          url         :'/knowledge-base-category'
        }
      ],
        requests: [
        {
          id: 2,
          request_type:'تغيير جوال',
          message: 'نرجو منكم تغيير رقم الجوال الى هذا الرقم 5679790823 حيث قمت بشراء جوال جديدشاكر ومقدر لتعاونكم ',
          date:'2021/05/12 4:05 AM',

        },
        {
          id          : 3,
          request_type:'إجازة طارئة',
          message: 'نرجو منكم تغيير رقم الجوال الى هذا الرقم 5679790823 حيث قمت بشراء جوال جديدشاكر ومقدر لتعاونكم ',
          date:'2021/05/12 4:05 AM',

        },
        {
          id          : 4,
          request_type:'إستئذان',
          message: 'نرجو منكم تغيير رقم الجوال الى هذا الرقم 5679790823 حيث قمت بشراء جوال جديدشاكر ومقدر لتعاونكم ',
          date:'2021/05/12 4:05 AM',

        },
        {
          id          : 5,
          request_type:'تسجيلات منسية',
          message: 'نرجو منكم تغيير رقم الجوال الى هذا الرقم 5679790823 حيث قمت بشراء جوال جديدشاكر ومقدر لتعاونكم ',
          date:'2021/05/12 4:05 AM',

        },
        {
          id          : 6,
          request_type:'تغيير جوال',
         message: 'نرجو منكم تغيير رقم الجوال الى هذا الرقم 5679790823 حيث قمت بشراء جوال جديدشاكر ومقدر لتعاونكم ',
          date:'2021/05/12 4:05 AM',

        },
        {
          id          : 7,
          request_type:'إجازة طارئة',
          message: 'نرجو منكم تغيير رقم الجوال الى هذا الرقم 5679790823 حيث قمت بشراء جوال جديدشاكر ومقدر لتعاونكم ',
          date:'2021/05/12 4:05 AM',
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
ul{
  list-style: none;
}
ul li span{
  font-size: .6rem;
  display: inline-block;
}
.btn{
  border: 1px solid #acacac;
  border-radius: 50%;
  padding: 10px 10px;
  line-height: 9px;
  background: #fff;
  cursor: pointer;
}
.btn:active , .btn:hover{
  background: #0E77FF;
  box-shadow: rgba(14, 119, 255, 50%) 0px 8px 24px;
  border: none;
}
.vs-button.small {
    font-family: "Cairo", sans-serif !important;
    padding: 3px;
    font-weight: 400;
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

