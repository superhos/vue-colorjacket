import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)


const route = new VueRouter({
	routes:[{
    path:'/index',component:require('../views/index.vue')
  },
  {
    path:'/create',component:require('../views/create.vue')
  },
  {
    path:'/show',component:require('../views/show.vue')
  },
  {
    path:'*',redirect:'/index'
  }],
  scrollBehavior (to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return { x: 0, y: 0 }
    }
  }
})


export default route;