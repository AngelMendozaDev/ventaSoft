<?php require_once "head.php" ?>

<?php 
    require_once "classes/funciones.php";
    $model = new funciones();

    $result = $model->getProvs();
    $Folio = 1;
?>

<div class="cont-g">
    <h1>Control general de Proveedores</h1>

    <div class="alert alert-success" id="descrip" role="alert">
        <span class="btn-close" onclick="closeAlert()" id="descrip"><i class="fas fa-times"></i></span>
        Dentro de este apartado podras, administrar los proveedores de
        su negocio
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ProvModal" onclick="$('#formProv')[0].reset()">
        <i class="fa fa-plus-circle" aria-hidden="true"></i>
        &nbsp;
        Nuevo Proveedor
    </button>

    <hr style="color: #fff; font-size:x-large; width: 80%; margin: auto; margin-top: 25px; margin-bottom: 25px;">

    <div class="contenedor-table">
        <table class="table table-hover table-responsive table-light" id="tableProv">
            <thead class="table-primary text-center">
                <tr>
                    <th>FOLIO</th>
                    <th>NOMBRE</th>
                    <th>EMPRESA</th>
                    <th>NUMERO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody class="text-center">

                <?php while($data = $result->fetch_assoc()){ ?>
                <tr>
                    <td><?php echo $Folio; ?></td>
                    <td><?php echo $data['empresa']; ?></td>
                    <td><?php echo $data['nombre_prov']; ?></td>
                    <td><?php echo $data['numero']; ?></td>
                    <td>
                        <button class="btn btn-small btn-warning" data-bs-toggle="modal" data-bs-target="#ProvModal" onclick="getInfo('<?php echo $data['id_prov'] ?>')">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </button>

                        <button class="btn btn-small btn-danger" onclick="deleteProv('<?php echo $data['id_prov'].'*'.$data['numero'].'*'.$_SESSION['ID'] ?>')">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
                <?php 
                $Folio++;
            } ?>
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
                <form method="POST" id="formProv" onsubmit="return setProv()">

                    <!--Datos invisibles -->
                    <input type="text" name="user" value="<?php echo $_SESSION['ID']; ?>" hidden>
                    <input type="text" name="action" id="action" hidden >
                    <input type="text" name="idProv" id="idProv" hidden>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Nombre:</span>
                        <input type="text" maxlength="60" class="form-control" style="text-transform: uppercase;" name="nombreP" id="nameP" placeholder="Nombre del representante" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Empresa:</span>
                        <input type="text" maxlength="50" class="form-control" style="text-transform: uppercase;" name="empresa" id="empresa" placeholder="Nombre de la empresa" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Telefono</span>
                        <input type="number" maxlength="10"
                            oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                            class="form-control" name="phone" id="phone" placeholder="N??mero telefonico a 10 digitos" required>
                    </div>

                    <center>
                        <button class="btn btn-success">
                            <i class="fa fa-save" aria-hidden="true"></i>
                            &nbsp;
                            Guardar
                        </button>
                    </center>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<?php require_once "foot.php" ?>
<script src="js/prov.js"></script>