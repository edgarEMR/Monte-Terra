$("#navigation").load("Navbar.php", function () {
  $("#titulo").text("Perfil");

  $("#navConst").removeClass();
  $("#navConst").hide();

  $("#crearProyecto").toggle();
  $("#crearEtapa").toggle();
  $("#crearProspecto").toggle();
  $("#agregarPago").toggle();
  $("#crearPresupuesto").toggle();
  $("#crearCotizacion").toggle();
  $("#crearCliente").toggle();
  $("#gestionProrrateo").toggle();
  $("#agregarAbono").toggle();
  $("#dividerTop").toggle();
  $("#agregarAportador").toggle();
  $("#agregarCredito").toggle();
  $("#agregarProveedor").toggle();
  $("#agregarPrestamo").toggle();
  $("#dividerBottom").toggle();

  var depaID = $("#depaID").val();
  var href = "";
  console.log(depaID);
  switch (depaID) {
    case "1":
      href = "Menu.php";
      break;

    case "2":
      href = "Proyectos.php";
      break;

    case "3":
      href = "Ventas.php";
      break;

    case "4":
      href = "Maquinaria.php";
      break;

    default:
      href = "Perfil.php";
      break;
  }
  console.log(href);
  $("#atras").on("click", function () {
    location.href = href;
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

$(document).ready(function () {
  //Detectar mensaje de error
  const liveAlert = $("#liveAlert");
  if (getParameterByName("success")) {
    console.log("SUCCESS");
    if (getParameterByName("success") == 1) {
      $(".alert-body").text("Informacion guardada correctamente");
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
});

function getParameterByName(name, url = window.location.search) {
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function verContra() {
  var contra = document.getElementById("inputContraseña");

  if (contra.type === "password") {
    contra.type = "text";
    document.getElementById("verIcon").className = "bi bi-eye-fill";
  } else {
    contra.type = "password";
    document.getElementById("verIcon").className = "bi bi-eye-slash-fill";
  }
}
