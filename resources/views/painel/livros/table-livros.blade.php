
@extends('painel.template.Painel-Master')

@section('conteudo')
<!--BODY PAGE -->


<div class="page-body">
    <!-- Basic table card start -->
    <div class="card">
        <div class="card-header">

            <a class="btn btn-info" href="{{route("FormCadastro.Livro")}}" >Novo Livro</a>
        </div>
        @if(!empty($dados->all()) && count($dados->all())>0)            
            <div class="card-block">
                <div class="row">
                    @foreach($dados->all() as $dado)
                    <div class="col-md-2 col-sm-12">
                        <div class="thumbnail">
                            <div class="thumb">
                                <a href="{{asset('estilo_painel/assets/images/gallery-grid/1.png')}}" data-lightbox="1" data-title="My caption 1">
                                    <figure class="text-center">
                                        <img src="{{asset('estilo_painel/assets/images/sistema/agenda.png')}}" alt="" class="listaLivros img-fluid img-thumbnail">
                                        <figcaption  class="listaLivros"><b>{{$dado->livro}}</b></figcaption>
                                        <small >{{$dado->categoria}}</small>
                                    </figure>                                    
                                </a>
                                <a href="{{route('FormCadastro.Folha',$dado->id_livros_registros)}}"><button class="btn btn-warning btn-icon"><span class="ion-plus-round"></span></button></a>
                                <a href="{{route('Visualizar.Folha',$dado->id_livros_registros)}}"><button class="btn btn-inverse btn-icon"><span class="icofont icofont-eye-alt"></span></button></a>
                                <button   class="btn btn-danger btn-icon alert-confirm"  ><span class="ion-trash-b"></span></button>
                               
                                
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>  
        <div class="md-overlay"></div>
         <div id="styleSelector"></div>
        @else
        <div class="card-block">
            <div class="row">
                  
                <div class="col-lg-6 col-sm-12">
                    <div class="alert alert-warning">
                        <h5>Não existe nenhum livro cadastrado no sitema</h5>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

</div>

<!-- BODY PAGE -->
@endsection

@section('css')
    <!-- sweet alert framework -->
    <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/sweetalert/css/sweetalert.css')}}">
    
    <!-- lightbox Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/lightbox2/css/lightbox.min.css')}}">
    
    <style>
        .listaLivros{
            width: 100px;
            height: auto;
            border:none;
            margin: auto;
        }
    </style>
    
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
        <!-- sweet alert js -->
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/sweetalert/js/sweetalert.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/assets/js/modal.js')}}"></script>
    <!-- sweet alert modal.js intialize js -->
    
    <!-- modalEffects js nifty modal window effects -->    
    <script type="text/javascript" src="{{asset('estilo_painel/assets/js/modalEffects.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/assets/js/classie.js')}}"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="{{asset('estilo_painel/assets/js/script.js')}}"></script>
@endsection