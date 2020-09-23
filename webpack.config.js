module.exports = {
  entry: "./scripts/main.js",
  mode: "development",
  output: {
    filename: "./main.js",
  },
  module: {
    rules: [
      {
        test: /\.m?js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: "babel-loader",
        },
      },
    ],
  },
};
