
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('select2', require('./components/Select2Component.vue'));


const app = new Vue({
    el: '#app'
});
*/

import VeeValidate from 'vee-validate';
Vue.use(VeeValidate,{
    locale: 'es',
    dictionary: {
      es: {
        custom: {
          risk: {
            required: 'Se requiere el campo riesgo.' // messages can be strings as well.
          },
          detail: {
            required: 'Se requiere el campo detalle.'
          }
       }
    }
  }
});

Vue.component('app-icon', {
    template: '<span :class="cssClasses" aria-hidden="true"></span>',
    props: ['img'],
    computed: {
        cssClasses: function () {
            return 'glyphicon glyphicon-'+this.img;
        }
    }
});

Vue.component('app-risk', require('./components/RiskComponent.vue'));

var vm = new Vue({
    el: '#app',
});



