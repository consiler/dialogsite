module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    recess: {
      dist: {
        options: {
          compile: true
        },
        files: {
          'css/main.css': [
            'css/lib/*.less'
          ]
        }
      }
    },
    watch: {
      less: {
        files: [
          'css/lib/*.less'
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
