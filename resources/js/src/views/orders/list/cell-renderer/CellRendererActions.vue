<template>
    <div :style="{'direction': $vs.rtl ? 'rtl' : 'ltr'}">
      <feather-icon icon="Edit3Icon" svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer" @click="editRecord" />
      <feather-icon icon="Trash2Icon" svgClasses="h-5 w-5 hover:text-danger cursor-pointer" @click="confirmDeleteRecord" />
    </div>
</template>

<script>
import moduleOrderManagement from '@/store/order-management/moduleOrderManagement.js'

export default {
  name: 'CellRendererActions',
  methods: {
    editRecord() {
      this.$router.push("/orders/edit/" + this.params.value).catch(() => {})
    },
    confirmDeleteRecord() {
      this.$vs.dialog({
        type: 'confirm',
        color: 'danger',
        title: `Confirm Delete`,
        text: `Are you sure you want to delete this order?`,
        accept: this.deleteRecord,
        acceptText: "Delete"
      })
    },
    deleteRecord() {
      this.$store.dispatch("orderManagement/removeOrder", this.params.data.id)
        .then(()   => { this.showDeleteSuccess() })
        .catch(err => { console.error(err)       })
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
    if(!moduleOrderManagement.isRegistered) {
        this.$store.registerModule('orderManagement', moduleOrderManagement)
        moduleOrderManagement.isRegistered = true
    }
  }
}
</script>
