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

        function gestionPago($idPago, $concepto, $importe, $fecha, $esIngreso, $area, $idTipoPago, $idEtapa, $idProyecto, $opcion)
        {
            
            return $this->connect()->query("CALL spGestionPago($idPago, '$concepto', $importe, '$fecha', $esIngreso, '$area',
                                                                $idTipoPago, $idEtapa, $idProyecto, '$opcion')");
        }

        function gestionPresupuesto($idPresupuesto, $concepto, $importe, $fecha, $idEtapa, $idProyecto, $opcion)
        {
            
            return $this->connect()->query("CALL spGestionPresupuesto($idPresupuesto, '$concepto', $importe, '$fecha', 
                                                                $idEtapa, $idProyecto, '$opcion')");
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