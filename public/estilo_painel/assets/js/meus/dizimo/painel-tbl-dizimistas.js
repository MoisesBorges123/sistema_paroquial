$(document).ready(function(){
   var table = $('#dizimistas').DataTable({
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
        
    });
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
    
    
    function formataData(data){
        var formattedDate = new Date(data);
        var d = formattedDate.getDate();
        var m =  formattedDate.getMonth();
        m += 1;  // JavaScript months are 0-11
        var y = formattedDate.getFullYear();
        var newData = d+"/"+m;
        return newData;
    }
});


