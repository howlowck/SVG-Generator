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
        },
        replace: {
            version: {
                src: ['package.json', 'composer.json'],
                overwrite: true,
                replacements: [{
                    from: '0.0.1',
                    to: "0.0.1-dev"
                }]
            }
        },
        phpcs: {
            options: {
                standard: 'PSR1'
            },
            src: {
                dir: 'src'
            }
        }
    });

    grunt.loadNpmTasks('grunt-regarde');
    grunt.loadNpmTasks('grunt-exec');
    grunt.loadNpmTasks('grunt-text-replace');
    grunt.loadNpmTasks('grunt-phpcs');
    grunt.registerTask('test', ['regarde:phpunit']);
};