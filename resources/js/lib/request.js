import axios from "axios";

let token = document.head.querySelector('meta[name="csrf-token"]');

axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
if (token) {
  axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
}
axios.defaults.withCredentials = true;
axios.defaults.headers.common["Accept"] = "application/json";

const instance = axios.create({
  timeout: 10000,
});

export const req = instance;
