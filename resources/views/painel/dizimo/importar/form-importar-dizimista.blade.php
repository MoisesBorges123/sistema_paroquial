
@extends('painel.template.Painel-Master')

@section('conteudo')

@endsection
@section('css')
<!--forms-wizard css-->
<link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/jquery.steps/css/jquery.steps.css')}}">
<link href="{{asset('estilo_painel/bower_components/sweetalert/css/sweetalert.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('estilo_painel/bower_components/jquery-sweetalert2/css/sweetalert2.css')}}" rel="stylesheet" type="text/css"/>

<style>
    #bem_vindo{
        width: 83%;
    }
    .error{
        background: antiquewhite;
    }
    .negrito{
        font-weight: 800;
        color:#000000;
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

<!-- Custom js -->
<script type="text/javascript">
    $(document).ready(function(){
        busca_cep = "{{route('BuscaCep.Dizimista')}}";
        nome_duplicidade = "{{route('Duplicidade.Dizimista')}}";
        ser_dizimista = "{{route('SerDizimista.Dizimista')}}";
        salvar_outros_dados = "{{route('SerDizimista2.Dizimista')}}";
        meus_dizimistas = "{{route('Visualizar.Dizimista')}}";
        token = "{{ csrf_token() }}";
        woli = "{{asset('imagens/woli.png')}}";
    });
</script>
<script src="{{asset('estilo_painel\assets\pages\forms-wizard-validation\form-wizard.js')}}"></script>
<script src="{{asset('estilo_painel\assets\js\meus\dizimo\painel-cadastro-novo-dizimista.js')}}"></script>
@endsection