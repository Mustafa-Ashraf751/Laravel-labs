import './bootstrap';
import { createApp } from 'vue';
import ViewAjax from './Components/ViewAjax.vue';

document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('blade-app')) {
        const app = createApp({});
        app.component('view-ajax', ViewAjax);
        app.mount('#blade-app');
        console.log('Vue mounted to #blade-app');
    } else {
        console.error('Element #blade-app not found');
    }
});