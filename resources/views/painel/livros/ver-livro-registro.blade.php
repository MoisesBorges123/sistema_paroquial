
@extends('painel.template.Painel-Master')

@section('conteudo')
<!--BODY PAGE -->


<div class="page-body">
    <!-- Basic table card start -->


    @if(empty($query)&& empty($dados) && empty($adicionaFolha))
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
            @if(session('sucesso'))
                <div class="bd-example bd-example-modal" >
                    <div class="modal" style='background:none'>
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-success">
                                    <h5 class="modal-title">{{session("header_sucesso")}}</h5>
                                   
                                </div>
                                <div class="modal-body">
                                    {!!session('sucesso')!!}
                                </div>
                                <div class="modal-footer">
                                    <a href="{{route('FormCadastro2.Folha',['livro' =>session('livro'),'sacramento'=> session('sacramento')])}}" class="btn btn-secondary mobtn" data-dismiss="modal">Cadastrar Outra Folha</button>
                                    <a href="{{route('FormCadastro3.Folha',['folha'=>session('id_folha'),'sacramento'=>session('sacramento')])}}" class="btn btn-primary mobtn">Adicionar Mais Fotos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @if(!empty($dados))
                        <form method="POST"  action="{{route("SalvarDigitalizacao.Folha")}}" id="form-folha-liro" enctype="multipart/form-data">
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
                          
                            <div class="row">
                                <div class="col-md-10 col-sm-10" style="margin:auto">
                                    <div class="card">          
                                        <div class="card-header text-center bg-inverse m-b-20">
                                            <h4 class='text-white' id="titulo">1-Insira os dados da nova folha.</h4>
                                        </div>
                                        <div class="card-block">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12" id="step1"></div>
                                                <div class="col-md-12 col-sm-12 resultado1" >
                                                    <label>Numeração da Página</label>
                                                    <input type="text"  name="numeracao_pagina" id="numeracao_pagina" required="">
                                                    <input type='hidden' name='livro' class='form-control' value="{{$dados['livro']}}" id='livro'>
                                                    <input type='hidden' name='sacramento' class='form-control' value="{{$dados['sacramento']}}" id='sacrameno'>
                                                </div>
                                                <div class='col-md-12 resultado1'>
                                                    <label>Observações</label>
                                                    <textarea class='form-control' id='observacoes'  name='obs_folha' rows='10' placeholder='Insira aqui alguma observação referente a página digitalizada, se existe algum erro, ou se está rasgada ou não está integra etc...'></textarea>
                                                </div>

                                            </div>               
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="passo1 col-md-6 col-sm-6">
                                                    <button class='btn btn-default sair' type='button' >Cancelar</button>
                                                </div>
                                                <div class="passo1 col-md-6 col-sm-6 text-right">
                                                    <button class="btn btn-inverse" id="btn-step2" type="button">Avançar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>               
                                </div>
                            </div>
                        </form>
                @elseif(!empty($adicionaFolha))
                <div class='card'>
                    <div class="card-header text-center bg-inverse">
                        <h4 class='text-white' id="titulo">3-Enviar foto da folha...</h4>
                    </div>
                    <div class='card-block'>
                        <form method="POST"  action="{{route("Salvarfoto.Folha")}}" id="form-folha-liro" enctype="multipart/form-data">
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
                            <input type="hidden" name="folha" value="{{$adicionaFolha['id_folha']}}">
                            <input type="hidden" name="livro" value="{{$adicionaFolha['livro']}}">
                            <input type='hidden' name='sacramento' class='form-control' value="{{$adicionaFolha['sacramento']}}" id='sacrameno'>
                            {!!$adicionaFolha['dados_html']!!}
                     </form>
                    </div>
                    <div class='card-footer'>
                        <div class='row'>
                            <div class='col-md-6'>
                                <button class='btn btn-default sair' type="button">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
                     
                @else
                        <div class="row">
                            <div class="col-md-1 col-sm-1"></div>
                            <div class="col-md-10 col-sm-12">
                                <div class="card" >
                                    <div class="card-header text-center bg-inverse">
                                        <h4 class='text-white' id="titulo">1-Selecione o sacramento referente aos registros do livro</h4>
                                    </div>
                                    <div class="progress progress-xs fade" id="progressbox">
                                        <div class="progress-bar progress-bar-danger" id="progressbar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="card-block"> 



                                        <form method="POST"  action="{{route("SalvarDigitalizacao.Folha")}}" id="form-folha-liro" enctype="multipart/form-data">
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
                                            @if(session('success'))
                                            <div class="alert alert-success">                                    
                                                <p>{!!session('success')!!}</p>                                    
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
                                    <div class="card-footer">
                                        <div class="row" id="botoes">
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-default sair" >Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif
            @endif
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

        height: 550px;
        background-color: #e8e8e1;
        width: 60%;
        margin: auto;
        font-size: 50px;
        padding: 15%;
        color:#999999;
        text-align: center;
    }
    #mostra-foto:hover{
        color:#ff0033;
        cursor: pointer;
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
<!-- jquery funções AJAX -->
<script src="{{asset('estilo_painel/assets/js/jquery.form.js')}}"></script>
<script src="{{asset('estilo_painel/assets/js/meus/painel-digitalizacao-folha-ajax.js')}}"></script>



<script type="text/javascript">
$(document).ready(function () {
    $('.passo2').hide();
    $(document).on('click', '#sair', function () {
        window.location.href = "{{route('dashboard')}}";
    });
    $(document).on('change', '#sacramento', function () {
        $('.alert').remove();
    });
    $(document).on('click', '#btn-avanca-passo2', function () {
        $('.passo1').addClass("fade");
        $('.passo1').hide();
        $('.passo2').show();
        $('.passo2').removeClass('fade');
        $('#titulo').html('2-Enviar foto da folha...');
    });
});


/*
 * Código JAVASCRIPT para trabalhar com progressbar mas não deu ceto
 * Talvez um dia dê certo
 * 
 const uploadForm = document.getElementById("uploadForm");
 const inpFile = document.getElementById("inpFile");
 const progressBarFill = document.querySelector("#progressBar > .progress-bar-fill");
 const progressBarText = progressBarFill.querySelector(".progress-bar-text");
 uploadForm.addEventListener("submit",uploadFile);
 
 function uploadFile(e){
 e.preventDefault();
 const xhr = new XMLHttpRequest();
 xhr.open("POST","http://127.0.0.1:8000/painel/livros/ajax3/salvar/livroDigital/novaFolha");
 xhr.upload.addEventListener("progress",e => {
 progressBarFill.style.width=percent.toFixed(2)
 progressBarText.textContent=percent.toFixed(2)
 });
 xhr.setRequestHeader("Content-Type","multipart/form-data");
 xhr.send(new FomrData(uploadForm));
 }
 */
</script>
@endsection