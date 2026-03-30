require('./bootstrap');

window.Vue = require('vue');

// Register Vue component
Vue.component('users', require('./components/UsersComponent.vue').default);
Vue.component('incidents', require('./components/IncidentsComponent.vue').default);
Vue.component('evacuation-point', require('./components/EvacuationPointComponent.vue').default);
Vue.component('rescuers-pending', require('./components/PendingRescuerComponent.vue').default);
Vue.component('rescuers-pending-manage', require('./components/ManagePendingRescuerComponent.vue').default);
Vue.component('rescuers', require('./components/RescuersComponent.vue').default);

// Create Vue instance
const app = new Vue({
    el: '#app',
});