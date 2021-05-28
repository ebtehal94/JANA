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
                  <h4 class="mb-4 text-base font-bold">{{$t('accountData')}}</h4>
                </div>
            </div>

            <!-- Col Content -->
            <div>
                <div class="bg-input">
                    <icon name="user-name" class="icon"/>
                    <vs-input
                      class="w-full text-base"
                      :placeholder="$t('fullName')"
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
                    :placeholder="$t('email')"
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
                    :placeholder="$t('mobile')"
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

                <div class="bg-input text-sm">
                    <icon name="city" class="icon"/>
                    <v-select class="w-full mt-2 p-0 text-sm"
                     v-model="customer_data.city_id"
                     :placeholder="$t('Location')"
                     label="name_ar" :options="cities_list"
                     :reduce="name_ar => name_ar.id"
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
                    :placeholder="$t('password')"
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

                <div class="bg-input text-sm">
                    <v-select class="w-full mt-2 text-sm"
                     v-model="customer_data.status"
                     :placeholder="$t('accountStatus')"
                     label="text" :options="status_list"
                     :reduce="text => text.id"
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
                       {{$i18n.locale == "en" ? "Create Account" : "إنشاء الحساب"}}
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
import { CitiesList } from '../pages/extra/CitiesList.js'
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
      cities_list:CitiesList ,
      status_list: [
        {text:'غير نشط',id:0},
        {text:'نشط',id:1},
      ],

    }
  },
  computed: {
    validateForm() {
     return ( !this.errors.any() && this.customer_data.email && this.customer_data.password ) ;
    },
  },
  methods: {
    registerUser() {
      // if(!this.validateForm) return
        if (this.customer_data.id != null && this.customer_data.id > 0){
          var link = "customerManagement/updateCustomer"
        }else{
          var link = "customerManagement/addCustomer"
        }
        this.$store.dispatch(link, this.customer_data)
        .then(res => {
          if( res.data.statusCode == 200 ){
            this.$vs.notify({
            color: 'success',
            title: 'Successfull',
            text: 'تم بنجاح'
            })
            this.$router.go(-1)
          }else if( res.data.statusCode == 401 ){
            this.$vs.notify({
            color: 'danger',
            title: 'خطاء',
            text: 'رقم الجوال مسجل بالفعل'
            })
          }else if( res.data.statusCode == 402 ){
            this.$vs.notify({
            color: 'danger',
            title: 'خطاء',
            text: 'هذا البريد الالكتروني مسجل بالفعل'
            })
          }
          else{
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
    if (this.$route.params.customerID != null){
      this.$store.dispatch("customerManagement/fetchCustomer", this.$route.params.customerID).catch(err => { console.error(err) })
      .then((res) => {
        this.customer_data = res.data.customer
      })
      .catch((error) => console.log(error))
      
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
      top:18px;
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
.vs__dropdown-toggle {
    .vs__selected-options {
        padding: 0 3rem 0 0 !important;
    }
  }
}

@media (max-width: 992px) and (min-width: 600px){
  #create-customer{
  .bg-input{
    .left-icon{
        left: 95%;
      }
    }
  }
}
@media (min-width: 375px) and (max-width: 600px){
  #create-customer{
    .bg-input{
    .left-icon{
        left: 86%;
      }
      .left-phone-icon{
        left: 60%;
        top:19px;
      }
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
