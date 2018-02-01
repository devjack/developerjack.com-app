// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import fontawesome from '@fortawesome/fontawesome';
import light from '@fortawesome/fontawesome-pro-light';

import Vue from 'vue';
import App from './App';
import router from './router';

fontawesome.library.add(light);

Vue.config.productionTip = false;

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App },
});
