<template>
  <el-form ref="form" :model="form" label-width="80px" label-position="left">

    <el-form-item label="AV号">
      <el-input v-model="href"></el-input>
    </el-form-item>
    <el-form-item >
      <el-button type="primary" @click="getVideoInfo">获取集数　&　封面</el-button>
    </el-form-item>

    <el-divider></el-divider>

    <el-row>
      <el-button type="success" @click="toUrl(pic)">点击查看封面
        <el-tooltip class="item" effect="dark" content="封面有防盗链　不想下载到服务器了　点击也是一样的" placement="top">
          <i class="el-icon-question"></i>
        </el-tooltip>
      </el-button>

    </el-row>

    <el-divider></el-divider>
    <el-form-item label="选集下载">
      <el-checkbox :indeterminate="isIndeterminate" v-model="checkAll" @change="handleCheckAllChange" style="float: left;display: block;width: 100%;text-align: left">全选</el-checkbox>
      <div style="margin: 15px 0;"></div>
      <el-checkbox-group v-model="form.indexs" @change="handleCheckedCidChange">
        <el-checkbox v-for="(item,index) in pages" :label="index" :key="index" style="float: left">{{ item.part }} {{ item.duration | m }}</el-checkbox>
      </el-checkbox-group>
    </el-form-item>

    <el-form-item label="清晰度">
      <el-radio-group v-model="form.resource">
        <el-radio label="720p"></el-radio>
        <el-radio label="360p"></el-radio>
      </el-radio-group>
    </el-form-item>
    <el-form-item>
      <el-button type="primary" @click="onSubmit">下载</el-button>
    </el-form-item>
  </el-form>
</template>
<script>
  //选集索引
  let Indexs = []
  const GET_VIDEO_INFO_URL = 'bilibili/getVideoInfo'
  const DOWNLOAD_VIDEO_URL = 'bilibili/downloadVideo'
  export default {
    data () {
      return {
        href:'https://www.bilibili.com/video/av12522583?from=search&seid=14461063034206590946',
        form: {
          aid: '',
          indexs: Indexs,//已经选择的索引
          pages:[]
        },
        pages: [],
        pic:"https://dss0.bdstatic.com/6Ox1bjeh1BF3odCf/it/u=2540772724,3018041659&fm=74&app=80&f=JPEG&size=f121,90?sec=1880279984&t=5187e4ff1bd3bf1c36ce979a042325a8",
        isIndeterminate: true,
        checkAll: false
      }
    },
    methods: {
      onSubmit () {
        this.form.indexs.forEach(index =>{
          this.form.pages.push(this.pages[index])
        })

        this.$post(DOWNLOAD_VIDEO_URL,{ href: this.href,aid: this.form.aid, pages: JSON.stringify(this.form.pages}).then(val => {
          this.$message(val);
        })

      },
      handleCheckAllChange (val) {
        this.form.indexs = val ? Indexs : []
        this.isIndeterminate = false
      },
      handleCheckedCidChange (value) {
        let checkedCount = value.length
        this.checkAll = checkedCount === this.form.indexs.length
        this.isIndeterminate = checkedCount > 0 && checkedCount < this.form.indexs.length
      },
      getVideoInfo () {
        this.$post(GET_VIDEO_INFO_URL, { href: this.href})
        .then(val => {
          this.pic = val.pic
          this.pages = val.pages
          Indexs = Object.keys(val.pages)
          Indexs = Indexs.map(val => parseInt(val))
          this.form.aid = val.aid
        })
      }
    },
    filters: {
      m (val) { //second to minute
        return Math.floor(val / 60) + ':' + val % 60
      }
    }
  }
</script>

<style>
  button{
    float: left;
  }
</style>
