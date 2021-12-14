import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

let routes = [
    { path: '/Dashbord', component: require('../components/admin/Dashbord.vue').default },
    { path: '/profile', component: require('../components/admin/profile.vue').default  },
    { path: '/users', component: require('../components/admin/users.vue').default  }

];
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('vue-multiselect', window.VueMultiselect.default);


const router = new VueRouter({
    mode:'history',
    routes // short for `routes: routes`
});
const app = new Vue({
    router
}).$mount('#app');
