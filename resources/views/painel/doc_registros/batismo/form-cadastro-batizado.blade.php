
@extends('painel.template.Painel-Master')



@section('conteudo')
<div class="row" id='fundo_folha'>
    <div class="col-sm-12 col-md-12">
        
            @if(isset($errors) && count($errors)>0)
                <div class="alert alert-danger">
                @foreach($errors->all() as $erro)
                <p>{{$erro}}</p>
                @endforeach
                </div>
            @endif
            
            @if(Session::has('resposta'))
            <div class="alert alert-{{Session::get('tipo')}}">
                <p>{!!Session::get('resposta')!!}</p>
            </div>
            @endif
        <form method="post" class="form" action="">
            {!! csrf_field() !!}
            <div class="form-group row m-t-10">
                <div class="col-md-1 col-sm-1 p-t-5 p-r-0 text-right">
                    <label class='h4 '>Aos</label>                    
                </div>
                <div class="col-md-3 col-sm-5 p-r-0 ">
                    <input id="dropper-lang" class="form-control" type="text" placeholder="Data do Batizado" readonly="readonly">                
                </div>
                <div class="col-md-1 col-sm-1 p-t-5 p-r-0 p-l-0 text-center">
                    <label class='h4 '>na</label>                    
                </div>
                <div class="col-md-3 col-sm-5  p-l-0">
                    <select class='form-control' name='capela_paroquia'>
                        <option value='1'>Capela</option>
                        <option value='2'>Paróquia</option>
                    </select>
                </div>
                <div class="col-md-4 col-sm-12  p-l-0">
                    <select class='form-control' name='capela_paroquia'>
                        <option value=''>- Selecione a Capela -</option>                 
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 col-sm-6 p-t-6 p-r-0 text-center">
                    <label class='h4'>Batizei solenemente</label>                    
                </div>
                <div class="col-md-9 col-sm-6 p-l-0">                    
                    <input type="text" name='batizando' class="form-control form-control-md" placeholder="Nome da criança">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-1 col-sm-4 p-t-6 p-r-0 text-center">
                    <label class='h4'>Filho de</label>                    
                </div>
                <div class="col-md-4 col-sm-6 p-l-0 p-r-0">                    
                    <input type="text" name='batizando' class="form-control form-control-md" placeholder="Nome do pai">
                </div>
                <div class="col-md-1 col-sm-3 p-t-6 p-r-0 text-center">
                    <label class='h4'>e de</label>                    
                </div>
                <div class="col-md-4 col-sm-6 p-l-0 ">                    
                    <input type="text" name='batizando' class="form-control form-control-md" placeholder="Nome da mãe">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-8 col-sm-12">
                    <label>*Pai</label>
                    <input type="text" name='pai' class="form-control form-control-md" placeholder="Nome completo">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-8 col-sm-12">
                    <label>*Mãe</label>
                    <input type="text" name='mae' class="form-control form-control-md" placeholder="Nome completo">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-8 col-sm-12">
                    <label>Padrinho</label>
                    <input type="text" name='padrinho' class="form-control form-control-md" placeholder="Nome completo">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-8 col-sm-12">
                    <label>Madrinha</label>
                    <input type="text" name='madrinha' class="form-control form-control-md" placeholder="Nome completo">
                </div>
            </div>
           
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">                        
                        <label>Data Nascimento</label>
                        <input type="date" name='data_nascimento' class="form-control form-control-md" placeholder="Nome completo">
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Data Batizado</label>
                        <input type="date" name='data_batizado' class="form-control form-control-md" placeholder="Nome completo">
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-md-4 col-sm-12" id="pagina">
                    <div class="preloader3 loader-block load fade">
                        <div class="circ1 loader-primary loader-md"></div>
                        <div class="circ2 loader-primary loader-md"></div>
                        <div class="circ3 loader-primary loader-md"></div>
                        <div class="circ4 loader-primary loader-md"></div>
                    </div>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-md-8 col-sm-12">
                    <textarea name="observacao" class="form-control" placeholder="Descrição" rows="5"></textarea>
                </div>
            </div>
            <button type="submit" class='btn btn-info'>Cadastrar</button>
        </form>
    </div>
    
</div>
@endsection


@section('css')
    <!-- Date-Dropper css -->
    <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/datedropper/css/datedropper.min.css')}}">
    <style>
        #fundo_folha{
            background-image: url("{{asset('estilo_painel/assets/images/sistema/folha_velha.jpg')}}");
            background-size: 100% 100%;
        
        }
        #p-t-5{
            padding-top: 5px !important;
        }
    </style>
@endsection

@section('javascript')
 <script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next/js/i18next.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/jquery-i18next/js/jquery-i18next.min.js')}}"></script>
    <script src="{{asset('estilo_painel/assets/js/pcoded.min.js')}}"></script>
   <!-- <script src="{{asset('estilo_painel/assets/js/vartical-layout.min.js')}}"></script> -->
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
    <script type="text/javascript" src="{{asset('estilo_painel/assets/pages/advance-elements/custom-picker.js')}}"></script
<script>
    $(document).ready(function(){
        
        
            
        $(document).on('change','#choosebook',function(){
            
            buscarPaginas($('#choosebook').val());
        });
        
        function buscarPaginas(livro){
            $.ajax({
                    url:",/phpfd.php",
                    type: 'GET',
                    datatype:'json',
                    data:{livro:livro},
                    beforeSend:function(){                       
                        
                        $('.load').removeClass('fade');
                    },
                    success:function(data){
                        $('.load').addClass('fade');
                        $('#pagina').html(data.resultado);
                    }
                    
            });
        }
        
    });
</script>
@endsection