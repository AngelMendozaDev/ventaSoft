<?php
require_once "head.php";
require_once "classes/funciones.php";
$model = new funciones();
$fi = $_GET['fi'];
$ff = $_GET['ff'];

$result = $model->repo_ventas($fi, $ff);

$total = 0.0;
?>
<link rel="stylesheet" href="css/repo.css">
<link rel="stylesheet" href="lib/datatable/css/buttons.dataTables.min.css">


<div class="cont-g">
    <center>
        <h1>Reporte de ventas</h1>
    </center>

    <button class="btn btn-primary mb-3" onclick="getDiario()">
        Reporte Diario
    </button>

    <div class="fechas-box">
        <div class="input-group campo">
            <span class="input-group-text my-label">
                <i class="far fa-calendar" aria-hidden="true"></i>
                &nbsp;
                Fecha inicial:
            </span>
            <input type="date" class="form-control" id="f-i">
        </div>

        <div class="input-group campo">
            <span class="input-group-text my-label">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                &nbsp;
                Fecha final:
            </span>
            <input type="date" class="form-control" id="f-f">
        </div>
    </div>
    <center>
        <button class="btn btn-success  mt-3 mb-3">
            Generar Reporte
        </button>
    </center>
    <hr class="separador" style="width: 80%; margin: auto; color: #fff;">

    <div class="table-box mt-3">
        <table class="table table-hover table-bordered table-small" id="myTable">
            <thead class="text-center table-dark">
                <tr>
                    <th>Ticket</th>
                    <th>Nombre</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody class="table-light text-center">
                <?php
                while ($data = $result->fetch_assoc()) {
                    $total += $data['total'];
                ?>
                    <tr>
                        <td><?php echo $data['folio_v'] ?></td>
                        <td><?php echo $data['nombre'] ?></td>
                        <td><?php echo $data['total'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" style="text-align:right; background-color: #fff; color: #000;">Total:</th>
                    <th style="text-align:right; background-color: #fff; color: #000;"></th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>

<?php require_once "foot.php" ?>
<script src="lib/datatable/js/dataTables.buttons.min.js"></script>
<script src="lib/datatable/js/buttons.print.min.js"></script>
<script src="js/repo_v.js"></script>
<script>
    $('#f-i').val('<?php echo $fi ?>');
    $('#f-f').val('<?php echo $ff ?>');
</script>