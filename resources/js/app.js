
require('./bootstrap');

//Material design icon
import '@mdi/font/css/materialdesignicons.css'

//Vue
import Vue from 'vue'

//Vuetify
import Vuetify from 'vuetify'
Vue.use(Vuetify);

//Vuetify styles
import 'vuetify/dist/vuetify.min.css'


new Vue({
    el: '#app',
    data:{
        data:'tex'
    }
});