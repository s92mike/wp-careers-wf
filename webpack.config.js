const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const path = require( 'path' );

module.exports = ( env ) => {
	return {
		entry: {
			'bl-careers-webflow': './src/index.js',
		},
		mode: env.mode,
		devtool: env.mode === 'development' ? 'source-map' : false,
		output: {
			filename: '[name].js',
			path: path.resolve( __dirname, 'dist' ),
			clean: true,
		},
		module: {
			rules: [
				{
					test: /\.(js|jsx)$/,
					exclude: /(node_modules|bower_components)/,
					loader: 'babel-loader',
					options: {
						presets: [ '@babel/preset-env', '@babel/preset-react' ],
					},
				},
				{
					test: /\.scss$/,
					exclude: /(node_modules|bower_components)/,
					use: [
						{
							loader: MiniCssExtractPlugin.loader,
						},
						{
							loader: 'css-loader',
							options: {
								sourceMap: true,
							},
						},
						{
							loader: 'sass-loader',
							options: {
								sourceMap: true,
							},
						},
					],
				},
			],
		},
		plugins: [ new MiniCssExtractPlugin() ],
		resolve: {
			extensions: [ '.js', '.jsx' ],
		},
		externals: {
			react: 'React',
			'react-dom': 'ReactDOM',
		},
	};
};
