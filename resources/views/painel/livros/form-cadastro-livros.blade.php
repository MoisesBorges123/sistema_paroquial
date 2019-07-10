
@extends('painel.template.Painel-Master')

@section('conteudo')
<!--BODY PAGE -->


<div class="page-body">
    <!-- Basic table card start -->

    <div class="row">
        <div class="col-md-1 col-sm-1"></div>
        <div class="col-md-10 col-sm-12">


            <div class="card m-t-20">
                <form method="POST" action="{{route("SalvarLivroDigital.Folha")}}">
                    {!! csrf_field() !!}
                    <div class="card">
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
                        <div class="card-header text-center bg-inverse"><h4>Dados do Livro</h4></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <label>*Numeração</label>
                                    <input class="form-control" value="{{old('numeracao')}}" name="numeracao" placeholder="Numero do Livro Ex.: 1" type="number" required="">
                                </div>
                                <div class="col-md-5 col-sm-12">
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
                                <div class="col-md-3 col-sm-12">
                                    <label>Quant. de Páginas</label>
                                    <input class="form-control" type="number" value="{{old('qtde_paginas')}}" name="qtde_paginas" >
                                </div>
                            </div>
                        </div>
                        <div class="card-header text-center bg-inverse"><h4>Periodo do Livro</h4></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 col-sm-12"></div>
                                <div class="col-md-4 col-sm-12">
                                    <label>*Inicia em</label>
                                    <input class="form-control" name="data_inicio" value="{{old('data_inicio')}}" placeholder="__/__/____" type="date" required="">
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label>*Finaliza em</label>
                                    <input class="form-control" value="{{old('data_fim')}}" name="data_fim" placeholder="__/__/____" type="date" required="">
                                </div>
                            </div>                    
                        </div>
                        <div class="card-header text-center bg-inverse"><h4>Informações Adicionais</h4></div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12 col-sm-12">
                                    <label>Observações</label>
                                    <textarea class="form-control" name="descricao" rows="10" placeholder="Mais Informações do livro, quanto ao estado de conservação, de qual região que é os seus registros etc...">{{old('descricao')}}</textarea>
                                </div>
                            </div>                    
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6 col-sm-3 text-left">
                                    <button class="btn btn-default" type="button" id="btn-cancelar">Cancelar</button>                                            
                                </div>
                                <div class="col-md-6 col-sm-3 text-right">
                                    <button class="btn btn-inverse" type="submit" id="btn-cadastrar">Cadastrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div> 
    </div>



    <!-- BODY PAGE -->
    @endsection

    @section('css')    

    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/icon/themify-icons/themify-icons.css')}}">
    <style>
        .listaLivros{
            width: 100px;
            height: auto;
            border:none;
        }
    </style>
    @endsection

    @section('javascript')  


    <script type="text/javascript">
    $(document).ready(function () {

            @if (!empty(session('livro')))
                $('#livro').val({{session('livro')}});
            @endif
       

       



                
    });
    </script>
    @endsection