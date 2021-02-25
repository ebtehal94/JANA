<template>
  <div class="search-bar flex justify-start items-center">
    <input type="text" :placeholder="$t('SearchBar')" v-model="query" @keyup.enter="searchProducts">
    <vs-icon class="cursor-pointer" icon="search" size="small" @click="searchProducts"></vs-icon>
  </div>
</template>

<script>
export default {
  data() {
    return {
      query: '',
    }
  },
  methods: {
    searchProducts() {
      this.$router.push({name: 'search', params: {search: this.query }}).catch(() => {})
    }
  },
}
</script>

<style lang="scss">
@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600&display=swap');

.search-bar {
  input {
    color: 000;
    border: none;
    padding: 0.5rem;
    font-family: 'Cairo', sans-serif;
    width: 15rem;
  }
}
</style>