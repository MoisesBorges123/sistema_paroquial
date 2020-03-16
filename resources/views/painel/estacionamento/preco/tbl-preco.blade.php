@extends('painel.template.Painel-Master')

@section('conteudo')
<div class="row">   
    <div class="col-md-12 col-sm-12">
        <div class="card badge-inverse-info">
            <div class="card-header">
                <h4>Carros Estacionados</h4>              

            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table id="carros_estacionados" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>Data Vigência</th>
                                <th>Veículo</th>
                                <th>Tempo</th>
                                <th>Valor</th>
                                <th>Computador</th>
                                <th>Usuario</th>
                            </tr>
                        </thead>
                        <tbody>                            
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                            </tr>
                            
                            
                        </tbody>
                        <tfoot>
                            
                        </tfoot>
                    </table>
                </div>
            </div>
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
<!-- Custom js -->
<script src="{{asset('estilo_painel/assets/pages/data-table/js/data-table-custom.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#placa_saida').select2();
        $('#placa_entrada').mask('AAA-0A00');
        carregar_tbl_car_estacionados = "{{route('CarrosEstacionados.Visualizar')}}";
        
        $(document).on('click','#btn-entrar',function(){
            if($('#placa_entrada').val()==null || $('#placa_entrada').val()==""){
                Swal.fire('Ops!','Você precisa informar a placa do veiculo.','warning');
            }else{
                var modalidade = $("input[name='modalidade']:checked").val();
                var tipo_veiculo = $("input[name='tipo_veiculo']:checked").val();
                var placa = $('#placa_entrada').val();
            $.ajax({
                url:estacionar_carro,
                data:{placa:placa,modalidade:modalidade,tipo_veiculo:tipo_veiculo},
                beforeSend:function(){
                    
                },
                success:function(data){
                    
                }
            });
        }
        });
        
        $('#scr-vrt-dt').DataTable({
            "scrollY": "200px",
            "scrollCollapse": true,
            "paging": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: busca_carros_estacionados,
                type: "POST"
            },
           
        });
    });
</script>
@endsection