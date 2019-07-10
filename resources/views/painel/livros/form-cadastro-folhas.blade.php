
@extends('painel.template.Painel-Master')

@section('conteudo')
<div class="card">
   
    <div class='card-block'>
        <div class="row text-center">
            <div class='col-md-2 col-sm-12'>                
            </div>
    <div class="col-md-8 col-sm-12">

        @if(isset($errors) && count($errors)>0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $erro)
            <p>{{$erro}}</p>
            @endforeach
        </div>
        @endif
        <form method="post" class="j-forms" id="j-forms" novalidate="" action="{{route('Cadastrar.Folha',$dado->id_livros_registros)}}" enctype="multipart/form-data">
            <div class="wrapper wrapper-640">                    
                <div class="content">
                {!! method_field('PUT') !!}
                {!! csrf_field() !!}
                <h4 class='text-center m-b-40'>Insira os dados da nova folha </h4>
                <p>Faça o UPLOAD de arquivos tipo .PNG, .JPG, .JPEG para adicinar novas folhas ao livro.</p>
                <!-- start cloned link elements -->
                <div class="clone-link">
                    <div class="toclone">                        
                        <div class="j-row">
                            <div class="span4 unit">
                                <div class="input">
                                    <input type="text" name="num_pagina" placeholder="Folha">
                                </div>
                            </div>
                            
                            <div class="span12 unit">
                                <div class="input">
                                    <textarea class='form-control' placeholder='Obsercações' rows='5' name='observacao'></textarea>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="divider-text gap-top-45 gap-bottom-45">
                                <span>Você pode enviar até 4 fotos da mesma página</span>
                         </div>
                        
                        <div class="span12 unit">
                            <div class="input">
                               <input type="file" name="foto[]" class="filer_input" multiple="multiple">
                            </div>
                        </div>
                    </div>
                    <!-- end /.toclone -->
                </div>
                <!-- end cloned link elements -->
                 <div class="footer-card">
                <button type="submit" class='btn btn-info'>Cadastrar</button>                
            </div>
            </div>


        </form>

       

        </div>
    </div>
            
    
    </div>
    </div>
</div>

        @endsection

        @section('javascript')
       
        @if(!empty($_SESSION['mensagem']))        
        <script>
            $(document).ready(function(){
                notify( "{{$_SESSION['mensagem']}}" , "{{$_SESSION['tipo']}}");                               
            });
            
            
        </script>
        
        @endif
                
        <!-- jquery file upload js -->
        <script type="text/javascript" src="{{asset('estilo_painel/assets/pages/jquery.filer/js/jquery.filer.min.js')}}"></script>
        <script src="{{asset('estilo_painel/assets/pages/filer/custom-filer.js')}}" type="text/javascript"></script>
        <script src="{{asset('estilo_painel/assets/pages/filer/jquery.fileuploads.init.js')}}" type="text/javascript"></script>
     
        @endsection
       






        @section('css')
        <!-- jpro forms css -->
        <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/pages/j-pro/css/demo.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/pages/j-pro/css/font-awesome.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/pages/j-pro/css/j-forms.css')}}">

        <!-- jquery file upload Frame work -->
        <link href="{{asset('estilo_painel/assets/pages/jquery.filer/css/jquery.filer.css')}}" type="text/css" rel="stylesheet">
        <link href="{{asset('estilo_painel/assets/pages/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css')}}" type="text/css" rel="stylesheet">
        
         
        @endsection
