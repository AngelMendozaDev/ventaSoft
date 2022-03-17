<?php require_once "head.php"; ?>
<link rel="stylesheet" href="css/personal.css">

<?php
require_once "classes/funciones.php";
$model = new funciones();
$result = $model->getAllPersonal();
?>

<div class="cont-g">
    <h1>Control general de Personal</h1>

    <div class="alert alert-success" id="descrip" role="alert">
        <span class="btn-close" onclick="closeAlert()" style="cursor: pointer;"><i class="fas fa-times"></i></span>
        Dentro de este apartado podras, dar de alta, modificar o eliminar todo lo referente al
        personal que maneja en su inventario.
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPersonal" onclick="$('#action').val('')">
        <i class="fa fa-user-plus" aria-hidden="true"></i>
        &nbsp;
        Nueva contratación
    </button>

    <hr style="width: 80%; margin: auto; margin-top: 15px; margin-bottom: 10px; background-color: #fff;">

    <div class="table-cont">
        <table class="table table-responsive table-hover table-bordered" id="table">
            <thead class="table-dark text-center">
                <tr>
                    <th>PATERNO</th>
                    <th>MATERNO</th>
                    <th>NOMBRES</th>
                    <th>TIPO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php while ($data = $result->fetch_assoc()) { ?>
                    <tr class="text-center">
                        <td><?php echo $data['app']; ?></td>
                        <td><?php echo $data['apm']; ?></td>
                        <td><?php echo $data['nombre']; ?></td>
                        <td><?php echo $data['tipo'] == 1 ? "*<i class='fas fa-user-tie'></i>" : "/<i class='fas fa-user-tag'></i>"; ?></td>
                        <td class="col-acct">
                            <button class="btn btn-primary btn-small">
                                <i class="fas fa-user-lock"></i>
                            </button>
                            <button class="btn btn-warning btn-small" data-bs-toggle="modal" data-bs-target="#modalPersonal" onclick="getUser('<?php echo $data['id_p'] ?>')">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="modalPersonal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalPersonalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPersonalLabel">Personal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" class="form-personal" onsubmit="return addPerson()" id="form-personal">
                    <input type="text" name="user" value="<?php echo $_SESSION['ID'] ?>" hidden>
                    <input type="text" name="action" id="action" hidden>
                    <input type="text" name="id_us" id="id_us" hidden>

                    <label>Datos Personales</label>
                    <div class="personal-cont">
                        <div class="input-group dato">
                            <span class="input-group-text">Nombre:</span>
                            <input type="text" maxlength="20" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="input-group dato">
                            <span class="input-group-text">Ap. Paterno:</span>
                            <input type="text" maxlength="25" name="app" id="app" class="form-control" required>
                        </div>
                        <div class="input-group dato">
                            <span class="input-group-text">Ap. Materno:</span>
                            <input type="text" maxlength="25" name="apm" id="apm" class="form-control" required>
                        </div>
                        <div class="input-group dato">
                            <span class="input-group-text">Telefono</span>
                            <input type="number" name="phone" id="phone" class="form-control" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                        </div>
                    </div>
                    <label>Info. user</label>
                    <div class="user-cont">
                        <div class="input-group user-dato">
                            <span class="input-group-text">Usuario:</span>
                            <input type="text" name="nameUser" maxlength="15" class="form-control" id="nameUser" required>
                        </div>
                        <div class="input-group user-dato">
                            <span class="input-group-text">Cargo</span>
                            <select name="tipo" id="tipo" class="form-select" required>
                                <option value="" selected="true" disabled>Selecciona un cargo</option>
                                <option value="1">Administrador</option>
                                <option value="2">Caja</option>
                            </select>
                        </div>
                    </div>
                    <center>
                        <button class="btn btn-success btn-block">
                            <i class="fas fa-save"></i>
                            &nbsp;
                            Guardar
                        </button>
                    </center>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>

<?php require_once "foot.php"; ?>
<script src="js/personal.js"></script>