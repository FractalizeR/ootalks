var webpack = require ( 'webpack' );

module.exports = {
    debug: true,
    cache: true,

    externals: {
        jquery: "jQuery"
    },

    entry: "./res/js",
    output: {
        path: __dirname + "/web",
        filename: 'js/app.js'
    },
    module: {
        loaders: [
            {
                test: /.js$/,
                loader: 'babel?presets[]=es2015&cacheDirectory=true',
                exclude: /(node_modules|bower_components)/
            }
        ]
    },
    plugins: [
        new webpack.optimize.UglifyJsPlugin ( { "screw-ie8": true, "compress": true } )
    ],
    devtool: 'source-map'
};