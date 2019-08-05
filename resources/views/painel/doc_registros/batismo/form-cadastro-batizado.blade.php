
@extends('painel.template.Painel-Master')



@section('conteudo')
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
                        <option value=''>- Selecione o local -</option>
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
                    <input class="form-control data-avancada" type="text" placeholder="Data do Nascimento" readonly="readonly">                
                </div>                
                <div class="col-md-2 col-sm-4 p-t-6 p-r-0 text-left passo6">
                    <label class='h4'>, filho de</label>                    
                </div>
                <div class="col-md-6 col-sm-6 p-r-0 passo6">                    
                    <input type="text" name='batizando' class="form-control form-control-md" placeholder="Nome do pai">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-1 col-sm-3 p-t-6 p-r-0 text-center passo7">
                    <label class='h4'>e de</label>                    
                </div>
                <div class="col-md-6 col-sm-6 p-l-0 passo7">                    
                    <input type="text" name='batizando' class="form-control form-control-md" placeholder="Nome da mãe">
                </div>
                <div class="col-md-3 col-sm-4 p-t-6 p-r-0 text-center passo8">
                    <label class='h4'>Foram padrinhos</label>                    
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-5 col-sm-6  p-r-0 passo8">                    
                    <input type="text" name='batizando' class="form-control form-control-md" placeholder="Nome do padrinho">
                </div>
                <div class="col-md-1 col-sm-3 p-t-6 p-r-0 text-center passo9">
                    <label class='h4'>e</label>                    
                </div>               
                <div class="col-md-5 col-sm-6 passo9">                    
                    <input type="text" name='batizando' class="form-control form-control-md" placeholder="Nome da madrinha">.
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
                <div class="col-md-10 col-sm-10 p-l-0 passo10">                    
                    <select class="form-control" id="padre" name="padre">
                        <option>- Selecione o Padre Celebrante -</option>
                        <option>Não está na Lista</option>

                    </select>
                </div>
            </div>




            <div class="form-group row passo11">
                <div class="col-md-12 col-sm-12">
                    <textarea name="observacao" class="form-control" placeholder="Insira aqui algumas observações sobre esse registro" rows="8"></textarea>
                </div>
            </div>
            <div class="form-group row passo12">
                <div class="col-md-12 col-sm-12 text-center">
                    <button type="button" class='btn btn-info md-effect-13'>Salvar</button> 
                    <button type="button" id='cadastra_igreja' class="fade hidden btn btn-primary btn-outline-primary waves-effect md-trigger" data-modal="modal-13">Cadastra Igreja</button>
                    
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
    
    input{
        font-size: 18px !important;
    }
</style>
@endsection

@section('javascript')
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next/js/i18next.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/bower_components/jquery-i18next/js/jquery-i18next.min.js')}}"></script>
<script src="{{asset('estilo_painel/assets/js/pcoded.min.js')}}"></script>
<script src="{{asset('estilo_painel/assets/js/vartical-layout.min.js')}}"></script>
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
    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _token
        }
    });
    rota_busca1 = "{{route('Pesquisa_Igreja.Batizado')}}";
    rota_busca0 = "{{route('Pesquisa_Folha.Batizado')}}";
    rota_salva_igreja = "{{route('CadastroRapido.Igreja')}}";
    rota_salva_capela = "{{route('CadastroRapido.Capela')}}";
    $(document).on('change','#livro',function(){
        buscarFolhas_deLivro($('#livro').val());
    });
    $(document).on('click','#salva-igreja',function(){
        cadastrarIgreja($('#nome-igreja').val());
    }); 
    $(document).on('click','#salva-capela',function(){
        cadastrarCapela($('#nome-igreja').val());
    }); 
     
    ////////// PASSO 01 (INSERE A DATA E MOSTRA O CAMPO PARA COLOCAR CAPELA OU IGREJA)
    $(document).on('click', '.passo1', function () {
        clearTimeout(this.interval);
        $('.passo2').fadeOut(500)
        this.interval = setTimeout(function () {
            $('.passo2').fadeIn(500)
        }, 3000);
    });
    
    
    ////////// PASSO 02 (INSERE CAPELA OU IGREJA E PEDE PRAR SELECIONAR QUAL FOI)
    $(document).on('change', '.passo2', function () {
        clearTimeout(this.interval);
        $('.passo3').fadeOut(500);
         buscarIgreja($('#tipo').val());
        this.interval = setTimeout(function () {
            $('.passo3').fadeIn(500);           
        },
                1500//Tempo de Espera para executar a função
                );
    });
   
    
    ////////// PASSO 03 (SELECIONA A IGREJA)
    $(document).on('change', '.passo3', function () {
        clearTimeout(this.interval);
        if($('#igreja').val()==-1){
            $('#modal-13-titulo').html("<h3>Nova Igreja</h3>");
            $('#modal-13-texto').html("<h5>Cadastro rápido</h5><p>Para adicionar uma nova igreja a LISTA por favor insira o nome no campo abaixo.<br><b>Ex.:Paróquia Catedral Imaculada Conceição.</b></p>");
            $('#cadastra_igreja').trigger('click');
            $('#salva-capela').attr('id','salva-igreja');
        }else if($('#capela').val()==-1){
            $('#modal-13-titulo').html("<h3>Nova Capela</h3>");
            $('#modal-13-texto').html("<h5>Cadastro rápido</h5><p>Para adicionar uma nova capela a LISTA por favor insira o nome no campo abaixo.<br><b>Ex.:Capela Sagrado Coração.</b></p>");
            $('#cadastra_igreja').trigger('click');   
            $('#salva-igreja').attr('id','salva-capela');
        }else{
            $('.passo4').fadeOut(500)
            this.interval = setTimeout(function () {
                $('.passo4').fadeIn(500)
            },
                    1500//Tempo de Espera para executar a função
                    );            
        }
    });
    $(document).on('input', '.passo4', function () {
        clearTimeout(this.interval);
        $('.passo5').fadeOut(500)
        this.interval = setTimeout(function () {
            $('.passo5').fadeIn(500)
        }, 2000);
    });
    $(document).on('click', '.passo5', function () {
        clearTimeout(this.interval);
        $('.passo6').fadeOut(500)
        this.interval = setTimeout(function () {
            $('.passo6').fadeIn(500)
        },
                3000//Tempo de Espera para executar a função
                );
    });
    
    ////////////PASSO 06
    
    $(document).on('input', '.passo6', function () {
        clearTimeout(this.interval);
        $('.passo7').fadeOut(500)
        this.interval = setTimeout(function () {
            $('.passo7').fadeIn(500)
        },
                2000//Tempo de Espera para executar a função
                );
    });
    $(document).on('input', '.passo7', function () {
        clearTimeout(this.interval);
        $('.passo8').fadeOut(500)
        this.interval = setTimeout(function () {
            $('.passo8').fadeIn(500)
        },
                2000//Tempo de Espera para executar a função
                );
    });

    $(document).on('input', '.passo8', function () {
        clearTimeout(this.interval);
        $('.passo9').fadeOut(500)
        this.interval = setTimeout(function () {
            $('.passo9').fadeIn(500)
        },
                3000//Tempo de Espera para executar a função
                );
    });
    $(document).on('input', '.passo9', function () {
        clearTimeout(this.interval);
        $('.passo10').fadeOut(500)
        this.interval = setTimeout(function () {
            $('.passo10').fadeIn(500)
        },
                3000//Tempo de Espera para executar a função
                );
    });

    $(document).on('change', '.passo10', function () {
        clearTimeout(this.interval);
        $('.passo11').fadeOut(500);
        if($('#padre').val()==-1){
            $('#modal-13-titulo').html("<h3>Novo Padre</h3>");
            $('#modal-13-texto').html("<h5>Cadastro rápido</h5><p>Para adicionar um novo padre a LISTA por favor insira o nome no campo abaixo.<br><b>Ex.:Paróquia Catedral Imaculada Conceição.</b></p>");
            $('#cadastra_igreja').trigger('click');
            $('#salva-capela').attr('id','salva-igreja');
        }else{
        }
        
        this.interval = setTimeout(function () {
            $('.passo11').fadeIn(500);
            $('.passo12').fadeIn(500);
        },
                1500//Tempo de Espera para executar a função
                );
    });





    function cadastrarIgreja(nome) {
        $.ajax({
            url: rota_salva_igreja,
            type: 'POST',
            data: {nome: nome},
            datatype: 'JSON',
            beforeSend: function () {
                $('.cadastrando').remove();                
                $('#modal-13-texto').after(
                        "<div class='cadastrando'><div class=\"preloader3 loader-block\">" +
                        "<div class=\"circ1\"></div>" +
                        "<div class=\"circ2\"></div>" +
                        "<div class=\"circ3\"></div>" +
                        "<div class=\"circ4\"></div>" +
                        "</div></div>"
                        );
            },
            success: function (data) {
                $('.cadastrando').remove();
                if(data.erro==0){
                      buscarIgreja($('#tipo').val());                    
                    $('#nome-igreja').val(null);
                      $('.md-close').trigger('click');
                }else{
                    $('#modal-13-texto').after("<div class='cadastrando'>"+data.erro+"</div>");
                }
            }

        });
    }
    function cadastrarCapela(nome) {
        $.ajax({
            url: rota_salva_capela,
            type: 'POST',
            data: {nome: nome},
            datatype: 'JSON',
            beforeSend: function () {
                $('.cadastrando').remove();                
                $('#modal-13-texto').after(
                        "<div class='cadastrando'><div class=\"preloader3 loader-block\">" +
                        "<div class=\"circ1\"></div>" +
                        "<div class=\"circ2\"></div>" +
                        "<div class=\"circ3\"></div>" +
                        "<div class=\"circ4\"></div>" +
                        "</div></div>"
                        );
            },
            success: function (data) {
                $('.cadastrando').remove();
                if(data.erro==0){
                      buscarIgreja($('#tipo').val());                    
                    $('#nome-igreja').val(null);
                      $('.md-close').trigger('click');
                }else{
                    $('#modal-13-texto').after("<div class='cadastrando'>"+data.erro+"</div>");
                }
            }

        });
    }
    function buscarIgreja(tipo) {
        $.ajax({
            url: rota_busca1,
            type: 'POST',
            data: {tipo: tipo},
            datatype: 'JSON',
            beforeSend: function () {

                $('.passo3').html(
                        "<div class=\"preloader3 loader-block\">" +
                        "<div class=\"circ1\"></div>" +
                        "<div class=\"circ2\"></div>" +
                        "<div class=\"circ3\"></div>" +
                        "<div class=\"circ4\"></div>" +
                        "</div>"
                        );
            },
            success: function (data) {
                $('.passo3').html(data.resultado);
            }

        });
    }
    function buscarFolhas_deLivro(livro) {
        $.ajax({
            url: rota_busca0,
            type: 'POST',
            data: {livro: livro},
            datatype: 'JSON',
            beforeSend: function () {
                $('.carregando').remove();
                $('.resultado0').remove();
                $('.pesquisa_livro').after(
                        "<div class=\"col-md-3 col-sm-12 ml-auto carregando\">" +
                        "<div class=\"preloader3 loader-block\">" +
                        "<div class=\"circ1\"></div>" +
                        "<div class=\"circ2\"></div>" +
                        "<div class=\"circ3\"></div>" +
                        "<div class=\"circ4\"></div>" +
                        "</div>"+
                        "</div>"
                        );
            },
            success: function (data) {
                $('.carregando').remove();
                $('.pesquisa_livro').after(data.resultado);
              
            }

        });
    }

});
</script>
@endsection