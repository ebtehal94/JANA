<template>
    <div id="promocodes-container">
         <!-- ADD NEW -->
        <div class="flex flex-wrap-reverse items-center mb-5">
            <vs-button @click="addNewData()" color="primary" icon-pack="feather" icon="icon-plus">
                {{ $t('AddNew') }}
            </vs-button>
        </div>

        <!-- Brands Table -->
        <!-- AgGrid Table -->
        <div class="p-2">
            <ag-grid-vue
                ref="agGridTable"
                @gridReady="onGridReady"
                :components="components"
                :gridOptions="gridOptions"
                class="ag-theme-material w-100 my-4 ag-grid-table"
                :columnDefs="columnDefs"
                :defaultColDef="defaultColDef"
                :rowData="PromocodesData"
                rowSelection="multiple"
                colResizeDefault="shift"
                :animateRows="true"
                :floatingFilter="true"
                :pagination="true"
                :paginationPageSize="paginationPageSize"
                :suppressPaginationPanel="true"
                :enableRtl="this.$vs.rtl">
            </ag-grid-vue>

            <vs-pagination :total="totalPages" :max="7" v-model="currentPage" />
        </div>
    </div>
</template>

<script>
import { AgGridVue } from "ag-grid-vue"
import '@sass/vuexy/extraComponents/agGridStyleOverride.scss'

import modulePromocodes from "@/store/promo-codes/modulePromocodes.js"
import CellRendererActions from "./cell-renderer/CellRendererActions.vue"
import CellRendererStatus from "./cell-renderer/CellRendererStatus.vue"
import CellRendererType from "./cell-renderer/CellRendererType.vue"

export default {
    components: {
        AgGridVue,
        CellRendererActions,
        CellRendererStatus,
        CellRendererType,
    },
    data() {
        return {
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
                    headerName: this.$i18n.locale == 'en' ? 'Code' : 'الكود',
                    field: 'code',
                    filter: true,
                },
                {
                    headerName: this.$i18n.locale == 'en' ? 'Type' : 'النوع',
                    field: 'type',
                    filter: true,
                    width: 100,
                    cellRendererFramework: 'CellRendererType',
                },
                {
                    headerName: this.$i18n.locale == 'en' ? 'Amount' : 'القيمة',
                    field: 'amount',
                    filter: true,
                    width: 100
                },
                {
                    headerName: this.$i18n.locale == 'en' ? 'Expire Date' : 'تاريخ الإنتهاء',
                    field: 'expires_at',
                    filter: true,
                },
                {
                    headerName: this.$i18n.locale == 'en' ? 'Status' : 'الحالة',
                    field: 'status',
                    filter: true,
                    width: 100,
                    cellRendererFramework: 'CellRendererStatus',
                },
                {
                    headerName: this.$i18n.locale == 'en' ? 'Actions' : 'إدارة',
                    valueGetter: function(params) {
                        return params.data
                    },
                    cellRendererFramework: 'CellRendererActions',
                    width: 100
                },
            ],
            components: {
                CellRendererActions,
                CellRendererStatus,
                CellRendererType,
            }
        }
    }, 
    computed: {
        PromocodesData() {
            return this.$store.state.PromocodesData.promocodes
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
           this.$router.push({path: '/promocodes/create'})
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
        if(!modulePromocodes.isRegistered) {
            this.$store.registerModule('PromocodesData', modulePromocodes)
            modulePromocodes.isRegistered = true

            this.$store.dispatch("PromocodesData/fetchPromocodes")
        }
    },
}
</script>

<style lang="scss" scoped>
    #promocodes-container {
        margin: 2rem;
    }
</style>