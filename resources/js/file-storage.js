import Vue from 'vue';
import Vuex from 'vuex';
import FileManager from 'laravel-file-manager'

Vue.use(Vuex);

// create Vuex store, if you don't have it
const store = new Vuex.Store();

Vue.use(FileManager, { store });

// Vue.component('file-managers',require("./components/FileManagers.vue").default);
const origin = window.location.origin;
const app = new Vue({
    el: "#app",
    store,
    data() {
        return {
            settings: {
                baseUrl: `${origin}/file-manager`,
                lang: 'es',
            }
        }
    }
});