$("#navigation").load("Navbar.php", function () {
  $("#titulo").text("Movimientos");

  $("#navMaqu").removeClass();
  $("#navMaqu").hide();
  $("#navConst").removeClass();
  $("#navConst").hide();

  $("#crearProyecto").toggle();
  $("#crearEtapa").toggle();
  $("#agregarPago").toggle();
  $("#crearPresupuesto").toggle();
  $("#crearCotizacion").toggle();
  $("#crearCliente").toggle();
  $("#crearProspecto").toggle();
  $("#gestionProrrateo").toggle();
  $("#agregarAbono").toggle();
  $("#agregarUsuario").toggle();
  $("#desglosePEG").toggle();
  $("#desgloseGeneral").toggle();
  $("#dividerTop").toggle();

  $("#atras").on("click", function () {
    location.href = "Proyectos.php";
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
      $(".alert-body").text("Pago agregado correctamente");
      liveAlert.addClass("text-bg-success");
    } else {
      $(".alert-body").text(
        "No fue posible agregar el pago, intente nuevamente"
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
        $("#general-tab").prop("disabled", true);

        $("#inputOgIngreso").trigger("change");
      } else {
        $("#egreso-tab").addClass("active");
        $("#egreso-tab-pane").addClass("show active");

        $("#ingreso-tab").prop("disabled", true);
        $("#general-tab").prop("disabled", true);

        $("#inputOgEgreso").trigger("change");
      }
      break;

    case "2":
      $("#general-tab").addClass("active");
      $("#general-tab-pane").addClass("show active");

      $("#ingreso-tab").prop("disabled", true);
      $("#egreso-tab").prop("disabled", true);

      $("#inputOgEgreso").trigger("change");
      break;

    default:
      break;
  }

  $("#inputOgIngreso").change(function () {
    var concepto = $("#inputOgIngreso").find("option:selected").text();
    $("#inputConcepto").val(concepto);
  });

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

  $("#inputEtapa").change(function () {
    var idProyecto = $("#inputProyecto").val();
    var idEtapa = $("#inputEtapa").val();
    $.ajax({
      method: "POST",
      url: "php/Cliente_Procesos.php",
      cache: false,
      data: { accion: "obtener", proyecto: idProyecto, etapa: idEtapa },
    }).done(function (result) {
      $("#inputCliente").empty().html(result);
      $("#inputCliente").selectpicker("destroy");
      $("#inputCliente").selectpicker({ style: "", styleBase: "form-control" });
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
  $("#inputConceptoA").change(function () {
    var idConcepto = $("#inputConceptoA").val();
    $.ajax({
      method: "POST",
      url: "php/Concepto_Procesos.php",
      cache: false,
      data: { accion: "obtenerB", tipo: "egreso", id: idConcepto },
    }).done(function (result) {
      $("#inputConceptoB").empty().html(result);
      $("#inputConceptoB").selectpicker("destroy");
      $("#inputConceptoB").selectpicker({
        style: "",
        styleBase: "form-control",
      });
    });
  });

  //Obtener areas en General dependiendo si es Ingreso o Egreso
  $('input[type=radio][name="esIngreso"]').on("change", function () {
    var esIngreso = $(this).val();
    $.ajax({
      method: "POST",
      url: "php/Area_Procesos.php",
      cache: false,
      data: { accion: "obtener", tipo: esIngreso },
    }).done(function (result) {
      $("#inputOgGeneral").empty().html(result);
      $("#inputOgGeneral").selectpicker("destroy");
      $("#inputOgGeneral").selectpicker({
        style: "",
        styleBase: "form-control",
      });

      $("#divConceptoGen").hide();
      $("#divConceptoGenA").hide();
      $("#divConceptoGenB").hide();
      $("#divEmpleado").hide();
      $("#divInstitucion").hide();
      $("#divProyectos").hide();
      $("#divNomina").hide();
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

    var pAdmin = idArea == 19 ? 1 : 0;
    console.log("Es Admin --> ", pAdmin);
    $.ajax({
      method: "POST",
      url: "php/Prorrateo_Procesos.php",
      cache: false,
      data: { accion: "obtener", esAdmin: pAdmin },
    }).done(function (result) {
      $("#inputProyectoGen").empty().html(result);
      $("#inputProyectoGen").selectpicker("destroy");
      $("#inputProyectoGen").selectpicker({
        style: "",
        styleBase: "form-control",
      });
    });
  });

  $("#inputProyectoMaq").change(function () {
    var idProyecto = $("#inputProyectoMaq").val();
    $.ajax({
      method: "POST",
      url: "php/Etapa_Procesos.php",
      cache: false,
      data: { accion: "obtener", id: idProyecto },
    }).done(function (result) {
      $("#inputEtapaMaq").empty().html(result);
    });
  });

  $("#divAportador").hide();
  $("#divPrestamo").hide();
  $("#divCliente").hide();
  $("#divBanco").hide();

  $("#divProveedor").hide();
  $("#divAportadorEg").hide();
  $("#divClienteEg").hide();
  $("#divAreaEg").hide();
  $("#divConceptoEg").hide();
  $("#divConceptoA").hide();
  $("#divConceptoB").hide();
  $("#divComentario").hide();
  $("#divBancoEg").hide();

  $("#divConceptoGen").hide();
  $("#divConceptoGenA").hide();
  $("#divConceptoGenB").hide();
  $("#divEmpleado").hide();
  $("#divInstitucion").hide();
  $("#divProyectos").hide();
  $("#divNomina").hide();

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

function checkIngreso() {
  $("#inputAportador").selectpicker("val", "");
  $("#inputCliente").selectpicker("val", "");
  $("#inputBanco").selectpicker("val", "");

  switch ($("#inputOgIngreso").prop("selectedIndex")) {
    case 1:
      console.log("Banco selected");
      $("#divAportador").hide();
      $("#divPrestamo").hide();
      $("#divCliente").hide();
      $("#divBanco").show();

      $("#inputAportador").prop("required", false);
      $("#inputPrestamo").prop("required", false);
      $("#inputCliente").prop("required", false);
      $("#inputBanco").prop("required", true);
      $("#inputAportador").addClass("is-valid");
      $("#inputPrestamo").addClass("is-valid");
      $("#inputCliente").addClass("is-valid");
      $("#inputBanco").removeClass("is-valid");
      break;

    case 2:
      console.log("Aportacion selected");
      $("#divAportador").show();
      $("#divPrestamo").hide();
      $("#divCliente").hide();
      $("#divBanco").hide();

      $("#inputAportador").prop("required", true);
      $("#inputPrestamo").prop("required", false);
      $("#inputCliente").prop("required", false);
      $("#inputBanco").prop("required", false);
      $("#inputAportador").removeClass("is-valid");
      $("#inputPrestamo").addClass("is-valid");
      $("#inputCliente").addClass("is-valid");
      $("#inputBanco").addClass("is-valid");
      break;

    case 3:
      console.log("Prestamo checked");
      $("#divAportador").hide();
      $("#divPrestamo").show();
      $("#divCliente").hide();
      $("#divBanco").hide();

      $("#inputAportador").prop("required", false);
      $("#inputPrestamo").prop("required", true);
      $("#inputCliente").prop("required", false);
      $("#inputBanco").prop("required", false);
      $("#inputAportador").addClass("is-valid");
      $("#inputPrestamo").removeClass("is-valid");
      $("#inputCliente").addClass("is-valid");
      $("#inputBanco").addClass("is-valid");
      break;

    case 4:
      console.log("Venta checked");
      $("#divAportador").hide();
      $("#divPrestamo").hide();
      $("#divCliente").show();
      $("#divBanco").hide();

      $("#inputAportador").prop("required", false);
      $("#inputPrestamo").prop("required", false);
      $("#inputCliente").prop("required", true);
      $("#inputBanco").prop("required", false);
      $("#inputAportador").addClass("is-valid");
      $("#inputPrestamo").addClass("is-valid");
      $("#inputCliente").removeClass("is-valid");
      $("#inputBanco").addClass("is-valid");
      break;
  }
}

function checkEgreso() {
  $("#inputAreaEg").selectpicker("val", "");
  $("#inputProveedorEg").selectpicker("val", "");
  $("#inputAportadorEg").selectpicker("val", "");
  $("#inputClienteEg").selectpicker("val", "");
  $("#inputConceptoA").selectpicker("val", "");
  $("#inputConceptoB").selectpicker("val", "");
  $("#inputComentario").val("");
  $("#inputBancoEg").selectpicker("val", "");

  switch ($("#inputOgEgreso").prop("selectedIndex")) {
    case 1:
      console.log("Pago selected");
      $("#divProveedor").show();
      $("#divAportadorEg").hide();
      $("#divClienteEg").hide();
      $("#divAreaEg").show();
      $("#divConceptoEg").hide();
      $("#divConceptoA").show();
      $("#divConceptoB").show();
      $("#divComentario").show();
      $("#divBancoEg").hide();
      $("#inputAreaEg").prop("disabled", false);
      $("#inputAreaEg").prop("required", true);
      $("#inputAreaEg").removeClass("is-valid");

      $("#inputAreaEg").prop("required", true);
      $("#inputProveedorEg").prop("required", true);
      $("#inputAportadorEg").prop("required", false);
      $("#inputClienteEg").prop("required", false);
      $("#inputConceptoEg").prop("required", false);
      $("#inputConceptoA").prop("required", true);
      $("#inputBancoEg").prop("required", false);
      $("#inputAreaEg").removeClass("is-valid");
      $("#inputProveedorEg").removeClass("is-valid");
      $("#inputAportadorEg").addClass("is-valid");
      $("#inputClienteEg").addClass("is-valid");
      $("#inputConceptoEg").addClass("is-valid");
      $("#inputConceptoA").removeClass("is-valid");
      $("#inputBancoEg").addClass("is-valid");
      break;

    case 2:
      console.log("Banco selected");
      $("#divProveedor").hide();
      $("#divAportadorEg").hide();
      $("#divClienteEg").hide();
      $("#divAreaEg").hide();
      $("#divConceptoEg").show();
      $("#divConceptoA").hide();
      $("#divConceptoB").hide();
      $("#divComentario").hide();
      $("#divBancoEg").show();
      $("#inputAreaEg").prop("disabled", true);
      $("#inputAreaEg").prop("required", false);
      $("#inputAreaEg").addClass("is-valid");

      $("#inputProveedorEg").prop("required", false);
      $("#inputAportadorEg").prop("required", false);
      $("#inputClienteEg").prop("required", false);
      $("#inputConceptoEg").prop("required", true);
      $("#inputConceptoA").prop("required", false);
      $("#inputConceptoB").prop("required", false);
      $("#inputBancoEg").prop("required", true);
      $("#inputProveedorEg").addClass("is-valid");
      $("#inputAportadorEg").addClass("is-valid");
      $("#inputClienteEg").addClass("is-valid");
      $("#inputConceptoEg").removeClass("is-valid");
      $("#inputConceptoA").addClass("is-valid");
      $("#inputConceptoB").addClass("is-valid");
      $("#inputBancoEg").removeClass("is-valid");
      break;

    case 3:
      console.log("Aportacion selected");
      $("#divProveedor").hide();
      $("#divAportadorEg").show();
      $("#divClienteEg").hide();
      $("#divAreaEg").hide();
      $("#divConceptoEg").show();
      $("#divConceptoA").hide();
      $("#divConceptoB").hide();
      $("#divComentario").hide();
      $("#divBancoEg").hide();
      $("#inputAreaEg").prop("disabled", true);
      $("#inputAreaEg").prop("required", false);
      $("#inputAreaEg").addClass("is-valid");

      $("#inputProveedorEg").prop("required", false);
      $("#inputAportadorEg").prop("required", true);
      $("#inputClienteEg").prop("required", false);
      $("#inputConceptoEg").prop("required", true);
      $("#inputConceptoA").prop("required", false);
      $("#inputConceptoB").prop("required", false);
      $("#inputBancoEg").prop("required", false);
      $("#inputProveedorEg").addClass("is-valid");
      $("#inputAportadorEg").removeClass("is-valid");
      $("#inputClienteEg").addClass("is-valid");
      $("#inputConceptoEg").removeClass("is-valid");
      $("#inputConceptoA").addClass("is-valid");
      $("#inputConceptoB").addClass("is-valid");
      $("#inputBancoEg").addClass("is-valid");
      break;

    case 4:
      console.log("Devolucion selected");
      $("#divProveedor").hide();
      $("#divAportadorEg").hide();
      $("#divClienteEg").show();
      $("#divAreaEg").hide();
      $("#divConceptoEg").hide();
      $("#divConceptoA").hide();
      $("#divConceptoB").hide();
      $("#divComentario").hide();
      $("#divBancoEg").hide();
      $("#inputAreaEg").prop("disabled", true);
      $("#inputAreaEg").prop("required", false);
      $("#inputAreaEg").addClass("is-valid");

      $("#inputProveedorEg").prop("required", false);
      $("#inputAportadorEg").prop("required", false);
      $("#inputClienteEg").prop("required", true);
      $("#inputConceptoEg").prop("required", false);
      $("#inputConceptoA").prop("required", false);
      $("#inputConceptoB").prop("required", false);
      $("#inputBancoEg").prop("required", false);
      $("#inputProveedorEg").addClass("is-valid");
      $("#inputAportadorEg").addClass("is-valid");
      $("#inputClienteEg").removeClass("is-valid");
      $("#inputConceptoEg").addClass("is-valid");
      $("#inputConceptoA").addClass("is-valid");
      $("#inputConceptoB").addClass("is-valid");
      $("#inputBancoEg").addClass("is-valid");
      break;
  }
}

function checkGeneral() {
  $("#inputConceptoGen").selectpicker("val", "");
  $("#inputConceptoGenA").selectpicker("val", "");
  $("#inputConceptoGenB").selectpicker("val", "");
  $("#inputEmpleado").selectpicker("val", "");
  $("#inputInstitucion").selectpicker("val", "");
  $("#inputProyectoGen").selectpicker("val", "");
  $("#divNomina").empty();

  switch ($("#inputOgGeneral").prop("selectedIndex")) {
    case 1:
      console.log("PEG selected");
      $("#divConceptoGen").hide();
      $("#divConceptoGenA").show();
      $("#divConceptoGenB").show();
      $("#divEmpleado").hide();
      $("#divInstitucion").hide();
      $("#divProyectos").hide();
      $("#divNomina").hide();

      $("#inputConceptoGen").prop("required", false);
      $("#inputConceptoGenA").prop("required", true);
      $("#inputConceptoGenB").prop("required", true);
      $("#inputEmpleado").prop("required", false);
      $("#inputInstitucion").prop("required", false);
      $("#inputProyectoGen").prop("required", false);

      $("#inputConceptoGen").addClass("is-valid");
      $("#inputConceptoGenA").removeClass("is-valid");
      $("#inputConceptoGenB").removeClass("is-valid");
      $("#inputEmpleado").addClass("is-valid");
      $("#inputInstitucion").addClass("is-valid");
      $("#inputProyectoGen").addClass("is-valid");
      break;

    case 2:
      console.log("PES selected");
      $("#divConceptoGen").show();
      $("#divConceptoGenA").hide();
      $("#divConceptoGenB").hide();
      $("#divEmpleado").hide();
      $("#divInstitucion").hide();
      $("#divProyectos").hide();
      $("#divNomina").hide();

      $("#inputConceptoGen").prop("required", true);
      $("#inputConceptoGenA").prop("required", false);
      $("#inputConceptoGenB").prop("required", false);
      $("#inputEmpleado").prop("required", false);
      $("#inputInstitucion").prop("required", false);
      $("#inputProyectoGen").prop("required", false);

      $("#inputConceptoGen").removeClass("is-valid");
      $("#inputConceptoGenA").addClass("is-valid");
      $("#inputConceptoGenB").addClass("is-valid");
      $("#inputEmpleado").addClass("is-valid");
      $("#inputInstitucion").addClass("is-valid");
      $("#inputProyectoGen").addClass("is-valid");
      break;

    case 3:
      console.log("EES selected");
      $("#divConceptoGen").show();
      $("#divConceptoGenA").hide();
      $("#divConceptoGenB").hide();
      $("#divEmpleado").hide();
      $("#divInstitucion").hide();
      $("#divProyectos").hide();
      $("#divNomina").hide();

      $("#inputConceptoGen").prop("required", true);
      $("#inputConceptoGenA").prop("required", false);
      $("#inputConceptoGenB").prop("required", false);
      $("#inputEmpleado").prop("required", false);
      $("#inputInstitucion").prop("required", false);
      $("#inputProyectoGen").prop("required", false);

      $("#inputConceptoGen").removeClass("is-valid");
      $("#inputConceptoGenA").addClass("is-valid");
      $("#inputConceptoGenB").addClass("is-valid");
      $("#inputEmpleado").addClass("is-valid");
      $("#inputInstitucion").addClass("is-valid");
      $("#inputProyectoGen").addClass("is-valid");
      break;

    case 4:
      console.log("Credito selected");
      if ($("#esIngresoGen").is(":checked")) {
        $("#divConceptoGen").hide();
        $("#divConceptoGenA").show();
        $("#divConceptoGenB").show();
        $("#divEmpleado").hide();
        $("#divInstitucion").show();
        $("#divProyectos").hide();
        $("#divNomina").hide();

        $("#inputConceptoGen").prop("required", false);
        $("#inputConceptoGenA").prop("required", true);
        $("#inputConceptoGenB").prop("required", true);
        $("#inputEmpleado").prop("required", false);
        $("#inputInstitucion").prop("required", true);
        $("#inputProyectoGen").prop("required", false);

        $("#inputConceptoGen").addClass("is-valid");
        $("#inputConceptoGenA").removeClass("is-valid");
        $("#inputConceptoGenB").removeClass("is-valid");
        $("#inputEmpleado").addClass("is-valid");
        $("#inputInstitucion").removeClass("is-valid");
        $("#inputProyectoGen").addClass("is-valid");
      }

      if ($("#esEgresoGen").is(":checked")) {
        $("#divConceptoGen").show();
        $("#divConceptoGenA").hide();
        $("#divConceptoGenB").hide();
        $("#divEmpleado").hide();
        $("#divInstitucion").show();
        $("#divProyectos").hide();
        $("#divNomina").hide();

        $("#inputConceptoGen").prop("required", true);
        $("#inputConceptoGenA").prop("required", false);
        $("#inputConceptoGenB").prop("required", false);
        $("#inputEmpleado").prop("required", false);
        $("#inputInstitucion").prop("required", true);
        $("#inputProyectoGen").prop("required", false);

        $("#inputConceptoGen").removeClass("is-valid");
        $("#inputConceptoGenA").addClass("is-valid");
        $("#inputConceptoGenB").addClass("is-valid");
        $("#inputEmpleado").addClass("is-valid");
        $("#inputInstitucion").removeClass("is-valid");
        $("#inputProyectoGen").addClass("is-valid");
      }
      break;

    case 5:
      console.log("Prestamo selected");
      $("#divConceptoGen").show();
      $("#divConceptoGenA").hide();
      $("#divConceptoGenB").hide();
      $("#divEmpleado").show();
      $("#divInstitucion").hide();
      $("#divProyectos").hide();
      $("#divNomina").hide();

      $("#inputConceptoGen").prop("required", true);
      $("#inputConceptoGenA").prop("required", false);
      $("#inputConceptoGenB").prop("required", false);
      $("#inputEmpleado").prop("required", true);
      $("#inputInstitucion").prop("required", false);
      $("#inputProyectoGen").prop("required", false);

      $("#inputConceptoGen").removeClass("is-valid");
      $("#inputConceptoGenA").addClass("is-valid");
      $("#inputConceptoGenB").addClass("is-valid");
      $("#inputEmpleado").removeClass("is-valid");
      $("#inputInstitucion").addClass("is-valid");
      $("#inputProyectoGen").addClass("is-valid");
      break;

    case 6:
      console.log("Prorrateo Admin selected");
      $("#divConceptoGen").hide();
      $("#divConceptoGenA").show();
      $("#divConceptoGenB").show();
      $("#divEmpleado").hide();
      $("#divInstitucion").hide();
      $("#divProyectos").show();
      $("#divNomina").hide();

      $("#inputConceptoGen").prop("required", false);
      $("#inputConceptoGenA").prop("required", true);
      $("#inputConceptoGenB").prop("required", true);
      $("#inputEmpleado").prop("required", false);
      $("#inputInstitucion").prop("required", false);
      $("#inputProyectoGen").prop("required", true);

      $("#inputConceptoGen").addClass("is-valid");
      $("#inputConceptoGenA").removeClass("is-valid");
      $("#inputConceptoGenB").removeClass("is-valid");
      $("#inputEmpleado").addClass("is-valid");
      $("#inputInstitucion").addClass("is-valid");
      $("#inputProyectoGen").removeClass("is-valid");
      break;

    case 7:
      console.log("Prorrateo Int selected");
      $("#divConceptoGen").show();
      $("#divConceptoGenA").hide();
      $("#divConceptoGenB").hide();
      $("#divEmpleado").hide();
      $("#divInstitucion").hide();
      $("#divProyectos").show();
      $("#divNomina").hide();

      $("#inputConceptoGen").prop("required", true);
      $("#inputConceptoGenA").prop("required", false);
      $("#inputConceptoGenB").prop("required", false);
      $("#inputEmpleado").prop("required", false);
      $("#inputInstitucion").prop("required", false);
      $("#inputProyectoGen").prop("required", true);

      $("#inputConceptoGen").removeClass("is-valid");
      $("#inputConceptoGenA").addClass("is-valid");
      $("#inputConceptoGenB").addClass("is-valid");
      $("#inputEmpleado").addClass("is-valid");
      $("#inputInstitucion").addClass("is-valid");
      $("#inputProyectoGen").removeClass("is-valid");
      break;

    case 8:
      console.log("Nomina selected");
      $("#divConceptoGen").hide();
      $("#divConceptoGenA").hide();
      $("#divConceptoGenB").hide();
      $("#divEmpleado").hide();
      $("#divInstitucion").hide();
      $("#divProyectos").hide();
      $("#divNomina").show();

      $("#inputConceptoGen").prop("required", false);
      $("#inputConceptoGenA").prop("required", false);
      $("#inputConceptoGenB").prop("required", false);
      $("#inputEmpleado").prop("required", false);
      $("#inputInstitucion").prop("required", false);
      $("#inputProyectoGen").prop("required", false);

      $("#inputConceptoGen").addClass("is-valid");
      $("#inputConceptoGenA").addClass("is-valid");
      $("#inputConceptoGenB").addClass("is-valid");
      $("#inputEmpleado").addClass("is-valid");
      $("#inputInstitucion").addClass("is-valid");
      $("#inputProyectoGen").addClass("is-valid");

      $.ajax({
        method: "POST",
        url: "php/Usuario_Procesos.php",
        cache: false,
        data: { accion: "obtener" },
      }).done(function (result) {
        $("#divNomina").empty().html(result);
      });
      break;
  }
}

function nominaTotal() {
  console.log("NOMINA TOTAL");
  const arraySueldo = $('input[name="sueldo[]"]');
  const arrayExtras = $('input[name="extras[]"]');
  const arrayCompensacion = $('input[name="compensacion[]"]');
  const arrayDescuento = $('input[name="descuento[]"]');
  const arrayAbono = $('input[name="abono[]"]');

  arraySueldo.on("change", function () {
    calcularNominaTotal(arraySueldo.index(this));
  });
  arrayExtras.on("change", function () {
    calcularNominaTotal(arrayExtras.index(this));
  });
  arrayCompensacion.on("change", function () {
    calcularNominaTotal(arrayCompensacion.index(this));
  });
  arrayDescuento.on("change", function () {
    calcularNominaTotal(arrayDescuento.index(this));
  });
  arrayAbono.on("change", function () {
    calcularNominaTotal(arrayAbono.index(this));
  });
}

function calcularNominaTotal(index) {
  console.log("CALCULAR NOMINA");
  const arraySueldo = $('input[name="sueldo[]"]');
  const arrayExtras = $('input[name="extras[]"]');
  const arrayCompensacion = $('input[name="compensacion[]"]');
  const arrayDescuento = $('input[name="descuento[]"]');
  const arrayAbono = $('input[name="abono[]"]');
  const arrayTotal = $('input[name="total[]"]');
  const inputImporte = $("#inputImporteGen");

  const sueldo = parseFloat($(arraySueldo[index]).val()) || 0;
  const extras = parseFloat($(arrayExtras[index]).val()) || 0;
  const compensacion = parseFloat($(arrayCompensacion[index]).val()) || 0;
  const descuento = parseFloat($(arrayDescuento[index]).val()) || 0;
  const abono = parseFloat($(arrayAbono[index]).val()) || 0;

  const suma = sueldo + extras * 100 + compensacion - descuento - abono;
  var sumaImporte = 0;

  $(arrayTotal[index]).val(suma);

  arrayTotal.each(function (index, value) {
    console.log(index, $(value).val());
    sumaImporte += parseFloat($(value).val() || 0);
  });

  inputImporte.val(sumaImporte);
}
// var today = new Date();
// var dd = today.getDate();
// var mm = today.getMonth()+1; //January is 0!
// var yyyy = today.getFullYear();
//  if(dd<10){
//         dd='0'+dd;
//     }
//     if(mm<10){
//         mm='0'+mm;
//     }

// today = yyyy+'-'+mm+'-'+dd;
// document.getElementById("inputFecha").setAttribute("max", today);
