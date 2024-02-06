
<template>
    <div id="account" class="my-4">
      <div class="container">
        <div class="vx-row flex flex-wrap">
          <div class="vx-col md:w-8/12 w-full column-border">
            <div class="vx-row w-full md:w-9/12">
                <h3 class="font-bold title pl-4 pb-8" style="font-size:.8rem">{{$t('MyAccount')}}</h3>
                <div class="vx-row pl-4 account-settings w-full md:w-4/6">
                    <h5 class="font-medium pb-2">{{$t('AccountAndSetting')}}</h5>
                    <ul>
                        <li @click="$router.push({path: '/personal-information'}).catch(() => {})">
                            <div class="flex justify-between">
                                <div class="flex">
                                    <img src='@assets/images/personal-info.svg' alt="" width="18" class="mr-2"/>
                                    <span class="">{{$t('PersonalInfo')}}</span>  
                                </div>
                                <div>
                                    <img src='@assets/images/left-arrow.svg' alt=""  class="ml-24"/>
                                </div>
                            </div>
                        </li>
                        <li @click="$router.push({path: '/documents'}).catch(() => {})">
                            <div class="flex justify-between">
                                <div class="flex">
                                    <img src='@assets/images/documents.svg' alt="" width="18" class="mr-2"/>
                                    <span class="">{{$t('PersonalDocuments')}}</span>
                            </div>
                            <div>
                                    <img src='@assets/images/left-arrow.svg' alt=""  class="ml-24"/>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex justify-between">
                                <div class="flex">
                                    <img src='@assets/images/language.svg' alt="" width="18" class="mr-2"/>
                                    <span class="">{{$t('Language')}}</span>
                            </div>
                            <div>
                                    <img src='@assets/images/left-arrow.svg' alt=""  class="ml-24"/>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex justify-between">
                                <div class="flex">
                                    <img src='@assets/images/night-mood.svg' alt="" width="18" class="mr-2"/>
                                    <span class="">{{$t('NightMood')}}</span>
                            </div>
                            <div>
                                    <img src='@assets/images/left-arrow.svg' alt=""  class="ml-24"/>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <vs-divider class="bg-divider"/>
                <div class="vx-row w-full md:w-4/6 pl-4">
                    <h5 class="font-medium">{{$t('WorkingTime')}}</h5>
                    <div class="flex working-time">
                        <div>
                            <span class="pr-2">{{ $i18n.locale == 'en' ? 'First Shift': 'الفترة الأولى' }}</span>
                            <span>8:30 - 12:30</span>
                        </div>
                        <div class="pl-5">
                            <span class="pr-2">{{ $i18n.locale == 'en' ? 'Second Shift': 'الفترة الثانية' }}</span>
                            <span>8:30 - 12:30</span>
                        </div>
                    </div>
                </div>
                <div class="vx-row mt-4 pl-4 w-full md:w-4/6">
                    <h5 class="font-medium pb-2">{{$t('Covenant')}}</h5>
                    <div class="covenant">
                        <ul class="flex">
                            <li class="mr-2" v-for="item in account_covenant" :key="item.name">{{item.name}}</li>
                        </ul>
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
      flatPickr,
      Statistics,
      icon
    },
    props:{

    },
  data () {
    return { 
        account_covenant:[
            {name:'الجوال'},{name:'لابتوب'},{name:'سيارة'},
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
#account{
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
.account-settings{
    ul{
        list-style: none;
    }
    ul li{
        padding-bottom: 1rem;
        cursor: pointer;
    }
    ul li span{
        font-size: .8rem;
    }
}
 .working-time  span{
    font-size: .8rem;
    color:#949494;
}
.covenant{
    ul{
        list-style: none;
    }
    ul li{
        font-size: .7rem;
        background: #E7EBEF;
        padding: 0 15px;
        border-radius: 5px;
        line-height: 3;
    }
} 
</style>

