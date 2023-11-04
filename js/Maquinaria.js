$("#navigation").load("Navbar.php", function () {
  $("#titulo").text("Maquinaria");

  $("#navMenu").removeClass();
  $("#navMenu").hide();
  $("#navVentas").removeClass();
  $("#navVentas").hide();
  $("#navConst").removeClass();
  $("#navConst").hide();

  $("#agregarMovimiento").toggle();
  $("#agregarMaquina").toggle();
  $("#agregarOperador").toggle();

  $("#logo").attr("href", "Maquinaria.php");
  $("#atrasMaquinaria").on("click", function () {
    location.href = "Maquinaria.php";
  });
});

$(document).ready(function () {});

(() => {
  "use strict";

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll(".needs-validation");

  // Loop over them and prevent submission
  Array.from(forms).forEach((form) => {
    console.log(form);
    form.addEventListener(
      "submit",
      (event) => {
        console.log("Submit");
        if (!form.checkValidity()) {
          console.log("Is Form");
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

function nominaTotal() {
  console.log("NOMINA TOTAL");
  const arraySueldo = $('input[name="sueldo[]"]');
  const arrayExtras = $('input[name="extras[]"]');
  const arrayDescuento = $('input[name="descuento[]"]');

  arraySueldo.on("change", function () {
    calcularNominaTotal(arraySueldo.index(this));
  });
  arrayExtras.on("change", function () {
    calcularNominaTotal(arrayExtras.index(this));
  });
  arrayDescuento.on("change", function () {
    calcularNominaTotal(arrayDescuento.index(this));
  });
}

function calcularNominaTotal(index) {
  console.log("CALCULAR NOMINA");
  const arraySueldo = $('input[name="sueldo[]"]');
  const arrayExtras = $('input[name="extras[]"]');
  const arrayDescuento = $('input[name="descuento[]"]');
  const arrayTotal = $('input[name="total[]"]');

  const sueldo = parseFloat($(arraySueldo[index]).val()) || 0;
  const extras = parseFloat($(arrayExtras[index]).val()) || 0;
  const descuento = parseFloat($(arrayDescuento[index]).val()) || 0;

  const suma = sueldo + extras - descuento;

  $(arrayTotal[index]).val(suma);
}
