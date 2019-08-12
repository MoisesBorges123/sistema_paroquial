




    function cadastrarIgreja(nome) {
        $.ajax({
            url: rota_salva_igreja,
            type: 'POST',
            data: {nome: nome},
            datatype: 'JSON',
            beforeSend: function () {
                $('.cadastrando').remove();                
                $('#modal-13-texto').after(
                        "<div class='cadastrando'><div class=\"preloader3 loader-block\">" +
                        "<div class=\"circ1\"></div>" +
                        "<div class=\"circ2\"></div>" +
                        "<div class=\"circ3\"></div>" +
                        "<div class=\"circ4\"></div>" +
                        "</div></div>"
                        );
            },
            success: function (data) {
                $('.cadastrando').remove();
                if(data.erro==0){
                      buscarIgreja($('#tipo').val());                    
                    $('#nome-igreja').val(null);
                      $('.md-close').trigger('click');
                }else{
                    $('#modal-13-texto').after("<div class='cadastrando'>"+data.erro+"</div>");
                }
            }

        });
    }
    function cadastrarCapela(nome) {
        $.ajax({
            url: rota_salva_capela,
            type: 'POST',
            data: {nome: nome},
            datatype: 'JSON',
            beforeSend: function () {
                $('.cadastrando').remove();                
                $('#modal-13-texto').after(
                        "<div class='cadastrando'><div class=\"preloader3 loader-block\">" +
                        "<div class=\"circ1\"></div>" +
                        "<div class=\"circ2\"></div>" +
                        "<div class=\"circ3\"></div>" +
                        "<div class=\"circ4\"></div>" +
                        "</div></div>"
                        );
            },
            success: function (data) {
                $('.cadastrando').remove();
                if(data.erro==0){
                      buscarIgreja($('#tipo').val());                    
                    $('#nome-igreja').val(null);
                      $('.md-close').trigger('click');
                }else{
                    $('#modal-13-texto').after("<div class='cadastrando'>"+data.erro+"</div>");
                }
            }

        });
    }
    function cadastrarPadre(nome) {
        $.ajax({
            url: rota_salva_padre,
            type: 'POST',
            data: {nome: nome},
            datatype: 'JSON',
            beforeSend: function () {
                $('.cadastrando').remove();                
                $('#modal-13-texto').after(
                        "<div class='cadastrando'><div class=\"preloader3 loader-block\">" +
                        "<div class=\"circ1\"></div>" +
                        "<div class=\"circ2\"></div>" +
                        "<div class=\"circ3\"></div>" +
                        "<div class=\"circ4\"></div>" +
                        "</div></div>"
                        );
            },
            success: function (data) {
                $('.cadastrando').remove();
                if(data.erro==0){
                    $('#nome-igreja').val(null);
                    $('.md-close').trigger('click');
                    buscarPadre();                    
                }else{
                    $('#modal-13-texto').after("<div class='cadastrando'>"+data.erro+"</div>");
                }
            }

        });
    }
    function buscarIgreja(tipo) {
        $.ajax({
            url: rota_busca1,
            type: 'POST',
            data: {tipo: tipo},
            datatype: 'JSON',
            beforeSend: function () {

                $('.passo3').html(
                        "<div class=\"preloader3 loader-block\">" +
                        "<div class=\"circ1\"></div>" +
                        "<div class=\"circ2\"></div>" +
                        "<div class=\"circ3\"></div>" +
                        "<div class=\"circ4\"></div>" +
                        "</div>"
                        );
            },
            success: function (data) {
                $('.passo3').html(data.resultado);
            }

        });
    }
    function buscarPadre() {
        $.ajax({
            url: rota_busca2,
            type: 'POST',            
            datatype: 'JSON',
            beforeSend: function () {

                $('#camp10').html(
                        "<div class=\"preloader3 loader-block\">" +
                        "<div class=\"circ1\"></div>" +
                        "<div class=\"circ2\"></div>" +
                        "<div class=\"circ3\"></div>" +
                        "<div class=\"circ4\"></div>" +
                        "</div>"
                        );
            },
            success: function (data) {
                $('#padre').remove();
                $('#camp10').html(data.input_select);
                $('#padre').prepend("<option value=''> - Selecione o Padre Celebrante - </option>"+"<option value='-1'>Não está na Lista</option>");
                $('#padre').val('');
            }

        });
    }
    function buscarFolhas_deLivro(livro) {
        $.ajax({
            url: rota_busca0,
            type: 'POST',
            data: {livro: livro},
            datatype: 'JSON',
            beforeSend: function () {
                $('.carregando').remove();
                $('.resultado0').remove();
                $('.pesquisa_livro').after(
                        "<div class=\"col-md-3 col-sm-12 ml-auto carregando\">" +
                        "<div class=\"preloader3 loader-block\">" +
                        "<div class=\"circ1\"></div>" +
                        "<div class=\"circ2\"></div>" +
                        "<div class=\"circ3\"></div>" +
                        "<div class=\"circ4\"></div>" +
                        "</div>"+
                        "</div>"
                        );
            },
            success: function (data) {
                $('.carregando').remove();
                $('.pesquisa_livro').after(data.resultado);
              
            }

        });
    }

