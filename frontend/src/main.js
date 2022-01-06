import Vue from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify'
import 'roboto-fontface/css/roboto/roboto-fontface.css'
import '@mdi/font/css/materialdesignicons.css'


import globalComponents from './plugins/globalComponents'

import vueDebounce from './plugins/vueDebounce'






import http from './plugins/http'

Vue.config.productionTip = false

new Vue({
  router,
  store,
  vuetify,
  http,
  vueDebounce,
  globalComponents,
  render: function (h) { return h(App) }
}).$mount('#app')
