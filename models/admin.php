<?php
require_once '../config.php';
require_once 'conexion.php';
class AdminModel
{
    private $pdo, $con;
    public function __construct()
    {
        $this->con = new Conexion();
        $this->pdo = $this->con->conectar();
    }

    public function getDatos($table)
    {
        $consult = $this->pdo->prepare("SELECT COUNT(*) AS total FROM $table WHERE estado = ?");
        $consult->execute([1]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function getAsistencia($fecha)
    {
        $consult = $this->pdo->prepare("SELECT COUNT(*) AS total FROM asistencias WHERE fecha = ?");
        $consult->execute([$fecha]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function getDato()
    {
        $consult = $this->pdo->prepare("SELECT * FROM configuracion");
        $consult->execute();
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function saveDatos($nombre, $telefono, $correo, $direccion, $id)
    {
        $consult = $this->pdo->prepare("UPDATE configuracion SET nombre=?, telefono=?, email=?, direccion=? WHERE id = ?");
        return $consult->execute([$nombre, $telefono, $correo, $direccion, $id]);
    }

    public function getAsistenciasDiarias($fechaInicial, $fechaFinal)
    {
        $consult = $this->pdo->prepare("
            SELECT DATE(fecha) AS fecha, COUNT(*) AS total 
            FROM asistencias 
            WHERE fecha BETWEEN ? AND ? 
            GROUP BY DATE(fecha)
        ");
        $consult->execute([$fechaInicial, $fechaFinal]);
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWeekAsistencias()
    {
        $dt = new DateTime();
        $asistenciasSemana = [];

        for ($d = 1; $d <= 7; $d++) {
            // Establecer la fecha actual con el día de la semana iterado
            $dt->setISODate($dt->format('o'), $dt->format('W'), $d);

            // Obtener la fecha en formato Y-m-d
            $fecha = $dt->format('Y-m-d');

            // Llamar a tu método para obtener las asistencias de ese día
            $asistencias = $this->getAsistenciasDia($fecha);

            // Agregar el total de asistencias de ese día al arreglo
            $asistenciasSemana[] = $asistencias;
        }

        return $asistenciasSemana;
    }

    // Método para obtener las asistencias de un día específico
    public function getAsistenciasDia($fecha)
    {
        $consult = $this->pdo->prepare("SELECT COUNT(*) AS total FROM asistencias WHERE DATE(fecha) = ?");
        $consult->execute([$fecha]);
        $result = $consult->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }
}
