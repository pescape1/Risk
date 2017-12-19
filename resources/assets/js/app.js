
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

import VeeValidate, { Validator } from 'vee-validate'

Validator.extend('unique_risk', {
    messages: {
        es: (field) => {
            return 'No se puede repetir el riesgo.';
        },
    },
    validate(value, [risks, index]) {
        let p=risks.map(risk => risk.risk).indexOf(value);
        return p == -1 || p==index;
    }
});

Vue.use(VeeValidate,{
    locale: 'es',
    dictionary: {
        es: {
            custom: {
                input_risk: {
                    required: 'Se requiere el campo riesgo.', // messages can be strings as well.
                },
                input_detail: {
                    required: 'Se requiere el campo detalle.'
                }
            }
        }
    }
});

Vue.component('app-icon', {
    template: '<span :class="cssClasses" aria-hidden="true"></span>',
    props: {img: String, clase: {default: null}},
    computed: {
        cssClasses: function () {
            return 'glyphicon glyphicon-'+this.img+(this.clase==null ? '' : ' '+this.clase);
        }
    }
});

Vue.component('app-risk', require('./components/RiskComponent.vue'));

var app = new Vue({
    el: '#app',
});
