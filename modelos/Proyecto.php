<?php 

while(!file_exists('php'))
chdir(('..'));

include_once('php/conection.php');

class Proyecto extends DB
{
    private $idProyecto;
    private $nombre;
    private $totalCasas;
    private $totalEtapas;
    private $prototipos;
    private $manzanas;
    private $metrosBase;
    private $activo;

    /**
     * Get the value of idProyecto
     */ 
    public function getIdProyecto()
    {
        return $this->idProyecto;
    }

    /**
     * Set the value of idProyecto
     *
     * @return  self
     */ 
    public function setIdProyecto($idProyecto)
    {
        $this->idProyecto = $idProyecto;

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
     * Get the value of totalCasas
     */ 
    public function getTotalCasas()
    {
        return $this->totalCasas;
    }

    /**
     * Set the value of totalCasas
     *
     * @return  self
     */ 
    public function setTotalCasas($totalCasas)
    {
        $this->totalCasas = $totalCasas;

        return $this;
    }

    /**
     * Get the value of totalEtapas
     */ 
    public function getTotalEtapas()
    {
        return $this->totalEtapas;
    }

    /**
     * Set the value of totalEtapas
     *
     * @return  self
     */ 
    public function setTotalEtapas($totalEtapas)
    {
        $this->totalEtapas = $totalEtapas;

        return $this;
    }

    /**
     * Get the value of presupuesto
     */ 
    public function getPrototipos()
    {
        return $this->prototipos;
    }

    /**
     * Set the value of presupuesto
     *
     * @return  self
     */ 
    public function setPrototipos($prototipos)
    {
        $this->prototipos = $prototipos;

        return $this;
    }

    /**
     * Get the value of manzanas
     */ 
    public function getManzanas()
    {
        return $this->manzanas;
    }

    /**
     * Set the value of manzanas
     *
     * @return  self
     */ 
    public function setManzanas($manzanas)
    {
        $this->manzanas = $manzanas;

        return $this;
    }

    /**
     * Get the value of activo
     */ 
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set the value of activo
     *
     * @return  self
     */ 
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get the value of metrosBase
     */ 
    public function getMetrosBase()
    {
        return $this->metrosBase;
    }

    /**
     * Set the value of metrosBase
     *
     * @return  self
     */ 
    public function setMetrosBase($metrosBase)
    {
        $this->metrosBase = $metrosBase;

        return $this;
    }
}
?>