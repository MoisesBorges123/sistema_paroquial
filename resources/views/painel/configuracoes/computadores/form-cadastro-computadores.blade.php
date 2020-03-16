
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
            @if(isset($situacao))
                <form method="post" class="form" action="{{route('update.Situacoes',$situacao->id_situacao)}}">
                {!! method_field('PUT') !!}
            @else
                <form method="post" class="form" action="{{route('insert.Situacoes')}}">
            @endif
            {!! csrf_field() !!}
            <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                    <input type="text" name='id_ip' value="{{$situacao->id_situacao or old('id_situacao')}}" class="form-control form-control-md" placeholder="*IP">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                    <input type="text" name='id_mac' value="{{$situacao->id_situacao or old('id_situacao')}}" class="form-control form-control-md" placeholder="MAC">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                    <input type="text" name='id_marca' value="{{$situacao->id_situacao or old('id_situacao')}}" class="form-control form-control-md" placeholder="Marca">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                    <input type="text" name='id_nome' value="{{$situacao->id_situacao or old('id_situacao')}}" class="form-control form-control-md" placeholder="*Nome">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                    <input type="text" name='id_senha' value="{{$situacao->id_situacao or old('id_situacao')}}" class="form-control form-control-md" placeholder="Senha">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                    <input type="text" name='id_so' value="{{$situacao->id_situacao or old('id_situacao')}}" class="form-control form-control-md" placeholder="Sistema Operacional">
                </div>
            </div>
           <div class="form-group row">
                            <div class="form-radio m-t-20">
                                <div class="radio radio-matrial radio-inverse radio-inline">
                                    <label>
                                        <input type="radio" value="celular" name="tipo_dispositivo" checked="checked">
                                        <i class="helper"></i>Celular
                                    </label>
                                </div>
                                <div class="radio radio-matrial radio-inverse radio-inline">
                                    <label>
                                        <input type="radio" value="computador" name="tipo_dispositivo" >
                                        <i class="helper"></i>Computador
                                    </label>
                                </div>
                                
                            </div>
                        </div>
            <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                    <textarea name="descricao" class="form-control" placeholder="Descrição" rows="5">{{$situacao->descricao or old('descricao')}}</textarea>
                </div>
            </div>
            <button type="submit" class='btn btn-inverse'>
                @if(!isset($situacao)) 
                Cadastrar 
                @else 
                Editar 
                @endif
            </button>
        </form>
    </div>
    
</div>
@endsection