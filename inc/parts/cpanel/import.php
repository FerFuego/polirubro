<div class="row">
    <div class="col-sm-12 col-md-6">
        <h2>Importar Productos</h2>
        <form action="/cpanel.php?opcion=importar" method="post" enctype="multipart/form-data" name="frmImportar">
            <div class="form-group">
                <label for="fileSQL">Seleccione archivo para importar los productos</label>
                <input type="file" name="fileSQL" id="fileSQL" class="form-control" accept="text/plain" required>
            </div>

            <div class="form-group">
                <input type="submit" name="cmdImportar" id="Importar" class="btn btn-primary" value="Importar">
            </div>
        </form>
        <br><br>
        <?php if (isset($_FILES["fileSQL"])) :
	
            $fileSQL = $_FILES["fileSQL"];
            
            $sql = file_get_contents($fileSQL['tmp_name']);
            $sql = utf8_encode($sql);

            $productos = new Productos();
            $result = $productos->importProducts($sql);
            
            if (is_integer($result) && $result > 1) : ?>
                <p class="text-success"><?php echo $result; ?> Productos Importados Correctamente!</p>
            <?php else : ?>
                <p class="text-danger">Ocurrio un error en la importacion. <?php echo $result; ?></p>
            <?php endif;

        endif; ?>
    </div>
</div>