
<template>
    <div id="requests" class="my-4">
      <div class="container">
        <div class="vx-row flex flex-wrap new-request">
          <div class="vx-col md:w-8/12 w-full column-border">
            <div class="vx-row w-full md:w-9/12">
              <h3 class="font-bold title pl-4 pb-4" style="color:#ACACAC">{{$t('SendRequest')}}</h3>
                
              <div class="bg-input">
                <v-select class="w-full mt-4 text-sm"
                :placeholder="$t('RequestType')"
                v-model="request_data.request_id"
                v-validate="'required'"
                label="title_ar" :options="request_type"
                :reduce="title_ar => title_ar.id"
                :dir="$vs.rtl ? 'rtl' : 'ltr'"
                name="request_type"/>
              </div>
              <div class="vx-row flex">
                <div class="vx-col w-full md:w-1/2">
                  <div class="bg-input">
                    <icon name="date" class="icon"/>
                    <flat-pickr
                    class="w-full mt-2 vacation-date"
                    :config="configFromdateTimePicker"
                    v-model="request_data.startVacation"
                    :placeholder="$t('StartVacationDate')"
                    @on-change="onFromChange" />
                  </div>
                </div>
                <div class="vx-col w-full md:w-1/2">
                <div class="bg-input">
                  <icon name="date" class="icon phone-icon"/>
                  <flat-pickr
                  class="w-full mt-2 ml-1 vacation-date"
                  :config="configTodateTimePicker"
                  v-model="request_data.startVacation"
                  :placeholder="$t('EndVacationDate')"
                  @on-change="onToChange" />
                </div>
                </div>
              </div>
              <div class="bg-input">
                <vs-textarea
                v-model="request_data.notes"
                :placeholder="$t('Notes')"
                class="mt-2 w-full"
                height="100px"/>
              </div>
              <div>
                <ul class="flex">
                    <li class="">
                      <input class="styled-checkbox" id="styled-checkbox-1" type="checkbox" value="value1">
                      <label for="styled-checkbox-1">{{$t('RequestTicket')}}</label>
                    </li>
                    <li class="ml-2">
                      <input class="styled-checkbox" id="styled-checkbox-2" type="checkbox" value="value2">
                      <label for="styled-checkbox-2">{{$t('RequestVisa')}}</label>
                    </li>
                  </ul>
              </div>
              <div class="bg-input">
                <input type="file" class="hidden" ref="uploadImgInput" multiple @change="updateCurrImg" accept="image/*">
                <icon name="attachments" class="icon attach-icon"/>
                <vs-input
                class="w-full  mt-2 text-base"
                :placeholder="$t('Attachements')"
                v-validate="'required'"
                icon-no-border
                icon="icon"
                 @click="$refs.uploadImgInput.click()"/>
              </div>
              <div class="vx-row flex">
              <div v-for="img in dataUploadedImages" :key="img.data" class="items-center vx-col w-full md:w-1/4 mt-4 mb-4 px-1 cardBox">
                <img :src="img.url" class="mx-auto w-full lg:responsive" width="80">
              </div>
              </div>
              <div class="vx-row flex  mt-8 ">
                  <vs-button
                    size="small"
                    class="mr-2 w-full mb-4 font-semibold text-sm rounded-full px-24"
                    color="#0E77FF"
                    @click="sendRequest">
                      {{$i18n.locale == "en" ? "Send Request" : "إرسال الطلب"}}
                  </vs-button>
                  <vs-button
                    size="small"
                    class="ml-2 w-full mb-4 font-semibold text-sm rounded-full"
                    color="#ACACAC" type="border"
                    @click="goBack">
                      {{ $i18n.locale == 'en' ? 'Back' : 'رجوع' }}
                  </vs-button>
                  
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
import vSelect from 'vue-select'
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import Statistics from "./components/statistics.vue"
import icon from '@/layouts/components/icon.vue';
export default{
  components: {
      vSelect,
      flatPickr,
      Statistics,
      icon
    },
    props:{

    },
  data () {
    return {
        request_data:{request_id:null,startVacation:null,endVacation:null,notes:null},
        request_type:[
        {title_ar:'طلب الإجازة',id:1},
        {title_ar:'طلب سلفة',id:2},
        {title_ar:'تسجيلات منسية',id:3},
        {title_ar:'طلب إستئذان',id:4},
        {title_ar:'إضافي دوام',id:5},
        {title_ar:'إزالة تأخير',id:6},
      ],
      configFromdateTimePicker: {
        maxDate: null
      },
      configTodateTimePicker: {
        minDate: null
      },
      dataUploadedImages: [],
    }

  },
  computed: {
  
  },
  
  methods: {
    updateCurrImg (input) {
      if (input.target.files && input.target.files[0]) {
        const reader = new FileReader()

        reader.onload = e => {
          this.dataUploadedImages = input.target.files

          for (let i = 0; i < this.dataUploadedImages.length; i++) {
            const url = URL.createObjectURL(this.dataUploadedImages[i])
            this.dataUploadedImages[i].url = url
          }
        }
        reader.readAsDataURL(input.target.files[0])
      }
    },
    onFromChange(selectedDates, dateStr, instance) {
      this.$set(this.configTodateTimePicker, 'minDate', dateStr);
    },
    onToChange(selectedDates, dateStr, instance) {
      this.$set(this.configFromdateTimePicker, 'maxDate', dateStr);
    },
    sendRequest(){
        axios.post("/api/request/create",this.request_data)
        .then(res => {
          if( res.data.statusCode == 200 ){
            this.$vs.notify({
            color: 'success',
            title: 'Successfull',
            text: 'تم بنجاح'
            })
          }else{
            this.$vs.notify({
            color: 'danger',
            title: 'Error',
            text: 'حدث خطأ ما'
            })
          }
        })
        .catch(function (error) {
            console.log(error.response);
        });

    },
    goBack(){
      this.$router.go(-1)
    },
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
  .bg-input{
    position: relative;
    .icon{
      position: absolute;
      top:15px;
      left: 15px;
      z-index:1;
      padding-right: 20px;
    }
    .phone-icon{
      position: absolute;
      top:15px;
      left: 18px;
    }
    .attach-icon{
      top:5px;
      left: 10px;
      z-index:1;
      padding-right: 20px;
    }

  }
  .vacation-date{
    border:1px solid #DBE2ED !important;
    padding:  0.5rem 0 0.5rem 2.5rem !important
  }
.vs-button.small {
    font-family: "Cairo", sans-serif !important;
    padding: 3px;
    font-weight: 400;
}
.vs-textarea{
  font-family: "Cairo", sans-serif !important;
}
.vs-con-textarea{
  border:1px solid #DBE2ED !important;
  height: 120px;
  border-radius: 18px;
  margin-bottom: 10px;
}
ul{
  list-style: none;
}
.styled-checkbox {
  position: absolute;
  opacity: 0;
}
.styled-checkbox + label {
  position: relative;
  cursor: pointer;
  padding:  0;
  font-size: .7rem;
}
.styled-checkbox + label:before {
  content: "";
  margin-right: 5px;
  margin-top: 5px;
  display: inline-block;
  vertical-align: text-top;
  width: 10px;
  height: 10px;
  background: white;
  border:1px solid #c2c2cc;
  border-radius: 50%;
}
.styled-checkbox label:before {
  background: #0E77FF;
}
.styled-checkbox:checked + label:before {
  background: #0E77FF;
}

.styled-checkbox:checked + label:after {
  content: "✓";
  position: absolute;
  left: 3px;
  top:0px;
  color: #fff;
  font-size: 10px;
}
.vs-input--input.normal {
    border:1px solid #DBE2ED !important;
    padding: .4rem 1rem !important;
    border-radius: 25px !important;
    height: 40px;
}
.vs-input--placeholder {
    left: 10px !important;
}
</style>

