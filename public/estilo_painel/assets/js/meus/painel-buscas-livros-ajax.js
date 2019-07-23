$(document).ready(function () {

       
        
     var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token
            }
        });
        
    

    
     
        $(document).on('input','.pesquisa',function(){
            var sacramento  = $('#sacramento').val();
            var livro = $('#livro').val();
            var inicio = $('#inicio').val();
            var fim = $('#fim').val();
            
             $.ajax({
                url: "http://127.0.0.1:8000/painel/livros/pesquisar",
                type: 'POST',
                data: {
                    sacramento:sacramento,
                    livro:livro,
                    inicio:inicio,
                    fim:fim,
                },
                dataType: 'JSON',
                beforeSend: function () {
                    $('.carregando').remove();             
                    $('#livros').html(
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
        });
       
        
      
});