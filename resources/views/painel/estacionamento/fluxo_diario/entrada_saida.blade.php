@extends('painel.template.Painel-Master')

@section('conteudo')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="card badge-inverse-primary">

            <div class="card-header h4">
                Entrada
                <img src="{{asset('imagens/carro_entrada.png')}}" width="120" height="120">
            </div>

            <div class="card-body ">
                <form >
                    <div class="row">
                        <div class="col-md-8">
                            <label>Placa</label>
                            <input type="text" class="form-control form-control-primary color-class form-control-uppercase placa" maxlength="10" name="placa_entrada" id="placa_entrada" placeholder="AAA-0000">
                        </div>
                        <!--<div class="col-md-4">
                            <label>Vaga</label>
                            <input class="form-control form-control-primary" name="vaga" id="vaga">
                        </div>-->
                        <div class="col-md-4"> 
                        <button style="margin-top:26px;" class="btn btn-info" data-url="{{route('CarroEstacionado.Insert')}}" type="button" id="btn-entrar">Salvar</button>

                        </div>
                        <div class="col-md-12">
                            <div class="form-radio m-t-20">
                                <div class="radio radio-matrial radio-info radio-inline">
                                    <label>
                                        <input type="radio" value="hora" name="modalidade" checked="checked">
                                        <i class="helper"></i>Por hora
                                    </label>
                                </div>
                                <div class="radio radio-matrial radio-info radio-inline">
                                    <label>
                                        <input type="radio" value="diaria" name="modalidade" >
                                        <i class="helper"></i>Diária
                                    </label>
                                </div>
                                <div class="radio radio-matrial radio-info radio-inline">
                                    <label>
                                        <input type="radio" value="pernoite" name="modalidade" >
                                        <i class="helper"></i>Pernoite
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-radio m-t-20">
                                <div class="radio radio-matrial radio-inverse radio-inline">
                                    <label>
                                        <input type="radio" value="C" name="tipo_veiculo" checked="checked">
                                        <i class="helper"></i>Carro
                                    </label>
                                </div>
                                <div class="radio radio-matrial radio-inverse radio-inline">
                                    <label>
                                        <input type="radio" value="M" name="tipo_veiculo" >
                                        <i class="helper"></i>Moto
                                    </label>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="card badge-inverse-danger">
            <div class="card-header h4">
                Saída
                <img src="{{asset('imagens/carro_saida.png')}}" width="120" height="120">
            </div>
            <div class="card-body">
                <form>
                    <div class="body">
                        <div class="row">
                            <div class="col-md-8">
                                <select class="form-control form-control-danger" id="placa_saida">
                                    <option>Selecione uma placa...</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type='button' id='btn-pg-sair' class="btn btn-outline-primary">Pagar</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="card badge-inverse-warning">
            <div class="card-header h4">
                Mensalistas
                <img src="{{asset('imagens/mensalistas.png')}}" width="200" height="170">
            </div>
            <div class="card-body">
                <form>
                    <div class="body">
                        <div class="row">
                            <div class="col-md-8">
                                <input class='form-control form-control-warning color-class placa form-control-uppercase' id='placa_mensalista' name='placa_mensalista' placeholder="AAA-0000" type="text">
                            </div>
                            <div class="col-md-4">
                                <button type="button" id='btn-mensalidade' class="btn btn-outline-warning">Pagar</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-sm-12">
        <div class="card badge-inverse-info">
            <div class="card-header">
                <h4>Carros Estacionados</h4>              

            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table id="minha_tabela" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>Placa</th>
                                <th>Entrada</th>
                                <th>Duração</th>
                                <th>Valor</th>
                                <th>Modalidade</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody id="body_tblCARestacionados">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-4 col-sm-12'>
        
            <div class="card user-card2">
                <div class="card-block text-center">
                    <h4 class="m-b-15">Capacidade do Estacionamento</h4>
                         <div id="wrapper">
                        <svg id="meter">
                            <circle id="outline_curves" class="circle outline" 
                            cx="50%" cy="50%"></circle>
                            
                            <circle id="low" class="circle range" cx="50%" cy="50%"
                            stroke="#33b704"></circle><!--#FDE47F -->
                            
                            <circle id="avg" class="circle range" cx="50%" cy="50%"
                            stroke="#f34e07"></circle><!-- #7CCCE5 -->
                            
                            <circle id="high" class="circle range" cx="50%" cy="50%"
                            stroke="#f30707"></circle><!-- #E04644 -->
                            
                            <circle id="mask" class="circle" cx="50%" cy="50%" >
                            </circle>
                            
                            <circle id="outline_ends" class="circle outline"
                            cx="50%" cy="50%"></circle>
                        </svg>
                    <img id="meter_needle" src="{{asset('imagens/ponteiro.svg')}}" alt="">
                        <input id="slider" type="range" min="0" max="100" value="0" disabled=true />
                        <label id="lbl" id="value" for="">0</label>
                    </div>
                    <h5 class="m-b-10 m-t-10">Total de veículos</h5>
                    <h5 id='total_de_veiculos' class="text-c-yellow b-b-warning"></h5>
                    <div class="row justify-content-center m-t-10 b-t-default m-l-0 m-r-0">
                        <div class="col m-t-15 b-r-default">
                            <h6 class="text-muted">Mensalistas</h6>
                            <h6 id='mensalista'></h6>
                        </div>
                        <div class="col m-t-15">
                            <h6 class="text-muted">Rotativo</h6>
                            <h6 id='rotativo'></h6>
                        </div>
                        <div class="col m-t-15">
                            <h6 class="text-muted">Free</h6>
                            <h6 id='free'></h6>
                        </div>
                    </div>
                </div>
                <button class="btn btn-warning btn-block p-t-15 p-b-15">Abri Gaveta de Caixa</button>
            </div>
        
       
    </div>
</div>
@endsection
@section('css')
 
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">

<style>
    .pcoded-inner-content{
        background-image: url('{{asset("imagens/carro_template.png")}}') !important;
        background-repeat: no-repeat;
        background-size: 100% 100%;
        background-attachment: inherit;
    }

    .btn-delete, .btn-update, .btn-detalhes, .btn-key {
        cursor: pointer;
       
     }



#wrapper {
  position: relative;
  margin: auto;
}
#meter {
  width: 100%; height: 100%;
  transform: rotateX(180deg);
}
.circle {
  fill: none;
}
.outline, #mask {
  stroke: #F1F1F1;
  stroke-width: 65;
}
.range {
  stroke-width: 60;
}
#slider, #lbl {
  position: absolute;
}
#slider {
  cursor: pointer;
  left: 0;
  margin: auto;
  right: 0;
  top: 58%;
  width: 94%;
}
#lbl {
  background-color: #4B4C51;
  border-radius: 2px;
  color: white;
  font-family: 'courier new';
  font-size: 15pt;
  font-weight: bold;
  padding: 4px 4px 2px 4px;
  right: -48px;
  top: 57%;
}
#meter_needle {
  height: 40%;
  left: 0;
  margin: auto;
  position: absolute;
  right: 0;
  top: 10%;
  transform-origin: bottom center;
  /*orientation fix*/
  transform: rotate(270deg);
}

</style>
@endsection

@section('javascript')
<!-- data-table js -->
<script src="{{asset('estilo_painel/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('estilo_painel/assets/pages/data-table/js/jszip.min.js')}}"></script>
<script src="{{asset('estilo_painel/assets/pages/data-table/js/pdfmake.min.js')}}"></script>
<script src="{{asset('estilo_painel/assets/pages/data-table/js/vfs_fonts.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('estilo_painel/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

<!-- Custom js 
<script src="{{asset('estilo_painel/assets/js/pcoded.min.js')}}"></script>
<script src="{{asset('estilo_painel/assets/js/vartical-layout.min.js')}}"></script>
<script src="{{asset('estilo_painel/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/assets/js/script.js')}}"></script>-->
<script src="{{asset('estilo_painel/assets/pages/data-table/js/data-table-custom.js')}}"></script>
<script src="{{asset('estilo_painel/assets/js/meus/estacionamento/dashboard.js')}}"></script>

<script>
url_busca="{{route('CarrosEstacionados.Visualizar')}}";
url_delete="{{route('CarrosEstacionados.Delete')}}";
url_update="{{route('CarrosEstacionados.Update')}}";
url_buscar_pessoas="{{route('Listar.Pessoas')}}";
url_busca_telefone = "{{route('Fetch.Telefone')}}";
url_save_more_informations="{{route('Carros.Update')}}";
url_busca_carro="{{route('Carros.Fetch')}}";
url_busca_preco_mensalidade="{{route('Preco.Fetch')}}";
url_calc="{{route('Carro.CalcEstaciomaneto')}}";
url_keyGeneration = "{{route('CarrosEstacionados.Key')}}";
url_checkingKey = "{{route('CarrosEstacionados.CheckingKey')}}";
renovar_mensalidade = "{{route('Mensalidade.Renovar')}}";
</script>
<script>
/* Set radius for all circles */
var r = 80;
var circles = document.querySelectorAll('.circle');
var total_circles = circles.length;
for (var i = 0; i < total_circles; i++) {
    circles[i].setAttribute('r', r);
}
 
/* Set meter's wrapper dimension */
var meter_dimension = (r * 2) + 100;
var wrapper = document.querySelector("#wrapper");
wrapper.style.width = meter_dimension + "px";
wrapper.style.height = meter_dimension + "px";
 
/* Add strokes to circles  */
var cf = 2 * Math.PI * r;
var semi_cf = cf / 2;
var semi_cf_1by3 = semi_cf / 3;
var semi_cf_2by3 = semi_cf_1by3 * 2;
document.querySelector("#outline_curves")
    .setAttribute("stroke-dasharray", semi_cf + "," + cf);
document.querySelector("#low")
    .setAttribute("stroke-dasharray", semi_cf + "," + cf);
document.querySelector("#avg")
    .setAttribute("stroke-dasharray", semi_cf_2by3 + "," + cf);
document.querySelector("#high")
    .setAttribute("stroke-dasharray", semi_cf_1by3 + "," + cf);
document.querySelector("#outline_ends")
    .setAttribute("stroke-dasharray", 2 + "," + (semi_cf - 2));
document.querySelector("#mask")
    .setAttribute("stroke-dasharray", semi_cf + "," + cf);
 
/* Bind range slider event*/
var slider = document.querySelector("#slider");
var lbl = document.querySelector("#lbl");
var mask = document.querySelector("#mask");
var meter_needle =  document.querySelector("#meter_needle");
 
function range_change_event(per) {
    //var percent = slider.value;
    var percent = per;
    var meter_value = semi_cf - ((percent * semi_cf) / 100);
    mask.setAttribute("stroke-dasharray", meter_value + "," + cf);
    meter_needle.style.transform = "rotate(" + 
        (270 + ((percent * 180) / 100)) + "deg)";
    lbl.textContent = percent + "%";
}
//slider.addEventListener("input", range_change_event);
    </script>
@endsection