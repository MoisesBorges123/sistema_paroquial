
@extends('painel.template.Painel-Master')

@section('conteudo')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 m-b-20">
        <div class="row">
            <div class="col-md-4">
                <a href="{{route("FormCadastro.TipoIntencao")}}" class="btn btn-primary">Novo</a>
            </div>

        </div>
    </div>
    <div class="col-sm-12">

        <div class="card">
            
            <div class="card-block table-border-style">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr >
                                <th>Código</th>
                                <th>Nome</th>
                                <th class="text-center">N. Linhas em Branco</th>
                                <th>Descrição</th>                                
                                <th class="text-center">Ações</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($query->all() as $dados)
                            <tr>
                                <td>{{$dados->id_tipos_intencoes}}</td>
                                <td>{{$dados->tipo}}</td>
                                <td class="text-center">{{$dados->linhas}}</td>
                                <td>{{$dados->descricao}}</td>
                                <td class="text-center">
                                    <a href="" class="icon-btn">
                                        <button class="btn btn-info btn-icon">
                                            <i class="icofont icofont-refresh"></i>
                                        </button>
                                    </a>
                                    <a href="" class="icon-btn">
                                        <button class="btn btn-danger btn-icon" href=" ">
                                            <i class="icofont icofont-trash"></i>
                                        </button>
                                    </a>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection