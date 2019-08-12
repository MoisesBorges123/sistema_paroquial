    $(document).ready(function () {
     
    ////////// PASSO 01 (INSERE A DATA E MOSTRA O CAMPO PARA COLOCAR CAPELA OU IGREJA)
    $(document).on('click', '.passo1', function () {
        clearTimeout(this.interval);
        $('.passo2').fadeOut(500);
        this.interval = setTimeout(function () {
            $('.passo2').fadeIn(500);
        }, 1500);
    });
    
    
    ////////// PASSO 02 (INSERE CAPELA OU IGREJA E PEDE PRAR SELECIONAR QUAL FOI)
    $(document).on('change', '.passo2', function () {
        clearTimeout(this.interval);
        $('.passo3').fadeOut(500);
         buscarIgreja($('#tipo').val());
        this.interval = setTimeout(function () {
            $('.passo3').fadeIn(500);           
        },
                1000//Tempo de Espera para executar a função
                );
    });
   
    
    ////////// PASSO 03 (SELECIONA A IGREJA)
    $(document).on('change', '.passo3', function () {
        clearTimeout(this.interval);
        if($('#igreja').val()==-1){
            $('#modal-13-titulo').html("<h3>Nova Igreja</h3>");
            $('#modal-13-texto').html("<h5>Cadastro rápido</h5><p>Para adicionar uma nova igreja a LISTA por favor insira o nome no campo abaixo.<br><b>Ex.:Paróquia Catedral Imaculada Conceição.</b></p>");
            $('#cadastra_igreja').trigger('click');
            $('#salva-capela').attr('id','salva-igreja');
            $('#salva-padre').attr('id','salva-igreja');
        }else if($('#capela').val()==-1){
            $('#modal-13-titulo').html("<h3>Nova Capela</h3>");
            $('#modal-13-texto').html("<h5>Cadastro rápido</h5><p>Para adicionar uma nova capela a LISTA por favor insira o nome no campo abaixo.<br><b>Ex.:Capela Sagrado Coração.</b></p>");
            $('#cadastra_igreja').trigger('click');   
            $('#salva-igreja').attr('id','salva-capela');
            $('#salva-padre').attr('id','salva-capela');
        }else{
            $('.passo4').fadeOut(500);
            this.interval = setTimeout(function () {
                $('.passo4').fadeIn(500);
            },
                    1000//Tempo de Espera para executar a função
                    );            
        }
    });
    $(document).on('input', '.passo4', function () {
        clearTimeout(this.interval);
        $('.passo5').fadeOut(500);
        this.interval = setTimeout(function () {
            $('.passo5').fadeIn(500);
        }, 1000);
    });
    $(document).on('click', '.passo5', function () {
        clearTimeout(this.interval);
        $('.passo6').fadeOut(500);
        this.interval = setTimeout(function () {
            $('.passo6').fadeIn(500);
        },
                1500//Tempo de Espera para executar a função
                );
    });
    
    ////////////PASSO 06
    
    $(document).on('input', '.passo6', function () {
        clearTimeout(this.interval);
        $('.passo7').fadeOut(500)
        this.interval = setTimeout(function () {
            $('.passo7').fadeIn(500);
        },
                1000//Tempo de Espera para executar a função
                );
    });
    $(document).on('input', '.passo7', function () {
        clearTimeout(this.interval);
        $('.passo8').fadeOut(500);
        this.interval = setTimeout(function () {
            $('.passo8').fadeIn(500);
        },
                1000//Tempo de Espera para executar a função
                );
    });

    $(document).on('input', '.passo8', function () {
        clearTimeout(this.interval);
        $('.passo9').fadeOut(500);
        this.interval = setTimeout(function () {
            $('.passo9').fadeIn(500);
        },
                1000//Tempo de Espera para executar a função
                );
    });
    $(document).on('input', '.passo9', function () {
        clearTimeout(this.interval);
        $('.passo10').fadeOut(500);
        this.interval = setTimeout(function () {
            buscarPadre();
            $('.passo10').fadeIn(500);
        },
                1000//Tempo de Espera para executar a função
                );
    });

    $(document).on('change', '.passo10', function () {
        clearTimeout(this.interval);
        $('.passo11').fadeOut(500);
        if($('#padre').val()==-1){
            $('#modal-13-titulo').html("<h3>Novo Padre</h3>");
            $('#modal-13-texto').html("<h5>Cadastro rápido</h5><p>Para adicionar um novo padre a LISTA por favor insira o nome no campo abaixo.<br><b>Ex.:Padre Serafim Magalhães.</b></p>");
            $('#cadastra_igreja').trigger('click');
            $('#salva-capela').attr('id','salva-padre');
            $('#salva-igreja').attr('id','salva-padre');
        }else{
            
            this.interval = setTimeout(function () {
                
                $('.passo11').fadeIn(500);
                $('.passo12').fadeIn(500);
            },
                    1000//Tempo de Espera para executar a função
                    );
        }
        
    });
    });
