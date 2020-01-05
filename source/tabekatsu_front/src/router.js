import Vue from 'vue';
import Router from 'vue-router';
import store from './store';

import Home from './views/Home';
import Login from './views/Login';
import Register from './views/Register';

Vue.use(Router);

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      component: Home,
      name: 'home',
      beforeEnter: function(to, from, next) {
        if (store.getters.idToken) {
          next();
        } else {
          next('login');
        }
      },
    },
    {
      path: '/login',
      component: Login,
      name: 'login',
      beforeEnter: function(to, from, next) {
        if (store.getters.idToken) {
          next('/');
        } else {
          next();
        }
      },
    },
    {
      path: '/register',
      component: Register,
      name: 'register',
      beforeEnter: function(to, from, next) {
        if (store.getters.idToken) {
          next('/');
        } else {
          next();
        }
      },
    },
  ]
});
