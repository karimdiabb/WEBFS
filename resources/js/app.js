import './bootstrap';
import Alpine from 'alpinejs';
import { createApp } from 'vue';
import OrderPage from '../components/OrderPage.vue';
import RegisterVisitors from './components/RegisterVisitors.vue';
import RequestHelp from './components/RequestHelp.vue';
import DownloadMenu from './components/DownloadMenu.vue';
import FavoriteDishes from './components/FavoriteDishes.vue';

window.Alpine = Alpine;
Alpine.start();

const app = createApp({});
app.component('order-page', OrderPage);
app.component('register-visitors', RegisterVisitors);
app.component('request-help', RequestHelp);
app.component('download-menu', DownloadMenu);
app.component('favorite-dishes', FavoriteDishes);

app.mount('#app');
