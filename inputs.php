<?php
require_once "classes/funciones.php";
require_once "head.php";

$model = new funciones();

$result = $model->getNotas();

?>

<link rel="stylesheet" href="css/notas.css">

<div class="cont-g">
    <h1>Notas y entradas:</h1>

    <div class="alert alert-success" id="descrip" role="alert">
        <span class="btn-close" onclick="closeAlert()" style="cursor: pointer;"><i class="fas fa-times"></i></span>
        Ingresa el producto recibido, si tienes productos nuevos, primero debes hacer el <a href="products.php">alta de
            producto</a>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalNote">
        Agregar Nota
        &nbsp;
        <i class="fa fa-sticky-note" aria-hidden="true"></i>
    </button>

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
                            <button class="btn btn-small btn-primary btn-popover">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="msg-pop">
                                    Ver detalle
                                </span>
                            </button>

                            <button class="btn btn-small btn-warning" data-bs-toggle="modal" data-bs-target="#addProductModal" onclick="getInfo('<?php echo $key['id_nota'] ?>')">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </button>

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

<!-- Modal -->
<div class="modal fade" id="ModalNote" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalNoteLabel">Notas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-nota">
                    <!-- Campos invisibles -->
                    <input type="text" readonly name="user" value="<?php echo $_SESSION['ID'] ?>">
                    <input type="text" readonly name="action" id="action" readonly>

                    <div class="nota-controllers">
                        <div class="input-group mb-3">
                            <span class="input-group-text">N° Nota:</span>
                            <input type="text" class="form-control" id="n_nota" name="n_nota" style="text-transform: uppercase;" maxlength="20" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Proveedor:</span>
                            <select name="prov" id="prov" class="form-select" required>
                                <option value="" selected="true" disabled>Selecciona un Proveedor</option>
                            </select>
                        </div>
                    </div>

                    <hr style="width: 95%; margin: auto; color:black; margin-bottom: 15px; margin-top: 15px;">

                    <!-- Modulo para agrtegar items -->
                    <div class="nota-controllers">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa fa-barcode" aria-hidden="true"></i>
                            </span>
                            <input type="text" class="form-control" id="codeBar" style="text-transform: uppercase;" maxlength="20">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Producto:</span>
                            <input type="text" class="form-control" id="Name" readonly>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Cantidad:</span>
                            <input step="any" type="number" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" id="Cant" disabled>
                        </div>

                        <button type="button" id="addProd" class="btn btn-primary btn-small h-50 my-auto">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                        </button>

                    </div>
                    <p class="error" id="msgbox">Llena los campos para continuar</p>
                    <hr style="width: 95%; margin: auto; color:black; margin-bottom: 15px; margin-top: 15px;">

                    <div class="cont-entrada">
                        <table class="table table-hover table-bordered">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>Codigo</th>
                                    <th>Producto</th>
                                    <th style="width: 50px;">Cantidad</th>
                                    <th>Cancel</th>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="lienzo">

                            </tbody>
                        </table>
                    </div>

                </form>
            </div>
            <div class="modal-footer">

                <button class="btn btn-danger" id="cancelNote">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                    &nbsp;
                    Cancelar Nota
                </button>

                <button class="btn btn-success" id="saveNote">
                    <i class="fa fa-save" aria-hidden="true"></i>
                    &nbsp;
                    Guardar Nota
                </button>
            </div>
        </div>
    </div>
</div>

<?php require_once "foot.php" ?>
<script src="js/inputs.js"></script>