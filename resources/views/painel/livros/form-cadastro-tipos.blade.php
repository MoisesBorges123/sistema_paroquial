
@extends('painel.template.Painel-Master')

@section('conteudo')
<div class="row">
    <div class="col-sm-6">
        
            @if(isset($errors) && count($errors)>0)
                <div class="alert alert-danger">
                @foreach($errors->all() as $erro)
                <p>{{$erro}}</p>
                @endforeach
                </div>
            @endif
        <form method="post" class="form" action="{{route('Cadastrar.TipoLivro')}}">
            {!! csrf_field() !!}
            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="text" name='nome' class="form-control form-control-md" placeholder="Nome">
                </div>
            </div>
            <button type="submit" class='btn btn-info'>Cadastrar</button>
        </form>
    </div>
    
</div>
@endsection