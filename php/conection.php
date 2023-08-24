<?php
    
    class DB
    {
        private $config;
        private $host;
        private $db;
        private $user;
        private $password;
        private $charset;
        private $current_date;

        function __construct(array $config)
        {   
            $this->config = $config;
            $this->host = $this->config['host'];
            $this->db = $this->config['database'];
            $this->user = $this->config['user'];
            $this->password = $this->config['password'];
            $this->charset = $this->config['charset'];

            date_default_timezone_set('America/Monterrey');

            $date = date('Y-m-d');
            $dayNumber = date("w", strtotime($date));
            if ($dayNumber === 5) {
                $this->current_date = $date;
            } else {
                $this->current_date = date_format(date_sub(date_create($date), date_interval_create_from_date_string(($dayNumber + 2) . ' days')), 'Y-m-d');
            }
            
        }
        function connect()
        {
            try {
                $connection = "mysql:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset;
                $options = [
                    PDO::ATTR_ERRMODE           => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES  => false
                ];

                $pdo = new PDO($connection, $this->user, $this->password);

                return $pdo;
            } catch (PDOException $e) {
                print_r('Error connection: ' . $e->getMessage());
            }
        }

        function inicioSesion($correo, $contraseña) {
            return $this->connect()->query("CALL spInicioSesion('$correo', '$contraseña')");
        }

        function obtenerResumen($date) {
            return $this->connect()->query("CALL spObtenerResumen('$date')");
        }

        function obtenerPortafolio($idPago, $idProyecto) {
            return $this->connect()->query("CALL spObtenerPortafolio($idPago, $idProyecto)");
        }
        
        function obtenerTipoPago() {
            return $this->connect()->query("CALL spObtenerTipoPago()");
        }

        function obtenerProyectos() {
            return $this->connect()->query("CALL spObtenerProyectos()");
        }

        function obtenerBancos($date) {
            return $this->connect()->query("CALL spObtenerBancos('$date')");
        }

        function obtenerPagoBanco($tipoPago) {
            return $this->connect()->query("CALL spObtenerPagoBanco($tipoPago)");
        }

        function obtenerFamilias() {
            return $this->connect()->query("CALL spObtenerFamilias()");
        }

        function obtenerConceptos($idBuscado, $tipo, $nivelConcepto) {
            return $this->connect()->query("CALL spObtenerConceptos($idBuscado, '$tipo', '$nivelConcepto')");
        }

        function obtenerAreas($tipoArea) {
            return $this->connect()->query("CALL spObtenerAreas($tipoArea)");
        }
        
        function obtenerProveedores() {
            return $this->connect()->query("CALL spObtenerProveedores()");
        }

        function gestionProyecto($idProyecto, $nombre, $totalCasas, $totalEtapas, $presupuesto, $opcion)
        {
            
            return $this->connect()->query("CALL spGestionProyecto($idProyecto, '$nombre', '$totalCasas', '$totalEtapas',
                                                                '$presupuesto', '$opcion')");
        }

        function gestionEtapa($idEtapa, $numeroEtapa, $cantidadCasas, $idProyecto, $opcion)
        {
            
            return $this->connect()->query("CALL spGestionEtapa($idEtapa, $numeroEtapa, $cantidadCasas,
                                                                $idProyecto, '$opcion')");
        }

        function gestionPago($idPago, $concepto, $importe, $esIngreso, $idTipoPago, $idArea, $idUsuario, 
                            $esGeneral, $idProyecto, $idEtapa, $idFamilia, $idConcepto, $idConceptoB, $idConceptoC,
                            $idCliente, $idAportador, $idBanco, $idProveedor, $idEmpleado, $opcion)
        {
            
            return $this->connect()->query("CALL spGestionPago($idPago, '$concepto', $importe, $esIngreso, $idTipoPago, $idArea, $idUsuario,
                                                                $esGeneral, $idProyecto, $idEtapa, $idFamilia, $idConcepto, $idConceptoB, $idConceptoC, 
                                                                $idCliente, $idAportador, $idBanco, $idProveedor, $idEmpleado, '$opcion')");
        }

        function gestionCliente($idCliente, $nombre, $segundoNombre, $apellidoPaterno, $apellidoMaterno, $email, $telefono, $fechaNacimiento,
                             $numeroSS, $puntaje, $contraseña, $tipoVivienda, $ingresos, $credito, $medio, $esProspecto, $opcion)
        {
            
            return $this->connect()->query("CALL spGestionCliente($idCliente, '$nombre', '$segundoNombre', '$apellidoPaterno', '$apellidoMaterno', 
                            '$email', '$telefono', '$fechaNacimiento', '$numeroSS', $puntaje, '$contraseña', '$tipoVivienda', 
                            $ingresos, $credito, '$medio', $esProspecto, '$opcion')");
        }

        function obtenerProspectos() {
            return $this->connect()->query("CALL spObtenerProspectos()");
        }

        function resumenVentas() {
            return $this->connect()->query("CALL spResumenVentas()");
        }

        function resumenVentasProyecto($idProyecto) {
            return $this->connect()->query("CALL spResumenVentasProyecto($idProyecto)");
        }

        function resumenVentasEtapa($idEtapa) {
            return $this->connect()->query("CALL spResumenVentasEtapa($idEtapa)");
        }

        function gestionPresupuesto($idPresupuesto, $concepto, $importe, $fecha, $idArea, $idProyecto, $opcion)
        {
            
            return $this->connect()->query("CALL spGestionPresupuesto($idPresupuesto, '$concepto', $importe, '$fecha', 
                                                                $idArea, $idProyecto, '$opcion')");
        }

        function gestionCotizacion($idCotizacion, $concepto, $importe, $fecha, $idArea, $idProyecto, $idEtapa, $opcion)
        {
            
            return $this->connect()->query("CALL spGestionCotizacion($idCotizacion, '$concepto', $importe, '$fecha', 
                                                                $idArea, $idProyecto, $idEtapa, '$opcion')");
        }

        function spObtenerCotizacion($idProyecto, $idEtapa, $idNivel) {
            return $this->connect()->query("CALL spObtenerCotizacion($idProyecto, $idEtapa, $idNivel)");
        }

        function gestionAportador($idAportador, $RFC, $nombre, $idProyecto, $opcion)
        {
            
            return $this->connect()->query("CALL spGestionAportador($idAportador, '$RFC', '$nombre', $idProyecto, '$opcion')");
        }

        function gestionBanco($idTipoPago, $nombre, $opcion)
        {
            
            return $this->connect()->query("CALL spGestionBanco($idTipoPago, '$nombre', '$opcion')");
        }

        function porPagarAportador() {
            return $this->connect()->query("CALL spPorPagarAportador()");
        }

        function spObtenerAportaciones($idProyecto) {
            return $this->connect()->query("CALL spObtenerAportaciones($idProyecto)");
        }

        function porPagarBanco() {
            return $this->connect()->query("CALL spPorPagarBanco()");
        }

        function spObtenerCreditos($idProyecto) {
            return $this->connect()->query("CALL spObtenerCreditos($idProyecto)");
        }

        function porCobrar() {
            return $this->connect()->query("CALL spPorCobrar()");
        }

        function presupuestoFamilia($idProyecto) {
            return $this->connect()->query("CALL spPresupuestoFamilia($idProyecto)");
        }

        function gestionMaquinaria($idMaquinaria, $nombre, $costo, $idRecu, $opcion) {
            return $this->connect()->query("CALL spGestionMaquinaria($idMaquinaria, '$nombre', $costo, $idRecu, '$opcion')");
        }

        function gastoMaquinaria() {
            return $this->connect()->query("CALL spGastoMaquinaria()");
        }

        function gestionOperador($idOperador, $nombre, $sueldo, $idMaquinaria, $opcion) {
            return $this->connect()->query("CALL spGestionOperador($idOperador, '$nombre', $sueldo, $idMaquinaria, '$opcion')");
        }

        function gestionPagoMaquinaria($idPagoMaquinaria, $concepto, $conceptoB, $cantidad, $precioUnitario, $modificacion, $importe, 
        $esIngreso, $idTipoPago, $idMaquinaria, $idProyecto, $idProveedor, $idUsuario, $opcion) {
            return $this->connect()->query("CALL spGestionPagoMaquinaria($idPagoMaquinaria, '$concepto', '$conceptoB', $cantidad, $precioUnitario, $modificacion, $importe, 
            $esIngreso, $idTipoPago, $idMaquinaria, $idProyecto, $idProveedor, $idUsuario, '$opcion')");
        }

        function gestionCredito($idCredito, $idBanco, $idProyecto, $opcion) {
            return $this->connect()->query("CALL spGestionCredito($idCredito, $idBanco, $idProyecto, '$opcion')");
        }

        function gestionProrrateo($idProrrateo, $idProyecto, $esAdmin, $opcion) {
            return $this->connect()->query("CALL spGestionProrrateo($idProrrateo, $idProyecto, $esAdmin, '$opcion')");
        }

        /**
         * Get the value of current_date
         */ 
        public function getCurrent_date()
        {
                return $this->current_date;
        }

        /**
         * Set the value of current_date
         *
         * @return  self
         */ 
        public function setCurrent_date($current_date)
        {
                $this->current_date = $current_date;

                return $this;
        }

/*        function gestionSeccion($idSeccion, $nombreSeccion, $color, $orden, $opcion)
        {
            return $this->connect()->query("CALL gestionSeccion($idSeccion,'$nombreSeccion','$color',$orden,'$opcion')");
        }

        function gestionNoticia($idNoticia, $titulo, $descripcion, $contenidoNoticia, $lugar, $fechaHora, $esUrgente, $idEstatus, $nombreUsuario, $opcion)
        {
            return $this->connect()->query("CALL gestionNoticia($idNoticia, '$titulo', '$descripcion', '$contenidoNoticia', 
                                            '$lugar', '$fechaHora', $esUrgente, '$idEstatus', '$nombreUsuario','$opcion')");
        }

        function obtenNoticia($idNoticia, $opcion)
        {
            return $this->connect()->query("CALL obtenNoticia($idNoticia,'$opcion')");
        }

        function obtenImagen($idNoticia, $opcion)
        {
            return $this->connect()->query("CALL obtenImagen($idNoticia,'$opcion')");
        }

        function obtenVideo($idNoticia, $opcion)
        {
            return $this->connect()->query("CALL obtenVideo($idNoticia,'$opcion')");
        }

        function gestionSeccion_Noticia($idSeccion_Noticia, $idSeccion, $idNoticia, $opcion)
        {
            return $this->connect()->query("CALL gestionSeccion_Noticia($idSeccion_Noticia, $idSeccion, $idNoticia, '$opcion')");
        }

        function gestionImagen($idImagen, $imagenNot, $idNoticia, $opcion)
        {
            return $this->connect()->query("CALL gestionImagen($idImagen, $imagenNot, $idNoticia, '$opcion')");
        }

        function gestionVideo($idVideo, $videoPath, $idNoticia, $opcion)
        {
            return $this->connect()->query("CALL gestionVideo($idVideo, '$videoPath', $idNoticia, '$opcion')");
        }

        function gestionPalabra_clave($idPalabra, $palabra, $idNoticia, $opcion)
        {
            return $this->connect()->query("CALL gestionPalabra_clave($idPalabra, '$palabra', $idNoticia, '$opcion')");
        }*/
    

        
    }