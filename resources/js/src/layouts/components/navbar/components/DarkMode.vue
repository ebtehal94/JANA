<template>
  <div class="mt-1 mr-2">
    <vs-switch v-model="themeMode" color="primary" icon-pack="feather" vs-icon-on="icon-moon" vs-icon-off="icon-sun">
      <span slot="on">Dark</span>
      <span slot="off">Light</span>
    </vs-switch>
  </div>
</template>

<script>
export default {
  computed: {
    themeMode: {
      get ()    {

          return this.$store.state.theme == 'dark' ? true : false

       },
      set (val) {
        if (val){
          this.$store.dispatch('updateTheme', 'dark')
        }else{
          this.$store.dispatch('updateTheme', 'light')
        }
       }
    },
  },
}
</script>
