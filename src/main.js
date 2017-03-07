import Vue from 'vue'
import App from './App.vue'
import VueMaterial from 'vue-material'
import router from './router'
import 'vue-material/dist/vue-material.css'
import './assets/css/ionicons.min.css'
// import './assets/css/md-theme-orange.css'
import VueResource from 'vue-resource'

Vue.use(VueMaterial)
Vue.use(VueResource)

Vue.material.registerTheme('default', {
  primary: 'white',
  accent: 'red',
  warn: 'red',
  background: {
  	color: 'grey',
    hue: 100
  }
})

Vue.material.registerTheme('orange', {
  primary: 'orange',
  accent: 'orange',
  warn: 'orange',
  background: {
  	color: 'orange',
    hue: 100
  }
})

new Vue({
  el: '#app',
  router,
  render: h => h(App)
})
