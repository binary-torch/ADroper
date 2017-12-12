require('./bootstrap');

window.Vue = require('vue');

import createApplication from './app/CreateApplication.vue'

const app = new Vue({
    el: '#app',
    components: {
        createApplication,
    }
});
