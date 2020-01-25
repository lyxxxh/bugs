import Vue from 'vue'
import { fetch, post }  from './http'


Vue.prototype.$fetch = fetch
Vue.prototype.$post = post

Vue.prototype.toUrl = function (url)
{
  //如果拦截
 if(! url.substr(0,7).toLowerCase() == "http://" || url.substr(0,8).toLowerCase() == "https://")
   url = "http://"+url;
  window.open(url);
}
