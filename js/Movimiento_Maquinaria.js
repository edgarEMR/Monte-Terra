$("#navigation").load("Navbar.php", function () {
  $("#titulo").text("Movimientos Maquinaria");

  $("#navMenu").removeClass();
  $("#navMenu").hide();
  $("#navConst").removeClass();
  $("#navConst").hide();

  $("#agregarMovimiento").toggle();
  $("#agregarMaquina").toggle();
  $("#agregarOperador").toggle();
  $("#dividerTop").toggle();

  $("#logo").attr("href", "Maquinaria.php");
  $("#atrasMaquinaria").on("click", function () {
    location.href = "Maquinaria.php";
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
      $(".alert-body").text("Pago agregada correctamente");
      liveAlert.addClass("text-bg-success");
    } else {
      $(".alert-body").text(
        "No fue posible agregar el movimiento, intente nuevamente"
      );
      liveAlert.addClass("text-bg-danger");
    }

    liveAlert.alert();

    setTimeout(() => {
      liveAlert.alert("close");
    }, 5000);
  }

  //Cambio de panel al seleccionar una pestaña
  switch ($("#idTipoArea").text()) {
    case "0":
      $("#ingreso-tab").addClass("active");
      $("#ingreso-tab-pane").addClass("show active");
      break;

    case "1":
      if ($("#idEsIngreso").text() === "1") {
        $("#ingreso-tab").addClass("active");
        $("#ingreso-tab-pane").addClass("show active");

        $("#egreso-tab").prop("disabled", true);
      } else {
        $("#egreso-tab").addClass("active");
        $("#egreso-tab-pane").addClass("show active");

        $("#ingreso-tab").prop("disabled", true);
      }
      break;

    default:
      break;
  }

  //Obtener etapas del proyecto seleccionado en Ingreso
  $("#inputProyecto").change(function () {
    var idProyecto = $("#inputProyecto").val();
    $.ajax({
      method: "POST",
      url: "php/Etapa_Procesos.php",
      cache: false,
      data: { accion: "obtener", id: idProyecto },
    }).done(function (result) {
      $("#inputEtapa").empty().html(result);
      $("#inputEtapa").selectpicker("destroy");
      $("#inputEtapa").selectpicker({ style: "", styleBase: "form-control" });
    });
  });

  //Obtener etapas del proyecto seleccionado en Egreso
  $("#inputProyectoEg").change(function () {
    var idProyecto = $("#inputProyectoEg").val();
    $.ajax({
      method: "POST",
      url: "php/Etapa_Procesos.php",
      cache: false,
      data: { accion: "obtener", id: idProyecto },
    }).done(function (result) {
      $("#inputEtapaEg").empty().html(result);
      $("#inputEtapaEg").selectpicker("destroy");
      $("#inputEtapaEg").selectpicker({ style: "", styleBase: "form-control" });
    });
  });

  //Obtener Concepto dependiendo de la Familia seleccionada en Egreso
  $("#inputAreaEg").change(function () {
    var idFamilia = $("#inputAreaEg").val();
    $.ajax({
      method: "POST",
      url: "php/Concepto_Procesos.php",
      cache: false,
      data: { accion: "obtenerA", tipo: "egreso", id: idFamilia },
    }).done(function (result) {
      $("#inputConceptoA").empty().html(result);
      $("#inputConceptoA").selectpicker("destroy");
      $("#inputConceptoA").selectpicker({
        style: "",
        styleBase: "form-control",
      });
    });
  });

  //Obtener Concepto B dependiendo del Concepto A seleccionado en Egreso
  $("#inputMaquina").change(function () {
    var idMaquina = $("#inputMaquina").val();
    $.ajax({
      method: "POST",
      url: "php/Maquinaria_Procesos.php",
      cache: false,
      data: { accion: "obtener", id: idMaquina },
    }).done(function (result) {
      var jsonResult = JSON.parse(result);
      $("#inputConcepto").val(jsonResult["nombre_recurrencia"]);
      $("#inputPrecioUn").val(jsonResult["costo"]);
      calcularImporte();
    });
  });

  //Obtener Concepto C dependiendo del Concepto B seleccionado en Egreso
  $("#inputConceptoB").change(function () {
    var idConcepto = $("#inputConceptoB").val();
    $.ajax({
      method: "POST",
      url: "php/Concepto_Procesos.php",
      cache: false,
      data: { accion: "obtenerC", tipo: "egreso", id: idConcepto },
    }).done(function (result) {
      $("#inputConceptoC").empty().html(result);
      $("#inputConceptoC").selectpicker("destroy");
      $("#inputConceptoC").selectpicker({
        style: "",
        styleBase: "form-control",
      });
    });
  });

  //Obtener Concepto dependiendo del Area seleccionada en General
  $("#inputOgGeneral").change(function () {
    var idArea = $("#inputOgGeneral").val();
    console.log(idArea);
    $.ajax({
      method: "POST",
      url: "php/Concepto_Procesos.php",
      cache: false,
      data: { accion: "obtenerA", tipo: "general", id: idArea },
    }).done(function (result) {
      $("#inputConceptoGenA").empty().html(result);
      console.log(result);
      $("#inputConceptoGenA").selectpicker("destroy");
      $("#inputConceptoGenA").selectpicker({
        style: "",
        styleBase: "form-control",
      });
    });
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

  $("#inputOgEgreso").on("change", function () {
    var selectpicker = $("#inputAreaEg");
    selectpicker.removeClass("is-valid is-invalid");

    if ($(this).val() == "1") {
      selectpicker.addClass("is-invalid");
      //selectpicker.parent().next().show();
    } else {
      selectpicker.addClass("is-valid");
      //selectpicker.parent().next().hide();
    }
    // selectpicker.next('.invalid-feedback').text(''); // Clear any previous error message
  });

  // Handle form submission to prevent invalid selects
  $("#nuevoPagoIng").on("submit", function (event) {
    var selectpicker = $("#nuevoPagoIng").find(".selectpicker");
    if (!selectpicker.val()) {
      selectpicker.addClass("is-invalid");
      selectpicker.parent().next().show();
    } else {
      selectpicker.addClass("is-valid");
      selectpicker.parent().next().hide();
    }

    var invalidSelects = $("#nuevoPagoIng").find(".selectpicker.is-invalid");
    if (invalidSelects.length > 0) {
      invalidSelects.first().focus();
    }
  });

  $("#nuevoPagoEgr").on("submit", function (event) {
    var selectpicker = $("#nuevoPagoEgr").find(".selectpicker");
    if (!selectpicker.val()) {
      selectpicker.addClass("is-invalid");
      selectpicker.parent().next().show();
    } else {
      selectpicker.addClass("is-valid");
      selectpicker.parent().next().hide();
    }

    var selectFamilia = $("#inputAreaEg");
    selectFamilia.removeClass("is-valid is-invalid");

    if ($("#inputOgEgreso").val() == "1") {
      selectFamilia.addClass("is-invalid");
      selectFamilia.parent().next().show();
    } else {
      selectFamilia.addClass("is-valid");
      selectFamilia.parent().next().hide();
    }

    var invalidSelects = $("#nuevoPagoEgr").find(".selectpicker.is-invalid");
    if (invalidSelects.length > 0) {
      invalidSelects.first().focus();
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

function calcularImporte() {
  var cantidad = $("#inputCantidad").val();
  var precioUnitario = $("#inputPrecioUn").val();
  var modificacion = parseFloat($("#inputModificacion").val()) || 0;
  var precioFinal = $("#inputImporte");

  var pFinal = cantidad * precioUnitario + modificacion;
  console.log(pFinal);
  precioFinal.val(pFinal);
}
