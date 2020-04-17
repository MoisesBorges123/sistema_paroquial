
@extends('painel.template.Painel-Master')

@section('conteudo')
<div class="row">
    <div class="col-lg-12 ncol-md-12 col-sm-12 m-b-20">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-12 ">
                <a href="{{route("FormCadastro.Dizimista")}}" class="btn btn-primary">Novo Dizimista</a>
            </div>            
            <div class="col-lg-2 col-md-2 col-sm-12 ">
                <button id='btn_add' type="button" class="btn btn-primary">Novo Dizimista2</a>
            </div>            
<!--
            <div id='coluna-aniversario' class="col-md-1 col-lg-1 col-sm-6" style="line-height: 24px;">
                <div class="icon-btn">
                    <div class="input-group" >
                    <select class="form-control" id="mes_aniversario">
                        <option>Selecione o mês de aniversário</option>
                        @foreach($meses as $mes)
                        <option value="{{$mes['key']}}">{{$mes['mes']}}</option>
                        @endforeach
                    </select>
                    <div class="icon-btn">
                        <button class="btn btn-inverse" id="btn-aniversariantes">
                            <i style="font-size:16px;" class="icofont icofont-birthday-cake"></i>
                        </button>

                    </div>
                    </div>
                </div>                
            </div>
           
            <div class="col-md-4 col-lg-3 col-sm-6" style="line-height: 24px;">
                <div class="icon-btn">
                    <div class="form-group row" >
                    <label class='col-sm-4 col-form-label'>Mostrar</label>
                    
                    <select class="form-control col-sm-8" id='selecionar_registros'>
                        <option value='1'>Apenas Ativos</option>
                        <option value='2'>Apenas Excluidos</option>
                        <option value='3'>Todos</option>                        
                    </select>    
         
                    </div>
                </div>                
            </div>
       
            -->
                 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">

                <div class="card-block">
                    <div class="dt-responsive table-responsive" id="mytable">
                        <table id="dizimistas" class="table table-striped table-bordered nowrap">
                            @if(empty($query->all()))
                            <div class="alert">
                                <div class="alert-default">
                                    <h5 class="text-inverse">Nenhum dizimista cadastrado.</h5>
                                </div>
                            </div>
                            @else
                            <thead id='tb_cabeca'>
                                <tr >

                                    <th>Código</th>
                                    <th class="text-center">Nome</th>                                                   
                                    <th class="text-center">Endereço</th>                                                   
                                    <th class="text-center">Aniversário</th>                                
                                    <th class="text-center">Ações</th>                                
                                </tr>
                            </thead>
                            <tbody id='tb_dados'>
                                @foreach($query->all() as $dados)
                                <tr id="linha{{$dados->id_dizimista}}">                               
                                    <td>{{$dados->id_dizimista}}</td>
                                    <td class="text-left">{{$dados->nome}}</td>                               
                                    <td class="text-center">{{$dados->rua}}, {{$dados->bairro}}, {{$dados->num_casa}} @if($dados->apartamento) , Apto {{$dados->apartamento}} @endif</td>                               

                                    <td class="text-center">{{date('d/m',strtotime($dados->d_nasc))}}</td>                               
                                    <td class="text-center">
                                        <div class="icon-btn">
                                            <button data-dizimista="{{$dados->id_dizimista}}" class="btn btn-info devolver btn-icon  bt-table"  data-toggle="tooltip" data-placement="top" data-original-title="Ficha">
                                                @if($dados->sexo==2)
                                                <i class="icofont icofont-user-female"></i>
                                                @elseif($dados->sexo==1)
                                                <i class="icofont icofont-user-alt-4"></i> 
                                                @else
                                                <i class="icofont icofont-user-alt-5"></i>
                                                @endif
                                            </button>



                                          <!--  <button data-toggle="tooltip"  data-placement="top" data-original-title="Devolver Dízimo" class="btn btn-success btn-icon devolver bt-table"  data-dizimista="{{$dados->id_dizimista}}">
                                                <i class="icofont icofont-money-bag m-auto"></i>
                                            </button> -->
                                            <button data-toggle="tooltip" id="excluir_cadastro" data-url="{{route('Deleta.Dizimista',$dados->id_dizimista)}}" data-placement="top" data-original-title="Excluir Cadastro" class="btn btn-danger btn-icon bt-table" data-dizimista="{{$dados->id_dizimista}}">
                                                <i class="icofont icofont-trash"></i>
                                            </button>
                                        </div>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @endif
                            
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
        indexDizimistas = "{{route('Visualizar.Dizimista.Excluidos_ou_Ativos')}}";
         
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            busca_cep = "{{route('BuscaCep.Dizimista')}}";
            nome_duplicidade = "{{route('Duplicidade.Dizimista')}}";
            ser_dizimista = "{{route('SerDizimista.Dizimista')}}";
            salvar_outros_dados = "{{route('SerDizimista2.Dizimista')}}";
            meus_dizimistas = "{{route('Visualizar.Dizimista')}}";
            token = "{{ csrf_token() }}";
            
        });
    </script>
    
    <script src="{{asset('estilo_painel/assets/js/meus/dizimo/painel-tbl-dizimistas.js')}}"></script>

    @endsection