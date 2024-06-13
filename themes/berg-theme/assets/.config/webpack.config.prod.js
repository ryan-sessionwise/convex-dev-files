const path = require("path"),
  glob = require("glob"),
  rules = require("./rules"),
  plugins = require("./plugins");

module.exports = [
  {
    mode: "production",
    watch: false,
    watchOptions: {
      ignored: ["./*", "vendor", "inc", "node_modules"],
    },
    entry: {
      vendor: glob.sync("./js/vendor/*[^slick].js"),
      main: glob.sync("./js/**/*.js", {
        ignore: ["./js/vendor/**", "./js/admin/**"],
      }),
      admin_scripts: path.resolve(__dirname, "../js/admin/index.js"),
    },
    output: {
      filename: "[name].js",
      path: path.resolve(__dirname, "../../dist/js"),
    },
    // Clean up build output
    stats: {
      all: false,
      assets: true,
      colors: true,
      errors: true,
      performance: true,
      timings: true,
      warnings: true,
    },
    module: {
      strictExportPresence: true,
      rules,
    },
    plugins: plugins,
  },
];
