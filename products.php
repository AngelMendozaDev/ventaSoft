<?php require_once "head.php"; ?>
<link rel="stylesheet" href="css/products.css">
<?php
require_once "classes/funciones.php";
$modelo = new funciones();
$result = $modelo->getProductos();
?>

<div class="cont-g">
    <h1>Control general de Productos</h1>

    <div class="alert alert-success" id="descrip" role="alert">
        <span class="btn-close" onclick="closeAlert()" style="cursor: pointer;"><i class="fas fa-times"></i></span>
        Dentro de este apartado podras, dar de alta, modificar o eliminar todo lo referente a
        los productos que maneja en su inventario.
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal" onclick="$('#formAddProd')[0].reset(); $('#codeBars').attr('readonly', false); $('#may').prop('disabled', false); $('#cont-may').empty()">
        <i class="fa fa-plus-circle" aria-hidden="true"></i>
        &nbsp;
        Alta de Producto
    </button>

    <hr style="width: 80%; color: #fff; margin: auto; margin-top: 25px; margin-bottom: 25px;">

    <div class="contenedor-table">
        <table class="table table-hover table-responsive" id="tableProd">
            <thead class="table-primary text-center">
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Unidad de Venta</th>
                    <th>Precio</th>
                    <th>Precio May.</th>
                    <th>Cant May.</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center table-light">
                <?php while ($key = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $key['codigo'] ?></td>
                        <td><?php echo $key['nombre'] ?></td>
                        <td><?php echo $key['unidad'] ?></td>
                        <td>$<?php echo $key['precio'] ?></td>
                        <td>$<?php echo $key['preciomay'] != null ? $key['preciomay'] : 0; ?></td>
                        <td><?php echo $key['cantMay'] != null ? $key['cantMay'] : 0.00; ?></td>
                        <td>
                            <button class="btn btn-small btn-primary btn-popover" data-bs-toggle="modal" data-bs-target="#mayModal" onclick="getInfoM('<?php echo $key['codigo'] ?>')">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                <span class="msg-pop">
                                    Agregar Mayoreo
                                </span>
                            </button>

                            <button class="btn btn-small btn-warning" data-bs-toggle="modal" data-bs-target="#addProductModal" onclick="getInfo('<?php echo $key['codigo'] ?>')">
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

</div>

<!-- Modal New-Edit -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" onsubmit="return addProd() " id="formAddProd">

                    <input type="text" name="user" value="<?php echo $_SESSION['ID'] ?>" readonly hidden>
                    <input type="text" id="action" name="action" readonly hidden>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                        <input type="text" class="form-control" name="codeBars" id="codeBars" placeholder="Código de Barras" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Nombre:</span>
                        <input type="text" maxlength="20" style="text-transform: uppercase;" class="form-control" name="nameProduct" id="nameProduct" placeholder="Nombre del Producto" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Unidad de Venta</span>
                        <select class="form-select" name="unidad" id="unidadV" required>
                            <option value="" selected="true" disabled>Selecciona una opcion</option>
                            <option value="KG">KILOGRAMO</option>
                            <option value="L">LITRO</option>
                            <option value="PZ">PIEZA</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Precio Unitario:</span>
                        <input step="any" type="number" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="price" id="price" placeholder="Precio por Pieza, Litro o Kilogramo" required>
                    </div>

                    <input type="checkbox" name="mayoreo" id="may">
                    <label for="may" style="cursor: pointer;">Tiene Precio de mayoreo</label>

                    <hr style="width: 90%; margin: auto; margin-bottom: 0px; margin-top: 10px;">

                    <div class="cont-mayoreo" id="cont-may"></div>

                    <center>
                        <button type="submit" class="btn btn-block btn-success ">
                            <i class="fas fa-save"></i>
                            &nbsp;
                            Guardar
                        </button>
                    </center>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar Ventana</button>
            </div>
        </div>
    </div>
</div>

<!-- ModalMayoreos -->
<div class="modal fade" id="mayModal" tabindex="-1" aria-labelledby="mayModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mayModalLabel">Agregar Mayoreo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <button class="btn btn-primary btn-small mb-2" id="btn-more-may">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>

                <form method="POST" onsubmit="return setMayoreo()" id="formMay" class="mt-3">
                    <input type="text" id="prodID" name="prodID" readonly hidden>
                    <input type="text" id="types" name="types" readonly>
                    <input type="text" value="<?php echo $_SESSION['ID'] ?>" name="user" hidden readonly>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Cantidad:</span>
                        <input type="number" class="form-control" id="cantMayA" name="cantMayA" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Precio $:</span>
                        <input type="number" class="form-control" id="priceMayA" name="priceMayA" required>
                    </div>

                    <center>
                        <button type="submit" class="btn btn-success" id="btn-May">
                            <i class="fas fa-save"></i>
                            &nbsp;
                            Guardar Registro
                        </button>
                    </center>
                </form>
                <br>

                <hr style="width: 80%; color: #000; margin: auto;">

                <div class="may">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="lienzo-may">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php require_once "foot.php"; ?>
<script src="js/products.js"></script>