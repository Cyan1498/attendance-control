<?php
require_once '../models/estudiantes.php';
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
$estudiantes = new EstudiantesModel();
switch ($option) {
    case 'listar':
        $data = $estudiantes->getEstudiantes();
        for ($i = 0; $i < count($data); $i++) {
            $colorNivel = substr(md5($data[$i]['id_sede']), 0, 6);
            $colorCarrera = substr(md5($data[$i]['id_aula']), 0, 6);
            $data[$i]['nombres'] = $data[$i]['nombre'] . ' ' . $data[$i]['apellido'];
            $data[$i]['carreras'] = '<span class="badge mx-1" style="background: #' . $colorCarrera . ';">' . $data[$i]['aula'] . '</span>';
            $data[$i]['niveles'] = '<span class="badge mx-1" style="background: #' . $colorNivel . ';">' . $data[$i]['sede'] . '</span>';
            $data[$i]['accion'] = '<div class="d-flex">
                <a class="btn-custom-red btn-delete" onclick="deleteEst(' . $data[$i]['id'] . ')"><i class="fas fa-eraser"></i></a>
                <a class="btn-custom-purple btn-edit" onclick="editEst(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></a>
                </div>';
            // Agregar la ruta de la imagen a los datos del estudiante
            // $data[$i]['imagen'] = '<img src="' . $data[$i]['imagen'] . '" alt="Imagen del estudiante">';

            // $data[$i]['foto'] = '<img src="' . RUTA . "assets/images/estudiante/" . $data[$i]['imagen'] . '" alt="Imagen del estudiante" >';
            // Verificar si la imagen existe
            if ($data[$i]['imagen'] !== "") {
                // Si existe una imagen, usar la ruta correspondiente
                $data[$i]['foto'] = '<img src="' . RUTA . "assets/images/estudiante/" . $data[$i]['imagen'] . '" alt="Imagen del estudiante" >';
            } else {
                // Si no existe una imagen, usar la ruta de la imagen predeterminada
                $data[$i]['foto'] = '<img src="' . RUTA . "assets/images/default.png" . '" alt="Imagen del estudiante" >';
            }
        }
        echo json_encode($data);
        break;
    case 'save':
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        // $telefono = $_POST['telefono'];
        // $direccion = $_POST['direccion'];
        $carrera = $_POST['carrera'];
        $nivel = $_POST['nivel'];
        $id_estudiante = $_POST['id_estudiante'];

        // Obtener el nombre de la imagen anterior del formulario si está presente
        $img_anterior = isset($_POST['img_anterior']) ? $_POST['img_anterior'] : "";
        // Verificar si se ha enviado una imagen
        // $img = !empty($_FILES['image']) ? $_FILES['image']['name'] : "default.png";
        $img = !empty($_FILES['image']) ? $_FILES['image']['name'] : $img_anterior;


        // Guardar la imagen en el directorio
        if (!empty($_FILES['image'])) {
            $targetDir = '../assets/images/estudiante/';
            $targetFilePath = $targetDir . $img;

            // Eliminar la imagen anterior si existe
            if (!empty($img_anterior) && file_exists($targetDir . $img_anterior)) {
                unlink($targetDir . $img_anterior);
            }

            // Mover la nueva imagen al directorio
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                $res = array('tipo' => 'error', 'mensaje' => 'Error al guardar la imagen');
                echo json_encode($res);
                exit; // Terminar la ejecución
            }
        }
        if ($id_estudiante == '') {
            $consult = $estudiantes->comprobarCodigo($codigo, 0);
            if (empty($consult)) {
                // $result = $estudiantes->save($codigo, $nombre, $apellido, $telefono, $direccion, $img, $carrera, $nivel);
                $result = $estudiantes->save($codigo, $nombre, $apellido, $img, $carrera, $nivel);
                if ($result) {
                    $res = array('tipo' => 'success', 'mensaje' => 'ESTUDIANTE REGISTRADO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
                }
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'EL CODIGO YA EXISTE');
            }
        } else {
            $consult = $estudiantes->comprobarCodigo($codigo, $id_estudiante);
            if (empty($consult)) {
                $result = $estudiantes->update($codigo, $nombre, $apellido, $img, $carrera, $nivel, $id_estudiante);
                if ($result) {
                    $res = array('tipo' => 'success', 'mensaje' => 'ESTUDIANTE MODIFICADO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL MODIFICAR');
                }
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'EL CODIGO YA EXISTE');
            }
        }

        // Guardar la imagen en el directorio
        // if (!empty($_FILES['image'])) {
        //     $targetDir = '../assets/images/estudiante/';
        //     $targetFilePath = $targetDir . $img;
        //     if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
        //         $res = array('tipo' => 'error', 'mensaje' => 'Error al guardar la imagen');
        //     }
        // }
        echo json_encode($res);
        break;
    case 'delete':
        $id = $_GET['id'];
        $data = $estudiantes->delete($id);
        if ($data) {
            $res = array('tipo' => 'success', 'mensaje' => 'ESTUDIANTE ELIMINADO');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL ELIMINAR');
        }
        echo json_encode($res);
        break;
    case 'edit':
        $id = $_GET['id'];
        $data = $estudiantes->getEstudiante($id);
        echo json_encode($data);
        break;
    case 'datos':
        $item = $_GET['item'];
        $data = $estudiantes->getDatos($item);
        echo json_encode($data);
        break;
    default:
        # code...
        break;

    case 'searchxQr':
        $codigoEstudiante = $_GET['codigo'];
        $estudiante = $estudiantes->getEstudiantePorCodigo($codigoEstudiante);
        echo json_encode($estudiante);
        break;
}
