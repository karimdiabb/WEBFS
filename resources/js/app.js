import './bootstrap';
import Alpine from 'alpinejs';
import { createApp } from 'vue';
import RegisterVisitors from './components/RegisterVisitors.vue';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const app = createApp({
      components: {
        RegisterVisitors
      }
    });
  
    app.component('register-visitors', RegisterVisitors);

    app.mount('#app');
    
  });
