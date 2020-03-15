// generated on 2019-10-09 using generator-webapp 4.0.0-5
const { src, dest, watch, series, parallel, lastRun } = require('gulp');
const gulpLoadPlugins = require('gulp-load-plugins');
const browserSync = require('browser-sync');
const del = require('del');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const { argv } = require('yargs');
const commonjs = require('rollup-plugin-commonjs');
const nodeResolve = require('rollup-plugin-node-resolve');
const optimizeJs = require('rollup-plugin-optimize-js');
const { uglify } = require('rollup-plugin-uglify');
const babelRollup = require('rollup-plugin-babel');

const $ = gulpLoadPlugins();
const server = browserSync.create();

const port = argv.port || 9000;

const isProd = process.env.NODE_ENV === 'production';
const isTest = process.env.NODE_ENV === 'test';
const isDev = !isProd && !isTest;

function styles() {
  return src('theme/source/styles/*.scss')
    .pipe($.plumber())
    .pipe($.if(!isProd, $.sourcemaps.init()))
    .pipe($.sass.sync({
      outputStyle: 'expanded',
      precision: 10,
      includePaths: ['.']
    }).on('error', $.sass.logError))
    .pipe($.postcss([
      autoprefixer()
    ]))
    .pipe($.if(!isProd, $.sourcemaps.write()))
    .pipe(dest('theme/dist/styles'))
    .pipe(server.reload({stream: true}));
}

const rollupPlugins = [
  commonjs(),
  nodeResolve(),
  babelRollup({
    "presets": [
      "@babel/preset-env"
    ]
  }),
];

if (isProd) {
  rollupPlugins.push( uglify({
    compress: {
      drop_console: true
    }}) );
  rollupPlugins.push( optimizeJs());
}

function scripts() {
  return src('theme/source/scripts/*.js')
    .pipe($.plumber())
    .pipe($.if(!isProd, $.sourcemaps.init()))
    .pipe($.betterRollup({
        plugins: rollupPlugins
      },
      'iife'))
    .pipe($.if(!isProd, $.sourcemaps.write('.')))
    .pipe(dest('theme/dist/scripts'))
    .pipe(server.reload({stream: true}));
}

function images() {
  return src('theme/source/images/**/*', {since: lastRun(images)})
    .pipe($.if(isProd, $.imagemin()))
    .pipe(dest('theme/dist/images'));
}

function fonts() {
  return src('theme/source/fonts/**/*.{eot,svg,ttf,woff,woff2}')
    .pipe(dest('theme/dist/fonts'));
}

function clean() {
  return del(['.tmp', 'dist'])
}

function measureSize() {
  return src('theme/dist/**/*')
    .pipe($.size({title: 'build', gzip: true}));
}

function startAppServer() {
  // server.init({
  //   proxy: 'http://dev.run.local/',
  //   notify: false,
  // });

  watch([
    'templates/**/*.twig',
    'theme/source/images/**/*',
    'theme/source/fonts/**/*'
  ]).on('change', server.reload);

  watch('theme/source/styles/**/*.scss', styles);
  watch('theme/source/scripts/**/*.js', scripts);
  watch('theme/source/fonts/**/*', fonts);
}

const build = series(
  clean,
  parallel(
    series(parallel(styles, scripts)),
    images,
    fonts,
  ),
  measureSize
);

let serve;
if (isDev) {
  serve = series(clean, parallel(styles, scripts, fonts, images), startAppServer);
} else if (isTest) {
  serve = series(clean, scripts);
} else if (isProd) {
  serve = series(build);
}

exports.serve = serve;
exports.build = build;
exports.default = build;
