<template>
  <div id="create-customer">
    <vx-card class="customer-info">
      <div slot="no-body" class="tabs-container md:px-6 pt-6 md:pb-4">
        <!-- Content Row -->
        <div class="vx-row">
          <div class="vx-col hidden lg:block lg:w-2/5 justify-center items-center">
            <img src="@assets/images/newCustomer.png" alt="jana-customer" class="mt-24 align" width="190">
          </div>
          <div class="vx-col sm:w-full md:w-full lg:w-1/2">
            <!-- Col Header -->
            <div class="vx-card__title">
                <div class="separator">
                    <h4 class="mb-4 text-lg">بيانات المتجر</h4>
                </div>
            </div>

            <!-- Col Content -->
                <div>
                  <div class="bg-input">
                    <icon name="name" class="icon"/>
                    <vs-input
                      size="large"
                      class="w-full text-base"
                      placeholder="اسم المتجر (عربي)"
                      v-model="store_data.name_ar"
                      v-validate="'required'"
                      icon-no-border
                      icon="icon"
                      name="name_ar"/>

                    <span v-if="!errors.has('name_ar') && store_data.name_ar">
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
                      v-model="store_data.name_en"
                      v-validate="'required'"
                      icon-no-border
                      icon="icon"
                      name="name_en"/>

                    <span v-if="!errors.has('name_en') && store_data.name_en">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('name_en')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                  </div>

                  <div class="bg-input">
                    <icon name="com-number" class="icon"/>
                    <vs-input
                      size="large"
                      placeholder="رقم السجل التجاري"
                      v-model="store_data.cr_number"
                      type="number"
                      icon-no-border
                      icon="icon"
                      v-validate="'required|min:6'"
                      class="w-full mt-2"/>

                    <span
                      v-if="!errors.has('cr_number') && store_data.cr_number && store_data.cr_number.length >= 6">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('cr_number')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>

                  </div>
                  <div class="bg-input">
                    <icon name="city" class="icon"/>
                    <v-select class="w-full mt-2"
                      placeholder="الموقع (المدينة)"
                      v-model="store_data.city_id"
                      v-validate="'required'"
                      label="text" :options="cities_list"
                      :reduce="text => text.value"
                      :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                    <span
                      v-if="!errors.has('city_id') && store_data.city_id">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('city_id')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                 </div>

                <!-- Col Header -->
                <div class="vx-card__title mt-4">
                    <div class="separator">
                        <h4 class="mb-4 text-lg">بيانات المتجر</h4>
                    </div>
                </div>

                <div class="vx-row bg-input">
                  <icon name="phone" class="icon phone-icon"/>
                  <vs-input
                    size="large"
                    placeholder="رقم الجوال"
                    v-model="data_local.phone"
                    type="number"
                    icon-no-border
                    icon="icon"
                    v-validate="'required|min:7'"
                    class="w-3/4 mt-2 px-3"/>

                  <vs-input
                    size="large"
                    v-model="data_local.cc"
                    type="text"
                    disabled
                    dir="ltr"
                    icon-no-border
                    v-validate="'required'"
                    class="w-1/5 mt-2"
                    placeholder="966+"/>

                  <span v-if="!errors.has('phone') && user.phone">
                    <icon name="confirm" class="icon left-phone-icon"/>
                  </span>
                  <span v-else-if="errors.has('phone')">
                    <icon name="cross" class="icon left-phone-icon"/>
                  </span>
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
                    class="w-full mt-2"/>

                   <span v-if="!errors.has('email') && data_local.email">
                    <icon name="confirm" class="icon left-icon"/>
                  </span>
                  <span v-else-if="errors.has('email')">
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

    </vx-card>
  </div>
</template>

<script>
import vSelect from 'vue-select'
import icon from '@/layouts/components/icon.vue';

// Store Module
import moduleUserManagement from '@/store/user-management/moduleUserManagement.js'

export default {
  components: {
    icon,
    vSelect
  },
  data() {
    return {
        store_data: {
            name_ar: null,
            name_en:null,
            cr_number:null,
            city_id:null
      },
      data_local: { name: null, email: null, mobile: null, cc: '+966', city_id:null, password: null,},
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
      status:null
    }
  },
  computed: {
    validateForm() {
      return !this.errors.any() && ((!this.data_local.id && this.data_local.password) || this.data_local.id)
    },
  },
  methods: {
    save_changes() {
      if(!this.validateForm) return

      // Here will go your API call for updating data
      // You can get data in "this.data_local"
        const obj = {
            id: this.data_local.id,
            name: this.data_local.name,
            email: this.data_local.email,
            mobile: this.data_local.mobile,
            status: this.activeUserInfo.status,
            rule: this.activeUserInfo.rule
        }
        if (this.data_local.password){
            obj.password = this.data_local.password
        }

        this.$store.dispatch("userManagement/updateUser", obj)
        .then(res => {
                        if( res.data.statusCode == 200 ){
                        this.$vs.notify({
                        color: 'success',
                        title: 'Successfull',
                        text: 'User updated successfully'
                        })
                        window.location.reload()
                    }else{
                        this.$vs.notify({
                        color: 'danger',
                        title: 'Error',
                        text: 'Error updating user'
                        })
                    }
                        })
        .catch(err => { console.error(err) })


    },
    reset_data() {
      this.data_local = JSON.parse(JSON.stringify(this.data))
    },
    fetch_user_data(userId) {
      this.$store.dispatch("userManagement/fetchUser", userId)
        .then(res => { this.data_local = res.data})
        .catch(err => { console.error(err) })
    }
  },
  created() {
    // Register Module UserManagement Module
    if(!moduleUserManagement.isRegistered) {
      this.$store.registerModule('userManagement', moduleUserManagement)
      moduleUserManagement.isRegistered = true
    }

    this.fetch_user_data(this.activeUserInfo.id)
    this.$store.dispatch("userManagement/fetchUsers").catch(err => { console.error(err) })
  }
}
</script>

<style lang="scss" scoped>
#create-customer {
    margin: 2rem 2.5rem;

    .customer-info{
        padding: 2.5rem;
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
      top:13px;
      left: 15px;
      z-index:1;
      padding-right: 20px;
    }
    .phone-icon{
      position: absolute;
      top:18px;
      left: 25px;
    }
    .left-icon{
      position: absolute;
      top:15px;
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