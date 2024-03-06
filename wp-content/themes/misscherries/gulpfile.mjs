import dotenv from 'dotenv';
dotenv.config();

import gulp from 'gulp';
import gulpAutoprefixer from 'gulp-autoprefixer';
import gulpClean from 'gulp-clean';
import gulpConcat from 'gulp-concat';
import gulpNotify from 'gulp-notify';
import gulpPlumber from 'gulp-plumber';
import gulpRename from 'gulp-rename';
import gulpSass from 'gulp-sass';
import gulpSassLint from 'gulp-sass-lint';
import gulpTerser from 'gulp-terser';

import * as dartSass from 'sass';
import child_process from 'child_process';
import browserSyncModule from 'browser-sync';
import fs from 'fs';

// Set configuration
const config = JSON.parse(fs.readFileSync('./config.json', { encoding: 'utf8', flag: 'r' }));
config.environment = process.env.NODE_ENV || 'production';
config.devUrl = process.env.DEVELOPMENT_URL || "",
config.php = {
    composer: process.env.PHP_COMPOSER_EXECUTABLE || 'composer',
    exec: process.env.PHP_EXECUTABLE || 'php',
};

const exec = child_process.exec;
const plugins = {
    autoprefixer: gulpAutoprefixer,
    clean: gulpClean,
    concat: gulpConcat,
    notify: gulpNotify,
    plumber: gulpPlumber,
    rename: gulpRename,
    sass: gulpSass,
    sassLint: gulpSassLint,
    terser: gulpTerser,
    sass: gulpSass(dartSass),
};
const browserSync  = browserSyncModule.create();

const sassLintHandler = function(err) {
    plugins.notify.onError({
        title: "SCSS Linter failed!",
        message: "<%= error.message %>",
    })(err);
    this.emit('end');
};

const buildSass =  env => {
    return gulp.src(config.sassPath + '/**/*.scss')
        .pipe(plugins.sassLint({ config: '.sass-lint.yml' }))
        .pipe(plugins.sassLint.format())
        .pipe(plugins.plumber({errorHandler: sassLintHandler }))
        .pipe(plugins.sassLint.failOnError())
        .pipe(plugins.plumber.stop())
        .pipe(plugins.sass({
            outputStyle: env === 'production' ? 'compressed' : 'expanded',
            includePaths:[
                ...config.vendor.sass,
                config.sassPath,
            ],
            errLogToConsole: true
        }).on('error', plugins.notify.onError(error => {
            if (env === 'production') {
                process.exitCode = 1;
            }
            return "Error: " + error.message;
        })))
        .pipe(plugins.autoprefixer('last 10 version'))
        .pipe(gulp.dest( config.destPath + '/css' ))
        .pipe(browserSync.stream());
};

gulp.task('buildDev:sass', () => { return buildSass(process.env.NODE_ENV); } );
gulp.task('build:sass', () => { return buildSass("production"); } );

gulp.task('build:css', (done) => {
    if (config.vendor.css.length === 0) {
        done();
        return;
    }
    return gulp.src([
        ...config.vendor.css
    ])
    .pipe(plugins.concat('vendor.css'))
    .pipe(gulp.dest(config.destPath + '/css'))
    .pipe(browserSync.stream());
});

gulp.task('build:javascript', () => {
    return gulp.src([
        ...config.vendor.js,
        config.jsPath + '/vendor/**/*.js',
        config.jsPath + '/**/_*.js',
        config.jsPath + '/**/*.js',
        config.jsPath + '/_*.js',
        config.jsPath + '/*.js',
    ])
    .pipe(plugins.concat('main.js'))
    .pipe(gulp.dest(config.destPath + '/js'))
    .pipe(plugins.rename('main.min.js'))
    .pipe(plugins.terser(config.uglify.front))
    .pipe(gulp.dest(config.destPath + '/js'));
});

gulp.task('build:javascriptadmin', () => {
    return gulp.src([
        config.jsAdminPath + '/**/_*.js',
        config.jsAdminPath + '/**/*.js',
        config.jsAdminPath + '/_*.js',
        config.jsAdminPath + '/*.js',
    ])
    .pipe(plugins.concat('admin.js'))
    .pipe(gulp.dest(config.destPath + '/js'))
    .pipe(plugins.rename('admin.min.js'))
    .pipe(plugins.terser(config.uglify.admin))
    .pipe(gulp.dest(config.destPath + '/js'));
});

gulp.task('build:javascriptlogin', () => {
    return gulp.src([
        config.jsLoginPath + '/**/_*.js',
        config.jsLoginPath + '/**/*.js',
        config.jsLoginPath + '/_*.js',
        config.jsLoginPath + '/*.js',
    ])
    .pipe(plugins.concat('login.js'))
    .pipe(gulp.dest(config.destPath + '/js'))
    .pipe(plugins.rename('login.min.js'))
    .pipe(plugins.terser(config.uglify.login))
    .pipe(gulp.dest(config.destPath + '/js'));
});

gulp.task('build:vendor', () => {
    return gulp.src([
        config.vendorPath + '/**/*',
    ])
    .pipe(gulp.dest(config.destPath + '/vendor' ));
});

gulp.task('build:image', () => {
    return gulp.src([
        config.imgPath + '/**/*'
    ])
    .pipe(gulp.dest(config.destPath + '/img'));
});

gulp.task('build:fonts', () => {
    return gulp.src([
        ...config.vendor.fonts,
        config.fontPath + '/**/*'
    ])
    .pipe(gulp.dest(config.destPath + '/fonts'));
});

gulp.task('clean', function () {
    return gulp.src([
            config.destPath
        ], { read: false, allowEmpty: true })
    .pipe(plugins.clean());
});

gulp.task('install:composer', (done) => {
    exec(`${config.php.composer} install`, (error) => {
        if(error) {
            done(error);
        } else {
            done();
        }
    });
});

gulp.task('install:composer:pro', (done) => {
    exec(`${config.php.composer} install --no-dev`, (error) => {
        if(error) {
            done(error);
        } else {
            done();
        }
    });
});

gulp.task('execute:phpstan', (done) => {
    exec(`${config.php.exec} ./vendor/bin/phpstan analyze -c phpstan.neon`, (error, stdout) => {
        if(error) {
            console.error(stdout);
            plugins.notify().write('PHP Code has some bugs', 'utf-8');
            done(new Error('PHP Code has some bugs'));
        } else {
            done();
        }
    });
});

gulp.task('execute:php', gulp.series('execute:phpstan'));

gulp.task('php:test', gulp.series('install:composer', 'execute:php' ));
gulp.task('php:pro', gulp.series('install:composer:pro'));

gulp.task('watch', function(){
    browserSync.init({
      files: [
          '{inc,lib,templates}/**/*.php',
          '*.php',
          config.destPath + '**/*'
        ],
      proxy: config.devUrl,
      snippetOptions: {
        whitelist: ['/wp-admin/admin-ajax.php'],
        blacklist: ['/wp-admin/**']
      },
    });
    gulp.watch([
        '{inc,lib,templates}/**/*.php',
        '*.php',
      ], gulp.series('execute:php'));
    gulp.watch(config.sassPath + '/**/*.scss', gulp.series('buildDev:sass'));
    gulp.watch(config.jsPath + '/**/*.js', gulp.series('build:javascript'));
    gulp.watch(config.jsAdminPath + '/**/*.js', gulp.series('build:javascriptadmin'));
    gulp.watch(config.jsLoginPath + '/**/*.js', gulp.series('build:javascriptlogin'));
    gulp.watch(config.imgPath + '/**/*', gulp.series('build:image'));
    gulp.watch(config.fontPath + '/**/*', gulp.series('build:fonts'));
    gulp.watch(config.vendorPath + '/**/*', gulp.series('build:vendor'));
    gulp.watch(config.destPath + "/**/{*.css,*.js}").on('change', browserSync.reload);
});

gulp.task('build:watch', gulp.series('php:test', 'build:javascriptadmin', 'build:javascriptlogin', 'buildDev:sass', 'build:css', 'build:fonts', 'build:javascript', 'build:image', 'build:vendor', 'watch'));

gulp.task('build:dev',  gulp.series('clean', 'php:test', 'buildDev:sass', gulp.parallel('build:javascriptadmin', 'build:javascriptlogin', 'build:css', 'build:fonts', 'build:javascript', 'build:image', 'build:vendor')));

gulp.task('build:pro',  gulp.series('clean', 'php:pro', 'build:sass', gulp.parallel('build:javascriptadmin', 'build:javascriptlogin', 'build:css', 'build:fonts', 'build:javascript', 'build:image', 'build:vendor')));



gulp.task('test', gulp.series('php:test'));
gulp.task('default', gulp.series('build:pro'));
