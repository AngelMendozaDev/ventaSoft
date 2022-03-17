<?php 
    require_once "head.php";
    require_once "classes/funciones.php";
    $model = new funciones();

    $data = $model->getFaltantes();
?>
<link rel="stylesheet" href="css/almacen.css">

<div class="cont-g">
    <center>
    <h1>Productos por terminar</h1>
    </center>

    <hr style="margin-top: 15px; margin-bottom: 15px; width: 90%; margin: auto; color: #fff;">
    <br>

    <div class="cont-table">
        <table class="table table-hover table-responsive table-bordered" id="table-almacen">
            <thead class="table-primary text-center">
                <tr>
                    <th>Codigo</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody class="text-center table-bod">
                <?php while($datos = $data->fetch_assoc()){ ?>
                <tr>
                    <td><?php echo $datos['codigo']; ?></td>
                    <td><?php echo $datos['nombre']; ?></td>
                    <td><?php echo $datos['cantidad'] . " " .$datos['unidad']; ?></td>
                    <td>$<?php echo $datos['precio']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once "foot.php";?>
<script>
    $('#table-almacen').dataTable();
</script>