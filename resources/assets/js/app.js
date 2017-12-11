require('./bootstrap');

window.Vue = require('vue');

import accordion from './app/Accordion.vue'
import notifyMe from './app/NotifyMe.vue'
import timeline from './app/Timeline.vue'
import createApplication from './app/CreateApplication.vue'

const app = new Vue({
    el: '#app',
    components: {
        accordion,
        timeline,
        notifyMe,
        createApplication,
    }
});
