<template>
    <div id="collections-container">
        <!-- ADD NEW -->
        <div class="flex flex-wrap-reverse items-center mb-5">
            <vs-button @click="addNewData()" color="primary" icon-pack="feather" icon="icon-plus">{{ $t('AddNew') }}</vs-button>
        </div>

        <collections-popup :popupActive="popupActive" @closePopup="toggleDataPopup" :data="popupData" />

        <!-- Brands Table -->
        <!-- AgGrid Table -->
        <div class="p-2">
            <ag-grid-vue
                ref="agGridTable"
                :components="components"
                :gridOptions="gridOptions"
                class="ag-theme-material w-100 my-4 ag-grid-table"
                :columnDefs="columnDefs"
                :defaultColDef="defaultColDef"
                :rowData="collectionsData"
                rowSelection="multiple"
                colResizeDefault="shift"
                :animateRows="true"
                :floatingFilter="true"
                :pagination="true"
                :paginationPageSize="paginationPageSize"
                :suppressPaginationPanel="true"
                @gridReady="onGridReady"
                :enableRtl="this.$vs.rtl">
            </ag-grid-vue>

            <vs-pagination :total="totalPages" :max="7" v-model="currentPage" />
        </div>
    </div>
</template>

<script>
import { AgGridVue } from "ag-grid-vue"
import '@sass/vuexy/extraComponents/agGridStyleOverride.scss'

import CollectionsPopup from './CollectionsPopup.vue'
import moduleCollections from "@/store/collections-list/moduleCollections.js"
import CellRendererActions from "./cell-renderer/CellRendererActions.vue"


export default {
    components: {
        AgGridVue,
        CollectionsPopup,
        CellRendererActions,
    },
    data() {
        return {
            popupActive: false,
            popupData: {},
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
                    headerName: this.$i18n.locale == 'en' ? 'Title (en)' : 'Title',
                    field: 'title_en',
                    filter: true,
                },
                {
                    headerName: this.$i18n.locale == 'en' ? 'Title (ar)' : 'العنوان',
                    field: 'title_ar',
                    filter: true,
                },
                {
                    headerName: this.$i18n.locale == 'en' ? 'Sort' : 'ترتيب',
                    field: 'sort',
                    filter: true,
                },
                {
                    headerName: this.$i18n.locale == 'en' ? 'Actions' : 'إدارة',
                    valueGetter: function(params) {
                        return params.data
                    },
                    cellRendererFramework: 'CellRendererActions',
                },
            ],
            components: {
                CellRendererActions,
            }
        }
    },
    computed: {
        collectionsData() {
            return this.$store.state.collectionsData.collections
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
        addNewData() {
            this.popupData = {}
            this.toggleDataPopup(true)
        },
        toggleDataPopup(val=false) {
            this.popupActive = val
        },
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
            // this.roleFilter = this.statusFilter = { label: 'All', value: 'all' }
            this.statusFilter = { label: 'All', value: 'all' }

            this.$refs.filterCard.removeRefreshAnimation()
        },
        updateSearchQuery(val) {
            this.gridApi.setQuickFilter(val)
        },
        onGridReady () {
            this.gridApi.sizeColumnsToFit();
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
        if(!moduleCollections.isRegistered) {
            this.$store.registerModule('collectionsData', moduleCollections)
            moduleCollections.isRegistered = true

            this.$store.dispatch("collectionsData/fetchCollections")
        }
    },
}
</script>

<style lang="scss" scoped>
#collections-container {
    margin: 2rem;
}
</style>