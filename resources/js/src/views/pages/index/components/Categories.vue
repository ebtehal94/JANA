
<template>
  <div>
    <section class="section bg-white">
      <div class="container pt-0 pb-0">
        <div class="row categories-box-container">
          <div class="categories-column mb-base" v-for="item in filteredKB" :key="item.id" @click="$emit('pageChanged', 4,i)">
            <vx-card class="text-center cursor-pointer categories-box">
              <img :src="item.graphic" alt="graphic"  width="70" height="70" class="mx-auto mb-4 text-grey">
              <h4 class="mb-2 title">{{ $i18n.locale == 'en' ? item.title_en.toUpperCase() : item.title_ar.toUpperCase()}}</h4>
            </vx-card>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>



<script>
export default{
  components: {

    },
    props:{
        searchQuery:{
            required:true
        },
        selectedPage: {
        default: 2
      }
    },
  data () {
    return {
    //   categories:[],
      kb: [
        {
          id          : 1,
          title_ar       : 'تهيئة النظام ',
          title_en       : 'System Initialization',
          graphic     :require('@assets/images/basmatk/graphic-1.svg'),
          url         :'/knowledge-base-category'
        },
        {
          id          : 2,
          title_ar       : ' ربط الأجهزة',
          title_en       : 'connect devices',
          graphic     : require('@assets/images/basmatk/graphic-2.svg'),
          url         :'/knowledge-base-category'
        },
        {
          id          : 3,
          title_ar       : 'التطبيق',
          title_en       : 'Application',
          graphic     : require('@assets/images/basmatk/graphic-3.svg'),
          url         :'/knowledge-base-category'
        },
        {
          id          : 4,
          title_ar       : 'الإشتراك ',
          title_en       : 'Subscription',
          graphic     : require('@assets/images/basmatk/graphic-4.svg'),
          url         :'/knowledge-base-category'
        },
        {
          id          : 5,
          title_ar       : 'الرئيسية',
          title_en       : 'Dashboard',
          graphic     : require('@assets/images/basmatk/graphic-5.svg'),
          url         :'/knowledge-base-category'
        },
        {
          id          : 6,
          title_ar       : 'الموظفين',
          title_en       : 'ُEmployees',
          graphic     : require('@assets/images/basmatk/graphic-6.svg'),
          url         :'/knowledge-base-category'
        },
        {
          id          : 7,
          title_ar       : 'المالية',
          title_en      : 'Finance',
          graphic     : require('@assets/images/basmatk/graphic-7.svg'),
          url         :'/knowledge-base-category'
        },
        {
          id          : 8,
          title_ar       : 'التحكم و الإعدادات',
          title_en       : 'Control and settings',
          graphic     : require('@assets/images/basmatk/graphic-8.svg'),
          url         :'/knowledge-base-category'
        },
        {
          id          : 9,
          title_ar      : 'المهام',
          title_en      : 'Task Management',
          graphic     : require('@assets/images/basmatk/graphic-9.svg'),

        },
        {
          id          : 10,
          title_ar       : 'الطلبات',
          title_en       : 'Requests',
          graphic     : require('@assets/images/basmatk/graphic-10.svg'),
          url         :'/knowledge-base-category'
        }
      ]
    }

  },
  computed: {
    filteredKB () {
      return this.kb.filter((item) => item.title_ar.toLowerCase().includes(this.searchQuery.toLowerCase()) || item.title_en.toLowerCase().includes(this.searchQuery.toLowerCase()))
    }
  },
  
  methods: {

  },
  created(){
        // axios.get('/api/categories/list')
        // .then((res) => {
        //     console.log(res.data)
        // this.categories = res.data.categories
        // })
        // .catch((error) => console.log(error))
  }

}
</script>


<style lang="scss">
.categories-box-container{
  width:100%;
  margin: 2rem auto 0;
}
.categories-box-container .categories-column{
  width: 100%;
}
@media (min-width: 768px){
  .categories-box-container .categories-column{
    width: 45% !important;
    margin-left: 10px;
    margin-right: 10px;
  }
}
@media (min-width: 1200px){
  .categories-box-container{
    width:85%;
    margin: 2rem auto 0;
  }
  .categories-box-container .categories-column{
    width: 18% !important;
    margin-left: 10px;
    margin-right: 10px;
  }
}
.categories-box{
  background: #f2f2f2;
  border-radius: 15px;
}
.categories-box:active, .categories-box:hover{
  background: #0E77FF;
  box-shadow: rgba(14, 119, 255, 50%) 0px 8px 24px;
}
.categories-box .title{
  font-size:.8rem;
  font-weight: 700;
  color:#333;
}
.categories-box:active, .categories-box:hover .title{
  color:#fff;
  
}

</style>

