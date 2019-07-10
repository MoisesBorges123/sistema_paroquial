
@extends('painel.template.Painel-Master')

@section('conteudo')
<!--BODY PAGE -->


<div class="page-body">
    <!-- Basic table card start -->
    <div class="card">
        <div class="card-header">

            <a class="btn btn-info" href="{{route("FormCadastro.tipolivro")}}" >Nova Categoria</a>
        </div>
        @if(!empty($dados))
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="example-2">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Categoria</th>                            
                            <th class="tabledit-toolbar-column">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dados as $dado)
                        
                        <tr>
                            <th scope="row">{{$dado['id_tipos_livros_reg']}}</th>
                            <td class="tabledit-view-mode"><span class="tabledit-span">{{$dado['nome']}}

                                </span><input class="tabledit-input form-control input-sm" type="text" name="nome" value="{{$dado['nome']}}" style="display: none;" disabled=""></td>
                            
                            <td style="white-space: nowrap; width: 1%;">
                                <div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                                    <div class="btn-group btn-group-sm" style="float: none;">
                                        <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" style="float: none;margin: 5px;"><span class="icofont icofont-ui-edit"></span></button>
                                        <button type="button" class="tabledit-delete-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;"><span class="icofont icofont-ui-delete"></span></button></div>
                                    
                                </div></td></tr>
                       
                     @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
     
    </div>

</div>

<!-- BODY PAGE -->
@endsection


@section('javascript')
    <!-- i18next.min.js -->
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next/js/i18next.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/jquery-i18next/js/jquery-i18next.min.js')}}"></script>
    <script src="{{asset('estilo_painel/assets/js/pcoded.min.js')}}"></script>
   <!-- <script src="{{asset('estilo_painel/assets/js/vartical-layout.min.js')}}"></script> -->
    <script src="{{asset('estilo_painel/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>

 <!-- Editable-table js -->
    <script type="text/javascript" src="{{asset('estilo_painel/assets/pages/edit-table/jquery.tabledit.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/assets/pages/edit-table/editable.js')}}"></script>
<!-- Custom js -->
    <script type="text/javascript" src="{{asset('estilo_painel/assets/js/script.js')}}"></script>
@endsection