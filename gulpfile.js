const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const minifyCSS = require('gulp-minify-css');
const uglify = require('gulp-uglify');
const del = require('del');

const paths = {
  src: {
    sass: './src/sass/**/*.scss',
    js: './src/js/**/*.js',
  },
  dest: {
    css: './assets/css',
    js: './assets/js',
  },
};

// Tarefa para compilar arquivos SCSS para CSS e agrupá-los em um único arquivo
gulp.task('sass', function () {
  return gulp
    .src(paths.src.sass)
    .pipe(sass().on('error', sass.logError))
    .pipe(concat('style-all.min.css'))
    .pipe(minifyCSS())
    .pipe(gulp.dest(paths.dest.css));
});

// Tarefa para minificar arquivos JS
gulp.task('minify-js', function () {
  return gulp
    .src(paths.src.js)
    .pipe(uglify())
    .pipe(gulp.dest(paths.dest.js));
});

// Tarefa para limpar apenas os arquivos minificados na pasta de destino
gulp.task('clean', function () {
  return del([
    `${paths.dest.css}/*.min.css`,
    `${paths.dest.js}/*.min.js`,
    `!${paths.dest.css}/.gitkeep`,
    `!${paths.dest.js}/.gitkeep`,
  ]);
});

// Tarefa de watch para executar automaticamente as tarefas ao detectar mudanças nos arquivos
gulp.task('watch', function () {
  gulp.watch(paths.src.sass, gulp.series('sass'));
  gulp.watch(paths.src.js, gulp.series('minify-js'));
});

// Tarefa padrão (default) que é executada ao digitar apenas 'gulp' no terminal
gulp.task('default', gulp.series('clean', 'sass', 'minify-js', 'watch'));
