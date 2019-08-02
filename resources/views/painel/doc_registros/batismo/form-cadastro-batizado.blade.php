
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
                    <select class='form-control' name='capela_paroquia'>
                        <option value='1'>Capela</option>
                        <option value='2'>Paróquia</option>
                    </select>
                </div>
                <div class="col-md-4 col-sm-12  p-l-0 passo3">
                    <select class='form-control' name='capela_paroquia'>
                        <option value=''>- Selecione a Capela -</option>  
                         <option>Outra</option>
                    </select>
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
                         <option>Outro</option>
                        
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
                    <button type="submit" class='btn btn-info'>Salvar</button>                    
                </div>
            </div>
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
          /*  padding-top: 5px !important;*/
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
    <script type="text/javascript" src="{{asset('estilo_painel/assets/pages/advance-elements/custom-picker.js')}}"></script>
<script>
    $(document).ready(function(){
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
        rota_busca1="{{route('Pesquisa_Igreja.Batizado')}}"
       $(document).on('click','.passo1',function(){
           clearTimeout(this.interval);
           $('.passo2').fadeOut(500)
           this.interval = setTimeout(function(){$('.passo2').fadeIn(500)},3000);
       }) ;
       $(document).on('change','.passo2',function(){
           clearTimeout(this.interval);
           $('.passo3').fadeOut(500)
           this.interval = setTimeout(function(){
                                           $('.passo3').fadeIn(500)},
                                           1500//Tempo de Espera para executar a função
                                       );
       }) ;
       $(document).on('change','.passo3',function(){
           clearTimeout(this.interval);
           $('.passo4').fadeOut(500)
           this.interval = setTimeout(function(){
                                           $('.passo4').fadeIn(500)},
                                           1500//Tempo de Espera para executar a função
                                       );
       }) ;
       $(document).on('input','.passo4',function(){
           clearTimeout(this.interval);
           $('.passo5').fadeOut(500)
           this.interval = setTimeout(function(){$('.passo5').fadeIn(500)},2000);
       }) ;
       $(document).on('click','.passo5',function(){
           clearTimeout(this.interval);
           $('.passo6').fadeOut(500)
           this.interval = setTimeout(function(){
                                           $('.passo6').fadeIn(500)},
                                           3000//Tempo de Espera para executar a função
                                       );
       }) ;
       $(document).on('input','.passo6',function(){
           clearTimeout(this.interval);
           $('.passo7').fadeOut(500)
           this.interval = setTimeout(function(){
                                           $('.passo7').fadeIn(500)},
                                           2000//Tempo de Espera para executar a função
                                       );
       }) ;
       $(document).on('input','.passo7',function(){
           clearTimeout(this.interval);
           $('.passo8').fadeOut(500)
           this.interval = setTimeout(function(){
                                           $('.passo8').fadeIn(500)},                                           
                                           2000//Tempo de Espera para executar a função
                                       );
       }) ;
       
       $(document).on('input','.passo8',function(){
           clearTimeout(this.interval);
           $('.passo9').fadeOut(500)
           this.interval = setTimeout(function(){
                                           $('.passo9').fadeIn(500)},
                                           3000//Tempo de Espera para executar a função
                                       );
       }) ;
       $(document).on('input','.passo9',function(){
           clearTimeout(this.interval);
           $('.passo10').fadeOut(500)
           this.interval = setTimeout(function(){
                                           $('.passo10').fadeIn(500)},
                                           3000//Tempo de Espera para executar a função
                                       );
       }) ;
       
       $(document).on('change','.passo10',function(){
           clearTimeout(this.interval);
           $('.passo11').fadeOut(500)
           this.interval = setTimeout(function(){
                                           $('.passo11').fadeIn(500);
                                           $('.passo12').fadeIn(500);},
                                           1500//Tempo de Espera para executar a função
                                       );
       }) ;
       
       
       
        
        
        function buscarIgreja(tipo){
            $.ajax({
                    url:rota_busca1,
                    type: 'POST',
                    datatype:'json',
                    data:{tipo:tipo},
                    beforeSend:function(){                       
                        
                        $('.passo2').html(
                        "<div class='text-left col-md-12 col-sm-12 carregando'>"+
                            "<div class=\"preloader3 loader-block\">"+
                                    "<div class=\"circ1\"></div>"+
                                    "<div class=\"circ2\"></div>"+
                                    "<div class=\"circ3\"></div>"+
                                    "<div class=\"circ4\"></div>"+
                            "</div>"+
                        "</div>"
                        );
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