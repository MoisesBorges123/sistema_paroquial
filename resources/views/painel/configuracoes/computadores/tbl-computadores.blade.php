
@extends('painel.template.Painel-Master')

@section('conteudo')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 m-b-20">
        <div class="row">
            <div class="col-md-4">
                <button id="btn-add" class="btn btn-primary">Novo</button>
            </div>            

        </div>
    </div>
    @if(!empty($query))
    <div class="col-sm-12">

        <div class="card">
            
            <div class="card-block table-border-style">
                <div class="dt-responsive table-responsive" id="div_table">
                    <table id="carros_estacionados" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                
                                <th>IP</th>
                                <th>Dispositivo</th>
                                <th>Sistema Operacional</th>
                                <th>MAC</th>
                                <th>Tipo</th>
                                <th>Marca</th>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($query as $q)
                            <tr>
                                
                                <td>{{$q->ip}}</td>
                                <td>{{$q->nome}}</td>
                                <td>{{$q->sistema_operacional}}</td>
                                <td>{{$q->mac}}</td>
                                <td>{{$q->tipo}}</td>
                                <td>{{$q->marca}}</td>
                                <td>{{$q->descricao}}</td>
                                <td>
                                    <div class="icon-btn">
                                         <button data-id="{{$q->id_computador}}" class='btn btn-info btn-editar'><i class='icofont icofont-pencil-alt-5'></i></button>
                                         <button data-id="{{$q->id_computador}}" class='btn btn-danger btn-excluir'><i class='icofont icofont-trash'></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
    @else
    <div class='col-md-12 com-sm-12' id='alerta'>
        <div class='alert'>
            <div class='alert-dafault'>
                <h5>Não há nenhum dispositovo cadastrado</h5>
            </div>
        </div>        
    </div>
    @endif
</div>
@endsection

@section('javascript')

<script>
    url_carregaTbl = "{{route('LoadTable.Dispositivos')}}";
    url_salva_dadosCadastrais = "{{route('SalvarDados.Dispositivos')}}";
    $(document).ready(function(){
        //Inicializa a Tabela
        loadTable();
        
        //Inicioalia a validaçao do formulario
        formValidate();
        
    });
    $(document).on('click','#btn-add',function(){
        var campo_ip = createInput('ip','*IP','text',true);
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
            html:"<form id='form_dispositivo' class='form-control'>"+
                    campo_nome.label+campo_nome.input+"<br>"+
                    campo_senha.label+campo_senha.input+"<br>"+
                    campo_SO.label+campo_SO.input+"<br>"+
                    campo_marca.label+campo_marca.input+"<br>"+
                    campo_ip.label+campo_ip.input+"<br>"+
                    campo_mac.label+campo_mac.input+
                    "</form",
            //showLoaderOnConfirm: true,
           // allowOutsideClick: () => !Swal.isLoading(),
            
            preConfirm:()=>{    
               if($('#id_ip').val()=="" || $('#id_nome').val()==''){
                    Swal.showValidationMessage("É obrigatório preencher todos os campos que possuam '*'");
                  return false;                   
               }else{
                   return true;
               }
              
            },
            
            
        }).then((result)=>{ //Salvar dados no banco de dados
              fetch(url_salva_dadosCadastrais,
              {
                credentials: "same-origin",
                method:'POST',
                body: new FormData(document.getElementById('form_dispositivo'))
              }) 
        });
    });
    $(document).on('click','#btn-editar',function(){
        var campo_ip = createInput('ip','*IP','text',true);
        var campo_nome = createInput('nome','*Nome','text',true);
        var campo_senha = createInput('senha','Senha','text',false);
        var campo_mac = createInput('mac','MAC','text',false);
        var campo_SO = createInput('so','Sistema Operacioal','text',false);
        var campo_marca = createInput('marca','Marca do Dispositivo','text',false);
         Swal.fire({
            title:woli_titulo,
            allowOutsideClick:false,
            allowEscapeKey:false,
            allowEnterKey:false,
            html:"<form id='form_dispositivo' class='form-control'>"+
                    campo_nome.label+campo_nome.input+"<br>"+
                    campo_senha.label+campo_senha.input+"<br>"+
                    campo_SO.label+campo_SO.input+"<br>"+
                    campo_marca.label+campo_marca.input+"<br>"+
                    campo_ip.label+campo_ip.input+"<br>"+
                    campo_mac.label+campo_mac.input+
                    "</form",
            showLoaderOnConfirm: true,
            allowOutsideClick: () => !Swal.isLoading(),
            
            preConfirm:()=>{
                
              
              return false;
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
                    console.log('entrou');
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
    </script>
@endsection