
$('#delete-modal').on('show.bs.modal', function (event) {
  
  var button = $(event.relatedTarget);
  var id = button.data('customer');
  
  var modal = $(this);
  modal.find('.modal-title').text('Excluir Cliente #' + id);
  modal.find('#confirm').attr('href', 'delete.php?id=' + id);
})

$('.custom-file-input').on('change',function(){
    var fileName = $(this).val().replace(/\\/g, '/').replace(/.*\//, '');
    var res = fileName.split(".");
    var tipos = ["xlsx", "xls", "xlt"];

    $("#alert_id").empty();

    if(tipos.includes(res[1])){
        if((fileName.length)> 28){ 
            $(".custom-file-label").text(fileName.slice(0, 28)+ '...');
        }
        else{
        $(".custom-file-label").text(fileName);}
    }
    else {
        $('#alert_id').append('O arquivo deve ser do tipo: .xslx, .xsl, .xlt');
        
        var temp = document.getElementById("input_file");
        temp.value = '';
        $(".custom-file-label").text("Selecionar arquivo");
    }
        
});


$('#submit_id').click(function(){
    var status=true;
        $('.required').each(function(){

            var element=$(this);
            var elementVal=$(this).val();
            var errorMsgId=element.attr('data-errorMsg');
            if(elementVal==''){
                $('.'+errorMsgId).show();
                element.addClass('errorField');
                status=false;
            }
            else{
                $('.'+errorMsgId).hide();
                element.removeClass('errorField');
            }
        });

    if(status) {
        $('.alert-success').css("display","block");
        setTimeout(function(){ $('.alert-success').fadeOut() }, 3000);

}

});

