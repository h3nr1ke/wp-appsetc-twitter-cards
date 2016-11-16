/**
 * @author  Henrique Deodato <h3nr1ke@gmail.com>
 * 
 */
'use strict';

var path = require('path');

module.exports = function(grunt) {

  grunt.initConfig({
        
    //task to generate the css files...
    less: {
      public: {
        options : {
          paths: ['less'],
          compress : true
        },
        files: {
          'style.admin.min.css': 'less/style.admin.less'
        }
      }
    }

  });
  
  grunt.loadNpmTasks('grunt-contrib-less');

};
