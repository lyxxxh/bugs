const Qs = require('qs');
let fetch = function(url, params) {
  return this.$axios.get(url, params);
}

let post = function (url, params) {
  return this.$axios.post(url,
    Qs.stringify(params)
  );
}

export  { fetch,post }
