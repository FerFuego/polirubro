<!-- Resumen Boxes -->
<div class="row col-xs-12 col-sm-8">
    <div class="col-xs col-sm-4">
        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Cantidad de Productos</h5>
                <?php $prod = new Productos(); ?>
                <p class="h1 card-text"><?php echo $prod->getCountProducts(); ?></p>
            </div>
        </div>
    </div>

    <div class="col-xs col-sm-4">
        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Pedidos Abiertos</h5>
                <?php $ped = new Pedidos(); ?>
                <p class="h1 card-text"><?php echo $ped->getCountOpenPedidos(); ?></p>
            </div>
        </div>
    </div>

    <div class="col-xs col-sm-4">
        <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Cantidad de Clientes</h5>
                <?php $cli = new Usuarios(); ?>
                <p class="h1 card-text"><?php echo $cli->getCountClients(); ?></p>
            </div>
        </div>
    </div>
</div>
<!-- End Resumen Boxes -->

<!-- Form Configuration -->
<div class="row mt-5 col-xs-12 col-sm-8">
    <?php $general = new Configuracion(); ?>
    <div class="col-12">
        <h2>Datos Generales</h2><hr>
        <form id="form-general">
            <div class="d-flex justify-content-between">
                <div class="form-group">
                    <label for="logo">Imagen Logo</label>
                    <input type="file" name="logo" id="logo">
                </div>
                <div class="form-group">
                    <img src="<?php echo $general->logo; ?>" width="300px">
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="form-group">
                    <label for="banner">Imagen Banner</label>
                    <input type="file" name="banner" id="banner">
                </div>
                <div class="form-group">
                    <img src="<?php echo $general->banner; ?>" width="300px">
                </div>
            </div>
            <div class="d-flex">
                <div class="form-group w-100 pl-2">
                    <label for="telefono">Telefono</label> <br>
                    <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $general->telefono; ?>">
                </div>
                <div class="form-group w-100 pl-2">
                    <label for="email">Email</label> <br>
                    <input type="text" name="email" id="email" class="form-control" value="<?php echo $general->email; ?>">
                </div>
                <div class="form-group w-100 pl-2">
                    <label for="atencion">Atencion</label> <br>
                    <input type="text" name="atencion" id="atencion" class="form-control" value="<?php echo $general->atencion; ?>">
                </div>
            </div>
            <div class="d-flex">
                <div class="form-group w-100 pl-2">
                    <label for="direccion">Direccion</label> <br>
                    <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $general->direccion; ?>">
                </div>
                <div class="form-group w-100 pl-2">
                    <label for="whatsapp">WhatsApp</label> <br>
                    <input type="text" name="whatsapp" id="whatsapp" class="form-control" value="<?php echo $general->whatsapp; ?>">
                </div>
                <div class="form-group w-100 pl-2">
                    <label for="instagram">Instagram</label> <br>
                    <input type="text" name="instagram" id="instagram" class="form-control" value="<?php echo $general->instagram; ?>">
                </div>
            </div>
            <div class="d-flex">
                <div class="form-group w-100 pl-2">
                    <label for="facebook">Facebook</label> <br>
                    <input type="text" name="facebook" id="facebook" class="form-control" value="<?php echo $general->facebook; ?>">
                </div>
                <div class="form-group w-100 pl-2">
                    <label for="twitter">Twitter</label> <br>
                    <input type="text" name="twitter" id="twitter" class="form-control" value="<?php echo $general->twitter; ?>">
                </div>
                <div class="form-group w-100 pl-2">
                    <label for="">&nbsp;</label> <br>
                    <input type="submit" class="form-control btn-success" value="Guardar">
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Form Configuration -->

<!-- Historic Orders -->
<div class="row mt-5 col-xs-12 col-sm-8">
    <table class="table table-bordered table-striped ml-3 mr-3">
        <thead>
            <tr class="bg-dark text-white">
                <th colspan="2">
                    Historico de Pedidos - <?php echo date('Y'); ?>
                </th>
            </tr>
            <tr class="bg-light">
                <th>Mes/Año</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $orders = new Pedidos();
                $orders = $orders->getTotalOrderByMonth();
                if ($orders) :
                    while ( $row = $orders->fetch_object() ) : ?>
                        <tr>
                            <td><?php echo $row->mes .'/'. $row->ano; ?></td>
                            <td><?php echo $row->total; ?></td>
                        </tr>
                    <?php endwhile; 
                else : ?>
                    <tr>
                        <td colspan="2"><h3>No existen registros</h3></td>
                    </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<!-- End Historic Orders -->