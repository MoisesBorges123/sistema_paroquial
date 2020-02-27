$(document).ready(function(){
    
 $('#devolucoes').Tabledit({
    url:salvar_devolucao+"/"+dizimista,     
    editButton: false,
    deleteButton: false,
    hideIdentifier: true,
    inputClass:'form-control input-lg money2',
    columns: {
        identifier: [0, 'id'],
        editable: [[1, 'Ano'], [2, 'Janeiro'], [3,'Fevereiro'], [4,'Março'], [5,'Abril'], [6,'Maio'], [7,'Junho'], [8,'Julho'], [9,'Agosto'], [10,'Setembro'], [11,'Outubro'],[12,'Novembro'],[13,'Dezembro']]
    }
});
$(document).on('focus','.money2',function(){
    $('.money2').mask("#.##0,00", {reverse: true});
});
$(document).on('focus','.cep',function(){
    $('.cep').mask('00000-000');
});
$(document).on('input','.cep',function(){
    var cep = $(this).val();
    
    if(cep.length == 9){
        $.ajax({
           url:busca_cep,
           type: 'POST',
           data:{cep:cep},
           
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
           success: function(msg){
               if(msg['rua'][0].length==1){
                   
                   $('#rua').val(msg['rua']);
                   $('#cidade').val(msg['cidade']);
                   $('#bairro').val(msg['bairro']);
                   $('#estado').val(msg['nome_estado']);
               }else{
                   $('#rua').val(msg['rua'][0]);
                   $('#cidade').val(msg['cidade'][0]);
                   $('#bairro').val(msg['bairro'][0]);
                   $('#estado').val(msg['nome_estado'][0]);
                   
           }
       }
        });
        
    }
});
$(document).on('click','#atualizar_cadastro',function(){
    
    $.ajax({
       url:buscar_dizimista,
       data:{dizimista:dizimista},
       type:'POST',
       
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
       success: function(msg){
           if(msg.apartamento==null || msg.apartamento == "null"){
               var apto="";
           }else{
              var apto=msg.apartamento; 
           }
           
           Swal.fire({
          title: 'Atualizar Cadastro',
          html:
              '<form id="form_update"><div class="row">'+
            '<div class="col-sm-3 text-right m-auto">'+
                '<label class="label_alert">Nome</label>'+
            '</div>'+
            '<div class="col-sm-9 m-b-10">'+
                '<input id="nome_dizimista" name="nome" value="'+msg.nome+'" class="form-control">' +
             '</div>'+
            '<div class="col-sm-3 text-right m-auto">'+
                '<label class="label_alert">Nascido(a) em</label>'+
            '</div>'+
            '<div class="col-sm-9 m-b-10">'+
                '<input id="d_nasc" name="d_nasc" type="date" value="'+msg.d_nasc+'" class="form-control">' +
             '</div>'+
            '<div class="col-sm-3 text-right m-auto">'+
                '<label class="label_alert">CEP</label>'+
            '</div>'+
            '<div class="col-sm-9 m-b-10">'+
                '<input id="cep" name="cep" type="text" value="'+msg.cep+'" class="form-control cep">' +
             '</div>'+
            '<div class="col-sm-3 text-right m-auto">'+
                '<label class="label_alert">Rua</label>'+
            '</div>'+
            '<div class="col-sm-9 m-b-10">'+
                '<input id="rua" name="rua" type="text" value="'+msg.rua+'" class="form-control">' +
             '</div>'+
            '<div class="col-sm-3 text-right m-auto">'+
                '<label class="label_alert">Bairro</label>'+
            '</div>'+
            '<div class="col-sm-9 m-b-10">'+
                '<input id="bairro" name="bairro" type="text" value="'+msg.bairro+'" class="form-control">' +
             '</div>'+
            '<div class="col-sm-3 text-right m-auto">'+
                '<label class="label_alert">Nº</label>'+
            '</div>'+
            '<div class="col-sm-9 m-b-10">'+
                '<input id="num_casa" name="num_casa" type="text" value="'+msg.num_casa+'" class="form-control">' +
             '</div>'+
            '<div class="col-sm-3 text-right m-auto">'+
                '<label class="label_alert">Apto</label>'+
            '</div>'+
            '<div class="col-sm-9 m-b-10">'+
                '<input id="apartamento" name="apartamento" type="text" value="'+apto+'" class="form-control">' +
             '</div>'+            
            '<div class="col-sm-3 text-right m-auto">'+
                '<label class="label_alert">Cidade</label>'+
            '</div>'+
            '<div class="col-sm-9 m-b-10">'+
                '<input id="cidade" name="cidade" disabled=true type="text" value="'+msg.cidade+'" class="form-control">' +
             '</div>'+
            '<div class="col-sm-3 text-right m-auto">'+
                '<label class="label_alert">Estado</label>'+
            '</div>'+
            '<div class="col-sm-9 m-b-10">'+
                '<input id="estado" name="estado" disabled=true type="text" value="'+msg.nome_estado+'" class="form-control">' +
             '</div>'+
            '<div class="col-sm-3 text-right m-auto">'+
                '<label class="label_alert">E-mail</label>'+
            '</div>'+
            '<div class="col-sm-9 m-b-10">'+
                '<input id="email" name="email" type="email" value="'+msg.email+'" class="form-control">' +
             '</div>'+
            '<div class="col-sm-3 text-right m-auto">'+
                '<label class="label_alert">DD</label>'+
            '</div>'+
            '<div class="col-sm-9 m-b-10">'+
                '<input id="dd" type="text" name="dd" value="'+msg.dd+'" class="form-control">' +
             '</div>'+
            '<div class="col-sm-3 text-right m-auto">'+
                '<label class="label_alert">Telefone</label>'+
            '</div>'+
            '<div class="col-sm-9">'+
                '<input id="telefone" name="telefone" type="text" value="'+msg.numero+'" class="form-control">' +
                '<input  type="hidden" name="id_dizimista" value="'+dizimista+'" class="form-control">' +
                '<input  type="hidden" name="_token" value="'+token+'" class="form-control">' +
                
             '</div>'+
            '</div></form>',
            
          focusConfirm: false,
          preConfirm: () => {
            
              var nome = $('#nome_dizimista').val();              
              var num_casa=$('#num_casas').val();
              var rua=$('#rua').val();
              var cep=$('#cep').val();
              var cidade=$('#cidade').val();
              var bairro=$('#bairro').val();
              var estado=$('#estado').val();
              var dd=$('#dd').val();
              var telefone=$('#telefone').val();
              var email=$('#email').val();
              var d_nasc=$('#d_nasc').val();
              var apartamento=$('#apartamento').val();
              var token=$('#token').val();
              console.log(token)
              if(cep.length==9){
                  
                  return fetch(atualiza_dizimista,{
                      method:'POST',
                      credentials: "same-origin",
                      body: new FormData(document.getElementById('form_update'))
                     
                  }).then(response=>{
                      if(!response.ok){
                          Swal.fire({
                              position: 'top-end',
                              icon: 'error',
                              title: 'Não foi possível comunicar com o servidor',
                              showConfirmButton: false,
                              timer: 1500
                            })
                         
                      }else{
                          //antes de retornar os dados para o navegador
                                                       
                            return response.json();
                      }
                     
                      
                  })
              }else{
                  //CASO O USUÁRIO NÃO DIGITAR UM CEP VALIDO FAÇA
              }
              
          },
          allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
          if (result.value) {
                Swal.fire({
                              position: 'top-end',
                              icon: 'success',
                              title: 'Dados atualizados',
                              showConfirmButton: false,
                              timer: 2000
                            });
            if(result.value.cadastro.apartamento==null){
                apto = '';
            }else{
                apto=', apto '+result.value.cadastro.apartamento;
            }
            $('#titulo-nome').html(result.value.cadastro.nome);
            $('#titulo-nascimento').html('Nascido em '+dateToPT(result.value.cadastro.d_nasc));
            $('#titulo-endereco').html(result.value.cadastro.rua+', nº'+result.value.cadastro.num_casa+apto+', '+result.value.cadastro.bairro+', '+result.value.cadastro.cep+', '+result.value.cadastro.cidade);
          }
        })
       }
    });
    
    
    
    
});
$(document).on('click','#excluir_cadastro',function(){
    var deletar_cadastro = $(this).data('url');
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
                      setTimeout(function(){
                        window.location.href=meus_dizimistas;
                    },1600);
                  }
              });
            
          }
     
    });
});

function dateToPT(date)
{	
	return date.split('-').reverse().join('/');
}
});


