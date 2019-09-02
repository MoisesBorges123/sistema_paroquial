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

//Route::get('/pdf','Painel\Missa\Intenção@printer'); 

    




//GRUPO DE ROTAS PARA MANIPULAÇÃO DE LIVROS DE REGISTRO (CERTIDÕES)
Route::group(['prefix'=>'painel/livros'], function () {
    
                        //TRABALHANDO COM CADASTROS
    
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
Route::group(['prefix'=>'/painel/diocese'],function(){
        
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
    
    Route::group(['prefix'=>'/intecoes'],function(){
        Route::get('/minhas_intencoes','Painel\Missa\Intenção@index')->name("visualiza.Intencao");        
        Route::get('/cadastrar','Painel\Missa\Intenção@cadastro')->name("FormCadastro.Intencao");        
        Route::get('/editar/{id}','Painel\Missa\Intenção@editar')->name("Editar.Intencao");        
        Route::get('/imprimir/','Painel\Missa\Intenção@imprimir')->name("Imprimir.Intencao");        
        Route::post('/printer/','Painel\Missa\Intenção@printer')->name("Printer.Intencao");        
        Route::post('/excluir/','Painel\Missa\Intenção@delete')->name("Delete.Intencao");        
        Route::post('/buscar/','Painel\Missa\Intenção@search')->name("Search.Intencao");                
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
   Route::get('/clientes','Painel/Estacionamento/Cliente@index')->name("Estacionamento-Clientes.index");
});

//CONFIGURAÇÕES DO SISTEMA
Route::group(['prefix'=>'painel/config/sistema'],function(){
   Route::get('/tabela_status','Painel\Configuracoes\Situacao@index')->name("visualizar.Situacoes");
    Route::get('/status/cadastro','Painel\Configuracoes\Situacao@cadastra')->name("FormCadastro.Situacoes");
        Route::post('/tipos_de_status\cadastrar','Painel\Configuracoes\Situacao@insert')->name("insert.Situacoes");
    Route::get('/status/edita/{id}','Painel\Configuracoes\Situacao@editar')->name("Editar.Situacoes");
        Route::put('/status/editar/{id}','Painel\Configuracoes\Situacao@update')->name("update.Situacoes");
    Route::get('/status/excluir/{id}','Painel\Configuracoes\Situacao@delete')->name("Excluir.Situacoes");
});

