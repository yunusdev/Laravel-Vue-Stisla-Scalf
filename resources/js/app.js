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
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('store-role', require('./components/Admin/StoreRole.vue').default);
Vue.component('store-permission', require('./components/Admin/StorePermission.vue').default);
Vue.component('roles', require('./components/Admin/Roles.vue').default);
Vue.component('permissions', require('./components/Admin/Permissions.vue').default);
Vue.component('categories', require('./components/Admin/Categories.vue').default);
Vue.component('store-category', require('./components/Admin/StoreCategory.vue').default);
Vue.component('sub-categories', require('./components/Admin/SubCategories.vue').default);
Vue.component('store-sub-category', require('./components/Admin/StoreSubCategory.vue').default);
Vue.component('sub-categories', require('./components/Admin/SubCategories.vue').default);

Vue.component('products', require('./components/Admin/Products.vue').default);
Vue.component('store-product', require('./components/Admin/StoreProduct.vue').default);
Vue.component('view-product', require('./components/Admin/ViewProduct.vue').default);

Vue.component('coupons', require('./components/Admin/Coupons.vue').default);
Vue.component('store-coupon', require('./components/Admin/StoreCoupon.vue').default);

Vue.component('nav-bar', require('./components/User/Layout/Navbar.vue').default);
Vue.component('shop', require('./components/User/Shop/Index.vue').default);
Vue.component('product-view', require('./components/User/Shop/ProductView.vue').default);
Vue.component('trending-products', require('./components/User/TrendingProducts.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.filter('formatDate', function(value, format = 'LLLL') {
    if (value) {
        return moment(String(value)).format(format)
    }
})

Vue.filter('formatMoney', function (amount, decimalCount = 2, decimal = ".", thousands = ",") {

    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

    const negativeSign = amount < 0 ? "-" : "";

    let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
    let j = (i.length > 3) ? i.length % 3 : 0;

    return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
});


Vue.filter('formatDate2', function(value, format = 'LL') {
    if (value) {
        return moment(String(value)).format(format)
    }
})


import Vuex from 'vuex'
Vue.use(Vuex)

const app = new Vue({
    el: '#app',
});
