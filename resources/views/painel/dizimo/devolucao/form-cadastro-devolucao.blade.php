<?php
$tituloPagina="Devolver Dízimo";
$page_header="Ficha do dizimista";
$descricao_page_header='';
?>
@extends('painel.template.Painel-Master')

@section('conteudo')
<div class="row">
    <!--INICIO MOSTRA ERROS -->
    <div class="col-sm-12">
        @if(isset($errors) && count($errors)>0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $erro)
            <p>{{$erro}}</p>
            @endforeach
        </div>
        @endif
        @if(isset($errors) && count($errors)>0)
        <div class="alert alert-danger">                
            <p>{{session('erro')}}</p>            
        </div>
        @endif
    </div>
    <!--FIM MOSTRA ERROS -->           


    

    <!-- Edit With Click card start -->
    <div class="card">
        <div class="card-header">
            <h3>{{$dados['dizimista']['nome']}}</h3>
            <div class='row'>
                <div class="col-md-12">
                    <span>Nascido em {{date('d/m/Y',strtotime($dados['dizimista']['data_nascimento']))}}</span>
                </div>
                <div class="col-md-12">
                    <span>Dízimista desde {{date('d/m/Y',strtotime($dados['dizimista']['data_cadastro']))}}</span>
                </div>
                <div class="col-md-12">
                    <span>{{$dados['dizimista']['rua']}}, {{$dados['dizimista']['numero']}}, {{$dados['dizimista']['apartamento']}} {{$dados['dizimista']['bairro']}}, cep: {{$dados['dizimista']['cep']}} {{$dados['dizimista']['cidade']}}, {{$dados['dizimista']['estado']}}</span>                    
                </div>
            </div>

        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="devolucoes">
                    <thead style="font-size: 14px;">
                        <tr>
                            <th>Código</th>
                            <th>Ano</th>
                            <th>Janeiro</th>
                            <th>Fevereiro</th>
                            <th>Março</th>
                            <th>Abril</th>
                            <th>Maio</th>
                            <th>Junho</th>
                            <th>Julho</th>
                            <th>Agosto</th>
                            <th>Setembro</th>
                            <th>Outubro</th>
                            <th>Novembro</th>
                            <th>Dezembro</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 12px;">
                        @foreach($dados['devolucoes'] as $anos)
                        <tr>
                            
                            @foreach($anos as $mes)
                            <td class="tabledit-view-mode"><span class="tabledit-span">{{$mes}}</span>
                                <input class="tabledit-input form-control input-sm money" type="text" name="{{$mes}}" value="{{trim($mes)}}">
                                
                            </td>
                            @endforeach
                        <tr>
                        @endforeach                    
                        
                    </tbody>
                </table>
            </div>
            <button type="button" class="btn btn-primary waves-effect waves-light add" onclick="add_row();">Add Row
            </button>
        </div>
    <!--Edit With Click card end -->
    



</div>
@endsection
@section('css')
<!--forms-wizard css-->
<link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/jquery.steps/css/jquery.steps.css')}}">
<link href="{{asset('estilo_painel/bower_components/sweetalert/css/sweetalert.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('estilo_painel/bower_components/jquery-sweetalert2/css/sweetalert2.css')}}" rel="stylesheet" type="text/css"/>

<style>
    #bem_vindo{
        width: 83%;
    }
    .error{
        background: antiquewhite;
    }
    .negrito{
        font-weight: 800;
        color:#000000;
    }
</style>
@endsection
@section('javascript')
<!-- i18next.min.js -->
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next/js/i18next.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/jquery-i18next/js/jquery-i18next.min.js')}}"></script>

<!--Forms - Wizard js-->
<script src="{{asset('estilo_painel/bower_components/jquery.cookie/js/jquery.cookie.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/jquery.steps/js/jquery.steps.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/jquery-validation/js/jquery.validate.js')}}"></script>
<!-- Validation js -->
<script src="{{asset('estilo_painel/assets/js/form-wizard/underscore-min.js')}}"></script>
<script src="{{asset('estilo_painel/assets/js/form-wizard/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/assets/pages/form-validation/validate.js')}}"></script>
<!-- Editable-table js -->
<script type="text/javascript" src="{{asset('estilo_painel/assets/pages/edit-table/jquery.tabledit.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/assets/pages/edit-table/editable.js')}}"></script>
<!-- Custom js -->
<script type="text/javascript">
                                                    $(document).ready(function () {
                                                        busca_cep = "{{route('BuscaCep.Dizimista')}}";
                                                        nome_duplicidade = "{{route('Duplicidade.Dizimista')}}";
                                                        ser_dizimista = "{{route('SerDizimista.Dizimista')}}";
                                                        salvar_outros_dados = "{{route('SerDizimista2.Dizimista')}}";
                                                        meus_dizimistas = "{{route('Visualizar.Dizimista')}}";
                                                        token = "{{ csrf_token() }}";
                                                        woli = "{{asset('imagens/woli.png')}}";
                                                    });
</script>
<script src="{{asset('estilo_painel/assets/pages/forms-wizard-validation/form-wizard.js')}}"></script>
<script src="{{asset('estilo_painel/assets/js/meus/dizimo/painel-tbl-dizimistas.js')}}"></script>
@endsection