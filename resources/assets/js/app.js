
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import money from 'v-money';
import VueTheMask from 'vue-the-mask';
Vue.use(BootstrapVue);
Vue.use(VueTheMask);
Vue.use(money, {precision: 4});

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('createinvests', require('./components/CreateInvests.vue'));
Vue.component('createinveststypestocks', require('./components/invests/createTypeStocks.vue'));
Vue.component('editinveststypestocks', require('./components/invests/editTypeStocks.vue'));
Vue.component('userlist', require('./components/users/usersList.vue'));
Vue.component('brokerlist', require('./components/brokers/brokersList.vue'));
Vue.component('stocklist', require('./components/stocks/stocksList.vue'));
Vue.component('investlist', require('./components/invests/investsList.vue'));
Vue.component('createmonthlyquotes', require('./components/monthlyQuotes/createMonthlyQuotes.vue'));
//Vue.component('currencybrl', require('./components/layouts/currencybrl.vue')); deprecated
//Vue.component('sidebar', require('./components/layouts/sidebar.vue')); deprecated
// Vue.component('autocomplete',require('./components/Autocomplete.vue'));
//Vue.component('autocompletecities',require('./components/Autocompletecities.vue')); versao antiga

const app = new Vue({
    el: '#app'
});