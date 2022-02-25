<template>
  <section class="login my-4">
    <form class="" @submit.prevent="loginSubmit">
      <div class="mb-3 pt-0">
        <input type="email" placeholder="email"
          class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative
            bg-white bg-white rounded text-sm border-0 shadow outline-none
            focus:outline-none focus:ring w-full"
            name="email" v-model="email" />
      </div>
      <div class="mb-3 pt-0">
        <input type="password" placeholder="password"
          class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative
            bg-white bg-white rounded text-sm border-0 shadow outline-none
            focus:outline-none focus:ring w-full"
            name="password" v-model="password" />
      </div>
      <input type="submit" value="submit"
        class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase
          text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none
          focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
    </form>
  </section>
</template>

<script lang="ts">
import { postLogin } from '@/apis';
import Vue from 'vue';

export default Vue.extend({
  data() {
    return {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
    };
  },
  methods: {
    loginSubmit() {
      postLogin({
        email: this.email,
        password: this.password,
      }).then((res) => {
        this.$cookies.set('id', res.data.id);
        this.$cookies.set('name', res.data.name);
        this.$cookies.set('access_token', res.data.access_token);

        this.$store.dispatch('FETCH_ACCESS_TOKEN', {
          id: res.data.id,
          name: res.data.name,
          token: res.data.access_token,
        });

        this.$router.push('/');
      }).catch((err) => {
        console.log(err.response.data.message);
        console.log(err.response.data.errors);
      });
    },
  },
});
</script>
