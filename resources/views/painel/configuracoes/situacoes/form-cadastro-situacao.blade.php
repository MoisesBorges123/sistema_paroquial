
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
            @if(isset($errors) && count($errors)>0)
                <div class="alert alert-danger">                
                <p>{{session('erro')}}</p>            
                </div>
            @endif
            @if(isset($tipoIntencao))
                <form method="post" class="form" action="{{route('update.Situacoes',$tipoIntencao->id_tipo)}}">
                {!! method_field('PUT') !!}
            @else
                <form method="post" class="form" action="{{route('insert.Situacoes')}}">
            @endif
            {!! csrf_field() !!}
            <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                    <input type="number" name='codigo' value="{{$status->id_situacao or old('codigo')}}" class="form-control form-control-md" placeholder="*Código">
                </div>
            </div>
           
            <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                    <textarea name="descricao" class="form-control" placeholder="Descrição" rows="5">{{$status->descricao or old('descricao')}}</textarea>
                </div>
            </div>
            <button type="submit" class='btn btn-inverse'>
                @if(isset($tipoIntecao)) 
                Cadastrar 
                @else 
                Editar 
                @endif
            </button>
        </form>
    </div>
    
</div>
@endsection