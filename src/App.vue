<template>
  <div id="app">
    <app-header title="Ramblings of an Engineer" :social="social"></app-header>
    <router-view></router-view>
    <!-- <home-page></home-page> -->
  </div>
</template>

<script>
import AppHeader from './components/AppHeader';
import HomePage from './components/HomePage';

const socialData = require('./../data/social.json');

export default {
  name: 'app',
  components: {
    AppHeader,
    HomePage,
  },
  data() {
    return {
      social: socialData,
    };
  },
};
</script>

<style lang="scss">
@import "./scss/_theme";
@import "~bootstrap/scss/bootstrap";

</style>
