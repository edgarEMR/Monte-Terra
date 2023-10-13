$("#navigation").load("Navbar.php", function () {
  $("#titulo").text("Nuevo Proyecto");

  $("#navMaqu").removeClass();
  $("#navMaqu").hide();
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
  $("#desglosePEG").toggle();
  $("#desgloseGeneral").toggle();
  $("#dividerBottom").toggle();

  $("#atras").on("click", function () {
    if (getParameterByName("id") == null) {
      location.href = "Proyectos.php";
    } else {
      location.href = "Portafolio.php?id=" + getParameterByName("id");
    }
  });
});

$(".selectpicker").selectpicker({
  style: "",
  styleBase: "form-control",
});

$(document).ready(function () {
  //Detectar mensaje de error
  if (getParameterByName("success")) {
    console.log("SUCCESS");
    const liveAlert = $("#liveAlert");
    if (getParameterByName("success") == 1) {
      $(".alert-body").text("Proyecto guardado correctamente");
      liveAlert.addClass("text-bg-success");
    } else {
      $(".alert-body").text(
        "No fue posible crear o modificar el proyecto, intente nuevamente"
      );
      liveAlert.addClass("text-bg-danger");
    }

    liveAlert.alert();

    setTimeout(() => {
      liveAlert.alert("close");
    }, 5000);
  }

  $("#inputPrototipo").on("change", totalPrototipos);
  $("#inputManzana").on("change", totalManzanas);
  $("#inputTotalCasas").on("change", function () {
    var etapas = $("#inputTotalEtapas");
    if (this.value < etapas.val()) {
      this.value = etapas.val();
    }
  });

  $("#registroProyecto").submit(function (e) {
    var totalCasas = 0;

    $(".prototiposEnProyecto").each(function () {
      totalCasas += parseInt(this.value);
    });
    console.log("total casas: " + totalCasas);
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

function totalPrototipos() {
  var prototipos = $("#inputPrototipo").val();

  $("#divPrototipos").empty();

  for (let i = 0; i < prototipos; i++) {
    $("#divPrototipos").append(
      '<div class="form-group col-md-4">' +
        '<label for="inputMetros">Prototipo ' +
        (i + 1) +
        "</label>" +
        '<div class="input-group has-validation">' +
        '<input type="number" name="metros[]" class="form-control prototiposEnProyecto" id="inputMetros" min="1" required>' +
        '<span class="input-group-text">metros</span>' +
        '<div class="invalid-feedback">' +
        "Ingrese un número válido." +
        "</div>" +
        "</div>" +
        "</div>"
    );
  }
}

function totalManzanas() {
  var manzanas = $("#inputManzana").val();

  $("#divManzanas").empty();

  for (let i = 0; i < manzanas; i++) {
    $("#divManzanas").append(
      '<div class="form-group col-md-4">' +
        '<label for="inputNumero">Manzana ' +
        (i + 1) +
        "</label>" +
        '<div class="input-group has-validation">' +
        '<span class="input-group-text">N°</span>' +
        '<input type="number" name="numeros[]" class="form-control prototiposEnProyecto" id="inputNumero" min="1" required>' +
        '<div class="invalid-feedback">' +
        "Ingrese un número válido." +
        "</div>" +
        "</div>" +
        "</div>"
    );
  }
}

function getParameterByName(name, url = window.location.search) {
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}
