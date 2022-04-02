<?php
require_once "headv.php";
if (!$_SESSION['ID'] || $_SESSION['ID'] == "")
    header("location:index.php");
?>
<link rel="stylesheet" href="css/venta.css">

<div class="jumbotron jumbotron-fluid mt-5">
    <div class="container">
        <a href="http://localhost/ventaSoft/mainpv.php?suc=<?php echo $_SESSION['suc']; ?>" style="position: absolute; right:10%; color: red; font-size: 25px;">
            <i class="fa fa-times-circle" aria-hidden="true"></i>
        </a>
        <h1 class="display-6">Vendedor: <?php echo $_SESSION['NameUs'] ?></h1>
        <h3>Fecha: [ <span id="fecha">21-03-2022</span> ]</h3>
        <hr class="my-2">
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="venta-cont mt-3">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                    <input type="text" class="form-control" name="codeBars" id="codeBars" placeholder="Código de Barras" required>
                </div>
                <button class="btn btn-primary btn-small" onclick="getProd()">
                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <form class="cont-table" id="form-compra">
            <input type="text" value="<?php echo $_SESSION['ID'] ?>" name="user" hidden>
            <table class="table table-bordered table-responsive table-small">
                <thead class="table-primary text-center mx-auto">
                    <tr>
                        <th>Codigp</th>
                        <th>Producto</th>
                        <th>Precio Unit.</th>
                        <th>Cantidad</th>
                        <th>Importe</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center" id="lienzo-venta">
                </tbody>
            </table>
            <div class="total-cont">
                <center>
                    <div class="input-group w-50">
                        <span class="input-group-text etiqueta">Total: $</span>
                        <input type="text" class="form-control etiqueta" name="total" id="total" readonly>
                        <button type="button" class="btn btn-success w-100" id="btn-pagar">
                            Pagar &nbsp; 
                            <i class="fas fa-money-bill-wave"></i>
                        </button>
                    </div>
                </center>
            </div>
        </form>
    </div>
</div>
<?php require_once "footv.php"; ?>
<script src="lib/jspdf.js"></script>
<script src="js/ventas.js"></script>