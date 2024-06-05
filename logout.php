<?php
session_start();
unset($_SESSION["id_user"]);
unset($_SESSION["Id_Cliente"]);
unset($_SESSION["Nombre"]);
unset($_SESSION["Mail"]);
unset($_SESSION["user"]);
unset($_SESSION["ListaPrecioDef"]);
unset($_SESSION["token"]);

session_destroy();
header("Location:index.php");
?>