$("#navigation").load("Navbar.php", function () {
  $("#titulo").text("Nueva Etapa");

  $("#navVentas").removeClass();
  $("#navVentas").hide();
  $("#navMaqu").removeClass();
  $("#navMaqu").hide();
  $("#navConst").removeClass();
  $("#navConst").hide();

  $("#atras").on("click", function () {
    location.href = "Portafolio.php?id=" + getParameterByName("id");
  });
});

var precioFinalTemp = 0;

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
      $("#inputSubtotal").val(jsonResult["subtotal"]);
      $("#inputPrecioFinal").val(jsonResult["precioFinal"]);
      precioFinalTemp = parseFloat(jsonResult["precioFinal"]);
      $("#inputPrototipoLote").selectpicker(
        "val",
        jsonResult["idPrototipo"].toString()
      );
      $("#inputManzana").selectpicker(
        "val",
        jsonResult["idManzana"].toString()
      );
      $("#inputAutorizado").prop(
        "checked",
        jsonResult["autorizado"] == 1 ? true : false
      );
      $("#inputParque").prop(
        "checked",
        jsonResult["esParque"] == 1 ? true : false
      );
      $("#inputEsquina").prop(
        "checked",
        jsonResult["esEsquina"] == 1 ? true : false
      );
    });
  });

  $("#inputParque").on("change", function () {
    console.log("Cambio Parque");
    const subtotal = parseFloat($("#inputSubtotal").val());
    const pFinal = parseFloat($("#inputPrecioFinal").val());
    const porcentaje = subtotal * 0.05;
    this.checked
      ? $("#inputPrecioFinal").val(pFinal + porcentaje)
      : $("#inputPrecioFinal").val(pFinal - porcentaje);
  });

  $("#inputEsquina").on("change", function () {
    console.log("Cambio Esquina");
    const subtotal = parseFloat($("#inputSubtotal").val());
    const pFinal = parseFloat($("#inputPrecioFinal").val());
    const porcentaje = subtotal * 0.1;
    this.checked
      ? $("#inputPrecioFinal").val(pFinal + porcentaje)
      : $("#inputPrecioFinal").val(pFinal - porcentaje);
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
