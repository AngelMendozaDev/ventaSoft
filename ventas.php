<?php
session_start();

if (!$_SESSION['ID'] || $_SESSION['ID'] == "")
    header("location:index.php");
?>
<?php require_once "headv.php"; ?>
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
                <button class="btn btn-primary btn-small">
                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="cont-table">
            <table class="table table-bordered table-responsive table-small">
                <thead class="table-primary text-center">
                    <tr>
                        <th>col1</th>
                        <th>col2</th>
                        <th>col3</th>
                        <th>col4</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <tr>
                        <td>data1</td>
                        <td>data2</td>
                        <td>data3</td>
                        <td>data4</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once "footv.php"; ?>