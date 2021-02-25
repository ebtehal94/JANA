<template>
    <vs-chip transparent class="ag-grid-cell-chip" :color="statusOptions[params.value].color">
        <span>{{ $i18n.locale == 'en' ? statusOptions[params.value].label.en : statusOptions[params.value].label.ar }}</span>
    </vs-chip>
</template>

<script>
    export default {
        name: 'CellRendererStatus',
        data(){
          return {
            statusOptions: [
              { label: { en: 'Expired', ar: 'منتهي الصلاحية' }, color:'danger', value: 0 },
              { label: { en: 'Active', ar: 'فعال' }, color:'#24c1a0', value: 1 },
            ],
          }
        },
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
