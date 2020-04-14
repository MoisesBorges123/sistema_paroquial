
    
    $(document).ready(function(){
        //Inicializa a Tabela
       // loadTable();
       
        //Inicioalia a validaçao do formulario
       // formValidate();
        
    });
    $(document).on('click','#btn-add',function(){
        var campo_ip = createInput('ip','*IP','text',true);
        var campo_token = createInput('_token','','hidden',false);
        var campo_nome = createInput('nome','*Nome','text',true);
        var campo_senha = createInput('senha','Senha','text',false);
        var campo_mac = createInput('mac','MAC','text');
        var campo_SO = createInput('so','Sistema Operacioal','text',false);
        var campo_marca = createInput('marca','Marca do Dispositivo','text',false);
        Swal.fire({
            title:woli_titulo,
            allowOutsideClick:false,
            allowEscapeKey:false,
            allowEnterKey:false,
            width:"50rem",
            html:"<form id='form_dispositivo' class='form-control'>"+
                    "<div class='form-group row'>"+
                        "<div class='col-md-2 col-sm-6'>"+
                            campo_nome.label+
                        "</div>"+
                        "<div class='col-md-4 col-sm-6'>"+
                            campo_nome.input+
                        "</div>"+
                        "<div class='col-md-2 col-sm-6'>"+
                            campo_senha.label+
                        "</div>"+
                        "<div class='col-md-4 col-sm-6'>"+
                            campo_senha.input+
                        "</div>"+                    
                    "</div>"+
                    "<div class='form-group row'>"+
                        "<div class='col-md-2 col-sm-6'>"+
                            campo_marca.label+
                        "</div>"+
                        "<div class='col-md-4 col-sm-6'>"+
                            campo_marca.input+
                        "</div>"+
                        "<div class='col-md-2 col-sm-6'>"+
                            campo_SO.label+
                        "</div>"+
                        "<div class='col-md-4 col-sm-6'>"+
                            campo_SO.input+
                        "</div>"+                    
                    "</div>"+
                    "<div class='form-group row'>"+
                        "<div class='col-md-2 col-sm-6'>"+
                            campo_ip.label+
                        "</div>"+
                        "<div class='col-md-4 col-sm-6'>"+
                            campo_ip.input+
                        "</div>"+
                        "<div class='col-md-2 col-sm-6'>"+
                            campo_mac.label+
                        "</div>"+
                        "<div class='col-md-4 col-sm-6'>"+
                            campo_mac.input+
                        "</div>"+                    
                    "</div>"+                    
                    campo_token.input+
                    "<div class='form-radio m-b-30'>"+
                            "<div class='radio radio-matrial radio-primary radio-inline'>"+
                                "<label>"+
                                    "<input type='radio' value='Computador' name='tipo' checked='checked'>"+
                                    "<i class='helper'></i>Computador"+
                                "</label>"+
                            "</div>"+
                            "<div class='radio radio-matrial radio-primary radio-inline'>"+
                                "<label>"+
                                    "<input type='radio' value='Dispositivo Movel' name='tipo' checked='checked'>"+
                                    "<i class='helper'></i>Dispositivel Movel"+
                                "</label>"+
                            "</div>"+
                    "</div>"+
                    "</form",
            //showLoaderOnConfirm: true,
            allowOutsideClick: () => !Swal.isLoading(),
            
            preConfirm:()=>{    
               if($('#id_ip').val()=="" || $('#id_nome').val()==''){
                    Swal.showValidationMessage("É obrigatório preencher todos os campos que possuam '*'");
                  return false;                   
               }else{
                   $('#id__token').val(_token);
                   return true;
               }
              
            },
            
            
        }).then((result)=>{ //Salvar dados no banco de dados
            $('#cadastrando').remove();
                 $('.loading').append('<div id="cadastrando" style="margin-top: 0px;text-align: left !important;" class="cell preloader5">'+
                '<span style="font-size: 29px;">Cadastrando</span>'+
                '<div class="circle-5 l"></div>'+
                '<div class="circle-5 m"></div>'+
                '<div class="circle-5 r"></div>'+
                '</div>'); 
            return fetch(url_salva_dadosCadastrais,
              {
                credentials: "same-origin",
                method:'POST',
                body: new FormData(document.getElementById('form_dispositivo'))
              }); 
              
        }).then((resultado)=>{
            $('#cadastrando').remove();
           if(!resultado.ok){
               Swal.fire({
                  position: 'top-end',
                  icon: 'error',
                  title: 'Não foi possível comunicar com o servidor',
                  showConfirmButton: false,
                  timer: 1500
                })
           }else{
               return resultado.json();
           }
        }).then((resposta)=>{
            
            
            if(resposta.resposta == true){
                 Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Dispositivo incluido com sucesso!',
                  showConfirmButton: false,
                  timer: 1500
                });
                loadTable();
            }else{
                 Swal.fire({
                  position: 'top-end',
                  icon: 'warning',
                  title: 'O Woli encontrou um problema ao salvar os dados, por favor tente novamente.',
                  showConfirmButton: true,
                  timer: 1500
                })
            }
        });
    });
    $(document).on('click','.btn-editar',function(){
        var campo_ip = createInput('ip','*IP','text',true);
        var campo_nome = createInput('nome','*Nome','text',true);
        var campo_senha = createInput('senha','Senha','text',false);
        var campo_mac = createInput('mac','MAC','text',false);
        var campo_SO = createInput('so','Sistema Operacioal','text',false);
        var campo_marca = createInput('marca','Marca do Dispositivo','text',false);
        var campo_token = createInput('_token','','hidden',false);
        var campo_id = createInput('cod','','hidden',false);
        var cod = $(this).data('cod');
        $.ajax({
            url: $(this).data('url'),
            type: 'GET',
            dataType:'JSON',
            statusCode: {
            404: function() {
              Swal.fire('Erro 404', "Ocorreu um erro ao carregar ao carregar a pagina!",'error');
            },
            405: function() {
              Swal.fire('Erro 405', "Ocorreu um erro ao encontrar o metodo de pesquisa!",'error');
            },
            500: function() {
              Swal.fire('Erro 500', "Ocorreu um erro ao processar os dados!",'error');
            }
           
           }, 
            success:function(data){
                    console.log(data.ip);
                if(data.ip){
                    Swal.fire({
                    title:woli_titulo+"(Atualizar)",            
                    allowEscapeKey:false,
                    allowEnterKey:false,
                    width:"50rem",
                     html:"<form id='form_dispositivo' class='form-control'>"+
                    "<div class='form-group row'>"+
                        "<div class='col-md-2 col-sm-6'>"+
                            campo_nome.label+
                        "</div>"+
                        "<div class='col-md-4 col-sm-6'>"+
                            campo_nome.input+
                        "</div>"+
                        "<div class='col-md-2 col-sm-6'>"+
                            campo_senha.label+
                        "</div>"+
                        "<div class='col-md-4 col-sm-6'>"+
                            campo_senha.input+
                        "</div>"+                    
                    "</div>"+
                    "<div class='form-group row'>"+
                        "<div class='col-md-2 col-sm-6'>"+
                            campo_marca.label+
                        "</div>"+
                        "<div class='col-md-4 col-sm-6'>"+
                            campo_marca.input+
                        "</div>"+
                        "<div class='col-md-2 col-sm-6'>"+
                            campo_SO.label+
                        "</div>"+
                        "<div class='col-md-4 col-sm-6'>"+
                            campo_SO.input+
                        "</div>"+                    
                    "</div>"+
                    "<div class='form-group row'>"+
                        "<div class='col-md-2 col-sm-6'>"+
                            campo_ip.label+
                        "</div>"+
                        "<div class='col-md-4 col-sm-6'>"+
                            campo_ip.input+
                        "</div>"+
                        "<div class='col-md-2 col-sm-6'>"+
                            campo_mac.label+
                        "</div>"+
                        "<div class='col-md-4 col-sm-6'>"+
                            campo_mac.input+
                        "</div>"+                    
                    "</div>"+                    
                    campo_token.input+
                    campo_id.input+
                    "<div class='form-radio m-b-30'>"+
                            "<div class='radio radio-matrial radio-primary radio-inline'>"+
                                "<label>"+
                                    "<input type='radio' id='d_fixo' value='Computador' name='tipo'>"+
                                    "<i class='helper'></i>Computador"+
                                "</label>"+
                            "</div>"+
                            "<div class='radio radio-matrial radio-primary radio-inline'>"+
                                "<label>"+
                                    "<input type='radio' id='d_movel' value='Dispositivo Movel' name='tipo' >"+
                                    "<i class='helper'></i>Dispositivel Movel"+
                                "</label>"+
                            "</div>"+
                    "</div>"+
                    "</form",
                    showLoaderOnConfirm: true,
                    allowOutsideClick: () => !Swal.isLoading(),
                    onRender:function(){
                        $('#id_ip').val(data.ip);
                        $('#id_nome').val(data.nome);
                        $('#id_senha').val(data.senha);
                        $('#id_so').val(data.sistema_operacional);
                        $('#id_marca').val(data.marca);
                        $('#id_mac').val(data.mac);
                        if(data.tipo=='Computador'){
                            $('#d_fixo').attr("checked",true);                          
                            
                        }else if(data.tipo=='Dispositivo Movel'){                            
                            $('#d_movel').attr("checked",true);
                            
                        }

                    },
                    preConfirm:()=>{
                         if($('#id_ip').val()=="" || $('#id_nome').val()==''){
                            Swal.showValidationMessage("É obrigatório preencher todos os campos que possuam '*'");
                          return false;                   
                       }else{
                           $('#id__token').val(_token);
                           $('#id_cod').val(cod);
                           return true;
                       }
                    },


                }).then((result)=>{ //Salvar dados no banco de dados
                    $('#atualizando').remove();
                         $('.loading').append('<div id="atualizando" style="margin-top: 0px;text-align: left !important;" class="cell preloader5">'+
                        '<span style="font-size: 29px;">Atualizando</span>'+
                        '<div class="circle-5 l"></div>'+
                        '<div class="circle-5 m"></div>'+
                        '<div class="circle-5 r"></div>'+
                        '</div>'); 
                    return fetch(url_atualizar_dadosCadastrais,
                      {
                        credentials: "same-origin",
                        method:'POST',
                        body: new FormData(document.getElementById('form_dispositivo'))
                      }); 

                }).then((resultado)=>{
                    $('#atualizando').remove();
                   if(!resultado.ok){
                       Swal.fire({
                          position: 'top-end',
                          icon: 'error',
                          title: 'Não foi possível comunicar com o servidor',
                          showConfirmButton: false,
                          timer: 1500
                        })
                   }else{
                       return resultado.json();
                   }
                }).then((resposta)=>{


                    if(resposta.resposta == true){
                         Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          title: 'Os dados do dispositivo foram atualizados com sucesso!',
                          showConfirmButton: false,
                          timer: 1500
                        });
                        loadTable();
                    }else{
                         Swal.fire({
                          position: 'top-end',
                          icon: 'warning',
                          title: 'O Woli encontrou um problema ao atualizar os dados, por favor tente novamente.',
                          showConfirmButton: true,
                          timer: 1500
                        })
                    }
                });
                }
            }
            
        });
                
         
    });
    $(document).on('click','.btn-excluir',function(){
        var url_delete = $(this).data('urldelete');
        $.ajax({
            url:$(this).data('url'),
            type: 'GET',
            dataType:'JSON',
            
            statusCode: {
                404: function() {
                  Swal.fire('Erro 404', "Ocorreu um erro ao carregar ao carregar a pagina!",'error');
                },
                405: function() {
                  Swal.fire('Erro 405', "Ocorreu um erro ao encontrar o metodo de pesquisa!",'error');
                },
                500: function() {
                  Swal.fire('Erro 500', "Ocorreu um erro ao processar os dados!",'error');
                }           
           }, 
            success: function(data){
              
                Swal.fire({
                    title:"<h4>Excluir</h4>",
                    html:"Tem certeza que dezeja excluir o dispositivo "+ data.nome +", "+data.tipo,                    
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, deletar!'
                    
                }).then((result)=>{
                    if(result.value){                        
                        
                        return fetch(url_delete,{
                            method:'GET'
                        });
                        
                    }
                }).then((resultado)=>{
                    if(!resultado.ok){
                        Swal.fire('Ops!','Não foi possivel comunicar com o servidor.','error');
                        return {'resposta':false};
                    }else{
                        return resultado.json(); 
                                            
                    }
                    
                }).then((retorno)=>{
                    console.log(retorno.resposta);
                        if(retorno.resposta){
                            Swal.fire('Deletado!','O dispositivo foi deletado com sucesso','success');
                        }else{
                            Swal.fire('Ops!','Não foi possivel comunicar com o servidor.','error');

                        }
                        loadTable();  
                });
                

            },
        });
    });
    $(document).on('focus','#id_ip',function(){
        $('#id_ip').mask("000.000.000.000");            
    });
    $(document).on('input','#id_ip',function(){
        
        if($('#id_ip').val().length==2){
            if($('#id_ip').val()=="10"){
                $('#id_ip').mask('00.0.0.000');
                console.log($('#id_ip').val());
            }
        }else if($('#id_ip').val().length==3){
            if($('#id_ip').val()>=128 && $('#id_ip').val()<=191){
                $('#id_ip').mask('000.000.0.000');
            }else if($('#id_ip').val()>=192 && $('#id_ip').val()<=223){
                $('#id_ip').mask('000.000.0.000');
            }
        }else if($('#id_ip').val().length<=1){
                $('#id_ip').mask('000.000.0.000');
        }
            
    });
    function loadTable(){
        $.ajax({
            url:url_carregaTbl,
            type:'POST',
            datatype:'json',
            beforeSend:function(){
                $('#background').remove();
                $('body').append('<div id="background" class="modal-backdrop fade show"><div style="margin-top:20%;margin-left:20%">'+
                '<div class="cell preloader5 loader-block">'+
                '<div class="circle-5 l"></div>'+
                '<div class="circle-5 m"></div>'+
                '<div class="circle-5 r"></div>'+
                '</div>'+
                '</div></div>');
            },
            success: function(data){
                $('#background').remove();
                if($('tbody')){                    
                    $('tbody').html(data['table']);                       
                }else{
                    $('.alert').remove();
                    $('#alerta').append(''
                +'<div class="card">'         
            +'<div class="card-block table-border-style">'
                +'<div class="dt-responsive table-responsive" id="div_table">'
                    +'<table id="carros_estacionados" class="table table-striped table-bordered nowrap">'
                       +'<thead>'
                            +'<tr>'                                
                                +'<th>IP</th>'
                                +'<th>Dispositivo</th>'
                                +'<th>Sistema Operacional</th>'
                                +'<th>MAC</th>'
                                +'<th>Tipo</th>'
                                +'<th>Marca</th>'
                                +'<th>Descrição</th>'
                                +'<th>Ações</th>'
                            +'</tr>'
                        +'</thead>'
                        +'<tbody>'
                        +data['resposta'].table
                        +'</tbody>'
                        +'</table>'
                        +'</div>'
                        +'</div>'
                        +'</div>'
                        );
                }
            }
        });
    }
    function createInput(name,label,type,required){
        
        var id="id_"+name;
        var input = "<input name='"+name+"' id='"+id+"' type='"+type+"' required='"+required+"' class='form-control'/>";
        var lbl = "<label>"+label+"</label>";
        var campo={}
        campo={
            label:lbl,
            input:input,
        };
                    
        
        return campo;
    }
    function formValidate(){
         var form = document.getElementById('form_dispositivo');
                console.log(form);
                form.validate({
                  debug: true,
                  rules:{
                      id_ip:{
                          required:true,                          
                      },
                      id_nome:{
                          required:true,
                          max:50
                      }
                  },
                  messages:{
                      id_ip:{
                          required:"O campo IP é obrigatório"
                      },
                      id_nome:{
                          required:"O campo NOME é obrigatório"
                      }
                  }
              });
    }