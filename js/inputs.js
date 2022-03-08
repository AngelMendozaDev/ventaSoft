function closeAlert() {
    $('#descrip').remove();
}

$(function() {
    $('#tableInput').dataTable();

    Tipo = "gallprov";
    $.ajax({
        url: "controllers/getInfo.php",
        type: "POST",
        data: { Tipo },
        success: function(response) {
            console.log(response);
            data = JSON.parse(response);
            console.log(data);
            $.each(data, function(key, item) {
                $('#prov').append("<option value=" + item.name + ">" + item.name + "</option>");
            });
        }
    });


    $('#codeBar').keypress(function(event) {
        if (event.which == 13) {
            code = $('#codeBar').val();

            if (code != "") {
                $.ajax({
                    url: "controllers/getInfo.php",
                    type: 'POST',
                    data: { code }
                });
            }
        }
    });

})