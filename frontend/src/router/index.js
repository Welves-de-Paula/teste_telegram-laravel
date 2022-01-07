import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    meta: { layout: 'AppLayout', name: 'Home', icon: "mdi-home", showLink: true },
    component: Home

  },
  {
    path: '/mensagens',
    name: 'Mensagens',
    meta: { layout: 'AppLayout', name: 'Mensagens', icon: "mdi-android-messages", showLink: true },


    component: () => import('../views/MessageIndex.vue')

  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
