/*=========================================================================================
  File Name: vue.config.js
  Description: configuration file of vue
  ----------------------------------------------------------------------------------------
  Item Name: "MyFreelancer.com"
  Author: "Ahsan Mahmood"
  Author URL: http://aoneahsan.website
==========================================================================================*/


module.exports = {
    publicPath: '/',
    transpileDependencies: [
      // 'vue-echarts',
      // 'resize-detector'
    ],
    configureWebpack: {
      optimization: {
        splitChunks: {
          chunks: 'all'
        }
      }
    }
    // devServer: {
    //   overlay: {
    //     warnings: true,
    //     errors: true
    //   }
    // }
  }