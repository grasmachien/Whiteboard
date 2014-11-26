var gulp = require('gulp'),
	browserify = require('browserify'),
	source = require('vinyl-source-stream'),
	gutil = require('gulp-util'),
	jshint = require('gulp-jshint'),
	uglify = require('gulp-uglify');
	compass = require('gulp-compass');

gulp.task('scripts', function(){ 
	var bundler = browserify({
		entries: ['./js/src/script.js'] 
	});
	return bundler.bundle()
		// als er errors zijn: log de error, en laat verder gulp runnen
		.on('error', function(err) {
			console.log(err.message);
			gutil.beep(); 
			this.emit('end');
		})
		
	.pipe(source('script.dist.js')) 
	.pipe(gulp.dest('./js'));

});

gulp.task('lint', function(){
	return gulp.src('./js/src/**/*.js')
		.pipe(jshint())
		.pipe(jshint.reporter('jshint-stylish'));
});

gulp.task('compress', function (){
	gulp.src('./js/script.dist.js')
		.pipe(uglify())
		.pipe(gulp.dest('js'))
});


gulp.task('default', function (){
	var watcher = gulp.watch(['js/src/**/*.js'], ['lint', 'scripts']);
		gulp.watch('./_scss/src/*.scss', ['compass']);

});

gulp.task('compass', function() {
	    console.log('compasssss');
  gulp.src('_scss/src/*.scss')
    .pipe(compass({
      config_file: 'config.rb',
      css: 'css',
      sass: '_scss'
    }))
    .pipe(gulp.dest('app/assets/temp'));
});