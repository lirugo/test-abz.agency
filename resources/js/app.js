
require('./bootstrap')

import _ from 'lodash'

//Material icons
import 'material-design-icons-iconfont/dist/material-design-icons.css'
//Material design icons
import '@mdi/font/css/materialdesignicons.css'

//Vue
import Vue from 'vue'

//VueRouter
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//Vuetify
import Vuetify from 'vuetify'
Vue.use(Vuetify);

//Vuetify styles
import 'vuetify/dist/vuetify.min.css'

//Imports components
import WidgetEmployee from './components/employee/Employee'
import WidgetEmployeeList from './components/employee/List'
//Partials
Vue.component('loader', require('./components/partials/Loader.vue').default);

//Routes
const routes = [
    //Employees
    { path: '/list', component: WidgetEmployeeList},
    { path: '/catalog', component: WidgetEmployee }
]

const router = new VueRouter({
    routes
})

//Main
new Vue({
    el: '#app',
    components: {
        WidgetEmployee,
        WidgetEmployeeList,
    },
    router
}).$mount('#app');