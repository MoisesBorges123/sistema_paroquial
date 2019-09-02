
@extends('painel.template.Painel-Master')

@section('conteudo')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 m-b-20">

        <div class="row icon-btn">
            <div class="col-md-4"> 
                <a href="{{route("FormCadastro.Intencao")}}" class="btn btn-warning">Nova Intenção</a>
            </div>
            <div class="col-md-4"> 
                <button type="button" id='imprimir' class="btn btn-primary waves-effect md-trigger" data-modal="modal-5">Imprimir</button>

            </div>


        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 m-b-20">
        <div class="row f-right  icon-btn">
            <div class="col-md-4">
                <button class="btn btn-inverse" id="bt-prev"><i class="icofont icofont-ui-previous"></i></button>
            </div>
            <div class="col-md-4">
                <button class="btn btn-inverse" id="bt-today">Hoje</button>
            </div>
            <div class="col-md-4"> 
                <button class="btn btn-inverse" id="bt-next"><i class="icofont icofont-ui-next"></i></button>
            </div>
        </div>
    </div>
    <div class="col-sm-12">

        <div class="card">

            <div class="card-block table-border-style">
                <div class="card-header my-2 text-center">
                    <h3 class="card-title data">
                        @if(!empty($data))
                        {{$data}}
                        @endif
                    </h3>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        @if(empty($query->all()))
                        <div class="alert">
                            <div class="alert-default">
                                <h5 class="text-inverse">Você não possui nenhuma intenção cadastrada.</h5>
                            </div>
                        </div>
                        @else
                        <thead>
                            <tr >

                                <th>Nome</th>
                                <th >Intenção</th>
                                <th >Missa</th>
                                <th>Solicitante</th>                                
                                <th>Telefone</th>                                
                                <th class="text-center">Ações</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($query->all() as $dados)
                            <tr>                               
                                <td>{{$dados->nome}}</td>
                                <td >{{$dados->intencao}}</td>
                                <td>{{$dados->missa}}</td>
                                <td>{{$dados->solicitante}}</td>
                                <td>{{$dados->telefone}}</td>
                                <td class="text-center">


                                    <a href="{{route("Editar.Intencao",$dados->id_intencao)}}" class="icon-btn">
                                        <button class="btn btn-info btn-icon alert-success-cancel" >
                                            <i class="icofont icofont-refresh"></i>
                                        </button>
                                    </a>                                            

                                    <span class="icon-btn">                                           
                                        <button class="btn btn-danger btn-icon excluir"  data-cod="{{$dados->id_intencao}}" >
                                            <i class="icofont icofont-trash"></i>
                                        </button>                                                                                                                       
                                    </span>




                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>

                <!--MODAL-->
                <div class="animation-model">
                    <div class="md-modal md-effect-5" id="modal-5">
                        <div class="md-content">
                            <h3><i class="icofont icofont-printer text-white"></i>&nbsp;&nbsp;Imprimir...</h3>
                            <div>
                                <p class='lead'>Selecione o dia e o horário da missa que deseja imprimir a intenção.</p>
                                <form method="post" action="{{route("Printer.Intencao")}}" target="_blank" >
                                    {!! csrf_field() !!}
                                    <div class='row justify-content-center'>                                        
                                        <div class='col-md-4'>
                                        
                                            <label for='data'>Dia:</label>
                                            <input class='form-control' id='data' type="date" name='data'>
                                     
                                        </div>
                                        <div class='col-md-4'>
                                      
                                            <label for='horario'>Horário:</label>
                                            <input class='form-control time' id='horario' type="text"  name='horario'>
                            
                                        </div>
                                    </div>
                                    <div class='row justify-content-center m-t-30'>
                                        <div class='col-md-4'>
                                            <button type="submit"  class="btn btn-primary waves-effect">Imprimir</button>                                            
                                        </div>
                                        <div class='col-md-4'>
                                            <button type="button" class="btn btn-danger waves-effect md-close">Sair</button>                                            
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                    <!--animation modal  Dialogs ends -->
                    <div class="md-overlay"></div>
                </div>     

            </div>
        </div>

    </div>
</div>

@endsection

@section('css')
<!-- sweet alert framework -->
<link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/sweetalert/css/sweetalert.css')}}">
<!-- animation nifty modal window effects css -->
<link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/css/component.css')}}">
@endsection



@section('javascript')
<!-- sweet alert js -->
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/sweetalert/js/sweetalert.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/assets/js/modal.js')}}"></script>
<!-- sweet alert modal.js')}} intialize js -->
<!-- modalEffects js nifty modal window effects -->
<script type="text/javascript" src="{{asset('estilo_painel/assets/js/modalEffects.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/assets/js/classie.js')}}"></script>

<script>
$(document).ready(function () {
    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _token
        }
    });
    _urlBusca = "{{route('Search.Intencao')}}";
    _urlExclui = "{{route('Delete.Intencao')}}";

});
</script>
<script type="text/javascript" src="{{asset('estilo_painel/assets/js/meus/missas/intencoes/painel-tbl-intencao.js')}}"></script>
@endsection