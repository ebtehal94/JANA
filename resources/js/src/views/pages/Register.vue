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
              <img src="@assets/images/pages/Logo.png" alt="jana" class="mx-auto" width="130">
              <img src="@assets/images/pages/Logo-text.png" alt="jana" class="mx-auto mt-2 " width="160" >
              <!--<h2 class="text-center text-3xl">بطاقات جنا للخصومات</h2>-->
            
              <div class="w-full bg-footer">
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
                      class="w-full text-base "
                      placeholder="اسم المتجر (عربي)"
                      v-model="data_local.name_ar"
                      v-validate="'required|alpha_spaces'"
                      icon-no-border
                      icon="icon"
                      name="name_ar"/>
          
                    <span
                      v-show="errors.has('name_ar')"
                      ><icon name="confirm" class="icon left-icon"/></span>
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
                      name="name_en"
                    
                    />
                    <span
                      v-show="errors.has('name_en')"
                      ><icon name="confirm" class="icon left-icon"/>
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
                      v-validate="'required|min:7'"
                      class="w-full mt-2"
                    />
                    
                     <span
                      v-show="errors.has('Commercial_num')"
                      ><icon name="confirm" class="icon left-icon"/></span>
                  </div>
                  <div class="bg-input">
                    <icon name="city" class="icon"/>
                   
                    <vs-select v-model="data_local.city" placeholder="العنوان (المدينة)"  class="mt-2 w-full" name="city">
                      <vs-select-item :key="item.value" :value="item.value" :text="item.text" v-for="item in cities_list" />
                    </vs-select>
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
              <img src="@assets/images/pages/Logo.png" alt="jana" class="mx-auto" width="130">
              <img src="@assets/images/pages/Logo-text.png" alt="jana" class="mx-auto mt-2 " width="160" >
            
              <div class="w-full bg-footer">
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
                <vs-select placeholder="نوع المتجر" v-model="data_local.store_type" class="w-full mt-2">
                  <vs-select-item :key="store.value" :value="store.value" :text="store.text" v-for="store in stores" />
                </vs-select>
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
                  <span
                    v-show="errors.has('brunch_name')"
                    ><icon name="confirm" class="icon left-icon"/></span>
              </div>
                <div class="bg-input">
                    <icon name="city" class="icon"/>
                   
                    <vs-select v-model="data_local.city" placeholder="العنوان (المدينة)"  class="mt-2 w-full" name="city">
                      <vs-select-item :key="item.value" :value="item.value" :text="item.text" v-for="item in cities_list" />
                    </vs-select>
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
                  <span
                    v-show="errors.has('location')"
                    ><icon name="confirm" class="icon left-icon"/></span
                  >
              </div>
              <div class="bg-input">
                <icon name="URL" class="icon"/>
                  <vs-input
                    size="large" 
                    class="w-full text-base mt-2 "
                    placeholder="الموقع الإلكتروني"
                    v-model="data_local.url"
                    v-validate="'required'"
                    icon-no-border
                    icon="icon"
                    name="url"/>
                  <span
                    v-show="errors.has('url')"
                    ><icon name="confirm" class="icon left-icon"/></span
                  >
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
                  <span
                    v-show="errors.has('optional_branch')"
                    ><icon name="confirm" class="icon left-icon"/></span
                  >
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
              <img src="@assets/images/pages/Logo.png" alt="jana" class="mx-auto" width="130">
              <img src="@assets/images/pages/Logo-text.png" alt="jana" class="mx-auto mt-2 " width="160" >
              <!--<h2 class="text-center text-3xl">بطاقات جنا للخصومات</h2>-->
            
              <div class="w-full bg-footer">
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
                    class="w-3/4 mt-2 px-3"
                  />

                  <vs-input
                  size="large" 
                  v-model="data_local.cc"
                  type="number"
                  icon-no-border
                  v-validate="'required'"
                  class="w-1/5 mt-2"
                  placeholder="966+"
                  />
                      
                  <span
                  class="text-danger text-sm"
                  v-show="errors.has('mobile')">
                  <icon name="confirm" class="icon left-icon"/></span>
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
                    class="w-3/4 mt-2 px-3"
                  />

                  <vs-input
                      
                  size="large" 
                  v-model="data_local.cc"
                  type="number"
                  icon-no-border
                  v-validate="'required'"
                  class="w-1/5 mt-2"
                  placeholder="966+"
                  />
                      
                  <span
                  class="text-danger text-sm"
                  v-show="errors.has('mobile')">
                  <icon name="confirm" class="icon left-icon"/></span>
                </div>

                  <div class="bg-input">
                    <icon name="email" class="icon"/>
                    <vs-input
                      size="large" 
                      v-validate="'required|email|min:3'"
                      data-vv-validate-on="blur"
                      icon-no-border
                      icon="icon"
                      placeholder="البريد الإلكتروني"
                      v-model="data_local.email"
                      class="w-full mt-2"
                    />
                  </div>
                  <span class="text-danger text-sm">{{
                    errors.first("email")
                  }}</span>

                  <div class="bg-input">
                    <icon name="password" class="icon"/>
                    <!--<icon name="hidden" class="icon left-icon"/>-->
                    <vs-input
                      size="large" 
                      data-vv-validate-on="blur"
                      placeholder="كلمة المرور"
                      v-validate="'required|min:6'"
                      type="password"
                      icon-no-border
                      icon="icon"
                      v-model="data_local.password"
                      class="w-full mt-2"
                    />
                  </div>
                  <span class="text-danger text-sm">{{
                    errors.first("password")
                  }}</span>

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

export default {
  components: { icon },
  data() {
    return { 
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
        cities_list: [
          {text:'الرياض',value:0},
          {text:'الدمام',value:1},
          {text:'جدة',value:2},
          {text:'تبوك',value:3}
        ],
        store_type:null,
        stores: [
          {text:'النوع الأول',value:0},
          {text:'النوع التاني',value:1},
          {text:'النوع الثالث',value:2},
          {text:'النوع الرابع',value:3}
        ]
      },
      page_num:1,
      disabled: true

    };
  },
  computed: {
    validateForm() {
      return (
        !this.errors.any() &&
        ((!this.data_local.id && this.data_local.password) ||
          this.data_local.id)
      );
    },
    cartItems() {
      return this.$store.state.eCommerce.cartItems.slice().reverse();
    },
  },
  methods: {
  changeNumber(num){
    return this.page_num = num
  },
  registerUser() {
      if(!this.validateForm) return
      this.$vs.loading()
      const obj = {
          name: this.data_local.name,
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
  .bg-logo{
    position: relative;
  }
  .bg-footer{
    position: absolute;
    bottom:-7rem;
  }
  .rounded-corner{
    border-radius: 25px;
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


</style>