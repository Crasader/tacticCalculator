
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('modal-template', require('./components/ModalTemplate.vue'));
Vue.component('basic-table', require('./components/BasicTable.vue'));
Vue.component('tactic-table', require('./components/TacticTable.vue'));
Vue.component('snackbar', require('./components/Snackbar.vue'));
Vue.component('loader', require('./components/Loader.vue'));
Vue.component('donut', require('./components/charts/Donut.vue'));

Vue.component('media-component-upload', require('./components/media/Upload.vue'));
Vue.component('media-component-list', require('./components/media/List.vue'));

const app = new Vue({
    el: '#app'
})
