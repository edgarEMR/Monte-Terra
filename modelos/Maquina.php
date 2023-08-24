<?php
while(!file_exists('php'))
chdir(('..'));

include_once('php/conection.php');

class Maquina extends DB
{
    private $idMaquinaria;
    private $nombre;
    private $costo;
    private $idRecurrencia;

    /**
     * Get the value of idMaquinaria
     */ 
    public function getIdMaquinaria()
    {
        return $this->idMaquinaria;
    }

    /**
     * Set the value of idMaquinaria
     *
     * @return  self
     */ 
    public function setIdMaquinaria($idMaquinaria)
    {
        $this->idMaquinaria = $idMaquinaria;

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
     * Get the value of costo
     */ 
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * Set the value of costo
     *
     * @return  self
     */ 
    public function setCosto($costo)
    {
        $this->costo = $costo;

        return $this;
    }

    /**
     * Get the value of idRecurrencia
     */ 
    public function getIdRecurrencia()
    {
        return $this->idRecurrencia;
    }

    /**
     * Set the value of idRecurrencia
     *
     * @return  self
     */ 
    public function setIdRecurrencia($idRecurrencia)
    {
        $this->idRecurrencia = $idRecurrencia;

        return $this;
    }
}
?>