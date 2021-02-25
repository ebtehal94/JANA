<!-- =========================================================================================
  File Name: UserList.vue
  Description: User List page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>

  <div id="page-user-list">

    <vx-card ref="filterCard" :title="$i18n.locale == 'en' ? 'Filters' : 'فلتر'" class="user-list-filters mb-8" actionButtons @refresh="resetColFilters" @remove="resetColFilters">
      <div class="vx-row">
        <div class="vx-col md:w-1/4 sm:w-1/2 w-full">
          <label class="text-sm opacity-75">{{ $i18n.locale == 'en' ? 'Role': 'الصلاحية' }}</label>
          <v-select :options="roleOptions" :clearable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="roleFilter" class="mb-4 md:mb-0" />
        </div>
        <div class="vx-col md:w-1/4 sm:w-1/2 w-full">
          <label class="text-sm opacity-75">{{ $i18n.locale == 'en' ? 'Status' : 'الحالة' }}</label>
          <v-select :options="statusOptions" :clearable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="statusFilter" class="mb-4 md:mb-0" />
        </div>
      </div>
    </vx-card>

    <div class="vx-card p-6">

      <div class="flex flex-wrap items-center">

        <!-- ITEMS PER PAGE -->
        <div class="flex-grow">
          <vs-dropdown vs-trigger-click class="cursor-pointer">
            <div class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
              <span class="mr-2">{{ currentPage * paginationPageSize - (paginationPageSize - 1) }} - {{ usersData.length - currentPage * paginationPageSize > 0 ? currentPage * paginationPageSize : usersData.length }} {{ $i18n.locale == 'en' ? 'of' : 'من' }} {{ usersData.length }}</span>
              <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
            </div>

            <vs-dropdown-menu>

              <vs-dropdown-item @click="gridApi.paginationSetPageSize(10)">
                <span>10</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(20)">
                <span>20</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(25)">
                <span>25</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(30)">
                <span>30</span>
              </vs-dropdown-item>
            </vs-dropdown-menu>
          </vs-dropdown>
          <!-- ADD NEW -->
          <vs-button color="primary" type="gradient" to="/users/create" class="p-3 mt-3 mb-4 mr-4 rounded-lg cursor-pointer flex items-center justify-between text-lg font-medium">
              <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
              <span class="ml-2 text-base">{{ $t('AddNew') }}</span>
          </vs-button>

        </div>

        <!-- TABLE ACTION COL-2: SEARCH & EXPORT AS CSV -->
          <vs-input class="sm:mr-4 mr-0 sm:w-auto w-full sm:order-normal order-3 sm:mt-0 mt-4" v-model="searchQuery" @input="updateSearchQuery" placeholder="Search..." />
          <vs-button class="mb-4 md:mb-0" @click="gridApi.exportDataAsCsv()">{{ $t('Export') }}</vs-button>
      </div>


      <!-- AgGrid Table -->
      <ag-grid-vue
        ref="agGridTable"
        :components="components"
        :gridOptions="gridOptions"
        class="ag-theme-material w-100 my-4 ag-grid-table"
        :columnDefs="columnDefs"
        :defaultColDef="defaultColDef"
        :rowData="usersData"
        rowSelection="multiple"
        colResizeDefault="shift"
        :animateRows="true"
        :floatingFilter="true"
        :pagination="true"
        :paginationPageSize="paginationPageSize"
        :suppressPaginationPanel="true"
        :enableRtl="$vs.rtl">
      </ag-grid-vue>

      <vs-pagination
        :total="totalPages"
        :max="7"
        v-model="currentPage" />

    </div>
  </div>

</template>

<script>
import { AgGridVue } from "ag-grid-vue"
import '@sass/vuexy/extraComponents/agGridStyleOverride.scss'
import vSelect from 'vue-select'

// Store Module
import moduleUserManagement from '@/store/user-management/moduleUserManagement.js'

// Cell Renderer
import CellRendererLink from "./cell-renderer/CellRendererLink.vue"
import CellRendererStatus from "./cell-renderer/CellRendererStatus.vue"
import CellRendererVerified from "./cell-renderer/CellRendererVerified.vue"
import CellRendererActions from "./cell-renderer/CellRendererActions.vue"


export default {
  components: {
    AgGridVue,
    vSelect,

    // Cell Renderer
    CellRendererLink,
    CellRendererStatus,
    CellRendererVerified,
    CellRendererActions,
  },
  data() {
    return {

      // Filter Options
      roleFilter: { label: 'All', value: 'all' },
      roleOptions: [
        { label: this.$i18n.locale == 'en' ? 'All': 'الكل', value: 'all' },
        { label: this.$i18n.locale == 'en' ? 'Admin' : 'اداري', value: 'admin' },
        { label: this.$i18n.locale == 'en' ? 'Operator' : 'مشغل', value: 'operator' },
        { label: this.$i18n.locale == 'en' ? 'Customer' : 'عميل', value: 'customer' },
      ],

      statusFilter: { label: 'All', value: 'all' },
      statusOptions: [
        { label: this.$i18n.locale == 'en' ? 'All' : 'الكل', value: 'all' },
        { label: this.$i18n.locale == 'en' ? 'Active' : 'فعال', value: 1 },
        { label: this.$i18n.locale == 'en' ? 'Deactivated' : 'غير فعال', value: 0 },
      ],


      searchQuery: "",

      // AgGrid
      gridApi: null,
      gridOptions: {},
      defaultColDef: {
        sortable: true,
        resizable: true,
        suppressMenu: true
      },
      columnDefs: [
        {
          headerName: this.$i18n.locale == 'en' ? 'Display Name' : 'الإسم',
          field: 'name',
          filter: true,
          // width: 210,
          cellRendererFramework: 'CellRendererLink'
        },
        {
          headerName: this.$i18n.locale == 'en' ? 'Email' : 'البريد الإلكتروني',
          field: 'email',
          filter: true,
          // width: 225,
        },
        {
          headerName: this.$i18n.locale == 'en' ? 'Role' : 'الصلاحية',
          field: 'rule',
          filter: true,
          // width: 150,
        },
        {
          headerName: this.$i18n.locale == 'en' ? 'Status' : 'الحالة',
          field: 'status',
          filter: true,
          // width: 150,
          cellRendererFramework: 'CellRendererStatus'
        },
        {
          headerName: this.$i18n.locale == 'en' ? 'Actions' : 'إدارة',
          field: 'id',
          // width: 150,
          cellRendererFramework: 'CellRendererActions',
        },
      ],

      // Cell Renderer Components
      components: {
        CellRendererLink,
        CellRendererStatus,
        // CellRendererVerified,
        CellRendererActions,
      }
    }
  },
  watch: {
    roleFilter(obj) {
      this.setColumnFilter("rule", obj.value)
    },
    statusFilter(obj) {
      this.setColumnFilter("status", obj.value)
    }
  },
  computed: {
    usersData() {
      return this.$store.state.userManagement.users
    },
    paginationPageSize() {
      if(this.gridApi) return this.gridApi.paginationGetPageSize()
      else return 10
    },
    totalPages() {
      if(this.gridApi) return this.gridApi.paginationGetTotalPages()
      else return 0
    },
    currentPage: {
      get() {
        if(this.gridApi) return this.gridApi.paginationGetCurrentPage() + 1
        else return 1
      },
      set(val) {
        this.gridApi.paginationGoToPage(val - 1)
      }
    }
  },
  methods: {
    setColumnFilter(column, val) {
      const filter = this.gridApi.getFilterInstance(column)
      let modelObj = null

      if(val !== "all") {
        modelObj = { type: "equals", filter: val }
      }

      filter.setModel(modelObj)
      this.gridApi.onFilterChanged()
    },
    resetColFilters() {
      // Reset Grid Filter
      this.gridApi.setFilterModel(null)
      this.gridApi.onFilterChanged()

      // Reset Filter Options
      this.roleFilter = this.statusFilter = { label: 'All', value: 'all' }

      this.$refs.filterCard.removeRefreshAnimation()
    },
    updateSearchQuery(val) {
      this.gridApi.setQuickFilter(val)
    }
  },
  mounted() {
    this.gridApi = this.gridOptions.api

    /* =================================================================
      NOTE:
      Header is not aligned properly in RTL version of agGrid table.
      However, we given fix to this issue. If you want more robust solution please contact them at gitHub
    ================================================================= */
    if(this.$vs.rtl) {
      const header = this.$refs.agGridTable.$el.querySelector(".ag-header-container")
      header.style.left = "-" + String(Number(header.style.transform.slice(11,-3)) + 9) + "px"
    }
  },
  created() {
    if(!moduleUserManagement.isRegistered) {
      this.$store.registerModule('userManagement', moduleUserManagement)
      moduleUserManagement.isRegistered = true
    }
    this.$store.dispatch("userManagement/fetchUsers").catch(err => { console.error(err) })
  }
}

</script>

<style lang="scss">
#page-user-list {
  margin: 2rem 1rem;

  .user-list-filters {
    .vs__actions {
      position: absolute;
      right: 0;
      top: 50%;
      transform: translateY(-58%);
    }
  }
}
</style>
