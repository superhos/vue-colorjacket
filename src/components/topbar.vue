<template>
  <div class="topbar">
    <md-toolbar class="md-dense">
      <router-link to="/index">
      <md-button class="md-icon-button">
        <md-icon md-iconset="ion-chevron-left" ></md-icon>
      </md-button>
      </router-link>

      <h2 class="md-title" style="flex: 1">
      <router-link to="/index"><img class="logo" src="../assets/logo.png" alt="Color Jacket">
      </router-link></h2>

      <router-link to="/create">
        <md-button class="md-icon-button">
          <md-icon md-iconset="ion-plus"></md-icon>
        </md-button>
      </router-link>
    </md-toolbar>
  </div>
</template>

<script type="es6">
  export default{
    name: 'topbar',
    data(){
      return {

      }
    },
    methods:{

    }
  }
</script>
<style>
.topbar{box-shadow: 1px 1px 1px #e1e1e1;}
.logo{width: 38px; height:40px;}
</style>
