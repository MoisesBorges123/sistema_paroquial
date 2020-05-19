
@extends('painel.template.Painel-Master')

@section('conteudo')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 m-b-20">
        <div class="row">
           
            
        </div>
    </div>    
    <div class="col-sm-12">        
        <div class="card">
            <div class='card-header bg-inverse'>
                <div class='row'>
                    <div class='col-3'>
                        <h4 class='text-white'>Cartas Dizimistas</h4>
                    </div>
                    <div class="col-md-2">                
                        <button data-modal="modal-5" class="btn btn-out btn-inverse btn-square waves-effect md-trigger"><i class="icofont icofont-exchange"></i>Imprimir Selecionados</button>
                    </div>
                </div>
            </div>
            <div class="card-block table-border-style">
                <div class="table-responsive">
                    <table id="minha_tabela" class="table table-striped table-bordered nowrap">
                        @if(empty($query->all()))
                        <div class="alert">
                            <div class="alert-default">
                                <h5 class="text-inverse">Nenhum dizimista cadastrado.</h5>
                            </div>
                        </div>
                        @else
                        <thead>
                            <tr>                           
                                <th id='print'> 
                                    <div class="border-checkbox-section">
                
                                    <div class="border-checkbox-group border-checkbox-group-success">
                                        <input class="border-checkbox" id='print_all' type="checkbox" id="print_all">
                                        <label class="border-checkbox-label" id='print' for="print_all">Selecionar Todos</label>
                                    </div>
                                    
                                </div>
                            </th>
                                <th class="text-center">Nome</th>                                                   
                                <th class="text-center">Mês Aniversário</th>                                                   
                                <th class="text-center">Data Nascimento</th>                                
                                <th class="text-center">Ações</th>                                
                            </tr>
                        </thead>
                        <tbody id='body_tbl_Dizimistas'></tbody>
                        @endif
                    </table>
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
                            <form method="get" id='form-printer' action="" target="_blank" >                               
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
                                        <button type="button" id='btn-imprimir'  class="btn btn-primary waves-effect">Imprimir</button>                                            
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
<!-- Custom js -->
<script src="{{asset('estilo_painel/assets/pages/data-table/js/data-table-custom.js')}}"></script>


     <script type='text/javascript'>
    woli = "{{asset('imagens/woli.png')}}";
    url_busca_table ="{{route('MontaTable.Dizimistas.Aniversariantes')}}";
    url_imprimir = "{{route('Print.Dizimistas.Aniversariantes')}}";
</script>
<script src="{{asset('estilo_painel\assets\js\meus\dizimo\painel-tbl-cartas-aniversario.js')}}"></script>

@endsection