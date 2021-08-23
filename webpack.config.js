const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
var path = require('path');

const appname = 'friendlyrobot';

// change these variables to fit your project
const publicPath = './theme/dist';
const jsPath= './theme/src/js';
const cssPath = './theme/src/scss';
const outputPath = 'theme/dist';
const localDomain = 'http://localhost/' + appname;
const entryPoints = {
  // 'app' is the output name, people commonly use 'bundle'
  // you can have more than 1 entry point

   [appname + "_footer"] : jsPath + "/footer.js",
   [appname + "_js"] : jsPath + "/app.js",
   [appname] : cssPath + "/style.scss"
};

module.exports = {
  entry: entryPoints,
  output: {
    path: path.resolve(__dirname, outputPath),
    filename: 'js/[name].js',
  },
  devtool: 'inline-source-map',
  plugins: [
    new MiniCssExtractPlugin({
      filename:'/css/[name].css',
    }),
    // Uncomment this if you want to use CSS Live reload
    /*
    new BrowserSyncPlugin({
      proxy: localDomain,
      files: [ outputPath + '/*.css' ],
      injectCss: true,
    }, { reload: false, }),
    */
  ],
  module: {
    rules: [  
      {
        //test: /\.m?js$/,
        test: /\.(js|mjs|jsx|ts|tsx)$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env']
          }
        }
      }, 
      /*     
      {
        test: /\.s?[c]ss$/i,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          'sass-loader'
        ]
      },
      */
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
         // MiniCssExtractPlugin.loader,
          MiniCssExtractPlugin.loader,
          'css-loader',
          'sass-loader'
        ]
      },
      /*
      {
        test: /\.sass$/i,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          {
            loader: 'sass-loader',
            options: {
              url: false, 
              sourceMap: true,
              sassOptions: { indentedSyntax: true }
            }
          }
        ]
      },
      */
      {
        test: /\.(jpg|jpeg|png|gif|woff|woff2|eot|ttf|svg)$/i,
        loader: 'file-loader',
        options:{
          name: "[name].[ext]",
          outputPath: "img/",
          useRelativePaths: true,
          esModule: false,
        }
      }
      
    ]
  }
};