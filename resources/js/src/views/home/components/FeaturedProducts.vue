<template>
  <div id="featured-products">

    <div class="section new-groups" :style="sectionBackgroundImage('coffee.jpg')">
       <div class="content">
        <h1>{{ $t('NewGroups') }}</h1>
        <vs-button class="action-btn w-full my-4 mr-1" color="primary" @click="$router.push('/all').catch(err => {})">{{ $t('ShopNow') }}</vs-button>
      </div>
    </div>

    <div class="section most-ordered" :style="sectionBackgroundImage('coffee.jpg')">
      <div class="content">
        <h1>{{ $t('MostOrdered') }}</h1>
        <vs-button class="action-btn w-full my-4 mr-1" color="primary" @click="$router.push('/all').catch(err => {})">{{ $t('ShopNow') }}</vs-button>
      </div>
    </div>

    <div class="section latest" :style="sectionBackgroundImage('coffee.jpg')">
      <div class="content">
        <h1>{{ $t('LatestDeals') }}</h1>
        <vs-button class="action-btn w-full my-4 mr-1" color="primary" @click="$router.push('/all').catch(err => {})">{{ $t('ShopNow') }}</vs-button>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  data() {
    return {

    }
  },
  computed: {
    sectionBackgroundImage() {
      return (imageName) => { 
        return {
          'background': 'linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(' + require('@assets/images/products/' + imageName) + ')',
          'background-size': 'cover',
          'background-position': 'center center',
          'background-repeat': 'no-repeat',
        } 
      }
    }
  },
}
</script>

<style lang="scss" scoped>
#featured-products {
  margin: 2rem 1.5rem;
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-template-rows: 1fr 1fr;
  grid-gap: .25rem;
  height: 30rem;

  .section {
    position: relative;
  
    .content {
      position: absolute;
      bottom: 0;
      left: 0;
      padding: 1rem;

      h1 {
        color: #fff;
      }

      .action-btn {
        border-radius: 0;
      }
    }
  }

  .new-groups {
    grid-row: 1 / 3;
  }
  .most-ordered {
    grid-row: 1 / 2;
  }
  .latest {
    grid-row: 2 / 3;
  }
}

@media only screen and (max-width: 600px) {
  #featured-products {
    margin: 1rem .5rem;
  }
}
</style>