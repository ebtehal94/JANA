<template>
  <div
    class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center"
    id="page-login">
    <!--- Store --->
    <div class="vx-col w-full lg:w-3/4 xl:w-4/5 sm:m-0 m-4" v-if="page_num === 1">
      <vx-card class="rounded-corner shadow-none">
        <div slot="no-body">
          <div class="vx-row no-gutter justify-center items-center py-8">
            <div class="vx-col hidden lg:block lg:w-2/5 pl-1.5 bg-logo">
              <img src="@assets/images/logo/logo-3.png" alt="jana" class="mx-auto" width="130">
            
              <div class="w-full bg-footer">
                <span class="steps-btn inline-block font-semibold">1</span>
                <span class="steps-btn inline-block font-semibold">2</span>
                <span class="steps-btn inline-block font-semibold">3</span>
                <span class="account pl-0.5 font-light text-xs">لديك حساب؟</span>
                  <vs-button 
                  class="login-btn p-0 text-sx"
                  size="small" 
                  type="transparent" 
                  to="/login">
                  تسجيل الدخول
                </vs-button>
              </div>
            </div>

            <div class="vx-col sm:w-full md:w-full lg:w-1/2">
              <div class="p-8 login-tabs-container">
                <div class="vx-card__title">
                  <div class="separator">
                    <h4 class="mb-4 text-lg">بيانات المتجر</h4> 
                  </div>                
                </div>

                <div>
                  <div class="bg-input">
                    <icon name="name" class="icon"/>
                    <vs-input
                      size="large" 
                      class="w-full text-base"
                      placeholder="اسم المتجر (عربي)"
                      v-model="data_local.name_ar"
                      v-validate="'required|alpha_spaces'"
                      icon-no-border
                      icon="icon"
                      name="name_ar"/>

                    <span v-if="!errors.has('name_ar') && data_local.name_ar">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('name_ar')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                  </div>

                  <div class="bg-input">
                    <icon name="name" class="icon"/>
                    <vs-input
                      size="large" 
                      class="w-full text-base mt-2 "
                      placeholder="اسم المتجر (انجليزي)"
                      v-model="data_local.name_en"
                      v-validate="'required|alpha_spaces'"
                      icon-no-border
                      icon="icon"
                      name="name_en"/>

                    <span v-if="!errors.has('name_en') && data_local.name_en">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('name_en')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                  </div>

                  <div class="bg-input">
                    <icon name="com-number" class="icon phone-icon"/>
                    <vs-input
                      size="large" 
                      placeholder="رقم السجل التجاري"
                      v-model="data_local.Commercial_num"
                      type="number"
                      icon-no-border
                      icon="icon"
                      v-validate="'required|min:6'"
                      class="w-full mt-2"/>

                    <span
                      v-if="!errors.has('Commercial_num') && data_local.Commercial_num">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('Commercial_num')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>

                  </div>
                  <div class="bg-input">
                    <icon name="city" class="icon"/>
                    <v-select class="w-full mt-2"
                      placeholder="الموقع (المدينة)" 
                      v-model="data_local.city"
                      v-validate="'required'" 
                      label="text" :options="cities_list" 
                      :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                    <span
                      v-if="!errors.has('city') && data_local.city">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('city')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                 </div>

                  <div class=" mb-3">
                    <vs-button
                      class="w-full mt-10 font-medium register-btn"
                      color="linear-gradient(to left,#E93F7D,#DA6653)"
                      gradient
                      @click="changeNumber(2)">
                      التالي
                    </vs-button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </vx-card>
    </div>
   
   <!----- Brunch ---->
    <div class="vx-col w-full lg:w-3/4 xl:w-4/5 sm:m-0 m-4"  v-if="page_num ===2">
      <vx-card class="rounded-corner shadow-none">
        <div slot="no-body">
          <div class="vx-row no-gutter justify-center items-center">
            <div class="vx-col hidden lg:block lg:w-2/5 pl-1.5 bg-logo">
              <img src="@assets/images/logo/logo-3.png" alt="jana" class="mx-auto" width="130">
            
              <div class="w-full bg-footer">
                <span class="steps-btn inline-block font-semibold">1</span>
                <span class="steps-btn inline-block font-semibold">2</span>
                <span class="steps-btn inline-block font-semibold">3</span>
                <span class="account pl-0.5 font-light text-xs">لديك حساب؟</span>
                  <vs-button 
                  class="login-btn p-0 text-xs"
                  size="small" 
                  type="transparent" 
                  to="/login">
                  تسجيل الدخول
                </vs-button>
              </div>
            </div>

            <div class="vx-col sm:w-full md:w-full lg:w-1/2">
              <div class="p-8 login-tabs-container">
                <div class="vx-card__title">
                  <div class="separator">
                    <h4 class="mb-4 text-lg">بيانات الفروع</h4> 
                  </div>                
                </div>

            <div>
              <div class="bg-input">
                <icon name="store-type" class="icon"/>
                <v-select class="w-full mt-2" 
                v-model="data_local.store_type" 
                placeholder="نوع المتجر"  
                label="text" :options="stores" 
                :dir="$vs.rtl ? 'rtl' : 'ltr'"/>

                <span v-if="!errors.has('store_type') && data_local.store_type">
                  <icon name="confirm" class="icon left-icon"/>
                </span>
                <span v-else-if="errors.has('store_type')">
                  <icon name="cross" class="icon left-icon"/>
                </span>
              </div>

              <div class="bg-input">
                <icon name="name" class="icon"/>
                <vs-input
                size="large" 
                class="w-full text-base mt-2 "
                placeholder="اسم الفرع"
                v-model="data_local.brunch_name"
                v-validate="'required|alpha_spaces'"
                icon-no-border
                icon="icon"
                name="brunch_name"/>

                <span v-if="!errors.has('brunch_name') && data_local.brunch_name">
                  <icon name="confirm" class="icon left-icon"/>
                </span>
                <span v-else-if="errors.has('brunch_name')">
                  <icon name="cross" class="icon left-icon"/>
                </span>
              </div>

              <div class="bg-input">
                <icon name="city" class="icon"/>
                <v-select class="w-full mt-2"
                 v-model="data_local.brunch_city" 
                 placeholder="الموقع (المدينة)" 
                 label="text" :options="cities_list" 
                 :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                <span v-if="!errors.has('brunch_city') && data_local.brunch_city">
                  <icon name="confirm" class="icon left-icon"/>
                </span>
                <span v-else-if="errors.has('brunch_city')">
                  <icon name="cross" class="icon left-icon"/>
                </span>
              </div>

              <div class="bg-input">
                <icon name="location" class="icon"/>
                  <vs-input
                    size="large" 
                    class="w-full text-base mt-2 "
                    placeholder="الموقع الجغرافي"
                    v-model="data_local.location"
                    v-validate="'required|alpha_spaces'"
                    icon-no-border
                    icon="icon"
                    name="location"/>

                  <span v-if="!errors.has('location') && data_local.location">
                    <icon name="confirm" class="icon left-icon"/>
                  </span>
                  <span v-else-if="errors.has('location')">
                    <icon name="cross" class="icon left-icon"/>
                  </span>
              </div>

              <div class="bg-input">
                <icon name="URL" class="icon"/>
                  <vs-input
                    size="large" 
                    class="w-full text-base mt-2 "
                    placeholder="الموقع الإلكتروني"
                    v-model="data_local.url"
                    v-validate="'required | url:require_protocol'"
                    icon-no-border
                    icon="icon"
                    name="url"/>

                  <span v-if="!errors.has('url') && data_local.url">
                    <icon name="confirm" class="icon left-icon"/>
                  </span>
                  <span v-else-if="errors.has('url')">
                    <icon name="cross" class="icon left-icon"/>
                  </span>
              </div>

              <div class="bg-input">
                  <vs-input
                    size="large" 
                    class="w-full text-base mt-2"
                    placeholder="إضافة فرع (إختياري)"
                    v-model="data_local.optional_branch"
                    v-validate="'required|alpha_spaces'"
                    icon-no-border
                    icon="icon"
                    name="optional_branch"
                    :disabled="disabled" 
                    @click="disabled=!disabled"/>
                  <span v-show="errors.has('optional_branch')">
                    <icon name="confirm" class="icon left-icon"/>
                  </span>
              </div>

                  <div class=" mb-3">
                    <vs-button
                      class="w-full mt-10 font-medium register-btn"
                      color="linear-gradient(to left,#E93F7D,#DA6653)"
                      gradient
                      @click="changeNumber(3)">
                      التالي
                      </vs-button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </vx-card>
    </div>

    <!--- Contact --->
    <div class="vx-col w-full lg:w-3/4 xl:w-4/5 sm:m-0 m-4" v-if="page_num === 3">
      <vx-card class="rounded-corner shadow-none">
        <div slot="no-body">
          <div class="vx-row no-gutter justify-center items-center py-8">
            <div class="vx-col hidden lg:block lg:w-2/5 pl-1.5 bg-logo">
              <img src="@assets/images/logo/logo-3.png" alt="jana" class="mx-auto" width="130">
            
              <div class="w-full bg-footer">
                <span class="steps-btn inline-block font-semibold">1</span>
                <span class="steps-btn inline-block font-semibold">2</span>
                <span class="steps-btn inline-block font-semibold">3</span>
                <span class="account pl-0.5 font-light text-xs">لديك حساب؟</span>
                  <vs-button 
                  class="login-btn p-0 text-xs"
                  size="small" 
                  type="transparent" 
                  to="/login">
                  تسجيل الدخول
                </vs-button>
              </div>
            </div>

            <div class="vx-col sm:w-full md:w-full lg:w-1/2">
              <div class="p-8 login-tabs-container">
                <div class="vx-card__title">
                  <div class="separator">
                    <h4 class="mb-4 text-lg">التواصل والأمان</h4> 
                  </div>                
                </div>

              <div>
                <div class="vx-row bg-input">
                  <icon name="mobile" class="icon phone-icon"/>
                  <vs-input
                    size="large" 
                    placeholder="رقم الجوال"
                    v-model="data_local.mobile"
                    type="number"
                    icon-no-border
                    icon="icon"
                    v-validate="'required|min:7'"
                    class="w-3/4 mt-2 px-3"/>

                  <vs-input
                  size="large" 
                  v-model="data_local.cc"
                  type="number"
                  icon-no-border
                  v-validate="'required'"
                  class="w-1/5 mt-2"
                  placeholder="966+"/>
                      
                  <span v-if="!errors.has('mobile') && data_local.mobile">
                    <icon name="confirm" class="icon left-icon"/>
                  </span>
                  <span v-else-if="errors.has('mobile')">
                    <icon name="cross" class="icon left-phone-icon"/>
                  </span>
                </div>

                <div class="vx-row bg-input">
                  <icon name="phone" class="icon phone-icon"/>
                  <vs-input
                    size="large" 
                    placeholder="رقم الهاتف"
                    v-model="data_local.phone"
                    type="number"
                    icon-no-border
                    icon="icon"
                    v-validate="'required|min:7'"
                    class="w-3/4 mt-2 px-3"/>

                  <vs-input
                    size="large" 
                    v-model="data_local.cc"
                    type="number"
                    icon-no-border
                    v-validate="'required'"
                    class="w-1/5 mt-2"
                    placeholder="966+"/>
                  
                  <span v-if="!errors.has('phone') && data_local.phone">
                    <icon name="confirm" class="icon left-phone-icon"/>
                  </span>
                  <span v-else-if="errors.has('phone')">
                    <icon name="cross" class="icon left-icon"/>
                  </span>
                </div>

                <div class="bg-input">
                  <icon name="email" class="icon"/>
                  <vs-input
                    size="large" 
                    v-validate="'required|email|min:3'"
                    icon-no-border
                    icon="icon"
                    placeholder="البريد الإلكتروني"
                    v-model="data_local.email"
                    class="w-full mt-2"/>

                   <span v-if="!errors.has('email') && data_local.email">
                    <icon name="confirm" class="icon left-icon"/>
                  </span>
                  <span v-else-if="errors.has('email')">
                    <icon name="cross" class="icon left-icon"/>
                  </span>
                </div>

                <div class="bg-input">
                  <icon name="password" class="icon"/>
                  <vs-input
                    size="large" 
                    data-vv-validate-on="blur"
                    placeholder="كلمة المرور"
                    v-validate="'required|min:6'"
                    type="password"
                    icon-no-border
                    icon="icon"
                    v-model="data_local.password"
                    class="w-full mt-2"/>

                  <span v-if="!errors.has('password') && data_local.password">
                    <icon name="confirm" class="icon left-icon"/>
                  </span>
                  <span v-else-if="errors.has('password')">
                    <icon name="cross" class="icon left-icon"/>
                  </span>
                </div>

                  <div class=" mb-3">
                    <vs-button
                      class="w-full mt-10 font-medium register-btn"
                      color="linear-gradient(to left,#E93F7D,#DA6653)"
                      gradient
                      @click="registerUser">
                      إنشاء حساب
                      </vs-button>
                  </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </vx-card>
    </div>
  </div>
</template>

<script>
import moduleUserManagement from "@/store/user-management/moduleUserManagement.js";
import icon from '../../layouts/components/icon.vue';
import vSelect from 'vue-select';



export default {
  components: {
     icon ,
     vSelect
     },
  data() {
    return { 
        cities_list: [
          {text:'الرياض',value:0},
          {text:'الدمام',value:1},
          {text:'جدة',value:2},
          {text:'تبوك',value:3}
        ],
        stores: [
          {text:'النوع الأول',value:0},
          {text:'النوع التاني',value:1},
          {text:'النوع الثالث',value:2},
          {text:'النوع الرابع',value:3}
        ],
      data_local: {
        name_ar: null,
        name_en:null,
        Commercial_num:null,
        brunch_name:null,
        url:null,
        optional_branch:null,
        email: null,
        cc: null,
        mobile: null,
        phone:null,
        password: null,
        rule: "customer",
        status: 1,
        city: "",
        brunch_city:"",
        store_type:"",
      },
      page_num:1,
      disabled: true
    }
  },
  computed: {
    validateForm() {
      return (
        !this.errors.any() &&
        ((!this.data_local.id && this.data_local.password) ||
          this.data_local.id)
      );
    }
  },
  methods: {
  changeNumber(num){
    if(!this.errors.any()
    && this.data_local.name_ar
    && this.data_local.name_en
    && this.data_local.Commercial_num
    && this.data_local.city)
    {
      return this.page_num = num
    }
    if(!this.errors.any()
    && this.data_local.store_type
    && this.data_local.brunch_name
    && this.data_local.brunch_city
    && this.data_local.location
    && this.data_local.url){
      return this.page_num = num
    }
  },
  registerUser() {
      if(!this.validateForm) return
      this.$vs.loading()
      const obj = {
          name_ar: this.data_local.name_ar,
          name_en: this.data_local.name_en,
          brunch_name:this.data_local.brunch_name,
          email: this.data_local.email,
          password: this.data_local.password,
          cc: this.data_local.cc,
          mobile: this.data_local.mobile,
          status: this.data_local.status
      }
      // if (this.data_local.password){
          // obj.password = this.data_local.password
      // }
      return new Promise((resolve, reject) => {
            this.$store.dispatch('auth/registerUserJWT', obj)
          .then(res => {
            this.$vs.loading.close()
          if( res.data.statusCode == 200 ){
              this.$vs.notify({
              color: 'success',
              title: 'Successfull',
              text: 'تم التسجيل بنجاح'
              })
              this.$acl.change('customer')
              if(this.cartItems.length > 0) {
                this.$router.push('/checkout')
              } else {
                this.$router.push('/')
              }
          } else if( res.data.statusCode == 402 ){
            this.$vs.notify({
            color: 'danger',
            title: 'خطاء',
            text: 'رقم الجوال مسجل بالفعل'
            })
          }else if( res.data.statusCode == 403 ){
            this.$vs.notify({
            color: 'danger',
            title: 'خطاء',
            text: 'هذا البريد الالكتروني مسجل بالفعل'
            })
          } else {
              this.$vs.notify({
              color: 'danger',
              title: 'Error',
              text: 'حدث خطاء ما'
              })
          }
          })
          .catch((error) => {
            this.$vs.loading.close()
            this.$vs.notify({
              color: 'danger',
              title: 'خطاء',
              text: error.message,
              position:'top-center'
            })
           })
      })
    }
  },
  created() {
      // Register Module UserManagement Module
      if(!moduleUserManagement.isRegistered) {
      this.$store.registerModule('userManagement', moduleUserManagement)
      moduleUserManagement.isRegistered = true
      }
  }
};
</script>

<style lang="scss" scoped>
  .rounded-corner{
    border-radius: 25px;
  }
  .bg-logo{
    position: relative;
  }
  .bg-footer{
    position: absolute;
    bottom:-7rem;
  }
  .separator{
    display: flex;
    align-items: center;
    text-align: center;
  }
  .separator::before, .separator::after {
    content: '';
    flex: 1;
    border-bottom: 1px solid #e2e2e2;
  }
  .separator::before {
    margin-right: 1em;
  }
  .separator::after {
    margin-left: 1em;
  }
  .separator{
    h4{
      color: #999999;
    }
  }
  .bg-input{
    position: relative;
    .icon{
      position: absolute;
      top:14px;
      left: 20px;
      z-index: 9999;
      padding-right: 20px;
    }
    .phone-icon{
      position: absolute;
      top:14px;
      left: 28px;
    }
    .left-icon{
      position: absolute;
      top:18px;
      left: 90%;
      z-index: 9999;
    }
    .left-phone-icon{
      position: absolute;
      top:24px;
      left: 65%;
      z-index: 9999;
    }
  }
  .register-btn{
    background:linear-gradient(#E93F7D,#DA6653) ;
    border-radius:30px ;
  }
  .login-btn{
    color: #DC6755;
  }
  .account{
    color: #ACACAC;
  }
 .vs__selected-options {
    padding: 0 10px;
}
.steps-btn{
    width: 18px;
    height: 18px;
    line-height: 18px;
    font-size: 12px;
    border-radius: 50%;
    text-align: center;
    background: #EAEAEA;
    color: #fff;
    cursor: pointer;
}
.steps-btn:hover{
  background: linear-gradient(#E93F7D,#DA6653) ;
}
.v-select .vs__dropdown-menu{
  margin-top: 2rem;
}
</style>