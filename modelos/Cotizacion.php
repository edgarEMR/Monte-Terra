<?php
while(!file_exists('php'))
chdir(('..'));

include_once('php/conection.php');

class Cotizacion extends DB
{
    private $idCotizacion;
    private $concepto;
    private $importe;
    private $fecha;
    private $idArea;
    private $idEtapa;
    private $idProyecto;


    /**
     * Get the value of concepto
     */ 
    public function getConcepto()
    {
        return $this->concepto;
    }

    /**
     * Set the value of concepto
     *
     * @return  self
     */ 
    public function setConcepto($concepto)
    {
        $this->concepto = $concepto;

        return $this;
    }

    /**
     * Get the value of importe
     */ 
    public function getImporte()
    {
        return $this->importe;
    }

    /**
     * Set the value of importe
     *
     * @return  self
     */ 
    public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

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
     * Get the value of idArea
     */ 
    public function getIdArea()
    {
        return $this->idArea;
    }

    /**
     * Set the value of idArea
     *
     * @return  self
     */ 
    public function setIdArea($idArea)
    {
        $this->idArea = $idArea;

        return $this;
    }

    /**
     * Get the value of idCotizacion
     */ 
    public function getIdCotizacion()
    {
        return $this->idCotizacion;
    }

    /**
     * Set the value of idCotizacion
     *
     * @return  self
     */ 
    public function setIdCotizacion($idCotizacion)
    {
        $this->idCotizacion = $idCotizacion;

        return $this;
    }

    /**
     * Get the value of idEtapa
     */ 
    public function getIdEtapa()
    {
        return $this->idEtapa;
    }

    /**
     * Set the value of idEtapa
     *
     * @return  self
     */ 
    public function setIdEtapa($idEtapa)
    {
        $this->idEtapa = $idEtapa;

        return $this;
    }
}
?>