<link href="<?php echo RUTA . 'assets/index/'; ?>css/style2.css" rel="stylesheet" />
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

                    <!-- Email address input-->
                    <div class="row input-group-newsletter">
                        <div class="col"><input class="form-control" id="codigo" name="codigo" type="text" placeholder="Ingrese código de estudiante" /></div>
                        <div class="col-auto"><button class="btn btn-primary" id="submitButton" type="submit">Registrar</button></div>
                    </div>

                    <!-- Social Icons-->
                    <div class="checkbox-wrapper-6">
                        <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center align-content-start h-100 mt-3 mt-lg-10">
                            <div class="wrapper">
                                <input type="radio" name="radio" value="entrada" id="option-1" checked />
                                <input type="radio" name="radio" value="salida" id="option-2" />
                                <label for="option-1" class="option option-1">
                                    <div class="dot"></div>
                                    <span>Turno Mañana</span>
                                </label>
                                <label for="option-2" class="option option-2">
                                    <div class="dot"></div>
                                    <span>Turno Tarde</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>