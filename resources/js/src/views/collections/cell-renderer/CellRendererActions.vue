<template>
    <div :style="{'direction': $vs.rtl ? 'rtl' : 'ltr'}">
      <collections-popup :popupActive="popupActive" @closePopup="toggleDataPopup" :data="popupData" />
      <feather-icon icon="Edit3Icon" svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer" @click="editRecord" />
      <feather-icon icon="Trash2Icon" svgClasses="h-5 w-5 hover:text-danger cursor-pointer" @click="confirmDeleteRecord" />
    </div>
</template>

<script>
import CollectionsPopup from '../CollectionsPopup.vue'
import moduleCollections from "@/store/collections-list/moduleCollections.js"

export default {
    name: 'CellRendererActions',
    components: {
      CollectionsPopup,
    },
    data() {
      return {
        popupActive: false,
        popupData: {},
      }
    },
    methods: {
      editRecord() {
        this.popupData = this.params.value
        this.toggleDataPopup(true)
      },
      deleteRecord() {

      },
      toggleDataPopup(val=false) {
        this.popupActive = val
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
      this.$store.dispatch("collectionsData/removeItem", this.params.value.id)
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
      if(!moduleCollections.isRegistered) {
        this.$store.registerModule('collectionsData', moduleCollections)
        moduleCollections.isRegistered = true
      }
    },
}
</script>
