

// window.Vue = require('vue').default;

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import Vue from 'vue'

import App from './views/app.vue'


const app = new Vue({
    el: '#app',
    components: { App }
});
