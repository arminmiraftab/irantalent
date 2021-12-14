/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('admin-lte');
require('../js/route/Route.js');


window.Vue = require('vue').default;
import Form from 'vform'
window.Form = Form;
import moment from 'moment'
import Multiselect from 'vue-multiselect'
import VueProgressBar from 'vue-progressbar'
const options = {
    color: '#3cfa00',
    failedColor: '#ff0100',
    thickness: '3px',
    transition: {
        speed: '0.8s',
        opacity: '0.8s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}
Vue.use(VueProgressBar, options)

Vue.filter('capital', (text) => {
    return text.charAt(0).toUpperCase() + text.slice(1)
});
Vue.filter('date', (text) => {
    return moment(text).format("MMM Do YY");
});

Vue.filter('str_limit', function (value, size) {
    if (!value) return '';
    value = value.toString();

    if (value.length <= size) {
        return value;
    }
    return value.substr(0, size) + '...';
});
Vue.filter('emty', function (value) {
    if (!value) return 'emty';
    return value;
});
// ES6 Modules or TypeScript
import Swal from 'sweetalert2'

// CommonJS
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.Toast = Toast;

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
    router
});
