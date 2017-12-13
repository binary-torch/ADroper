require('./bootstrap');

window.Vue = require('vue');

import createApplication from './app/CreateApplication.vue'
import login from './app/Login.vue'
import applications from './app/ShowApplications.vue'
import register from './app/Register.vue'
import approval from './app/Approval.vue'

const app = new Vue({
    el: '#app',
    components: {
        createApplication,
        login,
        register,
        applications,
        approval
    }
});
