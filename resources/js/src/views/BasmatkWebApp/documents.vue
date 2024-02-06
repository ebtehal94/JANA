
<template>
    <div id="account-files" class="my-4">
      <div class="container">
        <div class="vx-row flex flex-wrap">
          <div class="vx-col md:w-8/12 w-full column-border">
            <div class="vx-row w-full md:w-4/5">
                <h3 class="font-bold title pl-4 pb-8">{{$t('AccountAndSetting')}}</h3>
                <div class="vx-row pl-4  w-full md:w-4/6">
                    <h5 class="files-title pb-2">{{$t('CompanyFiles')}}</h5>
                    <div class="vx-row flex">
                    <div class="vx-col w-full md:w-1/3 pr-4 mb-4 text-center files" v-for="item in company_files"  :key="item.id">
                      <img :src="item.src"  alt=" " class="mx-auto w-full lg:responsive" width="80">
                      <p class="font-semibold">{{item.file_type}}</p>
                      <span>{{item.fromdate}} - {{item.todate}} </span>
                    </div>
                  </div>
                </div>
                <div class="vx-row pl-4  w-full md:w-4/6">
                    <h5 class="files-title pb-2">{{$t('MyFiles')}}</h5>
                    <div class="vx-row flex">
                    <div class="vx-col w-full md:w-1/4 pr-4 mb-4 text-center files" v-for="item in my_files"  :key="item.id">
                      <img :src="item.src"  alt=" " class="mx-auto w-full lg:responsive" width="80">
                      <p>{{item.file_type}}</p>
                      <span>{{item.fromdate}} - {{item.todate}} </span>
                    </div>
                    <div v-for="image in dataUploadedImages" :key="image.link" class="items-center vx-col w-full md:w-1/4 pr-4 ">
                        <img :src="image.url" class="mx-auto w-full lg:responsive" width="120">
                    </div>
                    <div class="vx-col w-full md:w-1/4 add-img ">
                        <input type="file" class="hidden" ref="uploadImgInput" multiple @change="updateCurrImg" accept="image/*">
                        <vs-button  class="text-gray"  type="filled" @click="$refs.uploadImgInput.click()">
                          <h5 class="font-normal text-gray  text-center">{{ $i18n.locale == 'en' ? 'New document ' : 'وثيقة جديدة' }}</h5>
                        </vs-button>
                    </div>
                  </div>
                </div>
                <div class="vx-row pl-4  w-full md:w-4/6">
                    <h5 class="files-title pb-2">{{$t('BankData')}}</h5>
                    <div class="vx-row flex">
                    <div class="vx-col pr-4 mb-4 bank-data">
                      <div class="flex">
                        <div>
                            <img :src="bank_data.src"  alt=" " class="mx-auto w-full lg:responsive">
                        </div>
                        <div class="pl-4">
                            <p><span class="pr-2">{{ $i18n.locale == 'en' ? 'Bank name' : 'إسم البنك' }}</span>{{bank_data.bank_name}}</p>
                            <p><span class="pr-2">{{ $i18n.locale == 'en' ? 'Account No' : 'رقم الحساب' }}</span>{{bank_data.account_no}}</p>
                            <vs-button
                            size="small"
                            class="font-semibold rounded-full"
                            color="#989898">
                              {{ $i18n.locale == 'en' ? 'Edit Data' : 'تعديل البيانات' }}
                            </vs-button>
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
        company_files:[
          {
            id: 2,
            src:require('@assets/images/id-card.png'),
            file_type:'السجل التجاري',
            fromdate:'12/04/2020',
            todate:'12/04/2020',
          },
        ],
        my_files:[
          {
            id: 1,
            src:require('@assets/images/id-card.png'),
            file_type:'السجل التجاري',
            fromdate:'12/04/2020',
            todate:'12/04/2020',
          },
        {
            id: 2,
            src:require('@assets/images/id-card.png'),
            file_type:'رخصة القيادة',
            fromdate:'12/04/2020',
            todate:'12/04/2020',
          },
        {
            id: 3,
            src:require('@assets/images/id-card.png'),
            file_type:'السيرة الذاتية',
            fromdate:'12/04/2020',
            todate:'12/04/2020',
          },
        ],
        dataUploadedImages:[],
        bank_data:{
            src:require('@assets/images/id-card.png'),
            bank_name:'بنك الراجحي',
            account_no:'123456789',
        }
    }
     

  },
  computed: {
  
  },
  
  methods: {
        updateCurrImg(input) {
        if (input.target.files && input.target.files[0]) {
        var reader = new FileReader()
        reader.onload = e => {
          this.dataUploadedImages = input.target.files
          for (var i = 0; i < this.dataUploadedImages.length; i++) {
            const url = URL.createObjectURL(this.dataUploadedImages[i])
            this.dataUploadedImages[i].url = url
          }
        }
        reader.readAsDataURL(input.target.files[0])
      }
    },
  },
  created(){

  }

}
</script>
<style lang="scss">
#account-files{
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
.files-title{
  color: #5E5E5E;
  font-size: .8rem;
  font-weight: normal;
}
.files{
    p{
        font-size: .7rem;
    }
    span{
        font-size: .5rem;
        display: block;
        color:#A5A5A5;
    }
}
.add-img .vs-button{
    font-family: "Cairo", sans-serif !important;
    color:#ACACAC;
    padding:24px 20px;
    border-radius: 15px;
    background: #F1F3F6 !important;
}
.vs-button-primary.vs-button-filled:hover {
    -webkit-box-shadow: none;
    box-shadow: none;
}
.bank-data{
  p{
    color:#5E5E5E;
    font-size: .7rem;
  }
  span{
    color:#989898;
  }
  .vs-button.small {
    font-family: "Cairo", sans-serif !important;
    padding: 0 10px !important;
  }
  .vs-button--text{
    color:#fff !important;
    font-size: .6rem !important;
  }
}
</style>

