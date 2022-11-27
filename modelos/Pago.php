<?php
while(!file_exists('php'))
chdir(('..'));

include_once('php/conection.php');

class Pago extends DB
{
    private $idPago;
    private $concepto;
    private $importe;
    private $fechaPago;
    private $esIngreso;
    private $area;
    private $extra;
    private $activo;
    private $idTipoPago;
    private $idEtapa;
    private $idProyecto;
    

    /**
     * Get the value of idPago
     */ 
    public function getIdPago()
    {
        return $this->idPago;
    }

    /**
     * Set the value of idPago
     *
     * @return  self
     */ 
    public function setIdPago($idPago)
    {
        $this->idPago = $idPago;

        return $this;
    }

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
     * Get the value of fechaPago
     */ 
    public function getFechaPago()
    {
        return $this->fechaPago;
    }

    /**
     * Set the value of fechaPago
     *
     * @return  self
     */ 
    public function setFechaPago($fechaPago)
    {
        $this->fechaPago = $fechaPago;

        return $this;
    }

    /**
     * Get the value of esIngreso
     */ 
    public function getEsIngreso()
    {
        return $this->esIngreso;
    }

    /**
     * Set the value of esIngreso
     *
     * @return  self
     */ 
    public function setEsIngreso($esIngreso)
    {
        $this->esIngreso = $esIngreso;

        return $this;
    }

    /**
     * Get the value of area
     */ 
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set the value of area
     *
     * @return  self
     */ 
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get the value of extra
     */ 
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * Set the value of extra
     *
     * @return  self
     */ 
    public function setExtra($extra)
    {
        $this->extra = $extra;

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
}
?>