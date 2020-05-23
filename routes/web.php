<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return view('painel\dashboard');
})->name('dashboard');

//TRABALHANDO COM PESSOAS
Route::group(['prefix'=>'painel/pessoas/'],function(){
    Route::get('list','Painel\Pessoa\Pessoa@list')->name('Listar.Pessoas');
    Route::get('fetch/{pessoa}','Painel\Pessoa\Pessoa@getpeople')->name('Fetch.Pessoas');
});

    

//GRUPO DE ROTAS PARA TRABALHAR COM A AREA DE DÍZIMO
Route::group(['prefix'=>'painel/dizimo/'],function(){

    //ROTAS RELACIONADAS AO CADASTRO DE DIZIMISTA
    Route::group(['prefix'=>'cadastro/'],function(){
        Route::get('meus-dizimistas/','Painel\Dizimo\Dizimista@index')->name('Visualizar.Dizimista');
        Route::get('dizimista/{dizimista}','Painel\Dizimo\Dizimista@verificaDadosCadastrais')->name('Verificacoes.Dizimista');
        Route::post('meus-dizimistas/','Painel\Dizimo\Dizimista@meus_dizimistas')->name('CarregarTble.Dizimista');
        Route::get('novo-dizimista','Painel\Dizimo\Dizimista@cadastro')->name('FormCadastro.Dizimista'); //CARREGA FORMULÁRIO PARA CADASTRAR DIZIMISTA (está desuso CUIDADO NA HORA DE RETIRAR, NÃO É UM SIMPRES DELETE)
        Route::get('deleta-dizimista/{id_dizimista}','Painel\Dizimo\Dizimista@delete')->name('Deleta.Dizimista');
        Route::get('restaura-dizimista/{id_dizimista}','Painel\Dizimo\Dizimista@restore')->name('Restaura.Dizimista');
        Route::post('insert-dizimistas','Painel\Dizimo\Dizimista@salva_dizimista')->name('Insert.Dizimista');
        Route::post('busca-cep','Painel\Enderecos\Logradouro@pesquisar_endereco')->name('BuscaCep.Dizimista');
        Route::post('valida/pessoa','Painel\Dizimo\Dizimista@pessoas_iguais')->name('Duplicidade.Dizimista');
        Route::post('pessoa/ser-dizimista','Painel\Dizimo\Dizimista@transformar_em_dizimista')->name('SerDizimista.Dizimista');
        Route::post('pessoa/outros-dados/ser-dizimista','Painel\Dizimo\Dizimista@transformar_em_dizimista_dados_adicionais')->name('SerDizimista2.Dizimista');
        Route::post('cadastro/atualizar','Painel\Dizimo\Dizimista@update')->name('Atualizar.Dizimista');
        Route::post('pesquisar/cadastro','Painel\Dizimo\Dizimista@buscar_dizimista')->name('Pesquisa_Cadastro.Dizimista');
    });
    
    //DEVOLUÇÃO DE DIZIMO
    Route::group(['prefix'=>'/devolucao'],function(){
        Route::get('/devolucao/{dizimista?}','Painel\Dizimo\Devolucoes@devolver')->name('Devolucoes.devolver_dizimo');
        Route::match(array('GET', 'POST'),'/salvar/devolucao/{dizimista?}','Painel\Dizimo\Devolucoes@salvar_devolucao')->name('Salvar.devolucao');
    });    
    
    //GRUPO DE ROTAS PARA TRABALHAR COM CARTAS
    Route::group(['prefix'=>'/cartas'],function(){
        Route::get('/aniversariantes','Painel\Dizimo\Cartas@index')->name('Visualizar.Dizimistas.Aniversariantes');
        Route::post('/carrega-table','Painel\Dizimo\Cartas@montaTable')->name('MontaTable.Dizimistas.Aniversariantes');
        Route::get('/print-table','Painel\Dizimo\Cartas@printer')->name('Print.Dizimistas.Aniversariantes');
        Route::post('/carta-devolvida','Painel\Dizimo\Cartas@cartaDevolvida')->name('Devolver.Carta'); //Notificar devolução de uma carta    
        Route::get('/load/dashboard','Painel\Dizimo\Cartas@dashboard')->name('Dashboard.Cartas.Dizimistas');
    });
});



//GRUPO DE ROTAS PARA MANIPULAÇÃO DE LIVROS DE REGISTRO (CERTIDÕES)
Route::group(['prefix'=>'painel/livros'], function () {
    
    //Rotas para cadastrar uma nova página    
    Route::get('/cadastro/livroDigital/novasFolhas', 'Painel\Livros\Folha@index')->name("FormCadastro.Folha");    
        Route::post('/ajax/livroDigital/novaFolha','Painel\Livros\Folha@buscar_livros')->name("BuscaLivroDititalizacao.Folha");
        Route::post('/ajax2/livroDigital/novaFolha','Painel\Livros\Folha@validaStep1')->name("VerificaStep1.Folha");
        Route::post('/ajax3/salvar/livroDigital/novaFolha','Painel\Livros\Folha@salvar_folha')->name("SalvarDigitalizacao.Folha");
    //Adicionar fotos a uma folha já cadastrada
    Route::get('/cadastro/folhas/{folha}/{sacramento}/novaFoto', 'Painel\Livros\Folha@form_adiciona_foto')->name("FormCadastro3.Folha");
        Route::post('/salvar/folha/', 'Painel\Livros\Folha@salvar_foto')->name("Salvarfoto.Folha");
 
    //Cadastrando Folhas a partir do cadastro de um novo Livro    
    Route::get('/cadastro/livro/{livro}/{sacramento}/novasFolhas', 'Painel\Livros\Folha@form_folha_via_cadas_livro')->name("FormCadastro2.Folha");    
    
    //Rotas´para cadastrar um novo livro
    Route::get('/cadastrar/novoLivro', 'Painel\Livros\LivrosRegistros@form_cadastro')->name("FormCadastro.Livro");    
        Route::post('/salvar/livroDigital/novoLivro','Painel\Livros\LivrosRegistros@salvarLivroDigital')->name("SalvarLivroDigital.Livro");
            

                        //TRABALHANDO COM VISUALIZAÇÕES
    Route::get('/','Painel\Livros\LivrosRegistros@index')->name('VisualizarTodos.Livro');
        Route::post('/pesquisar','Painel\Livros\LivrosRegistros@pesquisa')->name('Pesquisa.Livro');
 
    Route::get('/meusLivros/{livro}/{paginacao}','Painel\Livros\Folha@visualiza_paginas')->name('VisualizarFolhas.Folha');

     


                        //TRABALHANDO COM EXCLUSÕES
    Route::get('/excluir/livro/{livro}/','Painel\Livros\LivrosRegistros@deletar')->name('Excluir.Livro');        
    Route::get('/excluir/livro/folha/foto/{foto}','Painel\Livros\Folha@deletar')->name('Excluir.Folha');        
           
});


//GRUPO DE ROTAS PARA MANIPULAÇÃO REGISTROS
Route::group(['prefix'=>'painel/registros'], function () {  
//INICIO ROTAS PARA TRABALHAR COM BATIZADOS===================================================================    
    
    //FORMULÁRIO P/ CADASTRAR BATIZADO    
    Route::get('/batizado/cadastro', 'Painel\Registros\Batizado@form_cadastro')->name("FormCadastro.Batizado");    
        Route::post('/ajax/livro_folha/registro/batismo','Painel\Registros\Batizado@busca_folha')->name("Pesquisa_Folha.Batizado");
        Route::post('/ajax/igreja_capela/registro/batismo','Painel\Registros\Batizado@busca_igreja')->name("Pesquisa_Igreja.Batizado");
        Route::post('/cadastrar/registro/batismo','Painel\Registros\Batizado@salvar')->name("Cadastrar.Batizado");
        
    
    
//FIM ROTAS PARA TRABALHAR COM BATIZADOS================================================================== 
});

//TRABALHANDO COM AS IGREJAS E PADRES (DIOCESE)
Route::group(['prefix'=>'painel/diocese'],function(){
        
    Route::group(['prefix'=>'/capelas'], function(){
        Route::post('/capela/ajax/cadastro/rapido/salvar','Painel\Igrejas\Capela@cadastro_rapido')->name("CadastroRapido.Capela");        
    });
    
    Route::group(['prefix'=>'/igrejas'], function(){
        Route::get('/','Painel\Igrejas\Igreja@index')->name("Mostrar.Igreja");
            Route::post('/busca','Painel\Igrejas\Igreja@busca')->name("Busca.Igreja");
        Route::post('/igreja/ajax/cadastro/rapido/salvar','Painel\Igrejas\Igreja@cadastro_rapido')->name("CadastroRapido.Igreja");        
    });
    
    Route::group(['prefix'=>'/padres'],function(){
        Route::post('/padre/ajax/cadastro/rapido/salvar','Painel\Igrejas\Padre@cadastro_rapido')->name("CadastroRapido.Padre");
        Route::post('/pesquisa','Painel\Igrejas\Padre@mostrar')->name("Mostrar.Padres");
    });
});


//TRABALHANDO COM MISSAS
Route::group(['prefix'=>'painel/missas'],function(){
    
    //INTENÇÕES
    Route::group(['prefix'=>"/intecoes"],function(){
        Route::get('/minhas-intencoes','Painel\Missa\Intenção@index')->name("visualiza.Intencao");        
        Route::get('/cadastrar','Painel\Missa\Intenção@cadastro')->name("FormCadastro.Intencao");        
        Route::get('/editar/{id}','Painel\Missa\Intenção@editar')->name("Editar.Intencao");        
        Route::get('/imprimir','Painel\Missa\Intenção@imprimir')->name("Imprimir.Intencao");        
        Route::post('/printer','Painel\Missa\Intenção@printer')->name("Printer.Intencao");        
        Route::post('/excluir','Painel\Missa\Intenção@delete')->name("Delete.Intencao");        
        Route::post('/buscar','Painel\Missa\Intenção@search')->name("Search.Intencao");                
        Route::post('/cadastrar','Painel\Missa\Intenção@insert')->name("Insert.Intencao");        
        Route::put('/editar/{id}','Painel\Missa\Intenção@update')->name("Update.Intencao");        
    });
    
    
    
    
    
    Route::get('/intencao/tipo','Painel\Missa\Tipo_intencao@index')->name("visualizar.TipoIntencao");    
    Route::get('/intencao/tipo/cadastrar','Painel\Missa\Tipo_intencao@cadastro')->name("FormCadastro.TipoIntencao");
        Route::post('/intecao/tipo/salvar','Painel\Missa\Tipo_intencao@salvar')->name("Cadastrar.TipoIntencao");
    Route::get('/intencao/tipo/excluir/{id}','Painel\Missa\Tipo_intencao@deletar')->name("excluir.TipoIntencao");
    Route::get('/intencao/tipo/editar/{id}','Painel\Missa\Tipo_intencao@editar')->name("editar.TipoIntencao");
        Route::put('/intencao/tipo/update/{id}','Painel\Missa\Tipo_intencao@update')->name("update.TipoIntencao");
});

//ESTACIONAMENTO
Route::group(['prefix'=>'painel/estacionamento'],function(){
   Route::get('/clientes','Painel\Estacionamento\Cliente@index')->name("Estacionamento-Clientes.index");
   Route::get('/fluxo-diario','Painel\Estacionamento\Estacionamento@index')->name("FluxoDiario.Visualizar");
   Route::get('/load-table/carros-estacionados','Painel\Estacionamento\Estacionamento@carros_estacionados')->name("CarrosEstacionados.Visualizar");
   Route::post('/delete','Painel\Estacionamento\Estacionamento@delete')->name("CarrosEstacionados.Delete");
   Route::post('/update','Painel\Estacionamento\Estacionamento@update')->name("CarrosEstacionados.Update");
   Route::post('/cadastrar/carro-estacionado','Painel\Estacionamento\Estacionamento@estacionar')->name("CarroEstacionado.Insert");
   
   
   
   //ROTAS PARA TRABALHAR COM TABELA DE PREÇOS
   Route::group(['prefix'=>'/preco'],function(){
       Route::get('/cadastrar','Painel\Estacionamento\Preco@cadastrarPreco')->name('Preco.FormCadastrar');
       Route::get('/meus-precos','Painel\Estacionamento\Preco@index')->name('Visualizar.Tbl_de_Precos');
       Route::post('/salvar','Painel\Estacionamento\Preco@salvarPreco')->name('Salvar.Tbl_de_precos');
       Route::get('/tabela-de-precos/json/{id?}','Painel\Estacionamento\Preco@list')->name('Preco.Carrega_BasedePrecos');//CARREGA PREÇOS
       Route::post('/update','Painel\Estacionamento\Preco@update')->name('Preco.Update');
       Route::post('/buscar-preco','Painel\Estacionamento\Preco@buscar_preco')->name('Preco.Fetch');
   });

   //ROTAS PARA TRABALHAR COM CARROS
   Route::group(['prefix'=>'/carros'],function(){
       Route::post('/update','Painel\Estacionamento\Carros@update')->name("Carros.Update");
       Route::post('/fetch','Painel\Estacionamento\Carros@busca_carro')->name("Carros.Fetch");
   });
});

//CONFIGURAÇÕES DO SISTEMA
Route::group(['prefix'=>'painel/config/sistema'],function(){
    Route::get('/tabela_status','Painel\Configuracoes\Situacao@index')->name("visualizar.Situacoes");
    Route::get('/status/cadastro','Painel\Configuracoes\Situacao@cadastra')->name("FormCadastro.Situacoes");
    Route::post('/tipos_de_status\cadastrar','Painel\Configuracoes\Situacao@insert')->name("insert.Situacoes");
    Route::get('/status/edita/{id}','Painel\Configuracoes\Situacao@editar')->name("Editar.Situacoes");
    Route::put('/status/editar/{id}','Painel\Configuracoes\Situacao@update')->name("update.Situacoes");
    Route::get('/status/excluir/{id}','Painel\Configuracoes\Situacao@delete')->name("Excluir.Situacoes");
    //Route::get('/excluir/{id}','Painel\Configuracoes\Situacao@delete')->name("Excluir.Situacoes");
    
    //DISPOSITIVOS 
    Route::group(['prefix'=>'dispositivos/'],function(){
        Route::get('tabela','Painel\Configuracoes\Computador@index')->name('Visualizar.Dispositivos');
            Route::post('query-tabela','Painel\Configuracoes\Computador@carregaTable')->name('LoadTable.Dispositivos');
            Route::post('create','Painel\Configuracoes\Computador@insert')->name('SalvarDados.Dispositivos');
            Route::post('update','Painel\Configuracoes\Computador@update')->name('AtualizarDados.Dispositivos');
        Route::get('detalhes/{id}','Painel\Configuracoes\Computador@detalhes')->name('detalhes.Dispositivos');
        Route::get('delete/{id}','Painel\Configuracoes\Computador@deletar')->name('deletar.Dispositivos');
    });

    //TIPOS DE CARTAS
    Route::group(['prefix'=>'tipos-de-cartas/'],function(){
        Route::get('tabela_status','Painel\Configuracoes\TipoCarta@index')->name("visualizar.TipoCarta");
        Route::get('cadastro','Painel\Configuracoes\TipoCarta@cadastra')->name("FormCadastro.TipoCarta");
        Route::post('cadastrar','Painel\Configuracoes\TipoCarta@insert')->name("insert.TipoCarta");
        Route::get('edita/{id}','Painel\Configuracoes\TipoCarta@editar')->name("Editar.TipoCarta");
        Route::put('editar/{id}','Painel\Configuracoes\TipoCarta@update')->name("update.TipoCarta");
        Route::get('excluir/{id}','Painel\Configuracoes\TipoCarta@delete')->name("Excluir.TipoCarta");
    });

    
});

Route::get('notfound','Errors\Errors@pagenotfound')->name('404'); 
Route::get('pagina-em-manutenacao','Errors\Errors@manutencao')->name('manutencao'); 

