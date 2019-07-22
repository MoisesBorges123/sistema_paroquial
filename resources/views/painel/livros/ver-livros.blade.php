
@extends('painel.template.Painel-Master')

@section('conteudo')
<!--BODY PAGE -->


<div class="page-body">
    
</div>



    <!-- BODY PAGE -->
    @endsection

    @section('css')    

    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/icon/themify-icons/themify-icons.css')}}">
    <!-- animation nifty modal window effects css -->
    <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/css/component.css')}}">
    
    <style>
        .listaLivros{
            width: 100px;
            height: auto;
            border:none;
        }
    </style>
    @endsection

    @section('javascript')  
    
    <!-- sweet alert js -->
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/sweetalert/js/sweetalert.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/assets/js/modal.js')}}"></script>


    
    <script type="text/javascript">
    $(document).ready(function () {           
       

                
    });
    </script>
    @endsection