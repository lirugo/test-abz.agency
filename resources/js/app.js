
require('./bootstrap');

//Material icons
import 'material-design-icons-iconfont/dist/material-design-icons.css'
//Material design icons
import '@mdi/font/css/materialdesignicons.css'

//Vue
import Vue from 'vue'

//Vuetify
import Vuetify from 'vuetify'
Vue.use(Vuetify);

//Vuetify styles
import 'vuetify/dist/vuetify.min.css'

//Imports
import WidgetEmployee from './components/employee/Employee'

//Main
new Vue({
    el: '#app',
    components: {
        WidgetEmployee
    }
});