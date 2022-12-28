import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    comments: [],
    capcha: null,
    form: {
      username: '',
      message: '',
      capcha: '',
    },
  },
  mutations: {
    SET_COMMENTS(state, value) {
      state.comments = value;
    },
    SET_CAPCHA(state, value) {
      state.capcha = value;
    },
    SET_FORM_FIELD(state, data) {
      state.form[data.field] = data.value
    },
    CLEAR_FORM(state) {
      Object.keys(state.form).forEach(key => {
        state.form[key] = '';
      });
    }
  },
  actions: {
    async getComments({ commit }) {
      const { data } = await axios.get(
          'http://localhost:80/ajax/getComments.php'
      );
      commit('SET_COMMENTS', data);
    },
    async getCapcha({ commit }) {
      const { data } = await axios.get(
        'http://localhost:80/capcha.php'
      );
      localStorage.setItem('code', data.code);
      commit('SET_CAPCHA', data.image);
    },
    async sendForm({ state, commit, dispatch }) {
      const { form } = state;
      const formData = new FormData();
      formData.append('username', form.username);
      formData.append('message', form.message);
      formData.append('capcha', form.capcha);
      formData.append('code', localStorage.getItem('code'));

      await axios.post(        
        'http://localhost:80/ajax/comment.php',
        formData
      );
      commit('CLEAR_FORM');
      await dispatch('getComments');
      await dispatch('getCapcha');
    },
    async deleteComment({ dispatch }, id) {
      const formData = new FormData();
      formData.append('id', id);
      await axios.post(        
        'http://localhost:80/ajax/deleteComment.php',
        formData
      );
      await dispatch('getComments');
    }
  },
});