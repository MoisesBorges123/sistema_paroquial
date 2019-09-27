
$(document).ready(function(){
    $('.cep').mask('00000-000');
    $('.phone').mask('0000-0000');
    //CAMPOS DO CADASTRO DE TELEFONE
    var linha_telefone = 1;
    
    $(document).on('input','.dd',function(){
        if($(this).val().length==2){
            id = linha_telefone+22;
            $('telefone-'+id).focus();
        }
    }); //Após digitar o DD altere o foco para o telefone
    $(document).on('click','.adiciona-telefone',function(){
        linha_telefone++;
        var cod = linha_telefone+22;
        var txt_dd= "<div class=\"col-sm-2\" >"
                    +"<input id=\"dd-"+cod+"\" name=\"dd[]\" type=\"text\" class=\"form-control\" maxlength=\"2\">"

                +"</div>";
        var txt_telefone ="<div class=\"col-sm-8\">" 
                            +"<input id=\"telefone-"+cod+"\" name=\"fone[]\" type=\"text\" class=\"form-control phone\">"
                        +"</div>";
        var btn_adiciona_telefone="<div class=\"col-sm-2\">"
                                    +"<button class='btn btn-warning adiciona-telefone' data-linha="+linha_telefone+"  type='button'>+</button>"
                                "</div>";
        
        $(this).removeClass('btn-warning');
        $(this).addClass('btn-outline-danger');
        $(this).html("Remover"); 
        $(this).removeClass('adiciona-telefone');
        $(this).addClass('remove-telefone');
        
        //INSERE UM NOVO CAMPO PARA O USUARIO DIGITAR SEU TELEFONE
        $('#form-contato').after("<div class='form-group row linha-telefone' id='linha"+linha_telefone+"'>"
                                    +"<div class='col-sm-12'>"
                                        +"<label for='telefone-"+cod+"' class='block'>Telefone</label>"
                                    +"</div>"
                                    +txt_dd
                                    +txt_telefone
                                    +btn_adiciona_telefone
        );
        $('.phone').mask('0000-0000');
    }); //Inserir novos campos telefone
    $(document).on('click','.remove-telefone',function(){
        var linha=$(this).data('linha');
        $("#linha"+linha).remove();
    });// Removoer campos telefone inseridos
    $(document).on('click','#btn-salvar',function(){
        $.ajax({
            
        });
    }); // Enviar dados para o Controller
    
});

$(document).ready(function(e) {
    
    $("form[ajax=true]").submit(function(e) {
        
        e.preventDefault();
        
        var form_data = $(this).serialize();
        var form_url = $(this).attr("action");
        var form_method = $(this).attr("method").toUpperCase();
        
        $("#loadingimg").show();
        
        $.ajax({
            url: form_url, 
            type: form_method,      
            data: form_data,     
            cache: false,
            success: function(returnhtml){                          
                if(returnhtml)
                $("#teste").html(returnhtml); 
                                   
            }           
        });    
        
    });
    
});