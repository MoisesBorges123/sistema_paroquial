
@extends('painel.template.Painel-Master')

@section('conteudo')
<div class="row">
    <div class="col-lg-12 ncol-md-12 col-sm-12 m-b-20">
        <div class="row">             
            <div class="col-lg-2 col-md-2 col-sm-6 ">
                <button id='btn_add' type="button" class="btn btn-primary">Novo Dizimista</button>                
            </div> 
            <div class="col-md-4 col-lg-3 col-sm-6" style="line-height: 24px;">
                <div class="icon-btn">
                    <div class="form-group row" >
                        <label class='col-sm-4 col-form-label'>Mostrar</label>
                        
                        <select class="form-control col-sm-8" id='selecionar_registros'>
                            <option value='Registro Ativo'>Apenas Ativos</option>
                            <option value='Deletado'>Apenas Excluidos</option>
                            <option value=''>Todos</option>                        
                        </select>    
                        
                    </div>
                </div>                
            </div>
            
            
            
        </div>
        <div class='row'>
            <div class='col-md-4' id='loader'> 
                <div class="loader-block">
                    <span class='h4'>Carregando Dados</span>
                    <svg id="loader2" viewBox="0 0 100 100">
                        <circle id="circle-loader2" cx="50" cy="50" r="45"></circle>
                    </svg>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">

                <div class="card-block">
                    <div class="dt-responsive table-responsive" id="mytable">
                        <table id="minha_tabela" class="table table-striped table-bordered nowrap">   
                            <thead id='tb_cabeca'>
                                <tr >

                                    <th>Nome</th>
                                    <th class="text-center">Telefone</th>                                                   
                                    <th class="text-center">Endereço</th>                                                   
                                    <th class="text-center">Aniversário</th>                                
                                    <th class="text-center">Ações</th>                                
                                </tr>
                            </thead>
                            <tbody id='body_tbl_Dizimistas'></tbody>
                      
                            
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
    @endsection



    @section('css')
    <!-- lightbox Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/lightbox2/css/lightbox.min.css')}}">
     <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">-->
    <style>
        #mes_aniversario{
            /*height: 43px;*/
        }
        #btn-aniversariantes{
            /*height: 43px;*/
        }
        .bt-table{
            height: 30px !important;
            width: 30px !important;
            font-size:25px !important;
        }
        table{
            font-family: "Open Sans", sans-serif;
        }
        tr{
            
                height:30px !important;
            
        }
        tbody{
            font-size:13px;
        }
        
    </style>
    @endsection



    @section('javascript')
    <!-- data-table js -->
<script src="{{asset('estilo_painel/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('estilo_painel/assets/pages/data-table/js/jszip.min.js')}}"></script>
<script src="{{asset('estilo_painel/assets/pages/data-table/js/pdfmake.min.js')}}"></script>
<script src="{{asset('estilo_painel/assets/pages/data-table/js/vfs_fonts.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<!-- Custom js -->
<script src="{{asset('estilo_painel/assets/pages/data-table/js/data-table-custom.js')}}"></script>

    <script type='text/javascript'>
        woli = "{{asset('imagens/woli.png')}}";
        url_devolucao = "{{route('Devolucoes.devolver_dizimo')}}";
        indexDizimistas = null;
         
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            busca_cep = "{{route('BuscaCep.Dizimista')}}";
            nome_duplicidade = "{{route('Duplicidade.Dizimista')}}";
            ser_dizimista = "{{route('Insert.Dizimista')}}";
            salvar_outros_dados = "{{route('SerDizimista2.Dizimista')}}";
            meus_dizimistas = "{{route('Visualizar.Dizimista')}}";            
            url_buscar_pessoas="{{route('Listar.Pessoas')}}";
            url_busca_table="{{route('CarregarTble.Dizimista')}}";
        });
    </script>
    
    <script src="{{asset('estilo_painel/assets/js/meus/dizimo/painel-tbl-dizimistas.js')}}"></script>

    @endsection