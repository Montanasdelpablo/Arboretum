const path = require('path'),
	MiniCSSExtractPlugin = require('mini-css-extract-plugin'),
	CleanWebpackPlugin = require('clean-webpack-plugin'),
	{ VueLoaderPlugin } = require('vue-loader'),
	swp = require('sw-precache-webpack-plugin');

module.exports = env => {
	return {
		entry: {
			'main': './resources/assets/js/main.js',
			'print': './resources/assets/scss/print.scss'
		},
		output: {
			path: __dirname,
			filename: './public/js/[name].js',
		},
		module: {
			rules: [
				{
					test: /\.js$/,
					exclude: ['/vendor/', '/node_modules/', '/public/', '/resources/assets/scss/'],
					use: [
						'babel-loader'
					]
				},
				{
					test: /\.vue$/,
					exclude: ['/vendor/', '/node_modules', '/public/', '/resources/assets/scss/'],
					loader: 'vue-loader',
				},
				{
					test: /\.css$/,
					exclude: ['/vendor/', '/node_modules', '/public/', '/resources/assets/js/'],
					oneOf: [
						{
							resourceQuery: '/module/',
							use: [
								'vue-style-loader',
								{
									loader: 'css-loader',
									options: {
										minimize: !env.dev,
										modules: true,
										localIdentName: '[local]_[hash:base64:8]'
									}
								}
							]
						},
						{
							use: [
								MiniCSSExtractPlugin.loader,
								{
									loader: 'css-loader',
									options: {
										minimize: !env.dev,
									}
								}
							]
						}
					]
				},
				{
					test: /\.styl$/,
					exclude: ['/vendor/', '/node_modules', '/public/', '/resources/assets/js/'],
					oneOf: [
						{
					 		resourceQuery: '/module/',
							use:[
								'vue-style-loader',
								{
									loader: 'css-loader',
									options: {
										minimize: !env.dev,
										modules: true,
										localIdentName: '[local]_[hash:base64:8]'
									}
								},
								'stylus-loader'
							]
						},
						{
							use: [
								MiniCSSExtractPlugin.loader,
								{
									loader: 'css-loader',
									options: {
										minimize: !env.dev,
									}
								},
								'stylus-loader'
							]
						}
					]
				},
				{
					test: /\.scss$/,
					exclude: ['/vendor/', '/node_modules', '/public/', '/resources/assets/js/'],
					oneOf: [
						{
							resourceQuery: '/module/',
							use: [
								'vue-style-loader',
								{
									loader: 'css-loader',
									options: {
										minimize: !env.dev,
										modules: true,
										localIdentName: '[local]_[hash:base64:8]'
									}
								},
								'sass-loader'
							]
						},
						{
							use: [
								MiniCSSExtractPlugin.loader,
								{
									loader: 'css-loader',
									options: {
										minimize: !env.dev,
									}
								},
								'sass-loader'
							]
						}
					]
				},
				{
					test: /\.(jpg|jpeg|gif|png|svg)$/,
					exclude: ['/node_modules/', '/public/'],
					use: [
						/*{
							loader: 'responsive-loader',
							options: {
								adapter: require('responsive-loader/sharp'),
								sizes: [600, 960, 1280, 1920],
								placeholder: true,
								placeholderSize: 50,
								outPath: '/public/images/[hash]-[width].[ext]',
								publicPath: '/images/[hash]-[width].[ext]'
							}
						},*/
						{
							loader: 'file-loader',
							options: {
								name: '[hash].[ext]',
								outputPath: '/public/images',
								publicPath: '/images',
							}
						}
					],
				},
			]
		},
		resolve: {
			extensions: ['.js', '.vue'],
			alias: {
				'@': path.resolve(__dirname, './resources/assets/js')
			}
		},
		plugins: [
			new VueLoaderPlugin(),
			new MiniCSSExtractPlugin( {filename: 'public/css/[name].css'}),
			new CleanWebpackPlugin(['./public/js', './public/fonts', './public/css'])
			/*new swp({
				cacheId: 'travel-app',
				filename: 'service-worker.js',
				minify: !env.dev,
				staticFileGlobs: [
					'public/**.{css,eot,svg,ttf,woff,woff2,js,html}',
					'https://maps.googleapis.com/maps/api/js?key=AIzaSyDuy_qF0zXiupeh0-NKW78LoCamYYFR6kU',
					'https://fonts.googleapis.com/icon?family=Material+Icons',
					'https://unpkg.com/vuetify/dist/vuetify.min.css',
					'/en',
					'/nl',
					'/'

				],
				handleFetch: true,
				stripPrefix: 'public',
				dynamicUrlToDependencies: {
					'/': ['resources/views/index.blade.php'],
				},
				runtimeCaching: [
					{
						urlPattern: /^https:\/\/fonts\.googleapis\.com\//,
						handler: 'cacheFirst'
					},
					{
						urlPattern: /^https:\/\/fonts\.gstatic\.com\//,
						handler: 'cacheFirst'
					},
					{
						urlPattern: /^https:\/\/maps\.gstatic\.com\//,
						handler: 'cacheFirst'
					},
					{
						urlPattern: /^https:\/\/unpkg\.com\//,
						handler: 'cacheFirst'
					},
					{
						urlPattern: /^https:\/\/travel\.dsuper\.nl\/api\//,
						handler: 'cacheFirst'
					},
					{
						urlPattern: /^https:\/\/images\.pexels\.com\//,
						handler: 'cacheFirst'
					}
				],
				staticFileGlobsIgnorePatterns: [/\.map$/, /mix-manifest\.json$/, /manifest\.json$/, /service-worker\.js$/],
			]})   */
		]
	}
};