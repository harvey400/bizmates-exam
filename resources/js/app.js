import './bootstrap';

import {createApp} from 'vue';

import App from './components/App.vue'

import axios from 'axios';
import VueAxios from 'vue-axios';

import "bootstrap/dist/css/bootstrap.min.css"

const app = createApp(App);

//Axios
app.use(VueAxios, axios);

//Global variable
app.config.globalProperties.URL = 'http://localhost:8000/api/';

app.mount('#app');

import "bootstrap"

