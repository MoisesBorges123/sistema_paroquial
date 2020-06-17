
@extends('painel.template.Painel-Master')

@section('conteudo')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 m-b-20">
        <div class="row">
            <div class="col-md-2">
                <button id="btn-add" class="btn btn-primary">Novo</button>
            </div>            
            <div class="col-md-5 loading"></div>
                    

        </div>
    </div>
    @if(!empty($query))
    <div class="col-sm-12">

        <div class="card">
            
            <div class="card-block table-border-style">
                <div class="dt-responsive table-responsive" id="div_table">
                    <table id="carros_estacionados" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                
                                <th>IP</th>
                                <th>Dispositivo</th>
                                <th>Sistema Operacional</th>
                                <th>MAC</th>
                                <th>Tipo</th>
                                <th>Marca</th>                                
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($query as $q)
                            <tr>
                                
                                <td>{{$q->ip}}</td>
                                <td>{{$q->nome}}</td>
                                <td>{{$q->sistema_operacional}}</td>
                                <td>{{$q->mac}}</td>
                                <td>{{$q->tipo}}</td>
                                <td>{{$q->marca}}</td>                                
                                <td>
                                    <div class="icon-btn">
                                         <button data-url="{{route('detalhes.Dispositivos',$q->id_computador)}}" class='btn btn-info btn-editar'><i class='icofont icofont-pencil-alt-5'></i></button>
                                         <button data-url="{{route('detalhes.Dispositivos',$q->id_computador)}}" data-urldelete="{{route('deletar.Dispositivos',$q->id_computador)}}" class='btn btn-danger btn-excluir'><i class='icofont icofont-trash'></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
    @else
    <div class='col-md-12 com-sm-12' id='alerta'>
        <div class='alert'>
            <div class='alert-dafault'>
                <h5>Não há nenhum dispositovo cadastrado</h5>
            </div>
        </div>        
    </div>
    @endif
</div>
@endsection

@section('css')
<style>
    
</style>
@endsection

@section('javascript')
<script src="{{asset('estilo_painel/assets/js/meus/dispositivo/painel-config-dispositivo.js')}}"></script>
<script>
    url_carregaTbl = "{{route('LoadTable.Dispositivos')}}";
    url_salva_dadosCadastrais = "{{route('SalvarDados.Dispositivos')}}";
    url_atualizar_dadosCadastrais = "{{route('AtualizarDados.Dispositivos')}}";   

    </script>
@endsection