module.exports = function (grunt) {

	grunt.option('sass.includePaths', [
		'public/vendor/foundation/scss/',
		'public/vendor/fontawesome/scss/'
	]);
	grunt.option('sass.files', {
		// target:sources
		'public/css/app.css': 'app/frontend/scss/app.scss'
	});

	grunt.option('browserify.files', {
		// target:sources
		'public/js/app.js': 'app/frontend/js/app.js'
	});

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		sass: {
			dist: {
				options: {
					includePaths: grunt.option('sass.includePaths'),
					outputStyle: 'compressed',
					sourceComments: 'none'
				},
				files: grunt.option('sass.files')
			},
			dev: {
				options: {
					includePaths: grunt.option('sass.includePaths'),
					outputStyle: 'expanded',
					sourceMap: false
				},
				files: grunt.option('sass.files')
			}
		},


		browserify: {
			dist: {
				options: {
					transform: ['uglifyify']
				},
				files: grunt.option('browserify.files')
			},
			dev: {
				files: grunt.option('browserify.files')
			}
		},

		watch: {
			grunt: { files: ['Gruntfile.js'] },

			sass: {
				files: 'app/frontend/scss/**/*.scss',
				tasks: ['sass:dev']
			},

			js: {
				files: 'app/frontend/js/**/*.js',
				tasks: ['browserify:dev']
			},

			css: {
				files: Object.keys(grunt.option('sass.files')),
				options: {
					livereload: true
				}
			}
		}
	});

	grunt.loadNpmTasks('grunt-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-browserify');

	grunt.registerTask('default', ['sass:dev', 'browserify:dev', 'watch']);
	grunt.registerTask('build', ['sass:dist', 'browserify:dist']);
};
