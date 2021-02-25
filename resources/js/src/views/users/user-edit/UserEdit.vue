<!-- =========================================================================================
  File Name: UserEdit.vue
  Description: User Edit Page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="page-user-edit">

    <vs-alert color="danger" title="User Not Found" :active.sync="user_not_found">
      <span>User record with id: {{ $route.params.userId }} not found. </span>
      <span>
        <span>Check </span><router-link :to="{name:'page-user-list'}" class="text-inherit underline">All Users</router-link>
      </span>
    </vs-alert>

    <vx-card>

      <div slot="no-body" class="tabs-container px-6 pt-6 pb-4">
        <!-- Content Row -->
        <div class="vx-row">

          <div class="vx-col md:w-1/2 w-full">

            <!-- Col Header -->
            <div class="flex items-end">
              <feather-icon icon="UserIcon" class="mr-2" svgClasses="w-5 h-5" />
              <span class="leading-none font-medium">{{ $t('AccountInformation') }}</span>
            </div>

            <!-- Col Content -->
            <div>
              <vs-input
              class="w-full mt-4"
              :label="$t('Name')"
              v-model="data_local.name"
              v-validate="'required|alpha_spaces'"
              name="name" />
              <span class="text-danger text-sm"  v-show="errors.has('name')">{{ errors.first('name') }}</span>

              <vs-input
              class="w-full mt-4" :label="$t('Email')"
              v-model="data_local.email" type="email"
              v-validate="'required|email'"
              name="email" />
              <span class="text-danger text-sm"  v-show="errors.has('email')">{{ errors.first('email') }}</span>

              <vs-input
              class="w-full mt-4"
              :label="$t('Mobile')"
              placeholder="56xxxxxxx"
              v-model="data_local.mobile"
              type="number"
              v-validate="'required'"
              name="mobile" />
              <span class="text-danger text-sm"  v-show="errors.has('mobile')">{{ errors.first('mobile') }}</span>
            </div>
          </div>

          <div class="vx-col md:w-1/2 w-full">

            <!-- Col Header -->
            <div class="flex items-end">
              <feather-icon icon="LockIcon" class="mr-2" svgClasses="w-5 h-5" />
              <span class="leading-none font-medium">{{ $t('Controls') }}</span>
            </div>

            <!-- Col Content -->
            <div>

              <div class="mt-4">
                <label class="vs-input--label">{{ $t('Status') }}</label>
                <v-select v-model="data_local.status" :clearable="false" :options="statusOptions" v-validate="'required'" name="status" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                <span class="text-danger text-sm"  v-show="errors.has('status')">{{ errors.first('status') }}</span>
              </div>

              <div class="mt-4">
                <label class="vs-input--label">{{ $t('Role') }}</label>
                <v-select v-model="data_local.rule" :clearable="false" :options="roleOptions" v-validate="'required'" name="role" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                <span class="text-danger text-sm"  v-show="errors.has('role')">{{ errors.first('role') }}</span>
              </div>

              <vs-input class="w-full mt-4" :label="$t('Password')" placeholder="Leave empty if you do not wish to change it" v-model="data_local.password" type="password" v-validate="'min:6'" name="password" />
              <span class="text-danger text-sm"  v-show="errors.has('password')">{{ errors.first('password') }}</span>

            </div>
          </div>
        </div>

        <!-- Save & Reset Button -->
        <div class="vx-row">
          <div class="vx-col w-full">
            <div class="mt-8 flex flex-wrap items-center justify-end">
              <vs-button class="ml-auto mt-2" @click="save_changes" :disabled="!validateForm">{{ $t('Save') }}</vs-button>
              <vs-button class="ml-4 mt-2" type="border" color="warning" @click="reset_data">{{ $t('Reset' )}}</vs-button>
            </div>
          </div>
        </div>


      </div>

    </vx-card>
  </div>
</template>

<script>
import vSelect from 'vue-select'
// import UserEditTabAccount     from "./UserEditTabAccount.vue"

// Store Module
import moduleUserManagement from '@/store/user-management/moduleUserManagement.js'

export default {
  components: {
    // UserEditTabAccount,
    vSelect
  },
  data() {
    return {
      user_data: null,
      user_not_found: false,
      data_local: { name: null, email: null, mobile: null, password: null, rule: null, status: null},
      statusOptions: [
        { label: "Deactivated",  value: 0 },
        { label: "Active",  value: 1 },
      ],
      roleOptions: [
        { label: this.$i18n.locale == 'en' ? 'All': 'الكل', value: 'all' },
        { label: this.$i18n.locale == 'en' ? 'Admin' : 'اداري', value: 'admin' },
        { label: this.$i18n.locale == 'en' ? 'Operator' : 'مشغل', value: 'operator' },
        { label: this.$i18n.locale == 'en' ? 'Customer' : 'عميل', value: 'customer' },
      ],
    }
  },
  computed: {
    validateForm() {
      return !this.errors.any() && ((!this.data_local.id && this.data_local.password) || this.data_local.id)
    }
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
        status: this.data_local.status.value,
        rule: this.data_local.rule.value
      }
      if (this.data_local.password){
        obj.password = this.data_local.password
      }

      if(this.data_local.id !== null && this.data_local.id >= 0) {
        this.$store.dispatch("userManagement/updateUser", obj)
        .then(res => {
                      if( res.data.statusCode == 200 ){
                      this.$vs.notify({
                        color: 'success',
                        title: 'Successfull',
                        text: 'User updated successfully'
                      })
                      this.$router.go(-1)
                    }else{
                      this.$vs.notify({
                        color: 'danger',
                        title: 'Error',
                        text: 'Error updating user'
                      })
                    }
                     })
        .catch(err => { console.error(err) })

      }else{
        // delete obj.id
        // obj.popularity = 0
        this.$store.dispatch("userManagement/addUser", obj)
        .then(res => {
                      if( res.data.statusCode == 200 ){
                      this.$vs.notify({
                        color: 'success',
                        title: 'Successfull',
                        text: 'User created successfully'
                      })
                      this.$router.go(-1)
                    }else{
                      this.$vs.notify({
                        color: 'danger',
                        title: 'Error',
                        text: 'Error creating user'
                      })
                    }
                     })
        .catch(err => { console.error(err) })

      }


    },
    reset_data() {
      this.data_local = JSON.parse(JSON.stringify(this.data))
    },
    fetch_user_data(userId) {
      this.$store.dispatch("userManagement/fetchUser", userId)
        .then(res => { this.data_local = res.data
                        this.user_data = res.data })
        .catch(err => {
          if(err.response.status === 404) {
            this.user_not_found = true
            return
          }
          console.error(err) })
    }
  },
  created() {
    // Register Module UserManagement Module
    if(!moduleUserManagement.isRegistered) {
      this.$store.registerModule('userManagement', moduleUserManagement)
      moduleUserManagement.isRegistered = true
    }
    if (this.$route.params.userId){
      this.fetch_user_data(this.$route.params.userId)
    }
  }
}

</script>
