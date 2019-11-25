<?php

namespace App\Http\Controllers\Funcoes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FuncoesAdicionais extends Controller
{
    public function getEndereco($cep) {
        $cep = preg_replace("/[^0-9]/", "", $cep);
        $url = "http://viacep.com.br/ws/$cep/xml/";
        $xml = simplexml_load_file($url);
        return $xml;
    }
    
      /**
     * Verifica os valores de acordo com o tipo informado.
       * Ex: $valores=['value'=>"texto",'type'=>8];
       * Retornará "23" se estiver tudo correto caso contrário x.y.k,
       * sendo 
       * x = posição do valor no array, 
       * y  = tipo de erro 
       * k=valor
     *
     * @param  array  $valores 
     * @return string
     */
    public function validacoes($valores){       
        $i=1;       
        foreach ($valores as $valor) {
            extract($valor);
            if ($type == 0) {//SE NÚMERO COMUM VALIDE
                if (isset($value)) {
                    if (is_numeric($value)) {
                        $r="23";
                    } else {
                         $r = "$i.2.$variavel.$value";
                        break;
                    }
                } else {//SE VAZIO FAÇA...
                     $r = "$i.0.$variavel.$value";
                    break;
                }
//==============================================================================                
            } ELSEIF ($type == 1) {//SE NUMERO POSITIVO INTEIRO FAÇA
                if (!empty($value)) {
                    if (is_numeric($value)) {
                        if ($value > 0) {
                           $r="23"                              ;
                        } else {
                            $r = "$i.3";
                            break;
                        }
                    } else {
                        $r = "$i.2.$variavel.$value";
                        break;
                    }
                } else {//SE VAZIO FAÇA...
                    if (isset($value)) {
                        $r = "$i.1.$variavel.$value";
                        break;
                    } else {
                        $r = "$i.0.$variavel.$value";
                        break;
                    }
                }
//==============================================================================
            } ELSEIF ($type == 2) {//SE NUMERO POSITIVO REAL FAÇA 
                if (!empty($value)) {
                    if (is_float($value)) {
                        if ($value > 0) {
                            $r="23";
                        } else {
                            $r = "$i.3";
                            break;
                        }
                    } else {
                        $r = "$i.2.$variavel.$value";
                        break;
                    }
                } else {//SE VAZIO FAÇA...
                    if (isset($value)) {
                        $r = "$i.1.$variavel.$value";
                        break;
                    } else {
                        $r = "$i.0.$variavel.$value";
                        break;
                    }
                }
//==============================================================================                
            } elseif ($type == 3) {//SE NUMERO POSITIVO OU NEGATIVO INTEIRO
                if (!empty($value)) {
                    if (is_integer($value)) {
                        $r="23";
                    } else {
                        
                        $r = "$i.2.$variavel.$value";
                        break;
                    }
                } else {//SE VAZIO FAÇA...
                    if (isset($value)) {
                        $r = "$i.1.$variavel.$value";
                        break;
                    } else {
                        $r = "$i.0.$variavel.$value";
                        break;
                    }
                }
//==============================================================================                
            } ELSEIF ($type == 4) {//SE NUMERO POSITIVO OU NEGATIVO REAL
                if (!empty($value)) {
                    if (is_float($value)) {
                        $r="23";
                    } else {
                        $r = "$i.2.$variavel.$value";
                        break;
                    }
                } else {//SE VAZIO FAÇA...
                    if (isset($value)) {
                        $r = "$i.1.$variavel.$value";
                        break;
                    } else {
                        $r = "$i.0.$variavel.$value";
                        break;
                    }
                }
//==============================================================================
            } ELSEIF ($type == 5) {//SE EMAIL FAÇA
                if (!empty($value)) {
                    if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $r="23";
                    } else {
                        $r = "$i.2.$variavel.$value";
                        break;
                    }
                } else {//SE VAZIO FAÇA...
                    if (isset($value)) {
                        $r = "$i.1.$variavel.$value";
                        break;
                    } else {
                        $r = "$i.0.$variavel.$value";
                        break;
                    }
                }
//==============================================================================                
            } ELSEIF ($type == 6) {//SE NOME PROPRIO FAÇA
                if (!empty($value)) {
                    if (is_string($value)) {
                        $r="23";
                    } else {
                        $r = "$i.2.$variavel.$value";
                        break;
                    }
                } else {//SE VAZIO FAÇA...
                    if (isset($value)) {
                        $r = "$i.1.$variavel.$value";
                        break;
                    } else {
                        $r = "$i.0.$variavel.$value";
                        break;
                    }
                }
//==============================================================================
            } ELSEIF ($type == 7) {//SE STRING SEM NUMERO FAÇA
                if (!empty($value)) {
                    if (is_string($value)) {
                       $r="23";
                    } else {
                        $r = "$i.2.$variavel.$value";
                        break;
                    }
                } else {//SE VAZIO FAÇA...
                    if (isset($value)) {
                        $r = "$i.1.$variavel.$value";
                        break;
                    } else {

                        $r = "$i.0.$variavel.$value";
                        break;
                    }
                }
//================================================================================
            } ELSEIF ($type == 8) {//SE STRING COM NUMERO FAÇA
                if (!empty($value)) {
                    if (!is_numeric($value)) {
                       $r="23";
                    } else {
                        $r = "$i.2.$variavel.$value";
                        break;
                    }
                } else {//SE VAZIO FAÇA...
                    if (isset($value)) {
                         $r = "$i.1.$variavel.$value";
                        break;
                    } else {
                        $r = "$i.0.$variavel.$value";
                        break;
                    }
                }
//=================================================================================
            } ELSEIF ($type == 9) {
                $data= explode('-', $value);
                $resposta=checkdate($data[1], $data[2], $data[0]);
                if($resposta==1){
                    $r="23";
                }else{
                    $r="$i.2.$variavel.$value";
                    break;
                }
                
//==============================================================================
            } ELSEIF ($type == 10) {//SE STRNG (MAIUSCULA) FAÇA
                if (!empty($value)) {
                    if (is_string($value)) {
                        $r="23";
                    } else {
                        $r = "$i.2.$variavel.$value";
                        break;
                    }
                } else {//SE VAZIO FAÇA...
                    if (isset($value)) {
                        $r = "$i.1.$variavel.$value";
                        break;
                    } else {
                        $r = "$i.0.$variavel.$value";
                        break;
                    }
                }
//==============================================================================
            } ELSEif ($type == 11) {
                /*
                 * Tipo de Validação vago
                 */
            }
            $i++;
        }
        return $r;
    }
    
    /**
     * Função de tratamento de array para salvar os dados utilizando 
     * o metodo created
     * 1-Envia os valores('value',type) 
     * 2-Campos da Tabela do Banco de Dados    
     */
    public function tratamentoDados($valores,$campos){
        $dados=[]; 
        $c=0;
        foreach($valores as $v){
            extract($v);                              
            
                
                if($type==0){
                    $dado = $value;
                    
                    
                //Tratamento Nome Próprio
                }else if($type==1 || $type==6){
                    $texto = explode(" ", $value);
                    $i=0;
                    foreach ($texto as $t){
                 
                        if($i==0){
                            $dado= ucwords($t);                     
                        }else{
                            
                            if(substr($t,0,2) !="do" && substr($t,0,2)!="de" && substr($t,0,2)!="da"){                                    
                                $dado=$dado." ".ucwords($t);
                                                                    
                            }else{
                                $dado=$dado." ".$t;                                
                            }   
                        }
                     
                        $i++;
                    }
                //Texto Maiusculo    
                }elseif($type==2){
                    $dado = strtoupper($value);
                }
                
                //Texto Minusculo    
                elseif($type==3){
                    $dado = strtolower($value);
                }else{
                    $dado = $value;
                }
            
                $dados["$campos[$c]"] = $dado;
                $c++;
            
        }
        return $dados;
    }    
    public function notificacao1($r, $men = 0) {


        $erro = explode('.', $r);
        $r = $erro[1];
        $position = $erro[0];
        $variavel=$erro[2];
        $value=$erro[3];
       
        switch ($r) {

            case 0://Não Existe
                $mensagem = "&nbsp<b>OPS!</b> O campo $variavel não foi reconhecido pelo sistema.";
             
                break;
            case 1://Campos não preenchidos
                $mensagem = "&nbsp<b>OPS!</b> O campo $variavel é de preenchimento obrigatório.";
                $state = "warning";
                break;
            case 2://Campos com dados incopativeis ao tipo de variavel
                $mensagem = "&nbsp<b>OPS!</b> O valor digitado no campo $variavel não é compativel com o tipo esperado";
                $state = "warning";
                break;
            case 3://Inseriu numero '0'
                $mensagem = "&nbsp<b>OPS!</b> Por favor insiera um valor maior que <b>ZERO</b> no campo $position!<br><small>Detalhes:O campo $position  valor:($valor) não aceita valores menor que ZERO.</small>";
                $state = "warning";
                break;
            
        }
        
        


        return $mensagem;
    }
    /**
     *  Faz a converção da numeção da folha dos Livros de Registro
     * Tipo 1: 2v = 4
     * Tipo 2: 4 = 2v
     * @param string|int $valor
     * @param int $tipo
     */
    public function converter_numeracaoFolha($valor,$tipo){
        if($tipo==1){
            if(is_numeric($valor)){
                $num = (intval($valor)*2)-1;
            }else{
                $num = intval(substr($valor,0, strlen($valor)-1))*2;             
            }
            return $num;
            
        }else{
            if($valor%2==0){
                $text = ($valor/2)."V";
            }else{
                $text = ($valor+1)/2;
            }
            return $text;
        }
    }

}
