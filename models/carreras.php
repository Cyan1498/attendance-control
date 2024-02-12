<?php
require_once '../config.php';
require_once 'conexion.php';
class CarrerasModel{
    private $pdo, $con;
    public function __construct() {
        $this->con = new Conexion();
        $this->pdo = $this->con->conectar();
    }

    public function getCarreras()
    {
        $consult = $this->pdo->prepare("SELECT * FROM aulas WHERE estado = 1");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCarrera($id)
    {
        $consult = $this->pdo->prepare("SELECT * FROM aulas WHERE id = ?");
        $consult->execute([$id]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function comprobarNombre($nombre, $accion)
    {
        if ($accion == 0) {
            $consult = $this->pdo->prepare("SELECT * FROM aulas WHERE nombre = ?");
            $consult->execute([$nombre]);
        } else {
            $consult = $this->pdo->prepare("SELECT * FROM aulas WHERE nombre = ? AND id != ?");
            $consult->execute([$nombre, $accion]);
        }
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function save($nombre)
    {
        $consult = $this->pdo->prepare("INSERT INTO aulas (nombre) VALUES (?)");
        return $consult->execute([$nombre]);
    }

    public function delete($id)
    {
        $consult = $this->pdo->prepare("UPDATE aulas SET estado = ? WHERE id = ?");
        return $consult->execute([0, $id]);
    }

    public function update($nombre, $id)
    {
        $consult = $this->pdo->prepare("UPDATE aulas SET nombre=? WHERE id=?");
        return $consult->execute([$nombre, $id]);
    }
}
