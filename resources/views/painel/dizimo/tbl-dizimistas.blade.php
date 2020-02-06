
@extends('painel.template.Painel-Master')

@section('conteudo')
<div class="row">
    <div class="col-lg-12 ncol-md-12 col-sm-12 m-b-20">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-12 ">
                <a href="{{route("FormCadastro.Dizimista")}}" class="btn btn-primary">Novo Dizimista</a>
            </div>            

               <!-- <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="header-search">
                        <div class="main-search morphsearch-search">
                            <div class="input-group">                                
                                <select id='busca_dizimista' class="form-control" name="dizimista">
                                  <option value=''>Pesquisar Dizimista...</option>
                                    @foreach($query->all() as $dizimista)
                                    <option value="{{$dizimista->id_dizimisa}}">{{$dizimista->nome}}</option>
                                    @endforeach
                                </select>
                                
                                <span class="input-group-addon search-btn bg-inverse"><i class="feather icon-search"></i></span>
                            </div>
                        </div>
                    </div>

                </div>-->
            <div class="col-md-3 col-lg-4 col-sm-8" style="line-height: 24px;">
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
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">

                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="lang-dt" class="table table-striped table-bordered nowrap">
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
                                <tr>                               
                                    <td>{{$dados->id_dizimista}}</td>
                                    <td class="text-left">{{$dados->nome}}</td>                               
                                    <td class="text-center">{{$dados->rua}}, {{$dados->bairro}}, {{$dados->num_casa}} @if($dados->apartamento) , Apto {{$dados->apartamento}} @endif</td>                               

                                    <td class="text-center">{{date('d/m',strtotime($dados->d_nasc))}}</td>                               
                                    <td class="text-center">
                                        <div class="icon-btn">
                                            <button data-dizimizta="{{$dados->id_situacao}}" class="btn btn-info btn-icon  bt-table" data-toggle="tooltip" data-placement="top" data-original-title="Ficha Completa">
                                                @if($dados->sexo==2)
                                                <i class="icofont icofont-user-female"></i>
                                                @elseif($dados->sexo==1)
                                                <i class="icofont icofont-user-alt-4"></i> 
                                                @else
                                                <i class="icofont icofont-user-alt-5"></i>
                                                @endif
                                            </button>



                                               <!--<button data-toggle="tooltip" data-placement="top" data-original-title="Informar Morte" class="btn btn-dark btn-icon morte" data-nome='{{$dados->nome}}' data-dizimizta="{{$dados->id_situacao}}">
                                                   <i class="icofont icofont-skull-face"></i>
                                               </button> -->




                                            <button data-toggle="tooltip"  data-placement="top" data-original-title="Devolver Dízimo" class="btn btn-success btn-icon devolver bt-table"  data-dizimista="{{$dados->id_dizimista}}">
                                                <i class="icofont icofont-money-bag m-auto"></i>
                                            </button>


                                            <button data-toggle="tooltip" data-placement="top" data-original-title="Atualizar Cadastro" class="btn btn-primary btn-icon bt-table" data-dizimizta="{{$dados->id_dizimista}}">
                                                <i class="icofont icofont-refresh"></i>
                                            </button>


                                            <button data-toggle="tooltip" data-placement="top" data-original-title="Excluir Cadastro" class="btn btn-danger btn-icon bt-table" data-dizimizta="{{$dados->id_dizimista}}">
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
         
    </script>
    
    <script src="{{asset('estilo_painel/assets/js/meus/dizimo/painel-tbl-dizimistas.js')}}"></script>

    @endsection