require('./bootstrap');

window.Vue = require('vue');

// Register Vue component
Vue.component('users', require('./components/UsersComponent.vue').default);
Vue.component('user-edit', require('./components/UsersEditComponent.vue').default);
Vue.component('incidents', require('./components/IncidentsComponent.vue').default);
Vue.component('evacuation-point', require('./components/EvacuationPointComponent.vue').default);
Vue.component('rescuers-pending', require('./components/PendingRescuerComponent.vue').default);
Vue.component('rescuers-pending-manage', require('./components/ManagePendingRescuerComponent.vue').default);
Vue.component('rescuers', require('./components/RescuersComponent.vue').default);
Vue.component('rescuer-profile', require('./components/RescuerProfileComponent.vue').default);
Vue.component('emergency-type', require('./components/EmergencyTypesComponent.vue').default);
Vue.component('citizens-pending', require('./components/CitizensPendingComponent.vue').default);
Vue.component('citizens-pending-manage', require('./components/CitizensPendingComponent.vue').default);
Vue.component('citizens-pending-manage', require('./components/CitizensProfileComponent.vue').default);

// Create Vue instance
const app = new Vue({
    el: '#app',
});