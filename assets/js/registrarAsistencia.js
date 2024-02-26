const contactForm = document.querySelector('#contactForm');
const codigo = document.querySelector('#codigo');
const entrada = document.querySelector('#entrada');
const salida = document.querySelector('#salida');
//
const btnRegistrar = document.querySelector('#btnRegistrar');

//VERIFICAR UN ESTUDIANTES ANTES DE REGISTRARLO

const btnBuscar = document.querySelector('#btn-buscar');
const btn_nuevo = document.querySelector('#btn_nuevo')
const frmEstudiante = document.querySelector('#frmEstudiante');
// const codigo = document.querySelector('#codigo');
const nomcompleto = document.querySelector('#nomcompleto');
// const nombre = document.querySelector('#nombre');
// const apellido = document.querySelector('#apellido');
const aula = document.querySelector('#aula');
const sede = document.querySelector('#sede');
const imagen = document.querySelector('#file');
const imgArea = document.querySelector('.img-area');



document.addEventListener('DOMContentLoaded', function () {
    btnRegistrar.disabled = true;
    btn_nuevo.disabled = true;
    codigo.focus();
    // contactForm.onsubmit = function (e) {
    //     e.preventDefault();
    //     if (codigo.value == '') {
    //         message('error', 'EL CODIGO ES REQUERIDO');
    //     } else {
    //         const data = new FormData(contactForm);
    //         axios.post(ruta + 'controllers/asistenciaController.php?option=registrarAsistencia', data)
    //             .then(function (response) {
    //                 const info = response.data;
    //                 message(info.tipo, info.mensaje);
    //                 if (info.tipo == 'success') {
    //                     codigo.value = '';
    //                     codigo.focus();
    //                 }
    //             })
    //             .catch(function (error) {
    //                 console.log(error);
    //             });
    //     }

    // }

    contactForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const codEstudiante = codigo.value.trim();
        if (codigo.value == '') {
            message('error', 'EL CODIGO ES REQUERIDO');
        } else {
            // Realizar la solicitud AJAX para obtener la información del estudiante por su código
            axios.get(ruta + 'controllers/estudiantesController.php?option=searchxQr&codigo=' + codEstudiante)
                .then(function (response) {
                    const estudiante = response.data;
                    console.log(estudiante);

                    if (estudiante) {

                        // Actualizar los elementos <label> con la información del estudiante
                        const nombreCompleto = (estudiante.nombre + ' ' + estudiante.apellido).toUpperCase();
                        nomcompleto.innerText = nombreCompleto;
                        // nombre.innerText = estudiante.nombre;
                        // apellido.innerText = estudiante.apellido;
                        aula.innerText = estudiante.aula;
                        sede.innerText = estudiante.sede;

                        console.log(estudiante.imagen);
                        const img = document.createElement('img');
                        if (estudiante.imagen !== "") {
                            img.src = '../assets/images/estudiante/' + estudiante.imagen;
                        } else {
                            img.src = '../assets/images/default.png';
                        }
                        imgArea.appendChild(img);
                        // Mostrar mensaje de éxito
                        codigo.focus();
                        message('success', 'Estudiante encontrado con éxito');
                        btnRegistrar.disabled = false;
                        btn_nuevo.disabled = false;
                        btnBuscar.disabled = true;
                    } else {
                        // Mostrar mensaje de error si el código no existe
                        message('error', 'El código no existe');
                        limpiarFormulario();
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

    });


    // Agregamos un event listener para escuchar el clic en el botón de registro
    btnRegistrar.addEventListener('click', function (e) {
        e.preventDefault(); // Prevenimos el comportamiento por defecto del botón

        // Verificamos si el campo de código está vacío
        if (codigo.value == '') {
            message('error', 'EL CODIGO ES REQUERIDO');
        } else {
            const data = new FormData(contactForm);
            axios.post(ruta + 'controllers/asistenciaController.php?option=registrarAsistencia', data)
                .then(function (response) {
                    const info = response.data;
                    console.log(info);
                    message(info.tipo, info.mensaje);
                    if (info.tipo == 'success') {
                        codigo.value = '';
                        codigo.focus();
                        limpiarFormulario();
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    });

    function limpiarFormulario() {
        contactForm.reset();
        btnRegistrar.disabled = true;
        btn_nuevo.disabled = true;
        btnBuscar.disabled = false;
        // nombre.innerText = '';
        // apellido.innerText = '';
        nomcompleto.innerText = '';
        aula.innerText = '';
        sede.innerText = '';
        codigo.focus();
        const img = imgArea.querySelector('img');
        if (img) {
            img.remove(); // Eliminar la imagen si existe
            imgArea.classList.remove('active'); // Eliminar la clase "active" del contenedor de la imagen
        }
    }

    btn_nuevo.onclick = limpiarFormulario;

    // Agregar un event listener para el clic en la imagen
    imgArea.addEventListener('click', function () {
        // Verificar si hay una imagen presente
        const img = imgArea.querySelector('img');
        if (img) {
            // Aplicar el efecto de zoom
            img.classList.toggle('zoom');
        } else {
            // Si no hay una imagen presente, mostrar un mensaje
            // alert('No hay imagen cargada');
            message('error', 'No hay imagen cargada');
        }
    });


})