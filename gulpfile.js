"use strict";

var gulp   = require ( 'gulp' ),
    rename = require ( 'gulp-rename' ),
    path   = require ( "path" ),
    slash  = require ( "gulp-slash" );

gulp.task ( 'default', function() {
    var filesToCopy = [
        { src: "node_modules/bootstrap/dist/js/bootstrap.min.js", dest: "web/js/bootstrap.min.js" },
        { src: "node_modules/bootstrap/dist/css/bootstrap.min.css", dest: "web/css/bootstrap.min.css" },
        { src: "node_modules/bootstrap/dist/css/bootstrap.min.css.map", dest: "web/css/bootstrap.min.css.map" },

        { src: "node_modules/tether/dist/js/tether.min.js", dest: "web/js/tether.min.js" },
        { src: "node_modules/tether/dist/css/tether.min.css", dest: "web/css/tether.min.css" },
        {
            src: "node_modules/tether/dist/css/tether-theme-arrows.min.css",
            dest: "web/css/tether-theme-arrows.min.css"
        },

        { src: "node_modules/font-awesome/css/font-awesome.min.css", dest: "web/css/font-awesome.min.css" },
    ];

    var dirsToCopy = [
        { src: "node_modules/font-awesome/fonts", dest: "web/fonts" }
    ];

    filesToCopy.forEach ( function( file ) {
        gulp
            .src ( file.src )
            .pipe ( rename ( path.basename ( file.dest ) ) )
            .pipe ( gulp.dest ( path.dirname ( file.dest ) ) )
            .pipe ( slash () ); //Normalize paths on Windows
    } );

    dirsToCopy.forEach ( function( dir ) {
        gulp
            .src ( dir.src + "/**" )
            .pipe ( gulp.dest ( dir.dest ) )
            .pipe ( slash () ); //Normalize paths on Windows
    } );
} );
