
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
                    <select class='form-control pesquisa' name='sacramento' id='sacramento'>
                        <option value='4'>Todos</option>
                        <option value='1'>Batismo</option>
                        <option value='2'>Crisma</option>
                        <option value='3'>Casamento</option>
                    </select>
                </div>
                <div class='col-md-3 col-sm-12'>
                    <label>Livro</label>
                    <input class='form-control pesquisa' type="text" name="livro" id='livro'>
                </div>
                <div class='col-md-6 col-sm-12'>                   
                    <div class="row">
                        <div class='col-md-6 col-sm-12'>
                            <label>Data Início</label>
                            <input class='form-control border-primary pesquisa' type='date' name="inicio" id='inicio'>                            
                        </div>
                        <div class='col-md-6 col-sm-12'>
                            <label>Data Fim</label>
                            <input class='form-control border-primary pesquisa' type="date" name="fim" id='fim'>                            
                        </div>   
                       
                    </div>
                </div>
            </div>
         
        </div>                
            <div class="card-block z-depth-bottom-5">
              
                <div class="row m-t-15 " id='livros'>
                    
                </div>
            </div>  
        <div class="md-overlay"></div>
         <div id="styleSelector"></div>
        
    </div>

</div>

<!-- BODY PAGE -->
@endsection

@section('css')
    
    
   
    
    <style>
    
    </style>
    
@endsection

@section('javascript')


    <!-- Custom js -->  
    <script src="{{asset('estilo_painel/assets/js/meus/table-igrejas.js')}}"></script>
   
@endsection