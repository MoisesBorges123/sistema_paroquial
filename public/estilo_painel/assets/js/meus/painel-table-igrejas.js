$(document).ready(function () {

     var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token
            }
        });
        
    function busca_igreja(igreja){
         $.ajax({
                url: "http://127.0.0.1:8000/painel/igreja/busca",
                type: 'POST',
                data: {
                    igreja:igreja,
                },
                dataType: 'JSON',
                beforeSend: function () {
                    $('.carregando').remove();                    
                    $('#step1').after(
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
                success: function(data){
                    $('.carregando').remove();
                    $('#step1').after(data.resultadoHTML);
                    $('#titulo').html("2-Insira os dados da nova folha.");
                    $('#botoes').append(data.btn_avancar_HTML);
                    
                }
            });
    }
        
});

