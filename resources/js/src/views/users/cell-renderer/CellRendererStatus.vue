<template>
    <vs-chip transparent class="ag-grid-cell-chip" :color="statusOptions[params.value].color">
        <span>{{ $i18n.locale == 'en' ? statusOptions[params.value].label_en : statusOptions[params.value].label_ar }}</span>
    </vs-chip>
</template>

<script>
    export default {
        name: 'CellRendererStatus',
        data(){
          return {
            statusOptions: [
              { label_en: 'New', label_ar: 'جديد',color:'#24c1a0', value: 0 },
              { label_en: 'In Progress',label_ar: 'قيد الانتظار', color:'warning', value: 1 },
              { label_en: 'Ready For Pickup', label_ar: 'جاهز للتوصيل',color:'danger', value: 2 },
              { label_en: 'On The Way', label_ar: 'قيد التوصيل',color:'warning', value: 3 },
              { label_en: 'Delivered', label_ar: 'تم التوصيل',color:'success', value: 4 },
              { label_en: 'Cancelled', label_ar: 'ملغي',color:'dark', value: 5 },
            ],
          }
        },
        computed: {
          chipColor() {
            return (value) => {
              if(value === 1) return "success"
              else return "danger"
            }
          },
          userStatus() {
            return (value) => {
              if(value === 1) return "Active"
              else return "Deactivated"
            }
          }
        }
    }
</script>

<style lang="scss" scpoped>
.ag-grid-cell-chip {
  &.vs-chip-success {
    background: rgba(var(--vs-success),.15);
    color: rgba(var(--vs-success),1) !important;
    font-weight: 500;
  }
  &.vs-chip-warning {
    background: rgba(var(--vs-warning),.15);
    color: rgba(var(--vs-warning),1) !important;
    font-weight: 500;
  }
  &.vs-chip-danger {
    background: rgba(var(--vs-danger),.15);
    color: rgba(var(--vs-danger),1) !important;
    font-weight: 500;
  }
}
</style>
