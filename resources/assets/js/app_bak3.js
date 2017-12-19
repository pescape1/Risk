
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
import EventBus from './eventbus';

var vm = new Vue({
    el: '#app',
    created: function () {
        EventBus.$on('resetNew', function () {
            this.new_risk = '';
            this.new_detail = '';
            this.editing=true;
            this.$validator.reset();
        }.bind(this));
        EventBus.$on('activeNew', function () {
            this.editing=false;
        }.bind(this));
    },
    methods: {
        createRisk: function () {
            if(!this.editing) {
                this.$validator.validateAll();
                EventBus.$emit('resetEdit');
                if (!this.errors.any()) {
                    this.risks.push({
                        risk: this.new_risk,
                        detail: this.new_detail,
                    });
                    this.new_risk = '';
                    this.new_detail = '';
                    this.$validator.reset();
                }
            }
        },
        deleteRisk: function (index) {
            if(!this.editing) {
                this.risks.splice(index, 1);
            }
        },
        resetRisk: function (index) {
            if(!this.editing) {
                this.new_risk = '';
                this.new_detail = '';
                this.$validator.reset();
            }
        },
    },
    data: {
        new_risk: '',
        new_detail: '',
        editing: false,
        risks: [
            {
                risk: 'Riesgo 1',
                detail: 'Detalle 1',
            },
            {
                risk: 'Riesgo 2',
                detail: 'Detalle 2',
            },
        ]
    }
});



