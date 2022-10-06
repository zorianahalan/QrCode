import './bootstrap';
import { createApp } from "vue";
import App from "./App.vue";
import components from "./components";
import router from './router'
import auth from "./store/auth";

const app = createApp(App)

components.forEach(component => app.component(component.name, component))

app
    .use(auth)
    .use(router)
    .mount('#app');


