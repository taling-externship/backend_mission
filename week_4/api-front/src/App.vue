<template>
  <main id="app" class="container mx-auto">
    <header>
      <Gnb />
    </header>
    <router-view/>
  </main>
</template>

<script>
import Gnb from '@/components/Gnb.vue';

export default {
  name: 'Main',
  components: {
    Gnb,
  },
};
</script>

<style lang="scss">
h1 {
  font-family: 'Gugi', cursive;
}

* {
  font-family: 'Sunflower', sans-serif;
}
</style>
