/*global module*/
module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        regarde: {
            phpunit: {
                files: ['**/*.php'],
                tasks: ['exec:phpunit'],
                spawn: false
            }
        },
        exec: {
            phpunit: {
                command: 'phpunit',
                stdout: true,
                stderr: true
            }
        }
    });

    grunt.loadNpmTasks('grunt-regarde');
    grunt.loadNpmTasks('grunt-exec');
    grunt.registerTask('test', ['regarde:phpunit']);
};