let objects = [];

function getProd() {
    codeBar = $('#codeBars').val();
    userCant = 0;
    if (codeBar != "" && codeBar != null) {
        $.ajax({
            url: "controllers/getInfo.php",
            type: "post",
            data: { Tipo: "gp", codeBar: codeBar },
            success: function (response) {
                //console.log(response)
                if (response != "err") {
                    data = JSON.parse(response);
                    //console.log(data);
                    if (data.unidad != "PZ") {
                        aux = 0;
                        userCant = parseFloat(prompt("Cantidad:"));
                    } else
                        userCant = 1;
                    if (contador(data.codigo) + userCant <= data.cantidad) {
                        if (data.cantMay == null) {
                            object = {
                                codigo: data.codigo,
                                name: data.nombre,
                                price: data.precio,
                                cant: contador(data.codigo) + userCant
                            }
                        } else {
                            object = {
                                codigo: data.codigo,
                                name: data.nombre,
                                price: contador(data.codigo) + userCant < data.cantMay ? data.precio : data.preciomay,
                                cant: contador(data.codigo) + userCant
                            }
                        }

                        addProd(object)
                    } else {
                        alert("Stock Insuficiente");
                    }
                } else {
                    alert("El codigo no existe")
                }
            }
        });
    } else
        alert("Llena los campos");

    $('#codeBars').val("");
}

function contador(code) {
    dato = 0.0;
    $.each(objects, function (key, item) {
        if (item.codigo == code) {
            dato = item.cant;
            return parseFloat(dato);
        }
    });
    return dato;
}

function addProd(object) {
    exist = false;
    $.each(objects, function (key, item) {
        if (item.codigo == object.codigo) {
            exist = true;
            objects[key] = object;
            repaint(object);
        }
    });

    if (exist == false) {
        objects.push(object)
        num = object.codigo;
        $('#lienzo-venta').append("<tr id='item-" + num + "'>" +
            "<td>" +
            "<input type='text' name='code[]' id='code-" + num + "' value='" + object.codigo + "' class='form-control campo' readonly>" +
            "</td>" +
            "<td>" +
            "<input type='text' name='name[]' id='name-" + num + "' value='" + object.name + "' class='form-control campo' readonly>" +
            "</td>" +
            "<td>" +
            "<input type='text' name='preciov[]' id='pricev-" + num + "' value='" + object.price + "' class='form-control campo-small' readonly>" +
            "</td>" +
            "<td>" +
            "<input type='text' name='cant[]' id='cant-" + num + "' value='" + object.cant + "' class='form-control campo-small' readonly>" +
            "</td>" +
            "<td>" +
            "<input type='text' id='import-" + num + "' class='form-control campo' value='" + object.price * object.cant + "' readonly>" +
            "</td>" +
            "<td>" +
            "<button class='btn btn-danger btn-small' onclick=' deleteItem(`" + num.toString() + "`)'>" +
            "<i class='fa fa-trash' aria-hidden='true'></i>" +
            "</button>" +
            "</td>" +
            "</tr>");
    }

    getTotal()
    if (objects.length > 0)
        $('#btn-pagar').show();
}

function repaint(data) {
    code = data.codigo;
    $("#pricev-" + code).val(data.price);
    $("#cant-" + code).val(data.cant);
    $("#import-" + code).val(data.price * data.cant);
    //console.log("repaint prod");
}

function getTotal() {
    total = 0;
    $.each(objects, function (key, item) {
        total += parseFloat($('#import-' + item.codigo).val());
        //console.log(total)
    });

    $('#total').val(total)
}

function deleteItem(id) {
    keys = 0;
    console.log("Eliminando el Prod " + id)
    $('#item-' + id).remove();
    $.each(objects, function (key, item) {
        if (item.codigo == id)
            keys = key;
    });

    objects.splice(keys, 1);
    getTotal();
    if (objects.length <= 0)
        $('#btn-pagar').hide();
}

function Imprime(ticket, pago) {
    object = window.open("http://localhost/ventaSoft/ticket.php?ticket=" + ticket + "&p=" + pago)
    swal({
            title: "Venta confirmada!",
            text: "LUMEGA-MX ESTUDIO [MARZO 2022]",
            icon: "success"
        })
        .then((value) => {
            object.close();
            location.reload();
        });
}

// funciones de carga
$(function () {

    $('#btn-pagar').hide();

    $('#codeBars').keypress(function (evt) {
        if (evt.which == 13) {
            getProd();
        }
    });

    $('#btn-pagar').click(function () {
        pago = 0;
        pago = parseFloat(prompt("Pago:"));
        total = $('#total').val();
<<<<<<< HEAD
            if (pago >= total) {
                $.ajax({
                    url: "controllers/addVenta.php",
                    type: 'POST',
                    data: $('#form-compra').serialize(),
                    success: function (response) {
                        console.log(response);
                        res = response.trim();
                        if (res >= 1) {
                            Imprime(res, pago);
                        }
                    }
                });
            }
            else{
                alert("Entrada Invalida");
            }
=======

        if (pago >= total) {
            $.ajax({
                url: "controllers/addVenta.php",
                type: 'POST',
                data: $('#form-compra').serialize(),
                success: function(response) {
                    console.log(response);
                    res = response.trim();
                    if (res >= 1) {
                        Imprime(res, pago);
                    }
                }
            });
        } else
            alert("Cantidada invalida");
>>>>>>> fcac995a8c4397da3a7784e9e1439105f50f5c3e
    });

});