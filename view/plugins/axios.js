import axios from "../.nuxt/axios";
import Vue from 'vue'

export default function ({ $axios, redirect }) {

  $axios.onRequest(config => {
    config.headers['Content-Type'] = 'application/x-www-form-urlencoded'
  })
  $axios.onError(error => {
    const code = parseInt(error.response && error.response.status)
    switch( code){
      case 422:{
        console.log(422)
        Vue.prototype.$message({
          message: error.response.data,
          type: 'warning'
        });
        return new Promise(() => {});
      }
      case 201: {
        Vue.prototype.$message({
          message: error.response.data,
          type: 'warning'
        });
        return new Promise(() => {});
      }

    }

  })

  $axios.onResponse(response => {
      return response.data.data
  })

}
