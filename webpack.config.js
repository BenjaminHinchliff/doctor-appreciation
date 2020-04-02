const path = require('path');

const commonRules = {
  test: /\.(scss)$/,
  use: [
    {
      // Adds CSS to the DOM by injecting a `<style>` tag
      loader: 'style-loader',
    },
    {
      // Interprets `@import` and `url()` like `import/require()` and will resolve them
      loader: 'css-loader',
    },
    {
      // Loader for webpack to process CSS with PostCSS
      loader: 'postcss-loader',
      options: {
        plugins: function load() {
          return [
            // eslint-disable-next-line global-require
            require('autoprefixer'),
          ];
        },
      },
    },
    {
      // Loads a SASS/SCSS file and compiles it to CSS
      loader: 'sass-loader',
    },
  ],
};

const common = {
  module: {
    rules: [
      commonRules,
      {
        test: /\.(png|svg|jpg|gif)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              outputPath: 'images/',
            },
          },
        ],
      },
    ],
  },
};

const user = {
  entry: {
    index: './src/index.js',
    add: './src/add.js',
  },
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: '[name].bundle.js',
  },
  ...common,
};

const admin = {
  entry: './src/admin.js',
  output: {
    path: path.resolve(__dirname, 'dist', 'administrator'),
    filename: 'admin.bundle.js',
  },
  ...common,
};

module.exports = [
  user,
  admin,
];
