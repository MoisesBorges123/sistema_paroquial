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



//GRUPO DE ROTAS PARA MANIPULAÇÃO DE LIVROS DE REGISTRO
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
 

     


                
                
                
                
                
                
                

           
});


//GRUPO DE ROTAS PARA MANIPULAÇÃO REGISTROS
Route::group(['prefix'=>'painel/registros'], function () {  
    //INICIO ROTAS PARA TRABALHAR COM BATIZADOS===================================================================    
    
    //FORMULÁRIO P/ CADASTRAR BATIZADO    
    Route::get('/batizado/cadastro', 'Painel\Registros\Batizado@form_cadastro')->name("FormCadastro.Batizado");    
        Route::post('/cadastrar/registro/batismo','Painel\Registros\Batizado@salvar')->name("Cadastrar.Batizado");
        Route::get('buscar/paginas','Painel\Registros\Batizado@buscarPageLivro')->name("Buscar.PageLivroRegistro");//Consulta AJAX paginas do livro
    //VISUALIZAR FOLHAS
    Route::get('/ler/livroRegistro/{livro}', 'Painel\Registros\Batizado@index')->name("Visualizar.Batizado");
    //EXCLUIR FOLHAS
    Route::get('/excluir/folha', 'Painel\Registros\Batizado@excluir_tipo')->name("Excluir.Batizado");
    //EDITAR FOLHAS
    Route::get('/atualizar/folha', 'Painel\Registros\Batizado@editar_tipo')->name("Atualizar.Batizado");
    
//FIM ROTAS PARA TRABALHAR COM BATIZADOS================================================================== 
});

Route::group(['prefix'=>'painel/missas'],function(){
    Route::get('/intencao/cadastrar','Painel\Missa\Intenção@cadastro')->name("FormCadastro.Intencao");
    
    Route::get('/intencao/tipo','Painel\Missa\Tipo_intencao@index')->name("visualizar.TipoIntencao");
    Route::get('/intencao/tipo/cadastrar','Painel\Missa\Tipo_intencao@cadastro')->name("FormCadastro.TipoIntencao");
        Route::post('/intecao/tipo/salvar','Painel\Missa\Tipo_intencao@salvar')->name("Cadastrar.TipoIntencao");
});