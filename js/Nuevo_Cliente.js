$("#navigation").load("Navbar.php", function () {
  $("#titulo").text("Clientes");

  $("#navConst").removeClass();
  $("#navConst").hide();

  $("#crearProyecto").toggle();
  $("#crearEtapa").toggle();
  $("#crearPresupuesto").toggle();
  $("#crearCotizacion").toggle();
  $("#agregarPago").toggle();
  $("#crearCliente").toggle();
  $("#crearProspecto").toggle();
  $("#agregarAbono").toggle();
  $("#dividerTop").toggle();
  $("#agregarAportador").toggle();
  $("#agregarCredito").toggle();
  $("#agregarProveedor").toggle();
  $("#agregarPrestamo").toggle();
  $("#gestionProrrateo").toggle();
  $("#dividerBottom").toggle();

  $("#atras").on("click", function () {
    location.href = "Ventas.php";
  });
});

$(".selectpicker").selectpicker({
  style: "",
  styleBase: "form-control",
});

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
      .text("Error al crear proyecto, intente de nuevo");
    $("#modalMensaje").modal("show");
  }

  $("#registroProyecto").submit(function (e) {
    var casas = $("#inputTotalCasas").val();
    var totalCasas = 0;

    $(".casasEnEtapa").each(function () {
      totalCasas += parseInt(this.value);
    });
    console.log("total casas: " + totalCasas);

    if (casas < totalCasas) {
      e.preventDefault();
      $("#liveToast .me-auto").text("Atención");
      $("#liveToast > .toast-body").text(
        "La suma de las casas por etapa no puede ser mayor al total de casas"
      );
      $("#liveToast rect").attr("fill", "red");
      const toast = new bootstrap.Toast($("#liveToast"));
      toast.show();
    }
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

function getParameterByName(name, url = window.location.search) {
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1; //January is 0!
var yyyy = today.getFullYear();
if (dd < 10) {
  dd = "0" + dd;
}
if (mm < 10) {
  mm = "0" + mm;
}

today = yyyy + "-" + mm + "-" + dd;
document.getElementById("inputFecha").setAttribute("max", today);
