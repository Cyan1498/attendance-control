<link href="<?php echo RUTA . 'assets/index/'; ?>css/style2.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo RUTA . 'assets/'; ?>css/img_assistance.css">
<form id="contactForm" autocomplete="off">
    <div class="card">
        <div class="card-body">
            <div class="masthead-content text-black">
                <div class="container-fluid px-lg-0">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h1 class="fst-italic lh-1 mb-4">Registro de asistencia</h1>

                            <!-- Email address input-->
                            <div class="row input-group-newsletter">
                                <div class="col"><input class="form-control" id="codigo" name="codigo" type="text" placeholder="Ingrese código de estudiante" /></div>
                                <div class="col-auto"><button class="btn btn-primary" id="btnRegistrar" type="button">Registrar</button></div>
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
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" style="background-color: hsl(227, 34%, 15%); color: #fff;">
                                        DATOS DEL ESTUDIANTE
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="container">
                                                        <div class="img-area" data-img="">
                                                            <i class='bx bxs-user icon'></i>
                                                            <input type="file" id="file" accept="image/*" hidden>
                                                            <!-- <h4>Foto Estudiante</h4> -->
                                                            <!-- Fondo oscurecido -->
                                                            <div class="overlay"></div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <!-- <label for="nombre">NombreCompleto</label> -->
                                                    <span><b>NOMBRE: </b></span><label id="nomcompleto" name="nomcompleto"></label>
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label for="nombre">Nombre</label>
                                                    <label class="form-control" id="nombre" name="nombre"></label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="apellido">Apellidos</label>
                                                    <label class="form-control" id="apellido" name="apellido"></label>
                                                </div> -->
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <!-- <label for="sede">Sede</label> -->
                                                    <span><b>SEDE: </b></span><label id="sede" name="sede"></label>
                                                </div>
                                                <div class="form-group">
                                                    <!-- <label for="aula">Aula</label> -->
                                                    <span><b>AULA: </b> </span><label id="aula" name="aula" disabled></label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end mt-3">
                                    <div class="col-auto">
                                        <button class="btn btn-primary" type="submit" id="btn-buscar">Buscar</button>
                                        <button class="btn btn-danger" type="button" id="btn_nuevo">Limpiar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>