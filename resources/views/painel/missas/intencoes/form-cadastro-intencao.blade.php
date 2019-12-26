
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
        @if(!empty(session('erro')) )
        <div class="alert alert-danger">                
            <p>{{session('erro')}}</p>            
        </div>
        @endif
        @if(isset($intencao))
        <form method="post" class="form" action="{{route('Update.Intencao',$intencao->id_intencao)}}">
            {!! method_field('PUT') !!}
            @else
            <form method="post" class="form" action="{{route('Insert.Intencao')}}">

                @endif
                {!! csrf_field() !!}
                <div class="form-group row">
                    <div class="col-md-12 col-sm-12">
                        <input type="text" name='intencao' value="{{$intencao->intencao or old('intencao')}}" class="form-control form-control-md" placeholder="*Intenção" required="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-sm-12">
                        <select class="form-control-md form-control" name="tipo">
                            <option value="">Selecione o tipo de intenção</option>
                            @foreach($tipos->all() as $tipoIntencao)
                            @if( (isset($intencao) && $intencao->tipo == $tipoIntencao->id_tipo))
                            <option selected="" value="{{$tipoIntencao->id_tipo}}">{{$tipoIntencao->nome}}</option>                        
                            @elseif(old('tipo')==$tipoIntencao->id_tipo)
                            <option selected="" value="{{$tipoIntencao->id_tipo}}">{{$tipoIntencao->nome}}</option>       
                            @else
                            <option  value="{{$tipoIntencao->id_tipo}}">{{$tipoIntencao->nome}}</option>       
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-7 col-sm-12">
                        <input class="form-control form-control-md" value="{{$intencao->solicitante or old('solicitante')}}" placeholder="*Nome do Solicitante" name="solicitante" type="text" required=" ">
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <input class="form-control form-control-md phone_area-code" value="{{$intencao->telefone or old('telefone')}}" placeholder="*Telefone" name="telefone" type="text" required="">                    
                    </div>
                </div>           

                <div class="form-group row">
                    <div class="col-md-1 col-sm-1 text-right">
                        @if(isset($intencao->data_fim) && $intencao->data_fim!=$intencao->data_inicio)
                        <input class="form-control form-control-md" id='programacao' checked="true" name="programada" type="checkbox">                    
                        @else
                        <input class="form-control form-control-md" id='programacao'  value="{{old('programada')}}" name="programada" type="checkbox">                    
                        @endif
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <label>Intenção Programada</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <label>Horario da Celebração</label>
                        <input class="form-control form-control-md time" value="{{$intencao->horario or old('horario')}}" placeholder="*Horário" name="horario" type="text" required="">                    
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label>Dia da Missa </label>
                        <input class="form-control form-control-md" id='data_inicio' value="{{$intencao->data_inicio or old('data_inicio')}}"  name="data_inicio" type="date" required="">                    
                    </div>
                    <div class="col-md-4 col-sm-12 fade" id='dt-fim'>
                        <label>Celebrar até o dia</label>
                        <input class="form-control form-control-md" id='data_fim' value="{{$intencao->data_fim or old('data_fim')}}"  name="data_fim" type="date" >                    
                    </div>
                    <div class="col-md-12 col-sm-12 m-t-30 text-center">
                        <div class="row">
                            <div class='col-md-6 col-sm-6'>
                                <a href="{{route('visualiza.Intencao')}}" class='btn btn-danger'>
                                    Cancelar
                                </a>
                            </div>
                            <div class='col-md-6 col-sm-6 '>
                                <button type="submit" class='btn btn-inverse'>
                                    @if(!isset($intencao)) 
                                    Cadastrar 
                                    @else 
                                    Editar 
                                    @endif
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div>

</div>
@endsection

@section('javascript')
<script>
    $(document).ready(function () {
        if ($('#programacao').is(":checked") == true) {
            $('#dt-fim').removeClass('fade');
        } else {
            $('#dt-fim').addClass('fade');

        }
        $(document).on('change', '#programacao', function () {
            if ($('#programacao').is(":checked") == true) {
                $('#dt-fim').removeClass('fade');
            } else {
                $('#dt-fim').addClass('fade');
                $('#data_fim').val(null);
            }
        });
    });
</script>
@endsection