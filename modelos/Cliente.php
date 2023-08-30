<?php
while(!file_exists('php'))
chdir(('..'));

include_once('php/conection.php');

class Cliente extends DB
{
    private $idCliente;
    private $nombre;
    private $segundoNombre;
    private $apellidoPaterno;
    private $apellidoMaterno;
    private $email;
    private $telefono;
    private $tipoVivienda;
    private $tipoCredito;
    private $credito;
    private $medio;
    private $esProspecto;
    private $idProyecto;
    private $idEtapa;
    private $idPrototipo;
    private $idVendedor;

    /**
     * Get the value of idCliente
     */ 
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * Set the value of idCliente
     *
     * @return  self
     */ 
    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;

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
     * Get the value of segundoNombre
     */ 
    public function getSegundoNombre()
    {
        return $this->segundoNombre;
    }

    /**
     * Set the value of segundoNombre
     *
     * @return  self
     */ 
    public function setSegundoNombre($segundoNombre)
    {
        $this->segundoNombre = $segundoNombre;

        return $this;
    }

    /**
     * Get the value of apellidoPaterno
     */ 
    public function getApellidoPaterno()
    {
        return $this->apellidoPaterno;
    }

    /**
     * Set the value of apellidoPaterno
     *
     * @return  self
     */ 
    public function setApellidoPaterno($apellidoPaterno)
    {
        $this->apellidoPaterno = $apellidoPaterno;

        return $this;
    }

    /**
     * Get the value of apellidoMaterno
     */ 
    public function getApellidoMaterno()
    {
        return $this->apellidoMaterno;
    }

    /**
     * Set the value of apellidoMaterno
     *
     * @return  self
     */ 
    public function setApellidoMaterno($apellidoMaterno)
    {
        $this->apellidoMaterno = $apellidoMaterno;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of telefono
     */ 
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */ 
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of medio
     */ 
    public function getMedio()
    {
        return $this->medio;
    }

    /**
     * Set the value of medio
     *
     * @return  self
     */ 
    public function setMedio($medio)
    {
        $this->medio = $medio;

        return $this;
    }

    /**
     * Get the value of tipoVivienda
     */ 
    public function getTipoVivienda()
    {
        return $this->tipoVivienda;
    }

    /**
     * Set the value of tipoVivienda
     *
     * @return  self
     */ 
    public function setTipoVivienda($tipoVivienda)
    {
        $this->tipoVivienda = $tipoVivienda;

        return $this;
    }

    /**
     * Get the value of credito
     */ 
    public function getCredito()
    {
        return $this->credito;
    }

    /**
     * Set the value of credito
     *
     * @return  self
     */ 
    public function setCredito($credito)
    {
        $this->credito = $credito;

        return $this;
    }

    /**
     * Get the value of esProspecto
     */ 
    public function getEsProspecto()
    {
        return $this->esProspecto;
    }

    /**
     * Set the value of esProspecto
     *
     * @return  self
     */ 
    public function setEsProspecto($esProspecto)
    {
        $this->esProspecto = $esProspecto;

        return $this;
    }

    /**
     * Get the value of tipoCredito
     */ 
    public function getTipoCredito()
    {
        return $this->tipoCredito;
    }

    /**
     * Set the value of tipoCredito
     *
     * @return  self
     */ 
    public function setTipoCredito($tipoCredito)
    {
        $this->tipoCredito = $tipoCredito;

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
     * Get the value of idPrototipo
     */ 
    public function getIdPrototipo()
    {
        return $this->idPrototipo;
    }

    /**
     * Set the value of idPrototipo
     *
     * @return  self
     */ 
    public function setIdPrototipo($idPrototipo)
    {
        $this->idPrototipo = $idPrototipo;

        return $this;
    }

    /**
     * Get the value of idVendedor
     */ 
    public function getIdVendedor()
    {
        return $this->idVendedor;
    }

    /**
     * Set the value of idVendedor
     *
     * @return  self
     */ 
    public function setIdVendedor($idVendedor)
    {
        $this->idVendedor = $idVendedor;

        return $this;
    }
}
?>