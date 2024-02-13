<form id="frmEstudiante" autocomplete="off" enctype="multipart/form-data">
    <div class="card mb-2">
        <div class="card-body">
            <!-- Campo oculto para almacenar el nombre de la imagen anterior -->
            <input type="hidden" id="img_anterior" name="img_anterior" value="">
            <input type="hidden" id="id_estudiante" name="id_estudiante">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <div class="container">
                            <input type="file" id="file" accept="image/*" hidden>
                            <div class="img-area" data-img="">
                                <i class='bx bxs-cloud-upload icon'></i>
                                <h3>Upload Image</h3>
                                <p>Image size must be less than <span>2MB</span></p>
                            </div>
                            <button class="select-image" type="button">Select Image</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="codigo">Código <span class="text-danger">*</span></label>
                            <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Código">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="nombre">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="apellido">Apellidos <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellidos">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nivel">Sede <span class="text-danger">*</span></label>
                            <select id="nivel" class="form-control" name="nivel">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="telefono">Telefono</label>
                                <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Telefono">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="carrera">Aula <span class="text-danger">*</span></label>
                                <select id="carrera" class="form-control" name="carrera">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="button" class="btn btn-danger" id="btn-nuevo">Nuevo</button>
            <button type="submit" class="btn btn-primary" id="btn-save">Guardar</button>
        </div>
    </div>
</form>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover" style="width: 100%;" id="table_estudiantes">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Aula</th>
                        <th scope="col">Código</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Sede</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>