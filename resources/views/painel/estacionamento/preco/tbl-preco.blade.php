@extends('painel.template.Painel-Master')

@section('conteudo')
<div class="row">   
    <div class="col-md-6 col-sm-12">
        <div class="card badge-inverse-info">
            <div class="card-header">
                <h4>Preços Carros</h4>              

            </div>
            <div class="card-body">
                <div  class="dt-responsive table-responsive">
                    
                    <div id='tbl_carros'>


                    </div>                    
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="card badge-inverse-info">
            <div class="card-header">
                <h4>Preços Motos</h4>              

            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <div id='tbl_motos'>
                       
                    
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
<style>
    .pcoded-inner-content{
        background-image: url('{{asset("imagens/carro_template.png")}}') !important;
        background-repeat: no-repeat;
        background-size: 100% 100%;
        background-attachment: inherit;
    }

</style>
@endsection

@section('javascript')
<!-- data-table js -->
<script src="{{asset('estilo_painel/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('estilo_painel/assets/pages/data-table/js/jszip.min.js')}}"></script>
<script src="{{asset('estilo_painel/assets/pages/data-table/js/pdfmake.min.js')}}"></script>
<script src="{{asset('estilo_painel/assets/pages/data-table/js/vfs_fonts.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<!-- Custom js -->
<script src="{{asset('estilo_painel/assets/pages/data-table/js/data-table-custom.js')}}"></script>
<script>
    url_loadTable="{{route('Preco.Carrega_BasedePrecos')}}";
    $(document).ready(function () {
        loadTable(url_loadTable);
     
    });
    $(document).on('click','.btn-editar',function(){
        var url_update = $(this).data('url');
        var valor = $(this).data('value');
        var id = $(this).data('id');
        var input=createInput('preco','Preço','text',true);
        var token=createInput('_token','token','hidden',true);
        var cod=createInput('cod','cod','hidden',true);
        Swal.fire({
            title:'Atualizar Preço',
            html:"<form id='form-update' class='form'>"+
                input.label+input.input+token.input+cod.input+
                "</form>",

            onRender:function(){
                $('#id_preco').val(valor);
            },
            preConfirm:()=>{
                if($('#id_preco').val() == null){
                    Swal.showValidationMessage("Você não inseriu nenhum valor.");
                    return false;                    
                }else{
                    
                    $('#id__token').val(_token);
                    $('#id_cod').val(id);                   
                    return true;
                }
            }
        }).then((result)=>{
            return fetch(url_update,{
                credentials: "same-origin",
                method:'POST',
                body: new FormData(document.getElementById('form-update'))
            })
        }).then((resultado)=>{
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
            if(resposta.authorization=='negada'){
                Swal.fire({
                          position: 'top-end',
                          icon: 'waning',
                          title:'Ops!',
                          html: 'Esse dispositivo não tem autorização para realizar essa ação.',
                          showConfirmButton: true,                          
                        });
            }else if(resposta.authorization =='permitida' && resposta.update){
                Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          title: 'Dados Atualizados!',
                          showConfirmButton: false,   
                          timer: 1500                       
                        });
                        
            }
            loadTable(url_loadTable);
            
        });
    });

    function loadTable(url){ 
        $.ajax({
           url: url,
            type:'GET',
            dataType:'JSON',
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
                $('#tbl_motos').html(data.tabela_motos);
                $('#tbl_carros').html(data.tabela_carros);
                console.log(data);
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
</script>
@endsection