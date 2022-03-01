function setProv() {
    $.ajax({
        url: "controllers/addProv.php",
        type: "POST",
        data: $('#formProv').serialize(),
        success: function(response) {
            console.log(response);
        }
    });

    return false;
}