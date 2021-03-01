<div class="row">

    <div class="col-4">
        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Cantidad de Productos</h5>
                <?php $prod = new Productos(); ?>
                <p class="h1 card-text"><?php echo $prod->getCountProducts(); ?></p>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Pedidos Abiertos</h5>
                <?php $ped = new Pedidos(); ?>
                <p class="h1 card-text"><?php echo $ped->getCountOpenPedidos(); ?></p>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Cantidad de Clientes</h5>
                <?php $cli = new Usuarios(); ?>
                <p class="h1 card-text"><?php echo $cli->getCountClients(); ?></p>
            </div>
        </div>
    </div>
    
</div>

<div class="row">
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
                while ( $row = $orders->fetch_object() ) : ?>
                <tr>
                    <td><?php echo $row->mes .'/'. $row->ano; ?></td>
                    <td><?php echo $row->total; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>