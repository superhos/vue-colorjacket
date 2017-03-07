<template>
  <div>
     <md-layout md-align="center" md-gutter="100">
      <div class="orderball" v-bind:style="{background: orderType=='new'?'#c54c82':'#FFF',color:orderType=='new'?'#FFF':'#ec729c'}" @click="change('new')">最 • 新</div>
      <div class="orderball" v-bind:style="{background: orderType=='popular'?'#c54c82':'#FFF',color:orderType=='popular'?'#FFF':'#ec729c'}" @click="change('popular')">最 • 热</div>
      <router-link to="/show"><div class="orderball">最可愛</div></router-link>
      </md-layout>
    <md-layout md-align="center" md-gutter="16">
      <colorbox v-for="item in colorboxData" :boxdata="item" :key="item.id"></colorbox>
    </md-layout>
    <md-progress v-show="!isEmpty" md-theme="orange" md-indeterminate></md-progress>
  </div>
</template>

<script type="es6">
  import colorbox from '../components/colorbox.vue'

  export default{
    name: 'index',
    components: { colorbox },
    data(){
      return {
        colorboxData:[],
        currentPage: 1,
        isEmpty:false,
        sending: false,
        orderType:'new'
      }
    },
    created(){
      var _this = this;
      _this.getData();

      window.addEventListener('scroll', this.handleScroll);

    },
    watch:{
      orderType(newType){
        this.colorboxData = [];
        this.currentPage = 1;
        this.getData();
      }
    },
    methods:{
      itemer(id,code,day,like){
        console.log("INSERT INTO color VALUE (null,1,now(),'" + code + "'," + (like+"").replace(",","") +"," + Math.ceil(Math.random()*10) + ");");
      },
      handleScroll () {
        if (window.innerHeight + document.scrollingElement.scrollTop >= document.scrollingElement.scrollHeight && !this.isEmpty && !this.sending){
            this.getData();
            this.sending = true;
        }
      },
      change (type){
        this.orderType = type;
      }, 
      getData(){
          var _this = this;
         this.$http.get('http://api.colorjacket.cn/color/'+_this.currentPage+ '/' + _this.orderType,{}).then(function(res){
              _this.currentPage++;
              var datas = JSON.parse(JSON.stringify(res.body));
              var colors = datas.colors;
              if (colors.length > 0){
                for (var i in colors){
                  _this.colorboxData.push({
                    id: colors[i].id,
                    block:[
                      {code:"#" + colors[i].code.substring(0,6),row:5},
                      {code:"#" + colors[i].code.substring(6,12),row:3},
                      {code:"#" + colors[i].code.substring(12,18),row:2},
                      {code:"#" + colors[i].code.substring(18,24),row:2}
                    ],
                    likes: colors[i].likes,
                    dislikes: colors[i].dislikes,
                    pulishdate: colors[i].pulishdate
                  })
                }
              }else{
                _this.isEmpty = true;
              }
              _this.sending = false;
          },function(res){
              console.log(JSON.stringify(res));
          });
      }
    }
  }
</script>
<style>
.orderball{
  width: 50px;
  height: 50px;
  border-radius: 50px;
  line-height: 50px;
  color: #ec729c;
  margin:20px 10px;
}
</style>
