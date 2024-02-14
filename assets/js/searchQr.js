
// const btnBuscar = document.querySelector('#btn-buscar');
const frmEstudiante = document.querySelector('#frmEstudiante');
const codigo = document.querySelector('#codigo');
const nombre = document.querySelector('#nombre');
const apellido = document.querySelector('#apellido');
const telefono = document.querySelector('#telefono');
const direccionEstudiante = document.querySelector('#direccion');
const aula = document.querySelector('#aula');
const sede = document.querySelector('#sede');
const imagen = document.querySelector('#file');
const imgArea = document.querySelector('.img-area');

document.addEventListener('DOMContentLoaded', function () {


    frmEstudiante.addEventListener('submit', function (e) {
        e.preventDefault(); 
        const codEstudiante = codigo.value;

        // Validar si se ingresó un código
        if (codEstudiante.trim() === '') {
            // Mostrar mensaje de error si no se ingresó un código
            message('error', 'Ingrese un código');
            return; // Detener la ejecución de la función
        }

        // Realizar la solicitud AJAX para obtener la información del estudiante por su código
        axios.get(ruta + 'controllers/estudiantesController.php?option=searchxQr&codigo=' + codEstudiante)
            .then(function (response) {
                const estudiante = response.data;
                console.log(estudiante);

                if (estudiante) {
                    // Actualizar los elementos <label> con la información del estudiante
                    nombre.value = estudiante.nombre;
                    apellido.value = estudiante.apellido;
                    telefono.value = estudiante.telefono;
                    direccionEstudiante.value = estudiante.direccion;
                    aula.value = estudiante.aula;
                    sede.value = estudiante.sede;

                    // Actualizar la imagen del estudiante
                    const img = document.createElement('img');
                    img.src = '../assets/images/estudiante/' + estudiante.imagen;
                    imgArea.appendChild(img);
                    // Mostrar mensaje de éxito
                    codigo.focus();
                    message('success', 'Estudiante encontrado con éxito');
                } else {
                    // Mostrar mensaje de error si el código no existe
                    message('error', 'El código no existe');
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    });

});
