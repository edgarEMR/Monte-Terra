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
    private $presupuesto;
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
    public function getPresupuesto()
    {
        return $this->presupuesto;
    }

    /**
     * Set the value of presupuesto
     *
     * @return  self
     */ 
    public function setPresupuesto($presupuesto)
    {
        $this->presupuesto = $presupuesto;

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
}
?>