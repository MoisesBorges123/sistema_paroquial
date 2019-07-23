
@extends('painel.template.Painel-Master')

@section('conteudo')
<!--BODY PAGE -->


<div class="page-body">
    <!-- Basic table card start -->
    <div class="card z-depth-top-2">
        <div class="card-header bg-inverse ">
            <div class='row'>
                <div class='col-md-12 col-sm-12 m-b-15'>
                    <h3 class='h3 float-left'>Pesquisar...</h3>                 
                </div>
                <div class='col-md-3 col-sm-12'>
                    <label>Sacramento</label>
                    <select class='form-control' name='sacramento' id='sacraemnto'>
                        <option value='4'>Todos</option>
                        <option value='1'>Batismo</option>
                        <option value='2'>Crisma</option>
                        <option value='3'>Casamento</option>
                    </select>
                </div>
                <div class='col-md-3 col-sm-12'>
                    <label>Livro</label>
                    <input class='form-control' type="text" name="livro" id='livro'>
                </div>
                <div class='col-md-6 col-sm-12'>                   
                    <div class="row">
                        <div class='col-md-6 col-sm-12'>
                            <label>Data Início</label>
                            <input class='form-control border-primary' type='date' name="inicio" id='inicio'>                            
                        </div>
                        <div class='col-md-6 col-sm-12'>
                            <label>Data Fim</label>
                            <input class='form-control border-primary' type="date" name="fim" id='fim'>                            
                        </div>   
                       
                    </div>
                </div>
            </div>
         
        </div>
        @if(!empty($dados->all()) && count($dados->all())>0)            
            <div class="card-block z-depth-bottom-5">
              
                <div class="row" id='livros'>
                    @foreach($dados->all() as $dado)
                    <div class="col-md-2 col-sm-12">
                        <div class="thumbnail">
                            <div class="thumb" >
                                <a href="{{asset('estilo_painel/assets/images/gallery-grid/1.png')}}" data-lightbox="1" data-title="My caption 1">
                                    <figure class="text-center">
                                        <img src="{{asset('estilo_painel/assets/images/sistema/agenda.png')}}" alt="" class="listaLivros img-fluid img-thumbnail">
                                        <figcaption  class="listaLivros"><b>Livro: {{$dado->numeracao}}</b></figcaption>
                                        <p>{{$dado->sacramento}}</p>
                                        <small class='text-center' >Periodo de {{date('d/m/Y',strtotime($dado->inicio))}} a {{date('d/m/Y',strtotime($dado->fim))}}</small>
                                    </figure>                                    
                                </a>
                                <div class='text-center'>
                                <a href="#"><button class="btn btn-warning btn-icon"><span class="icofont icofont-eye-alt"></span></button></a>
                                <a href="#"><button class="btn btn-inverse btn-icon"><span class="icofont icofont-eye-alt"></span></button></a>
                                <button   class="btn btn-danger btn-icon"  ><span class="ion-trash-b"></span></button>
                                </div>
                                
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
        .card-header{
            background-image: url("{{asset('estilo_painel/assets/images/sistema/lupa2.png')}}") !important;
            background-repeat: no-repeat;
            background-size: 66px 67px;
            background-position: initial;
        }
        h3{
            padding-left: 70px;
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
    <script src="{{asset('estilo_painel/assets/js/meus/painel-buscas-livros-ajax.js')}}"></script>
   
@endsection