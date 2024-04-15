<?php session_start(); ?>
<!-- php Functions -->
<?php require('inc/functions/class-polirubro.php'); ?>

<?php
    // Variables para los Productos 
    $id         = (isset($_GET['id'])           ? filter_var($_GET['id'],          FILTER_VALIDATE_INT) : null);
    $id_rubro   = (isset($_GET["id_rubro"])     ? filter_var($_GET["id_rubro"],    FILTER_VALIDATE_INT) : "");
    $id_subrubro = (isset($_GET["id_subrubro"]) ? filter_var($_GET["id_subrubro"], FILTER_VALIDATE_INT) : "");
    $id_grupo   = (isset($_GET["id_grupo"])     ? filter_var($_GET["id_grupo"],    FILTER_VALIDATE_INT) : "");
    $minamount  = (isset($_GET["minamount"])    ? filter_var(str_replace('$','',$_GET["minamount"]),   FILTER_VALIDATE_INT) : null);
    $maxamount  = (isset($_GET["maxamount"])    ? filter_var(str_replace('$','',$_GET["maxamount"]),   FILTER_VALIDATE_INT) : null);
    $order      = (isset($_GET['order'])        ? filter_var($_GET['order'],       FILTER_UNSAFE_RAW) : "");
    $page       = (isset($_GET["page"])         ? filter_var($_GET["page"],        FILTER_VALIDATE_INT) : 1);
    $search     = (isset($_GET['s'])            ? filter_var($_GET['s'],           FILTER_UNSAFE_RAW) : "");
    $opcion     = (isset($_GET['opcion'])       ? filter_var($_GET['opcion'],      FILTER_UNSAFE_RAW) : "");
    $limit      = 21; //Limito la busqueda
    $links      = 6; // limito los items a mostrar en el paginador
    $general = new Configuracion();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="NUESTRO Polirrubros - Mayorista de juguetes, libreria, regalaria, bazar, marroquineria y ropa interior">
    <meta name="keywords" content="polirrubros, polirubros, nuestro polirrubros, mayorista, venta, juguetes, libreria, regalaria, bazar, marroquineria, ropa interior, bell ville, cordoba, argentina">
    <meta name="description" content="NUESTRO Polirrubros de Alejandra Barzabal - Mayorista de juguetes, libreria, regalaria, bazar, marroquineria y ropa interior">
    <meta name="author" content="Luciano Colmano y Fernando Catalano">
    <meta name="Robots" content="All">
    <meta name="Revisit-after" content="15 days">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/favicon.png">
    <title>Nuestro Polirrubros | Bell Ville</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Google Captcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Css Styles -->
    <link rel="stylesheet" href="dist/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="dist/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="dist/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="dist/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="dist/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="dist/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="dist/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="dist/css/style.css" type="text/css">
</head>

<body>

<!-- Page Preloder -->
<!-- <div id="preloder">
    <div class="loader"></div>
</div> -->