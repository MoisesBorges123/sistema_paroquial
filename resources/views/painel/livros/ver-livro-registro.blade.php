
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
                    <div class="card-header text-center bg-inverse">
                        <h4 class='text-white' id="titulo">1-Selecione o sacramento referente aos registros do livro</h4>
                    </div>
                    <div class="progress progress-xs" id="progressbox">
                            <div class="progress-bar progress-bar-danger" id="progressbar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                <div class="card-block"> 
                  
                        
                   
                    <form method="POST" action="{{route("SalvarLivroDigital.Folha")}}" id="form-folha-liro">
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
    <script src="{{asset('estilo_painel/assets/js/meus/painel-digitalizacao-folha-ajax.js')}}"></script>
   

    
    <script type="text/javascript">

    </script>
    @endsection