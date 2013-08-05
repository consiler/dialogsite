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
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.registerTask('default', ['recess']);
  grunt.registerTask('dev', ['watch']);
};