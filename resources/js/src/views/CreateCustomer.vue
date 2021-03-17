<template>
  <div id="create-customer">
    <vx-card class="customer-info">
      <div slot="no-body" class="tabs-container md:px-6 pt-8 md:pb-4">
        <!-- Content Row -->
        <div class="vx-row">
          <div class="vx-col hidden lg:block lg:w-2/5 pl-16">
            <img src="@assets/images/newCustomer.png" alt="jana-customer" class="mt-20 align" width="160">
          </div>
          <div class="vx-col sm:w-full md:w-full lg:w-1/2">
            <!-- Col Header -->
            <div class="vx-card__title">
                <div class="separator">
                    <h4 class="mb-4 text-base">بيانات الحساب</h4>
                </div>
            </div>

            <!-- Col Content -->
            <div>
                <div class="bg-input">
                    <icon name="user-name" class="icon"/>
                    <vs-input
                      class="w-full text-base"
                      placeholder="الإسم كامل"
                      v-model="customer_data.name"
                      v-validate="'required'"
                      icon-no-border
                      icon="icon"
                      name="name"/>

                    <span v-if="!errors.has('name') && customer_data.name">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('name')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                </div>

                <div class="bg-input">
                  <icon name="email" class="icon"/>
                  <vs-input
                    v-validate="'required|email|min:3'"
                    data-vv-validate-on="blur"
                    icon-no-border
                    icon="icon"
                    placeholder="البريد الإلكتروني"
                    v-model="customer_data.email"
                    class="w-full mt-2"/>

                   <span v-if="!errors.has('email') && customer_data.email">
                    <icon name="confirm" class="icon left-icon"/>
                  </span>
                  <span v-else-if="errors.has('email')">
                    <icon name="cross" class="icon left-icon"/>
                  </span>
                </div>

                <div class="vx-row bg-input">
                  <icon name="mobile" class="icon phone-icon"/>
                  <vs-input
                    placeholder="رقم الجوال"
                    v-model="customer_data.mobile"
                    type="number"
                    icon-no-border
                    icon="icon"
                    v-validate="'required|min:7'"
                    class="w-3/4 mt-2 px-3"/>

                  <vs-input
                  v-model="customer_data.cc"
                  type="text"
                  disabled
                  dir="ltr"
                  icon-no-border
                  v-validate="'required'"
                  class="w-1/5 mt-2"
                  placeholder="966+"/>

                  <span v-if="!errors.has('mobile') && customer_data.mobile">
                    <icon name="confirm" class="icon left-phone-icon"/>
                  </span>
                  <span v-else-if="errors.has('mobile')">
                    <icon name="cross" class="icon left-phone-icon"/>
                  </span>
                </div>

                <div class="bg-input">
                    <icon name="city" class="icon"/>
                    <v-select class="w-full mt-2 p-0"

                     v-model="customer_data.city_id"
                     placeholder="الموقع (المدينة)"
                     label="text" :options="cities_list"
                     :reduce="text => text.value"
                     :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                    <span v-if="!errors.has('city_id') && customer_data.city_id">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('city_id')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                </div>

                <div class="bg-input">
                  <icon name="password" class="icon"/>
                  <vs-input
                    data-vv-validate-on="blur"
                    placeholder="كلمة المرور"
                    v-validate="'required|min:6'"
                    type="password"
                    icon-no-border
                    icon="icon"
                    v-model="customer_data.password"
                    class="w-full mt-2"/>

                  <span v-if="!errors.has('password') && customer_data.password">
                    <icon name="confirm" class="icon left-icon"/>
                  </span>
                  <span v-else-if="errors.has('password')">
                    <icon name="cross" class="icon left-icon"/>
                  </span>
                </div>

                <div class="bg-input">
                    <v-select class="w-full mt-2"
                     v-model="customer_data.status"
                     placeholder="حالة الحساب (غير نشط)"
                     label="text" :options="status_list"
                     :reduce="text => text.value"
                     :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                    <span v-if="!errors.has('status') && customer_data.status">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('status')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                </div>

                <div class=" mb-3">
                  <vs-button
                    class="w-full mt-10 font-medium rounded-full"
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

    </vx-card>
  </div>
</template>

<script>
import vSelect from 'vue-select'
import icon from '@/layouts/components/icon.vue';

// Store Module
import moduleCustomerManagement from '@/store/customer-management/moduleCustomerManagement.js'

export default {
  components: {
    icon,
    vSelect
  },
  data() {
    return {
      customer_data: { 
        name: null, 
        email: null, 
        mobile: null, 
        cc: '+966', 
        city_id:null, 
        password: null,
        status:null},
      cities_list: [
        {text:'الرياض',value:1},
        {text:'الدمام',value:2},
        {text:'جدة',value:3},
        {text:'تبوك',value:4}
      ],
      status_list: [
        {text:'غير نشط',value:1},
        {text:'نشط',value:2},
      ],
      
    }
  },
  computed: {
    validateForm() {
     return ( !this.errors.any() && this.customer.email && this.customer.password ) ;
    },
  },
  methods: {
    registerUser() {
      if(!this.validateForm) return
        // this.$vs.loading()
      // Here will go your API call for updating data
      // You can get data in "this.data_local"
        //const obj = {
           // id: this.data_local.id,
           // name: this.data_local.name,
            //email: this.data_local.email,
            //mobile: this.data_local.mobile,
       // }
        //if (this.data_local.password){
           // obj.password = this.data_local.password
        //}

        this.$store.dispatch("customerManagement/addCustomer", {customer_data:this.customer})
        .then(res => {
                        if( res.data.statusCode == 200 ){
                        this.$vs.notify({
                        color: 'success',
                        title: 'Successfull',
                        text: 'تم التسجيل بنجاح'
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
  },
  created() {
    // Register Module UserManagement Module
    if(!moduleCustomerManagement.isRegistered) {
      this.$store.registerModule('customerManagement', moduleCustomerManagement)
      moduleCustomerManagement.isRegistered = true
    }
  }
}
</script>

<style lang="scss" scoped>
#create-customer {
    margin: 2rem 2.5rem;

    .customer-info{
        padding: 2rem 2.5rem;
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
      top:10px;
      left: 15px;
      z-index:1;
      padding-right: 20px;
    }
    .phone-icon{
      position: absolute;
      top:13px;
      left: 25px;
    }
    .left-icon{
      position: absolute;
      top:13px;
      left: 92%;
      z-index: 9999;
    }
    .left-phone-icon{
      position: absolute;
      top:22px;
      left: 65%;
      z-index: 999;
    }
  }
  .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large) {
      padding: .5rem 2rem;
  }
  .v-select .vs__dropdown-toggle .vs__search {
    font-size: .8rem;
  }
}

@media only screen and (min-width: 375px) and (max-width: 600px) {
  #create-customer {
    .align {
      display: block;
      margin: 0.5rem auto;
    }
  }
}

@media only screen and (min-width: 360px) and (max-width: 375px) {
  #create-customer {
    .align {
      display: block;
      margin: 0.5rem -1rem;
    }
  }
}

@media only screen and (min-width: 320px)  and (max-width: 360px) {
  #create-customer {
    .align {
      width: 200px !important;
      height: 200px !important;
      margin: 0.5rem auto;
    }
  }
}

@media only screen  and (max-width: 320px) {
  #create-customer {
    .align {
      width: 200px !important;
      height: 200px !important;
      margin: 0.5rem -1.5rem;
    }
  }
}
</style>