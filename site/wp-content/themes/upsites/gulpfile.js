var gulp = require('gulp');
var $ = require('gulp-load-plugins')();
var browserSync = require('browser-sync').create();

var webpack = require('webpack');
var webpackConfig = require('./webpack.config.js');
var bundler = webpack(webpackConfig);

var uglify = require('gulp-uglify');

var isWatching = false;

/**
 * SVG
 */
gulp.task('svg2png', function() {
  var svg = gulp.src(['./src/img/svg/*.svg']);

  svg
    .pipe($.changed('./assets/img/', { extension: '.png' }))
    .pipe($.svg2png())
    .pipe(gulp.dest('./assets/img/'));

  svg
    .pipe($.changed('./assets/img/'))
    .pipe($.svgmin())
    .pipe(gulp.dest('./assets/img/'));

  return svg;
});

/**
 * Icons
 */
gulp.task('svgicons', function() {
  var path = require('path');
  return gulp.src(['./src/img/icons/*.svg'])
    .pipe($.svgmin(function(file) {
      var prefix = path.basename(file.relative, path.extname(file.relative));
      return {
        plugins: [{
          removeAttrs: { attrs: 'fill' },
          cleanupIDs: {
            prefix: prefix + '-',
            minify: true
          }
        }]
      };
    }))
    .pipe($.svgstore())
    .pipe(gulp.dest('./assets/img/'));
});

/**
 * Sass
 */
gulp.task('sass', function() {
  return gulp.src(['./src/sass/main.scss'])
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: ['./node_modules/'],
        outputStyle: 'expanded'
      })
      .on('error', $.sass.logError)
    )
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
});
gulp.task('sasshome', function() {
  return gulp.src(['./src/sass/home.scss'])
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: ['./node_modules/'],
        outputStyle: 'expanded'
      })
      .on('error', $.sass.logError)
    )
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
});
gulp.task('sassstructure', function() {
  return gulp.src(['./src/sass/structure.scss'])
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: ['./node_modules/'],
        outputStyle: 'expanded'
      })
      .on('error', $.sass.logError)
    )
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
});
gulp.task('sasspostinternal', function() {
  return gulp.src(['./src/sass/post-internal.scss'])
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: ['./node_modules/'],
        outputStyle: 'expanded'
      })
      .on('error', $.sass.logError)
    )
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
});
gulp.task('sasssignaturesite', function() {
  return gulp.src(['./src/sass/signature-site.scss'])
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: ['./node_modules/'],
        outputStyle: 'expanded'
      })
      .on('error', $.sass.logError)
    )
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
});
gulp.task('sassshop', function() {
  return gulp.src(['./src/sass/shop.scss'])
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: ['./node_modules/'],
        outputStyle: 'expanded'
      })
      .on('error', $.sass.logError)
    )
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
});
gulp.task('sassseo', function() {
  return gulp.src(['./src/sass/seo.scss'])
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: ['./node_modules/'],
        outputStyle: 'expanded'
      })
      .on('error', $.sass.logError)
    )
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
});
gulp.task('sasschat', function() {
  return gulp.src(['./src/sass/chat.scss'])
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: ['./node_modules/'],
        outputStyle: 'expanded'
      })
      .on('error', $.sass.logError)
    )
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
});
gulp.task('sassportfolio', function() {
  return gulp.src(['./src/sass/portfolio.scss'])
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: ['./node_modules/'],
        outputStyle: 'expanded'
      })
      .on('error', $.sass.logError)
    )
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
});
gulp.task('sassblog', function() {
  return gulp.src(['./src/sass/blog.scss'])
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: ['./node_modules/'],
        outputStyle: 'expanded'
      })
      .on('error', $.sass.logError)
    )
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
});
gulp.task('sasspartners', function() {
  return gulp.src(['./src/sass/partners.scss'])
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: ['./node_modules/'],
        outputStyle: 'expanded'
      })
      .on('error', $.sass.logError)
    )
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
});
gulp.task('sasslandings', function() {
  return gulp.src(['./src/sass/landings.scss'])
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: ['./node_modules/'],
        outputStyle: 'expanded'
      })
      .on('error', $.sass.logError)
    )
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
});
gulp.task('sasscookies', function() {
  return gulp.src(['./src/sass/cookies.scss'])
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: ['./node_modules/'],
        outputStyle: 'expanded'
      })
      .on('error', $.sass.logError)
    )
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
});
gulp.task('sasssegments', function() {
  return gulp.src(['./src/sass/segments.scss'])
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: ['./node_modules/'],
        outputStyle: 'expanded'
      })
      .on('error', $.sass.logError)
    )
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
});
gulp.task('sasscases', function() {
  return gulp.src(['./src/sass/cases.scss'])
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: ['./node_modules/'],
        outputStyle: 'expanded'
      })
      .on('error', $.sass.logError)
    )
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
});
gulp.task('sasscasessingle', function() {
  return gulp.src(['./src/sass/single-cases.scss'])
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: ['./node_modules/'],
        outputStyle: 'expanded'
      })
      .on('error', $.sass.logError)
    )
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
});
gulp.task('sassglossary', function() {
  return gulp.src(['./src/sass/glossary.scss'])
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: ['./node_modules/'],
        outputStyle: 'expanded'
      })
      .on('error', $.sass.logError)
    )
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
});
gulp.task('sasssingleglossary', function() {
  return gulp.src(['./src/sass/single-glossary.scss'])
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: ['./node_modules/'],
        outputStyle: 'expanded'
      })
      .on('error', $.sass.logError)
    )
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
});



gulp.task('sass:release', ['sass'], function() {
  return gulp.src(['./assets/css/main.css'])
    .pipe($.autoprefixer(['last 2 versions', 'ie 8', 'ie 9', '> 1%']))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.cleanCss({ compatibility: 'ie8', processImport: false }))
    .pipe(gulp.dest('./assets/css/'));
});
gulp.task('sasshome:release', ['sasshome'], function() {
  return gulp.src(['./assets/css/home.css'])
    .pipe($.autoprefixer(['last 2 versions', 'ie 8', 'ie 9', '> 1%']))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.cleanCss({ compatibility: 'ie8', processImport: false }))
    .pipe(gulp.dest('./assets/css/'));
});
gulp.task('sassstructure:release', ['sassstructure'], function() {
  return gulp.src(['./assets/css/structure.css'])
    .pipe($.autoprefixer(['last 2 versions', 'ie 8', 'ie 9', '> 1%']))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.cleanCss({ compatibility: 'ie8', processImport: false }))
    .pipe(gulp.dest('./assets/css/'));
});
gulp.task('sasspostinternal:release', ['sasspostinternal'], function() {
  return gulp.src(['./assets/css/post-internal.css'])
    .pipe($.autoprefixer(['last 2 versions', 'ie 8', 'ie 9', '> 1%']))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.cleanCss({ compatibility: 'ie8', processImport: false }))
    .pipe(gulp.dest('./assets/css/'));
});
gulp.task('sasssignaturesite:release', ['sasssignaturesite'], function() {
  return gulp.src(['./assets/css/signature-site.css'])
    .pipe($.autoprefixer(['last 2 versions', 'ie 8', 'ie 9', '> 1%']))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.cleanCss({ compatibility: 'ie8', processImport: false }))
    .pipe(gulp.dest('./assets/css/'));
});
gulp.task('sassshop:release', ['sassshop'], function() {
  return gulp.src(['./assets/css/shop.css'])
    .pipe($.autoprefixer(['last 2 versions', 'ie 8', 'ie 9', '> 1%']))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.cleanCss({ compatibility: 'ie8', processImport: false }))
    .pipe(gulp.dest('./assets/css/'));
});
gulp.task('sassseo:release', ['sassseo'], function() {
  return gulp.src(['./assets/css/seo.css'])
    .pipe($.autoprefixer(['last 2 versions', 'ie 8', 'ie 9', '> 1%']))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.cleanCss({ compatibility: 'ie8', processImport: false }))
    .pipe(gulp.dest('./assets/css/'));
});
gulp.task('sasschat:release', ['sasschat'], function() {
  return gulp.src(['./assets/css/chat.css'])
    .pipe($.autoprefixer(['last 2 versions', 'ie 8', 'ie 9', '> 1%']))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.cleanCss({ compatibility: 'ie8', processImport: false }))
    .pipe(gulp.dest('./assets/css/'));
});
gulp.task('sassportfolio:release', ['sassportfolio'], function() {
  return gulp.src(['./assets/css/portfolio.css'])
    .pipe($.autoprefixer(['last 2 versions', 'ie 8', 'ie 9', '> 1%']))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.cleanCss({ compatibility: 'ie8', processImport: false }))
    .pipe(gulp.dest('./assets/css/'));
});
gulp.task('sassblog:release', ['sassblog'], function() {
  return gulp.src(['./assets/css/blog.css'])
    .pipe($.autoprefixer(['last 2 versions', 'ie 8', 'ie 9', '> 1%']))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.cleanCss({ compatibility: 'ie8', processImport: false }))
    .pipe(gulp.dest('./assets/css/'));
});
gulp.task('sasspartners:release', ['sasspartners'], function() {
  return gulp.src(['./assets/css/partners.css'])
    .pipe($.autoprefixer(['last 2 versions', 'ie 8', 'ie 9', '> 1%']))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.cleanCss({ compatibility: 'ie8', processImport: false }))
    .pipe(gulp.dest('./assets/css/'));
});
gulp.task('sasslandings:release', ['sasslandings'], function() {
  return gulp.src(['./assets/css/landings.css'])
    .pipe($.autoprefixer(['last 2 versions', 'ie 8', 'ie 9', '> 1%']))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.cleanCss({ compatibility: 'ie8', processImport: false }))
    .pipe(gulp.dest('./assets/css/'));
});
gulp.task('sasscookies:release', ['sasscookies'], function() {
  return gulp.src(['./assets/css/cookies.css'])
    .pipe($.autoprefixer(['last 2 versions', 'ie 8', 'ie 9', '> 1%']))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.cleanCss({ compatibility: 'ie8', processImport: false }))
    .pipe(gulp.dest('./assets/css/'));
});
gulp.task('sasssegments:release', ['sasssegments'], function() {
  return gulp.src(['./assets/css/segments.css'])
    .pipe($.autoprefixer(['last 2 versions', 'ie 8', 'ie 9', '> 1%']))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.cleanCss({ compatibility: 'ie8', processImport: false }))
    .pipe(gulp.dest('./assets/css/'));
});
gulp.task('sasscases:release', ['sasscases'], function() {
  return gulp.src(['./assets/css/cases.css'])
    .pipe($.autoprefixer(['last 2 versions', 'ie 8', 'ie 9', '> 1%']))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.cleanCss({ compatibility: 'ie8', processImport: false }))
    .pipe(gulp.dest('./assets/css/'));
});
gulp.task('sasscasessingle:release', ['sasscasessingle'], function() {
  return gulp.src(['./assets/css/single-cases.css'])
    .pipe($.autoprefixer(['last 2 versions', 'ie 8', 'ie 9', '> 1%']))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.cleanCss({ compatibility: 'ie8', processImport: false }))
    .pipe(gulp.dest('./assets/css/'));
});
gulp.task('sassglossary:release', ['sassglossary'], function() {
  return gulp.src(['./assets/css/glossary.css'])
    .pipe($.autoprefixer(['last 2 versions', 'ie 8', 'ie 9', '> 1%']))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.cleanCss({ compatibility: 'ie8', processImport: false }))
    .pipe(gulp.dest('./assets/css/'));
});
gulp.task('sasssingleglossary:release', ['sasssingleglossary'], function() {
  return gulp.src(['./assets/css/single-glossary.css'])
    .pipe($.autoprefixer(['last 2 versions', 'ie 8', 'ie 9', '> 1%']))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.cleanCss({ compatibility: 'ie8', processImport: false }))
    .pipe(gulp.dest('./assets/css/'));
});


gulp.task('js:release', function() {
  gulp.src(['./assets/js/bundle.js'])
    .pipe(uglify())
    .pipe($.rename({ suffix: '.min' }))
    .pipe(gulp.dest('./assets/js/')) // It will create folder client.min.js
});


/**
 * Javascript
 */
gulp.task('scripts', function(cb) {
  var handler = function(err, stats) {
    if (err) {
      throw new $.util.PluginError('webpack', err);
    }

    $.util.log('[webpack]', stats.toString('normal'));

    browserSync.reload(webpackConfig.output.filename);
  };

  if (isWatching) {
    bundler.watch(200, handler);
  } else {
    bundler.run(handler);
  }

  return cb();
});


/**
 * Live preview
 */
gulp.task('serve', function() {
  browserSync.init({
    open: false,
    server: {
      // proxy: 'framework.local.com',
      baseDir: './'
    }

  });
});


/**
 * Build
 */
gulp.task('build', [
  'sass', 
  'sasshome', 
  'sasspostinternal', 
  'sasssignaturesite', 
  'sassshop', 
  'sassseo', 
  'sasschat', 
  'sassportfolio', 
  'sassblog', 
  'sassstructure',
  'sasspartners',
  'sasslandings',
  'sasscookies',
  'sasssegments',
  'sasscases',
  'sasscasessingle',
  'sassglossary',
  'sasssingleglossary',
  
  'scripts'
], function() {
  $.util.log($.util.colors.green('Build is finished'));
});

gulp.task('build:min', function() {
  gulp.start(
    'sass:release', 
    'sasshome:release', 
    'sasspostinternal:release', 
    'sasssignaturesite:release', 
    'sassshop:release', 
    'sassseo:release', 
    'sasschat:release', 
    'sassportfolio:release', 
    'sassblog:release', 
    'sassstructure:release', 
    'sasspartners:release', 
    'sasslandings:release', 
    'sasscookies:release', 
    'sasssegments:release', 
    'sasscases:release', 
    'sasscasessingle:release',
    'sassglossary:release',
    'sasssingleglossary:release',
    'js:release'
  );
});

/**
 * Watch files
 */
gulp.task('watch', ['serve'], function() {
  isWatching = true;

  /* Watch htmls */
  gulp.watch('./*.html', { cwd: './' }).on('change', browserSync.reload);

  /* Watch styles */
  gulp.watch(['**/*.scss'], { cwd: './src/sass/' }, [
    'sass', 
    'sasshome', 
    'sasspostinternal', 
    'sasssignaturesite', 
    'sassshop', 
    'sassseo', 
    'sasschat', 
    'sassportfolio', 
    'sassblog', 
    'sassstructure',
    'sasspartners',
    'sasslandings',
    'sasscookies',
    'sasssegments',
    'sasscasessingle',
    'sasscases',
    'sassglossary',
    'sasssingleglossary'
  ]
).on('change', browserSync.reload);

  /* Watch SVG */
  gulp.watch(['*.svg'], { cwd: './src/img/icons/' }, ['svgicons']).on('change', browserSync.reload);
  gulp.watch(['*.svg'], { cwd: './src/img/svg/' }, ['svg2png']).on('change', browserSync.reload);
});

/**
 * Default task
 */
gulp.task('default', ['watch', 'build', 'svgicons']);