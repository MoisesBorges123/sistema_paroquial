
$(document).on('click','#print',function(){
    $('.check-print').prop('checked',$('#print_all').prop('checked'));
});
$(document).on('click','#btn-sair',function(){
  $('#id_mes').val(1);
});
$(document).on('click','#btn-carta-devolvida',async function(){
    cod_carta = createInput('codigo','Código','text',true);
    (form) = await swal.fire({
        title:'Carta Devolvida',
        html:cod_carta.label+cod_carta.input,
        showCancelButton:true,
        confirmButtonText:'Enviar <i class="icofont icofont-send-mail"></i>',
        preConfirm:()=>{
            if($('#id_codigo').val()==''|| $('#id_codigo').val()==null){
                return false;
            }else{

                return true;
            }
        }
    })
    if(form.value==true){        
        data = new FormData();
        data.append('cod_carta',$('#id_codigo').val());
        (reportar) = await fetch(url_devolver_carta,{
            method:'POST',
            headers:{
                'X-CSRF-TOKEN':_token
            },
            credentials:'same-origin',
            body:data
        }).then((result)=>{
            if(result.ok){
                return result.json();
            }else{
                return false;
            }
        })
        if(reportar.update_carta==false){
            notify('Não foi possível registrar essa devolução, tente novamente.', 'danger', 4000,'top');
        }else {
            notify('Devolução registrada!', 'success', 3000,'top');            
        }
    }
});
$(window).on('load',function(){
    $('#loader').hide();
    //montarTable();
});


function imprimir(){




    var registro = document.getElementsByName('registro');
    var ids=[];
    for (var i = 0; i < registro.length; i++){
        if ( registro[i].checked ) {            
            ids.push(registro[i].value);
        }
    }
    var formData = new FormData();
    formData.append('ids',ids);
    fetch(url_gerarPdf,{
            headers:{
                'X-CSRF-TOKEN':_token
            },
            method:'POST',
            body:formData,
            credentials:'same-origin'
        }).then((result)=>{
            if(result.ok){
                console.log(result.json());
            }
        });

}
function select_element(){
    var options='';
    var meses = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
    for(var i=1; i<=12;i++ ){
        options=options+"<option value='"+i+"'>"+meses[i-1]+"</option>";        
    }
    var select = "<select id='id_mes' name='mes' class='form-control'>"+options+"</select>";
    return select;
}
async function cartasDevolvidas(){
    
}
/*
function montarTable(){  
    $('#loader').show();  
    fetch(url_busca_table,{
        headers:{
            'X-CSRF-Token':_token
        },
        method:'post',
        credentials:'same-origin',
}).then((result)=>{
        if(!result.ok){
            return{"busca":false}
        }else{
            console.log('carregou');
            return result.json();
        }
       
    }).then((resposta)=>{                
        var linhasTBL = ""; 
        dados = resposta.dados;  
    for(var i=0;i<resposta.total_registros;i++){         
              
        
        linhasTBL = linhasTBL+
        "<tr>"+        
            "<td>"+dados[i].nome+"</td>"+
            "<td>"+dados[i].mes_aniversario+"</td>"+                
            "<td>"+dados[i].d_nasc+"</td>"+                                            
        "</tr>";      
     
    } 
    $('#minha_tabela').DataTable().destroy();
    $('#body_tbl_Dizimistas').html(null);
    $('#minha_tabela').find('tbody').append(linhasTBL);
    $('#minha_tabela').DataTable({
        "order": [[ 2, "asc" ]],
        "scrollCollapse": true,
        "paging": true,
        "searching": true,
        "ordering":true,
        "info":true,
        "language": {
            "decimal": ",",
            "lengthMenu":     "Mostrar _MENU_ registros",
            "thousands": ".",
            "search":         "Buscar:",
            "emptyTable":     "Nenhum registro cadastrado.",
            "info":           "Mostrando _START_ de _END_ de _TOTAL_ registros",
            "infoEmpty":      "Mostrando 0 de 0 registros",
            paginate: {
                first:    '«',
                previous: '‹',
                next:     '›',
                last:     '»'
            }
        },
    });
    $('#loader').hide();
    
    
    
   
    
    });
    
      
} */