module.exports = {
    debug: true,
    externals: { jquery: "jQuery" },

    entry: './res/js/entry.ts',
    output: {
        path: __dirname + "/web",
        filename: 'js/app.js'
    },
    module: {
        loaders: [
            // note that babel-loader is not required
            { test: /\.tsx?$/, loader: 'ts-loader' }
        ]
    }
};