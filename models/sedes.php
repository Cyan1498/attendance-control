<?php
require_once '../config.php';
require_once 'conexion.php';
class SedesModel{
    private $pdo, $con;
    public function __construct() {
        $this->con = new Conexion();
        $this->pdo = $this->con->conectar();
    }

    public function getSedes()
    {
        $consult = $this->pdo->prepare("SELECT * FROM sedes WHERE estado = 1");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSede($id)
    {
        $consult = $this->pdo->prepare("SELECT * FROM sedes WHERE id = ?");
        $consult->execute([$id]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function comprobarNombre($nombre, $accion)
    {
        if ($accion == 0) {
            $consult = $this->pdo->prepare("SELECT * FROM sedes WHERE nombre = ?");
            $consult->execute([$nombre]);
        } else {
            $consult = $this->pdo->prepare("SELECT * FROM sedes WHERE nombre = ? AND id != ?");
            $consult->execute([$nombre, $accion]);
        }
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function save($nombre)
    {
        $consult = $this->pdo->prepare("INSERT INTO sedes (nombre) VALUES (?)");
        return $consult->execute([$nombre]);
    }

    public function delete($id)
    {
        $consult = $this->pdo->prepare("UPDATE sedes SET estado = ? WHERE id = ?");
        return $consult->execute([0, $id]);
    }

    public function update($nombre, $id)
    {
        $consult = $this->pdo->prepare("UPDATE sedes SET nombre=? WHERE id=?");
        return $consult->execute([$nombre, $id]);
    }
}
