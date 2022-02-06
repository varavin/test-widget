import { createApp } from "vue";
import App from "./components/App.vue";
import axios from 'axios'

const app = createApp(App)
app.config.globalProperties.axios=axios
createApp(App).mount("#app");

