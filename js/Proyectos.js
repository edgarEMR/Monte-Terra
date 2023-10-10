$("#navigation").load("Navbar.php", function () {
  $("#titulo").text("Proyectos");

  $("#navMaqu").removeClass();
  $("#navMaqu").hide();
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

function sendDate(pagina, dateIni, dateEnd) {
  var body = document.getElementsByTagName("body")[0];

  //var sessionImagen = document.getElementById('sessionImagen').value;
  var form = document.createElement("form"); //CREATE FORM
  form.setAttribute("method", "get"); //SET FORM ATTRIBUTES
  form.setAttribute("style", "display:none");
  form.setAttribute("action", pagina);
  body.appendChild(form); //APPEND FORM TO BODY

  var inputDateIni = document.createElement("input"); //CREATE INPUT
  inputDateIni.setAttribute("type", "hidden"); //SET INPUT ATTRIBUTES
  inputDateIni.setAttribute("name", "dateSrt");
  inputDateIni.setAttribute("value", dateIni);

  var inputDateEnd = document.createElement("input"); //CREATE INPUT
  inputDateEnd.setAttribute("type", "hidden"); //SET INPUT ATTRIBUTES
  inputDateEnd.setAttribute("name", "dateEnd");
  inputDateEnd.setAttribute("value", dateEnd);
  form.appendChild(inputDateIni); //APPEND INPUT TO FORM
  form.appendChild(inputDateEnd); //APPEND INPUT TO FORM
  form.submit(); //SUBMIT FORM
}

function setDateRange() {
  var dateIni = $("#inputDateIni").val();
  var dateFin = $("#inputDateFin").val();
  console.log(dateIni);
  console.log(dateFin);

  console.log(Date.parse(dateIni));
  console.log(Date.parse(dateFin));

  if (Date.parse(dateIni) < Date.parse(dateFin)) {
    sendDate("Proyectos.php", dateIni, dateFin);
  } else {
    console.log("ERROR");
    const liveAlert = $("#liveAlert");
    $(".alert-body").text("La fecha final debe ser mayor a la inicial");
    liveAlert.addClass("text-bg-warning");

    liveAlert.show();

    setTimeout(() => {
      liveAlert.hide();
    }, 5000);
  }
}
