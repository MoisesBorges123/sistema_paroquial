
@extends('painel.template.Painel-Master')

@section('conteudo')
<!--BODY PAGE -->


<div class="page-body">
    <div class="row">
                                            <div class="col-md-12">
                                                <!-- Multiple image card start -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>{!! $dados['periodo'] !!}</h5>

                                                    </div>
                                                    <div class="card-block">
                                                        
                                                        <div class="row">
                                                            {!! $dados['folhas'] !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Multiple image card end -->
                                            </div>
                                        </div>

</div>

<!-- BODY PAGE -->
@endsection

@section('css')
    
    <!-- light-box css -->
    <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/ekko-lightbox/css/ekko-lightbox.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/lightbox2/css/lightbox.css')}}">
    <style>
    
          
    </style>
    
@endsection

@section('javascript')

    <!-- light-box js -->
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/ekko-lightbox/js/ekko-lightbox.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/lightbox2/js/lightbox.js')}}"></script>
    <!-- Custom js -->  
    <script src="{{asset('estilo_painel/assets/js/meus/painel-buscas-livros-ajax.js')}}"></script>
   
@endsection