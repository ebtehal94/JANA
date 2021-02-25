<template>
    <div :style="{'direction': $vs.rtl ? 'rtl' : 'ltr'}">
      <feather-icon icon="EyeIcon" svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer" @click="showOrderDetails" />
    </div>
</template>

<script>
    export default {
      name: 'CellRendererActions',
      methods: {
        showOrderDetails() {
          this.$router.push({name: 'ecommerce-user-order', params: {order_id: this.params.data.id }})
          .catch(() => {})
        }
      }
    }
</script>
