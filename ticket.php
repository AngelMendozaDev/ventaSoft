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
        <!--img src="media/icons/logo.png" alt="lumega-mx" class="logo"-->
        <h5 class="nameProd">Cremeria y salchichoneria lucero</h5>
        <h6>
            Atendio: <span class="person">
                <?php echo $venta['nombre'] ?>
                </span>
        </h6>
        <center>
            <span id="hora"></span>
        </center>
    </div>
    <div class="ticket-body">
        <table>
            <thead>
                <tr>
                    <th>Prod</th>
                    <th>|</th>
                    <th>Cant</th>
                    <th>|</th>
                    <th>Costo</th>
                    <th>|</th>
                    <th>Import.</th>

                </tr>
            </thead>
            <tbody>
                <?php while($data = $detalle->fetch_assoc()){ ?>
                <tr>
                    <td style="text-align: center; font-size: 8px;" class="name"><?php echo $data['nombre'] ?></td>
                    <td></td>
                    <td style="text-align: left;" class="dato"><?php echo $data['cantidad_v'] ?></td>
                    <td></td>
                    <td style="text-align: left;" class="dato"><?php echo $data['precio_v'] ?></td>
                    <td></td>
                    <td style="text-align: left;" class="dato">$<?php echo  round($data['precio_v'] * $data['cantidad_v'] , 2) ?></td>
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

<script src="lib/jquery.js"></script>
<script>
    $(function(){
        fecha = new Date();
        dia = fecha.getDate() < 10 ? ("0"+fecha.getDate()) : fecha.getDate();
        mes = (fecha.getMonth() +1) < 10 ? "0"+(fecha.getMonth()+1) : fecha.getMonth()+1;
        año = (fecha.getFullYear());

        hoy = dia+"/"
        $('#hora').val(hoy)
        window.print();
    });
</script>
