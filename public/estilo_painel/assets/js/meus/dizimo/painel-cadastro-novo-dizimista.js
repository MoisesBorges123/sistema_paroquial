
$(document).ready(function(){
    
   
    $('.cep').mask('00000-000');
    $('.phone').mask('0000-0000');
    //CAMPOS DO CADASTRO DE TELEFONE
    var linha_telefone = 1;
    $('.clearfix').addClass('bg-inverse');
    $(document).on('input','#userName-22',function(){
           
        clearTimeout(this.interval);
   
         
        this.interval = setTimeout(function () {
           
      
        
            var nome = $('#userName-22').val();
            $.ajax({
                url:nome_duplicidade,
                type: 'POST',
                data:{ nome:nome },
                dataType:'JSON',
                beforeSend: function(){
                  
                },
                success: function(data){
                   if(data.id>0 && data.dizimista==0){
                      Swal.fire({
                         
                          title:"<h2 style='margin-top:auto;'>Woli</h2> <img src = '"+woli+"' width='100' height='70'>",
                          allowOutsideClick:false,
                          allowEscapeKey:false,
                          allowEnterKey:false,
                          html:"<h4>Acho que já conheço essa pessoa preciso que confirme os dados abaixo:</h4><br>"+
                                  "<p>Nome: "+data.nome+"<br>Endereço: "+data.rua+", "+data.bairro+", CEP: "+data.cep+"</p>",
                           showCancelButton: true,
                           confirmButtonText:"Sim, é esta pessoa",
                           cancelButtonText:"Não, é outra pessoa",
                           cancelButtonColor: '#d33',
                           //confirmButtonColor: '#43b51a',
                           icon:'question'
                      }).then((result) => {
                          if (result.value) {
                              if(data.data_nascimento==null || data.telefone==null){
                              //if(data.cidade==null || data.bairro==null || data.data_nascimento==null || data.cep==null || data.telefone==null || (data.num_casa == null && data.apta==null)){ 
                                  
                                    
                                  if(data.cidade==null){
                                    var cidade = '<br><label>Cidade</label><input class="form-control" name="txt_cidade" required>';
                                    
                                  }else{
                                    var cidade=' ';
                                  }
                                  if(data.num_casa==null){
                                    var num_casa = '<br><label>Cidade</label><input class="form-control" name="txt_cidade" required>';
                                    
                                  }else{
                                    var num_casa=' ';
                                  }
                                  if(data.num_casa==null){
                                    var num_casa = '<br><label>Cidade</label><input class="form-control" name="txt_cidade" required>';
                                    
                                  }else{
                                    var num_casa=' ';
                                  }
                                  
                                  if(data.bairro==null){
                                    var bairro = '<br><label>Bairro</label><input class="form-control" name="txt_bairro" required>';
                                   

                                  }else{
                                      var bairro=' ';
                                  }
                                  if(data.cep==null){
                                    var cep = '<br><label>CEP</label><input class="form-control cep" type="text" name="txt_cep" required>';
                              
                                      
                                  }else{
                                      var cep=' ';
                                  }
                                  if(data.data_nascimento==null){
                                    
                                    var nascimento = '<label>Data Nascimento</label><input type="date" class="form-control" name="d_nasc" id="txt_nasciemento" required>';
                                      
                                  }else{
                                      var nascimento=' ';
                                  }
                                  if(data.telefone==null){
                                   
                                    var telefone = '<br><label>Telefone</label><input class="phone_area-code form-control" name="txt_telefone" required>';
                                      
                                  }else{
                                      var telefone=' ';
                                  }
                                  var _token  = '<input type="hidden" name="_token" value="'+token+'">';
                                  var id  = '<input type="hidden" name="pessoa" value="'+data.id+'">';
                           const { value: formValues } =  Swal.fire({
                               title:"<h2 style='margin-top:auto;'>Woli</h2> <img src = '"+woli+"' width='100' height='70'>",
                               allowOutsideClick:false,
                          allowEscapeKey:false,
                          allowEnterKey:false,                                                              
                               html:"<h5>Quase tudo pronto, por favor ajude o <b>Woli</b> terminar de preencher esses dados para inserir o novo dizimista.<br><br></h5><form method='POST' id='form_dizimista'> "+id+_token+nascimento+cep+bairro+cidade+telefone+"</form>",
                               focusConfirm: false,
                               confirmButtonText:"Enviar &nbsp;<i class=\"icofont icofont-location-arrow\"></i>",
                               showLoaderOnConfirm: true,
                               preConfirm:()=>{                                 
                                
                                   
                                   fetch(
                                           salvar_outros_dados,//Caminho
                                           {
                                            credentials: "same-origin",
                                            method:'POST',
                                            body: new FormData(document.getElementById('form_dizimista'))
                                           }        
                                   
                                       ).then(response =>{
                                           var resposta = response.json();
                                           console.log(resposta.erro);
                                           if (resposta.erro==0){
                                               swal.fire('Parabens!', 'Dizimista cadastrado com sucesso.','success');
                                               setTimeout(function(){window.location.href=resposta.url},500);
                                           }else{
                                               swal.fire('OPS!', 'Ocorreu um erro inesperado.','error');
                                               
                                           }
                                       });
                               },
                                allowOutsideClick: () => !Swal.isLoading()
                           });
                       
                          }else{ // SE TODOS OS CAMPOS JÁ ESTÃO PREENCHIDOS ENTÃO CADASTRE O DIZIMISTA
                              $.ajax({
                                  url:ser_dizimista,
                                  data:{pessoa:data.id},
                                  dataType:'JSON',
                                  type:'POST',
                                  success: function(data2){
                                      
                                      if(data2.cadastro==true){
                                          Swal.fire("Parabéns!",data.nome+" agora é um dizimista!","success");
                                          setTimeout(function(){
                                              window.location.href=meus_dizimistas;
                                          },3000);
                                      }else{
                                          Swal.fire("Woli","Aconteceu um problema inesperado, por favor tente mais tarde.","error");
                                          
                                      }
                                  }
                                  
                                          
                              });
                          }
                      }
});
                       
                   }else if(data.id > 0 && data.dizimista==1){
                        Swal.fire({
                           title:"<h2 style='margin-top:auto;'>Woli</h2> <img src = '"+woli+"' width='100' height='70'>",
                          html:"Ops! Esse dizimista já existe!",
                          icon:'warning',                                                          
                      }).then((result) => {
                          if (result.value) {
                            $('#userName-22').val(null);
                          }
                        });
                       
                   }
                }
            });
         },
                500//Tempo de Espera para executar a função
                );
    
        
    });
    $(document).on('input','.dd',function(){
        if($(this).val().length==2){
            id = linha_telefone+22;
            $('#telefone-'+id).focus();
        }
    }); //Após digitar o DD altere o foco para o telefone
    $(document).on('click','.adiciona-telefone',function(){
        linha_telefone++;
        var cod = linha_telefone+22;
        var txt_dd= "<div class=\"col-sm-2\" >"
                    +"<input id=\"dd-"+cod+"\" name=\"dd[]\" type=\"text\" class=\"form-control\" maxlength=\"2\">"

                +"</div>";
        var txt_telefone ="<div class=\"col-sm-8\">" 
                            +"<input id=\"telefone-"+cod+"\" name=\"fone[]\" type=\"text\" class=\"form-control phone\">"
                        +"</div>";
        var btn_adiciona_telefone="<div class=\"col-sm-2\">"
                                    +"<button class='btn btn-warning adiciona-telefone' data-linha="+linha_telefone+"  type='button'>+</button>"
                                "</div>";
        
        $(this).removeClass('btn-warning');
        $(this).addClass('btn-outline-danger');
        $(this).html("Remover"); 
        $(this).removeClass('adiciona-telefone');
        $(this).addClass('remove-telefone');
        
        //INSERE UM NOVO CAMPO PARA O USUARIO DIGITAR SEU TELEFONE
        $('#form-contato').after("<div class='form-group row linha-telefone' id='linha"+linha_telefone+"'>"
                                    +"<div class='col-sm-12'>"
                                        +"<label for='telefone-"+cod+"' class='block'>Telefone</label>"
                                    +"</div>"
                                    +txt_dd
                                    +txt_telefone
                                    +btn_adiciona_telefone
        );
        $('.phone').mask('0000-0000');
    }); //Inserir novos campos telefone
    $(document).on('click','.remove-telefone',function(){
        var linha=$(this).data('linha');
        $("#linha"+linha).remove();
    });// Removoer campos telefone inseridos
    $(document).on('input','.phone', function(){
        var telefone = $(this).val();
        if(telefone.substr(0,1)=='9'){
            $(this).mask('00000-0000');
        }else{
            $(this).mask('0000-0000');            
        }
    }); //Coloca a mascara no telefone de acordo se for um celular ou telefone fixo
    $(document).on('input','.cep',function(){
        var cep = $(this).val();
        
        if(cep.length==9){
            
            $.ajax({
                url:busca_cep,
                type: 'POST',
                data:{ cep:cep },
                dataType:'JSON',
                beforeSend: function(){
                    $('.carregando').remove();
                    $('#load_cep').html(                   
                        "<div class=\"preloader3 loader-block carregando\">"+
                                "<div class=\"circ1\"></div>"+
                                "<div class=\"circ2\"></div>"+
                                "<div class=\"circ3\"></div>"+
                                "<div class=\"circ4\"></div>"+
                        "</div>"                   
                    );
                },
                success: function(data){
                    $('.carregando').remove();
                
                    console.log(data)
                    if(data['logradouro'][0]){
                       console.log("if - 1");
                        $('#rua-22').val(data['logradouro'][0]);
                        $('#bairro-22').val(data['bairro'][0]);
                        $('#cidade22').val(data['cidade'][0]);
                        $('#txt_estados').val(data['estado']);
                        
                    }else if(data['logradouro']){
                        $('#rua-22').val(data['logradouro']);
                        $('#bairro-22').val(data['bairro']);
                        $('#cidade22').val(data['cidade']);
                        $('#txt_estados').val(data['estado']);
                       console.log("if - 2");
                    }
                }
            });
        }
    });
});

