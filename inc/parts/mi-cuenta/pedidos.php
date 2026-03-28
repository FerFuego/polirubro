<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h4 class="mb-0">Mis Pedidos</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>N° Pedido</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $pedidos = new Pedidos();
                        $results = $pedidos->getOrdersByUser($_SESSION["Id_Cliente"]);
                        if ($results->num_rows > 0):
                            while ($pedido = $results->fetch_object()):
                    ?>
                    <tr>
                        <td>#<?php echo $pedido->Id_Pedido; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($pedido->FechaIni)); ?></td>
                        <td>$<?php echo number_format($pedido->ImpTotal, 2, ',', '.'); ?></td>
                        <td>
                            <button class="btn btn-sm btn-info text-white" onclick="getMyOrderData(<?php echo $pedido->Id_Pedido; ?>)"><i class="fa fa-eye"></i> Ver Detalle</button>
                        </td>
                    </tr>
                    <?php
                            endwhile;
                        else:
                    ?>
                    <tr>
                        <td colspan="4" class="text-center">No has realizado pedidos aún.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
