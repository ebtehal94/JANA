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
    class="vs-sidebar--item"
    :class="[
      {'vs-sidebar-item-active'            : activeLink},
      {'disabled-item pointer-events-none' : isDisabled}
    ]" >

      <router-link
        tabindex="-1"
        v-if="to"
        exact
        :class="[{'router-link-active': activeLink}]"
        :to="to"
        :target="target" >
          <!--<vs-icon v-if="!featherIcon" :icon-pack="iconPack" :icon="icon" />
          <feather-icon v-else :class="{'w-3 h-3': iconSmall}" :icon="icon" />-->
          <slot />
      </router-link>

      <a v-if="cat"
      @click="$router.push({name: 'category', params: {category: cat }}).catch(() => {})"
      :class="[{'router-link-active': activeLink}]">
        <!--<img :src="'/images/'+ categoriesIconsFolder +'/'+icon+'.svg'" class="h-5 ml-0 mr-2">-->
        <slot />
      </a>

      <a v-if="!to && !cat" :target="target" :href="href" tabindex="-1">
        <!--<vs-icon v-if="!featherIcon" :icon-pack="iconPack" :icon="icon" />
        <feather-icon v-else :class="{'w-3 h-3': iconSmall}" :icon="icon" />-->
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
    activeLink () {
      return ( ((this.to == this.$route.path) || (this.$route.meta.parent == this.slug) && this.to) ||
      ( this.cat && this.$route.path.includes(this.cat)) ) ? true : false
    },
    categoriesIconsFolder () {
      return (this.activeLink || this.$store.state.theme === 'dark') ? 'icons-w' : 'icons-b'
    }
  }
}

</script>

<style lang="scss">
  .vs-sidebar-item-active {
    background: #bd9c72;
  }

  .router-link-exact-active.router-link-active.router-link-active {
    box-shadow: none;
    border: none;
  }
</style>