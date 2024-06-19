import axios, { AxiosStatic } from 'axios';
import { Component, createApp } from 'vue';

declare global {
  interface Window {
    axios: AxiosStatic;
  }
}

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const app = createApp({})
const files = require.context('./', true, /\.vue$/i);
files.keys().map((key: string) => {
  const myComponent: Component = files(key).default;
  if (myComponent) {
    app.component(key.split('/').pop()!.split('.')[0], myComponent);
  }
});
app.mount('#app')
