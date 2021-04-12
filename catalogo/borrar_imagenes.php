<?php
    header("Content-Type: text/html;charset=utf-8");

    function listarArchivos ($path)
    {
        require ("cnn.php");
        
        // Abrimos la carpeta que nos pasan como parámetro
        $dir = opendir($path);
        // Leo todos los ficheros de la carpeta 
        
        $i = 1;
        while ($elemento = readdir($dir))
        {
            // Tratamos los elementos . y .. que tienen todas las carpetas
            if ($elemento != "." && $elemento != "..")
            {
                // Si es una carpeta
                if (is_dir($path.$elemento))
                {
                    // Muestro la carpeta
                    echo "<p><strong>CARPETA: ". $elemento ."</strong></p>";
                // Si es un fichero
                }
                else
                {
                    // Muestro el fichero
                    echo "<p>".$elemento."</p>";
                    $cod = explode('.', $elemento);
                    echo "<p>".$cod[0]."</p>";
                    $sql = "SELECT CodProducto FROM productos WHERE CodProducto = '".$cod[0]."'";
                    echo "<p>".$sql."</p>";
                    
                    $rsProductos = mysqli_query($cnn, $sql);
                    $cantidad = mysqli_num_rows($rsProductos);
                    if ($cantidad == 0)
                    {
                        echo "<h3>NO se ha encontrado el producto: $cod[0]</h3>";
                        if (@unlink ($_SERVER['DOCUMENT_ROOT']."/fotos/".$elemento))
                        {
                            echo "<h3><font color='00FF00'>Se ha borrado la imagen: $elemento</font></h3>";
                        }
                        else
                        {
                            echo "<h3><font color='FF0000'>Error al borrar la imagen: $elemento</font></h3>";
                        }
                    }
                    mysqli_free_result($rsProductos);
                    echo "<hr>";
                }
            }
        }
        mysqli_close($cnn);
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Borrado de imágenes</title>
</head>
<body>
    <div id="container">
        <div id="header">Polirrubros Garro</div>
    
	    <div id="main">
	        <h1>Proceso de borrado de imágenes</h1>
            <?
            listarArchivos("../fotos/");
            ?>
        </div>
    
        <div id="footer">
            Polirrubros Garro - Pasaje Bujados 173, 2550 Bell Ville, Córdoba - Tel.: (03537) 410102 - info&nbsp;@&nbsp;polirrubrosgarro.com.ar
        </div>
    </div>
</body>
</html>