// let carrera = document.getElementById('carrera');
// let nivel = document.getElementById('nivel');
const btn_clear = document.querySelector('#btn-clear');
document.addEventListener('DOMContentLoaded', function () {

  // Obtener la fecha actual
const currentDate = new Date();

// Obtener el año, mes y día
const year = currentDate.getFullYear();
const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Agrega un 0 inicial si el mes es menor a 10
const day = String(currentDate.getDate()).padStart(2, '0'); // Agrega un 0 inicial si el día es menor a 10

// Formatear la fecha en el formato deseado (YYYY-MM-DD)
const formattedDate = `${year}-${month}-${day}`;


  // Establecer las fechas actuales en los campos de fecha
  document.getElementById('f1').value = formattedDate;
  document.getElementById('f2').value = formattedDate;

  const table = $('#tbl_reporteAsistencias').DataTable({
    ajax: {
      url: ruta + 'controllers/asistenciaController.php?option=listarxfechaActual',
      dataSrc: ''
    },
    columns: [
      { data: 'id' },
      { data: 'fecha' },
      { data: 'codigo' },
      { data: 'nombre' },
      { data: 'aula' },
      { data: 'sede' },
      { data: 'ingreso' },
      { data: 'salida' },
      { data: 'accion' }
    ],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
    },
    "order": [[0, 'desc']],
    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [{
      //Botón para Excel
      extend: 'excelHtml5',
      footer: true,
      title: 'REPORTE DE ASISTENCIAS',
      titleAttr: 'Exportar Excel',
      filename: 'Reporte_asistencias',

      //Aquí es donde generas el botón personalizado
      text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
    },
    //Botón para PDF
    {
      extend: 'pdfHtml5',
      download: 'open',
      footer: true,
      title: 'Reporte de Asistencias',
      filename: 'Reporte_asistencias',
      titleAttr: 'Exportar Pdf',
      text: '<span class="badge badge-danger"><i class="fas fa-file-pdf"></i></span>',
      exportOptions: {
        columns: [0, ':visible']
      }
    },
    //Botón para copiar
    {
      extend: 'copyHtml5',
      footer: true,
      title: 'Reporte de asistencias',
      filename: 'Reporte de Asistencias',
      titleAttr: 'Copiar',
      text: '<span class="badge badge-primary"><i class="fas fa-copy"></i></span>',
      exportOptions: {
        columns: [0, ':visible']
      }
    }
    ]
  });

  // $('#btn-filtrar').on('click', function () {
  //     let fechaInicial = $('#f1').val();
  //     let fechaFinal = $('#f2').val();

  //     // Verificar si ambas fechas están seleccionadas
  //     if (fechaInicial && fechaFinal) {
  //         $.ajax({
  //             url: ruta + 'controllers/asistenciaController.php?option=listarxRangoFechas',
  //             method: 'POST',
  //             data: { fechaInicial: fechaInicial, fechaFinal: fechaFinal },
  //             success: function (response) {
  //                 console.log(response);
  //                 table.clear().rows.add(response).draw();
  //             },
  //             error: function (xhr, status, error) {
  //                 console.error(xhr.responseText);
  //             }
  //         });
  //     }
  // });

  $('#btn-filtrar').on('click', function () {
    let fechaInicial = $('#f1').val();
    let fechaFinal = $('#f2').val();

    // Verificar si ambas fechas están seleccionadas
    if (fechaInicial && fechaFinal) {
      const formData = new FormData();
      formData.append('fechaInicial', fechaInicial);
      formData.append('fechaFinal', fechaFinal);

      axios.post(ruta + 'controllers/asistenciaController.php?option=listarxRangoFechas', formData)
        .then(function (response) {
          console.log(response.data);
          table.clear().rows.add(response.data).draw();
        })
        .catch(function (error) {
          console.error(error);
        });
    } else {
      message('error', 'Debe seleccionar ambas fechas');
    }
  });

  // Mostar los valores actuales de la tabla
   // Agregar event listener al botón "Limpiar"
   btn_clear.addEventListener('click', function () {
    // Limpiar los campos de fecha
    // document.getElementById('f1').value = '';
    // document.getElementById('f2').value = '';
    
    // Recargar la página
    window.location.reload();
});
})



document.querySelectorAll('.mydp').forEach(function (el) {
  const myDatePicker = MCDatepicker.create({
    el: '#' + el.getAttribute('id')
    , autoClose: true
    , customOkBTN: 'ACEPTAR'
    , customClearBTN: 'BORRAR'
    , customCancelBTN: 'CANCELAR'
    , dateFormat: 'YYYY-MM-DD'
    , customWeekDays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']
    , customMonths: [
      'Enero'
      , 'Febrero'
      , 'Marzo'
      , 'Abril'
      , 'Mayo'
      , 'Junio'
      , 'Julio'
      , 'Agosto'
      , 'Septiembre'
      , 'Octubre'
      , 'Noviembre'
      , 'Diciembre'
    ]
  })

  // myDatePicker.onSelect((date, formatedDate) => {
  //     if (myDatePicker.el == '#f1')
  //         @this.startDate = formatedDate;
  //     else
  //         @this.endDate = formatedDate;



  // })

})