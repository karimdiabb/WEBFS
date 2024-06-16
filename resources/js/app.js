import './bootstrap';
import Alpine from 'alpinejs';
import { createApp } from 'vue';
import OrderPage from './components/OrderPage.vue';
import RegisterVisitors from './components/RegisterVisitors.vue';
import MenuImageForm from './components/MenuImageForm.vue';
import OrderSummary from './components/OrderSummary.vue';
import PageForm from './components/PageForm.vue';
import CKEditor from '@ckeditor/ckeditor5-vue';

window.Alpine = Alpine;
Alpine.start();

const app = createApp({});
app.component('order-page', OrderPage);
app.component('register-visitors', RegisterVisitors);
app.component('menu-image-form', MenuImageForm);
app.component('order-summary', OrderSummary);
app.component('page-form', PageForm);
app.use(CKEditor);

app.mount('#app');
