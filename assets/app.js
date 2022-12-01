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

// start the Stimulus application
// import './bootstrap';

import "./js/bootstrap.bundle.min.js";
import "./js/main.js";

const $ = require("jquery");
global.$ = global.jQuery = $;

$("#form-{{pay.id}}").on("submit", (evtSubmit) => {
    evtSubmit.preventDefault();
    console.log($("#form-{{pay.id}} [name='message']").val());
    $.ajax({
      url: "{{ path('app_commentaire_ajouter', {id: pay.id}) }}",
      method: "POST",
      data: "msg=" + $("#form-{{pay.id}} [name='commentaire[message]']").val(),
      dataType: "json",
      success: (data) => {
        $("#comment").html(data);
        console.log("Data = " + data);
      },
      error: (jqXHR, status, error) => {
        console.log("ERREUR AJAX", status, error);
      },
    });
  });