import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import VueLayers from "vuelayers";

import vuetify from "./plugins/vuetify";
import "vuelayers/lib/style.css"; // needs css-loader

Vue.use(VueLayers);

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  vuetify,
  render: (h) => h(App),
}).$mount("#app");
