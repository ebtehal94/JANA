<template>
    <div :style="{'direction': $vs.rtl ? 'rtl' : 'ltr'}">
      <feather-icon icon="Edit3Icon" svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer" @click="editRecord" />
      <feather-icon icon="Trash2Icon" svgClasses="h-5 w-5 hover:text-danger cursor-pointer" @click="confirmDeleteRecord" />
    </div>
</template>

<script>
import moduleUserManagement from '@/store/user-management/moduleUserManagement.js'

export default {
  name: 'CellRendererActions',
  methods: {
    editRecord() {
      this.$router.push("/users/edit/" + this.params.value).catch(() => {})

      /*
        Below line will be for actual product
        Currently it's commented due to demo purpose - Above url is for demo purpose

        this.$router.push("/apps/user/user-edit/" + this.params.data.id).catch(() => {})
      */
    },
    confirmDeleteRecord() {
      this.$vs.dialog({
        type: 'confirm',
        color: 'danger',
        title: `Confirm Delete`,
        text: `Are you sure you want to delete this user ?"`,
        accept: this.deleteRecord,
        acceptText: "Delete"
      })
    },
    deleteRecord() {
      /* UnComment below lines for enabling true flow if deleting user */
      this.$store.dispatch("userManagement/removeUser", this.params.value)
        .then(()   => { this.showDeleteSuccess() })
        .catch(err => { console.error(err.response)       })
    },
    showDeleteSuccess() {
      this.$vs.notify({
        color: 'success',
        title: 'User Deleted',
        text: 'The selected user was successfully deleted'
      })
    }
  },
  created() {
    if(!moduleUserManagement.isRegistered) {
      this.$store.registerModule('userManagement', moduleUserManagement)
      moduleUserManagement.isRegistered = true
    }
  }
}
</script>
