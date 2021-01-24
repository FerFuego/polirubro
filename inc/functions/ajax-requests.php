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

    $html = '<div class="d-block">';

    while ( $row = $result->fetch_object() ) {
        $html .= '<div>';
        $html .= '<a href="productos.php?id_rubro='. $row->Id_Rubro.'&id_subrubro='.$row->Id_SubRubro.'" class="item sub-item lastlistCTA" data-subrubro="'. $row->Id_SubRubro .'">'. $row->Nombre .'<span></span></a>';
        $html .= '<div class="lastlist"></div>';
        $html .= '</div>';
    }

    $html .= '</div>';

    echo $html;
    die();
}


if( !empty($_POST) && isset($_POST['action']) && $_POST['action'] == 'getGrupoByIdSubRubro') {

    $object = new Subrubros();
    $result = $object->getSubRubroByIdGrupo($_POST['id_gubro']);

    $html = '<div>';

    while ( $row = $result->fetch_object() ) {
        $html .= '<a href="productos.php?id_rubro='. $row->Id_Rubro.'&id_subrubro='.$row->Id_SubRubro.'&id_grupo='.$row->Id_Grupo.'" class="item sub-item">'. $row->Nombre .'<span></span></a>';
    }

    $html .= '</div>';

    echo $html;
    die();
}