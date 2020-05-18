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
           success: function(data){


            if(data['logradouro'][0]){                       
                $('#id_rua').val(data['logradouro'][0]);
                $('#id_bairro').val(data['bairro'][0]);
                $('#id_cidade').val(data['cidade'][0]);
                $('#id_estado').val(data['nome_estado']);
                $('#id_estado').data('cod',data['estado']);
                
            }else if(data['logradouro']){
                $('#id_rua').val(data['logradouro']);
                $('#id_bairro').val(data['bairro']);
                $('#id_cidade').val(data['cidade']);
                $('#id_estado').val(data['nome_estado']);                       
            }
       }
        });
        
    }
});
$(document).on('click','#atualizar_cadastro', async function(){
    var id_dizimista = $(this).data('dizimista');
    var field_nome = createInput('nome','Nome','text',true);
    var field_dataNasc = createInput('d_nasc','Data de Nascimento','date',true);
    var field_email = createInput('email','E-mail','email',false);
    var field_cep = createInput('cep','CEP','text',false);
    var field_numero = createInput('numero','Nº','text',false);
    var field_rua = createInput('rua','Rua','text',false);
    var field_bairro = createInput('bairro','Bairro','text',false);
    var field_cidade = createInput('cidade','Cidade','text',false);
    var field_estado = createInput('estado','Estado','text',false);
    var field_telefone = "<label>Telefone</label><input class='form-control phone_area-code telefone' name='telefone[]'>";        
    var btn_add_telefone = "<button data-linha=1 class='btn btn-warning addTelefone m-t-30' type='button'>Adicionar</button>";   
   

    (formulario) = await  Swal.fire({
     title:'Atualizar Dados',
     html:"<div class='row'>"+
         "<div class='col-md-6 col-sm-12 m-t-20'>"+field_nome.label+field_nome.input+"</div>"+
         "<div class='col-md-6 col-sm-12 m-t-20'>"+field_dataNasc.label+field_dataNasc.input+"</div>"+
         "<div class='col-md-5 col-sm-12 m-t-20'>"+field_email.label+field_email.input+"</div>"+         
         "<div class='col-md-7 col-sm-12  m-t-20' id='meus_telefones'>"+
            "<div class='row' id='linha_1'>"+
            "<div class='col-md-8 col-sm-12'>"+field_telefone+"</div>"+
            "<div class='col-md-4 col-sm-12'>"+btn_add_telefone+"</div>"+
            "</div>"+
         "</div>"+
         "<div class='col-md-4 col-sm-12 m-t-20'>"+field_cep.label+field_cep.input+"</div>"+
         "<div class='col-md-3 col-sm-12 m-t-20'>"+field_numero.label+field_numero.input+"</div>"+
         "<div class='col-md-6 col-sm-12 m-t-20'>"+field_rua.label+field_rua.input+"</div>"+
         "<div class='col-md-6 col-sm-12 m-t-20'>"+field_bairro.label+field_bairro.input+"</div>"+
         "<div class='col-md-6 col-sm-12 m-t-20'>"+field_cidade.label+field_cidade.input+"</div>"+
         "<div class='col-md-6 col-sm-12 m-t-20'>"+field_estado.label+field_estado.input+"</div>"+
     "</div>",
     width:'700px',
     onRender: async function(){
         dados = new FormData();
         dados.append('_token',_token);
         dados.append('dizimista',id_dizimista);
         $('.swal2-title').html('Carregando dados do dizimista...');
         $('#id_nome').prop('disabled',true);
         $('#id_d_nasc').prop('disabled',true);
         $('#id_cep').prop('disabled',true);
         $('#id_email').prop('disabled',true);
         $('#id_numero').prop('disabled',true);
         $('.telefone').prop('disabled',true);
         (dadosPessoa) = await fetch(buscar_dizimista,{
             
             method:'post',
             credentials:'same-origin',
             body:dados,
             
         }).then((result)=>{
             if(!result.ok){
                 $('.swal2-title').html('Erro ao carregar os dados...');
                 return false;
             }else{
                $('.swal2-title').html('Atualizar Dados'); 
                $('#id_nome').prop('disabled',false);
                $('#id_d_nasc').prop('disabled',false);
                $('#id_cep').prop('disabled',false);
                $('#id_email').prop('disabled',false);
                $('#id_numero').prop('disabled',false);
                $('.telefone').prop('disabled',false);
                 return result.json();
             }
         });
         
         $('#id_nome').val(dadosPessoa.dados.nome);
         $('#id_d_nasc').val(dadosPessoa.dados.d_nasc);
         $('#id_cep').val(dadosPessoa.dados.cep);
         $('.cep').trigger('input');
         $('#id_email').val(dadosPessoa.dados.email);
         $('#id_numero').val(dadosPessoa.dados.num_casa);        
        $.each(dadosPessoa.telefones,function(){
            $('#meus_telefones').prepend(
                "<div class='row' id='linha_"+this.id_telefone+"'>"+
                "<div class='col-md-8 col-sm-12'>"+
                "<label>Telefone</label><input data-id_telefone='"+this.id_telefone+"' class='form-control phone_area-code telefone' value='"+this.numero+"' name='telefone[]'>"+                
                "</div>"+
                "<div class='col-md-2 col-sm-12'>"+
                "<button data-linha="+this.id_telefone+" data-id="+this.id_telefone+" class='btn btn-danger btn-remover m-t-30' type='button'>Remover</button>"+
                "</div>"+
                "</div>"
                );          
        });               
        //Carrega pessoas já cadastradas no sistema
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
         var cep = $('#id_cep').val();
         var numero = $('#id_numero').val();
         if(nome==''){
             Swal.showValidationMessage("Você deve preencher o nome campo.");
             return false;
         }else{
             if((cep!='' && numero=='') || (numero!='' && cep=='')){
                 Swal.showValidationMessage("Você deve preencher o numero da residência.");
                 return false;
             }else{
                 return true;
             }
         }
     },
     
     });

     if(formulario.value==true){
         var numeros = jQuery('input[name^="telefone"]');
         var telefones = [];
         for(var i = 0; i < numeros.length; i++){
             telefones.push($(numeros[i]).val());
            }
           
            var formDadosDizimista = new FormData();            
            formDadosDizimista.append('nome',$('#id_nome').val());
            formDadosDizimista.append('dizimista',dizimista);
            formDadosDizimista.append('d_nasc',$('#id_d_nasc').val());
            formDadosDizimista.append('cep',$('#id_cep').val());
            formDadosDizimista.append('num_casa',$('#id_numero').val());
            formDadosDizimista.append('telefone',telefones);
            formDadosDizimista.append('rua',$('#id_rua').val());
            formDadosDizimista.append('bairro',$('#id_bairro').val());
            formDadosDizimista.append('cidade',$('#id_cidade').val());
            formDadosDizimista.append('estado',$('#id_estado').data('cod'));
            formDadosDizimista.append('email',$('#id_email').val());
        
        (update) = await fetch(url_update,{
            headers:{'X-CSRF-Token':_token},
            method:'POST',
            body:formDadosDizimista,
            credentials:'same-origin',
        }).then((result)=>{
            if(!result.ok){
                return false;
            }else{
                return result.json();
            }
        });        
  
        
        if(update){
            var apartamento='';
            if(update.new_cadastro.dados.apartamento!=null){
                apartamento=update.new_cadastro.dados.apartamento;
            }
            $('#titulo-nome').html(update.new_cadastro.dados.nome);
            $('#titulo-nascimento').html("Nascido(a) em "+dateToPT(update.new_cadastro.dados.d_nasc)+" / E-mail"+update.new_cadastro.dados.email);
            $('#titulo-endereco').html(update.new_cadastro.dados.rua+
                ", nº "+update.new_cadastro.dados.num_casa+", "+
                apartamento+" "
                +update.new_cadastro.dados.bairro+", cep: "
                +update.new_cadastro.dados.cep+" "
                +update.new_cadastro.dados.cidade+", "
                +update.new_cadastro.dados.nome_estado);

            var telefones='Telefones: ';
            $.each(update.new_cadastro.telefone,function(){
                telefones=telefones+this.numero+"| ";
            });
            $('#titulo-telefone').html(telefones);
        }
     }
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
});//BOTÃO PARA ADICIONAR MAIS UM CAMPO DE TELEFONE DURANTE O CADASTRO DO DIZIMISTA
$(document).on('click','.btn-remover',function(){
    var linha =  $(this).data('linha');
    $("#linha_"+linha).remove();
});//BOTÃO PARA REMOVER MAIS UM CAMPO DE TELEFONE DURANTE O CADASTRO DO DIZIMISTA


});

$(window).on('load', function(){
    //Welcome Message (not for login page)   
    notify('Ficha de '+$('#titulo-nome').html(), 'inverse');  
    verifcarDados();
    //Verificar se os dados do dizimista estão corretos
    async function verifcarDados(){
        (verificacao) = await fetch(verificar_dados,{
            method:'GET',
            credentials:'same-origin',
        }).then((result)=>{
            if(result.ok){
                return result.json();
            }else{
                return false;
            }
        });
        if(verificacao!=false && verificacao.mensagem!=null && verificacao.status!=null){
            notify(verificacao.mensagem, verificacao.status,10000);  
        }
    }
});

