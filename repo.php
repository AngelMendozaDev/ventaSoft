<?php require_once "head.php"?>

<link rel="stylesheet" href="css/repo.css">

<div class="cont-g">
    <h1>Reportes</h1>

    <div class="alert alert-success" id="descrip" role="alert">
        <span class="btn-close" onclick="closeAlert()" style="cursor: pointer;"><i class="fas fa-times"></i></span>
        Ingresa la fecha inicial y la final que desea de su reporte.
    </div>

    

    <!-- Button trigger modal -->

    <div class="fechas">
        <div class="input-group mx-auto mb-3 fech-i">
            <span class="input-group-text">
                <i class="fa fa-calendar" aria-hidden="true"></i>
            </span>
            <input type="date"  class="form-control" id="date-start">
        </div>
        <div class="input-group mx-auto mb-3 fech-i">
            <span class="input-group-text">
                <i class="far fa-calendar" aria-hidden="true"></i>
            </span>
            <input type="date"  class="form-control" id="date-final">
        </div>
    </div>

    <hr style="width: 80%; color: #fff; margin: auto; margin-top: 25px; margin-bottom: 25px;">

    <div class="contenedor-table">
        <table class="table table-hover table-responsive" id="tableInput">
            <thead class="table-primary text-center">
                <tr>
                    <th>Nota</th>
                    <th>Proveedor</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center table-light">
                <?php while ($key = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $key['n_nota'] ?></td>
                        <td><?php echo $key['prov'] ?></td>
                        <td><?php echo $key['fecha'] ?></td>
                        <td>
                            <button class="btn btn-small btn-primary btn-popover" data-bs-toggle="modal" data-bs-target="#modalDetails" onclick="getDetalle('<?php echo $key['id_nota'] ?>')">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="msg-pop">
                                    Ver detalle
                                </span>
                            </button>

                            <!-- <button class="btn btn-small btn-danger" data-bs-toggle="modal" data-bs-target="#addProductModal" onclick="deleteNote('<?php echo $key['id_nota'] ?>')">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button> -->

                            <!-- <button class="btn btn-small btn-danger">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button> -->

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


    <!-- Fin de Contenedor -->
</div>

<?php require_once "foot.php" ?>