
@extends('painel.template.Painel-Master')

@section('conteudo')
<div class="row">
    <div class="col-sm-8">
        
            @if(isset($errors) && count($errors)>0)
                <div class="alert alert-danger">
                @foreach($errors->all() as $erro)
                <p>{{$erro}}</p>
                @endforeach
                </div>
            @endif
        <form method="post" class="form" action="{{route('Cadastrar.TipoIntencao')}}">
            {!! csrf_field() !!}
            <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                    <input type="text" name='tipo' class="form-control form-control-md" placeholder="Novo Tipo">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4 col-sm-12">
                    <input class="form-control form-control-md" placeholder="Linhas em Branco" name="linhas" type="text">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                    <textarea name="descricao" class="form-control" placeholder="Descrição" rows="5"></textarea>
                </div>
            </div>
            <button type="submit" class='btn btn-info'>Cadastrar</button>
        </form>
    </div>
    
</div>
@endsection