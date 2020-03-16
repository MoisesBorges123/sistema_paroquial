
@extends('painel.template.Painel-Master')

@section('conteudo')
<!-- Verticle Wizard card start -->
<div class="card">
    <div class="card-header">
        <h4>Cadastrar Tabela de Preços</h4>


    </div>
    <div class="card-block">
        <div class="row">
            <div class="col-md-12">
                <div id="wizard2">
                    <section>
                        <form class="wizard-form" id="tbl-preco" action="{{route('Salvar.Tbl_de_precos')}}">
                            <h3> Valor 01 Hora </h3>
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="carro-hora" class="block">R$ (Hora - Carro)</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="carro-hora" name="carro_hora" type="text" class="money2 form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="moto_hora" class="block">R$ (Hora - Moto)</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="moto_hora" name="moto_hora" type="text" class=" form-control money2">
                                    </div>
                                </div>                                                                                
                            </fieldset>
                            <h3> Valor de 15min a 30min </h3>
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="carro_15_30" class="block">R$ (15min a 30min - Carro)</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="carro_15_30" name="carro_15_30" type="text" class="form-control money2">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="moto_15_30" class="block">R$ (15min a 30min - Moto)</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="moto_15_30" name="moto_15_30" type="text" class="form-control money2">
                                    </div>
                                </div>                                                                                
                            </fieldset>
                            <h3> Valor de 01min a 15min</h3>
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="carro_01_15" class="block">R$ (01min a 15min - Carro)</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="carro_01_15" name="carro_01_15" type="text" class="form-control money2">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="moto_01_15" class="block">R$ (01min a 15min - Moto)</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="moto_01_15" name="moto_15_30" type="text" class="form-control money2">
                                    </div>
                                </div>
                            </fieldset>
                            <h3>Diária</h3>
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="diaria_carro" class="block">Carro</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="diaria_carro" name="diaria_carro" type="text" class="money2 form-control required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="diaria_moto" class="block">Moto</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="diaria_moto" name="diaria_moto" type="text" class="money2 form-control required">
                                    </div>
                                </div>                                                                                
                            </fieldset>
                            <h3>Pernoite</h3>
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="pernoite_carro" class="block">Carro</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="pernoite_carro" name="pernoite_carro" type="text" class="money2 form-control required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="pernoite_moto" class="block">Moto</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="diaria_moto" name="pernoite_moto" type="text" class="form-control required money2">
                                    </div>
                                </div>                                                                                
                            </fieldset>
                            <h3>Mensalidade</h3>
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="mensalidade_carro" class="block">Carro</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="mensalidade_carro" name="mensalidade_carro" type="text" class="form-control required money2">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="mensalidade_moto" class="block">Moto</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="diaria_moto" name="mensalidade_moto" type="text" class="form-control required money2">
                                    </div>
                                </div>                                                                                
                            </fieldset>
                            <h3>Observações</h3>
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="obs_tbl" class="block">Descrição</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea id="obs_tbl"  name="obs_tbl" class="form-control"></textarea>
                                        {!!csrf_field()!!}
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
@endsection

@section('css')
<!--forms-wizard css-->
<link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/jquery.steps/css/jquery.steps.css')}}">
@endsection

@section('javascript')
<!--Forms - Wizard js-->
<script src="{{asset('estilo_painel/bower_components/jquery.cookie/js/jquery.cookie.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/jquery.steps/js/jquery.steps.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/jquery-validation/js/jquery.validate.js')}}"></script>
<!-- Validation js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script type="text/javascript" src="{{asset('estilo_painel/assets/pages/form-validation/validate.js')}}"></script>
<!-- Custom js -->
<script src="{{asset('estilo_painel/assets/pages/forms-wizard-validation/form-wizard.js')}}"></script>
<script src="{{asset('estilo_painel/assets/js/pcoded.min.js')}}"></script>
<script src="{{asset('estilo_painel/assets/js/vartical-layout.min.js')}}"></script>
<script src="{{asset('estilo_painel/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/assets/js/script.js')}}"></script>
<script>
    url_salvar_tbl = "{{route('Salvar.Tbl_de_precos')}}";
    url_tbl_precos="{{route('Visualizar.Tbl_de_Precos')}}"
$(document).ready(function () {
    $('#tbl-preco').steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "slide",
        stepsOrientation: "vertical",
        autoFocus: true,
        onFinished: function (event, currentIndex){            
            return fetch(url_salvar_tbl,{
              method:'POST',
              credentials: "same-origin",
              body: new FormData(document.getElementById('tbl-preco'))
            }).then((result)=>{
                  
                if(!result.ok){
                  Swal.fire({
                              position: 'top-end',
                              icon: 'error',
                              title: 'Não foi possível comunicar com o servidor',
                              showConfirmButton: false,
                              timer: 1500
                            })
                }else{
                    return result.json();
                }
            }).then((resultado)=>{
                if(resultado){
                    Swal.fire({
                              position: 'top-end',
                              icon: 'success',
                              title: 'Dados atualizados',
                              showConfirmButton: false,
                              timer: 2000
                            });
                            setTimeout(function(){
                                window.location.href=url_tbl_precos;
                            },2500);
                }
                
            })
        }
    
  
    
    });
    
});
    $(document).on('input', '.money2', function () {
        $('.money2').mask("#.##0,00", {reverse: true});
    });
    
</script>
@endsection