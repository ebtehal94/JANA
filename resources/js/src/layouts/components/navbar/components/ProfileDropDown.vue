<template>
  <div class="the-navbar__user-meta flex items-center dropdown-button-container" >
    <span v-if="activeUserInfo.id == 0" @click="$router.push('/login')" class="cursor-pointer text-black flex items-center cairo p-2">
        <img class="h-5 w-5 mr-2"  :src="require(`@assets/images/navbar/user.svg`)" alt="login" />
        {{ $t('loginLabel') }}
    </span>
    <!-- <router-link v-if="activeUserInfo.id == 0"  to="/login" class="p-2 cursor-pointer text-right leading-tight">
      <span style="color: #000; font-family: 'Cairo', sans-serif;">
        <img class="h-5 w-5 mr-2"  :src="require(`@assets/images/navbar/user.svg`)" alt="qt" />
        {{ $t('loginLabel') }}
      </span>
    </router-link> -->
    <vs-dropdown v-if="activeUserInfo.id > 0" vs-custom-content vs-trigger-click class="p-2 cursor-pointer">
      <div class="text-right leading-tight">
          <vs-avatar  class="flex-shrink-0 mr-2" size="15rem" />
      </div>

      <vs-dropdown-menu class="vx-navbar-dropdown">
        <ul style="min-width: 9rem">

          <li
          v-if="$acl.not.check('admin')"
          class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white"
          @click="$router.push('/user-profile').catch(() => {})">
            <feather-icon icon="UserIcon" svgClasses="w-4 h-4" />
            <span class="ml-2">{{$t('MyAccount')}}</span>
          </li>

          <li
          v-if="$acl.not.check('admin')"
          class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white"
          @click="$router.push('/user-orders').catch(() => {})">
            <feather-icon icon="ShoppingBagIcon" svgClasses="w-4 h-4" />
            <span class="ml-2">{{$t('MyOrders')}}</span>
          </li>

          <li
            v-if="$acl.not.check('admin')"
            class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white"
            @click="$router.push('/wish-list').catch(() => {})">
            <feather-icon icon="HeartIcon" svgClasses="w-4 h-4" />
            <span class="ml-2">{{$t('Wishlist')}}</span>
          </li>

          <li
            v-if="$acl.not.check('admin')"
            class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white"
            @click="$router.push('/inqueries').catch(() => {})">
            <feather-icon icon="MailIcon" svgClasses="w-4 h-4" />
            <span class="ml-2">{{$t('Messeges')}}</span>
          </li>

          <vs-divider v-if="$acl.not.check('customer')" class="m-1" />

          <li class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white" @click="logout">
            <feather-icon icon="LogOutIcon" svgClasses="w-4 h-4" />
            <span class="ml-2">{{$t('Logout')}}</span>
          </li>
        </ul>
      </vs-dropdown-menu>
    </vs-dropdown>
  </div>
</template>

<script>
export default {
  data () {
    return {

    }
  },
  computed: {
    activeUserInfo () {
      return this.$store.state.AppActiveUser
    }
  },
  methods: {
    logout () {
      // If JWT login
      // if(localStorage.getItem("accessToken")) {
        localStorage.removeItem("accessToken")
        // localStorage.removeItem("userInfo")
        // this.$router.push('/pages/login').catch(() => {})
      // }

      // Change role on logout. Same value as initialRole of acj.js
      // this.$acl.change('admin')
      localStorage.removeItem('userInfo')
      this.$store.dispatch('updateMainLayout', 'horizontal')

      // This is just for demo Purpose. If user clicks on logout -> redirect
      this.$router.push('/login').catch(() => {})
    }
  }
}
</script>
