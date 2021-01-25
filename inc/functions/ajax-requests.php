<?php
/*-----------------------
    Ajax Requests
-----------------------*/
session_start();
require('class-connection.php');
require('class-squery.php');
require('class-rubros.php');
require('class-subrubros.php');
require('class-login.php');


if( !empty($_POST) && isset($_POST['action']) && $_POST['action'] == 'actionLogin') {

    $user = (isset($_POST['user']) ? filter_var($_POST['user'], FILTER_SANITIZE_STRING) : null);
    $pass = (isset($_POST['pass']) ? filter_var($_POST['pass'], FILTER_SANITIZE_STRING) : null);
    $login = 'false';

    $access = new Login($user, $pass);
    $result = $access->loginProcess();

    if ( $result->num_rows > 0 ) :

        while ( $user = $result->fetch_object() ) {
            $_SESSION["id_user"] = session_id();
            $_SESSION["Id_Cliente"] = $result->Id_Cliente;
            $_SESSION["Nombre"] = $result->Nombre;
            $_SESSION["Mail"] = $result->Mail;
            $_SESSION["ListaPrecioDef"] = $result->ListaPrecioDef;
            $_SESSION["user"] = $result->Usuario;
            $login = 'true';
        }

    endif;

    echo $login;
    die();
}


if( !empty($_POST) && isset($_POST['action']) && $_POST['action'] == 'getSubRubroByIdRubro') {

    $id_rubro = filter_var($_POST["id_rubro"], FILTER_VALIDATE_INT);

    $object = new Subrubros();
    $result = $object->getSubRubroByIdRubro($id_rubro);

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

    $id_grupo = filter_var($_POST["id_grupo"], FILTER_VALIDATE_INT);

    $object = new Subrubros();
    $result = $object->getSubRubroByIdGrupo($id_grupo);

    $html = '<div>';

    while ( $row = $result->fetch_object() ) {
        $html .= '<a href="productos.php?id_rubro='. $row->Id_Rubro.'&id_subrubro='.$row->Id_SubRubro.'&id_grupo='.$row->Id_Grupo.'" class="item sub-item">'. $row->Nombre .'<span></span></a>';
    }

    $html .= '</div>';

    echo $html;
    die();
}