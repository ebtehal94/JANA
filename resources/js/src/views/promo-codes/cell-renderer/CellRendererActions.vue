<template>
    <div :style="{'direction': $vs.rtl ? 'rtl' : 'ltr'}">
      <feather-icon icon="Edit3Icon" svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer" @click.stop="editRecord" />
      <feather-icon icon="Trash2Icon" svgClasses="h-5 w-5 hover:text-danger cursor-pointer" @click="confirmDeleteRecord" />
    </div>
</template>

<script>
import axios from "@/axios.js"

export default {
    name: 'CellRendererActions',
    data() {
      return {
        
      }
    },
    methods: {
      editRecord() {
        this.$router.push({path: '/promocodes/edit/' + this.params.value.id})
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
        return new Promise((resolve, reject) => {
          axios.delete("/api/promocodes/delete/" + this.params.value.id)
            .then((response) => {
              resolve(response)
              showDeleteSuccess()
              window.location.reload()
            })
            .catch((error) => { console.log(error.response) })
        })
      },
      showDeleteSuccess() {
        this.$vs.notify({
          color: 'success',
          title: 'Promo Code Removed',
          text: 'Promo Code Removed Successfully'
        })
      }
    }
}
</script>
