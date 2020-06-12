const webpack = require('webpack');
const HtmlWebPackPlugin = require("html-webpack-plugin");
const path = require('path');

const htmlPlugin = new HtmlWebPackPlugin({
    template: path.resolve(__dirname, "./src/templates/index.html"),
    filename: "./index.html"
});

module.exports = {
    entry: path.resolve(__dirname, './src/web/assets/js/index.js'),
    output: {
        filename: 'bundle.js',
        path: path.resolve(__dirname, './src/assets/dist')
    },
    mode: 'development',
    devtool: 'inline-source-map',
    performance: {
        hints: false,
    },
    module: {
        rules: [
            // for graphql module, which uses mjs still
            {
                type: 'javascript/auto',
                test: /\.mjs$/,
                use: [],
                include: /node_modules/,
            },
            {
                test: /\.(js|jsx)$/,
                use: [
                    {
                        loader: 'babel-loader',
                        options: {
                            presets: [
                                ['@babel/preset-env', { modules: false }],
                                '@babel/preset-react',
                            ],
                        },
                    },
                ],
            },
            {
                test: /\.css$/,
                use: ['style-loader', 'css-loader'],
            },
            {
                test: /\.svg$/,
                use: [{ loader: 'svg-inline-loader' }],
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/,
                use: ['file-loader'],
            },
        ],
    },
    resolve: {
        extensions: ['.js', '.json', '.jsx', '.css', '.mjs'],
    },
    plugins: [
        htmlPlugin,
        new webpack.HotModuleReplacementPlugin()
    ],
    devServer: {
        hot: true,
        // bypass simple localhost CORS restrictions by setting
        // these to 127.0.0.1 in /etc/hosts
        allowedHosts: ['local.craftvue.com', 'graphiql.com'],
        contentBase: path.resolve(__dirname, './src/web/assets/dist'),
        historyApiFallback: true,
    },
    node: {
        fs: 'empty',
        module: 'empty',
    },
};