/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');
try {
    window.$ = window.jQuery = require('jquery');
    window.Popper = require('popper.js');

    //require('bootstrap-sass');
    require('bootstrap');
} catch (e) {}

//datatables
require('datatables.net/js/jquery.dataTables.min');

//datatables bs
require('datatables.net-bs/js/dataTables.bootstrap.min');

//datatables buttons
require('datatables.net-buttons/js/dataTables.buttons.min');

//datatables select
require('datatables.net-select/js/dataTables.select.min');

//perfect scrollbar
require('perfect-scrollbar/dist/perfect-scrollbar');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
