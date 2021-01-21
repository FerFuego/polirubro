<?php
/*-----------------------
    Ajax Requests
-----------------------*/

require('class-connection.php');
require('class-squery.php');
require('class-rubros.php');
require('class-subrubros.php');

if( !empty($_POST) && isset($_POST['action']) && $_POST['action'] == 'getSubRubroByIdRubro') {

    $object = new Subrubros();
    $result = $object->getSubRubroByIdRubro($_POST['id_rubro']);

    $html = '<ul>';

    while ( $row = mysqli_fetch_array($result) ) {
        $html .= '<a href="productos.php?id_rubro='. $row['Id_Rubro'].'&id_subrubro='.$row['Id_SubRubro'].'" class="item sub-item sublistCTA" id="'. $row['Id_SubRubro'] .'">'. $row['Nombre'] .'<span></span></a>';
        $html .= '<div class="sublist"></div>';
    }

    $html .= '</ul>';

    echo $html;
    die();
}