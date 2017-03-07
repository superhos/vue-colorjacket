<template>
  <div id="app">
      <topbar></topbar>
      <div class="main">
        <keep-alive>
          <router-view></router-view>
        </keep-alive>
      </div>
  </div>
</template>

<script>
import topbar from './components/topbar.vue'
export default {
  name: 'app',
  components: {
    topbar
  },
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  }
}
</script>

<style lang="scss">
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}

.main{padding:0 50px}
</style>
