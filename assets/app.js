/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

require("bootstrap");
// any CSS you import will output into a single css file (app.css in this case)
import "./styles/app.scss";
import "./styles/bootstrap.min.css";
import "./styles/bootstrap-icons.css";
import "./styles/glightbox.min.css";
import "./styles/main.css";
import "./axentix.min.css";

// start the Stimulus application
// import './bootstrap';

import "./js/bootstrap.bundle.min.js";
import "./js/main.js";
import "./js/vanilla-tilt.babel.min.js";
import "./js/axentix.min.js";

const $ = require("jquery");
global.$ = global.jQuery = $;
