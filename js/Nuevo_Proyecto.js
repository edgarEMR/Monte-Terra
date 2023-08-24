$('#navigation').load("Navbar.php", function() {
    $('#titulo').text('Nuevo Proyecto');

    $('#navConst').removeClass();
    $('#navConst').hide();

    $('#crearProyecto').toggle();
    $('#crearPresupuesto').toggle();
    $('#crearCotizacion').toggle();
    $('#agregarPago').toggle();
    $('#crearCliente').toggle();
    $('#agregarAbono').toggle();
    $('#dividerTop').toggle();
    $('#agregarAportador').toggle();
    $('#agregarCredito').toggle();
    $('#agregarProveedor').toggle();
    $('#agregarPrestamo').toggle();
    $('#dividerBottom').toggle();

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
    
    $('#inputPrototipo').on('change', totalPrototipos);
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

      $('.prototiposEnProyecto').each(function(){
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

function totalPrototipos() {
    var prototipos = $('#inputTotalEtapas').val();

    $('#divPrototipos').empty();

    for (let i = 0; i < prototipos; i++) {
        $('#divPrototipos').append(
            '<div class="form-group col-md-4">' +
                '<label for="inputMetros">Prototipo ' + (i + 1) +'</label>' +
                '<div class="input-group has-validation">' +
                  '<input type="number" name="metros[]" class="form-control prototiposEnProyecto" id="inputMetros" min="1" required>' +
                  '<span class="input-group-text">metros</span>' +
                  '<div class="invalid-feedback">' +
                      'Ingrese un número válido.' +
                  '</div>' +
                '</div>' +
            '</div>'
        );
    }

}

function getParameterByName(name, url = window.location.search) {
  name = name.replace(/[\[\]]/g, '\\$&');
  var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
      results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, ' '));
}