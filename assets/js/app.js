/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
 

// any CSS you require will output into a single css file (app.css in this case)
require('../css/bulma.css');
require('../css/style.css');
require('../css/classic.css');
//require('../css/default.css');
require('../css/default.date.css');
require('../css/tinycarousel.css');
require('../scripts/jquery.tinycarousel.js');
$(document).ready(function(){
$('#slider1').tinycarousel();	
})

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
