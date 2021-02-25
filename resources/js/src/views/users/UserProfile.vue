<template>
  <div id="page-user-edit">
    <vx-card class="profile-info">

      <div slot="no-body" class="tabs-container md:px-6 pt-6 md:pb-4">
        <!-- Content Row -->
        <div class="vx-row">
          <div class="vx-col w-full md:w-1/2">
            <vs-avatar class="align" size="250px" />
          </div>
          <div class="vx-col w-full md:w-1/2">
            <!-- Col Header -->
            <div class="flex items-end">
              <feather-icon icon="UserIcon" class="mr-2" svgClasses="w-5 h-5" />
              <span class="leading-none font-medium">{{ $t('AccountInformation')}}</span>
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

              <vs-input 
              class="w-full mt-4" 
              :label="$t('Password')" 
              placeholder="Leave empty if you do not wish to change it" 
              v-model="data_local.password" 
              type="password" 
              v-validate="'min:6'" 
              name="password" />
              <span class="text-danger text-sm"  v-show="errors.has('password')">{{ errors.first('password') }}</span>
            </div>
          </div>
        </div>

        <!-- Save & Reset Button -->
        <div class="vx-row">
          <div class="vx-col w-full">
            <div class="mt-8 flex flex-wrap items-center justify-end">
              <vs-button class="ml-auto mt-2" @click="save_changes" :disabled="!validateForm">{{ $t('Save') }}</vs-button>
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
      data_local: { name: null, email: null, mobile: null, password: null},
    }
  },
  computed: {
    validateForm() {
      return !this.errors.any() && ((!this.data_local.id && this.data_local.password) || this.data_local.id)
    },
    activeUserInfo () {
      return this.$store.state.AppActiveUser
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
#page-user-edit {
    margin: 2rem 2.5rem;

    .profile-info {
        padding: 2.5rem;
    }
}

@media only screen and (min-width: 375px) and (max-width: 600px) {
  #page-user-edit {
    .align {
      display: block;
      margin: 0.5rem auto;
    }
  }
}

@media only screen and (min-width: 360px) and (max-width: 375px) {
  #page-user-edit {
    .align {
      display: block;
      margin: 0.5rem -1rem;
    }
  }
}

@media only screen and (min-width: 320px)  and (max-width: 360px) {
  #page-user-edit {
    .align {
      width: 200px !important;
      height: 200px !important;
      margin: 0.5rem auto;
    }
  }
}

@media only screen  and (max-width: 320px) {
  #page-user-edit {
    .align {
      width: 200px !important;
      height: 200px !important;
      margin: 0.5rem -1.5rem;
    }
  }
}
</style>