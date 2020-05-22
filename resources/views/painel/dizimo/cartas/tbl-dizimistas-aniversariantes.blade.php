
@extends('painel.template.Painel-Master')

@section('conteudo')
<div class="row">
    @if(session('mensagem'))
    <div class="col-lg-12 col-md-12 col-sm-12">        
        <div class='alert'>
        <div class='alert alert-{{session('tipo')}}'><h3><b>Alerta!</b></h3><br>{!!session('mensagem')!!}</div>
        </div>
    </div>    
    @endif
    <div class="col-sm-12">        
        <div class="card">
            <div class='card-header bg-inverse'>
                <div class='row'>
                    <div class='col-4' id='loader'> 
                        <div class="loader-block">
                            <h4 class='text-white'>Carregando Dados</h4>
                            <svg id="loader2" viewBox="0 0 100 100">
                                <circle id="circle-loader2" cx="50" cy="50" r="45"></circle>
                            </svg>
                        </div>
                    </div>
                    <div class='col-3'>
                        <h4 class='text-white'>Cartas Dizimistas</h4>
                    </div>
                    <div class="col-3">                
                        <button data-modal="modal-5" class="btn btn-out btn-inverse btn-square waves-effect md-trigger"><i class="icofont icofont-printer"></i>Imprimir Selos</button>
                    </div>
                    <div class="col-2">                
                        <button type="button" id='btn-carta-devolvida' class="btn btn-out btn-inverse btn-square"><i class="icofont icofont-letter"></i>Cartas Devolvidas</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
              <div class='row'>
                <div class="col-xl-4 col-md-6">
                    <div class="card social-card bg-simple-c-blue">
                        <div class="card-block">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <i class="feather icon-mail f-34 text-c-blue social-icon"></i>
                                </div>
                                <div class="col">
                                    <h6 class="m-b-0">Envio de Cartas</h6>
                                    <p>Mês de ?</p>
                                    <p class="m-b-0">Cartas Enviadas: 100</p>
                                    <p class="m-b-0">Cartas Retornadas: 09</p>
                                                                    </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-xl-9 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Sales Analytics</h5>
                            <span class="text-muted">For more details about usage, please refer <a href="https://www.amcharts.com/online-store/" target="_blank">amCharts</a> licences.</span>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="feather icon-maximize full-card"></i></li>
                                    <li><i class="feather icon-minus minimize-card"></i></li>
                                    <li><i class="feather icon-trash-2 close-card"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block">
                            <div style="height: 265px;">
                                <canvas id="canvas"></canvas>
                            </div>
                            
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>



            <!--MODAL-->
            <div class="animation-model">
                <div class="md-modal md-effect-5" id="modal-5">
                    <div class="md-content">
                        <h3><i class="icofont icofont-printer text-white"></i>&nbsp;&nbsp;Imprimir...</h3>
                        <div>
                            <p class='lead'>Selecione o mês de aniversário que você deseja imprimir.</p>
                            <form method="get" id='form-printer' action="{{route('Print.Dizimistas.Aniversariantes')}}" target="_blank" >                               
                                <div class='row justify-content-center'>                                        
                                    <div class='col-md-4'>
                                    <label>Mês</label>                               
                                    <select name='mes' id='id_mes' class='form-control'>                                        
                                        <option value='1'>Janeiro</option>
                                        <option value='2'>Fevereiro</option>
                                        <option value='3'>Março</option>
                                        <option value='4'>Abril</option>
                                        <option value='5'>Maio</option>
                                        <option value='6'>Junho</option>
                                        <option value='7'>Julho</option>
                                        <option value='8'>Agosto</option>
                                        <option value='9'>Setembro</option>
                                        <option value='10'>Outubro</option>
                                        <option value='11'>Novembro</option>
                                        <option value='12'>Dezembro</option>
                                    </select>  
                                    </div>
                              
                                </div>
                                <div class='row justify-content-center m-t-30'>
                                    <div class='col-md-4'>
                                        <button type="submit" id='btn-imprimir'  class="btn btn-primary waves-effect">Imprimir</button>                                            
                                    </div>
                                    <div class='col-md-4'>
                                        <button type="button" id='btn-sair' class="btn btn-danger waves-effect md-close">Sair</button>                                            
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
@endsection



@section('css')
    <style>
        canvas{
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
	</style>
<!-- animation nifty modal window effects css -->
<link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/css/component.css')}}">
   <!-- Data Table Css -->
   <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
     @endsection
     
     
     
     @section('javascript')

<!-- modalEffects js nifty modal window effects -->
<script type="text/javascript" src="{{asset('estilo_painel/assets/js/modalEffects.js')}}"></script>
<script type="text/javascript" src="{{asset('estilo_painel/assets/js/classie.js')}}"></script>
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
 <!-- Chart js -->
 <script type="text/javascript" src="{{asset('estilo_painel/bower_components/chart.js/js/Chart.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('estilo_painel/bower_components/chart.js/js/utils.js')}}"></script>
 <!-- amchart js -->
 <script src="{{asset('estilo_painel/assets/pages/widget/amchart/amcharts.js')}}"></script>
 <script src="{{asset('estilo_painel/assets/pages/widget/amchart/serial.js')}}"></script>
 <script src="{{asset('estilo_painel/assets/pages/widget/amchart/light.js')}}"></script>
 <script src="{{asset('estilo_painel/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('estilo_painel/assets/js/SmoothScroll.js')}}"></script>
 <script src="{{asset('estilo_painel/assets/js/pcoded.min.js')}}"></script>

<!-- Custom js -->
<script src="{{asset('estilo_painel/assets/pages/data-table/js/data-table-custom.js')}}"></script>


     <script type='text/javascript'>
    woli = "{{asset('imagens/woli.png')}}";
    url_busca_table ="{{route('MontaTable.Dizimistas.Aniversariantes')}}";
    url_devolver_carta="{{route('Devolver.Carta')}}";
    
</script>
<script src="{{asset('estilo_painel\assets\js\meus\dizimo\painel-tbl-cartas-aniversario.js')}}"></script>
<script>
    var MONTHS = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
    var config = {
        type: 'line',
        data: {
            labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho',],
            datasets: [{
                label: 'Cartas Devolvidas',
                backgroundColor: window.chartColors.red,
                borderColor: window.chartColors.red,
                data: [
                    10,
                    20,
                    30,
                    50,
                    7,
                    90,
                    101
                ],
                fill: false,
            }, {
                label: 'Cartas',
                fill: false,
                backgroundColor: window.chartColors.blue,
                borderColor: window.chartColors.blue,
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ],
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Grafico de cartas devolvidas'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Mês'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Valores'
                    }
                }]
            }
        }
    };

    window.onload = function() {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = new Chart(ctx, config);
    };

    document.getElementById('randomizeData').addEventListener('click', function() {
        config.data.datasets.forEach(function(dataset) {
            dataset.data = dataset.data.map(function() {
                return randomScalingFactor();
            });

        });

        window.myLine.update();
    });

    var colorNames = Object.keys(window.chartColors);
    document.getElementById('addDataset').addEventListener('click', function() {
        var colorName = colorNames[config.data.datasets.length % colorNames.length];
        var newColor = window.chartColors[colorName];
        var newDataset = {
            label: 'Dataset ' + config.data.datasets.length,
            backgroundColor: newColor,
            borderColor: newColor,
            data: [],
            fill: false
        };

        for (var index = 0; index < config.data.labels.length; ++index) {
            newDataset.data.push(randomScalingFactor());
        }

        config.data.datasets.push(newDataset);
        window.myLine.update();
    });

    document.getElementById('addData').addEventListener('click', function() {
        if (config.data.datasets.length > 0) {
            var month = MONTHS[config.data.labels.length % MONTHS.length];
            config.data.labels.push(month);

            config.data.datasets.forEach(function(dataset) {
                dataset.data.push(randomScalingFactor());
            });

            window.myLine.update();
        }
    });

    document.getElementById('removeDataset').addEventListener('click', function() {
        config.data.datasets.splice(0, 1);
        window.myLine.update();
    });

    document.getElementById('removeData').addEventListener('click', function() {
        config.data.labels.splice(-1, 1); // remove the label first

        config.data.datasets.forEach(function(dataset) {
            dataset.data.pop();
        });

        window.myLine.update();
    });
</script>
@endsection