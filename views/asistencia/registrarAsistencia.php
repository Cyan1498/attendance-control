<link rel="stylesheet" href="<?php echo RUTA . 'assets/'; ?>css/snackbar.min.css">
<link href="<?php echo RUTA . 'assets/index/'; ?>css/styles.css" rel="stylesheet" />

<form id="contactForm" autocomplete="off">
    <div class="card">
        <div class="card-body">
            <div class="masthead-content text-black">
                <div class="container-fluid px-lg-0">
                    <div class="widget">
                        <!-- <div class="fecha">
                            <p id="diaSemana" class="diaSemana"></p>
                            <p id="dia" class="dia"></p>
                            <p>de </p>
                            <p id="mes" class="mes"></p>
                            <p>del </p>
                            <p id="year" class="year"></p>
                        </div> -->
                        <!-- <div class="reloj">
                            <p id="horas" class="horas"></p>
                            <p>:</p>
                            <p id="minutos" class="minutos"></p>
                            <p>:</p>
                            <div class="caja-segundos">
                                <p id="segundos" class="segundos"></p>
                                <p id="ampm" class="ampm"></p>
                            </div>
                        </div> -->
                    </div>
                    <h1 class="fst-italic lh-1 mb-4">Registro de asistencia</h1>
                    <p class="mb-5">Entradas y salidas de estudiantes</p>

                    <!-- Email address input-->
                    <div class="row input-group-newsletter">
                        <div class="col"><input class="form-control" id="codigo" name="codigo" type="text" placeholder="Ingrese código de estudiante" /></div>
                        <div class="col-auto"><button class="btn btn-primary" id="submitButton" type="submit">Registrar</button></div>
                    </div>

                    <!-- Social Icons-->
                    <div class="social-icons">
                        <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center align-content-start h-50 mt-3 mt-lg-0">
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
    </div>
</form>
