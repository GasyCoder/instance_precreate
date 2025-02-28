import './bootstrap';
// import Alpine from 'alpinejs'
import { createApp } from 'vue';
import App from './components/App.vue';

// // Initialize Alpine
// window.Alpine = Alpine
// Alpine.start()

// Vue initialization
const app = createApp(App);
app.mount('#app');
