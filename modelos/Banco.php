<?php
while(!file_exists('php'))
chdir(('..'));

include_once('php/conection.php');

class Banco extends DB
{
    private $idTipoPago;
    private $nombre;

    /**
     * Get the value of idTipoPago
     */ 
    public function getIdTipoPago()
    {
        return $this->idTipoPago;
    }

    /**
     * Set the value of idTipoPago
     *
     * @return  self
     */ 
    public function setIdTipoPago($idTipoPago)
    {
        $this->idTipoPago = $idTipoPago;

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
}
?>