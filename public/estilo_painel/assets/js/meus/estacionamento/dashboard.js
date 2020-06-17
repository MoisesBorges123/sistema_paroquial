const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });

$(document).ready(function () {
       
    $('#placa_saida').select2();
    $('.placa').mask('AAA-0A00');  
    montarTable();      
    setInterval(() => {          
       montarTable();
      
    }, 30000);

    $(document).on('keypress','#placa_entrada',function(e) {
    if (e.which == 13) {
         $('#btn-entrar').trigger('click'); 
         return false;
    }
    
    });
    $(document).on('click','#btn-entrar',function(){
        var tempo = new Date;
        var horas = tempo.getHours();        
        if(horas < 18){

            if($('#placa_entrada').val()==null || $('#placa_entrada').val()==""){
                Swal.fire({
                    title:'Ops!',
                    html:'Você precisa informar a placa do veiculo.',
                    icon:'warning',
                    position:'top-right',
                    timer:500,
                    showConfirmButton: false
                    });
            }else{
                var modalidade = $("input[name='modalidade']:checked").val();
                var tipo_veiculo = $("input[name='tipo_veiculo']:checked").val();
                var placa = $('#placa_entrada').val();
                var estacionar_carro = $(this).data('url');
            $.ajax({
                url:estacionar_carro,
                type:'POST',
                data:{placa:placa,modalidade:modalidade,tipo_veiculo:tipo_veiculo},
                statusCode: {
                    404: function() {
                    Swal.fire('Erro 404', "Ocorreu um erro ao carregar ao carregar a pagina!",'error');
                    },
                    405: function() {
                    Swal.fire('Erro 405', "Ocorreu um erro ao encontrar o metodo de pesquisa!",'error');
                    },
                    500: function() {
                    Swal.fire('Erro 500', "Ocorreu um erro ao processar os dados!",'error');
                    }
                
                },
                beforeSend:function(){
                    
                },
                success:function(data){  
                    if(data.insert==true){
                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })

                        Toast.fire({
                        icon: 'success',
                        title: 'Carro cadastrado!!'
                        });
                        $('#placa_entrada').val(null);           
                        montarTable();
                    }else{
                        if(data.carro_estacionado){
                            const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true,
                            onOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                            })

                            Toast.fire({
                            icon: 'info',
                            title: 'O carro em questão já foi cadastrado.'
                            })
                            
                        }
                    }                  
                    
                }
            });
            }
        }else{
            Toast.fire({
                title:'O estacionamento já encerrou o expediente.',
                icon:'info'
            })
        }
    });
    $(document).on('click','.btn-delete',function(){
        var id = $(this).data('id');
        var placa = $(this).data('placa');
        Swal.fire({
            title:"Excluir Veículo?",
            html:"Tem certeza que deseja excluir o veículo <b>"+placa+"</b>",
            icon:"question",
            showCancelButton:true,
            confirmButtonText:"Deletar!",
            cancelButtonText:"Cancelar",
        }).then((result)=>{
            if(result.value){
                data =  new FormData();
                data.append('_token',_token);
                data.append('id',id);
                return fetch(url_delete,{
                    credentials: "same-origin",
                    method:'POST',
                    body: data
                })
            }
        }).then((resultado)=>{
            if(!resultado.ok){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    })

                    Toast.fire({
                    icon: 'error',
                    title: 'Não foi possivel comunicar com o servidor.'
                    })
                
            }else{
                return resultado.json();
            }
        }).then((resposta)=>{
            if(resposta.result=true){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    })

                    Toast.fire({
                    icon: 'success',
                    title: 'Carro removido.'
                    });
                    montarTable();
            }else{
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    })

                    Toast.fire({
                    icon: 'error',
                    title: 'Ocorreu um erro ao excluir esse carro.'
                    })
                
            }
        });
    });
    $(document).on('click','.btn-update',function(){
        var id = $(this).data('id');
        var old_placa = $(this).data('placa');
        var old_horario = $(this).data('horario');
        var veiculo = $(this).data('tipo_veiculo');
        var placa = createInput('placa','*Placa','text',true);
        var horario_entrada = createInput('horario_entrada','*Entrada','text',true);
        var modalidade = $(this).data('modalidade');
        var modalidade_input=createInputModalidade();
        var veiculo_input=createInputTipo_Veiculo();

       if(modalidade!='mensalidade' && modalidade!='free'){
            
        Swal.fire({
            title:"Alterar Registro",
            html:placa.label+placa.input+"<br>"+horario_entrada.label+horario_entrada.input+"<br>"+modalidade_input+"<br>"+veiculo_input,
            onRender:function(){
                $('#id_placa').val(old_placa);
                $('#id_horario_entrada').val(old_horario);
                $("input[name='modalidade'][value='"+modalidade+"']").attr('checked',true);
                $("input[name='tipo'][value='"+veiculo+"']").attr('checked',true);
            },
            onOpen:function(){
                $('#id_horario_entrada').addClass('time');
                $('#placa').addClass('placa');
            },
            showCancelButton:true,
            cancelButtonText:"Cancelar",
            confirmButtonText:"Alterar",
            preConfirm:()=>{
                if($('#id_placa').val()=='' && $('#id_horario_entrada').val()){
                    Swal.showValidationMessage("É obrigatório preencher todos os campos que possuam '*'");
                    return false;
                }else{
                    return true;
                }
            }

        }).then((result)=>{
            
            if(result.value){
                var new_veiculo =$("input[name='tipo']:checked").val(); 
                var new_modalidade = $("input[name='modalidade']:checked").val();               
               // console.log($('#id_placa').val()+" "+old_placa+" "+$('#id_horario_entrada').val()+" "+old_horario+" "+new_veiculo+" "+veiculo+" "+new_modalidade+" "+modalidade)
                var newDATA=verificaUpdate($('#id_placa').val(),old_placa,$('#id_horario_entrada').val(),old_horario,new_veiculo,veiculo,new_modalidade,modalidade)
                if(newDATA==true){
                
                    var data = new FormData();
                    data.append('placa',$('#id_placa').val());
                    data.append('horario',$('#id_horario_entrada').val());
                    data.append('tipo_veiculo',new_veiculo);
                    data.append('modalidade',new_modalidade);
                    data.append('_token',_token);
                    data.append('id',id);
                    return fetch(url_update,{
                        body:data,
                        method:'POST',
                        credentials: "same-origin",
                    });
                }else{
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })
    
                        Toast.fire({
                        icon: 'info',
                        title: 'Nenhuma alteração foi realizada.'
                        })
                    return false;
                }
                
            }else{
            
                return false;
            }
        }).then((resultado)=>{
            if(!resultado.ok && resultado != false){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    })

                    Toast.fire({
                    icon: 'error',
                    title: 'Não foi possivel comunicar com o servidor.'
                    })
            }else if(resultado.ok){
                return resultado.json();
            }
        }).then((resposta)=>{
            if(resposta != false && resposta.update ){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    })

                    Toast.fire({
                    icon: 'success',
                    title: 'Registro Alterado.'
                    })
            }else if(resposta.update == false){
                if(resposta.duplicidade==true){

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })
    
                        Toast.fire({
                        icon: 'warning',
                        title: 'Esse carro já foi registrado.'
                        })
                }else{

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })
    
                        Toast.fire({
                        icon: 'error',
                        title: 'Não foi possivel alterar esse registro.'
                        })
                }
            }
            montarTable();
        });
       }else{
           Swal.fire('OPS!','Não é possivel alterar dados desse carro.','warning');
       }
        
    });
    $(document).on('click','.btn-detalhes', async function(){
        var pessoa = $(this).data('dono');
        var telefone = $(this).data('fone');
        var icone = $(this).data('icon');
        var placa = $(this).data('placa');
        var informar =false;
        if(pessoa=='Desconhecido'){
            
            (informar) = await Swal.fire({
                title: woli_titulo,
                text:"Não possuo nenhuma informação sobre esse veiculo. Deseja me informar?",
                showCancelButton:true,
                confirmButtonText:'Sim!',
                cancelButtonText:'Mais tarde',                
                icon:"question"
            });
           
            if(informar.value==true){
                var proprietario = createInput('proprietario','Proprietario','text',false);
                var fone_contato = createInput('telefone','Telefone','text',false);                
                var email = createInput('email','E-mail','email',false);
                var modelo_veiculo = createInput('modelo_veiculo','Modelo do Veículo','text',false);
                var cor = createInput('cor','Cor do Veículo','text',false);
                var sexo = createRadioSexo();
               (cadastro) = await Swal.fire({ 
                    title:"<div class='row'>"+
                    "<div class='col-md-3 col-sm-3 text-right'>"+
                        "<img src="+woli+" width='70' height='60'>"+
                    "</div>"+
                    "<div class='col-md-9 col-sm-9 text-left'>"+
                        "<h3>Então vamos lá!</h3>"+
                    "</div>",
                    html: "<div class='row'><div class='col-md-12 col-sm-12'>"+proprietario.label+proprietario.input+"</div>"+
                    "<div class='col-md-12 col-sm-12>"+sexo+"</div>"+
                    "<div class='col-md-6 col-sm-12'>"+fone_contato.label+fone_contato.input+"</div>"+
                    "<div class='col-md-6 col-sm-12'>"+email.label+email.input+"</div>"+
                    "<div class='col-md-6 col-sm-12 m-t-15'>"+modelo_veiculo.label+modelo_veiculo.input+"</div>"+
                    "<div class='col-md-6 col-sm-12 m-t-15'>"+cor.label+cor.input+"</div></div>",
                    showCancelButton: true,
                    cancelButtonText:"Sair",
                    width:"40em",
                    onRender: async function(){
                        (dados) = await fetch(url_buscar_pessoas,{
                            method:'GET',
                        }).then((result)=>{
                            if(result.ok){
                                return result.json();
                            }
                        });
                        var linhas=null;                        
                            if(dados){
                                for(var i = 0; i<dados.total_pessoas;i++){
                                    linhas=linhas+"<option style='width:100%;' data-id='"+dados.pessoas[i].id_pessoa+"' value='"+dados.pessoas[i].nome+"'>"+dados.pessoas[i].nome+"</option>"                                    
                                }
                            }
                        $('#list_pessoas').remove();
                        $('body').append("<datalist id='list_pessoas'>"+linhas+"</datalist>");
                        $('#id_proprietario').attr('list','list_pessoas');
                    },
                    onOpen:function(){
                        $('#id_telefone').addClass('phone_area-code');
                    },
                }).then((result)=>{
                        var meuForm = new FormData();                        
                        var pessoa  = $('#list_pessoas [value="'+$('#id_proprietario').val()+'"]').data('id');   
                        var sexo  = $("input[name='sexo']:checked").val();                                          
                        meuForm.append('pessoa',pessoa);
                        meuForm.append('placa',placa);
                        meuForm.append('nome',$('#id_proprietario').val());
                        meuForm.append('telefone',$('#id_telefone').val());
                        meuForm.append('email',$('#id_email').val());
                        meuForm.append('modelo_veiculo',$('#id_modelo_veiculo').val());
                        meuForm.append('cor',$('#id_cor').val());
                        meuForm.append('sexo',sexo);
                        meuForm.append('_token',_token);
                        
                        return fetch(url_save_more_informations,{
                            'body': meuForm,
                            'method':'POST',
                            'credentials':'same-origin'
                        });
                }).then((response)=>{
                    if(response.ok){
                        return response.json();
                    }else{
                        return false;
                    }
                });
                console.log(cadastro);
                if(cadastro.update==true){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })
    
                        Toast.fire({
                        icon: 'success',
                        title: 'Dados inseridos com sucesso.'
                        })
                }else{
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })
    
                        Toast.fire({
                        icon: 'error',
                        title: 'Ocorreu um erro ao inserir o dados.'
                        })
                }
            }
        }else{
            
            Swal.fire({
                title:"<h2>"+placa+"</h2>"+"<div class='h3'><i class='icofont "+icone+"'></i></div>",
                html:"<h4>Proprietário:<b>"+pessoa+"</b><br>Telefone:<b>"+telefone+"</b></h4>",
                
            });
        }
    });
    $(document).on('click','#btn-mensalidade',async function(){
        var placa  = $('#placa_mensalista').val();        
        if(placa != ''){
            dados = new FormData();
            dados.append('carro',placa);
            dados.append('_token',_token);
            (busca) = await fetch(url_busca_carro,{
                credentials:'same-origin',
                method:'post',
                body:dados,
            }).then((result)=>{
                if(result.ok){
                    return result.json();
                }else{
                    return false;
                }
            });
            if(busca.cad_carro==true && busca.cad_pessoa==true){//CASO A PESSOA JÁ TENHA CADASTRO NO SISTEMA FAÇA (FALTA IMPLEMENTAR)
                var modelo_veiculo;
                var cor;
                if(busca.dados.tipo_veiculo=='C'){
                    tipo_veiculo="&nbsp;&nbsp;&nbsp;&nbsp;<i style='font-size:30px' class='icofont icofont-police-car-alt-2'></i>";
                }else{
                    tipo_veiculo="&nbsp;&nbsp;&nbsp;&nbsp;<i style='font-size:35px' class='icofont icofont-motor-bike'></i>";
                }
                if(busca.dados.modelo_veiculo==null){
                    modelo_veiculo=null;
                }else{
                    modelo_veiculo="Modelo do carro: <b>"+busca.dados.modelo_veiculo+"</b><br>";
                }
                if(busca.dados.cor==null){
                    cor='';
                }else{
                    cor=", cor <b>"+busca.dados.cor+"</b><br>";
                }
                var field_valor = createInput('valor','Valor','text',false);
                var field_desconto = createInput('desconto','Desconto','text',false);
                var field_total = createInput('total','Valor a Pagar','text',false);
                var field_pago = createInput('pago','Valor Pago','text',false);
                var field_dataEntrada = createInput('dataEntrada','Data Inicio','date',false);
                var field_dataSaida = createInput('dataSaida','Data Fim','date',false);
                var field_obs = createTextArea('justificativa','Observações',4,'Observações do pagamento');
                var renovar = await Swal.fire({
                    title:"<h2>Veículo: <b>"+placa.toUpperCase()+"</b></h2>"+tipo_veiculo,
                    html:'<div class="row">'+
                            '<div class="col-md-12 col-sm-12 m-t-10"><h5>Proprietário: <b>'+busca.dados.nome+'</b></h5></div>'+
                            '<div class="col-md-6 col-sm-12 m-t-10"><h5>Telefone: <b>'+busca.dados.numero+'</b></h5></div>'+
                            '<div class="col-md-6 col-sm-12 m-t-10"><h5>Modelo: <b>'+modelo_veiculo+'</b></h5></div>'+
                            "<div class='col-md-6 col-sm-12  m-t-10'>"+field_dataEntrada.label+field_dataEntrada.input+"</div>"+
                            "<div class='col-md-6 col-sm-12  m-t-10'>"+field_dataSaida.label+field_dataSaida.input+"</div>"+
                            "<div class='col-md-6 col-sm-12  m-t-10' id='valor'>"+field_valor.label+field_valor.input+"</div>"+
                            "<div class='col-md-6 col-sm-12  m-t-10' id='desconto'>"+field_desconto.label+field_desconto.input+"</div>"+
                            "<div class='col-md-6 col-sm-12  m-t-10' id='total'>"+field_total.label+field_total.input+"</div>"+
                            "<div class='col-md-6 col-sm-12  m-t-10' id='pago'>"+field_pago.label+field_pago.input+"</div>"+
                            "<div class='col-md-12 col-sm-12 m-t-10 justificativa'>"+field_obs.label+field_obs.input+"</div>"+
                        '</div>',
                    confirmButtonText:"Renovar Mensalidade",
                    showCancelButton:true,
                    width:"36rem",
                    onOpen:()=>{
                        $('.justificativa').hide();
                        $('#id_dataEntrada')[0].valueAsDate = new Date();                        
                        $('#id_dataEntrada').change();
                        $('#id_dataSaida').prop('disabled',true);                          
                        buscaPrecoMensalidade(busca.dados.tipo_veiculo);                      
                    },
                    preConfirm:()=>{
                        var total = $('#id_total').val();
                        var pago = $('#id_pago').val();                        
                        var desconto = $('#id_desconto').val();
                        desconto = desconto.replace(',','.');
                        var obs = $('#id_justificativa').val();
                        pago = pago.replace(',','.');
                        total = total.replace('R$ ','');
                        total = parseFloat(total.replace(',','.'));
                        if(pago=='' || pago < total){
                            Swal.showValidationMessage("OPS! Não é possível prosseguir você precisa inserir um valor válido.");
                            return false;
                        }else{
                            if( (desconto > 0 || desconto!='') && (obs=='') ){
                                Swal.showValidationMessage("OPS! Para prosseguir você deve inserir uma observação referente ao desconto recebido.");
                            return false;
                            }else{
                                if(obs == '.' || $.isNumeric(obs) ){
                                    Swal.showValidationMessage("OPS! Não é possível prosseguir você precisa uma observação válida.");                                        
                                    return false;
                                }else{                                        
                                    return true;
                                }
                            }
                        }
                    }
                });
                if(renovar.value){
                    form = new FormData();
                    form.append('data_entrada',$('#id_dataEntrada').val());
                    form.append('data_saida',$('#id_dataSaida').val());
                    form.append('justificativa',$('#id_justivicativa').val());
                    form.append('desconto',$('#id_desconto').val());
                    form.append('id_veiculo',busca.dados.id_carro);
                    form.append('_token',_token);
                    form.append('base_calculo',$('#id_valor').data('base'));
                    fetch(renovar_mensalidade,{
                        method:'POST',
                        body:form,
                        credentials:'same-origin'
                    }).then((result)=>{
                        if(!result.ok){
                            Swal.fire({
                                title:'Ops! Erro ao renovar mensalidade.',
                                text:result.statusText+" ("+result.status+")",
                                icon:'error'
                            });
                        }else{
                            return result.json();                           

                        }
                    }).then((resposta)=>{
                        if(resposta.pagamento && resposta.horario && resposta.fluxo_diario){
                            Toast.fire({
                                icon:'success',
                                title:'Mensalidade renovada!'
                            });
                        }else{
                            Swal.fire({
                                title:'Ops! Erro ao renovar mensalidade.',
                                html:"Pagamento: "+resposta.pagamento+"<br>"+
                                "Horario: "+resposta.horario+"<br>"+
                                "Fluxo diario: "+resposta.fluxo_diario,
                                icon:'error'
                            });
                        }
                    });
                }
                
            }else{//CASO O CARRO OU A PESSOA NÃO SEJA CADASTRADA CARREGUE O FORMULARIO DE CADASTRO
                var field_nome = createInput('nome','Proprietário','text',true);
                var field_telefone = createInput('telefone','Telefone','text',true);
                var field_email = createInput('email','E-mail','email',false);
                var field_placa = createInput('placa','Placa','text',true);
                var field_modelo = createInput('modelo','Modelo Veículo','text',false);
                var field_valor = createInput('valor','Valor','text',false);
                var field_desconto = createInput('desconto','Desconto','text',false);
                var field_total = createInput('total','Valor a Pagar','text',false);
                var field_tipo = createInputTipo_Veiculo();
                var field_cor = createInput('cor','Cor','text',true);
                var field_obs = createTextArea('justificativa','Observações',4,'Observações do pagamento');
                var field_pago = createInput('pago','Valor Pago','text',false);
                var field_dataEntrada = createInput('dataEntrada','Data Inicio','date',false);
                var field_dataSaida = createInput('dataSaida','Data Fim','date',false);
                (cadastro) = await Swal.fire({
                    title:"Novo Mensalista",
                    html:"<div class='row'>"+
                    "<div class='col-md-12 col-sm-12'>"+field_nome.label+field_nome.input+"</div>"+
                    "<div class='col-md-6 col-sm-12 m-t-10'>"+field_telefone.label+field_telefone.input+"</div>"+
                    "<div class='col-md-6 col-sm-12  m-t-10'>"+field_email.label+field_email.input+"</div>"+
                    "<div class='col-md-6 col-sm-12  m-t-10'>"+field_placa.label+field_placa.input+"</div>"+
                    "<div class='col-md-6 col-sm-12  m-t-10'>"+field_modelo.label+field_modelo.input+"</div>"+
                    "<div class='col-md-7 col-sm-12  m-t-10'>"+field_cor.label+field_cor.input+"</div>"+
                    "<div class='col-md-6 col-sm-12  m-t-10'>"+field_dataEntrada.label+field_dataEntrada.input+"</div>"+
                    "<div class='col-md-6 col-sm-12  m-t-10'>"+field_dataSaida.label+field_dataSaida.input+"</div>"+
                    "<div class='col-md-12 col-sm-12 m-t-10 text-center'>"+field_tipo+"</div>"+
                    "<div class='col-md-6 col-sm-12  m-t-10' id='valor'>"+field_valor.label+field_valor.input+"</div>"+
                    "<div class='col-md-6 col-sm-12  m-t-10' id='desconto'>"+field_desconto.label+field_desconto.input+"</div>"+
                    "<div class='col-md-6 col-sm-12  m-t-10' id='total'>"+field_total.label+field_total.input+"</div>"+
                    "<div class='col-md-6 col-sm-12  m-t-10' id='pago'>"+field_pago.label+field_pago.input+"</div>"+
                    "<div class='col-md-12 col-sm-12 m-t-10 justificativa' >"+field_obs.label+field_obs.input+"</div>"+
                    "</div>",
                    width:"40rem",
                    confirmButtonText:"Salvar e Efetuar Pagamento!",
                    cancelButtonText:"Cancelar",
                    showCancelButton:true,
                    onOpen: function(){
                        $('input[name="tipo"]').addClass('tipo_mensalista');
                        $('#total').hide();
                        $('.justificativa').hide();
                        
                        $('#valor').hide();
                        $('#pago').hide();
                        $('#desconto').hide();
                        $('#id_placa').val(placa.toUpperCase());
                        $('#id_placa').prop('disabled',true);
                        $('#id_telefone').addClass('phone_area-code');
                        $('#id_dataEntrada')[0].valueAsDate = new Date();                        
                        $('#id_dataEntrada').change();
                        $('#id_dataSaida').prop('disabled',true);
                    },
                    onRender: async function(){
                        (dados) = await fetch(url_buscar_pessoas,{
                            method:'GET',
                        }).then((result)=>{
                            if(result.ok){
                                return result.json();
                            }
                        });
                        var linhas=null;                        
                            if(dados){
                                for(var i = 0; i<dados.total_pessoas;i++){
                                    linhas=linhas+"<option style='width:100%;' data-id='"+dados.pessoas[i].id_pessoa+"' value='"+dados.pessoas[i].nome+"'>"+dados.pessoas[i].nome+"</option>"                                    
                                }
                            }
                        $('#list_pessoas').remove();
                        $('body').append("<datalist id='list_pessoas'>"+linhas+"</datalist>");
                        $('#id_nome').attr('list','list_pessoas');
                    },
                    preConfirm:function(){
                        
                        var total = $('#id_total').val();
                        var pago = $('#id_pago').val();
                        var telefone = $('#id_telefone').val();
                        var desconto = $('#id_desconto').val();
                        desconto = desconto.replace(',','.');
                        var obs = $('#id_justificativa').val();
                        pago = pago.replace(',','.');
                        total = total.replace('R$ ','');
                        total = parseFloat(total.replace(',','.'));
                        tipo = $('input[name="tipo"]:checked').val();
                        if(tipo==''){
                            Swal.showValidationMessage("OPS! Selecione o tipo do veículo.");
                            return false;
                        }else{
                            if(telefone=='' || telefone==null){
                                Swal.showValidationMessage("OPS! Não é possível prosseguir o Telefone é um campo obrigatório.");
                                return false;
                            }else{
                                if(pago=='' || pago < total){
                                    Swal.showValidationMessage("OPS! Não é possível prosseguir você precisa inserir um valor válido.");
                                    return false;
                                }else{
                                    if( (desconto > 0 || desconto!='') && (obs=='') ){
                                        Swal.showValidationMessage("OPS! Para prosseguir você deve inserir uma observação referente ao desconto recebido.");
                                    return false;
                                    }else{
                                        if(obs == '.' || $.isNumeric(obs) ){
                                            Swal.showValidationMessage("OPS! Não é possível prosseguir você precisa uma observação válida.");                                        
                                            return false;
                                        }else{                                        
                                            return true;
                                        }
                                    }
                                }
                            }

                        }


                    }
                });
                if(cadastro.value){
                    FormMensalista  = new FormData();
                    
                    var pessoa  = $('#list_pessoas [value="'+$('#id_nome').val()+'"]').data('id');   
                    FormMensalista.append('pessoa',pessoa);                
                    FormMensalista.append('placa',$('#placa_mensalista').val());                
                    FormMensalista.append('tipo_veiculo',$('input[name="tipo"]:checked').val());                
                    FormMensalista.append('nome',$('#id_nome').val());
                    FormMensalista.append('telefone',$('#id_telefone').val());
                    FormMensalista.append('email',$('#id_email').val());
                    FormMensalista.append('modelo_veiculo',$('#id_modelo').val());
                    FormMensalista.append('valor',$('#id_valor').val());
                    FormMensalista.append('desconto',$('#id_desconto').val());
                    FormMensalista.append('total',$('#id_total').val());
                    FormMensalista.append('cor_veiculo',$('#id_cor').val());
                    FormMensalista.append('justificativa',$('#id_justificativa').val());
                    FormMensalista.append('pago',$('#id_pago').val());
                    FormMensalista.append('id_preco',$('#id_valor').data('id_preco'));
                    FormMensalista.append('data_entrada',$('#id_dataEntrada').val());
                    FormMensalista.append('data_saida',$('#id_dataSaida').val());                    
                    FormMensalista.append('_token',_token);
                    FormMensalista.append('base_calculo',$('#id_valor').data('base'));
                    fetch(renovar_mensalidade,{
                        method:'POST',
                        body:FormMensalista,
                        credentials:'same-origin'
                    }).then((result)=>{
                        if(!result.ok){
                            Swal.fire({
                                title:'Ops! Erro ao renovar mensalidade.',
                                text:result.statusText+" ("+result.status+")",
                                icon:'error'
                            });
                        }else{
                            return result.json();                           

                        }
                    }).then((resposta)=>{
                        if(resposta.pagamento && resposta.horario && resposta.fluxo_diario){
                            Toast.fire({
                                icon:'success',
                                title:'Mensalidade efetuada!'
                            });
                        }else{
                            Swal.fire({
                                title:'Ops! Erro ao salvar mensalidade.',
                                html:"Pagamento: "+resposta.pagamento+"<br>"+
                                "Horario: "+resposta.horario+"<br>"+
                                "Fluxo diario: "+resposta.fluxo_diario,
                                icon:'error'
                            });
                        }
                    });

                }
            }

        }else{
            Swal.fire('OPS!','Você precisa informar a placa do veículo!','warning');
        }
    });
    $(document).on('click','.tipo_mensalista',async function(){
        var tipo_veiculo = $(this).val();
        buscaPrecoMensalidade(tipo_veiculo);
    });
    $(document).on('input','#id_desconto',function(){
        if($('#id_desconto').val()==0 || $('#id_desconto').val()=='' || $('#id_desconto').val()==null ){
            $('.justificativa').hide(500);
        }else{
            $('.justificativa').show(500);            
        }
        var valor = $('#id_valor').val();
        if($('#id_desconto').val()==''){
            var desconto = 0;     
            desconto = parseFloat(desconto);                  
        }else{
            var desconto = $('#id_desconto').val();
            desconto = desconto.replace(',','.');
            desconto = parseFloat(desconto);
        }
        valor = valor.replace(',','.');
        valor = valor.replace('R$ ','');        
        valor = parseFloat(valor);
        var total = valor - desconto;
        if(Number.isInteger(total)){
            total = "R$ "+total+",00";
        }else{
            total = "R$ "+total;
            total = total.replace(',','');
            total = total.replace('.',',');
        } 
        $('#id_total').val(total);
    });
    $(document).on('input','#id_tempo',function(){
        Swal.resetValidationMessage();
    });
    $(document).on('change','#id_nome',async function(){
        var telefone  = $('#list_pessoas [value="'+$('#id_nome').val()+'"]').data('id');
        var buscaFone = await fetch(url_busca_telefone+"/"+telefone)
        .then((result)=>{
            if(result.ok){
                return result.json();
            }else{
                return false;
            }
        });
        if(buscaFone){
            $('#id_telefone').val(buscaFone.telefone);
        }
    });
    $(document).on('change','#id_dataEntrada',function(){
        var date = this.valueAsDate;
        date.setDate(date.getDate() + 30);
        $('#id_dataSaida')[0].valueAsDate = date;
    });
    $(document).on('input','#id_justificativa',function(){
        Swal.resetValidationMessage();  
    });   
    $(document).on('click','#chave_desconto',function(){  
        $('.alert').remove();
        if(!$("input[name='inserir_chave']").prop("disabled") ){
            if($("input[name='inserir_chave']").prop("checked")){
                $('.fieldChave').show(500);            
                $(".efetuarPagamento").hide(500);
            }else{
                $('.fieldChave').hide(500);
                $(".efetuarPagamento").show(500);
            }
        }  
    });
    $(document).on('click','.btn-key', async function(){
        var id = $(this).data('id');
        var horario_entrada = $(this).data('timeestacionamento');
        var tokenTempo = createInput('tempo','Tempo (mins)','number',true);
        if(!$(this).data('key')){
            var placa = $(this).data('placa');
            var gerarChave = await swal.fire({
                title:'<h4 id="titulo_key">Gerar Chave</h4>',
                html:"Deseja gerar uma chave de desconto para o carro "+placa+" ?"+
                "<br><p>Esse carro estacionou às <b>"+horario_entrada+"</b></p>"+
                "<div class='row'>"+
                    "<div class='col-3'>"+tokenTempo.label+"</div>"+
                    "<div class='col-7'>"+tokenTempo.input+"</div>"+
                "</div>",  
                showCancelButton: true,                
                icon:'question',
                cancelButtonText:"Sair.", 
                onOpen:()=>{
                    $('#id_tempo').attr('placeholder','Tempo em minutos');
                },
                preConfirm:()=>{
                    
                    if($('#id_tempo').val()==''){
                        Swal.showValidationMessage("O campo tempo é obrigatório.");
                        return false;
                    }else{
                        
                        return true;
                    }
                }
            });
            if(gerarChave.value){  
                var tempo =$('#id_tempo').val();
                swal.fire({text:"Gerando chave...",});
                var key = await gerarkey(id,'create',tempo); 
                
                if(key){
                    swal.fire({
                        title:'Chave de Desconto: '+key.codigo,
                        text:'Chave gerada com sucesso!!',
                        icon:'success'
                    });
                    $(this).data('key',key.codigo);
                }
            }
        }else{
            var renovar;
            (renovar) = await swal.fire({
                title:'Chave de Desconto: <b>'+$(this).data('key')+'</b>',
                html:'Chave gerada : <b>'+$(this).data('timekey')+'</b><br><i>Tempo:'+$(this).data('tempo_chave')+'</i>'+
                '<div class="row m-t-20">'+
                    '<div class="col-3">'+tokenTempo.label+'</div>'+
                    '<div class="col-7">'+tokenTempo.input+'</div>'+
                '</div>',
                icon:'info',
                showCancelButton: true,
                showConfirmButton:true,
                confirmButtonText:"Renovar Chave...",                
                cancelButtonText:"Sair.",
                showLoaderOnConfirm: true,
                onOpen:()=>{
                    $('#id_tempo').attr('placeholder','Tempo em minutos');
                    $('#id_tempo').val(parseInt($(this).data('chave_minTotal')));
                },
                preConfirm:()=>{
                    if($('#id_tempo').val()==''){
                        Swal.showValidationMessage("O campo tempo é obrigatório.");
                        return false;
                    }else{
                        
                        return true;
                    }
                }                
            });
            if(renovar.value){
                var tempo =$('#id_tempo').val();
                swal.fire({text:"Gerando chave...",});
                var key = await gerarkey(id,'update',tempo); 
                
                if(key){
                    swal.fire({
                        title:'Chave de Desconto: '+key.codigo,
                        text:'Chave gerada com sucesso!!',
                        icon:'success',
                    });
                    $(this).data('key',key.codigo);
                    montarTable();
                }
            }
        }
    });
    $(document).on('input','.money2',function(){      
        Swal.resetValidationMessage();  
        if(server.calculo.valor){

            var valor = server.calculo.valor;
            if($('#id_desconto').val()==''){
                var desconto = 0;     
                desconto = parseFloat(desconto);                  
            }else{
                var desconto = $('#id_desconto').val();
                desconto = desconto.replace(',','.');
                desconto = parseFloat(desconto);
            }
            if($('#id_pago').val()==''){
                var dinheiro = 0;     
                dinheiro = parseFloat(dinheiro);                  
            }else{
                var dinheiro = $('#id_pago').val();
                dinheiro = dinheiro.replace(',','.');
                dinheiro = parseFloat(dinheiro);
            }
            valor = valor.replace(',','.');
            valor = valor.replace('R$ ','');        
            valor = parseFloat(valor);
            var troco = (valor-desconto)-dinheiro; 
            if(troco<0){
                troco = troco*-1;
            }
            if(Number.isInteger(troco)){
                troco = "R$ "+troco+",00";
            }else{
                troco = "R$ "+troco;
                troco = troco.replace(',','');
                troco = troco.replace('.',',');
            }       
            
            $("#id_troco").val(troco);
        
        }
    });
    $(document).on('click','#key-checking',async function(){
        $('#key-checkin').removeClass('ion-checkmark');
        $('#div_field_chave').append('<div class="loader-block">'+
        '<svg id="loader2" viewBox="0 0 100 100">'+
        '<circle id="circle-loader2" cx="50" cy="50" r="45"></circle>'+
        '</svg>'+
        '</div>');
        $('.alert').remove();
        url = url_checkingKey+"/"+$(this).data('fluxo')+"/"+$('#id_chave').val();
        var checking = await fetch(url)
        .then((result)=>{
            if(!result.ok){
                swal.fire({
                    title:'Ops! Ocorreu um erro ao verificar essa chave.',
                    text: "("+result.status+") "+ result.statusText,
                    icon:'error',
                });
                return false;
            }else{
                return result.json();
            }
        });
        $('.loader-block').remove();
        if(checking){
            if(checking.token){
                $('#key-checking').css({
                    color:'#09d003'
                });
                $('#div_checking').after("<div class='alert'>"+
                "<div class='alert-success'>"+checking.menssagem+"</div>"+
                "</div>"); 
                $('.fade-in-primary').addClass('fade-in-disable');
                $('.fade-in-disable').removeClass('fade-in-primary');
                $("input[name='inserir_chave']").prop("disabled",true);
                server = await saidaEstacionamento($(this).data('fluxo'));
                var titulo='';
                if(server.calculo.token){
                    titulo = "<h5>Tempo Estacionado <b>"+server.calculo.duracao_original+"</b></h5>"+
                    "<h5>Abatimento <b>"+server.token.tempo.tempo+"</b></h5>"+
                    "<h4>Resultado <b>"+server.calculo.duracao+"</b></h4>"+
                    "<h4>Valor:<b>"+server.calculo.valor+"</b></h4>";
                }else{
                    titulo = "<h5>Tempo Estacionado <b>"+server.calculo.duracao+"</b></h5>"+           
                    "<h4>Valor:<b>"+server.calculo.valor+"</b></h4>";
                }
                
                setTimeout(function(){
                    $('#titulo-box-saida').html(titulo);
                    $('.alert').remove();  
                    $('.fieldChave').hide(500);
                    $(".efetuarPagamento").show(500);        
                },1000);
            }else{
                $('#key-checking').css({
                    color:'#d00303'
                });
                $('#div_checking').after("<div class='alert'>"+
                "<div class='alert-warning'>"+checking.menssagem+"</div>"+
                "</div>");                
            }
        }

    });
});
$(document).on('click','#btn-pg-sair',async function(){
   var cod=$('#placa_saida').val();       
   server = await saidaEstacionamento(cod);
   var titulo='';
   if(server.calculo){
       if(server.pagamento==true){
            Toast.fire({
                icon:'success',
                title:'Pagamento Efetuado!!'
            })
       }else{

        if(server.calculo.token){
            titulo = "<h4>Tempo Estacionado <b>"+server.calculo.duracao_original+"</b></h4>"+
            "<h4>Abatimento <b>"+server.token.tempo.tempo+"</b></h4>"+
            "<h4>Resultado <b>"+server.calculo.duracao+"</b></h4>"+
            "<h4>Valor:<b>"+server.calculo.valor+"</b></h4>";
        }else{
            titulo = "<h5>Tempo Estacionado <b>"+server.calculo.duracao+"</b></h5>"+           
            "<h4>Valor:<b>"+server.calculo.valor+"</b></h4>";
        }
       pago = createInput('pago','*Dinheiro','text',true);
       desconto = createInput('desconto','Desconto','text',true);
       troco = createInput('troco','Troco','text',true);
       chave = createInput('chave','Chave','text',true);
       (pagamento) = await swal.fire({
           title:'<h3>Carro '+server.placa+"</h3>",
           showCancelButton:true,
           cancelButtonText:"Sair",
           html:"<div class='titulo-box-saida'>"+titulo+"</div>"+
           "<div class='row m-t-20'>"+
           "<div class='col-2 efetuarPagamento'>"+pago.label+"</div><div class='col-10 efetuarPagamento'>"+pago.input+"</div>"+
           "<div class='col-2 m-t-10 efetuarPagamento'>"+desconto.label+"</div><div class='col-10 m-t-10 efetuarPagamento'>"+desconto.input+"</div>"+
           "<div class='col-2 m-t-10 efetuarPagamento'>"+troco.label+"</div><div class='col-10 m-t-10 efetuarPagamento'>"+troco.input+"</div>"+
           "<div class='col-2 m-t-10 fieldChave'>"+chave.label+"</div><div class='col-8 m-t-10 fieldChave' id='div_field_chave'>"+chave.input+"</div>"+"<div class='col-1 m-t-10 fieldChave btn' id='div_checking' ><i id='key-checking' data-fluxo='"+cod+"' class='ion-checkmark'></i></div>"+
           "<div class='col-2 m-t-10 justificativa'><label>*Justificar Desconto</label></div><div class='col-10 m-t-10 justificativa'><textarea rows='5' name='justificativa' placeholder='Insira uma justificativa para o desconto realizado' class='form-control' id='id_justificativa'></textarea></div>"+
           "<div class='col-12 m-t-10'>"+
                   "<div class='row'>"+
                       "<div class='col-6'>"+
                           "<div class='checkbox-fade fade-in-primary'>"+
                           "<label>"+
                               "<input type='checkbox' name='imprimir' value=''>"+
                               "<span class='cr'>"+
                                   "<i class='cr-icon icofont icofont-ui-check txt-primary'></i>"+
                               "</span>"+
                               "<span>Imprimir Cupom</span>"+
                           "</label>"+
                           "</div>"+
                       "</div>"+
                       "<div class='col-6'>"+
                           "<div class='checkbox-fade fade-in-primary' id='chave_desconto'>"+
                               "<label>"+
                                   "<input type='checkbox' name='inserir_chave' value=''>"+
                                   "<span class='cr'>"+
                                       "<i class='cr-icon icofont icofont-ui-check txt-primary'></i>"+
                                   "</span>"+
                                   "<span>Chave de Desconto</span>"+
                               "</label>"+
                           "</div>"+
                       "</div>"+
                   "</div>"+
           "</div>"+
           "</div>",
           onOpen:()=>{
                   $('#id_pago').addClass('money2');
                   $('#id_desconto').addClass('money2');
                   $('#id_troco').prop('disabled',true);
                   $('#id_troco').val('R$ 0,00');
                   $('.justificativa').hide();
                   $('.fieldChave').hide();
           },
           preConfirm:()=>{
               if($('#id_pago').val()!=''){
                   var dinheiro = $('#id_pago').val();
                   var valor = server.calculo.valor;
                   if($('#id_desconto').val()==''){
                       var desconto = 0;     
                       desconto = parseFloat(desconto);                  
                       }else{
                           var desconto = $('#id_desconto').val();
                           desconto = desconto.replace(',','.');
                           desconto = parseFloat(desconto);
                   }
                   valor = valor.replace(',','.');
                   valor = valor.replace('R$ ','');
                   dinheiro = dinheiro.replace(',','.');
                   dinheiro = parseFloat(dinheiro);
                   valor = parseFloat(valor);
                       if(dinheiro<(valor-desconto)){
                           var menssagem = "O valor inserido é invalido";                                   
                           Swal.showValidationMessage(menssagem);                        
                           return false;
                       }else{
                           if(desconto!=0 && $('#id_justificativa').val()==''){
                               Swal.showValidationMessage("O campo JUSTIFICATIVA é obrigatório.");
                               return false
                           }else{
                               return true;                            
                           }
                       }
               }else{
                   var menssagem = "O campo dinheiro deve ser preenchido";
                   Swal.showValidationMessage(menssagem);         
                   return false;
               }
           }
       });
           pg = pagamento.value;
       if(pg){//Efetuando pagamento e imprimindo comprovante
               var dinheiro =$('#id_pago').val();
               var desconto =$('#id_desconto').val() == ''? '' : $('#id_desconto').val();
               var justificativa = $('#id_justificativa').val() == '' ? false : $('#id_justificativa').val();
               var troco =$('#id_troco').val();
               var imprimir = $("input[name='imprimir']").prop("checked");          
               
               //console.log('Dinheiro: '+dinheiro+'\nDesconto: '+desconto+'\nJustificativa: '+justificativa+'\nTroco: '+troco+'\nImprimir: '+imprimir);
               var efetuaPagamento = await saidaEstacionamento(cod,pg,dinheiro,desconto,justificativa,troco,imprimir,server);
               if(efetuaPagamento){
                   if(efetuaPagamento.pagamento){
                       Toast.fire({
                           icon: 'success',
                           title: 'Pagamento Efetuado!!'
                       })
                   }
                   montarTable();
               }
       }
       server = '';
       }
   }
});
$(document).on('click','.radio-modalidade',function(){
    $("input[name='modalidade']").attr('checked',false);
    var modalidade = $(this).data('value');    
    $("input[name='modalidade'][value='"+modalidade+"']").attr('checked',true);
});
$(document).on('click','.radio-veiculo',function(){
    $("input[name='tipo']").attr('checked',false);
    var veiculo = $(this).data('value');    
    $("input[name='tipo'][value='"+veiculo+"']").attr('checked',true);
});
async function gerarkey(id,method = 'create',tempo){//Função para gerar chave de liberação    
    var data = new FormData();  
    data.append('method',method);
    data.append('id_fluxo',id);
    data.append('tempo',tempo);
    chave = await fetch(url_keyGeneration,{
        headers:{
            'X-CSRF-TOKEN':_token,
        },
        method:'POST',
        body:data,
        credentials:'same-origin',
    }).then((result)=>{      
        if(result.ok){
           return result.json();
        }else{
           swal.fire({
               title:result.status,
               html:result.statusText,
               icon:'error',
           });
           return false;
        }
       
    });
    return chave;
}
async function saidaEstacionamento(cod,pago='',dinheiro='',desconto='',justificativa='',troco='',imprimir='',server=''){
    data = new FormData();
    data.append('cod',cod);
    data.append('pago',pago);
    data.append('desconto',desconto);  
    if(imprimir){
        data.append('imprimir',imprimir);            
    }else{
        data.append('imprimir','');            
    } 
    data.append('dinheiro',dinheiro);
    data.append('troco',troco);
    data.append('justificativa',justificativa);
    if(server){
        
        data.append('h_saida',server.calculo.hora_saida);
        data.append('m_saida',server.calculo.min_saida);
        data.append('token',server.calculo.token);
        if(server.calculo.token){
            data.append('duracao_token',server.token.tempo.tempo);
        }else{
            data.append('duracao_token','');

        }
        data.append('duracao',server.calculo.duracao);
        data.append('duracao_original',server.calculo.duracao_original);
        
        data.append('valor',server.calculo.valor);

    }
    (calc) = await fetch(url_calc,{
            method:'POST',
            credentials:"same-origin",
            headers:{
                'X-CSRF-TOKEN':_token,
            },
            body:data

        }).then((result)=>{
            if(result.ok){
                return result.json();
            }else{

                swal.fire({
                    title:'Erro ao dar saida neste veiculo.',
                    text:result.statusText+" ("+result.status+")",
                    icon:'error'
                });
                return false;
            }
        });
    return calc;
}
function montarTable(){
   
    fetch(url_busca,{'method':'GET'}).then((result)=>{
        if(!result.ok){
            return{"busca":false}
        }else{
            return result.json();
            
        }
       
    }).then((resposta)=>{
        var linhasTBL = "";
        var placas_saida="";
        dados = resposta.dados;
        var icone_veiculo=null;
        var style;
    $('#placa_saida').html("<option>Selecione uma placa...</option>");      
    for(var i=0;i<resposta.total_registros;i++){        
        if(dados[i].tipo_veiculo=='M'){
            icone_veiculo = 'icofont-motor-bike';  
            style ='font-size: 21px;'           
        }else{
            icone_veiculo='icofont-police-car-alt-2';
            style=null;
        }
        if(dados[i].modalidade=='Rotativo'){
            btn_geraChave = "&nbsp;&nbsp;&nbsp;&nbsp;"+
            "<i style='"+style+"' data-key='"+dados[i].chave+"' data-timeKey='"+dados[i].horario_chave+"' data-id="+dados[i].id_fluxo+" data-placa="+dados[i].carro+" data-timeEstacionamento='"+dados[i].horario_entrada+"' data-tempo_chave='"+dados[i].tempo_chave.tempo+"'  data-chave_minTotal='"+dados[i].tempo_chave.total_min+"' class='icofont icofont-key btn-key'></i>";
            
        }else{
            btn_geraChave='';
        }
        
       placas_saida=placas_saida+"<option value='"+dados[i].id_fluxo+"'>"+dados[i].carro+"</option>";
        linhasTBL = linhasTBL+
        "<tr>"+
            "<td>"+dados[i].carro+"</td>"+
            "<td>"+dados[i].horario_entrada+"</td>"+
            "<td>"+dados[i].tempo+"</td>"+
            "<td>"+dados[i].valor+"</td>"+
            "<td>"+dados[i].modalidade+"</td>"+
            "<td>"+
            "<i data-id="+dados[i].id_fluxo+" data-placa="+dados[i].carro+" data-tipo_veiculo="+dados[i].tipo_veiculo+" data-modalidade="+dados[i].modalidade2+" data-horario="+dados[i].horario_entrada+" class='ion-edit btn-update'></i>"+
            "&nbsp;&nbsp;&nbsp;&nbsp;"+
            "<i data-id="+dados[i].id_fluxo+" data-placa="+dados[i].carro+"  data-dono='"+dados[i].dono+"' class='ion-close-circled btn-delete'></i>"+
            "&nbsp;&nbsp;&nbsp;&nbsp;"+
            "<i style='"+style+"' data-icon='"+icone_veiculo+"' data-id="+dados[i].id_fluxo+" data-placa="+dados[i].carro+"  data-obs='"+dados[i].obs_ligar+"' data-fone='"+dados[i].telefone+"'  data-dono='"+dados[i].dono+"' class='icofont "+icone_veiculo+" btn-detalhes'></i>"+
            btn_geraChave+
            "</td>"+
        "</tr>";
      
    } 
    $('#placa_saida').append(placas_saida);
    $('.select2-search__field').addClass('placa');
    $('.placa').mask('AAA-0A00');
    $('#minha_tabela').DataTable().destroy();
    $('#body_tblCARestacionados').html(null);
    $('#minha_tabela').find('tbody').append(linhasTBL);
    $('#minha_tabela').DataTable({
            "scrollY": '50vh',
            "scrollCollapse": true,
            "paging": false,
            "searching": true,
            "language": {
                "decimal": ",",
                "lengthMenu":     "Mostrar _MENU_ registros",
                "thousands": ".",
                "search":         "Buscar:",
                "emptyTable":     "Nenhum registro cadastrado.",
                "info":           "Mostrando _START_ de _END_ de _TOTAL_ registros",
                "infoEmpty":      "Moostrando 0 de 0 registros",
                paginate: {
                    first:    '«',
                    previous: '‹',
                    next:     '›',
                    last:     '»'
                }
            },
    });
    
    
    
    //Atualiza Estatisticas do estacionamento
    var y = (resposta.total_registros*100)/40;
    if(y<100){
        range_change_event(y);
    }else{
        range_change_event(100);
    }
    $('#slider').val(y);
    $('#total_de_veiculos').html(resposta.total_registros);
    $('#rotativo').html(resposta.num_rotativo);
    $('#free').html(resposta.num_free);
    $('#mensalista').html(resposta.num_mensalista);
    
    });
    
      
}
function createInput(name,label,type,required){
        
    var id="id_"+name;
    var input = "<input name='"+name+"' id='"+id+"' type='"+type+"' required='"+required+"' class='form-control'/>";
    var lbl = "<label>"+label+"</label>";
    var campo={}
    campo={
        label:lbl,
        input:input,
    };
                
    
    return campo;
}
function createInputModalidade(){
    
        modalidade_input = "<h5 class='text-center m-t-5 m-b-15'>Modalidade</h5>"+
        "<div class='form-radio m-b-30'>"+
                        "<div class='radio radio-matrial radio-primary radio-inline radio-modalidade' data-value='hora'>"+
                            "<label>"+
                                "<input type='radio'  value='hora' name='modalidade' >"+
                                "<i class='helper'></i>Por hora"+
                            "</label>"+                                
                        "</div>"+                            
                        "<div class='radio radio-matrial radio-primary radio-inline radio-modalidade' data-value='diaria'>"+
                            "<label>"+
                                "<input type='radio'  value='diaria' name='modalidade' >"+
                                "<i class='helper'></i>Diária"+
                            "</label>"+
                                               
                        "</div>"+                            
                        "<div class='radio radio-matrial radio-primary radio-inline radio-modalidade' data-value='pernoite'>"+
                            "<label>"+
                                "<input type='radio'  value='pernoite' name='modalidade' >"+
                                "<i class='helper'></i>Pernoite"+
                            "</label>"+                                 
                        "</div>"+                            
                "</div>";
   
    return modalidade_input;
}
function createInputTipo_Veiculo(){    

 
    
        
        var veiculo_input = "<h5 class='text-center m-t-5 m-b-15'>Veículo</h5>"+
        "<div class='form-radio m-b-30'>"+
                        "<div class='radio radio-matrial radio-primary radio-inline radio-veiculo' data-value='M'>"+
                            "<label>"+
                                "<input type='radio' value='M' name='tipo' >"+
                                "<i class='helper'></i>Moto"+
                            "</label>"+                                
                        "</div>"+                            
                        "<div class='radio radio-matrial radio-primary radio-inline radio-veiculo' data-value='C'>"+
                            "<label>"+
                                "<input type='radio' value='C' name='tipo'  >"+
                                "<i class='helper'></i>Carro"+
                            "</label>"+
                                               
                        "</div>"+                           
                                                
                "</div>";
    
    return veiculo_input;
}
function createRadioSexo(){
    
        
        var sexo_input = "<h5 class='text-center m-t-5 m-b-15'>Sexo</h5>"+
        "<div class='form-radio m-b-30'>"+
                        "<div class='radio radio-matrial radio-primary radio-inline radio-sexo' data-value='M'>"+
                            "<label>"+
                                "<input type='radio' value='1' name='sexo' >"+
                                "<i class='helper'></i>Masculino"+
                            "</label>"+                                
                        "</div>"+                            
                        "<div class='radio radio-matrial radio-primary radio-inline radio-sexo' data-value='F'>"+
                            "<label>"+
                                "<input type='radio' value='2' name='sexo'  >"+
                                "<i class='helper'></i>Feminino"+
                            "</label>"+
                                               
                        "</div>"+                           
                                                
                "</div>";
    
    return sexo_input;

}
function createTextArea(name,label,rows,placehoder){
        
    var id="id_"+name;
    var input = "<textarea name='"+name+"' id='"+id+"' rows='"+rows+"' placehoder='"+placehoder+"' class='form-control'></textarea>";
    var lbl = "<label>"+label+"</label>";
    var campo={}
    campo={
        label:lbl,
        input:input,
    };
                
    
    return campo;
}
function verificaUpdate(new_placa,old_placa,new_entrada,old_entrada,new_veiculo,old_veiculo, new_modalidade, old_modalidade){
     if( (new_placa==old_placa) && (new_entrada==old_entrada) && (new_veiculo==old_veiculo) && (new_modalidade==old_modalidade)){
        return false
    }else{
        return true;
    }
}
async function buscaPrecoMensalidade(tipo_veiculo){
    var myform = new FormData();
        myform.append('modalidade','mensalidade');
        myform.append('tipo_veiculo',tipo_veiculo);
        myform.append('_token',_token);
        (valor) = await fetch(url_busca_preco_mensalidade,{
            method:'POST',
            credentials:'same-origin',
            body:myform,
        }).then((result)=>{
            if(result.ok){
                return result.json();
            }else{
                return false;
            }
        });
        
        if(valor){
            $('#total').show(300);
            $('#pago').show(300);
            //$('.justificativa').show(300);
            $('#valor').show(300);
            $('#desconto').show(300);
            $('#id_desconto').addClass("money2");
            $('#id_pago').addClass("money2");
            $('#id_valor').val("R$ "+number_format(valor.preco,2,',','.'));
            $('#id_valor').data('base',valor.base);
            $('#id_valor').data('id_preco',valor.id_preco);
            $('#id_total').val("R$ "+number_format(valor.preco,2,',','.'));
            $('#id_valor').prop('disabled',true );
            $('#id_total').prop('disabled',true );            
            
        }
}