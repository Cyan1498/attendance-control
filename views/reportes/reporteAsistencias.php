<link rel="stylesheet" href="<?php echo RUTA . 'assets/'; ?>css/dtbuttons.css">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nivel">Fecha Inicial</label>
                    <!-- <input id="f2" type="text" class="form-control form-control-lg text-center mydp"> -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary text-white"><i class="fas fa-calendar-alt"></i></span>
                        </div>
                        <input id="f1" type="text" class="form-control form-control-lg mydp" placeholder="Seleccione fecha inicial">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nivel">Fecha Final</label>
                    <!-- <input id="f2" type="text" class="form-control form-control-lg text-center mydp"> -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary text-white"><i class="fas fa-calendar-alt"></i></span>
                        </div>
                        <input id="f2" type="text" class="form-control form-control-lg mydp" placeholder="Seleccione fecha final">
                        <!-- <input type="text" class="form-control" placeholder="Seleccione Fecha Inicial" aria-label="Amount (to the nearest dollar)"> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-4">
                <div class="form-group">
                    <button type="submit" class="btn-custom-purple" id="btn-filtrar">Buscar</button>
                    <button type="button" class="btn-custom-red" id="btn-clear">Limpiar</button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover" style="width: 100%;" id="tbl_reporteAsistencias">
                <thead style="background-color: hsl(227, 34%, 15%);">
                    <tr>
                        <th scope="col" style="color: #fff;">Id</th>
                        <th scope="col" style="color: #fff;">Fecha</th>
                        <th scope="col" style="color: #fff;">Código</th>
                        <th scope="col" style="color: #fff;">Estudiante</th>
                        <th scope="col" style="color: #fff;">Aula</th>
                        <th scope="col" style="color: #fff;">Sede</th>
                        <th scope="col" style="color: #fff;">Ingreso</th>
                        <th scope="col" style="color: #fff;">Salida</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>