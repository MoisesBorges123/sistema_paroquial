
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
                                    <i class="icofont icofont-letterbox f-54 text-c-blue social-icon"></i>
                                </div>
                                <div class="col">
                                    <h6 class="m-b-0">Envio de Cartas</h6>
                                    <p>Mês de <span id='nomeMes'></span></p>
                                    <p class="m-b-0">Cartas Enviadas: <span id='qtdeEviadas'></span></p>
                                    <p class="m-b-0">Cartas Retornadas: <span id='qtdeRetornadas'></span></p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-xl-8 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Grafico devolução de cartas</h5>
                            <span class="text-muted">Demonstrativo de cartas que retornaram ao remetente no periodo de 1 ano.</span>
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
                <div class='co-xl-12 col-md-12'>
                    <div class="dt-responsive table-responsive" id="mytable">
                        <table id="minha_tabela" class="table table-striped table-bordered nowrap">   
                            <thead id='tb_cabeca'>
                                <tr>
                                    <th>Nome</th>
                                    <th class="text-center">Telefone</th>                                                   
                                    <th class="text-center">Endereço</th>                                                                                                                       
                                    <th class="text-center">Ações</th>                                
                                </tr>
                            </thead>
                            <tbody id='body_tbl_Dizimistas'></tbody>
                      
                            
                        </table>
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
    url_dashboard="{{route('Dashboard.Cartas.Dizimistas')}}";
    
    </script>

    <script src="{{asset('estilo_painel\assets\js\meus\dizimo\painel-tbl-cartas-aniversario.js')}}"></script>
@endsection