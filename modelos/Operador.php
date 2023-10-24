<?php
while(!file_exists('php'))
chdir(('..'));

include_once('php/conection.php');

class Operador extends DB
{
    private $idOperador;
    private $nombre;
    private $sueldo;
    private $idMaquina;



    /**
     * Get the value of idOperador
     */ 
    public function getIdOperador()
    {
        return $this->idOperador;
    }

    /**
     * Set the value of idOperador
     *
     * @return  self
     */ 
    public function setIdOperador($idOperador)
    {
        $this->idOperador = $idOperador;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of sueldo
     */ 
    public function getSueldo()
    {
        return $this->sueldo;
    }

    /**
     * Set the value of sueldo
     *
     * @return  self
     */ 
    public function setSueldo($sueldo)
    {
        $this->sueldo = $sueldo;

        return $this;
    }

    /**
     * Get the value of idMaquina
     */ 
    public function getIdMaquina()
    {
        return $this->idMaquina;
    }

    /**
     * Set the value of idMaquina
     *
     * @return  self
     */ 
    public function setIdMaquina($idMaquina)
    {
        $this->idMaquina = $idMaquina;

        return $this;
    }
}
?>