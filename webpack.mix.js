let mix = require("laravel-mix");
let path = require("path");

require("./mix");

mix.setPublicPath("dist")
    .js("resources/js/field.js", "dist/js/gtmetrix.js")
    .sass("resources/sass/field.scss", "dist/css/gtmetrix.css")
    .vue({ version: 3 })
    .nova("marshmallow/gtmetrix");
