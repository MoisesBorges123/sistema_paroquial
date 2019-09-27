
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
    });
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
        $(this).addClass('btn-danger');
        $(this).html("Remover");        
        
        //INSERE UM NOVO CAMPO PARA O USUARIO DIGITAR SEU TELEFONE
        $('#form-contato').append("<div class='form-group row linha-telefone' data-linha="+linha_telefone+">"
                                    +"<div class='col-sm-12'>"
                                        +"<label for='telefone-"+cod+"' class='block'>Telefone ("+linha_telefone+")</label>"
                                    +"</div>"
                                    +txt_dd
                                    +txt_telefone
                                    +btn_adiciona_telefone
        );
        $('.phone').mask('0000-0000');
    });
});