<!-- =========================================================================================
  Ahmed Khairy

  www.Clouds-line.com
========================================================================================== -->

<template>
  <div id="data-list-thumb-view" class="data-list-container">

    <!-- ADD NEW -->
    <div class="flex flex-wrap-reverse items-center mb-5">
      <vs-button @click="addNewData()" color="primary" type="gradient" icon-pack="feather" icon="icon-plus">{{ $t('AddNew') }}</vs-button>

    </div>

    <category-popup :popupActive="popupActive" @closePopup="toggleDataPopup" :data="popupData" />

    <div class="vx-row">
      <!-- USER PROFILE CARD 2 - MINIMAL -->
      <div v-for="category in categories" :key="category.id" class="vx-col w-full sm:w-1/2 lg:w-1/4 mb-base">
        <vx-card>
            <h4 class="mb-3">{{ $i18n.locale == 'en' ? category.title_en : category.title_ar }}</h4>
            <!-- ACTION SLOT -->
            <template slot="actions">
              <vs-chip>{{category.products_count}}</vs-chip>
              <feather-icon icon="ShoppingCartIcon"></feather-icon>
               <feather-icon icon="Trash2Icon" svgClasses="h-5 w-5 hover:text-danger cursor-pointer" @click="deleteCategory(category.id)" />
            </template>

            <ul class="friend-suggesions-list">
                <li class="friend-suggestion flex items-center mb-4" v-for="(filter, index) in category.filters" :key="index">
                    <!-- <div class="mr-3 img-container" width="35px">
                      <img :src="filtersLink+filter.images[0].link" class="" style="width:35px;" size="35px" />
                    </div> -->
                    <div class="leading-tight">
                        <p class="font-medium">{{ filter.title_en }}</p>
                        <span class="text-xs">{{ filter.title_ar }}</span>
                    </div>
                    <div class="ml-auto cursor-pointer flex justify-around" style="width: 7.5rem">
                        <vs-button @click.stop="editFilter(filter)" radius type="border" icon-pack="feather" icon="icon-edit" />
                        <vs-button @click.stop="confirmDeleteRecord(filter.id, category.id)" radius type="border" icon-pack="feather" icon="icon-trash" />
                    </div>
                </li>
            </ul>
            <template slot="footer" class="text-center">
              <vs-button @click.stop="createFilter(category.id)" icon-pack="feather" icon="icon-plus" class="w-full">{{ $i18n.locale == 'en' ? 'New Filter' : 'إضافة فلتر' }}</vs-button>
            </template>
        </vx-card>
      </div>
    </div>

  </div>
</template>

<script>
import CategoryPopup from './CategoryPopup.vue'

import moduleDataList from "@/store/categories-list/moduleDataList.js"

export default {
  components: {
    CategoryPopup
  },
  data() {
    return {
      popupActive: false,
      popupData: {},
      productsLink: 'https://otantik-home.s3.me-south-1.amazonaws.com/products/',
    }
  },
  computed: {
    categories() {
      return this.$store.state.categoriesData.categories
    }
  },
  methods: {
    validateForm() {
      return !this.errors.any()
    },
    addNewData() {
      this.popupData = {}
      this.toggleDataPopup(true)
      // console.log(this.$store.state.categoriesData.categories.length)

    },
    editFilter(data) {
      data['filter_id']= data.id
      this.popupData = data
      this.toggleDataPopup(true)
    },
    createFilter(id) {
      this.popupData = { category_id: id }
      this.toggleDataPopup(true)
    },
    deleteCategory(id) {
      this.$store.dispatch("categoriesData/removeItem", id).catch(err => { console.error(err) })
      window.location.reload()
    },
    toggleDataPopup(val=false) {
      this.popupActive = val
    },
    confirmDeleteRecord(filter, category) {
      this.$vs.dialog({
        type: 'confirm',
        color: 'danger',
        title: `Confirm Delete`,
        text: `Are you sure you want to delete this order?`,
        accept: this.deleteRecord(filter, category),
        acceptText: "Delete"
      })
    },
    deleteRecord(filter, category) {
      const obj = {
        filter_id: filter,
        category_id: category
      }

      this.$store.dispatch("categoriesData/removeFilter", obj)
        .then(()   => { this.showDeleteSuccess() })
        .catch(err => { console.error(err.response)       })
        window.location.reload()
    },
    showDeleteSuccess() {
      this.$vs.notify({
        color: 'success',
        title: 'Filter Removed',
        text: 'Filter Removed Successfully'
      })
    }
  },
  created() {
    if(!moduleDataList.isRegistered) {
      this.$store.registerModule('categoriesData', moduleDataList)
      moduleDataList.isRegistered = true
    }
    this.$store.dispatch("categoriesData/fetchDataListItems", this.$store.state.AppActiveUser.account_id)
  }
}
</script>

<style lang="scss">
  #data-list-thumb-view {
    margin: 1rem;
  }
</style>