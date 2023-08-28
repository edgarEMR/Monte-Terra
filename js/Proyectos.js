$("#navigation").load("Navbar.php", function () {
  $("#titulo").text("Proyectos");

  $("#navConst").removeClass();
  $("#navConst").hide();

  $("#crearEtapa").toggle();
  $("#crearPresupuesto").toggle();
  $("#agregarPago").on("click", function () {
    location.href = "Detalle_Pago.php";
  });
  $("#crearCliente").toggle();
  $("#crearProspecto").toggle();
  $("#agregarAbono").toggle();
  $("#dividerTop").toggle();
  $("#agregarAportador").toggle();
  $("#agregarCredito").toggle();
  $("#agregarProveedor").toggle();
  $("#agregarPrestamo").toggle();
  $("#gestionProrrateo").toggle();
  $("#dividerBottom").toggle();
});

$(document).ready(function () {
  $("#crecimento").text("Crecimiento: " + $("#crecimientoHidden").text());
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

function addDays(date) {
  console.log(date);
  var newDate = new Date(date);
  newDate.setDate(newDate.getDate() + 8);

  var dd = newDate.getDate();
  var mm = newDate.getMonth() + 1;
  var yyyy = newDate.getFullYear();

  if (dd < 10) {
    dd = "0" + dd;
  }

  if (mm < 10) {
    mm = "0" + mm;
  }

  var dateString = yyyy + "-" + mm + "-" + dd;
  console.log(dateString);

  sendVariables("Proyectos.php", dateString, "date");
}

function subDays(date) {
  console.log(date);
  var newDate = new Date(date);
  newDate.setDate(newDate.getDate() - 6);

  var dd = newDate.getDate();
  var mm = newDate.getMonth() + 1;
  var yyyy = newDate.getFullYear();

  if (dd < 10) {
    dd = "0" + dd;
  }

  if (mm < 10) {
    mm = "0" + mm;
  }

  var dateString = yyyy + "-" + mm + "-" + dd;
  console.log(dateString);

  sendVariables("Proyectos.php", dateString, "date");
}
