
@extends('painel.template.Painel-Master')



@section('conteudo')
<div class="page-body">
<div class='card' id='fundo_folha'>
    <div class='card-block'>
        <div class="row" >
            <div class="col-sm-12 col-md-12">

                @if(isset($errors) && count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $erro)
                    <p>{{$erro}}</p>
                    @endforeach
                </div>
                @endif


                <form method="post" class="form" action="">
                    {!! csrf_field() !!}
                    <div class="form-group row  m-b-25 m-t-10">
                        <div class="col-md-3 col-sm-6 ml-auto pesquisa_livro">
                            <select class="form-control" name="livro" id="livro">
                                <option value="-1">- Selecione um livro -</option>
                                @foreach($dadosLivro as $dado)
                                <option value="{{$dado->id_livro}}">{{$dado->numeracao}}</option>
                                @endforeach
                                <option value="-1">Não está na Lista</option>
                            </select>                    
                        </div>


                    </div>
                    <div class="form-group row m-t-10">
                        <div class="col-md-1 col-sm-1 p-t-5 p-r-0 text-right passo1">
                            <label class='h4 '>Aos</label>                    
                        </div>
                        <div class="col-md-4 col-sm-5 p-r-0 passo1">
                            <input class="form-control data-avancada" type="text" placeholder="Data do Batizado" readonly="readonly">                
                        </div>
                        <div class="col-md-1 col-sm-1 p-t-5 p-r-0 p-l-0 text-center passo2">
                            <label class='h4 '>na</label>                    
                        </div>
                        <div class="col-md-2 col-sm-5  p-l-0 passo2">
                            <select class='form-control' name='capela_paroquia' id="tipo">
                                <option value=''>Pároquia/Capela</option>
                                <option value='1'>Capela</option>
                                <option value='2'>Paróquia</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-12  p-l-0 passo3">
                        </div>
                    </div>
                    <div class="form-group row passo4">
                        <div class="col-md-3 col-sm-6 p-t-6 p-r-0 text-center">
                            <label class='h4'>Batizei solenemente</label>                    
                        </div>
                        <div class="col-md-6 col-sm-6 p-l-0 passo4">                    
                            <input type="text" name='batizando' class="form-control" placeholder="Nome da criança">
                        </div>
                        <div class="col-md-2 col-sm-4 p-t-6 p-r-0 text-left passo5">
                            <label class='h4'>Nascido em</label>                    
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-sm-5 p-r-0 passo5">
                            <input name="d_nasc" class="form-control data-avancada" type="text" placeholder="Data do Nascimento" readonly="readonly">                
                        </div>                
                        <div class="col-md-2 col-sm-4 p-t-6 p-r-0 text-left passo6">
                            <label class='h4'>, filho de</label>                    
                        </div>
                        <div class="col-md-6 col-sm-6 p-r-0 passo6">                    
                            <input type="text" name='pai' class="form-control form-control-md" placeholder="Nome do pai">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-1 col-sm-3 p-t-6 p-r-0 text-center passo7">
                            <label class='h4'>e de</label>                    
                        </div>
                        <div class="col-md-6 col-sm-6 p-l-0 passo7">                    
                            <input type="text" name='mae' class="form-control form-control-md" placeholder="Nome da mãe">
                        </div>
                        <div class="col-md-3 col-sm-4 p-t-6 p-r-0 text-center passo8">
                            <label class='h4'>Foram padrinhos</label>                    
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-5 col-sm-6  p-r-0 passo8">                    
                            <input type="text" name='padrinho' class="form-control form-control-md" placeholder="Nome do padrinho">
                        </div>
                        <div class="col-md-1 col-sm-3 p-t-6 p-r-0 text-center passo9">
                            <label class='h4'>e</label>                    
                        </div>               
                        <div class="col-md-5 col-sm-6 passo9">                    
                            <input type="text" name='madrinha' class="form-control form-control-md" placeholder="Nome da madrinha">.
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-sm-12 passo10">                    
                            <label class="h4">E para constar lavrei este termo que assino</label>
                        </div>                
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2 col-sm-2 p-r-0 text-center passo10">                    
                            <label class="h4">O padre</label>
                        </div>
                        <div class="col-md-10 col-sm-10 p-l-0 passo10 " id="camp10">                    
                            <select class="form-control" id="padre" name="padre">
                                <option>- Selecione o Padre Celebrante -</option>
                                <option value='-1'>Não está na Lista</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row passo11">
                        <div class="col-md-12 col-sm-12">
                            <textarea name="observacao" id="editor" class="form-control" rows="8">Insira aqui algumas observações sobre esse registro</textarea>
                        </div>
                    </div>
                    <div class="form-group row passo12">
                        <div class="col-md-12 col-sm-12 text-center">
                            <button type="button" id='cadastra_igreja' class="fade hidden btn btn-primary btn-outline-primary waves-effect md-trigger" data-modal="modal-13">Cadastra Igreja</button>
                            <button type="submit" class='btn btn-info md-effect-13'>Salvar</button> 

                        </div>
                    </div>
                </form>
            </div>
            <div class='col-md-12'>


                <div class="animation-model">
                    <div class="md-modal md-effect-13" id="modal-13">
                        <div class="md-content">
                            <h3 id='modal-13-titulo'>Modal Dialog</h3>
                            <div>
                                <div id='modal-13-texto'></div>
                                <form id='cadastro-rapido-igreja'>
                                    <div class='form-group row'>
                                        <div class='col-md-10'>
                                            <input name='nome' type='text' id='nome-igreja' placeholder="Nome" class='form-control' required=''>
                                        </div>
                                        <div class='col-md-2'>
                                            <button type="button" id='salva-igreja' class="btn btn-success">Salvar</button>                                                                                     
                                        </div>
                                    </div>
                                </form>
                                <button type="button" class="btn btn-primary waves-effect md-close">Fechar</button>
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
</div>
@endsection


@section('css')
<!-- Date-Dropper css -->
<link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/datedropper/css/datedropper.min.css')}}">
<!-- sweet alert framework -->
<link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/sweetalert/css/sweetalert.css')}}">
<!-- animation nifty modal window effects css -->
<link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/css/component.css')}}">
<style>
    #fundo_folha{
        background-image: url("{{asset('estilo_painel/assets/images/sistema/folha_velha.jpg')}}");
        background-size: 100% 100%;

    }
    .page-body{
        input{
            font-size: 18px !important;
        }
        
    }
</style>
@endsection

@section('javascript')
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next/js/i18next.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/jquery-i18next/js/jquery-i18next.min.js')}}"></script>
<script src="{{asset('estilo_painel/assets/js/pcoded.min.js')}}"></script>
<!--<script src="{{asset('estilo_painel/assets/js/vartical-layout.min.js')}}"></script>-->
<script src="{{asset('estilo_painel/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Bootstrap date-time-picker js -->
<script type="text/javascript" src="{{asset('estilo_painel/assets/pages/advance-elements/moment-with-locales.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/assets/pages/advance-elements/bootstrap-datetimepicker.min.js')}}"></script>
<!-- Date-range picker js -->
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/bootstrap-daterangepicker/js/daterangepicker.js')}}"></script>
<!-- Date-dropper js -->
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/datedropper/js/datedropper.min.js')}}"></script>
<!-- Custom js -->
<script type="text/javascript" src="{{asset('estilo_painel/assets/pages/advance-elements/custom-picker.js')}}"></script>
<!-- sweet alert js -->
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/sweetalert/js/sweetalert.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/assets/js/modal.js')}}"></script>
<!-- sweet alert modal.js intialize js -->
<!-- modalEffects js nifty modal window effects -->
<script type="text/javascript" src="{{asset('estilo_painel/assets/js/modalEffects.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/assets/js/classie.js')}}"></script>

<script type="text/javascript" src="{{asset('frameworks-plugins/ckeditor/ckeditor.js')}}"></script>

<script type="text/javascript" src="{{asset('estilo_painel/assets/js/meus/painel-cadastrar-batismo-ajax.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/assets/js/meus/painel-cadastrar-batismo-passos.js')}}"></script>
<script>
$(document).ready(function () {
    $('.passo2').fadeOut();
    $('.passo3').fadeOut();
    $('.passo4').fadeOut();
    $('.passo5').fadeOut();
    $('.passo6').fadeOut();
    $('.passo7').fadeOut();
    $('.passo8').fadeOut();
    $('.passo9').fadeOut();
    $('.passo10').fadeOut();
    $('.passo11').fadeOut();
    $('.passo12').fadeOut();
    /*var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _token
        }
    });*/
    rota_busca2 = "{{route('Mostrar.Padres')}}";
    rota_busca1 = "{{route('Pesquisa_Igreja.Batizado')}}";
    rota_busca0 = "{{route('Pesquisa_Folha.Batizado')}}";
    rota_salva_igreja = "{{route('CadastroRapido.Igreja')}}";
    rota_salva_capela = "{{route('CadastroRapido.Capela')}}";
    rota_salva_padre = "{{route('CadastroRapido.Padre')}}";
    $(document).on('change', '#livro', function () {
        buscarFolhas_deLivro($('#livro').val());
    });
    $(document).on('click', '#salva-igreja', function () {
        cadastrarIgreja($('#nome-igreja').val());
    });
    $(document).on('click', '#salva-capela', function () {
        cadastrarCapela($('#nome-igreja').val());
    });
    $(document).on('click', '#salva-padre', function () {
        cadastrarPadre($('#nome-igreja').val());
    });
    CKEDITOR.replace('editor', {
        language: 'pt-br',
        uiColor: '#e5ce92'
    });
});
</script>

@endsection