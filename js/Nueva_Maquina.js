$("#navigation").load("Navbar.php", function () {
  $("#titulo").text("Maquinaria");

  $("#navMenu").removeClass();
  $("#navMenu").hide();
  $("#navConst").removeClass();
  $("#navConst").hide();

  $("#crearProyecto").toggle();
  $("#crearPresupuesto").toggle();
  $("#agregarPago").toggle();
  $("#crearCotizacion").toggle();
  $("#dividerTop").toggle();
  $("#agregarAportador").toggle();
  $("#agregarCredito").toggle();
  $("#agregarProveedor").toggle();
  $("#agregarPrestamo").toggle();
  $("#agregarMovimiento").toggle();
  $("#agregarMaquina").toggle();
  $("#agregarOperador").toggle();
  $("#atras").toggle();

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
      $(".alert-body").text("Maquinaria agregada correctamente");
      liveAlert.addClass("text-bg-success");
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
});

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
