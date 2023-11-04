$("#navigation").load("Navbar.php", function () {
  $("#titulo").text("Agregar Cotización");

  $("#navVentas").removeClass();
  $("#navVentas").hide();
  $("#navMaqu").removeClass();
  $("#navMaqu").hide();
  $("#navConst").removeClass();
  $("#navConst").hide();

  $("#atras").on("click", function () {
    location.href = "Proyectos.php";
  });
});

$(".selectpicker").selectpicker({
  style: "",
  styleBase: "form-control",
});

$(document).ready(function () {
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

  $("#divConcepto").hide();
  $("#divConceptoLista").hide();
  $("#divNumCasas").hide();
  $("#divPrecioM").hide();
  $("#divMetros2").hide();
  $("#divImporte").hide();

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

  $("#inputEtapa").on("submit", function (event) {
    var selectpicker = $("#inputEtapa").find(".selectpicker");
    if (!selectpicker.val()) {
      selectpicker.addClass("is-invalid");
      selectpicker.parent().next().show();
    } else {
      selectpicker.addClass("is-valid");
      selectpicker.parent().next().hide();
    }

    var invalidSelects = $("#inputEtapa").find(".selectpicker.is-invalid");
    if (invalidSelects.length > 0) {
      invalidSelects.first().focus();
    }
  });

  $("#inputConceptoLista").on("submit", function (event) {
    var selectpicker = $("#inputConceptoLista").find(".selectpicker");
    if (!selectpicker.val()) {
      selectpicker.addClass("is-invalid");
      selectpicker.parent().next().show();
    } else {
      selectpicker.addClass("is-valid");
      selectpicker.parent().next().hide();
    }

    var invalidSelects = $("#inputConceptoLista").find(
      ".selectpicker.is-invalid"
    );
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

function sendVariables(pagina, id, name) {
  var body = document.getElementsByTagName("body")[0];
  var sendID = id;
  //var sessionImagen = document.getElementById('sessionImagen').value;
  var form = document.createElement("form"); //CREATE FORM
  form.setAttribute("method", "get"); //SET FORM ATTRIBUTES
  form.setAttribute("style", "display:none");
  form.setAttribute("action", pagina);
  body.appendChild(form); //APPEND FORM TO BODY
  var proyectoID = document.createElement("input"); //CREATE INPUT
  proyectoID.setAttribute("type", "hidden"); //SET INPUT ATTRIBUTES
  proyectoID.setAttribute("name", name);
  proyectoID.setAttribute("value", sendID);
  form.appendChild(proyectoID); //APPEND INPUT TO FORM
  form.submit(); //SUBMIT FORM
}

function getParameterByName(name, url = window.location.search) {
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function checkCotizacion() {
  $("#inputConcepto").val("");
  $("#inputConceptoLista").selectpicker("val", "");
  $("#inputNumCasas").val("0");
  $("#inputImporteM2").val("");
  $("#inputMetros2").val("0");
  $("#inputImporte").val("");

  console.log($("#inputFamilia").prop("selectedIndex"));
  switch ($("#inputFamilia").prop("selectedIndex")) {
    case 1:
      $("#divConcepto").show();
      $("#divConceptoLista").hide();
      $("#divNumCasas").show();
      $("#divPrecioM").show();
      $("#divMetros2").show();
      $("#divImporte").show();

      $("#inputConcepto").prop("required", true);
      $("#inputConceptoLista").prop("required", false);
      $("#inputNumCasas").prop("required", true);
      $("#inputImporteM2").prop("required", true);
      $("#inputMetros2").prop("required", true);

      $("#inputConcepto").removeClass("is-valid");
      $("#inputConceptoLista").addClass("is-valid");
      $("#inputNumCasas").removeClass("is-valid");
      $("#inputImporteM2").removeClass("is-valid");
      $("#inputMetros2").removeClass("is-valid");

      $("#divImporte").removeClass("col-md-6");
      $("#divImporte").addClass("col-md-3");
      break;

    case 2:
      $("#divConcepto").hide();
      $("#divConceptoLista").show();
      $("#divNumCasas").hide();
      $("#divPrecioM").hide();
      $("#divMetros2").hide();
      $("#divImporte").show();

      $("#inputConcepto").prop("required", false);
      $("#inputConceptoLista").prop("required", true);
      $("#inputNumCasas").prop("required", false);
      $("#inputImporteM2").prop("required", false);
      $("#inputMetros2").prop("required", false);

      $("#inputConcepto").addClass("is-valid");
      $("#inputConceptoLista").removeClass("is-valid");
      $("#inputNumCasas").addClass("is-valid");
      $("#inputImporteM2").addClass("is-valid");
      $("#inputMetros2").addClass("is-valid");

      $("#divImporte").removeClass("col-md-3");
      $("#divImporte").addClass("col-md-6");
      break;
  }
}

function calcularImporte() {
  var numCasas = $("#inputNumCasas").val();
  var importeM2 = $("#inputImporteM2").val();
  var metros2 = $("#inputMetros2").val();
  var importe = $("#inputImporte");

  importe.val(importeM2 * metros2 * numCasas);
}
