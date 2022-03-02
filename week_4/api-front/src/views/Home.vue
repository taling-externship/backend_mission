<template>
  <section class="home">
    <ul class="mt-4">
      <li v-for="atc in this.$store.state.articles" :key="atc.id"
        class="mt-2 flex gap-2">
        <p class="flex gap-4">
          {{ atc.title }}
          <span class="">
            <i>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" stroke="red" fill="none" viewBox="0 0 24 24">
                <!-- eslint-disable-next-line max-len -->
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
              </svg>
            </i>
          </span>
          {{ atc.love ? atc.love.length : 0 }}
        </p>
        <div class="flex gap-2" v-show="atc.user_id === signId">
          <router-link :to="{ name: 'article.edit', params: { id: atc.id } }">update</router-link>
          <form @submit.prevent="deleteSubmit(atc.id)" class="">
            <input type="submit" value="delete" />
          </form>
        </div>
      </li>
    </ul>
  </section>
</template>

<script lang="ts">
import { deleteArticle } from '@/apis';
import Vue from 'vue';
// import HelloWorld from '@/components/HelloWorld.vue'; // @ is an alias to /src

export default Vue.extend({
  name: 'Home',
  data() {
    return {

    };
  },
  computed: {
    signId() {
      return parseInt(this.$store.state.id, 10);
    },
  },
  components: {

  },
  created() {
    this.$store.dispatch('FETCH_ARTICLES', { page: 1 });
  },
  methods: {
    deleteSubmit(id: number) {
      deleteArticle({
        Authorization: `Bearer ${this.$store.state.token}`,
      }, id).then(() => {
        this.$store.dispatch('FETCH_ARTICLES', { page: 1 });
      });
    },
  },
});
</script>
