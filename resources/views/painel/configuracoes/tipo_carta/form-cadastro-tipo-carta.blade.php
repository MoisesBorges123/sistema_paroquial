
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
            @if(isset($tipo))
                <form method="post" class="form" action="{{route('update.TipoCarta',$tipo->id_tipo_carta)}}">
                {!! method_field('PUT') !!}
            @else
                <form method="post" class="form" action="{{route('insert.TipoCarta')}}">
            @endif
            {!! csrf_field() !!}
                       
            <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                    <textarea name="tipo" class="form-control" placeholder="Descrição" rows="5">{{$tipo->tipo or old('tipo')}}</textarea>
                </div>
            </div>
            <button type="submit" class='btn btn-inverse'>
                @if(!isset($tipo)) 
                Cadastrar 
                @else 
                Editar 
                @endif
            </button>
        </form>
    </div>
    
</div>
@endsection