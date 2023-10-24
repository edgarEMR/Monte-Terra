$("#navigation").load("Navbar.php", function () {
  $("#titulo").text("Clientes");

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
    location.href = "Ventas.php";
  });
});

$(".selectpicker").selectpicker({
  style: "",
  styleBase: "form-control",
});

$(document).ready(function () {
  if (getParameterByName("success")) {
    const liveAlert = $("#liveAlert");
    if (getParameterByName("success") == 1) {
      $(".alert-body").text("Cliente creado correctamente");
      liveAlert.addClass("text-bg-success");
    } else if (getParameterByName("success") == 2) {
      $(".alert-body").text(
        "Ya existe un Prospecto con estos datos, verifique la información"
      );
      liveAlert.addClass("text-bg-warning");
    } else {
      $(".alert-body").text(
        "No fue posible realizar la acción, intente nuevamente"
      );
      liveAlert.addClass("text-bg-danger");
    }

    liveAlert.alert();

    setTimeout(() => {
      liveAlert.alert("close");
    }, 5000);
  }
  $("#fechaFirma").text(getDate());

  //Obtener las calles de la etapa seleccionada al cargar la pagina
  //Solo si existe el Cliente
  var idEtapa = $("#inputEtapa").val();
  console.log($("#inputEtapa").val());
  $.ajax({
    method: "POST",
    url: "php/Calle_Procesos.php",
    cache: false,
    data: { accion: "obtener", id: idEtapa },
  }).done(function (result) {
    $("#inputCalle").empty().html(result);
    $("#inputCalle").selectpicker("destroy");
    $("#inputCalle").selectpicker({ style: "", styleBase: "form-control" });
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

    $.ajax({
      method: "POST",
      url: "php/Prototipo_Procesos.php",
      cache: false,
      data: { accion: "obtener", id: idProyecto },
    }).done(function (result) {
      $("#inputPrototipo").empty().html(result);
      $("#inputPrototipo").selectpicker("destroy");
      $("#inputPrototipo").selectpicker({
        style: "",
        styleBase: "form-control",
      });
    });
  });

  $("#inputEtapa").change(function () {
    var idEtapa = $("#inputEtapa").val();
    $.ajax({
      method: "POST",
      url: "php/Calle_Procesos.php",
      cache: false,
      data: { accion: "obtener", id: idEtapa },
    }).done(function (result) {
      $("#inputCalle").empty().html(result);
      $("#inputCalle").selectpicker("destroy");
      $("#inputCalle").selectpicker({ style: "", styleBase: "form-control" });
    });
  });

  $("#inputCalle").change(function () {
    var idCalle = $("#inputCalle").val();
    $.ajax({
      method: "POST",
      url: "php/Lote_Procesos.php",
      cache: false,
      data: { accion: "obtener", id: idCalle },
    }).done(function (result) {
      $("#inputLote").empty().html(result);
      $("#inputLote").selectpicker("destroy");
      $("#inputLote").selectpicker({ style: "", styleBase: "form-control" });
    });
  });

  $("#inputLote").change(function () {
    var idLote = $("#inputLote").val();
    $.ajax({
      method: "POST",
      url: "php/Lote_Procesos.php",
      cache: false,
      data: { accion: "select", id: idLote },
    }).done(function (result) {
      var jsonResult = JSON.parse(result);
      console.log(jsonResult);
      let precioLista = new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "USD",
      });
      $("#inputPrototipo").selectpicker(
        "val",
        jsonResult["idPrototipo"].toString()
      );
      $("#inputExcedente").val(jsonResult["metrosExcedentes"]);
      $("#precioLista").text(precioLista.format(jsonResult["precioLista"]));
      $("#precioLista").attr("value", jsonResult["precioLista"]);
    });

    var idEtapa = $("#inputEtapa").val();
    $.ajax({
      method: "POST",
      url: "php/Etapa_Procesos.php",
      cache: false,
      data: { accion: "select", id: idEtapa },
    }).done(function (result) {
      var jsonResult = JSON.parse(result);
      $("#inputPrecioExcedente").val(jsonResult["precioExcedente"]);
    });
  });

  $(function () {
    $('input[type="text"]').keyup(function () {
      this.value = this.value.toLocaleUpperCase();
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

function getParameterByName(name, url = window.location.search) {
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function getDate() {
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

  today = dd + "-" + mm + "-" + yyyy;
  return today;
}
//document.getElementById("inputFecha").setAttribute("max", today);

function calcularImporte() {
  const liveAlert = $("#liveAlert");

  var m2Excedente = $("#inputExcedente").val();
  var precioExcedente = $("#inputPrecioExcedente").val();
  var precioVenta = $("#inputPrecioVenta").val();
  var precioFinal = $("#inputPrecioFinal");
  var precioLista = parseFloat($("#precioLista").attr("value"));

  var pFinal = m2Excedente * precioExcedente + parseFloat(precioVenta);
  console.log(pFinal, precioLista);
  if (pFinal >= precioLista) {
    liveAlert.alert("close");
    precioFinal.val(pFinal);
  } else {
    precioFinal.val("");
    $(".alert-body").text(
      "El precio de venta no puede ser menor al precio de lista"
    );
    liveAlert.addClass("text-bg-warning");
    liveAlert.alert();
  }
}
