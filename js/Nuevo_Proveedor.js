$("#navigation").load("Navbar.php", function () {
  $("#titulo").text("Proveedores");

  $("#navVentas").removeClass();
  $("#navVentas").hide();
  $("#navMaqu").removeClass();
  $("#navMaqu").hide();
  $("#navConst").removeClass();
  $("#navConst").hide();

  $("#atras").on("click", function () {
    location.href = "Detalle_Pago.php";
  });
});

(() => {
  "use strict";

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll(".needs-validation");

  // Loop over them and prevent submission
  Array.from(forms).forEach((form) => {
    form.addEventListener(
      "submit",
      (event) => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      },
      false
    );
  });
})();

$(document).ready(function () {
  $("#inputTotalEtapas").on("change", totalEtapas);
  $("#inputTotalCasas").on("change", function () {
    var etapas = $("#inputTotalEtapas");
    if (this.value < etapas.val()) {
      this.value = etapas.val();
    }
  });

  if (getParameterByName("error") == 1) {
    $("#modalMensaje").find(".modal-title").text("Atención");
    $("#modalMensaje")
      .find(".modal-body")
      .text("Error al agregar Aportador, intente de nuevo");
    $("#modalMensaje").modal("show");
  }
});

function getParameterByName(name, url = window.location.search) {
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}
