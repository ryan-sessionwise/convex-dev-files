const path = require("path");
const rules = require( './rules' )
const externals = require( './externals' )

module.exports = [
	{
		mode: "development",

		devtool: "cheap-module-source-map",

		entry: {
			editor_blocks_custom: path.resolve(__dirname, "../src/blocks.js"),
		},

		output: {
			filename: "[name].js",
			library: "[name]", // it assigns this module to the global (window) object
		},
		// Permit importing @wordpress/* packages.
		externals,
		optimization: {
			splitChunks: {
				cacheGroups: {
					vendor: {
						test: /node_modules/,
						chunks: "initial",
						name: "editor_vendor_custom",
						priority: 10,
						enforce: true,
					},
				},
			},
		},

		resolve: {
			alias: {
				"~bergcustom": path.resolve(__dirname, "../src/"),
			},
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
	},
	{
		mode: "production",

		devtool: "cheap-module-source-map",

		entry: {
			frontend_blocks_custom: path.resolve(__dirname, "../src/block-frontend.js"),
		},

		output: {
			filename: "[name].js",
			library: "[name]", // it assigns this module to the global (window) object
		},
		resolve: {
			alias: {
				"~bergcustom": path.resolve(__dirname, "../src/"),
			},
		},
		// Permit importing @wordpress/* packages.
		externals,
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
	},
];
