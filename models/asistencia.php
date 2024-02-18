<?php
require_once '../config.php';
require_once 'conexion.php';
class AsistenciaModel
{
    private $pdo, $con;
    public function __construct()
    {
        $this->con = new Conexion();
        $this->pdo = $this->con->conectar();
    }

    public function getAsistencias()
    {
        $consult = $this->pdo->prepare("SELECT a.*, e.codigo, CONCAT(e.nombre, ' ', e.apellido) AS estudiante, c.nombre AS aula, n.nombre AS sede FROM asistencias a INNER JOIN estudiantes e ON a.id_estudiante = e.id INNER JOIN aulas c ON e.id_aula = c.id INNER JOIN sedes n ON e.id_sede = n.id");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFiltro($aula, $sede)
    {
        $consult = $this->pdo->prepare("SELECT a.*, CONCAT(e.nombre, ' ', e.apellido) AS estudiante FROM asistencias a INNER JOIN estudiantes e ON a.id_estudiante = e.id INNER JOIN aulas c ON e.id_aula = c.id INNER JOIN sedes n ON e.id_sede = n.id WHERE c.id = ? AND n.id = ?");
        $consult->execute([$aula, $sede]);
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFiltroAsistencia($id_estudiante)
    {
        $consult = $this->pdo->prepare("SELECT a.*, CONCAT(e.nombre, ' ', e.apellido) AS estudiante FROM asistencias a INNER JOIN estudiantes e ON a.id_estudiante = e.id WHERE a.id_estudiante = ?");
        $consult->execute([$id_estudiante]);
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    //

    public function getEstudiante($codigo)
    {
        $consult = $this->pdo->prepare("SELECT * FROM estudiantes WHERE codigo = ? AND estado = ?");
        $consult->execute([$codigo, 1]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function getAsistencia($fecha, $id_estudiante)
    {
        $consult = $this->pdo->prepare("SELECT * FROM asistencias WHERE fecha = ? AND id_estudiante = ?");
        $consult->execute([$fecha, $id_estudiante]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function registrarEntrada($entrada, $fecha, $id_estudiante)
    {
        $consult = $this->pdo->prepare("INSERT INTO asistencias (ingreso, fecha, id_estudiante) VALUES (?,?,?)");
        return $consult->execute([$entrada, $fecha, $id_estudiante]);
    }

    public function registrarSalida($salida, $id)
    {
        $consult = $this->pdo->prepare("UPDATE asistencias SET salida=? WHERE id = ?");
        return $consult->execute([$salida, $id]);
    }

    public function buscarEstudiante($valor)
    {
        $consult = $this->pdo->prepare("SELECT * FROM estudiantes WHERE (nombre LIKE '%" . $valor . "%' OR apellido LIKE '%" . $valor . "%') AND estado = 1 LIMIT 10");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }
    //Para el reporte
    public function getAsisxfechActual()
    {
        $consult = $this->pdo->prepare(
            "SELECT a.*, 
                e.codigo, 
                CONCAT(e.nombre, ' ', e.apellido) AS estudiante, 
                c.nombre AS aula, 
                n.nombre AS sede 
                FROM asistencias a 
                INNER JOIN estudiantes e 
                ON a.id_estudiante = e.id 
                INNER JOIN aulas c 
                ON e.id_aula = c.id 
                INNER JOIN sedes n 
                ON e.id_sede = n.id
                WHERE DATE(a.fecha) = CURRENT_DATE()"
        );
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAsistenciasxFechas($fechaInicial, $fechaFinal)
    {
        $consult = $this->pdo->prepare(
            "SELECT a.*, 
                e.codigo, 
                CONCAT(e.nombre, ' ', e.apellido) AS estudiante, 
                c.nombre AS aula, 
                n.nombre AS sede 
                FROM asistencias a 
                INNER JOIN estudiantes e 
                ON a.id_estudiante = e.id 
                INNER JOIN aulas c 
                ON e.id_aula = c.id 
                INNER JOIN sedes n 
                ON e.id_sede = n.id 
                WHERE a.fecha BETWEEN ? AND ?"
        );
        $consult->execute([$fechaInicial, $fechaFinal]);
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }
}
