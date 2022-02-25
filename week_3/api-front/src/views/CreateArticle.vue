<template>
   <section class="create my-4">
    <form class="" @submit.prevent="articleSubmit">
      <div class="mb-3 pt-0">
        <input type="text" placeholder="title"
          class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative
            bg-white bg-white rounded text-sm border-0 shadow outline-none
            focus:outline-none focus:ring w-full"
            name="title" v-model="title" />
      </div>
      <div class="mb-3 pt-0">
        <textarea placeholder="make content"
          class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative
            bg-white bg-white rounded text-sm border-0 shadow outline-none
            focus:outline-none focus:ring w-full"
            rows="10"
            name="body" v-model="body" />
      </div>
      <input type="submit" value="submit"
        class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase
          text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none
          focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
    </form>
  </section>
</template>

<script lang="ts">
import { postArticle } from '@/apis';
import Vue from 'vue';

export default Vue.extend({
  data() {
    return {
      title: '',
      body: '',
    };
  },
  methods: {
    articleSubmit() {
      postArticle({
        title: this.title,
        body: this.body,
      }, {
        Authorization: `Bearer ${this.$store.state.token}`,
      }).then(() => {
        this.$router.push('/');
      });
    },
  },
});
</script>

<style>

</style>
