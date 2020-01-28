$(document).ready(function(){
   
    $(document).on('click','td',function(){
        var td = $(this);
        var input = td.querySelect('input');
        input.val = null;
        $(input).mask("#.##0,00", {reverse: true})
        
    });
    $(document).on('click','.devolver',function(){
        //alert($(this).data('id_dizimista'));
        window.location.href=url_devolucao+'\/'+$(this).data('dizimista');
    });
   /* $(document).on('click','.morte',function(){
        Swal.fire({
            title:"<h2 style='margin-top:auto;'>Woli</h2> <img src = '"+woli+"' width='100' height='70'>",
            html:"<h5>Tem certeza que "+$(this).data('nome')+" realmente morreu?</h5>"
                +"<p>Essa pessoa será removida de todos os grupos e pastorais que ela participa.</p>",
        });
    });*/
});


