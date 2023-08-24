<?php
while(!file_exists('php'))
chdir(('..'));

include_once('php/conection.php');

class Cotizacion extends DB
{
    private $idCotizacion;
    private $concepto;
    private $numeroCasas;
    private $importeM2;
    private $metros2;
    private $importe;
    private $fecha;
    private $idFamilia;
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
     * Get the value of idFamilia
     */ 
    public function getIdFamilia()
    {
        return $this->idFamilia;
    }

    /**
     * Set the value of idFamilia
     *
     * @return  self
     */ 
    public function setIdFamilia($idFamilia)
    {
        $this->idFamilia = $idFamilia;

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

    /**
     * Get the value of numeroCasas
     */ 
    public function getNumeroCasas()
    {
        return $this->numeroCasas;
    }

    /**
     * Set the value of numeroCasas
     *
     * @return  self
     */ 
    public function setNumeroCasas($numeroCasas)
    {
        $this->numeroCasas = $numeroCasas;

        return $this;
    }

    /**
     * Get the value of importeM2
     */ 
    public function getImporteM2()
    {
        return $this->importeM2;
    }

    /**
     * Set the value of importeM2
     *
     * @return  self
     */ 
    public function setImporteM2($importeM2)
    {
        $this->importeM2 = $importeM2;

        return $this;
    }

    /**
     * Get the value of metros2
     */ 
    public function getMetros2()
    {
        return $this->metros2;
    }

    /**
     * Set the value of metros2
     *
     * @return  self
     */ 
    public function setMetros2($metros2)
    {
        $this->metros2 = $metros2;

        return $this;
    }
}
?>