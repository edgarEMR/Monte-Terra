$("#navigation").load("Navbar.php", function () {
  $("#titulo").text("Aportaciones Por Pagar");

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
  $("#agregarAbono").toggle();
  $("#dividerTop").toggle();
  $("#agregarAportador").toggle();
  $("#agregarCredito").toggle();
  $("#agregarProveedor").toggle();
  $("#agregarPrestamo").toggle();
  $("#agregarUsuario").toggle();
  $("#gestionProrrateo").toggle();
  $("#dividerBottom").toggle();

  $("#atras").on("click", function () {
    location.href = "Proyectos.php";
  });

  $("#inputProyectoID").val(getParameterByName("id"));
});

$(document).ready(function () {
  getUniqueValuesFromColumn();
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

function getUniqueValuesFromColumn() {
  var unique_col_values_dict = {};

  allFilters = document.querySelectorAll(".table-filter");
  allFilters.forEach((filter_i) => {
    col_index = filter_i.parentElement.getAttribute("col-index");
    // alert(col_index)
    const rows = document.querySelectorAll("#tabla-portafolio > tbody > tr");

    rows.forEach((row) => {
      cell_value = row.querySelector(
        "td:nth-child(" + col_index + ")"
      ).innerHTML;

      if (col_index == 1) {
        date_value = cell_value;
        console.log(date_value);
        cell_value = date_value.substring(3, 5);
        console.log(cell_value);
      }
      // if the col index is already present in the dict
      if (col_index in unique_col_values_dict) {
        // if the cell value is already present in the array
        if (unique_col_values_dict[col_index].includes(cell_value)) {
          // alert(cell_value + " is already present in the array : " + unique_col_values_dict[col_index])
        } else {
          unique_col_values_dict[col_index].push(cell_value);
          // alert("Array after adding the cell value : " + unique_col_values_dict[col_index])
        }
      } else {
        unique_col_values_dict[col_index] = new Array(cell_value);
      }
    });
  });

  for (i in unique_col_values_dict) {
    //alert("Column index : " + i + " has Unique values : \n" + unique_col_values_dict[i]);
  }

  updateSelectOptions(unique_col_values_dict);
}

// Add <option> tags to the desired columns based on the unique values

function updateSelectOptions(unique_col_values_dict) {
  allFilters = document.querySelectorAll(".table-filter");

  allFilters.forEach((filter_i) => {
    col_index = filter_i.parentElement.getAttribute("col-index");

    //ACTUALIZAR OTRO DROPDOWN(EL QUE ESTARÁ EN EL MENU DE FILTROS)
    unique_col_values_dict[col_index].forEach((i) => {
      filter_i.innerHTML =
        filter_i.innerHTML + `\n<option value="${i}">${i}</option>`;
    });
    //ACTUALIZAR OTRO DROPDOWN(EL QUE ESTARÁ EN EL MENU DE FILTROS)
  });
}

// Create filter_rows() function

// filter_value_dict {2 : Value selected, 4:value, 5: value}

function filter_rows() {
  allFilters = document.querySelectorAll(".table-filter");
  var filter_value_dict = {};

  allFilters.forEach((filter_i) => {
    col_index = filter_i.parentElement.getAttribute("col-index");

    //OBTENER EL VALOR DEL OTRO DROPDOWN(EL QUE ESTARÁ EN EL MENU DE FILTROS)
    value = filter_i.value;
    if (value != "all") {
      filter_value_dict[col_index] = value;
    }
    //OBTENER EL VALOR DEL OTRO DROPDOWN(EL QUE ESTARÁ EN EL MENU DE FILTROS)
  });

  var col_cell_value_dict = {};

  const rows = document.querySelectorAll("#tabla-portafolio tbody tr");
  rows.forEach((row) => {
    var display_row = true;

    allFilters.forEach((filter_i) => {
      col_index = filter_i.parentElement.getAttribute("col-index");
      col_cell_value_dict[col_index] = row.querySelector(
        "td:nth-child(" + col_index + ")"
      ).innerHTML;
    });

    for (var col_i in filter_value_dict) {
      filter_value = filter_value_dict[col_i];
      row_cell_value = col_cell_value_dict[col_i];

      if (row_cell_value.indexOf(filter_value) == -1 && filter_value != "all") {
        display_row = false;
        break;
      }
    }

    if (display_row == true) {
      row.style.display = "table-row";
    } else {
      row.style.display = "none";
    }
  });
}
