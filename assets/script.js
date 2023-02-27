// const myModal = boostrap.Modal.getOrCreateInstance('#autoload-modal');
// window.addEventListener('DOMContentLoaded', () => {
// myModal.show();
// });

$(function () {
  $("body").css("padding-right", "0px");
  $("body").removeClass("modal-open");
  $(".modal-backdrop").remove();

  $("#MyModal").modal("show");
});

// $("button[data-bs-dismiss=modal]").click(function () {
//   $(".modal.in").removeClass("in").addClass("fade").hide();
//   $(".modal-backdrop").remove();
// });
