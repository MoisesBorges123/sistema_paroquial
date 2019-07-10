
@extends('painel.template.Painel-Master')



@section('conteudo')
<div class="row">
    <div class="col-sm-12 col-md-10">
        
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
        <form method="post" class="form" action="{{route('Cadastrar.Batizado')}}">
            {!! csrf_field() !!}
            <div class="form-group row">
                <div class="col-md-8 col-sm-12">
                    <label>*Criança</label>
                    <input type="text" name='batizando' class="form-control form-control-md" placeholder="Nome completo">
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
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Livro</label>
                        <select class="form-control" name="tipo" id="choosebook">
                            <option value="">Selecione a categoria do livro</option>
                            @foreach($livros->all() as $livro)
                            <option value="{{$livro->id_livros_registros}}">{{$livro->numero}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
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
    <link rel="stylesheet" type="text/css" href="..\files\bower_components\datedropper\css\datedropper.min.css">
@endsection

@section('javascript')
 <script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next/js/i18next.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/jquery-i18next/js/jquery-i18next.min.js')}}"></script>
    <script src="{{asset('estilo_painel/assets/js/pcoded.min.js')}}"></script>
   <!-- <script src="{{asset('estilo_painel/assets/js/vartical-layout.min.js')}}"></script> -->
    <script src="{{asset('estilo_painel/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    
<script>
    $(document).ready(function(){
        
        
            
        $(document).on('change','#choosebook',function(){
            
            buscarPaginas($('#choosebook').val());
        });
        
        function buscarPaginas(livro){
            $.ajax({
                    url:"{{route('Buscar.PageLivroRegistro')}}",
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