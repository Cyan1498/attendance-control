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

    //desde aqui
    public function registrarSalidaSinEntrada($salida, $fecha, $id_estudiante)
    {
        $consult = $this->pdo->prepare("INSERT INTO asistencias (salida, fecha, id_estudiante) VALUES (?,?,?)");
        return $consult->execute([$salida, $fecha, $id_estudiante]);
    }
    public function verificarSalida($fecha, $id_estudiante) {
        $consulta = $this->pdo->prepare("SELECT * FROM asistencias WHERE fecha = ? AND id_estudiante = ? AND salida IS NOT NULL LIMIT 1");
        $consulta->execute([$fecha, $id_estudiante]);
        return $consulta->fetch(PDO::FETCH_ASSOC);
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

    //Para el reporte
    public function getInasxfechActual()
    {
        $consult = $this->pdo->prepare(
            "SELECT 
            e.id, 
            e.codigo, 
            CONCAT(e.nombre, ' ', e.apellido) AS nombre_estudiante, 
            aulas.nombre AS aula, 
            sedes.nombre AS sede, 
            CURDATE() AS fecha,
            CASE 
                WHEN a.ingreso IS NULL AND a.salida IS NULL THEN 'Faltó en ambos turnos'
                WHEN a.ingreso IS NULL THEN 'Faltó en la mañana'
                WHEN a.salida IS NULL THEN 'Faltó en la tarde'
                ELSE 'Asistió en ambos turnos'
            END AS estado_turno
        FROM estudiantes e
        LEFT JOIN asistencias a ON e.id = a.id_estudiante AND DATE(a.fecha) = CURDATE()
        LEFT JOIN aulas ON e.id_aula = aulas.id
        LEFT JOIN sedes ON e.id_sede = sedes.id
        WHERE 
            (a.ingreso IS NULL AND a.salida IS NOT NULL) -- Faltó en la mañana
            OR
            (a.ingreso IS NOT NULL AND a.salida IS NULL) -- Faltó en la tarde
            OR
            (a.ingreso IS NULL AND a.salida IS NULL) -- Faltó en ambos turnos
    ;"
        );
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getInasistenciasPorRangoFechas($fechaInicial, $fechaFinal)
{
    $consulta = $this->pdo->prepare(
        "SELECT 
            e.id, 
            e.codigo, 
            CONCAT(e.nombre, ' ', e.apellido) AS nombre_estudiante, 
            aulas.nombre AS aula, 
            sedes.nombre AS sede,
            fecha.fecha AS fecha,
            CASE 
                WHEN a.ingreso IS NULL AND a.salida IS NULL THEN 'Faltó en ambos turnos'
                WHEN a.ingreso IS NULL THEN 'Faltó en la mañana'
                WHEN a.salida IS NULL THEN 'Faltó en la tarde'
                ELSE 'Asistió en ambos turnos'
            END AS estado_turno
        FROM (
            SELECT :fechaInicial + INTERVAL a.a + b.a * 10 DAY AS fecha
            FROM (
                SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL
                SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
            ) AS a
            CROSS JOIN (
                SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL
                SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
            ) AS b
        ) AS fecha
        CROSS JOIN estudiantes e
        LEFT JOIN asistencias a ON e.id = a.id_estudiante AND DATE(a.fecha) = fecha.fecha
        LEFT JOIN aulas ON e.id_aula = aulas.id
        LEFT JOIN sedes ON e.id_sede = sedes.id
        WHERE ((a.id IS NULL)
            OR (a.ingreso IS NULL AND a.salida IS NOT NULL) -- Faltó en la mañana
            OR (a.ingreso IS NOT NULL AND a.salida IS NULL) -- Faltó en la tarde
            OR (a.ingreso IS NULL AND a.salida IS NULL)) -- Faltó en ambos turnos
            AND fecha.fecha BETWEEN :fechaInicial AND :fechaFinal -- Ajusta las fechas según sea necesario
        ORDER BY fecha.fecha, e.id;"
    );

    $consulta->execute(['fechaInicial' => $fechaInicial, 'fechaFinal' => $fechaFinal]);
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

}
