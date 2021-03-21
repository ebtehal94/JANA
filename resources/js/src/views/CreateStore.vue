<template>
  <div id="create-store">
    <vx-card class="store-info">
      <div slot="no-body" class="tabs-container md:px-6 pt-6 md:pb-4">
        <!-- Content Row -->
        <div class="vx-row">
          <div class="vx-col w-full md:w-2/5 pr-8 mt-5 justify-center items-center">
            <div class="upload ml-8">
              <input type="file" class="hidden" ref="uploadImgInput" multiple @change="updateCurrImg" accept="image/*">
              <vs-button v-if="dataUploadedImages.length === 0" class="mt-12 ml-8" type="transparent" @click="$refs.uploadImgInput.click()">
              <img src="@assets/images/Uploader.png" alt="upload" width="90"/>
              </vs-button>
            </div>
            <div class="text-center text-xs mt-12">
              <p>تاريخ الإنضمام<span class="pl-4 date">15/4/2021</span></p>
              <p>تاريخ آخر عرض<span class="pl-4 date">15/4/2021</span></p>
            </div>
            <div class="bg-input text-center">
              <icon name="qrcode" class="qr-icon"/>
              <vs-button
                size="small"
                class="pl-4 mt-8 text-xs font-bold rounded-full"
                color="linear-gradient(to left,#E93F7D,#DA6653)"
                gradient>
                إنشاء QRCODE
              </vs-button>
            </div>
            <div class="bg-input">
                <v-select class="w-full mt-8"
                v-model="status"
                placeholder="حالة الحساب (غير نشط)"
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
          </div>

          <div class="vx-col sm:w-full md:w-1/2 lg:w-1/2">
            <!-- Col Header -->
            <div class="vx-card__title">
                <div class="separator">
                    <h4 class="mb-4 text-base">بيانات المتجر</h4>
                </div>
            </div>

            <!-- Col Content -->
                <div>
                  <div class="bg-input">
                    <icon name="store-name" class="icon"/>
                    <vs-input
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
                    <icon name="store-name" class="icon"/>
                    <vs-input
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
                  <div class="bg-input text-xs">
                    <icon name="city" class="icon"/>
                    <v-select class="w-full mt-2 text-xs"
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
                <div class="vx-card__title mt-5">
                    <div class="separator">
                        <h4 class="mb-4 text-base">طريقة الإتصال</h4>
                    </div>
                </div>

                <div class="vx-row bg-input">
                  <icon name="mobile" class="icon phone-icon"/>
                  <vs-input
                    placeholder="رقم الجوال"
                    v-model="data_local.phone"
                    type="number"
                    icon-no-border
                    icon="icon"
                    v-validate="'required|min:7'"
                    class="w-3/4 mt-2 px-3"/>

                  <vs-input
                    v-model="data_local.cc"
                    type="text"
                    disabled
                    dir="ltr"
                    icon-no-border
                    v-validate="'required'"
                    class="w-1/5 mt-2"
                    placeholder="966+"/>

                  <span v-if="!errors.has('phone') && data_local.phone">
                    <icon name="confirm" class="icon left-phone-icon"/>
                  </span>
                  <span v-else-if="errors.has('phone')">
                    <icon name="cross" class="icon left-phone-icon"/>
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
                      class="w-full mt-10 font-medium register-btn rounded-full"
                      color="linear-gradient(to left,#E93F7D,#DA6653)"
                      gradient>
                      حفظ التغيرات
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
      status:null,
      dataUploadedImages: [],
      dataUploadedImagesForDisplay: [],
      ImageToDelete: null,
    }
  },
  computed: {
    validateForm() {
      return !this.errors.any() && ((!this.data_local.id && this.data_local.password) || this.data_local.id)
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
  }
}
</script>

<style lang="scss" scoped>
#create-store {
    margin: 2rem 2.5rem;

    .store-info{
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
    width: 200px;
    height: 200px;
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
    .qr-icon{
      position: absolute;
      top:55%;
      left: 60%;
      z-index: 9999;
    }
  }
  .date{
    color: #ACACAC;
  }
  .vs-button.small:not(.includeIconOnly) {
    padding: 0.5rem 4rem 0.5rem 1.5rem;
    
  }
  .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large) {
      padding: .5rem 2rem;
  }
}

@media (min-width: 768px) and (max-width: 991.98px){
  #create-store {
    .upload{
      margin-left: 0rem !important;
    }
    .bg-input{
      .left-icon{
        left: 88%;
      }
      .left-phone-icon{
        left: 62%;
        top:20px;
      }
    }
  }
}
@media only screen and (min-width: 375px) and (max-width: 600px) {
  #create-store {
    .vx-card__title{
      margin-top: 1.5rem;
    }
    .upload{
      margin-left: 0rem !important;
    }
    .qr-icon{
      left: 57%;
    }
    .bg-input{
      .left-icon{
        left: 88%;
      }
      .left-phone-icon{
        left: 62%;
        top:20px;
      }
    }
  }
}

@media only screen and (min-width: 360px) and (max-width: 375px) {
  #create-store {
    .vx-card__title{
      margin-top: 1.5rem;
    }
    .qr-icon{
      left: 55%;
    }
  }
}


</style>