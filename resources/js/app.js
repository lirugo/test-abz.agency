
require('./bootstrap');

//Vue
import Vue from 'vue'

//Vuetify
import Vuetify from 'vuetify'
Vue.use(Vuetify);


const app = new Vue({
    el: '#app',
    data:{
        data:'tex'
    }
});