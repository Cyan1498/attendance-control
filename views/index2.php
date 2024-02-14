<form id="contactForm" autocomplete="off">
    <div class="card mb-2">
        <div class="card-body text-black">
            <div class="container-fluid px-lg-0">
                <div class="widget">
                    <div class="fecha">
                        <p id="diaSemana" class="diaSemana"></p>
                        <p id="dia" class="dia"></p>
                        <p>de </p>
                        <p id="mes" class="mes"></p>
                        <p>del </p>
                        <p id="year" class="year"></p>
                    </div>
                    <div class="reloj">
                        <p id="horas" class="horas"></p>
                        <p>:</p>
                        <p id="minutos" class="minutos"></p>
                        <p>:</p>
                        <div class="caja-segundos">
                            <p id="segundos" class="segundos"></p>
                            <p id="ampm" class="ampm"></p>
                        </div>
                    </div>
                </div>
                <h1 class="fst-italic lh-1 mb-4">Sistema de registro de asistencia</h1>
                <p class="mb-5">Entradas y salidas de estudiantes 2024</p>

                <!-- Email address input-->
                <div class="row input-group-newsletter">
                    <div class="col"><input class="form-control" id="codigo" name="codigo" type="text" placeholder="Ingrese código" /></div>
                    <div class="col-auto"><button class="btn btn-primary" id="submitButton" type="submit">Registrar</button></div>
                </div>

                <!-- Social Icons-->
                <div class="social-icons">
                    <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center h-100 mt-3 mt-lg-0">
                        <div>
                            <label>
                                <input type="radio" name="radio" value="entrada" checked />
                                <span>Entrada</span>
                            </label>
                            <label>
                                <input type="radio" name="radio" value="salida" />
                                <span>Salida</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="<?php echo RUTA . 'assets/'; ?>js/snackbar.min.js"></script>
<script src="<?php echo RUTA . 'assets/'; ?>js/axios.min.js"></script>
<script>
    const ruta = '<?php echo RUTA; ?>';

    function message(tipo, mensaje) {
        Snackbar.show({
            text: mensaje,
            pos: 'top-right',
            backgroundColor: tipo == 'success' ? '#079F00' : '#FF0303',
            actionText: 'Cerrar'
        });
    }
</script>
<script src="<?php echo RUTA . 'assets/index/'; ?>js/scripts.js"></script>