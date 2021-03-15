<template>
  <div id="page-user-edit">
    <vx-card class="profile-info">

      <div slot="no-body" class="tabs-container md:px-6 pt-6 md:pb-4">
        <!-- Content Row -->
        <div class="vx-row">
          <div class="vx-col w-full md:w-1/2">
            <!-- Col Header -->
            <div class="flex items-end">
              <span class="leading-none font-semibold text-xs">بيانات العرض باللغة العربية</span>
            </div>

            <!-- Col Content -->
            <div>
              <vs-input 
              class="w-full mt-4"
              placeholder="العنوان" 
              v-model="offer_data.name" 
              v-validate="'required|alpha_spaces'" 
              name="name" />
              <span class="text-danger text-sm"  v-show="errors.has('name')">{{ errors.first('name') }}</span>

              <vs-textarea 
              placeholder="الوصف"
              v-model="offer_data.desc_ar" 
              class="mt-2 w-full px-8" 
              name="desc_ar"/>
              <span class="text-danger text-sm" v-show="errors.has('desc_ar')">{{ errors.first('desc_ar') }}</span>

            </div>
          </div>

            <div class="vx-col w-full md:w-1/2">
            <!-- Col Header -->
            <div class="flex items-end">
              <span class="leading-none font-semibold text-xs">بيانات العرض باللغة العربية</span>
            </div>

            <!-- Col Content -->
            <div>
              <vs-input 
              class="w-full mt-4" 
              placeholder="العنوان"
              v-model="offer_data.name" 
              v-validate="'required|alpha_spaces'" 
              name="name" />
              <span class="text-danger text-sm"  v-show="errors.has('name')">{{ errors.first('name') }}</span>

              <vs-textarea 
              placeholder="الوصف"
              v-model="offer_data.desc_ar" 
              class="mt-2 w-full px-8" 
              name="desc_ar"/>
              <span class="text-danger text-sm" v-show="errors.has('desc_ar')">{{ errors.first('desc_ar') }}</span>

            </div>
          </div>
        </div>

        <div class="vx-row my-6">
          <div class="vx-col w-full md:w-1/2">
            <!-- Col Header -->
            <div class="flex items-end">
              <span class="leading-none font-semibold text-xs">خصائص العرض</span>
            </div>

            <!-- Col Content -->
            <div>
                <div class="bg-input">
                    <v-select class="w-full mt-2"
                      placeholder="الفئة (القسم)"
                      v-model="offer_data.category"
                      v-validate="'required'"
                      label="text" :options="category_list"
                      :reduce="text => text.value"
                      :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                    <span
                      v-if="!errors.has('category') && offer_data.category">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('category')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                </div>

                <div class="bg-input">
                    <v-select class="w-full mt-2"
                      placeholder="حالة العرض (نشطة)"
                      v-model="offer_data.status"
                      v-validate="'required'"
                      label="text" :options="status_list"
                      :reduce="text => text.value"
                      :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                    <span
                      v-if="!errors.has('status') && offer_data.status">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('status')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                </div>
                
            </div>
          </div>

          <div class="vx-col w-full md:w-1/2">
            <!-- Col Header -->
            <div class="flex items-end">
              <span class="leading-none font-semibold text-xs">صور العرض</span>
            </div>

            <!-- Col Content -->
            <div class="vx-row flex mt-4 mx-0">
              <div class="vx-col w-full md:w-1/3 add-img">
              </div>
              <div class="vx-col w-full md:w-1/3">
                <img src="@assets/images/payment-methods.png" alt="" class="mx-auto" width="120">
              </div>
              <div class="vx-col w-full md:w-1/3">
                <img src="@assets/images/card.png" alt="" class="mx-auto" width="120">
              </div>
            </div>
          </div>
        </div>

        <div class="vx-row my-6">
          <div class="vx-col w-full md:w-1/2 flex">
            <div class="vx-col w-full">
              <!-- Col Header -->
              <div class="flex items-end">
                <span class="leading-none font-medium text-xs">السعر قبل الخصم</span>
              </div>

              <!-- Col Content -->

                <vs-input 
                class="w-full mt-4"
                placeholder="السعر" 
                v-model="offer_data.name" 
                v-validate="'required|alpha_spaces'" 
                name="name" />
                <span class="text-danger text-sm"  v-show="errors.has('name')">{{ errors.first('name') }}</span>
  
            </div>

            <div class="vx-col w-full">
              <!-- Col Header -->
              <div class="flex items-end">
                <span class="leading-none font-medium text-xs">السعر بعد الخصم</span>
              </div>

              <!-- Col Content -->

                <vs-input 
                class="w-full mt-4"
                placeholder="السعر" 
                v-model="offer_data.name" 
                v-validate="'required|alpha_spaces'" 
                name="name" />
                <span class="text-danger text-sm"  v-show="errors.has('name')">{{ errors.first('name') }}</span>

            </div>

            <div class="vx-col w-full">
              <!-- Col Header -->
              <div class="flex items-end">
                <span class="leading-none font-medium text-xs">تاريخ انتهاء العرض</span>
              </div>

              <!-- Col Content -->

                <vs-input 
                class="w-full mt-4"
                placeholder="14/14/2021" 
                v-model="offer_data.name" 
                v-validate="'required|alpha_spaces'" 
                name="name" />
                <span class="text-danger text-sm"  v-show="errors.has('name')">{{ errors.first('name') }}</span>
            </div>
          </div>

          <div class="vx-col w-full md:w-1/2">
            <!-- Col Header -->
            <div class="flex items-end">
              <span class="leading-none font-medium text-xs">بيانات العرض باللغة العربية</span>
            </div>

            <!-- Col Content -->
            <div>
             <div>
                <div class="bg-input">
                    <v-select class="w-full mt-2"
                      placeholder=" (القسم)الفئة"
                      v-model="offer_data.category"
                      v-validate="'required'"
                      label="text" :options="category_list"
                      :reduce="text => text.value"
                      :dir="$vs.rtl ? 'rtl' : 'ltr'" />

                    <span
                      v-if="!errors.has('category') && offer_data.category">
                      <icon name="confirm" class="icon left-icon"/>
                    </span>
                    <span v-else-if="errors.has('category')">
                      <icon name="cross" class="icon left-icon"/>
                    </span>
                 </div>
            </div>
            </div>
          </div>
        </div>
        
        <!-- Save & Reset Button -->
        <div class="vx-row flex justify-center mt-10">
            <vs-button
              size="small"
              class="mx-4 font-semibold text-sm rounded-full"
              color="linear-gradient(to left,#E93F7D,#DA6653)"
              gradient
              @click="registerUser">
                إنشاء العرض
            </vs-button>

            <vs-button
              size="small"
              class="mx-4 font-semibold text-sm rounded-full px-24"
              color="#ACACAC" type="border"
              @click="registerUser">
                خروج 
            </vs-button>
        </div>


      </div>

    </vx-card>
  </div>
</template>

<script>
import vSelect from 'vue-select'
import icon from '@/layouts/components/icon.vue'


// Store Module
import moduleUserManagement from '@/store/user-management/moduleUserManagement.js'

export default {
  components: {
    icon,
    vSelect
  },
  data() {
    return {
      offer_data: { name: null, category: null, desc_ar:null, mobile: null, password: null,status:null},
      category_list:[
        {text:'القسم الأول',value:1},
        {text:'القسم الثاني',value:2},
        {text:'القسم الثالث',value:3},
        {text:'القسم الرابع',value:4}
      ],
      status_list: [
        {text:'غير نشط',value:1},
        {text:'نشط',value:2},
      ],
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
#page-user-edit {
    margin: 2rem 2.5rem;

    .profile-info {
        padding: 2.5rem;
    }
    .add-img{
      border: 1px solid #eee;
      border-radius: 15px;
    }
    .vs-button.small:not(.includeIconOnly) {
      padding: 0.4rem 5rem;
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