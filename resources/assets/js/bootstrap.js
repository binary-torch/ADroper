window._ = require('lodash');

try {
    window.$ = window.jQuery = require('jquery');
    require('bootstrap-sass');
} catch (e) {}

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

AOS = require('aos');
AOS.init({
    disable: 'mobile'
});

Parallax = require('parallax-js');
require('smoothscroll-for-websites');
require('./material-kit/material.min');


require('moment');
require('spiritjs');

require('./material-dashboard/arrive.min.js');
require('./material-dashboard/perfect-scrollbar.jquery.min.js');
require('./material-dashboard/jquery.validate.min.js');
require('./material-dashboard/bootstrap-notify.js');
require('./material-dashboard/jquery.select-bootstrap.js');
require('./material-dashboard/sweetalert2.js');
require('./material-dashboard/jquery.bootstrap-wizard.js');
require('./material-dashboard/bootstrap-datetimepicker.js');
require('./material-dashboard/material-dashboard.js');
require('./material-kit/hipster-cards');