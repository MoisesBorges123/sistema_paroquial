
@extends('painel.template.Painel-Master')

@section('conteudo')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 m-b-20">
        <div class="row">
            <div class="col-md-4">
                <a href="{{route("FormCadastro.TipoCarta")}}" class="btn btn-primary">Novo</a>
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
                                <h5 class="text-inverse">Você não nenhum tipo de situação cadastrada.</h5>
                            </div>
                        </div>
                        @else
                        <thead>
                            <tr >
                           
                                <th>Código</th>
                                <th class="text-center">Tipo</th>                                                   
                                <th class="text-center">Ações</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($query->all() as $dados)
                            <tr>                               
                                <td>{{$dados->id_tipo_carta}}</td>
                                <td class="text-center">{{$dados->tipo}}</td>                               
                                <td class="text-center">
                                    <a href="{{route("Editar.TipoCarta",$dados->id_tipo_carta)}}" class="icon-btn">
                                        <button class="btn btn-info btn-icon">
                                            <i class="icofont icofont-refresh"></i>
                                        </button>
                                    </a>
                                    <a href="{{route("Excluir.TipoCarta",$dados->id_tipo_carta)}}" class="icon-btn">
                                        <button class="btn btn-danger btn-icon" href=" ">
                                            <i class="icofont icofont-trash"></i>
                                        </button>
                                    </a>
                                    
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