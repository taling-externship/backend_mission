<template>
  <nav class="relative flex flex-wrap items-center justify-between px-2 py-3 bg-pink-500 mb-3">
    <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
      <div class="w-full relative flex justify-between
        lg:w-auto  px-4 lg:static lg:block lg:justify-start">
        <a href="/"
          class="text-sm font-bold leading-relaxed inline-block
            mr-4 py-2 whitespace-nowrap uppercase text-white">
          <h1>Hello front end</h1>
        </a>
        <button class="text-white cursor-pointer text-xl leading-none
          px-3 py-1 border border-solid border-transparent rounded bg-transparent block
          lg:hidden outline-none focus:outline-none" type="button" v-on:click="toggleNavbar()">
          <i class="burger-menu" v-text="!showMenu ? '➕' : '➖'"></i>
        </button>
      </div>
      <div v-bind:class="{'hidden': !showMenu, 'flex': showMenu}"
        class="lg:flex lg:flex-grow items-center">
        <ul class="flex flex-col lg:flex-row list-none ml-auto" v-show="!this.$store.state.token">
          <li class="nav-item">
            <router-link to="/register" class="px-3 py-2 flex items-center
              text-xs uppercase font-bold leading-snug text-white hover:opacity-75">
              <span class="ml-2">Register</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/login" class="px-3 py-2 flex items-center
              text-xs uppercase font-bold leading-snug text-white hover:opacity-75">
              <span class="ml-2">Login</span>
            </router-link>
          </li>
        </ul>
        <ul class="flex gap-4 lg:flex-row list-none ml-auto" v-show="this.$store.state.token">
          <li class="nav-item">
            <span>Hello {{this.$store.state.name}}</span>
          </li>
          <li class="nav-item border rounded px-2 text-white">
            <router-link to="/create">Create</router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script lang="ts">
import Vue from 'vue';

declare interface Data {
  showMenu: boolean,
}

export default Vue.extend({
  name: 'pink-navbar',
  data(): Data {
    return {
      showMenu: false,
    };
  },
  methods: {
    toggleNavbar(): void {
      this.showMenu = !this.showMenu;
    },
  },
  created() {
    console.log(this.$cookies.get('id'));
    if (this.$cookies.get('id')) {
      const id = this.$cookies.get('id');
      const name = this.$cookies.get('name');
      const token = this.$cookies.get('access_token');
      this.$store.dispatch('FETCH_ACCESS_TOKEN', {
        id,
        name,
        token,
      });
    }
  },
});
</script>
