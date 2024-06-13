module.exports = [
	{
		test: /\.js$/,
		exclude: /(node_modules|bower_components)/,
		use: {
			loader: 'babel-loader',
			options: {
				// presets: ['es2015'],
				// Cache compilation results in ./node_modules/.cache/babel-loader/
				cacheDirectory: true,
				plugins: [
					'@babel/plugin-proposal-class-properties',
					'@babel/plugin-transform-destructuring',
					'@babel/plugin-proposal-object-rest-spread',
					'@babel/plugin-proposal-optional-chaining',
					[
						'@babel/plugin-transform-react-jsx',
						{
							pragma: 'wp.element.createElement',
						},
					]
				]
			}
		}
	}
]
