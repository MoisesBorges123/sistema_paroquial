
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
                <form method="post" class="form" action="{{route('update.TipoIntencao',$tipoIntencao->id_tipo)}}">
                {!! method_field('PUT') !!}
            @else
                <form method="post" class="form" action="{{route('Cadastrar.TipoIntencao')}}">
                   
            @endif
            {!! csrf_field() !!}
            <div class="form-group row">
                <div class="col-md-8 col-sm-12">
                    <input type="text" name='falecido' value="{{$intencao->falecido or old('falecido')}}" class="form-control form-control-md" placeholder="*Intenção" required="">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-7 col-sm-12">
                    <input class="form-control form-control-md" value="{{$intencao->solicitante or old('solicitante')}}" placeholder="*Nome do Solicitante" name="solicitante" type="text" required=" ">
                </div>
                <div class="col-md-5 col-sm-12">
                    <input class="form-control form-control-md" value="{{$intencao->telefone or old('telefone')}}" placeholder="*Telefone" name="telefone" type="text" required="">                    
                </div>
            </div>           
            
            <div class="form-group row">
                <div class="col-md-6 col-sm-6">
                    <input class="form-control form-control-md" value="{{$intencao->programada or old('programada')}}" name="programada" type="checkbox">                    
                </div>
                <div class="col-md-6 col-sm-6">
                    <label>Intenção Programada</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                    <input class="form-control form-control-md" value="{{$intencao->data_inicio or old('data_inicio')}}"  name="data_inicio" type="date" required="">                    
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                    <input class="form-control form-control-md" value="{{$intencao->data_inicio or old('data_fim')}}"  name="data_fim" type="date" required="">                    
                </div>
            </div>
           
            <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                    <input class="form-control form-control-md" value="{{$intencao->telefone or old('telefone')}}" placeholder="*Telefone" name="telefone" type="date" required="">                    
                </div>
            </div>
            <button type="submit" class='btn btn-inverse'>
                @if(!isset($tipoIntecao)) 
                Cadastrar 
                @else 
                Editar 
                @endif
            </button>
        </form>
    </div>
    
</div>
@endsection