module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    recess: {
      dist: {
        options: {
          compile: true
        },
        files: {
          'css/main.min.css': [
            'css/less/app.less'
          ]
        }
      }
    },
    jade: {
      compile: {
          options: {
            pretty: true,
            data: {
              debug: false
            }
          },
          files: {
            "front-page.php": ["jade/front-page.jade"]
          }
        }
      },
    watch: {
      less: {
        files: [
          'css/less/*.less'
        ],
        tasks: ['recess']
      },
    },
  });

  grunt.loadTasks('tasks');
  grunt.loadNpmTasks('grunt-recess');
  grunt.loadNpmTasks('grunt-contrib-jade');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.registerTask('default', ['jade', 'recess']);
  grunt.registerTask('dev', ['watch']);
};
