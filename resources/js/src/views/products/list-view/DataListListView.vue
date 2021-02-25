<!-- =========================================================================================
  File Name: DataListListView.vue
  Description: Data List - List View
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="data-list-list-view" class="data-list-container">

    <vs-table ref="table" pagination :max-items="itemsPerPage" search :data="products">

      <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">

        <div class="flex flex-wrap-reverse items-center data-list-btn-container">
          <div class="p-4 mr-4 mb-4 shadow-drop rounded-lg d-theme-dark-bg cursor-pointer flex items-center justify-center text-lg font-medium w-32" @click="thumbView">
            <span class="mr-2">{{ $i18n.locale == 'en' ? 'Thumb' : 'قائمة' }}</span>
            <feather-icon icon="GridIcon" svgClasses="h-4 w-4" />
          </div>


          <!-- ADD NEW -->
          <div class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary" @click="addNewData">
              <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
              <span class="ml-2 text-base text-primary">{{ $t('AddNew') }}</span>
          </div>
        </div>

        <!-- ITEMS PER PAGE -->
        <vs-dropdown vs-trigger-click class="cursor-pointer mb-4 mr-4 items-per-page-handler">
          <div class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
            <span class="mr-2">{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} - {{ products.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : products.length }} of {{ queriedItems }}</span>
            <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
          </div>
          <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
          <vs-dropdown-menu>

            <vs-dropdown-item @click="itemsPerPage=4">
              <span>4</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage=10">
              <span>10</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage=15">
              <span>15</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage=20">
              <span>20</span>
            </vs-dropdown-item>
          </vs-dropdown-menu>
        </vs-dropdown>
      </div>

      <template slot="thead">
        <vs-th sort-key="name">{{ $i18n.locale == 'en' ? 'Name' : 'العنوان' }}</vs-th>
        <vs-th sort-key="category">{{ $i18n.locale == 'en' ? 'Category' : 'التصنيف' }}</vs-th>
        <vs-th>{{ $i18n.locale == 'en' ? 'Action' : 'إدارة' }}</vs-th>
      </template>

        <template slot-scope="{data}">
          <tbody>
            <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">

              <vs-td>
                <p class="product-name font-medium truncate">{{ $i18n.locale == 'en' ? (tr.title_en || 'N/A') : (tr.title_ar || 'N/A') }}</p>
              </vs-td>

              <vs-td>
                <p class="product-category">{{ tr.category.title_en }}</p>
              </vs-td>

              <vs-td class="whitespace-no-wrap">
                <feather-icon icon="EditIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current" @click.stop="editData(tr)" />
                <feather-icon icon="Trash2Icon" svgClasses="h-5 w-5 hover:text-danger cursor-pointer" @click="confirmDeleteRecord(tr.id)" />
              </vs-td>

            </vs-tr>
          </tbody>
        </template>
    </vs-table>
  </div>
</template>

<script>
import DataViewSidebar from '../DataViewSidebar.vue'
import moduleDataList from "@/store/data-list/moduleDataList.js"

export default {
  components: {
    DataViewSidebar
  },
  data() {
    return {
      // products: [],
      itemsPerPage: 8,
      isMounted: false,
      productStatuses: [
                    {name:'Active', color: 'primary'},
                    {name:'Featured', color: 'success'},
                    {name:'Out of Stock', color: 'danger'},
                    {name:'Hidden', color: 'dark'},
                  ],

      // Data Sidebar
      addNewDataSidebar: false,
      sidebarData: {},
    }
  },
  computed: {
    currentPage() {
      if(this.isMounted) {
        return this.$refs.table.currentx
      }
      return 0
    },
    products() {
      return this.$store.state.dataList.products
    },
    queriedItems() {
      return this.$refs.table ? this.$refs.table.queriedResults.length : this.products.length
    }
  },
  methods: {
    thumbView(){
      this.$router.push({path: '/products/list'})
    },
    addNewData() {
      this.$router.push({path: '/products/createProduct'})
    },
    editData(data) {
      this.$router.push({path: '/products/edit/' + data.id})
    },
    confirmDeleteRecord(id) {
      this.$vs.dialog({
        type: 'confirm',
        color: 'danger',
        title: `Confirm Delete`,
        text: `Are you sure you want to delete this order?`,
        accept: this.deleteRecord(id),
        acceptText: "Delete"
      })
    },
    deleteRecord(id) {
      this.$store.dispatch("dataList/removeItem", id)
        .then(()   => { this.showDeleteSuccess() })
        .catch(err => { console.error(err.response)       })
    },
    showDeleteSuccess() {
      this.$vs.notify({
        color: 'success',
        title: 'Order Removed',
        text: 'Order Removed Successfully'
      })
    }
  },
  created() {
    if(!moduleDataList.isRegistered) {
      this.$store.registerModule('dataList', moduleDataList)
      moduleDataList.isRegistered = true
    }
    this.$store.dispatch("dataList/fetchDataListItems").catch(err => console.log(err.response))
  },
  mounted() {
    this.isMounted = true;
  }
}
</script>

<style lang="scss">
#data-list-list-view {
  margin: 2rem 1rem;
  
  .vs-con-table {

    /*
      Below media-queries is fix for responsiveness of action buttons
      Note: If you change action buttons or layout of this page, Please remove below style
    */
    @media (max-width: 689px) {
      .vs-table--search {
        margin-left: 0;
        max-width: unset;
        width: 100%;

        .vs-table--search-input {
          width: 100%;
        }
      }
    }

    @media (max-width: 461px) {
      .items-per-page-handler {
        display: none;
      }
    }

    @media (max-width: 341px) {
      .data-list-btn-container {
        width: 100%;

        .dd-actions,
        .btn-add-new {
          width: 100%;
          margin-right: 0 !important;
        }
      }
    }

    .product-name {
      max-width: 23rem;
    }

    .vs-table--header {
      display: flex;
      flex-wrap: wrap;
      margin-left: 1.5rem;
      margin-right: 1.5rem;
      > span {
        display: flex;
        flex-grow: 1;
      }

      .vs-table--search{
        padding-top: 0;

        .vs-table--search-input {
          padding: 0.9rem 2.5rem;
          font-size: 1rem;

          &+i {
            left: 1rem;
          }

          &:focus+i {
            left: 1rem;
          }
        }
      }
    }

    .vs-table {
      border-collapse: separate;
      border-spacing: 0 1.3rem;
      padding: 0 1rem;

      tr{
          box-shadow: 0 4px 20px 0 rgba(0,0,0,.05);
          td{
            padding: 20px;
            &:first-child{
              border-top-left-radius: .5rem;
              border-bottom-left-radius: .5rem;
            }
            &:last-child{
              border-top-right-radius: .5rem;
              border-bottom-right-radius: .5rem;
            }
          }
          td.td-check{
            padding: 20px !important;
          }
      }
    }

    .vs-table--thead{
      th {
        padding-top: 0;
        padding-bottom: 0;

        .vs-table-text{
          text-transform: uppercase;
          font-weight: 600;
        }
      }
      th.td-check{
        padding: 0 15px !important;
      }
      tr{
        background: none;
        box-shadow: none;
      }
    }

    .vs-table--pagination {
      justify-content: center;
    }
  }
}
</style>
