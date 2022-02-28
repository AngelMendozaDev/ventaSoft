function addProd() {
    $.ajax({
        url: 'controllers/addProduct.php',
        type: 'POST',
        data: $('#formAddProd').serialize(),
        success: function (response) {
            //console.log(response);
            if (response.trim() == 1) {
                swal({
                    title:"Producto registrado, con exíto",
                    text:"LUMEGA-MX ESTUDIO [MARZO 2022]",
                    icon:"success"
                })
                    .then((value) => {
                        location.reload();
                    });
            }

        }
    });

    return false;
}

$(function(){
    $('#tableProd').dataTable();
})