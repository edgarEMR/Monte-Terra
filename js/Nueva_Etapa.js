$("#navigation").load("Navbar.php", function () {
  $("#titulo").text("Nueva Etapa");

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
      $(".alert-body").text("Etapa creada correctamente");
      liveAlert.addClass("text-bg-success");
    } else {
      $(".alert-body").text(
        "No fue posible crear la etapa, intente nuevamente"
      );
      liveAlert.addClass("text-bg-danger");
    }

    liveAlert.alert();

    setTimeout(() => {
      liveAlert.alert("close");
    }, 5000);
  }

  //Detectar mensaje de error (Calle)
  if (getParameterByName("successCalle")) {
    console.log("SUCCESS");
    const liveAlert = $("#liveAlert");
    if (getParameterByName("successCalle") == 1) {
      $(".alert-body").text("Calle agregada correctamente");
      liveAlert.addClass("text-bg-success");
    } else {
      $(".alert-body").text(
        "No fue posible agregar la calle, intente nuevamente"
      );
      liveAlert.addClass("text-bg-danger");
    }

    liveAlert.alert();

    setTimeout(() => {
      liveAlert.alert("close");
    }, 5000);
  }

  //Detectar mensaje de error (Lote)
  if (getParameterByName("successLote")) {
    console.log("SUCCESS");
    const liveAlert = $("#liveAlert");
    if (getParameterByName("successLote") == 1) {
      $(".alert-body").text("Lote modificado correctamente");
      liveAlert.addClass("text-bg-success");
    } else {
      $(".alert-body").text(
        "No fue posible modificar la información, intente nuevamente"
      );
      liveAlert.addClass("text-bg-danger");
    }

    liveAlert.alert();

    setTimeout(() => {
      liveAlert.alert("close");
    }, 5000);
  }

  $("#inputPrototipo").on("change", totalPrototipos);
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

  $(".selectpicker").on("change", function () {
    var selectpicker = $(this);
    selectpicker.removeClass("is-valid is-invalid");
    // selectpicker.next('.invalid-feedback').text(''); // Clear any previous error message

    if (!selectpicker.val()) {
      selectpicker.addClass("is-invalid");
      selectpicker.parent().next().show();
    } else {
      selectpicker.addClass("is-valid");
      selectpicker.parent().next().hide();
    }
  });

  $(".showCalleModal").on("click", function (event) {
    console.log("CALLE");

    var etapa = $(this).attr("etapa");
    console.log(etapa);
    $("#etapaID").val(etapa);

    $.ajax({
      method: "POST",
      url: "php/Etapa_Procesos.php",
      cache: false,
      data: { accion: "select", id: etapa },
    }).done(function (result) {
      console.log(result);
      var jsonResult = JSON.parse(result);
      console.log(jsonResult["cantidadCasas"]);
      $("#inputTotalLotes").attr("max", jsonResult["cantidadCasas"]);
    });
  });

  $(".showLoteModal").on("click", function (event) {
    console.log("LOTE");

    var lote = $(this).attr("loteID");
    console.log(lote);
    $("#loteID").val(lote);

    $.ajax({
      method: "POST",
      url: "php/Lote_Procesos.php",
      cache: false,
      data: { accion: "select", id: lote },
    }).done(function (result) {
      console.log(result);
      var jsonResult = JSON.parse(result);
      console.log(jsonResult["cantidadCasas"]);
      $("#modalLoteTitle").text("Modificar Lote " + jsonResult["numeroLote"]);
      $("#inputMetrosExcedentes").val(jsonResult["metrosExcedentes"]);
      $("#inputPrecioLote").val(jsonResult["precioLista"]);
      $("#inputPrototipoLote").selectpicker(
        "val",
        jsonResult["idPrototipo"].toString()
      );
      $("#inputAutorizado").prop(
        "checked",
        jsonResult["autorizado"] == 1 ? true : false
      );
      $("#inputTotalLotes").attr("max", jsonResult["cantidadCasas"]);
    });
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

function getParameterByName(name, url = window.location.search) {
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}
