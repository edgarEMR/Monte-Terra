<?php
while(!file_exists('php'))
chdir(('..'));

include_once('php/conection.php');

class Aportador extends DB
{
    private $idAportador;
    private $nombre;
    private $RFC;
    private $proyecto;

    /**
     * Get the value of idAportador
     */ 
    public function getIdAportador()
    {
        return $this->idAportador;
    }

    /**
     * Set the value of idAportador
     *
     * @return  self
     */ 
    public function setIdAportador($idAportador)
    {
        $this->idAportador = $idAportador;

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

    /**
     * Get the value of proyecto
     */ 
    public function getProyecto()
    {
        return $this->proyecto;
    }

    /**
     * Set the value of proyecto
     *
     * @return  self
     */ 
    public function setProyecto($proyecto)
    {
        $this->proyecto = $proyecto;

        return $this;
    }
}
?>