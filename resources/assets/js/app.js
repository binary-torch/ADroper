require('./bootstrap');

window.Vue = require('vue');

import accordion from './app/Accordion.vue'
import notifyMe from './app/NotifyMe.vue'
import timeline from './app/Timeline.vue'
import contactUs from './app/ContactUs.vue'
import newProject from './app/NewProject.vue'
import workshopRegistration from './app/WorkshopRegistration.vue'

const app = new Vue({
    el: '#app',
    components: {
        accordion,
        timeline,
        notifyMe,
        contactUs,
        newProject,
        workshopRegistration
    }
});
