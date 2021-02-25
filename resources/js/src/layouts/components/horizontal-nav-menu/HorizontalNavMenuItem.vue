<!-- =========================================================================================
    File Name: VerticalNavMenuItem.vue
    Description: Vertical NavMenu item component. Extends vuesax framework's 'vs-sidebar-item' component
    Component Name: VerticalNavMenuItem
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div
    class="h-nav-menu-item">

      <router-link
        v-if="to"
        exact
        :class="[{'router-link-active active-menu-link page-link': activeLink}, 'nav-link flex items-center', { 'no-display': isDisplayed }]"
        :to="to"
        :target="target" >
          <feather-icon v-if="featherIcon" :class="iconClasses" :icon="icon" />
          <slot />
          <!-- <strong></strong> -->
      </router-link>

      <!-- categories-->
      <a v-if="cat"
      @click="$router.push({name: 'category', params: {category: cat }}).catch(() => {})"
      :class="[{'router-link-active active-menu-link': activeLink}, 'nav-link flex items-center']">
        <!--<img :src="'/images/'+ categoriesIconsFolder +'/'+icon+'.svg'" class="h-5 ">-->
        <slot />
      </a>

      <a v-if="!to && !cat" :target="target" :href="href" class="nav-link flex items-center">
        <!-- <vs-icon v-if="!featherIcon" :icon-pack="iconPack" :icon="icon" /> -->
        <!-- <feather-icon v-else :class="iconClasses" :icon="icon" /> -->
        <slot />
      </a>
  </div>
</template>

<script>
export default {
  name: 'v-nav-menu-item',
  props: {
    icon        : { type: String,                 default: ''               },
    iconSmall   : { type: Boolean,                default: false            },
    iconPack    : { type: String,                 default: 'material-icons' },
    href        : { type: [String, null],         default: '#'              },
    to          : { type: [String, Object, null], default: null             },
    cat         : { type: String,                 default: null             },
    slug        : { type: String,                 default: null             },
    index       : { type: [String, Number],       default: null             },
    featherIcon : { type: Boolean,                default: true             },
    target      : { type: String,                 default: '_self'          },
    isDisabled  : { type: Boolean,                default: false            }
  },
  computed: {
    isDisplayed () {
      return this.$route.name == 'home'
    },
    iconClasses () {
      return this.iconSmall ? 'w-3 h-3 mr-3' : 'w-5 h-5 mr-3'
    },
    activeLink () {
      return ( ((this.to == this.$route.path) || (this.$route.meta.parent == this.slug) && this.to) ||
      ( this.cat && this.$route.path.includes(this.cat)) ) ? true : false
    },
    categoriesIconsFolder () {
      return (this.activeLink || this.$store.state.theme === 'dark') ? 'icons-w' : 'icons-b'
    }
  },
  // created(){
  //   console.log(this.$route.path)
  //   console.log(this.to)
  // }
}

</script>

<style lang="scss">
@import "@sass/vuexy/components/horizontalNavMenuItem.scss";
</style>
