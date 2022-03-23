function getCode(){
    code = $('#codeBars').val();
    if(code != ""){
        $.ajax({
            url:"controllers/getInfo.php",
            type: "POST",
            data:{Tipo:"getProdN", codeBar: code},
            success: function(response){
                console.log(response);
            }
        });
    }
    $('#codeBars').focus();
    
}

$(function(){
    $('#codeBars').keypress(function(evt) {
        if(evt.which == 13){
            getCode();
        }
    });
})