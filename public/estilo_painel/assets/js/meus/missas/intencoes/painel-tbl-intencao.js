$(document).ready(function () {
    posicaoPagina = 0;
   
    $(document).on('click', '#bt-next', function () {
        buscar(++posicaoPagina);
    });
    $(document).on('click', '#bt-today', function () {
        posicaoPagina = 0;
        buscar(posicaoPagina);
    });
    $(document).on('click', '#bt-prev', function () {
        buscar(--posicaoPagina);

    });
    $(document).on('click', '.excluir', function () {
        var codigo = $(this).data('cod');
        swal({
            title: "Excluir esse registro?",
            text: "Se você excluir esse registro não será possível recupera-lo! Tem certeza que deseja excluir?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim, excluir!",
            cancelButtonText: "Não, cancelar exclusão!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
                function (isConfirm) {
                    if (isConfirm) {

                        excluir_registro(codigo);


                    } else {
                        swal("Cancelado!", "Exclusão cancelada.", "error");
                    }
                });
    });
    function excluir_registro(cod) {

        $.ajax({
            url: _urlExclui,
            dataType: 'json',
            type: 'post',
            data: {
                cod: cod
            },
            success: function (data) {
                if (data.resultado == true) {
                    swal("Excluido!", "Seu registro foi deletado.", "success");
                    buscar(posicaoPagina);
                } else {
                    swal("Problema", "Não foi possível excluir esse registro", "error");
                }

            },
            error: function (erro) {
                var retorno = false;
                return retorno;
            }
        });
    }


    function buscar(posicao) {

        $.ajax({
            url: _urlBusca,
            type: 'POST',
            data: {
                posicao: posicao,
            },
            dataType: 'html',
            beforeSend: function () {
                $('.alert').remove();
                $('table').html(
                        "<tr><td colspan='6'><div class='text-left col-md-12 col-sm-12 carregando'>" +
                        "<div class=\"preloader3 loader-block\">" +
                        "<div class=\"circ1\"></div>" +
                        "<div class=\"circ2\"></div>" +
                        "<div class=\"circ3\"></div>" +
                        "<div class=\"circ4\"></div>" +
                        "</div>" +
                        "</div></td></tr>"
                        );
             
            },
            success: function (data) {
                $('.alert').remove();
                $('table').remove();
                $('#busca').html(data);
                
            }
        });

    }

});

