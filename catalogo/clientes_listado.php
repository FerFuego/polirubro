<?php
session_start();

if ($_SESSION["id_user"] != session_id())
{
	header("Location: login.htm");
}

header("Content-Type: text/html;charset=utf-8");

require ("cnn.php");

$sql = "SELECT * FROM clientes ORDER BY Nombre";
$rs = mysqli_query($cnn, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Polirrubros Garro - Clientes</title>
    <?php require("head.php"); ?>
    <script language="JavaScript">
        function confirma_borrar()
        {
	        return confirm("Confirma borrar el registro?");
        }
    </script>
</head>
<body>
    <div class="container" align="center" style="background-color: #FFF;">
        <header>
            <h1>Polirrubros Garro</h1>
        </header>
    </div>

    <div class="container" style="background-color: #FFF;">
        <div class="row">
            <div align="center" class="col-md-12">
                <br>
                <a href="sistema.php" class="myButton">Inicio</a>&nbsp;&nbsp;
                <a href="productos_importar.php" class="myButton">Importar Productos</a>&nbsp;&nbsp;
                <a href="productos_editar.php" class="myButton">Editar Productos</a>&nbsp;&nbsp;
                <a href="clientes_listado.php" class="myButton">ABM Clientes</a>&nbsp;&nbsp;
                <a href="logout.php" class="myButton">Cerrar Sesi&oacute;n</a>
                <br>
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12">
                <h2>Listado de Clientes</h2>
                <hr>
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12">
                <p><a href="clientes_altas.php" class="myButton">Nuevo Cliente</a></p><br>
            </div>
        </div>

        <div class="row">
            <div align="center" class="col-md-12">
                <div class="table-responsive">
                    <table class='table table-hover'>
                        <tr>
                            <th width="10%"><strong>Id</strong></th>
                            <th width="40%"><strong>Nombre</strong></th>
                            <th width="15%"><strong>Usuario</strong></th>
                            <th width="15%"><strong>Password</strong></th>
                            <th width="10%" style="text-align:center"><strong>Editar</strong></th>
                            <th width="10%" style="text-align:center"><strong>Borrar</strong></th>
                        </tr>
                        <?php
                        $cantidad = mysqli_num_rows($rs);
                        if ($cantidad == 0)
                        {
                            echo "<tr><td><h3>No hay registros...</h3></td></tr>";
                        }
                        else
                        {
                            while ($dato = mysqli_fetch_array ($rs))
                            {
                                echo "<tr>";
                                echo "<td>".$dato["Id_Cliente"]."</td>";
                                echo "<td>".$dato["Nombre"]."</td>";
                                echo "<td>".$dato["Usuario"]."</td>";
                                echo "<td>".$dato["Password"]."</td>";
                                // Armo los links para editar y borrar registro.
                                echo "<td style='text-align:center'><a href='clientes_editar.php?Id=".$dato["Id_Cliente"]."'><img src='images/editar_32.png' title='Editar Cliente'></a></td>";
                                echo "<td style='text-align:center'><a href='clientes_bajas.php?Id=".$dato["Id_Cliente"]."' onClick='return confirma_borrar()'><img src='images/borrar_32.png' title='Borrar Cliente'></a></td>";
                                echo "</tr>";
                            }
                        }
                        mysqli_free_result($rs);
                        mysqli_close($cnn);
                        ?>
                    </table>
                </div>
            </div>
        </div>

        <?php require("footer.php"); ?>
    </div>
</body>
</html>