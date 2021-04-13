<template>
  <div id="create-admin">
    <vx-card class="admin-info">
      <div slot="no-body" class="tabs-container md:px-6 pt-6 md:pb-4">
        <!-- Content Row -->
        <div class="vx-row">
          <div class="vx-col w-full lg:block lg:w-2/5 justify-center items-center">
            <div class="center">
              <div class="upload mt-16 mb-8">
                <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
                <vs-button v-if="dataUploadedImages.length === 0" class="mt-16 ml-4" type="transparent" @click="$refs.uploadImgInput.click()">
                <img src="@assets/images/Uploader.png" alt="upload" width="100"/>
                </vs-button>
              </div>
            </div>
          </div>
          <div class="vx-col sm:w-full md:w-full lg:w-1/2">
            <!-- Col Header -->
            <div class="vx-card__title">
                <div class="separator">
                    <h4 class="mb-4 text-base ">{{$t('accountData')}}</h4>
                </div>
            </div>

            <!-- Col Content -->
            <div>
                <div class="bg-input">
                    <icon name="user-name" class="icon"/>
                    <vs-input
                      class="w-full text-base"
                      :placeholder="$t('fullName')"
                      v-model="user_data.name"
                      v-validate="'required'"
                      icon-no-border
                      icon="icon"
                      name="name"/>

                    <span v-if="!errors.has('name') && user_data.name">
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
                    v-model="user_data.email"
                    class="w-full mt-2"/>

                   <span v-if="!errors.has('email') && user_data.email">
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
                    v-model="user_data.mobile"
                    type="number"
                    icon-no-border
                    icon="icon"
                    v-validate="'required|min:7'"
                    class="w-3/4 mt-2 px-3"/>

                  <vs-input
                  v-model="user_data.cc"
                  type="text"
                  disabled
                  dir="ltr"
                  icon-no-border
                  v-validate="'required'"
                  class="w-1/5 mt-2"
                  placeholder="966+"/>

                  <span v-if="!errors.has('mobile') && user_data.mobile">
                    <icon name="confirm" class="icon left-phone-icon"/>
                  </span>
                  <span v-else-if="errors.has('mobile')">
                    <icon name="cross" class="icon left-phone-icon"/>
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
                    v-model="user_data.password"
                    class="w-full mt-2"/>

                  <span v-if="!errors.has('password') && user_data.password">
                    <icon name="confirm" class="icon left-icon"/>
                  </span>
                  <span v-else-if="errors.has('password')">
                    <icon name="cross" class="icon left-icon"/>
                  </span>
                </div>

                <div class="bg-input">
                    <v-select class="w-full mt-2"
                     v-model="user_data.status"
                     :placeholder="$t('accountStatus')"
                     label="text" :options="status_list"
                     :reduce="text => text.id"
                     :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                    <span v-if="!errors.has('status') && user_data.status">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('status')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                </div>

                <div class=" mb-3">
                  <vs-button
                    class="w-full mt-10 font-medium register-btn rounded-full"
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
import moduleUserManagement from '@/store/user-management/moduleUserManagement.js'

export default {
  components: {
    icon,
    vSelect
  },
  data() {
    return {
      user_data: { name: null, email: null, mobile: null, cc: '+966', password: null,status:null},
      status_list: [
        {text:'غير نشط',id:1},
        {text:'نشط',id:2},
      ],
      dataUploadedImages: [],
    }
  },
  computed: {
    validateForm() {
      return ( !this.errors.any() && this.admin_data.email && this.admin_data.password ) ;
    },
  },
  methods: {
    updateCurrImg(input) {
       if (input.target.files && input.target.files[0]) {
         var reader = new FileReader()
         reader.onload = e => {
           this.dataUploadedImages= input.target.files[0]
           console.log(input.target.files[0])
         }
         reader.readAsDataURL(input.target.files[0])
       }
    },
    registerUser()  {
      //if(!this.validateForm) return

      let formData = new FormData();
      formData.append('name', this.user_data.name)
      formData.append('email', this.user_data.email)
      formData.append('cc', this.user_data.cc)
      formData.append('mobile', this.user_data.mobile)
      formData.append('password', this.user_data.password)
      formData.append('status', this.user_data.status)
      if (this.dataUploadedImages){
          formData.append('image', this.dataUploadedImages);
      }
      if (this.user_data.id != null && this.user_data.id > 0){
        var link = "userManagement/updateUser"
      }else{
        var link = "userManagement/addUser"
      }
      this.$store.dispatch(link,formData)                                 
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
      .catch(err => { console.error(err) })
    },


  },
  created() {
    // Register Module UserManagement Module
    if(!moduleUserManagement.isRegistered) {
      this.$store.registerModule('userManagement', moduleUserManagement)
      moduleUserManagement.isRegistered = true
    }
    if (this.$route.params.userID != null){
      this.$store.dispatch("userManagement/fetchUser", this.$route.params.userID).catch(err => { console.error(err) })
      .then((res) => {
        this.formData = res.data.user
      })
      .catch((error) => console.log(error))
    }

  }
}
</script>

<style lang="scss" scoped>
#create-admin {
    margin: 2rem 2.5rem;

    .admin-info{
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
  .center{
      text-align: -webkit-center;
    }
  .upload{
    background: rgb(243, 243, 243);
    border-radius: 50%;
    width: 230px;
    height: 230px;
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
  .con-select {
    .vs-select--input {
      padding: .7rem .7rem .7rem 5rem;
      font-size: .8rem;
    }
  }
}
@media (max-width: 992px) and (min-width: 600px){
#create-admin {
  .bg-input{
    .left-icon{
        left: 95%;
      }
    }
  }
}
@media (min-width: 375px) and (max-width: 600px){
  #create-admin {
    .bg-input{
      .left-icon{
          left: 88%;
        }
        .left-phone-icon{
        left: 60%;
      }
    }
  }
}




</style>