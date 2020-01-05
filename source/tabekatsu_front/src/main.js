import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store';
import axios from 'axios';

Vue.config.productionTip = false;

axios.defaults.baseURL = "";
// axios.defaults.headers.common["Authorization"] = ""; //全てのメソッド
// axios.defaults.headers.get["Accept"] = "application/json";

axios.interceptors.request;
axios.interceptors.response;

store.dispatch('initial_set');
store.dispatch('autologin');
new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app');
