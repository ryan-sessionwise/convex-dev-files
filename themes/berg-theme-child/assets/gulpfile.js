"use strict";
const gulp = require("gulp"),
  autoprefixer = require("autoprefixer"),
  concat = require("gulp-concat"),
  path = require("path"),
  postcss = require("gulp-postcss"),
  sass = require("gulp-sass"),
  sourcemaps = require("gulp-sourcemaps");

sass.compiler = require("node-sass");

// Initializing options and paths
const postCSSOptions = [autoprefixer()],
  scssFiles = ["./scss/**"],
  scssCustomPath = "./scss/style.scss",
  scssOutputPath = "../dist/css/",
  scssMapPath = "../css/";

// compress style scss to dist
gulp.task("scss", function () {
  return gulp
    .src([path.resolve(__dirname, scssCustomPath)])
    .pipe(sourcemaps.init())
    .pipe(sass({ outputStyle: "compressed" }).on("error", sass.logError))
    .pipe(postcss(postCSSOptions))
    .pipe(concat("style.css"))
    .pipe(sourcemaps.write(scssMapPath))
    .pipe(gulp.dest(scssOutputPath));
});

gulp.task("run", gulp.series("scss"));

// watch the tasks
gulp.task("scss-watch", function () {
  gulp.watch(scssFiles, gulp.series("scss"));
});

gulp.task("watch", gulp.series("run", "scss-watch"));
