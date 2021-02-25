/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Axios from 'axios'
import Swal from 'sweetalert'
import izitoast from 'izitoast'
import '../../public/admin/css/izitoast.css'

Vue.prototype.$http = Axios;
Vue.prototype.$swal = Swal;
Vue.mixin({
    methods: {
        notifSuceess: function(msg) {
            izitoast.success({
                title: 'Success!',
                message: msg,
                position: 'topRight'
            });
        },
        notifError: function(msg) {
            izitoast.error({
                title: 'Error!',
                message: msg,
                position: 'topRight'
            });
        }
    }
});
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
Vue.component('store-role', require('./components/Admin/StoreRole.vue').default);
Vue.component('store-permission', require('./components/Admin/StorePermission.vue').default);
Vue.component('roles', require('./components/Admin/Roles.vue').default);
Vue.component('permissions', require('./components/Admin/Permissions.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
