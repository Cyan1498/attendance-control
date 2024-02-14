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
                <div class="col-md-4">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="codigo">Código</label>
                            <div class="input-group">
                                <input id="codigo" class="form-control" type="text" name="codigo" >
                                <button class="btn btn-primary" type="submit" id="btn-buscar">Buscar</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="apellido">Apellidos</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sede">Sede</label>
                            <input type="text" class="form-control" id="sede" name="sede" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="telefono">Telefono</label>
                                <input type="number" class="form-control" id="telefono" name="telefono" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="aula">Aula</label>
                                <input type="text" class="form-control" id="aula" name="aula" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>