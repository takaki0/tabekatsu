import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import router from '../router';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    idToken: null,
    areas: [],
    prefectures: [],
  },
  getters: {
    idToken: state => state.idToken,
    areas: state => state.areas,
    prefectures: state => state.prefectures,
  },
  mutations: {
    updateIdToken(state, idToken){
      state.idToken = idToken;
    },
    setAreas(state, areas) {
      state.areas = areas;
    },
    setPrefectures(state, prefectures) {
      state.prefectures = prefectures;
    },
  },
  actions: {
    initial_set(context){
      //set areas list.
      const url_areas = '/api/member/areas';
      axios
        .get(
          url_areas,
        )
        .then(response => {
          context.commit('setAreas', response.data);
        })
        .catch(error => {
          // eslint-disable-next-line no-console
          console.log(error);
        });
      //set prefectures list.
      const url_prefectures = '/api/member/prefectures';
      axios
        .get(
          url_prefectures,
        )
        .then(response => {
          context.commit('setPrefectures', response.data);
        })
        .catch(error => {
          // eslint-disable-next-line no-console
          console.log(error);
        });
    },
    autologin(context){
      const idToken = localStorage.getItem('idToken');
      if (!idToken) return;
      const expiryTimeMs = localStorage.getItem('expiryTimeMs');
      const now = new Date();
      const isExpired = now.getTime() >= expiryTimeMs;
      if (isExpired) {
        context.dispatch('refreshIdToken', localStorage.getItem('refreshIdToken'));
      } else {
        context.commit('updateIdToken', idToken);
      }
    },
    login({ dispatch }, authData){
      const url = '';
      axios
        .post(
          url,
          {
            user_id: authData.user_id,
            password: authData.password,
            returnSecureToken: true,
          },
        )
        .then(response => {
          dispatch('setAuthData', response.data);
          router.push({name: 'home'});
        })
        .catch(error => {
          // eslint-disable-next-line no-console
          console.log(error);
        });
    },
    refreshIdToken({ commit, dispatch }, refreshToken){
      axios
        .post('', {
          type: 'refresh_token',
          refresh_token: refreshToken,
        })
        .then(response => {
          commit('updateIdToken', response.data.id_token);
          setTimeout(() => {
            dispatch('refreshIdToken', response.expires_in * 1000);
          });
        });
    },
    register({ commit }, authData){
      var url = '';
      axios
        .post(
          url,
          {
            user_id: authData.user_id,
            password: authData.password,
            returnSecureToken: true,
          },
        )
        .then(response => {
          var idToken =  response.token;
          commit('updateIdToken', idToken);
        })
        .catch(error => {
          // eslint-disable-next-line no-console
          console.log(error);
        });
    },
    setAuthData({commit, dispatch}, authData){
      const now = new Date();
      const expiryTimeMs = now.getTime() + authData.expiresin * 1000;
      const idToken =  authData.id_token;
      commit('updateIdToken', idToken);
      localStorage.setItem('idToken', idToken);
      localStorage.setItem('expiresTimeMs', expiryTimeMs);
      localStorage.setItem('refreshIdToken', authData.refreshToken);
      setTimeout(() => {
        dispatch('refreshIdToken', authData.refreshToken);
      }, 3600000); //１時間後にトークン更新。
    },
    logout({ commit }){
      commit('updateIdToken', null);
      localStorage.removeItem('idToken');
      localStorage.removeItem('expiryTimeMs');
      localStorage.removeItem('refreshIdToken');
      router.replace({name: 'login'});
    },
  },
});
