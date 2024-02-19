<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Usuarios (Total)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalUsuarios">00</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users-cog fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Estudiantes (Total)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalEst">00</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Asistencias (Dia)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalAsistencia">00</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-th-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Canales (Total)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalCarreras">00</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-12 col-md-12 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sedeSelect">Seleccionar Sede:</label>
                    <select id="sedeSelect" class="form-control">
                        <option value="Chimbote">Chimbote</option>
                        <option value="Nv. Chimbote">Nv. Chimbote</option>
                    </select>
                </div>
            </div>
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        <!-- Usuarios (Total)</div> -->
                        <!-- <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalUsuarios">00</div> -->
                        <h4 class="p-3 text-center text-theme-1 font-bold">TOTAL DE ASISTENCIAS DIARIAS POR SEDE</h4>
                        <div id="chart-container"></div>

                    </div>
                    <!-- <div class="col-auto">
                        <i class="fas fa-users-cog fa-2x text-gray-300"></i>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
<div class="col-xl-6 col-md-12 mb-4"> <!-- Cambiar el tamaño para que quepan dos gráficos en una fila -->
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        <h4 class="p-3 text-center text-theme-1 font-bold">TOTAL DE ALUMNOS POR CANALES EN CHIMBOTE</h4>
                        <div id="chart-container-chimbote"></div> <!-- Contenedor del primer gráfico -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-6 col-md-12 mb-4"> <!-- Cambiar el tamaño para que quepan dos gráficos en una fila -->
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        <h4 class="p-3 text-center text-theme-1 font-bold">TOTAL DE ALUMNOS POR CANALES EN NV. CHIMBOTE</h4>
                        <div id="chart-container-NvChimbote"></div> <!-- Contenedor del segundo gráfico -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>