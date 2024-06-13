const path = require("path");
const rules = require( './rules' )
const externals = require( './externals' )

module.exports = [
	{
		mode: "production",

		devtool: "cheap-module-source-map",

		entry: {
			'editor_blocks': path.resolve( __dirname, '../src/blocks.js' ),
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
						name: "editor_vendor",
						priority: 10,
						enforce: true,
					},
				},
			},
		},

		resolve: {
			alias: {
				"~berg": path.resolve(__dirname, "../src/"),
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
			frontend_blocks: path.resolve(__dirname, "../src/block-frontend.js"),
		},

		output: {
			filename: "[name].js",
			library: "[name]", // it assigns this module to the global (window) object
		},
		resolve: {
			alias: {
				"~berg": path.resolve(__dirname, "../src/"),
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
