
@extends('painel.template.Painel-Master')

@section('conteudo')
<!--BODY PAGE -->


<div class="page-body">
    <!-- Basic table card start -->


    @if(empty($query))
    <div class="card">
        <div class="card-block">
            <div class="row">

                <div class="col-lg-6 col-sm-12">
                    <div class="alert alert-warning">
                        <h5>Não existe nenhum livro cadastrado no sitema</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else

    <div class="row">
        <div class="col-md-1 col-sm-1"></div>
        <div class="col-md-10 col-sm-12">
                <div class="card" >
                    <div class="card-header text-center bg-inverse"><h4 class='text-white' id="titulo">1-Selecione o sacramento referente aos registros do livro</h4></div>
                <div class="card-block">  
                    <form method="POST" action="{{route("SalvarLivroDigital.Folha")}}">
                            {!! csrf_field() !!}
                       
                               @if(isset($errors) && count($errors)>0)
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $erro)
                                    <p>{{$erro}}</p>
                                    @endforeach
                                </div>
                                @endif
                                @if(session('erro'))
                                <div class="alert alert-danger">                                    
                                    <p>{!!session('erro')!!}</p>                                    
                                </div>
                                @endif
                <div  class="row m-t-20">
                     <div class="col-md-5 col-sm-12" id="step1">
                        <label>*Livro de:</label>
                        <select value="1" class="form-control" name="sacramento" id="sacramento" required="">
                            <option value="">Selecione um sacramento</option>
                            @foreach($query2->all() as $dado2)
                            @if(old('sacramento')==$dado2->id_sacramento)                                            
                            <option value="{{$dado2->id_sacramento}}" selected="true">{{$dado2->nome}}</option>
                            @else
                            <option value="{{$dado2->id_sacramento}}">{{$dado2->nome}}</option>
                            @endif
                            @endforeach                        
                        </select>
                    </div>
                    </div>
                              
                    </form>                    
               
            </div>
        </div>
 </div>
</div>
        @endif
   
</div>


    <!-- BODY PAGE -->
    @endsection

    @section('css')
    <!-- jquery file upload Frame work 
    <link href="{{asset('estilo_painel/assets/pages/jquery.filer/css/jquery.filer.css')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('estilo_painel/assets/pages/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css')}}" type="text/css" rel="stylesheet">
    -->
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/icon/themify-icons/themify-icons.css')}}">
    <style>
.listaLivros{
    width: 100px;
    height: auto;
    border:none;
}
#mostra-foto{  

    height: 400px;
    background-color: #e8e8e1;
    width: 80%;
    margin: auto;
}
.icon-btn{
   text-align: center;
}
.btn{
    margin-left: 8px;
}
    </style>
    @endsection

    @section('javascript')
   <!-- jquery file upload js -->
    <script src="{{asset('estilo_painel/assets/pages/jquery.filer/js/jquery.filer.min.js')}}"></script>
    <script src="{{asset('estilo_painel/assets/pages/filer/custom-filer.js')}}" type="text/javascript"></script>
    <script src="{{asset('estilo_painel/assets/pages/filer/jquery.fileuploads.init.js')}}" type="text/javascript"></script>

    
    <script type="text/javascript">
$(document).ready(function () {

     var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token
            }
        });
        $(document).on('change','#sacramento',function(){
            var sacramento  = $('#sacramento').val();
            
             $.ajax({
                url: "{{route('BuscaLivroDititalizacao.Folha')}}",
                type: 'POST',
                data: {
                    sacramento:sacramento,
                },
                dataType: 'JSON',
                beforeSend: function () {
                    $('.carregando').remove();
                    $('.resultado1').remove();
                    $('#step1').after(
                    "<div class='text-left col-md-12 col-sm-12 carregando'>"+
                        "<div class=\"preloader3 loader-block\">"+
                                "<div class=\"circ1\"></div>"+
                                "<div class=\"circ2\"></div>"+
                                "<div class=\"circ3\"></div>"+
                                "<div class=\"circ4\"></div>"+
                        "</div>"+
                    "</div>"
                    );
                },
                success: function(data){
                    $('.carregando').remove();
                    $('#step1').after(data.resultadoHTML);
                    $('#titulo').html("2-Insira os dados da nova folha.");
                    
                }
            });
            
            $(document).on('click','#btn-step2',function(){
                var livro = $("#livro").val();
                var numeracao_pagina = $("input[type=number][name=numeracao_pagina]").val();
                var obs_folha = $("#observacoes").val();
                $.ajax({
                    url: "{{route('VerificaStep1.Folha')}}",
                    type: 'POST',
                    data: {
                        livro:livro,numeracao_pagina:numeracao_pagina,obs_folha:obs_folha
                    },
                    dataType: 'JSON',
                    beforeSend: function () {
                        $('.carregando').remove();
                        $('.resultado2').remove();
                        $('#step1').after(
                        "<div class='text-left col-md-12 col-sm-12 carregando'>"+
                            "<div class=\"preloader3 loader-block\">"+
                                    "<div class=\"circ1\"></div>"+
                                    "<div class=\"circ2\"></div>"+
                                    "<div class=\"circ3\"></div>"+
                                    "<div class=\"circ4\"></div>"+
                            "</div>"+
                        "</div>"
                        );
                    },
                    success: function(data){
                        $('.carregando').remove();
                        $('.resultado2').remove();
                        if(data.resposta==1){
                            $('.resultado1').addClass('fade');
                            $("#step1").addClass('fade');
                            $('#titulo').html("3-Enviar foto da folha...");
                            $('#step1').before(data.html);                            
                        }else{                            
                            $('#step1').before(data.html);                            
                        }
                        
                    }
                });
            });
        });
        
        


});
    </script>
    @endsection