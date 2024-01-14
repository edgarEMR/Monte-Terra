$("#navigation").load("Navbar.php", function () {
  $("#titulo").text("Expediente");

  $("#navMenu").removeClass();
  $("#navMenu").hide();
  $("#navMaqu").removeClass();
  $("#navMaqu").hide();
  $("#navConst").removeClass();
  $("#navConst").hide();

  $("#logo").attr("href", "Ventas.php");
  $("#atras").on("click", function () {
    history.back();
  });
});

$(document).ready(function () {});

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
