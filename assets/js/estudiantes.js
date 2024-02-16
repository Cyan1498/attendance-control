const frm = document.querySelector('#frmEstudiante');
const codigo = document.querySelector('#codigo');
const telefono = document.querySelector('#telefono');
const nombre = document.querySelector('#nombre');
const apellido = document.querySelector('#apellido');
const direccion = document.querySelector('#direccion');
const carrera = document.querySelector('#carrera');
const nivel = document.querySelector('#nivel');
const id_estudiante = document.querySelector('#id_estudiante');
const btn_nuevo = document.querySelector('#btn-nuevo');
const btn_save = document.querySelector('#btn-save');

//Para cargar la img
const selectImage = document.querySelector('.select-image');
const inputFile = document.querySelector('#file');
const imgArea = document.querySelector('.img-area');

document.addEventListener('DOMContentLoaded', function () {

  cargarCarreras();
  cargarNiveles();

  $('#table_estudiantes').DataTable({
    ajax: {
      url: ruta + 'controllers/estudiantesController.php?option=listar',
      dataSrc: ''
    },
    columns: [
      { data: 'id' },
      { data: 'carreras' },
      { data: 'codigo' },
      { data: 'nombres' },
      // { data: 'telefono' },
      { data: 'foto' },
      // { data: 'direccion' },
      { data: 'niveles' },
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
      title: 'Archivo',
      titleAttr: 'Exportar Excel',
      filename: 'Export_File',

      //Aquí es donde generas el botón personalizado
      text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
    },
    //Botón para PDF
    {
      extend: 'pdfHtml5',
      download: 'open',
      footer: true,
      title: 'Reporte de estudiantes',
      filename: 'Reporte de estudiantes',
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
      title: 'Reporte de usuarios',
      filename: 'Reporte de usuarios',
      titleAttr: 'Copiar',
      text: '<span class="badge badge-primary"><i class="fas fa-copy"></i></span>',
      exportOptions: {
        columns: [0, ':visible']
      }
    }
    ]

  });
  frm.onsubmit = function (e) {
    e.preventDefault();
    if (codigo.value == '' || nombre.value == ''
      || apellido.value == '' || carrera.value == '' || nivel.value == '') {
      message('error', 'TODO LOS CAMPOS CON * SON REQUERIDOS')
    } else {
      const frmData = new FormData(frm);
      // Agregar la imagen al FormData si está presente
      if (inputFile.files.length > 0) {
        frmData.append('image', inputFile.files[0]);
      }
      axios.post(ruta + 'controllers/estudiantesController.php?option=save', frmData)
        .then(function (response) {
          console.log(response.data);
          const info = response.data;
          message(info.tipo, info.mensaje);
          if (info.tipo == 'success') {
            setTimeout(() => {
              window.location.reload();
            }, 1500);
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  }
  btn_nuevo.onclick = function () {
    frm.reset();
    id_estudiante.value = '';
    btn_save.innerHTML = 'Guardar';
    codigo.focus();
    const img = imgArea.querySelector('img');
    if (img) {
      img.remove(); // Eliminar la imagen si existe
      imgArea.classList.remove('active'); // Eliminar la clase "active" del contenedor de la imagen
    }
    // Restablecer el valor del atributo "data-img" a una cadena vacía
    imgArea.dataset.img = '';
    const imgAnteriorInput = document.querySelector('#img_anterior');
    imgAnteriorInput.value = '';
    console.log(imgAnteriorInput.value);
  }
})

function deleteEst(id) {
  Snackbar.show({
    text: 'Esta seguro de eliminar',
    width: '475px',
    actionText: 'Si eliminar',
    backgroundColor: '#FF0303',
    onActionClick: function (element) {
      axios.get(ruta + 'controllers/estudiantesController.php?option=delete&id=' + id)
        .then(function (response) {
          const info = response.data;
          message(info.tipo, info.mensaje);
          if (info.tipo == 'success') {
            setTimeout(() => {
              window.location.reload();
            }, 1500);
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  });

}

function editEst(id) {
  axios.get(ruta + 'controllers/estudiantesController.php?option=edit&id=' + id)
    .then(function (response) {
      const info = response.data;
      console.log(info);
      codigo.value = info.codigo;
      // telefono.value = info.telefono;
      nombre.value = info.nombre;
      apellido.value = info.apellido;
      // direccion.value = info.direccion;
      carrera.value = info.id_aula;
      nivel.value = info.id_sede;
      id_estudiante.value = info.id;
      btn_save.innerHTML = 'Actualizar';
      codigo.focus();

      // Cargar la imagen previa del estudiante si existe
      if (info.imagen) {
        const img = document.createElement('img');
        img.src = '../assets/images/estudiante/' + info.imagen;
        // imgArea.innerHTML = ''; // Limpiar el área de la imagen
        imgArea.appendChild(img);
        // imgArea.classList.add('active');
      }
      // Guardar el nombre de la imagen anterior en un campo oculto
      const imgAnteriorInput = document.querySelector('#img_anterior');
      imgAnteriorInput.value = info.imagen;
      console.log(imgAnteriorInput.value);

    })
    .catch(function (error) {
      console.log(error);
    });
}

function cargarCarreras() {
  axios.get(ruta + 'controllers/estudiantesController.php?option=datos&item=aulas')
    .then(function (response) {
      const info = response.data;
      console.log(info);
      let html = '<option value="">Seleccionar</option>';
      info.forEach(carrera => {
        html += `<option value="${carrera.id}">${carrera.nombre}</option>`;
      });
      carrera.innerHTML = html;
    })
    .catch(function (error) {
      console.log(error);
    });
}

function cargarNiveles() {
  axios.get(ruta + 'controllers/estudiantesController.php?option=datos&item=sedes')
    .then(function (response) {
      const info = response.data;
      let html = '<option value="">Seleccionar</option>';
      info.forEach(nivel => {
        html += `<option value="${nivel.id}">${nivel.nombre}</option>`;
      });
      nivel.innerHTML = html;
    })
    .catch(function (error) {
      console.log(error);
    });
}

selectImage.addEventListener('click', function () {
  inputFile.click();
})

inputFile.addEventListener('change', function () {
  const image = this.files[0]
  if (image.size < 2000000) {
    const reader = new FileReader();
    reader.onload = () => {
      const allImg = imgArea.querySelectorAll('img');
      allImg.forEach(item => item.remove());
      const imgUrl = reader.result;
      const img = document.createElement('img');
      console.log(img);
      img.src = imgUrl;
      imgArea.appendChild(img);
      imgArea.classList.add('active');
      imgArea.dataset.img = image.name;
    }
    reader.readAsDataURL(image);
    console.log(image);
  } else {
    alert("Image size more than 2MB");
  }
})