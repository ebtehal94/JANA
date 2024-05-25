
<template>
    <div>
      <!-- Navbar -->
      <navbar />
      
      <!--- Header --->
      <header class="section header text-contrast app-landing-header main-header">
        <img src="@assets/images/basmatk/Register-header.png" class="absolute main-img-header-1">
          <div class="container overflow-hidden">
            <div class="row gap-y text-left">
              <div class="col-md-6 col-lg-6 header-desc">
                <!-- <p class="lead d-flex align-items-center my-0"><i class="fas fa-award font-md mr-3"></i>{{$t('HeaderF1')}}</p> -->
                <h1 class="extra-bold text-contrast d-flex align-items-center mb-4 ml-6" >{{$t('HeaderF3')}}</h1>
                <h4 class="text-light text-contrast align-items-center ml-6 mb-4">{{$t('TryHeader2')}}</h4>
                <!-- <p class="lead w-1/2 md:w-full"> {{$t('HeaderF4')}} </p> -->
        
                    <div class="ml-6 text-left flex">
                      <ul class="list-unstyled feat-list text-sm font-semibold">
                        <li class="mb-3 relative flex" v-for="item in feats" v-bind:key="item.id">
                          <img src="@assets/images/basmatk/check.svg" width="15px" class="check">
                          <vs-chip
                          color="info">
                          {{ $i18n.locale == 'en' ? (item.name_en || $t('NA')) : (item.name_ar  || $t('NA'))}}
                          </vs-chip> 
                        </li>
                      </ul>
                    </div>

                <div class="contact-btn pl-6">
                  <p class="text-contrast font-semibold">{{$i18n.locale == "en" ? "Do you have a question ?" : "هل لديك استفسار ؟"}}</p>
                  <a href="/" :alt="$t('ContactUs')" class="btn btn-rounded btn-solid font-extrabold btn-lg shadow text-capitalize" >{{$t('ContactUs')}}
                    <img class="pl-2" src="@assets/images/basmatk/help.svg">
                  </a>
                  <span class="text-contrast block mt-2">{{$i18n.locale == "en" ? "Available from 8 am to 4 pm during working days" : "متاح من الساعة 8 صباحاَ حتى 4 مساءَ خلال أيام العمل"}}</span>
                </div>
              </div>
              <div class="col-md-4 col-lg-4">
                <vx-card class="rounded-corner shadow-none mt-8">
                  <div slot="no-body">
                    <div class="vx-row no-gutter py-4">
                      <div class="w-full bg-steps cursor-pointer">
                                <span @click="goToTab(1)"
                                      class="steps-btn border inline-block font-semibold"
                                      :class="{ active: activeTab == 1 }">1</span>
                                <span
                                      @click="goToTab(2)"
                                      class="steps-btn border inline-block font-semibold"
                                      :class="{ active: activeTab == 2 }">2</span>
                                <!-- <span
                                      @click="goToTab(3)"
                                      class="steps-btn border inline-block font-semibold"
                                      :class="{ active: activeTab == 3 }">3</span> -->
                      </div>
                      <div class="vx-col w-full">
                        <div class="p-8 login-tabs-container">
                          <div class="vx-card__title mb-4">
                            <div>
                              <h4 class="welcome-text mb-2 mt-6 text-sm">{{$t('EnterData')}}</h4>
                              <h4 class="try-text font-bold mb-0">{{$t('FreeAccount') }}</h4>
                              <span class="text-xs text-black mb-4 inline-block">{{$i18n.locale == "en" ? "For 7 Days" : "لمدة 7 أيام"}}</span>
                            </div>
                          </div>

                          <div  v-if="activeTab === 1">
                            <div class="bg-input">
                              <icon name="name" class="icon"/>
                              <vs-input
                                class="w-full text-base inputer"
                                :placeholder="$t('CompanyBusinessName')"
                                v-model="settings_data.title"
                                data-vv-validate-on="blur"
                                v-validate="{
                                            required: true,
                                            min: 3,
                                            regex: /^[\u0621-\u064Aa-zA-Z\d\-_\s]+$/
                                            }"
                                name="company-name"
                                type="text"
                                icon-no-border
                                icon="icon"/>

                              <span v-if="!errors.has('company-name') && settings_data.title">
                                <icon name="confirm" class="icon left-icon"/>
                              </span>
                              <span v-else-if="errors.has('company-name')">
                                <icon name="cross" class="icon left-icon"/>
                              </span>
                            </div>

                            <div class="bg-input">
                              <icon name="employee-num" class="icon"/>
                              <v-select
                                class="w-full mt-2"
                                :placeholder='$t("employeeNum")'
                                v-model="settings_data.employee_num"
                                v-validate="'required'"
                                label="text" :options="employees"
                                :reduce="text => text.value"
                                :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                              <span
                                v-if="!errors.has('employees') && settings_data.employee_num">
                                <icon name="confirm" class="icon left-icon"/>
                              </span>
                              <span v-else-if="errors.has('employees')">
                                <icon name="cross" class="icon left-icon"/>
                              </span>
                            </div>

                          <!-- <model-list-select
                            :list="CountriesList"
                            v-model="country_id"
                            option-value="id"
                            :option-text="$i18n.locale == 'en' ? 'name_en' : 'name_ar'"
                            placeholder=""
                            class="vx-col w-1/2 md:w-2/12 rounder-corners">
                          </model-list-select> -->

                            <div>
                              <vs-button
                                class="lg:w-2/4 mt-6 font-bold register-btn small text-base"
                                color="#0C65D1"
                                @click="goToTab(2)">
                                {{$i18n.locale == "en" ? "Start Now >>" : "ابدأ الآن >>"}}
                              </vs-button>
                            </div>
                          </div>

                          <div v-if="activeTab === 2">
                            <div class="bg-input">
                              <icon name="employee" class="icon employee-icon"/>
                              <vs-input
                                class="w-full text-base mt-2 "
                                :placeholder="$t('YourName')"
                                v-model="user_data.name"
                                v-validate="{
                                            required: true,
                                            min: 3,
                                            regex: /^[\u0621-\u064Aa-zA-Z\d\-_\s]+$/
                                            }"
                                name="name"
                                icon-no-border
                                icon="icon"/>

                              <span v-if="!errors.has('name') && user_data.name">
                                <icon name="confirm" class="icon left-icon"/>
                              </span>
                              <span v-else-if="errors.has('name')">
                                <icon name="cross" class="icon left-icon"/>
                              </span>
                            </div>

                          <div class="vx-row bg-input">
                            <icon name="mobile" class="icon phone-icon"/>
                            <vs-input
                              :placeholder="$t('Mobile')"
                              v-model="user_data.mobile"
                              type="number"
                              icon-no-border
                              icon="icon"
                              v-validate="'required|max:10|min:7'"
                              class="w-3/4 mt-2 px-3"
                              name="mobile"/>

                            <vs-input
                              v-model="user_data.cc"
                              type="number"
                              dir="ltr"
                              icon-no-border
                              v-validate="'required|max:4|min:1'"
                              class="w-1/5 mt-2"
                              placeholder="966"/>

                            <span v-if="!errors.has('mobile') && user_data.mobile">
                              <icon name="confirm" class="icon left-phone-icon"/>
                            </span>
                            <span v-else-if="errors.has('mobile')">
                              <icon name="cross" class="icon left-phone-icon"/>
                            </span>
                            
                          </div>
                          
                          <div class="bg-input">
                            <icon name="email" class="icon"/>
                            <vs-input
                              v-validate="'required|email|min:3'"
                              data-vv-validate-on="blur"
                              icon-no-border
                              icon="icon"
                              :placeholder="$t('Email')"
                              v-model="user_data.email"
                              class="w-full mt-2"
                              name="email"/>

                            <span v-if="!errors.has('email') && user_data.email">
                              <icon name="confirm" class="icon left-icon"/>
                            </span>
                            <span v-else-if="errors.has('email')">
                              <icon name="cross" class="icon left-icon"/>
                            </span>
                          </div>

                          <div class="bg-input">
                            <icon name="password" class="icon"/>
                            <vs-input
                              data-vv-validate-on="blur"
                              :placeholder="$t('Password') "
                              v-validate="'required|min:6'"
                              type="password"
                              ref="password"
                              name="password"
                              icon-no-border
                              icon="icon"
                              v-model="user_data.password"
                              class="w-full mt-2"
                              @input="passwordCheck"/>

                            <span v-if="isPasswordValid && user_data.password">
                              <icon name="confirm" class="icon left-icon"/>
                            </span>
                            <span v-else-if="errors.has('password')">
                              <icon name="cross" class="icon left-icon"/>
                            </span>
                            <div v-if="user_data.password">
                              <div v-for="check in passwordChecks"
                                          :key="check.label"
                                          class="vx-row flex md:ml-2 mt-2">
                                <feather-icon :icon="check.value? 'CheckCircleIcon': 'XCircleIcon'"
                                              :svgClasses="'w-4 h-4 ' +(check.value == true? 'text-success': 'text-danger')"/>
                                <p class="text-xs text-grey m-0 ml-2">{{ check.label }}</p>
                              </div>
                            </div>
                          </div>

                          <div class="bg-input">
                            <icon name="password" class="icon"/>
                            <vs-input
                              :placeholder="$t('ConfirmPassword')"
                              v-validate="'min:6|confirmed:password'"
                              type="password"
                              name="confirm_password"
                              data-vv-as="password"
                              icon-no-border
                              icon="icon"
                              v-model="user_data.confirm_password"
                              class="w-full mt-2"/>

                            <span v-if="!errors.has('confirm_password') && user_data.confirm_password">
                              <icon name="confirm" class="icon left-icon"/>
                            </span>
                            <span v-else-if="errors.has('confirm_password')">
                              <icon name="cross" class="icon left-icon"/>
                            </span>
                          </div>
                            <div>
                              <vs-button
                                class="lg:w-2/4 mt-6 font-bold register-btn small text-base"
                                color="#0C65D1"
                                @click="save_data()">
                                {{$i18n.locale == "en" ? "Start Now >> " : "ابدأ الآن >>"}}
                              </vs-button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- <div class="vx-col sm:w-full md:w-full lg:w-full" v-if="activeTab === 3">
                        <div class="vx-row justify-center items-center">
                          <div class="center">
                            <div class="items-center vx-col w-full mt-4">
                              <img src="@assets/images/basmatk/Login-confirm.png" width="30%">
                            </div>
                        </div>
                      </div>
                        <div class="p-8 login-tabs-container text-center">
                          <div class="vx-card__title">
                            <div>
                              <h4 class="mb-4 text-lg font-extrabold">{{$t('tryTitle1')}}<span class="try-text font-extrabold"> {{$t('tryTitle2')}}</span></h4>
                              <span class="text-black">ارسلنا رمز التفعيل للرقم<span class="text-black">{{user_data.mobile}}</span></span>
                              <a class="activate-btn p-0 text-sm" href="https://basmtak.com/login">{{$i18n.locale == "en" ? "(ُEdit)" : "(تعديل)"}}</a>

                            </div>
                          </div>
                          <div  class="mt-4 justify-center" style="display: flex; flex-direction: row;">
                            <v-otp-input
                              ref="otpInput"
                              input-classes="otp-input"
                              :num-inputs="4"
                              :should-auto-focus="true"
                              :is-input-num="true"
                            />
                        </div>
  
                        <div> 
                            <div class=" mb-3 text-center">
                              <vs-button
                                class="w-3/4 mt-10 font-bold register-btn"
                                color="#0C65D1"
                                @click="registerUser">
                                {{$i18n.locale == "en" ? "Start Your Free Account Now" : "ابدأ حسابك المجاني الآن"}}
                                </vs-button>
                            </div>
                        </div> 
                      </div>
                      </div> -->
                    </div>
                  </div>
                </vx-card>

              </div>
            </div>
          </div>
      </header>
      
      <!-- Clients -->
      <clients />

      <!--Star Rating-->
      <div class="row gap-y justify-content-center">
        <div class="col-4">
          <vx-card class="border-0 text-center align-items-center star-box absolute shadow-none d-none d-md-block">
            <h6 class="mt-5 mb-4 text-white">{{$i18n.locale == "en" ? "Join over 5,000 customers" : "انضم لاكثر من 5,000 عميل"}}</h6>
            <star-rating :rtl="$vs.rtl" :star-size="40" :read-only="true" :rating="5" :rounded-corners="true" class="star"></star-rating>
        </vx-card>
        </div>
      </div>

      <!-- Mobile -->
      <mobile />

      <!-- Dashboard -->
      <dashboard />

      <!-- Footer -->
      <siteFooter />
    </div>
  </template>
  
  
  
  <script>
  import './common-script.js'
  import './site.js'
  import moduleUserManagement from "@/store/user-management/moduleUserManagement.js";
  import icon from '../../../layouts/components/icon.vue';
  import vSelect from 'vue-select';
  import I18n  from "@/layouts/components/navbar/components/I18n.vue"
  import { CountriesList } from "../extra/CountriesList.js";
  import StarRating from 'vue-star-rating'
  // import { ModelListSelect } from "vue-search-select"
  import "vue-search-select/dist/VueSearchSelect.css";
  import navbar from "./components/Navbar.vue"
  import clients from "./components/clients.vue"
  import mobile from "./components/mobile.vue"
  import dashboard from "./components/dashboard.vue"
  import siteFooter from "./components/siteFooter.vue"
  import Echo from "laravel-echo";
  
  
  
  export default {
    components: {
       icon ,
       vSelect,
       StarRating,
       I18n,
       navbar,
       mobile,
       dashboard,
       clients,
       siteFooter,
      // ModelListSelect 
       },
    data() {
      return {
          feats:[{id: 1,name_ar: "ادارةالحضور والانصراف",name_en: "Attendance and departure management"},
                 {id: 2,name_ar:"ادارة طلبات الاجازات وادارة الطلبات الاخرى",name_en: "Managing leave requests and managing other requests"},
                 {id: 3,name_ar:"مسير رواتب تلقائي بضغطة زر",name_en: "Automatic Salary Payment System with the press of a button"},
                 {id: 4,name_ar:"ادارة واسناد المهام بقوائم جاهزة وقابلة للتخصيص",name_en: "Managing and assigning tasks with ready-made and customizable lists"},
                 {id: 5,name_ar:"ارشفة جميع المستندات وتذكير دوري بتواريخ الانتهاء",name_en: "Archiving all documents and periodic reminders of expiration dates"},
                 {id: 6,name_ar:"تقييم الاداء بإحصائيات مفصلة عن كل موظف",name_en: "Evaluating performance with detailed statistics for each employee"},],
          activeTab: 1,
          country_id: 1,
          CountriesList: CountriesList,
          user_data: {
                name: null,
                email: null,
                mobile: null,
                password: null,
                confirm_password: null,
                cc: "966"
            },
            settings_data: {
                title: null,
                country_id: 1,
                timezone: "Asia/Riyadh",
                employee_num: null,
            },
            employees:[
            {text:'1-10' ,value:1},
            {text:'11-100' ,value:2},
            {text:'101-500' ,value:3},
            {text:'101-500' ,value:4},
            {text:'501-1000' ,value:5},
            {text:'1001-2000' ,value:6},
            ],
            passwordChecks: [
                { label: this.$t("passwordCondition2"), value: false }, // 1 capital & 1 small
                { label: this.$t("passwordCondition3"), value: false }, // 1 number
                { label: this.$t("passwordCondition4"), value: false }, // 1 special char
                { label: this.$t("passwordCondition1"), value: false } // 8 chars
            ],
            isPasswordValid: false,
      }
    },
    computed: {

    },
    watch: {
        country_id(val) {
            // if (val != this.country_id){
              console.log(val);
              console.log(val);
              console.log(val);
            this.country = this.CountriesList.find(
                country => country.id == val
            );
            if (this.country.CC) {
                this.user_data.cc = this.country.CC;
                this.settings_data.country_id = val;
                this.settings_data.country_id = this.country.timezone;
            }
            // }
        }
    },
    methods: {
      passwordCheck() {
            let password = this.user_data.password;
            this.passwordChecks[0].value =
                /[a-z]/.test(password) && /[A-Z]/.test(password);
            this.passwordChecks[1].value = /\d/.test(password);
            this.passwordChecks[2].value = /[!@#\$%\^\&*\)\(+=._-]/.test(
                password
            );
            this.passwordChecks[3].value = password.length >= 8;

            if (
                !this.passwordChecks[0].value ||
                !this.passwordChecks[1].value ||
                !this.passwordChecks[2].value ||
                !this.passwordChecks[3].value
            ) {
                this.isPasswordValid = false;
            } else {
                this.isPasswordValid = true;
            }
        },
      checkLogin() {
            if (this.$store.state.auth.isUserLoggedIn()) {
                this.$vs.notify({
                    title: "خطاء",
                    text: "لقد قمت بتسجيل الدخول مسبقاً",
                    iconPack: "feather",
                    icon: "icon-alert-circle",
                    color: "warning"
                });
                return false;
            }
            return true;
        },
      goToTab(tab) {
            // if (this.errors.any()){
            if (
                this.errors.any() ||
                !this.settings_data.title ||
                // !this.user_data.name ||
                !this.settings_data.employee_num
            ) {
                this.$vs.notify({
                    color: "danger",
                    title: this.$t("Error"),
                    text: this.$t("PleaseFillAllFields")
                });
                return;
            }
            this.activeTab = tab;
            // return this.$refs.createAccountWizard.nextTab()
        },
      encrypt(pwd) {
            var encodedString = btoa(pwd);
            console.log(encodedString); // Outputs: "SGVsbG8gV29ybGQh"
            return encodedString;
      },
      setHisCurrentCountry() {
            if (localStorage.getItem("ipInfo")) {
                var ipInfo = JSON.parse(localStorage.getItem("ipInfo"));
                if (ipInfo.country_code && ipInfo.country_code != "SA") {
                    this.country = this.CountriesList.find(
                        country => country.code == ipInfo.country_code
                    );
                    if (this.country && this.country.id) {
                        this.country_id = this.country.id;
                    }
                    console.log('changed!!!')
                    console.log(this.country_id)
                }
            }
        },
      save_data() {
            if (
                this.errors.any() ||
                !this.user_data.name ||
                !this.user_data.email ||
                !this.user_data.mobile ||
                !this.user_data.password ||
                !this.user_data.confirm_password
            ) {
                this.$vs.notify({
                    color: "danger",
                    title: this.$t("Error"),
                    text: this.$t("PleaseFillAllFields")
                });
                return;
            }
            this.$vs.loading();
            // get timezone of selected country
            this.settings_data.country_id = this.country_id;
            this.settings_data.timezone = this.CountriesList.find(
                country => country.id == this.country_id
            ).timezone;
            var password = this.encrypt(this.user_data.password);
            var payload = {
                user: this.user_data,
                settings: this.settings_data
            };
            payload.user.password = password;
            // console.log(payload)
            return new Promise((resolve, reject) => {
                this.$store
                    .dispatch("auth/registerUserJWT", payload)
                    .then(res => {
                        this.$vs.loading.close();
                        if (res.data.accessToken) {
                            this.$vs.notify({
                                color: "success",
                                title: "Successfull",
                                text: "تم التسجيل بنجاح",
                                position: "top-center"
                            });

                            this.$acl.change(res.data.userData.rule);

                            // ability.update([]);
                            // if (res.data.userData.perms.length) {
                            //     ability.update(res.data.userData.perms);
                            // }
                            // this.$store.dispatch(
                            //     "widgetsList/setWidgets",
                            //     res.data.homeItems
                            // );

                            if (
                                this.$router.currentRoute.path != "/dashboard"
                            ) {
                                // console.log(router.currentRoute.path)
                                this.$router.push("/dashboard");
                            }
                        }
                    })
                    .catch(error => {
                        this.$vs.loading.close();
                        this.$vs.notify({
                            color: "danger",
                            title: "خطاء",
                            text: error,
                            position: "top-center"
                        });
                    });
            });
        },
        
    },
    created() {
      console.log(this.CountriesList)
      if (!this.checkLogin()) {
            this.$router.push("/dashboard");
        }
        // if (!modulehomeManagement.isRegistered) {
        //     this.$store.registerModule("widgetsList", modulehomeManagement);
        //     modulehomeManagement.isRegistered = true;
        // }
        if (localStorage.getItem("ipInfo")) {
            this.setHisCurrentCountry();
        } else {
            setTimeout(() => {
                this.setHisCurrentCountry();
            }, 1000);
        }
        // Register Module UserManagement Module
        // if(!moduleUserManagement.isRegistered) {
        //   this.$store.registerModule('userManagement', moduleUserManagement)
        //   moduleUserManagement.isRegistered = true
        // }
  
        // if (localStorage.getItem('isRegistered')){
        //   this.activeTab = 3
        // }
    }
  };
  </script>
  <style>
  @import './css/indexMainTheme.css';
  </style>
  
  <style lang="scss">
  /* Header ========================================================== */
  .main-header .header-desc{
    margin-top: 4rem !important;
    padding-left:4rem !important;
  }
  .main-header h1{
    margin-top: 4rem;
  }
  .main-header h2{
     font-size:1.5rem;
  }
  .main-header .contact-btn{
    margin-top: 3rem !important;
  }
  .main-header .contact-btn .btn{
    background: #ffffff;
    color: #0083dd;
  }
  .main-header .contact-btn span{
    font-size: 10px;
  }
  @media (min-width: 768px){

    .app-landing-header .container {
        padding-bottom: 6rem !important;
    }
    .main-header .header-desc{
      margin-top: 0 !important;
    }
    .main-header h2{
      font-size:2rem;
    }
    .main-header .contact-btn{
      margin-top: 2rem !important;
    }
  }
  .main-img-header-1{
    top:0;
    left:0;
    width:100%;
    height: 100%;
    object-fit: cover;
  }
  @media (min-width: 1600px){
    .main-header{
      height: 1150px; 
    }
  }
  .con-vs-chip{
    background: #0e115c33;
    border-radius: 7px;
    padding: 5px;
  }
  .check{
    position: absolute;
    left: -7px;
    top: 7px;
    z-index: 1;
  }
  .center{
      text-align: -webkit-center;
    }
  .rounded-corner{
    border-radius: 20px;
  }
  /* Star Rating ----------*/
  .star-box{
    background: #0C65D1;
    z-index: 999;
  }
  .star{
    margin-left: 6rem;
  }
  /* Registraion---------- */
.bg-steps {
    position: absolute;
    top: 2rem;
    left: 2rem;
    bottom:-6rem;
}
.steps-btn {
    z-index: 100;
    width: 20px;
    height: 20px;
    line-height: 20px;
    font-size: 12px;
    border-radius: 20%;
    text-align: center;
    background: #ffffff;
    color: #ececec;
    cursor: pointer;
    margin-left: 0.5rem;
}
.steps-btn:hover {
    background: #1b76b3;
    color: #ececec;
}
.active {
    background: #0C65D1;
    color: #ffffff;
}
.welcome-text {
    font-size: 44px;
    color: #000000;
}
.try-text{
  color: #0C65D1;
}
.vs-con-input .vs-inputx{
  border-radius: 10px !important;
  color:#000000
}
.vs-con-input .v-select{
  border-radius: 10px !important;
}
.vs-con-input .vs-inputx:hover,
.vs-con-input .vs-inputx:focus {
    border-color: #2a9eeb !important;
}

.vs--searchable .vs__dropdown-toggle {
  border-radius: 10px !important;
}
  .vs__dropdown-menu  {
    .vs__dropdown-option--highlight {
      background:  #2a9eeb !important;
    }
  }
  .vs__selected-options {
      padding: 2px 0 2px 3rem !important;
    }

.bg-input{
    position: relative;
    .icon{
      position: absolute;
      top:10px;
      left: 0px;
      z-index:1;
      padding-right: 20px;
    }
    .employee-icon{
      top:0px
    }
    .phone-icon{
      position: absolute;
      top:20px;
      left: 10px;
    }
    .left-icon{
      position: absolute;
      top:12px;
      left: 85%;
      z-index: 9999;
    }
    .left-phone-icon{
      position: absolute;
      top:20px;
      left: 58%;
      z-index: 999;
    }
  }
  .register-btn{
    border-radius:30px ;
  }
  .account{
    color: #ACACAC;
  }
    .vs__dropdown-menu{
      z-index: 9999;
    }

  .activate-btn{
    color: red;
  }

@media (max-width: 992px) and (min-width: 600px){
.bg-input{
  .left-icon{
      left: 95%;
    }
  }
}
@media (min-width: 375px) and (max-width: 600px){
  .bg-input{
  .left-icon{
      left: 88%;
    }
  }
}
  @media (max-width: 375px){
    .left-phone-icon{
      left: 63%;
    }
  }

  .otp-input {
    width: 40px;
    height: 40px;
    padding: 5px;
    margin: 5px;
    font-size: 20px;
    border-radius: 4px;
    border: 1px solid rgba(0, 0, 0, 0.3);
    text-align: center;
    &.error {
      border: 1px solid red !important;
    }
  }
  .otp-input:focus{
    background: #0C65D1;
    color: #ffffff;
  }
  .otp-input::-webkit-inner-spin-button,
  .otp-input::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }






  </style>
  
  