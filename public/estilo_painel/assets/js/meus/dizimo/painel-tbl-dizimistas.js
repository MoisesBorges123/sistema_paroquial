$(document).ready(function(){
   /*var table = $('#dizimistas').DataTable({
        "language": {
            "decimal": ",",
            "lengthMenu":     "Mostrar _MENU_ registros",
            "thousands": ".",
            "search":         "Buscar:",
            "emptyTable":     "Nenhum registro cadastrado.",
            "info":           "Mostrando _START_ de _END_ of _TOTAL_ registros",
            "infoEmpty":      "Moostrando 0 de 0 registros",
             paginate: {
                first:    '«',
                previous: '‹',
                next:     '›',
                last:     '»'
            }
        },
        select: true,
        compact:true
        
    });*/
   $('#mes_aniversario').slideToggle();
   
   $('#busca_dizimista').select2();
    $(document).on('click','td',function(){
        var td = $(this);
        var input = td.querySelect('input');
        input.val = null;
        $(input).mask("#.##0,00", {reverse: true})
        
    });
    $(document).on('click','.devolver',function(){
        //alert($(this).data('id_dizimista'));
        window.location.href=url_devolucao+'\/'+$(this).data('dizimista');
    });
    $(document).on('click','.morte',function(){
        Swal.fire({
            title:"<h2 style='margin-top:auto;'>Woli</h2> <img src = '"+woli+"' width='100' height='70'>",
            html:"<h5>Tem certeza que "+$(this).data('nome')+" realmente morreu?</h5>"
                +"<p>Essa pessoa será removida de todos os grupos e pastorais que ela participa.</p>",
        });
    });
    $(document).on('input','#id_cep',function(){
        var cep = $(this).val();
        
        if(cep.length==9){
            
            $.ajax({
                url:busca_cep,
                type: 'POST',
                data:{ cep:cep },
                dataType:'JSON',
                beforeSend: function(){
                    Swal.showLoading();
                },
                success: function(data){
                    Swal.hideLoading();            
                    
                    if(data['logradouro'][0]){                       
                        $('#id_rua').val(data['logradouro'][0]);
                        $('#id_bairro').val(data['bairro'][0]);
                        $('#id_cidade').val(data['cidade'][0]);
                        $('#id_estado').val(data['estado']);
                        
                    }else if(data['logradouro']){
                        $('#id_rua').val(data['logradouro']);
                        $('#id_bairro').val(data['bairro']);
                        $('#id_cidade').val(data['cidade']);
                        $('#id_estado').val(data['estado']);                       
                    }
                }
            });
        }
    });
    $(document).on('click','#btn_add',async function(){
        var field_nome = createInput('nome','Nome','text',true);
        var field_dataNasc = createInput('d_nasc','Data de Nascimento','date',true);
        var field_email = createInput('email','E-mail','text',false);
        var field_cep = createInput('cep','CEP','text',false);
        var field_numero = createInput('numero','Nº','text',false);
        var field_rua = createInput('rua','Rua','text',false);
        var field_bairro = createInput('bairro','Bairro','text',false);
        var field_cidade = createInput('cidade','Cidade','text',false);
        var field_estado = createInput('estado','Estado','text',false);
        var field_telefone = "<label>Telefone</label><input class='form-control phone_area-code telefone' name='telefone[]'>";
        var btn_add_telefone = "<button data-linha=1 class='btn btn-warning addTelefone m-t-30' type='button'>Adicionar</button>";
        (cadastro) = Swal.fire({
            title:'Novo Dizimista',
            html:"<div class='row'>"+
                "<div class='col-md-12 col-sm-12'>"+field_nome.label+field_nome.input+"</div>"+
                "<div class='col-md-6 col-sm-12 m-t-20'>"+field_dataNasc.label+field_dataNasc.input+"</div>"+
                "<div class='col-md-6 col-sm-12 m-t-20'>"+field_email.label+field_email.input+"</div>"+
                "<div class='col-md-12  m-t-20' id='meus_telefones'><div class='row' id='linha_1'>"+
                "<div class='col-md-8 col-sm-12 m-t-20'>"+field_telefone+"</div>"+
                "<div class='col-md-2 col-sm-12 m-t-20'>"+btn_add_telefone+"</div>"+
                "</div></div>"+
                "<div class='col-md-8 col-sm-12 m-t-20'>"+field_cep.label+field_cep.input+"</div>"+
                "<div class='col-md-4 col-sm-12 m-t-20'>"+field_numero.label+field_numero.input+"</div>"+
                "<div class='col-md-12 col-sm-12 m-t-20'>"+field_rua.label+field_rua.input+"</div>"+
                "<div class='col-md-6 col-sm-12 m-t-20'>"+field_bairro.label+field_bairro.input+"</div>"+
                "<div class='col-md-6 col-sm-12 m-t-20'>"+field_cidade.label+field_cidade.input+"</div>"+
                "<div class='col-md-6 col-sm-12 m-t-20'>"+field_estado.label+field_estado.input+"</div>"+
            "</div>",
            onRender: async function(){
                (dados) = await fetch(url_buscar_pessoas,{
                    method:'GET',
                }).then((result)=>{
                    if(result.ok){
                        return result.json();
                    }
                });
                var linhas=null;                        
                    if(dados){
                        for(var i = 0; i<dados.total_pessoas;i++){
                            linhas=linhas+"<option style='width:100%;' data-telefone='"+dados.pessoas[i].numero+"' data-id='"+dados.pessoas[i].id_pessoa+"' value='"+dados.pessoas[i].nome+"'>"+dados.pessoas[i].nome+"</option>"                                    
                        }
                    }
                $('#list_pessoas').remove();
                $('body').append("<datalist id='list_pessoas'>"+linhas+"</datalist>");
                $('#id_nome').attr('list','list_pessoas');
            },
            onOpen: function(){
                $('#id_cep').addClass('cep');                
                $('#id_rua').prop('disabled',true);
                $('#id_bairro').prop('disabled',true);
                $('#id_cidade').prop('disabled',true);
                $('#id_estado').prop('disabled',true);                
            },
            preConfirm: function(){
                var nome = $('#id_nome').val();
                if(nome==''){
                    Swal.showValidationMessage("Você deve preencher o nome campo.");
                    return false;
                }else{
                    return true;
                }
            }
            
        });
    });

    $(document).on('click','#btn-aniversariantes', function(){
        $('#coluna-anivesario').removeClass('col-md-1');
        $('#coluna-anivesario').removeClass('col-lg-1');
        $('#coluna-anivesario').addClass('col-lg-3');
        $('#coluna-anivesario').addClass('col-md-3');
        $('#mes_aniversario').slideToggle(200);
       
    });
    $(document).on('click','#excluir_cadastro',function(){
    var deletar_cadastro = $(this).data('url');
    var dizimista = $(this).data('dizimista');
    Swal.fire({
        title:'Tem certeza que deseja excluir esse cadastro?',
        icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sim, deletar!'
    }).then((result) => {
          if (result.value) {
              fetch(deletar_cadastro,{
                  method:'GET',                  
              }).then((response)=>{
                  if(!response.ok){
                      Swal.fire('Ops!','Erro ao comunicar com o servidor.','error');
                  }else{
                      
                  }
                 return response.json();
              }).then(function(resposta){
                  if(resposta.resposta==false){
                      var msg;
                      var icon;
                      if(resposta.excluido==true){
                          msg = "Esse registro já foi excluido";
                          icon = "info";
                      }else{
                          msg = "Não foi possível excluir esse registro por razões misteriosas.";
                          icon = "warning";
                      }
                      Swal.fire({
                          title:"<h2 style='margin-top:auto;'>Woli</h2> <img src = '"+woli+"' width='100' height='70'><br><div>Ops!</div>",
                          html:msg,
                          icon:icon,
                          timer:3000,
                          showConfirmButton:false
                      });
                  }else{
                      Swal.fire({
                          title:"<h2 style='margin-top:auto;'>Woli</h2> <img src = '"+woli+"'  width='100' height='70'><br> <div>Registro Deletado!</div>",
                          icon:'success',
                          timer:2000,
                          showConfirmButton:false
                      });
                      $('#linha'+dizimista).remove();
                      setTimeout(function(){
                        window.location.href=meus_dizimistas;
                    },1600);
                  }
              });
            
          }
     
    });
});
    $(document).on('change','#selecionar_registros',function(){
        
        fetch(indexDizimistas+'/'+$('#selecionar_registros').val(),{
            method:'GET',            
        }).then((response)=>{
            if(!response.ok){
                Swal.fire('Ops!','Não foi possível comunciar com o servidor.','warning');
            }
            return response.json();
        }).then((result)=>{
           if(result.qtde_registros==0){
               Swal.fire({
                  title:"<h2 style='margin-top:auto;'>Woli</h2> <img src = '"+woli+"' width='100' height='70'><br><div>Ops!</div>",
                  html:"Não encontrei nenhum registro.",
                  icon:'info',
                  timer:3000,
                  showConfirmButton:true
               });
                
           }else{   
               
               table.clear().draw();
               
               for(var i = 0; i<result.qtde_registros;i++){
                   
                   if(result.query[i].apartamento){
                       var apartamento =' ,'+result.query[i].apartamento;
                   }else{
                       var apartamento ='';
                       
                   }
                   var sexo;
                   if(result.query[i].sexo==2){
                       sexo='<i class="icofont icofont-user-female"></i>';
                   }else if(result.query[i].sexo==1){
                       sexo='<i class="icofont icofont-user-alt-4"></i>';                       
                   }else{
                       sexo='<i class="icofont icofont-user-alt-5"></i>';                       
                   }
                   var button_ficha='<button data-dizimista="'+result.query[i].id_dizimista+'" class="btn btn-info devolver btn-icon bt-table" data-toggle="tooltip" data-original-title="Ficha">'
                                   +sexo
                               +'</button>';
                   table.row.add( {
                        "Código":       result.query[i].id_dizimista,
                        "Nome":   result.query[i].nome,
                        "Endereço":     result.query[i].rua+', '+result.query[i].bairro+', '+result.query[i].num_casa+apartamento,
                        "Aniversário": formataData(result.query[i].d_nasc),
                        "Ações":     "<div class='icon-btn'>"+button_ficha+result.butao_excluir[i]+"</div>"                        
                    } ).draw();
                    
                    /*  dados = dados+ ''
                           +'<tr id="'+result.query[i].id_dizimista+'">'
                           +'<td>'+result.query[i].id_dizimista+'</td>'
                           +'<td class="text-left">'+result.query[i].nome+'</td>'
                           +'<td class="text-left">'+result.query[i].rua+', '+result.query[i].bairro+', '+result.query[i].num_casa+apartamento+'</td>'
                           +'<td class="text-left">'+formataData(result.query[i].d_nasc)+'</td>'
                           +'<td class="text-left">'
                               +'<div class="icon-btn">'
                               +'<button data-dizimista="'+result.query[i].id_dizimista+'" class="btn btn-info devolver btn-icon bt-table" data-toggle="tooltip" data-original-title="Ficha">'
                                   +sexo
                               +'</button>'
                               +result.butao_excluir[i]
                               +'</div>'
                           +'</td>'
                           +'</tr>';*/
               }
              
              
           }
            
        });
    }); //botão para mostrar registros excluidos e não excluidos
    $(document).on('click','.addTelefone',function(){
        var linha = $(this).data('linha')+1;
        var btnAdicionar ="<button data-linha="+linha+" class='btn btn-warning addTelefone m-t-30' type='button'>Adicionar</button>";
        var field_telefone = "<label>Telefone</label><input class='form-control phone_area-code telefone' name='telefone[]'>";
        $("#meus_telefones").append("<div class='row' id='linha_"+linha+"'><div class='col-md-8 col-sm-12' >"+field_telefone+"</div>"+"<div class='col-md-2 col-sm-12'>"+btnAdicionar+"</div>");
        $(this).addClass('btn-danger');
        $(this).addClass('btn-remover');
        $(this).removeClass('btn-warning');
        $(this).removeClass('addTelefone');
        $(this).html("Remover");
    });
    $(document).on('click','.btn-remover',function(){
        var linha =  $(this).data('linha');
        $("#linha_"+linha).remove();
    });
    
    function formataData(data){
        var formattedDate = new Date(data);
        var d = formattedDate.getDate();
        var m =  formattedDate.getMonth();
        m += 1;  // JavaScript months are 0-11
        var y = formattedDate.getFullYear();
        var newData = d+"/"+m;
        return newData;
    }
    function createTextArea(name,label,rows,placehoder){
        
        var id="id_"+name;
        var input = "<textarea name='"+name+"' id='"+id+"' rows='"+rows+"' placehoder='"+placehoder+"' class='form-control'></textarea>";
        var lbl = "<label>"+label+"</label>";
        var campo={}
        campo={
            label:lbl,
            input:input,
        };
                    
        
        return campo;
    }
});


