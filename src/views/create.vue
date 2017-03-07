<template>
  <div id="create">
    <span class="md-display-1">发布你的屌配色</span>
    <br/>
    <span class="md-subheading">Show Me Your Fucking Color</span>
    <div class="mask" v-show="showColor" @click="closeColorBox"></div>
    <Sketch v-show="showColor" class="fly" v-model="color" @change-color="onChange" @ok="onOk" @cancel="onCancel"></Sketch>
    <md-layout md-align="center" md-gutter="16">
         <div class="blockbox">
          <div v-bind:style="{background:colorData[0]}" class="block_1 block" @click="showColorBox(0)"></div>
          <div v-bind:style="{background:colorData[1]}" class="block_2 block" @click="showColorBox(1)"></div>
          <div v-bind:style="{background:colorData[2]}" class="block_3 block" @click="showColorBox(2)"></div>
          <div v-bind:style="{background:colorData[3]}" class="block_4 block" @click="showColorBox(3)"></div>
        </div>
    </md-layout>
    <md-layout md-align="center" md-gutter="16" class="mt-20">
       <md-button class="md-raised md-accent" @click.native="publish">发布</md-button>
    </md-layout>
    <md-dialog-alert
      :md-content="alert.content"
      :md-ok-text="alert.ok"
      ref="alertbox">
    </md-dialog-alert>
  </div>
</template>

<script type="es6">
  import colorbox from '../components/colorbox.vue'
  import { Sketch } from 'vue-color'

  let defaultProps = {
  hex: '#194d33',
  hsl: {
    h: 150,
    s: 0.5,
    l: 0.2,
    a: 1
  },
  hsv: {
    h: 150,
    s: 0.66,
    v: 0.30,
    a: 1
  },
  rgba: {
    r: 25,
    g: 77,
    b: 51,
    a: 1
  },
  a: 1
}

  export default{
    name: 'create',
    components: { colorbox ,Sketch},
    data(){
      return {
        color:defaultProps,
        showColor:false,
        colorData: ['#dddddd','#cccccc','#bbbbbb','#aaaaaa'],
        currentBlock: -1,
        alert:{
          content: 'HelloWorld',
          ok: '好了好了 我知道錯了'
        }
      }
    },
    created(){
      var _this = this;
      // _this.getData();
    },
    methods:{
      getData(){
          var _this = this;
         this.$http.get('http://api.colorjacket.cn/getColor/'+_this.$route.params.id,{}).then(function(res){
              var datas = JSON.parse(JSON.stringify(res.body));
              var color = datas.color;
                  _this.colorboxData = {
                    id: color.id,
                    block:[
                      {code:"#" + color.code.substring(0,6),row:5},
                      {code:"#" + color.code.substring(6,12),row:3},
                      {code:"#" + color.code.substring(12,18),row:2},
                      {code:"#" + color.code.substring(18,24),row:2}
                    ],
                    likes: color.likes,
                    dislikes: color.dislikes,
                    pulishdate: color.pulishdate
                  }
          },function(res){
              console.log(JSON.stringify(res));
          });
      },
      showColorBox (blockId){
        this.showColor = true;
        this.currentBlock = blockId;
      },
       onOk () {
        console.log('ok')
      },
      onCancel () {
        console.log('cancel')
      },
      onChange (val) {
        this.color = val;
        this.colorData[this.currentBlock] = val.hex;
      },
      closeColorBox(){
        this.showColor = false;
      },
      publish(){
        var _this = this;
        this.$http.post('http://api.colorjacket.cn/addColor',{ 
            code: _this.colorData[0].replace('#','') +　_this.colorData[1].replace('#','') + _this.colorData[2].replace('#','') + _this.colorData[3].replace('#','')
        },{emulateJSON:true}).then(function(res){
              var data = JSON.parse(JSON.stringify(res.body));
              if (data.error){
                // alert(data.error.msg);
                _this.alert.content = data.error.msg;
                _this.$refs['alertbox'].open();
                return;
              }
              if (data.code == 1){
                _this.alert.content = "發佈成功";
                _this.$refs['alertbox'].open();
                _this.$router.go(-1)
              }
          },function(res){
              console.log(JSON.stringify(res));
          });
      }
    }
  }
</script>
<style scoped>
#create{padding:50px 0;}
.mt-20{margin-top:20px;}
.blockbox{margin-top: 50px;}
.block{width: 300px;}
.block_1{height: 125px;border-top-left-radius: 10px;border-top-right-radius: 10px;}
.block_2{height: 75px;}
.block_3{height: 50px;}
.block_4{height: 50px;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;}
.fly{
  position: absolute;
  right: 15%;
}
.mask{
  position: absolute;
  top:0;
  left:0;
  width: 100%;
  height: 100%;
  display: block;
  background:rgba(0,0,0,0);
}
</style>
