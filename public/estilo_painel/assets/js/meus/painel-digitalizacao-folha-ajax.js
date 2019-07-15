$(document).ready(function () {

       
        
     var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token
            }
        });
        
    

        // open file upload on upload button click
        $(document).on('click','#mostra-foto', function() {
          $('#foto-livro').trigger('click');
        });

        // populate preview
        $(document).on('change','#foto-livro', function() {
            var $input = $('#foto-livro');
            var $preview = $('#mostra-foto');
            var reader = new FileReader();
              reader.addEventListener('loadstart',function(){
                  $('#mostra-foto').html("<div class='loader animation-start'>"
                                                +"<span class='circle delay-1 size-2'></span>" 
                                                +"<span class='circle delay-2 size-4'></span>" 
                                                +"<span class='circle delay-3 size-6'></span>" 
                                                +"<span class='circle delay-4 size-7'></span>" 
                                                +"<span class='circle delay-5 size-7'></span>" 
                                                +"<span class='circle delay-6 size-6'></span>" 
                                                +"<span class='circle delay-7 size-4'></span>" 
                                                +"<span class='circle delay-8 size-2'></span>" 
                                            +"</div>"
                                        );
              });
              reader.addEventListener('loadend',function(){
                  $('#carrega-foto').remove();                  
              });
              reader.addEventListener('error',function(){
                  $('#mostra-foto').html(reader.error);
                  $('#carrega-foto').remove();         
              });
              reader.addEventListener('load', function() {
                $('#mostra-foto').html('');
                $preview.css('background', `url(${reader.result})`);
                $preview.css('background-size', '100% 100%');
              });
              reader.readAsDataURL($input.get(0).files[0]);
              $('.buttons').removeClass('fade');
        });
        
        $(document).on('click','#btn-deleta-foto',function(){
           $('#foto-livro').val(null);
           $('#mostra-foto').css('background','#e8e8e1');
           $('#mostra-foto').html("<i class=\"icofont icofont-cloud-upload\" style='font:35px;'></i> <div style='font:35px;'>Fazer Upload</div>");
           $('.buttons').addClass('fade');
        });
        $(document).on('click','.sair',function(){
            window.location.href="http://127.0.0.1:8000/";
        });
        
        $(document).on('change','#sacramento',function(){
            var sacramento  = $('#sacramento').val();
            
             $.ajax({
                url: "http://127.0.0.1:8000/painel/livros/ajax/livroDigital/novaFolha",
                type: 'POST',
                data: {
                    sacramento:sacramento,
                },
                dataType: 'JSON',
                beforeSend: function () {
                    $('.carregando').remove();
                    $('.resultado1').remove();
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
                    
                }
            });
            
            $(document).on('click','#btn-step2',function(){
                var livro = $("#livro").val();
                var numeracao_pagina = $("input[type=number][name=numeracao_pagina]").val();
                var obs_folha = $("#observacoes").val();
                $.ajax({
                    url: "http://127.0.0.1:8000/painel/livros/ajax2/livroDigital/novaFolha",
                    type: 'POST',
                    data: {
                        livro:livro,numeracao_pagina:numeracao_pagina,obs_folha:obs_folha
                    },
                    dataType: 'JSON',
                    beforeSend: function () {
                        $('.carregando').remove();
                        $('.resultado2').remove();
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
                        $('.resultado2').remove();
                        if(data.resposta==1){
                            $('.resultado1').addClass('fade');
                            $("#step1").addClass('fade');
                            $('#titulo').html("3-Enviar foto da folha...");
                            $('#step1').before(data.html);                            
                        }else{                            
                            $('#step1').before(data.html);                            
                        }
                        
                    }
                });
            });
            
           
           
        });
        
        


});