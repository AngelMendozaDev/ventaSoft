<?php
    require_once "classes/ventas.php";
    require_once "headv.php";
    $ticket = $_GET['ticket'];
    $pago = $_GET['p'];
    
    $model = new Ventas();
    $venta = $model->getVenta($ticket)->fetch_assoc();
    $detalle = $model->getDetailVenta($ticket);
?>
<link rel="stylesheet" href="css/ticket.css">

<div class="ticket">
    <div class="ticket-head">
        <img src="media/icons/logo.png" alt="lumega-mx" class="logo">
        <h6>
            Atendio: <br> <?php echo $venta['nombre']." ". $venta['app'] ?>
        </h6>
    </div>
    <div class="ticket-body">
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cant</th>
                </tr>
            </thead>
            <tbody>
                <?php while($data = $detalle->fetch_assoc()){ ?>
                <tr>
                    <td class="name"><?php echo $data['nombre'] ?></td>
                    <td class="dato">$<?php echo $data['precio_v'] ?></td>
                    <td class="dato"><?php echo $data['cantidad_v'] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="ticket-footer">
        <h2>Total: $ <?php echo $venta['total'] ?></h2>
        <h2>Cambio: $ <?php echo ($pago-$venta['total'])?></h2>
        <h5>¡GRACIAS POR SU COMPRA!</h5>
    </div>
</div>

<button onclick="window.close()">
    ok
</button>

<script src="lib/jquery.js"></script>
<script>
    $(function(){
        window.print();
    });
</script>
