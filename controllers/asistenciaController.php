<?php
require_once '../models/asistencia.php';
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
$asistencias = new AsistenciaModel();
switch ($option) {
    case 'listar':
        $data = $asistencias->getAsistencias();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['nombre'] = $data[$i]['estudiante'];
            $data[$i]['ingreso'] = '<span class="badge bg-info">' . $data[$i]['ingreso'] . '</span>';
            $data[$i]['salida'] = '<span class="badge bg-success">' . $data[$i]['salida'] . '</span>';
            $data[$i]['accion'] = '';
        }
        echo json_encode($data);
        break;
    case 'asistencia':
        $carrera = $_GET['carrera'];
        $nivel = $_GET['nivel'];
        $data = $asistencias->getFiltro($carrera, $nivel);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['start'] = $data[$i]['ingreso'];
            $data[$i]['end'] = $data[$i]['salida'];
            $data[$i]['title'] = $data[$i]['estudiante'];
        }
        echo json_encode($data);
        break;
    case 'verAsistencia':
        $estudiante = $_GET['estudiante'];
        $data = $asistencias->getFiltroAsistencia($estudiante);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['start'] = $data[$i]['fecha'];
            $data[$i]['color'] = '#00d082';
            // $data[$i]['end'] = $data[$i]['salida'];
            $data[$i]['title'] = $data[$i]['estudiante'];
        }
        echo json_encode($data);
        break;
    case 'registrarAsistencia':
        $codigo = $_POST['codigo'];
        $accion = $_POST['radio'];
        $consult = $asistencias->getEstudiante($codigo);
        if (empty($consult)) {
            $res = array('tipo' => 'error', 'mensaje' => 'EL CODIGO NO EXISTE');
        } else {
            $fecha = date('Y-m-d');
            if ($accion == 'entrada') {
                $entrada = date('Y-m-d H:i:s');
                $verificarEntrada = $asistencias->getAsistencia($fecha, $consult['id']);
                if (empty($verificarEntrada)) {
                    $registrar = $asistencias->registrarEntrada($entrada, $fecha, $consult['id']);
                    if ($registrar) {
                        $res = array('tipo' => 'success', 'mensaje' => 'INGRESO REGISTRADO');
                    } else {
                        $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL REGISTRAR');
                    }
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ENTRADA YA ESTA REGISTRADA');
                }
            } else {
                $salida = date('Y-m-d H:i:s');
                $verificarSalida = $asistencias->getAsistencia($fecha, $consult['id']);
                if (empty($verificarSalida)) {
                    $registrar = $asistencias->registrarSalida($salida, $fecha, $consult['id']);
                    if ($registrar) {
                        $res = array('tipo' => 'success', 'mensaje' => 'INGRESO REGISTRADO');
                    } else {
                        $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL REGISTRAR');
                    }
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ENTRADA YA ESTA REGISTRADA');
                }
            }
        }
        echo json_encode($res);
        break;
    case 'buscarEstudiante':
        $array = array();
        $valor = $_GET['term'];
        $data = $asistencias->buscarEstudiante($valor);
        foreach ($data as $row) {
            $result['id'] = $row['id'];
            $result['label'] = $row['nombre'] . ' ' . $row['apellido'];
            $result['carrera'] = $row['id_aula'];
            $result['nivel'] = $row['id_sede'];
            array_push($array, $result);
        }
        echo json_encode($array);
        break;
    case 'listarxfechaActual':
        $data = $asistencias->getAsisxfechActual();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['nombre'] = $data[$i]['estudiante'];
            $data[$i]['ingreso'] = '<span class="badge bg-info">' . $data[$i]['ingreso'] . '</span>';
            $data[$i]['salida'] = '<span class="badge bg-success">' . $data[$i]['salida'] . '</span>';
            $data[$i]['accion'] = '';
        }
        echo json_encode($data);
        break;

    case 'listarxRangoFechas':
        $fechaInicial = $_POST['fechaInicial'];
        $fechaFinal = $_POST['fechaFinal'];
        $data = $asistencias->getAsistenciasxFechas($fechaInicial, $fechaFinal);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['nombre'] = $data[$i]['estudiante'];
            $data[$i]['ingreso'] = '<span class="badge bg-info">' . $data[$i]['ingreso'] . '</span>';
            $data[$i]['salida'] = '<span class="badge bg-success">' . $data[$i]['salida'] . '</span>';
            $data[$i]['accion'] = '';
        }
        echo json_encode($data);
        break;
    default:
        # code...
        break;
    case 'listarInasxfechaActual':
        // $fechaActual = date('Y-m-d');
        $data = $asistencias->getInasxfechActual();
        echo json_encode($data);
        break;
    case 'listarInasxRangoFechas':
        $fechaInicial = $_POST['fechaInicial'];
        $fechaFinal = $_POST['fechaFinal'];
        $data = $asistencias->getInasistenciasPorRangoFechas($fechaInicial, $fechaFinal);
        echo json_encode($data);
        break;
}
