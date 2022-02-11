/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
window.Vue.mixin(require('./asset'));
window.Vue.mixin(require('./modal'));
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('reports-component', require('./components/ReportsComponent.vue').default);
Vue.component('modal-component', require('./components/ModalComponent.vue').default);
Vue.component('calendar', require('./components/CalendarComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        form: {
            description: null,
            start_date: null,
            end_date: null
        }
    },
    methods: {
        crearReporte() {
            let form = this.form;
            if (form.description == null || form.start_date == null || form.end_date == null) {
                alert('Debe llenar todos los campos');
                return;
            }
            fetch('/api/generate-report', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    description: form.description,
                    start_date: form.start_date,
                    end_date: form.end_date
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    form.description = null;
                    form.start_date = null;
                    form.end_date = null;
                    this.$refs.report.loadData();
                    this.closeModal('generarModal');
                } else {
                    alert(data.message);
                }
            });
        }
    }
});