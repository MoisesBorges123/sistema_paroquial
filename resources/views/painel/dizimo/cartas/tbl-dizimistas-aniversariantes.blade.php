
@extends('painel.template.Painel-Master')

@section('conteudo')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 m-b-20">
        <div class="row">
            <div class="col-md-4">
                <select>
                    <option value=''>Mês de Aniversário</option>
                    @for($i=1;$i<=12;$i++)
                    <option value='{{$i}}'>{{date('F',strtotime($i))}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary">Pesquisar</button>
            </div>

        </div>
    </div>
    <div class="col-sm-12">

        <div class="card">
            
            <div class="card-block table-border-style">
                <div class="table-responsive">
                    <table class="table">
                        @if(empty($query->all()))
                        <div class="alert">
                            <div class="alert-default">
                                <h5 class="text-inverse">Nenhum dizimista cadastrado.</h5>
                            </div>
                        </div>
                        @else
                        <thead>
                            <tr >
                           
                                <th>Código</th>
                                <th class="text-center">Nome</th>                                                   
                                <th class="text-center">Endereço</th>                                                   
                                <th class="text-center">Aniversário</th>                                
                                <th class="text-center">Ações</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($query->all() as $dados)
                            <tr>                               
                                <td>{{$dados->id_dizimista}}</td>
                                <td class="text-left">{{$dados->nome}}</td>                               
                                <td class="text-center">{{$dados->rua}}, {{$dados->bairro}}, {{$dados->num_casa}} @if($dados->apartamento) , Apto {{$dados->apartamento}} @endif</td>                               
                                
                                <td class="text-center">{{date('d/m',strtotime($dados->d_nasc))}}</td>                               
                                <td class="text-center">
                                    <div class="icon-btn">
                                        <button data-dizimizta="{{$dados->id_situacao}}" class="btn btn-info btn-icon" data-toggle="tooltip" data-placement="top" data-original-title="Detalhes da Ficha">
                                           @if($dados->sexo==2)
                                           <i class="icofont icofont-user-female"></i>
                                           @elseif($dados->sexo==1)
                                           <i class="icofont icofont-user-alt-4"></i> 
                                           @else
                                           <i class="icofont icofont-user-alt-5"></i>
                                           @endif
                                        </button>
                                   
                                      
                                            
                                         <!--   <button data-toggle="tooltip" data-placement="top" data-original-title="Informar Morte" class="btn btn-dark btn-icon morte" data-nome='{{$dados->nome}}' data-dizimizta="{{$dados->id_situacao}}">
                                                <i class="icofont icofont-skull-face"></i>
                                            </button> -->
                                            
                                       
                                    
                                  
                                         <button data-toggle="tooltip"  data-placement="top" data-original-title="Devolver Dízimo" class="btn btn-warning btn-icon devolver"  data-dizimista="{{$dados->id_dizimista}}">
                                            <i class="icofont icofont-money-bag m-auto"></i>
                                        </button>
                                 
                                 
                                        <button data-toggle="tooltip" data-placement="top" data-original-title="Atualizar Cadastro" class="btn btn-info btn-icon" data-dizimizta="{{$dados->id_dizimista}}">
                                            <i class="icofont icofont-refresh"></i>
                                        </button>
                              
                                    
                                        <button data-toggle="tooltip" data-placement="top" data-original-title="Excluir Cadastro" class="btn btn-danger btn-icon" data-dizimizta="{{$dados->id_dizimista}}">
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
@endsection



@section('javascript')
<script type='text/javascript'>
    woli = "{{asset('imagens/woli.png')}}";
    url_devolucao ="{{route('Devolucoes.devolver_dizimo')}}";
</script>
<script src="{{asset('estilo_painel\assets\js\meus\dizimo\painel-tbl-dizimistas.js')}}"></script>

@endsection