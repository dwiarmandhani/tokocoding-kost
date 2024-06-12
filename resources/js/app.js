/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue');
 import Vuex from 'vuex'
 import storeVuex from './components/store/index'
 import filter from './filter'

 Vue.use(Vuex)

 import VueChatScroll from 'vue-chat-scroll'
 Vue.use(VueChatScroll)

 const store = new Vuex.Store(storeVuex)

 Vue.component('main-app', require('./components/UserApp.vue').default);
 Vue.component('admin-app', require('./components/AdminApp.vue').default);


 const app = new Vue({
     el: '#app',
     store
 });
