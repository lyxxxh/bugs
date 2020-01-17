<template>
  <div class="" id="app">
    <el-container>

      <el-header>
        <el-menu
          router
          :default-active="activeIndex"
          class="el-menu-demo"
          mode="horizontal"
          @select="handleSelect"
          background-color="#545c64"
          text-color="#fff"
          active-text-color="#ffd04b">
          <el-menu-item index="/">Index</el-menu-item>
          <el-submenu index="2">
            <template slot="title">哔哩哔哩</template>
            <el-menu-item index="/bilbil/video_download">视频下载</el-menu-item>
            <el-menu-item index="2-2">封面下载</el-menu-item>
          </el-submenu>
          <el-menu-item index="3" disabled>待留</el-menu-item>
          <el-menu-item index="4"><a href="https://www.ele.me" target="_blank">关于</a></el-menu-item>
        </el-menu>
      </el-header>
      <el-container>

        <!--
        <el-aside width="300px">
        </el-aside>
-->
        <el-container>
          <el-main>
            <el-card class="main-card" shadow="hover">
              <nuxt />
            </el-card>
          </el-main>
          <el-footer>Footer</el-footer>
        </el-container>
      </el-container>
    </el-container>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        activeIndex: '/',
        activeIndex2: '1'
      }
    },
    methods: {
      handleSelect (key, keyPath) {
        console.log(key, keyPath)
      }
    }
  }
</script>
<style>
  html,body,.el-container{
    width: 100;
    height: 100%;
  }
  .main-card{
    min-height: 700px;
  }
  .el-header, .el-footer {
    background-color: #B3C0D1;
    color: #333;
    text-align: center;
    line-height: 60px;
  }

  .el-aside {
    background-color: #D3DCE6;
    color: #333;
    text-align: center;
    line-height: 200px;
  }

  .el-main {
    background-color: #E9EEF3;
    color: #333;
    text-align: center;
    line-height: 160px;
  }

  body > .el-container {
    margin-bottom: 40px;
  }

  .el-container:nth-child(5) .el-aside,
  .el-container:nth-child(6) .el-aside {
    line-height: 260px;
  }

  .el-container:nth-child(7) .el-aside {
    line-height: 320px;
  }
  .el-header{
    padding: 0;
  }
</style>
