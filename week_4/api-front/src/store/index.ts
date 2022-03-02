import { fetchArticles } from '@/apis';
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    id: 0,
    name: '',
    token: '',
    articles: [{}],

    page: 1,
  },
  getters: {

  },
  mutations: {
  },
  actions: {
    FETCH_ACCESS_TOKEN(ctx, { id, name, token }) {
      this.state.id = id;
      this.state.name = name;
      this.state.token = token;
    },
    FETCH_ARTICLES(ctx, { page }) {
      fetchArticles(page)
        .then((res) => {
          this.state.articles = res.data.data;
        });
    },
  },
  modules: {
  },
});
