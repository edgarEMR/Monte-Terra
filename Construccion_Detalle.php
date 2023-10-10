<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle</title>
    <link rel="stylesheet" href="css/Construccion_Detalle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
    <div id="navigation" class="top">

    </div>

    <?php
        ob_start();
        include_once('php/conection.php');

        $date = '';
        $crecimiento = 0;
        $conection = new DB(require 'php/config.php');

        if(isset($_GET['date'])){
            $date = $_GET['date'];
        } else {
            $date = $conection->getCurrent_date();
        }
        
        $procedure = $conection->obtenerResumen($date);
        $rows = $procedure->fetch(PDO::FETCH_ASSOC);

    ?>
    
    <div id="construccion" class="table-responsive">
        
        <div id="titulo-construccion">
            <h2 class="text-primary">La herradura</h2>
        </div>

        
        <table id="tabla-resumen" class="table table-hover">
    <tr class="table-primary">
        <th></th>
        <th>01-dic-22</th>
        <th>08-dic-22</th>
        <th>15-dic-22</th>
        <th>22-dic-22</th>
        <th>29-dic-22</th>
        <th>05-ene-23</th>
        <th>12-ene-23</th>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>0</td>
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
    </tr>
    <tr>
        <td>Programa de obra: %</td>
        <td>Prog.</td>
        <td> -   </td>
        <td> 7.85 </td>
        <td> 16.32 </td>
        <td> 24.69 </td>
        <td> 33.17 </td>
        <td> 38.41 </td>
    </tr>
    <tr>
        <td> -   </td>
        <td>Real</td>
        <td> -   </td>
        <td> -   </td>
        <td> -   </td>
        <td> -   </td>
        <td> -   </td>
        <td> -   </td>
    </tr>
    <tr>
        <td>Entrega de Viviendas</td>
        <td>Prog.</td>
        <td> -   </td>
        <td> -   </td>
        <td> -   </td>
        <td> -   </td>
        <td> -   </td>
        <td> -   </td>
    </tr>
    <tr>
        <td></td>
        <td>Real</td>
        <td> -   </td>
        <td> -   </td>
        <td> -   </td>
        <td> -   </td>
        <td> -   </td>
        <td> -   </td>
    </tr>
    <tr>
        <td>Avance por Lote</td>
        <td>Mza</td>
        <td> 3 </td>
        <td> 3 </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td>Lote</td>
        <td> 2 </td>
        <td> 4 </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td>%</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>Avance de Viviendas en %</td>
        <td></td>
        <td>0%</td>
        <td>1% al 10%</td>
        <td>11% al 20%</td>
        <td>21% al 30%</td>
        <td>31% al 40%</td>
        <td>41% al 50%</td>
    </tr>
    <tr>
        <td></td>
        <td>No.</td>
        <td> 15.00 </td>
        <td> -   </td>
        <td> -   </td>
        <td> -   </td>
        <td> -   </td>
        <td> -</td>
    </tr>
</table>

<div id="titulo-construccion" class="mt-5">
            <h2 class="text-primary">Resumen Avance</h2>
        </div>

<table id="tabla-resumen" class="table table-hover">
    <tr class="table-primary">
        <th>Avance Numerico</th>
        <th></th>
        <th></th>
        <th>08-dic-22</th>
        <th>15-dic-22</th>
        <th>22-dic-22</th>
        <th>29-dic-22</th>
        <th>05-ene-23</th>
    </tr>
    <tr>
        <td>No.</td>
        <td>SEMANA</td>
        <td></td>
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>1</td>
        <td>PLATAFORMA</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> 1 </td>
        <td> 1 </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>2</td>
        <td>CIMENTACION CORRIDA</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>3</td>
        <td>CIMENTACION DE PILOTES</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>4</td>
        <td>CIMENTACION DE LOSA</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> 1 </td>
        <td> 1 </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>5</td>
        <td>Plomería Firme</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> 1 </td>
        <td> 1 </td>
        <td> - </td>
    </tr>
    <tr>
        <td>6</td>
        <td>FIRME DE CIMENTACION CORRIDA</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>7</td>
        <td>FIRME DE PILOTES</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>8</td>
        <td>FIRME DE LOSA</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> 1 </td>
        <td> 1 </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>9</td>
        <td>Electricidad Firme</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> 1 </td>
        <td> 1 </td>
        <td> - </td>
    </tr>
    <tr>
        <td>10</td>
        <td>Muros Planta Baja</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> 1 </td>
        <td> 1 </td>
    </tr>
    <tr>
        <td>11</td>
        <td>Plomería Entrepiso</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> 1 </td>
        <td> 1 </td>
    </tr>
    <tr>
        <td>12</td>
        <td>Electricidad Entrepiso</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> 1 </td>
    </tr>
    <tr>
        <td>13</td>
        <td>Losa Entrepiso</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>14</td>
        <td>Muros Planta Alta</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>15</td>
        <td>Electricidad Azotea</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>16</td>
        <td>Losa Azotea</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>17</td>
        <td>Pretil de Block</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>18</td>
        <td>Empastado de Losa</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>19</td>
        <td>Llaves de Empotrar</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>20</td>
        <td>Instalación de Marcos</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>21</td>
        <td>Acabado Exterior</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>22</td>
        <td>Fachada Vivienda</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>23</td>
        <td>Cableado Eléctrico</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>24</td>
        <td>Instalación Azulejo</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>25</td>
        <td>Impermeabilización</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>26</td>
        <td>Limpieza Gruesa de Obra</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>27</td>
        <td>Yeso Plana Baja</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>28</td>
        <td>Yeso Plana Alta</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>29</td>
        <td>Instalación de Entronques</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>30</td>
        <td>Instalación de Acometida Elect.</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>31</td>
        <td>Instalación de Piso P.B.</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>32</td>
        <td>Instalación de Piso P.A.</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>33</td>
        <td>Instalación de Piso Antiderrapante</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>34</td>
        <td>Albañilería Exterior</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>35</td>
        <td>Instalación de Accesorios Elect.</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>36</td>
        <td>Pintura Exterior</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>37</td>
        <td>Pintura Interior</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>38</td>
        <td>Instalación de Puertas y Chapas</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>39</td>
        <td>Instalación de Ventanas</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>40</td>
        <td>Colocación de Aparatos</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>41</td>
        <td>Relleno de Patio y Frente</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>42</td>
        <td>Pruebas Finales</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>43</td>
        <td>Limpieza Final Obra</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Prog.</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
    </tr>
    <tr>
        <td>44</td>
        <td>Entrega de Vivienda</td>
        <td>Real</td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> - </td>
        <td> -</td>
    </tr>
</table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Construccion_Detalle.js"></script>
</body>
</html>