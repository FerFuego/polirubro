<?php session_start(); ?>

<!-- php Functions -->
<?php require('inc/functions/class-connection.php'); ?>
<?php require('inc/functions/class-squery.php'); ?>
<?php require('inc/functions/class-login.php'); ?>
<?php require('inc/functions/class-polirubro.php'); ?>
<?php require('inc/functions/class-rubros.php'); ?>
<?php require('inc/functions/class-subrubros.php'); ?>
<?php require('inc/functions/class-productos.php'); ?>
<?php require('inc/functions/class-paginator.php'); ?>

<?php
    // Variables para los Productos 
    $id_rubro = (isset($_GET["id_rubro"]) ? $_GET["id_rubro"] : "");
    $id_subrubro = (isset($_GET["id_subrubro"]) ? $_GET["id_subrubro"] : "");
    $id_grupo = (isset($_GET["id_grupo"]) ? $_GET["id_grupo"] : "");
    $page = (isset($_GET["page"]) ? $_GET["page"] : 1);
    $search = (isset($_GET['s']) ? $_GET['s'] : "");
    $limit = 21; //Limito la busqueda
    $links = 6; // limito los items a mostrar en el paginador
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

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>

<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>