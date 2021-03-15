<template>
  <div id="create-customer">
    <vx-card class="customer-info">
      <div slot="no-body" class="tabs-container md:px-6 pt-6 md:pb-4">
        <!-- Content Row -->
        <div class="vx-row">
          <div class="vx-col hidden lg:block lg:w-2/5 justify-center items-center">
            <img src="@assets/images/Notifications.png" alt="Notice" class="mt-24 align" width="190">
          </div>
          <div class="vx-col sm:w-full md:w-full lg:w-1/2">
            <div class="vx-row">
                <div class="vx-col w-full md:w-1/2">
                    <!-- Col Header -->
                    <div class="flex items-end">
                        <span class="leading-none font-medium text-xs">مستلمي الإشعار</span>
                    </div>
                     <!-- Col Content -->
                    <div>
                        <div>
                            <v-select class="w-full mt-2"
                            placeholder="حدد المستعملين (العملاء)"
                            v-model="customers"
                            v-validate="'required'"
                            label="text" :options="customers_list"
                            :reduce="text => text.value"
                            :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                            <span
                            v-if="!errors.has('customers') && customers">
                            <icon name="confirm" class="icon left-icon"/>
                            </span>
                            <span v-else-if="errors.has('customers')">
                            <icon name="cross" class="icon left-icon"/>
                            </span>
                        </div>
                        
                    </div>
                </div>
                <div class="vx-col w-full md:w-1/2">
                    <!-- Col Header -->
                    <div class="flex items-end">
                        <span class="leading-none font-medium text-sm">وقت الإرسال</span>
                    </div>
                     <!-- Col Content -->
                  <div class="bg-input">
                    <vs-input
                      size="large"
                      class="w-full text-base mt-2 "
                      placeholder="15/4/2021 10:45 AM"
                      v-model="date"
                      v-validate="'required'"
                      icon-no-border
                      icon="icon"
                      name="date"/>

                    <span v-if="!errors.has('date') && date">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('date')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                  </div>
                </div>
            </div>
            <div class="vx-row">
                <div class="vx-col">
                    <!-- Col Header -->
                    <div class="flex items-end">
                        <span class="leading-none font-medium text-xs">تفاصيل الإشعار</span>
                    </div>
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
      data_local: { name: null, email: null, mobile: null, cc: '+966', city_id:null, password: null,},
      cities_list: [
        {text:'الرياض',value:1},
        {text:'الدمام',value:2},
        {text:'جدة',value:3},
        {text:'تبوك',value:4}
      ],
     customers_list: [
        {text:'العميل الأول',value:1},
        {text:'العميل الثاني',value:2},
        {text:'العميل الثالث',value:3},
      ],
      customers:null,
      date:''
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