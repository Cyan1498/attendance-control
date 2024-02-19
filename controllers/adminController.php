<?php
require_once '../models/admin.php';
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
$admin = new AdminModel();
$id_user = $_SESSION['idusuario'];
switch ($option) {
    case 'totales':
        $fecha = date('Y-m-d');
        $fechaInicial = '2024-01-01'; // Reemplaza con la fecha inicial deseada
        $fechaFinal = '2024-12-31';
        $data['usuario'] = $admin->getDatos('usuario');
        $data['estudiante'] = $admin->getDatos('estudiantes');
        $data['asistencia'] = $admin->getAsistencia($fecha);
        // $data['asistenciasDiarias'] = $admin->getAsistenciasDiarias($fechaInicial, $fechaFinal); 
        $data['carrera'] = $admin->getDatos('aulas');
        echo json_encode($data);
        break;
    case 'datos':
        $data = $admin->getDato();
        echo json_encode($data);
        break;
    case 'save':
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $correo = $_POST['correo'];
        $id = $_POST['id'];
        if (empty($id) || empty($nombre)) {
            $res = array('tipo' => 'error', 'mensaje' => 'TODO LOS CAMPOS SON REQUERIDOS');
        } else {
            $result = $admin->saveDatos($nombre, $telefono, $correo, $direccion, $id);
            if ($result) {
                $res = array('tipo' => 'success', 'mensaje' => 'REGISTRO MODIFICADO');
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL MODIFICAR');
            }
        }
        echo json_encode($res);
        break;
    case 'weekAsistencias':
        $data = $admin->getWeekAsistencias();
        echo json_encode($data);
        break;
    default:
        # code...
        break;
}
