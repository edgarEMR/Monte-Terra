$('#navigation').load("Navbar.php", function() {
    $('#titulo').text('Nuevo Proyecto');

    $('#crearProyecto').toggle();
    $('#crearPresupuesto').toggle();
    $('#agregarPago').toggle();

    $('#atras').on("click", function () {
      if(getParameterByName('id') == null){
        location.href = 'Proyectos.php';
      } else {
        location.href = 'Portafolio.php?id=' + getParameterByName('id');
      }
      
  });
});

(() => {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
  
        form.classList.add('was-validated')
      }, false)
    })
  })()

$(document).ready(function(){
    
    $('#inputTotalEtapas').on('change', totalEtapas);
    $('#inputTotalCasas').on('change', function() {
      var etapas = $('#inputTotalEtapas');
      if(this.value < etapas.val()){
        this.value = etapas.val();
      }
    }
    );

    if(getParameterByName('error') == 1) {
      $('#modalMensaje').find('.modal-title').text('Atención');
      $('#modalMensaje').find('.modal-body').text('Error al crear proyecto, intente de nuevo');
      $('#modalMensaje').modal('show');
    }

    $('#registroProyecto').submit(function(e){
      var casas = $('#inputTotalCasas').val();
      var totalCasas = 0;

      $('.casasEnEtapa').each(function(){
        totalCasas += parseInt(this.value);
      });
      console.log('total casas: ' + totalCasas);

      if(casas < totalCasas) {
        e.preventDefault();
        $('#liveToast .me-auto').text("Atención");
        $('#liveToast > .toast-body').text("La suma de las casas por etapa no puede ser mayor al total de casas");
        $('#liveToast rect').attr("fill", "red");
        const toast = new bootstrap.Toast($('#liveToast'));
        toast.show();
      }
    });
});

function totalEtapas() {
    var casas = $('#inputTotalCasas').val();
    var etapas = $('#inputTotalEtapas').val();

    $('#casasEtapa').empty();

    for (let i = 0; i < etapas && i < casas; i++) {
        $('#casasEtapa').append(
            '<div class="form-group col-md-4">' +
                '<label for="inputCasasEtapa' + (i + 1) + '">Casas en Etapa ' + (i + 1) +'</label>' +
                '<input type="number" name="casasEtapa' + (i + 1) + '" class="form-control casasEnEtapa" id="inputCasasEtapa' + (i + 1) + '" min="1" required>' +
                '<div class="invalid-feedback">' +
                    'Ingrese un número válido.' +
                '</div>' +
            '</div>'
        );
    }

    if(etapas > casas) $('#inputTotalEtapas').val(casas);
}

function getParameterByName(name, url = window.location.search) {
  name = name.replace(/[\[\]]/g, '\\$&');
  var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
      results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, ' '));
}