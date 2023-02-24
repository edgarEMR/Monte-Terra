<?php
while(!file_exists('php'))
chdir(('..'));

include_once('php/conection.php');

class Proveedor extends DB
{
    private $idProveedor;
    private $nombre;
    private $RFC;

    /**
     * Get the value of idAportador
     */ 
    public function getidProveedor()
    {
        return $this->idProveedor;
    }

    /**
     * Set the value of idAportador
     *
     * @return  self
     */ 
    public function setidProveedor($idProveedor)
    {
        $this->idProveedor = $idProveedor;

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
     * Get the value of RFC
     */ 
    public function getRFC()
    {
        return $this->RFC;
    }

    /**
     * Set the value of RFC
     *
     * @return  self
     */ 
    public function setRFC($RFC)
    {
        $this->RFC = $RFC;

        return $this;
    }
}
?>