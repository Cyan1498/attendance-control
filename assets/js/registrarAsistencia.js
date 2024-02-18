const contactForm = document.querySelector('#contactForm');
const codigo = document.querySelector('#codigo');
const entrada = document.querySelector('#entrada');
const salida = document.querySelector('#salida');
document.addEventListener('DOMContentLoaded', function () {
    codigo.focus();
    contactForm.onsubmit = function (e) {
        e.preventDefault();
        if (codigo.value == '') {
            message('error', 'EL CODIGO ES REQUERIDO');
        } else {
            const data = new FormData(contactForm);
            axios.post(ruta + 'controllers/asistenciaController.php?option=registrarAsistencia', data)
                .then(function (response) {
                    const info = response.data;
                    message(info.tipo, info.mensaje);
                    if (info.tipo == 'success') {
                        codigo.value = '';
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

    }
})