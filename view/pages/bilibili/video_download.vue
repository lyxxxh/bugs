<template>
  <el-form ref="form" :model="form" label-width="80px" label-position="left">

    <el-form-item label="AV号">
      <el-input v-model="form.a_id"></el-input>
    </el-form-item>
    <el-form-item >
      <el-button type="primary" @click="initCids">获取集数　&　封面</el-button>
    </el-form-item>

    <el-divider></el-divider>

    <el-image
      style="width: 100px; height: 100px;display: block"
      src="https://dss0.bdstatic.com/6Ox1bjeh1BF3odCf/it/u=2540772724,3018041659&fm=74&app=80&f=JPEG&size=f121,90?sec=1880279984&t=5187e4ff1bd3bf1c36ce979a042325a8"
      :preview-src-list="['https://dss0.bdstatic.com/6Ox1bjeh1BF3odCf/it/u=2540772724,3018041659&fm=74&app=80&f=JPEG&size=f121,90?sec=1880279984&t=5187e4ff1bd3bf1c36ce979a042325a8']"></el-image>

    <el-divider></el-divider>
    <el-form-item label="选集下载">
      <el-checkbox :indeterminate="isIndeterminate" v-model="checkAll" @change="handleCheckAllChange" style="float: left">全选</el-checkbox>
      <div style="margin: 15px 0;"></div>
      <el-checkbox-group v-model="form.cids" @change="handleCheckedCidChange">
        <el-checkbox v-for="item in cids" :label="item.cid" :key="item.cid">{{ item.part }} {{ item.duration | m }}</el-checkbox>
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
  let CIDS = []
  const GET_CID_URL = 'bilbil/get_cids'
  const VIDEO_DOWNLOAD_URL = 'bilbil/download'
  export default {
    data () {
      return {
        form: {
          a_id: '',
          cids: []
        },
        cids: CIDS,
        isIndeterminate: true,
        checkAll: false
      }
    },
    methods: {
      onSubmit () {
        this.$post(VIDEO_DOWNLOAD_URL, this.form).then(val => console.log(val))
      },
      handleCheckAllChange (val) {
        this.form.cids = val ? CIDS : []
        this.isIndeterminate = false
      },
      handleCheckedCidChange (value) {
        let checkedCount = value.length
        this.checkAll = checkedCount === this.form.cids.length
        this.isIndeterminate = checkedCount > 0 && checkedCount < this.form.cids.length
      },
      initVideoInfo () {
        this.$fetch(GET_VIDEO_INFO, {'a_id': this.form.a_id}).then(val => {
          this.cids = val
          CIDS = val.map(val => val.cid)
        })
      }
    },
    filters: {
      m (val) {
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
