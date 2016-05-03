var ExtractTextPlugin = require("extract-text-webpack-plugin");
module.exports = {
    entry: "./mod/entry.js",
    output: {
        path: __dirname,
        filename: "./js/bundle.js"
    },
    module: {
        loaders: [
            {
                test: /\.html$/,
                loader: "html"
            },
            {
                test: /\.(scss|css)$/,
                loader: ExtractTextPlugin.extract("style-loader", "css-loader!sass")
            },
            {
                test: /\.png$/,
                loader: "url-loader?limit=100000"
            },
            {
                test: /\.jpg$/,
                loader: "file-loader"
            },
            {
                test: /\.(woff|woff2)(\?v=\d+\.\d+\.\d+)?$/,
                loader: 'url?limit=10000&mimetype=application/font-woff&name=/css/[name].[ext]'
            },
            {
                test: /\.ttf(\?v=\d+\.\d+\.\d+)?$/,
                loader: 'url?limit=10000&mimetype=application/octet-stream&name=/css/[name].[ext]'
            },
            {
                test: /\.eot(\?v=\d+\.\d+\.\d+)?$/,
                loader: 'file?&name=/css/[name].[ext]'
            },
            {
                test: /\.svg(\?v=\d+\.\d+\.\d+)?$/,
                loader: 'url?limit=10000&mimetype=image/svg+xml&name=/css/[name].[ext]'
            }
        ]
    },
    plugins: [
        new ExtractTextPlugin("./css/bundle.css", {
            allChunks: true
        })
    ],
    watch: true,
    watchOptions: {
      poll: true
  },
  devtool: 'source-map'
};
