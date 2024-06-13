const webpack = require("webpack"),
    CopyWebpackPlugin = require("copy-webpack-plugin");

module.exports = [
    new webpack.ProvidePlugin({
        $: "jquery",
        jQuery: "jquery",
        "window.jQuery": "jquery",
        _: "underscore",
        "window.Isotope": "Isotope",
    }),
    new webpack.SourceMapDevToolPlugin({ filename: "[name].js.map" }),
    new CopyWebpackPlugin({
        patterns: [
            { from: "./images", to: "../images/" },
            { from: "./fonts", to: "../fonts/" },
        ],
        options: {
            concurrency: 100,
        },
    }),
];
