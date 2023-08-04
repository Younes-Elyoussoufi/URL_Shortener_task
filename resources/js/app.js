import './bootstrap';

import {createApp} from 'vue/dist/vue.esm-bundler.js'
import {createPinia} from 'pinia'

import Home from '@/components/Home.vue'

const app =createApp({})
const pinia=createPinia();

app.use(pinia)

app.component('home-component',Home);
app.mount("#app")