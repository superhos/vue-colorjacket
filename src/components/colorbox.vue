<template>
  <md-layout class="colorbox" :md-flex="33" :md-flex-small="100">
    <!-- <router-link to="/show/item.id"> -->
      <md-card md-with-hover>
        <md-card-media>
          <colorblock v-for="item in boxdata.block" :code="item.code" :row="item.row"></colorblock>

          <md-ink-ripple></md-ink-ripple>
        </md-card-media>

        <md-card-actions>
          <md-button class="md-dense" @click.native="like" :disabled="hasVote">
            <md-icon md-iconset="ion-thumbsup" class="md-like" v-bind:style="{color:islike==1?'#ff5656':'#799999'}"></md-icon>
            <span class="lovefont">{{boxdata.likes}}</span>
          </md-button>

          <md-button class="md-dense" @click.native="dislike" :disabled="hasVote">
            <md-icon md-iconset="ion-thumbsdown" class="md-dislike" v-bind:style="{color:islike==-1?'#58828b':'#799999'}"></md-icon>
            <span class="lovefont">{{boxdata.dislikes}}</span>
          </md-button>

          <span class="day">
            {{checkToday(boxdata.pulishdate)}}
          </span>
          <!-- <md-button class="md-icon-button">
            <md-icon md-iconset="ion-ios-bookmarks"></md-icon>
          </md-button> -->

        </md-card-actions>
      </md-card>
    <!-- </router-link> -->
  </md-layout>
</template>

<script type="es6">
  import colorblock from "./colorblock.vue"
  export default{
    name: 'colorbox',
    components: {colorblock},
    props: ['boxdata','isBig'],
    data(){
      return {
        hasVote:false,
        islike: 0
      }
    },
    methods:{
      checkToday(pday){
        var gap = Date.parse(new Date()) - Date.parse(new Date(pday.replace(/-/g, "/")));
        var day = Math.floor(gap / 86400000);
        console.log(Date.parse(new Date(pday)));
        console.log(gap);
        console.log(day);
        return day==0?'Today':(day?(day+' days'):'2 days');
      },
      like(){
        if (this.hasVote)return;

        this.boxdata.likes++;
        this.hasVote=true;
        var _this = this;
        this.$http.get('http://color.ibowshow.cn/color/like/'+_this.boxdata.id,{}).then(function(res){
             _this.islike = 1;
          },function(res){
              console.log(JSON.stringify(res));
          });
      },
      dislike(){
        if (this.hasVote)return;
        
        this.boxdata.dislikes++;
        this.hasVote=true;
        var _this = this;
        this.$http.get('http://color.ibowshow.cn/color/dislike/'+_this.boxdata.id,{}).then(function(res){
             _this.islike = -1;
          },function(res){
              console.log(JSON.stringify(res));
          });
      }
    }
  }
</script>
<style>
.colorbox{margin-bottom: 40px;}
.lovefont{color: #799999;font-size:15px;margin-top: 1px;float: right;}
.md-theme-default.md-icon.md-like,.md-theme-default.md-icon.md-dislike{color: #799999;}
.colorbox .md-card .md-card-actions {
    justify-content: flex-start;
    display: block;
}
.colorbox .md-card{overflow: hidden}
.day{float:right;font-family: 'Source Sans Pro', sans-serif;
    color: #799999;font-size:12px;line-height: 35px;}
.colorbox .md-button{min-width: 50px;padding:0 8px;float:left;}
</style>

