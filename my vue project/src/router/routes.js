// router.js
import { createRouter, createWebHistory } from 'vue-router';
import  frontHome from '../components/pages/front/home/home.vue'
import  About from '../components/pages/front/home/about.vue'
import backHome from '../components/pages/back/home/home.vue';

const routes = [
  {
    path: '/',
    name: 'home',
    component: frontHome,
  },
  {
    path: '/about',
    name: 'about',
    component: About,
  },
  {
    path: '/back/home',
    name: 'backhome',
    component: backHome,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});
export default router;