$(document).ready(function () {
  //Detectar mensaje de error
  const liveAlert = $("#liveAlert");
  if (getParameterByName("success")) {
    console.log("SUCCESS");
    if (getParameterByName("success") == 1) {
      $(".alert-body").text("Prospecto creado correctamente");
      liveAlert.addClass("text-bg-success");
    } else {
      $(".alert-body").text(
        "No fue posible realizar la acción, intente nuevamente"
      );
      liveAlert.addClass("text-bg-danger");
    }
  } else if (getParameterByName("error")) {
    $(".alert-body").text(
      "Correo o contraseña incorrectos, intente nuevamente"
    );
    liveAlert.addClass("text-bg-danger");
  } else {
    $(".alert-body").text(
      "Ocurrio un problema, pongase en contacto con su administrador"
    );
    liveAlert.addClass("text-bg-warning");
  }

  liveAlert.alert();

  setTimeout(() => {
    liveAlert.alert("close");
  }, 5000);
});

function getParameterByName(name, url = window.location.search) {
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}
