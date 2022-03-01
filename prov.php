<?php require_once "head.php" ?>
<link rel="stylesheet" href="css/">

<div class="cont-g">
    <h1>Control general de Productos</h1>

    <div class="alert alert-success" id="descrip" role="alert">
        <span class="btn-close" onclick="closeAlert()"><i class="fas fa-times"></i></span>
        Dentro de este apartado podras, administrar los proveedores de
        su negocio
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ProvModal">
        <i class="fa fa-plus-circle" aria-hidden="true"></i>
        &nbsp;
        Nuevo Proveedor
    </button>

    <hr style="color: #fff; font-size:x-large; width: 80%; margin: auto; margin-top: 25px; margin-bottom: 25px;">

    <div class="contenedor-table">
        <table class="table table-hover table-responsive" id="myTabla">
            <thead class="table-primary text-center">
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="ProvModal" tabindex="-1" aria-labelledby="ProvModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ProvModalLabel">Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" onsubmit="return setProv()">

                <!--Datos invisibles -->
                <input type="text" name="user" value="<?php echo $_SESSION['ID']; ?>" hidden>
                <input type="text" name="action" id="action" hidden>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<?php require_once "foot.php" ?>