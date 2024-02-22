import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router/routes.js'; 


const app = createApp(App);
app.use(router); 
app.mount('#app');