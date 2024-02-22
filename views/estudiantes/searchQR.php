<link rel="stylesheet" href="<?php echo RUTA . 'assets/'; ?>css/uploadImg.css">
<form id="frmEstudiante" autocomplete="off" enctype="multipart/form-data">
    <div class="card mb-2">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <div class="container">
                            <div class="img-area" data-img="">
                                <i class='bx bxs-user icon'></i>
                                <!-- <i class='bx bxs-user-circle icon' ></i> -->
                                <input type="file" id="file" accept="image/*" hidden>
                                <h4>Foto Estudiante</h4>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" style="background-color: hsl(227, 34%, 15%); color: #fff;">
                            DATOS DEL ESTUDIANTE
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Ingrese un código">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <label class="form-control" id="nombre" name="nombre"></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido">Apellidos</label>
                                        <label class="form-control" id="apellido" name="apellido"></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sede">Sede</label>
                                        <label class="form-control" id="sede" name="sede"></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="aula">Aula</label>
                                        <label class="form-control" id="aula" name="aula" disabled></label>
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
</form>