<template>
  <div id="create-admin">
    <vx-card class="admin-info">
      <div slot="no-body" class="tabs-container md:px-6 pt-6 md:pb-4">
        <!-- Content Row -->
        <div class="vx-row">
          <div class="vx-col hidden lg:block lg:w-2/5 justify-center items-center">
            <div class="upload ml-8 mt-24">
              <input type="file" class="hidden" ref="uploadImgInput" multiple @change="updateCurrImg" accept="image/*">
              <vs-button v-if="dataUploadedImages.length === 0" class="mt-16 ml-10" type="transparent" @click="$refs.uploadImgInput.click()">
              <img src="@assets/images/Uploader.png" alt="upload" width="90"/>
              </vs-button>
            </div>
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
                      v-model="admin_data.name"
                      v-validate="'required'"
                      icon-no-border
                      icon="icon"
                      name="name"/>

                    <span v-if="!errors.has('name') && admin_data.name">
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
                    v-model="admin_data.email"
                    class="w-full mt-2"/>

                   <span v-if="!errors.has('email') && admin_data.email">
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
                    v-model="admin_data.mobile"
                    type="number"
                    icon-no-border
                    icon="icon"
                    v-validate="'required|min:7'"
                    class="w-3/4 mt-2 px-3"/>

                  <vs-input
                  v-model="admin_data.cc"
                  type="text"
                  disabled
                  dir="ltr"
                  icon-no-border
                  v-validate="'required'"
                  class="w-1/5 mt-2"
                  placeholder="966+"/>

                  <span v-if="!errors.has('mobile') && admin_data.mobile">
                    <icon name="confirm" class="icon left-phone-icon"/>
                  </span>
                  <span v-else-if="errors.has('mobile')">
                    <icon name="cross" class="icon left-phone-icon"/>
                  </span>
                </div>

                <div class="bg-input">
                    <icon name="city" class="icon"/>
                    <v-select class="w-full mt-2"
                     v-model="admin_data.city_id"
                     :placeholder="$t('Location')"
                     label="text" :options="cities_list"
                     :reduce="text => text.value"
                     :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                    <span v-if="!errors.has('city_id') && admin_data.city_id">
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
                    v-model="admin_data.password"
                    class="w-full mt-2"/>

                  <span v-if="!errors.has('password') && admin_data.password">
                    <icon name="confirm" class="icon left-icon"/>
                  </span>
                  <span v-else-if="errors.has('password')">
                    <icon name="cross" class="icon left-icon"/>
                  </span>
                </div>

                <div class="bg-input">
                    <v-select class="w-full mt-2"
                     v-model="status"
                     :placeholder="$t('accountStatus')"
                     label="text" :options="status_list"
                     :reduce="text => text.value"
                     :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                    <span v-if="!errors.has('status') && status">
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
      admin_data: { name: null, email: null, mobile: null, cc: '+966', city_id:null, password: null,},
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
      status:null,
      dataUploadedImages: [],
      dataUploadedImagesForDisplay: [],
      ImageToDelete: null,
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
          this.dataUploadedImages = input.target.files

            const url = URL.createObjectURL(this.dataUploadedImages[i])
            this.dataUploadedImages[i].url = url

          // this.dataImg.push(input.target.files[0])
          // this.dataImg = input.target.files[0]
          // this.dataImg = e.target.result

        }
        reader.readAsDataURL(input.target.files[0])
      }
    },
    registerUser()  {
      if(!this.validateForm) return

      // Here will go your API call for updating data
      // You can get data in "this.data_local"
       // const obj = {
           // id: this.data_local.id,
           // name: this.data_local.name,
           // email: this.data_local.email,
            //mobile: this.data_local.mobile,
            //status: this.activeUserInfo.status,
            //rule: this.activeUserInfo.rule
       // }
       // if (this.data_local.password){
           // obj.password = this.data_local.password
       // }

        this.$store.dispatch("userManagement/updateUser", this.admin_data)
        .then(res => {
                        if( res.data.statusCode == 200 ){
                        this.$vs.notify({
                        color: 'success',
                        title: 'Successfull',
                        text: 'تم التسجيل بنجاح'
                        })
                        window.location.reload()
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