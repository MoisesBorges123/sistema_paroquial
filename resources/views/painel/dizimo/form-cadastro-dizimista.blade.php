
@extends('painel.template.Painel-Master')

@section('conteudo')
<div class="row">
    <div class="col-sm-12">

        <!--INICIO MOSTRA ERROS -->
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
        <!--FIM MOSTRA ERROS -->           


        <!-- Verticle Wizard card start -->
        <div class="card">
            <div class="card-header">
                <h5>Insira os dados do novo dizimista</h5>              

            </div>
            <div class="card-block bg-inverse">
                <div class="row m-auto">
                    <div class="col-md-12">
                        <div id="wizard2">
                            <section>
                                <h2 id='teste'></h2>
                                <form ajax="true" method="post" class="wizard-form" id="form-dizimista" action="{{route('Insert.Dizimista')}}">
                                    <h3> Dados Pessoais </h3>
                                    <fieldset>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="nome-2" class="block">Nome Completo *</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input id="userName-22" name="nome" type="text" class=" form-control" required="">
                                                <input id="existe" name="exite" type="hidden" value="0">
                                            </div>
                                        </div>                                       
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="d_nasc-2" class="block">Data de Nascimento</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input id="d_nasc-22" name="d_nasc" type="date" class="form-control ">
                                            </div>
                                        </div> 
                                        <div class="form-group row m-auto">
                                            <img id='bem_vindo' src="{{asset('imagens/bem_vindo.png')}}">
                                        </div>
                                    </fieldset>
                                    <h3> Endereço </h3>
                                    <fieldset>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="cep-2" class="block">CEP *</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input id="cep-22" name="cep" type="text" minlength="9" class="form-control cep" required="">
                                            </div>
                                            <div class="col-sm-2" id="load_cep">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="numero" class="block">Número *</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input id="numero" name="num_casa" type="text" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="rua-2" class="block">Rua *</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input id="rua-22" name="rua" type="text" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="bairro-2" class="block">Bairro *</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input id="bairro-22" name="bairro" type="text" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="cidade" class="block">Cidade *</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input id="cidade22" name="cidade" type="text" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">Estado *</div>
                                            <div class="col-sm-12">
                                                <select class="form-control required" name="estado" id='txt_estados'>
                                                    <option value="">Selecione seu Estado</option>
                                                    @foreach($estados as $uf)
                                                    <option value="{{$uf->id_estado}}">{{$uf->nome_estado}}</option>
                                                    @endforeach                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <h3> Contato</h3>
                                    <fieldset>
                                        
                                        <div class="form-group row" id='form-contato'>
                                            <div class="col-sm-11">
                                                <label for="email-2" class="block">Email</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input id="email-22" name="email" type="email" class=" form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row linha-telefone" id='linha1' >
                                            <div class="col-sm-12">
                                                <label for="telefone-2" class="block">Telefone</label>
                                            </div>
                                            <div class="col-sm-2" >
                                                <input id="dd-22" name="dd[]" type="text" class="form-control dd" maxlength="2">
                                              
                                            </div>
                                            <div class="col-sm-8">                                              
                                                <input id="telefone-22" name="fone[]" type="text" class="form-control phone">
                                            </div>
                                            <div class="col-sm-2">
                                                <button class='btn btn-warning adiciona-telefone' data-linha=1  type='button'>+</button>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-12 col-sm-12">
                                                
                                                <textarea class="form-control" rows="4" name="obs_telefone" placeholder="Melhor horário para efetuar ligações">
                                                
                                                </textarea>
                                            </div>                                            
                                        </div>
                                       
                                    </fieldset>
                                    
                                </form>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Verticle Wizard card end -->







    </div>

</div>
@endsection
@section('css')
<!--forms-wizard css-->
<link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/jquery.steps/css/jquery.steps.css')}}">
<link href="{{asset('estilo_painel/bower_components/sweetalert/css/sweetalert.css')}}" rel="stylesheet" type="text/css"/>
<style>
    #bem_vindo{
        width: 83%;
    }
    .error{
        background: antiquewhite;
    }
</style>
@endsection
@section('javascript')
<!-- i18next.min.js -->
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next/js/i18next.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/jquery-i18next/js/jquery-i18next.min.js')}}"></script>

<!--Forms - Wizard js-->
<script src="{{asset('estilo_painel/bower_components/jquery.cookie/js/jquery.cookie.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/jquery.steps/js/jquery.steps.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/jquery-validation/js/jquery.validate.js')}}"></script>
<!-- Validation js -->
<script src="{{asset('estilo_painel/assets/js/form-wizard/underscore-min.js')}}"></script>
<script src="{{asset('estilo_painel/assets/js/form-wizard/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/assets/pages/form-validation/validate.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/sweetalert/js/sweetalert.min.js')}}" type="text/javascript"></script>
<!-- Custom js -->
<script type="text/javascript">
    $(document).ready(function(){
        busca_cep = "{{route('BuscaCep.Dizimista')}}";
    });
</script>
<script src="{{asset('estilo_painel\assets\pages\forms-wizard-validation\form-wizard.js')}}"></script>
<script src="{{asset('estilo_painel\assets\js\meus\dizimo\painel-cadastro-novo-dizimista.js')}}"></script>
@endsection