<template>
  <div>
    <md-layout md-align="center">
      <img class="me" src="../assets/cute.jpeg" alt="Sevens">
    </md-layout>
    <md-layout md-align="center">
      <span class="md-body-2"><md-icon md-iconset="ion-happy-outline"></md-icon>Sevens</span>
      <br/>
      <span class="md-body-2"><md-icon md-iconset="ion-android-contact"></md-icon>Single</span>
      <br/>
      <span class="md-body-2"><md-icon md-iconset="ion-android-create"></md-icon>技術棧 : vue.js + vue-resource + vue-route <br/> + vuematerial + slim(PHP Framework)</span>
      <br/>
      <span class="md-caption"><a href="http://www.chenhaotaishuaile.com">www.chenhaotaishuaile.com</a></span>
    </md-layout>
  </div>
</template>

<script type="es6">
  export default{
    name: 'show',
    components: {},
    data(){
      return {
       
      }
    },
    methods:{
     
    }
  }
</script>
<style scoped>
.me{
  max-width: 300px;
  max-height: 385px;
  margin-top:20px;
  margin-bottom:20px;
}
span{float:left;width: 100%;text-align: center;}
.md-theme-default a:not(.md-button){color:#408ab4;}
</style>
