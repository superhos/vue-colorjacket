<template>
  <div class="colorblock" v-bind:style="{background: code,'height':row*25 + 'px'}">
    <span class="code">{{code}}</span>
  </div>
</template>

<script type="es6">
  export default{
    name: 'colorblock',
    props:['row','code'],
    data(){
      return {

      }
    }
  }
</script>
<style>
.colorblock{min-width:320px;position: relative;}
.colorblock .code {position:absolute; left:0; bottom:0;background: rgba(0,0,0,.6);color:#FFF;padding:5px 10px;display:none;}
.colorblock:hover .code{display: block;}
</style>
