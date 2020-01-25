
export default {
  mode: 'universal',
  /*
  ** Headers of the page
  */
  head: {
    title: process.env.npm_package_name || '',
    meta: [
      { charset: 'utf-8' },
      { name: 'bughello', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: process.env.npm_package_description || '' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },
  /*
  ** Customize the progress-bar color
  */
  loading: { color: '#fff' },
  /*
  ** Global CSS
  */
  css: [
    {src:'element-ui/lib/theme-chalk/index.css'}
  ],
  /*
  ** Plugins to load before mounting the App
  */
  plugins: [
    {src:'~plugins/element-ui', ssr: true},
    {src:'~plugins/axios', ssr: true},
    {src:'~plugins/http', ssr: true},
    {src:'~plugins/vue-extend', ssr: true}
  ],
  /*
  ** Nuxt.js dev-modules
  */
  buildModules: [
  ],
  /*
  ** Nuxt.js modules
  */
  modules: [
    '@nuxtjs/axios'
  ],
  axios: {
    debug: false,
//    baseURL:"http://127.0.0.1:9501/api/",
    proxy: true,
    prefix: '/api/',
    credentials: true
  },
  proxy: {
    '/api/': {
      target: 'http://127.0.0.1:9501/api/',
      pathRewrite: {
        '^/api/': '/',
        changeOrigin: true
      }
    }
  },


  build: {
    vendor: ['element-ui'],
    /*
    ** You can extend webpack config here
    */
    extend (config, ctx) {
    }
  },
}
