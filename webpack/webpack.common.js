import MiniCssExtractPlugin from 'mini-css-extract-plugin';
import CopyWebpackPlugin from 'copy-webpack-plugin';
// import TailwindCSS from '@tailwindcss/postcss7-compat'; // Update import
import fs from 'fs';
import path from 'path';

/**
 * Common configuration
 * @param {Object} config
 * @param {Object} process
 * @returns {Object}
 */
export const commonConfig = (config, process) => {
    console.log('process.custom', process.custom);

    /**
     * Get version from ShoplyticsDataLayerBoilerplateConfig.ts
     */
    const VERSION = process.custom.VERSION || '';
    const ENTRYPOINT = process.custom.ENTRYPOINT || 'none';

    /**
     * Define app directory
     */
    const appDirectory = fs.realpathSync(process.cwd());
    const resolveApp = (relativePath) => path.resolve(appDirectory, relativePath);

    /**
     * Define parameters
     */
    const mode = process.env.NODE_ENV;
    const lib = process.custom.lib
        ? process.custom.lib
        : config.library != ''
          ? config.library
          : undefined;

    let entrypoint;
    let outputDir;

    if (typeof config.entrypoints[ENTRYPOINT] === 'object') {
        entrypoint = config.entrypoints[ENTRYPOINT].entry;
        outputDir = config.entrypoints[ENTRYPOINT].outputDir;
    } else {
        entrypoint = config.entrypoints[ENTRYPOINT];
        outputDir = config.outputDir;
    }

    const entryFiles = Array.isArray(entrypoint) ? entrypoint : [entrypoint];
    const isStyleOnlyEntrypoint = entryFiles.every(
        (file) => typeof file === 'string' && /\.(sa|sc|c)ss$/i.test(file)
    );

    /**
     * Define common configuration
     */
    return {
        context: resolveApp(config.sourceDir),
        entry: { [ENTRYPOINT]: entrypoint },
        output: {
            filename: `js/[name]${VERSION == '' ? '' : '-' + VERSION}${mode == 'development' ? '.debug' : ''}.js`,
            devtoolModuleFilenameTemplate: 'webpack://[namespace]/[resource-path]?[loaders]',
            path: resolveApp(outputDir),
            // Example:
            // export const init = () => {}
            // Call: [lib].init();
            library: lib
                ? {
                      name: lib,
                      type: 'var',
                  }
                : undefined,
        },
        resolve: {
            symlinks: false,
            extensions: ['.js', '.jsx', '.ts', '.tsx'],
        },
        cache: {
            type: 'memory',
        },
        optimization: {
            splitChunks: {
                cacheGroups: {
                    styles: {
                        name: 'styles',
                        test: /\.css$/,
                        chunks: 'all',
                        enforce: true,
                    },
                },
            },
        },
        module: {
            rules: [
                {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    loader: 'babel-loader',
                },
                {
                    test: /\.ts?$/,
                    exclude: /node_modules/,
                    use: 'ts-loader',
                },
                {
                    test: /\.(sa|sc|c)ss$/,
                    use: [
                        MiniCssExtractPlugin.loader,
                        {
                            loader: 'css-loader',
                            options: {
                                importLoaders: 2,
                                url: false,
                                sourceMap: true,
                            },
                        },
                        {
                            loader: 'postcss-loader',
                            options: {
                                postcssOptions: {
                                    sourceMap: true,
                                    plugins: [
                                        'autoprefixer',
                                        'postcss-flexbugs-fixes',
                                        // TailwindCSS('./tailwind.config.cjs'), // Update path to .cjs file
                                    ],
                                    processCssUrls: false,
                                },
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
                {
                    test: /\.html$/,
                    use: 'html-loader',
                },
                {
                    test: /\.(woff2?|eot|ttf|otf)$/,
                    use: {
                        loader: 'file-loader',
                        options: {
                            publicPath: 'assets/fonts',
                            outputPath: 'assets',
                            name: '[path][name].[ext]',
                            esModule: false,
                        },
                    },
                },
                {
                    test: /\.(gif|ico|jpe?g|png|svg|webp)$/,
                    use: {
                        loader: 'file-loader',
                        options: {
                            publicPath: 'assets/images',
                            outputPath: 'assets',
                            name: '[path][name].[ext]',
                            esModule: false,
                        },
                    },
                },
            ],
        },
        plugins: [
            new MiniCssExtractPlugin({
                filename: 'css/[name].css',
                chunkFilename: 'css/[name].[id].css',
            }),
            {
                apply: (compiler) => {
                    compiler.hooks.emit.tap('RemoveEmptyJsAssetsPlugin', (compilation) => {
                        Object.keys(compilation.assets).forEach((assetName) => {
                            if (!assetName.endsWith('.js')) {
                                return;
                            }

                            const asset = compilation.assets[assetName];
                            const isEntrypointAsset = assetName.startsWith(`js/${ENTRYPOINT}-`);

                            if (
                                (isStyleOnlyEntrypoint && isEntrypointAsset) ||
                                asset.size() === 0
                            ) {
                                delete compilation.assets[assetName];
                            }
                        });
                    });
                },
            },
            new CopyWebpackPlugin({
                patterns: [
                    {
                        from: config.staticDir,
                        noErrorOnMissing: true,
                        globOptions: {
                            dot: true,
                            gitignore: false,
                            ignore: ['**/README.md'],
                        },
                    },
                ],
            }),
        ],
    };
};
