<?php


class myfunctions {
   public function conecta($bd){
            $servidor='localhost';
            $user='root';             
            $senha='';
            $conexao=mysqli_connect($servidor,$user,$senha,$bd);            
            if($conexao==false){
                echo"<script> alert('O sistema está sem conexão por favor tente mais tarde!\n Desde já aceite nossas desculpas. ') </script>";
                $status="sem conexao";
            }
                $status = "conectado";
            return $conexao;
    }
    public function ajax_buscar($variaveis1){
        $x=explode(',',$variaveis1);
        $i=0;       
        $variaveis2="";
        $t= count($x);
        foreach ($x as $y){
            if($i==0){
                $variaveis2=$y.":".$y.",";
            }elseif ($i==$t-1){
                $variaveis2=$variaveis2.$y.":".$y;
            }
            else{
                $variaveis2=$variaveis2.$y.":".$y.",";
            }
            $i++;
        }
        
        
        echo"<script>function buscar($variaveis1) {
               var page = './buscar.php';
               $.ajax({
                   type: 'POST',
                   dataType:'html',
                   url:page,
                   beforeSend:function(){
                      $('#carregando').show();
                   },
                   data:{".$variaveis2."},
                   success:function(msg){
                  
                                            $('#resposta').delay(2000);
                                            $('#carregando').hide();
                   $('#resposta').html(msg);$('#salvar').html('Cadastrar');}
               });
           }</script>";
    }
    
    public function tiraReal($valor){
        //$x= explode(".", $valor);
  //$t=ereg_replace("[^0-9]","" ,$x[0]).".".$x[1];
        $t=substr($valor,3);
  return $t;
    }
    public function diasdoMes($mes){
        if($mes==1){
            $r=31;
        }elseif($mes==2){
            $r=28;
        }elseif($mes==3){
            $r=31;
        }elseif($mes==4){
            $r=30;
        }elseif($mes==5){
            $r=31;
        }elseif($mes==6){
            $r=30;
        }elseif($mes==7){
            $r=31;
        }elseif($mes==8){
            $r=31;
        }elseif($mes==9){
            $r=30;
        }elseif($mes==10){
            $r=31;
        }elseif($mes==11){
            $r=30;
        }elseif($mes==12){
            $r=31;
        }
        return$r;
    }       
    
    public function nomeMês($mes){
        $r="#Erro!";
        if($mes==1){
            $r="Janeiro";
        }elseif($mes==2){
            $r="Fevereiro";
        }elseif($mes==3){
            $r="Março";
        }elseif($mes==4){
            $r="Abril";
        }elseif($mes==5){
            $r="Maio";
        }elseif($mes==6){
            $r="Junho";
        }elseif($mes==7){
            $r="Julho";
        }elseif($mes==8){
            $r="Agosto";
        }elseif($mes==9){
            $r="Setembro";
        }elseif($mes==10){
            $r="Outubro";
        }elseif($mes==11){
            $r="Novembro";
        }elseif($mes==12){
            $r="Dezembro";
        }
        return$r;
    }

    public function dataVencimento($data){
        $y =date('Y-m-d', strtotime('+30 days', strtotime($data)));
         return $y;

       
    }
    
    public function gmp_div_qr($n, $d) {
        $resto = $n % $d;
        $quociente = explode(".", ($x = $n / $d));
        return array($resto, $quociente[0]);
    }

/////////////////////////////////////////////////////////////////////////////////

    public function diferencaDia($data1, $data2) {
        $x1 = explode("-", $data1);
        $x2 = explode("-", $data2);
        
        if ($x1[2] != $x2[2]) {
            if($x2[2]>$x1[2]){
                $dif = ((($x2[2] - $x1[2]) * 24));
                return $dif;
            }else{
                $dif = ((($x1[2] - $x2[2]) * 24));
                return $dif;
            }
        } else {
            $dif = 0;
            return $dif;
        }
    }

////////////////////////////////////////////////////////////////////////////////////

    public function diferencaHora($h1, $h2, $min1, $min2) {
        $tempo = 0;
        
        if ($h1 == $h2) {
            $tempo = $tempo + 0;
            
          
        } else {
            $tempo = (($h2 - $h1) * 60) + $tempo;
             
        }
        if ($min1 < $min2) {
            $tempo = $tempo + ($min2 - $min1);
        } else {
            $tempo = $tempo + 0;
            
        }
        return $tempo;
    }
///////////////////////////////////////////////////////////////////////////////////////

    public function separaData($data){
        $x = explode("-", $data);
        return $x;
    }

///////////////////////////////////////////////////////////////////////////////////////
    
    public function valorDiasDIFF($veiculo,$h1, $h2, $data1, $data2, $min1, $min2,$conection) {
       

        if ($min2 < $min1) {
            $min2 = $min2 + 60;
            $hdif = 1;
            $temp1 = $min2 - $min1;
        } else {
            $temp1 = $min2 - $min1;
            $hdif = 0;
        }
        $v1 = $this->valorMinuto($veiculo,$temp1,$conection);
        
        $datadif = $this->diferencaDia($data1, $data2);
        $horaDif = $h2 - $h1;
        $horaTotal = $datadif + $horaDif - $hdif;
        $duracaoH=$horaTotal;
        $duracaoM=$temp1;
        $sql = "select * from tabela_precos where (tempo='60' and veiculo='".$veiculo."' and tipo='1');";
        $result = mysqli_query($conection, $sql);
        $q = mysqli_num_rows($result);
        if ($q > 0) {
            while ($row = mysqli_fetch_row($result)) {
                //$idvalor = $row[0];
                $valor = $row[4];
            }
            $v2 = $horaTotal * $valor;

        } else {
            echo"<div class='alert alert-danger'>
  <strong>Erro Crítico!</strong> Não foi possível realizar o calculo por falta de informações .
</div>";
            exit();
        }
        $total=$v1+$v2;
        return array($total,$duracaoH,$duracaoM);
    }

///////////////////////////////////////////////////////////////////////////////////////
    public function valorDiasIGUAL($veiculo,$h1,$h2,$min1,$min2,$conection) {
        
        if ($min2 < $min1) {
            $min2 = $min2 + 60;
            $hdif = 1;
            $temp1 = $min2 - $min1;
        } else {
            $temp1 = $min2 - $min1;
            $hdif = 0;
        }
        $v1 = $this->valorMinuto($veiculo,$temp1,$conection);
        
        $horaTotal=$h2-$h1-$hdif;
        $duracaoH=$horaTotal;
        $duracaoM=$temp1;
        $sql = "select * from tabela_precos where (tempo='60' and veiculo='".$veiculo."' and tipo='1');";
        $result = mysqli_query($conection, $sql);
       $q = mysqli_num_rows($result);
        if ($q > 0) {
            while ($row = mysqli_fetch_row($result)) {
                //$idvalor = $row[0];
                $valor = $row[4];
            }
            $v2 = $horaTotal * $valor;
            
        } else {
            echo"<div class='alert alert-danger'>
                <strong>Erro Crítico!</strong> Não foi possível realizar o calculo por falta de informações .
              </div>";
            exit();
        }
         $total = $v1 + $v2;
         return array($total,$duracaoH,$duracaoM);
        
    }
///////////////////////////////////////////////////////////////////////////////////////    
    public function valorMinuto($veiculo,$tempo,$conection) {/////VALOR DE 15 MINUTOS
        if ($tempo > 0 & $tempo <= 15) {
            $sql = "select * from tabela_precos where (tempo='15' and veiculo='".$veiculo."' and tipo='1');";
            $result = mysqli_query($conection, $sql);
            $q = mysqli_num_rows($result);
            
            if ($q > 0) {
                while ($row = mysqli_fetch_row($result)) {
                    $idvalor = $row[0];
                    $valor = $row[4];
                }
            } else {
                echo"<div class='alert alert-danger'>
  <strong>Erro Crítico!</strong> Não foi possível realizar o calculo por falta de informações .
</div>";
                exit();
            }
            return$valor;
            
            
        } elseif ($tempo >= 16 & $tempo < 31) {/////VALOR DE 30 MINUTOS
            $sql = "select * from tabela_precos where (tempo='30' and veiculo='".$veiculo."' and tipo='1');";
            $result = mysqli_query($conection, $sql);
            $q = mysqli_num_rows($result);
            if ($q > 0) {
                while ($row = mysqli_fetch_row($result)) {
                    $idvalor = $row[0];
                    $valor = $row[4];
                }
            } else {
                echo"<div class='alert alert-danger'>
  <strong>Erro Crítico!</strong> Não foi possível realizar o calculo por falta de informações .
</div>";
                exit();
            }
            return$valor;
            
            
        } elseif ($tempo >= 31) {/////VALOR DE 1 HORA
            $sql = "select * from tabela_precos where (tempo='60' and veiculo='".$veiculo."' and tipo='1');";            
            $result = mysqli_query($conection, $sql);
            $q = mysqli_num_rows($result);
            if ($q > 0) {
                while ($row = mysqli_fetch_row($result)) {
                    $idvalor = $row[0];
                    $valor = $row[4];
                }
            } else {
                echo"<div class='alert alert-danger'>
  <strong>Erro Crítico!</strong> Não foi possível realizar o calculo por falta de informações .
</div>";
                exit();
            }
            return$valor;
        }
    }

///////////////////////////////////////////////////////////////////////////////////////
    public function valorEstacionamento($veiculo,$modalidade,$desconto, $data1, $data2, $h1, $h2, $min1, $min2, $placa,$conection) {      

        //VERIFICA SE JÁ É CADASTRADO NO SISTEMA  
        $sql = "select * from clientes where (placa='" . $placa . "' and tipo>1);";
        $result = mysqli_query($conection, $sql);
        $q = mysqli_num_rows($result);
        //echo$q;
        //SE FOR DESCONTISTA FAÇA...
        if ($q > 0) {


            while ($row = mysqli_fetch_row($result)) {//Colhe os dados do cliente
                $id = $row[0];
                // $nome = $row[1];

                $desconto = $row[3];
                //$vaga = $row[6];
                //$sexo = $row[7];
            }

            $diaDiff = $this->diferencaDia($data1, $data2);


            if ($diaDiff == 0) {
                $valor = $this->valorDiasIGUAL($veiculo,$h1, $h2, $min1, $min2, $conection);
            } else {
                $valor = $this->valorDiasDIFF($veiculo,$h1, $h2, $data1, $data2, $min1, $min2, $conection);
            }
            $duracao = $valor[1] . "H " . $valor[2] . "min";
            //$total=0+$valor[0]-($valor[0]*($desconto/100));
            $total = 0 + $valor[0];
            return array($total, $duracao);
            //SE NÃO FOR DESCONTISTA FAÇA...    
        } else {
            if ($modalidade == 1) {
                $diaDiff = $this->diferencaDia($data1, $data2);
                if ($diaDiff == 0) {
                    $valor = $this->valorDiasIGUAL($veiculo,$h1, $h2, $min1, $min2, $conection);
                } else {


                    $valor = $this->valorDiasDIFF($veiculo,$h1, $h2, $data1, $data2, $min1, $min2, $conection);
                }
                $duracao = $this->addZERO($valor[1]) . "H " . $this->addZERO($valor[2]) . "min";
                $total = 0 + $valor[0];
                return array($total, $duracao);
            } elseIF ($modalidade != 4) {
                $sql = "select * from tabela_precos where(tipo='" . $modalidade . "' and veiculo='".$veiculo."')";
                $result = mysqli_query($conection, $sql);
                while ($row = mysqli_fetch_row($result)) {
                    $valor1 = $row[4];
                }
                $diaDiff = $this->diferencaDia($data1, $data2);
                if ($modalidade == 3 & $h2 > 8 & $diaDiff > 0) {
                    if ($diaDiff == 1) {
                        $h1 = 8;
                        $min1 = 0;
                        $valor2 = $this->valorDiasIGUAL($veiculo,$h1, $h2, $min1, $min2, $conection);
                        $duracao = $this->addZERO($valor2[1]) . "H " . $this->addZERO($valor2[2]) . "min + 01 Diária";
                        $v2 = $valor2[0];
                    } else {
                        $h1 = 8;
                        $min1 = 0;
                        $d = explode("-", $data1);
                        $a=$d[2]+1;
                        $data1 = $d[0] ."-". $d[1] ."-". $a;
                        $valor2 = $this->valorDiasDIFF($veiculo,$h1, $h2, $data1, $data2, $min1, $min2, $conection);
                        $duracao = $this->addZERO($valor2[1]) . "H " . $this->addZERO($valor2[2]) . "min + 01 Diária";
                        $v2 = $valor2[0];
                        
                    }
                } else {
                    $v2 = 0;
                    $duracao = "01 Diária";
                }
                $total = $valor1 + $v2;
                return array($total, $duracao);
            } ELSE {
                $diaDiff = $this->diferencaDia($data1, $data2);
                if ($diaDiff == 0) {
                    $valor = $this->valorDiasIGUAL($veiculo,$h1, $h2, $min1, $min2, $conection);
                } else {


                    $valor = $this->valorDiasDIFF($veiculo,$h1, $h2, $data1, $data2, $min1, $min2, $conection);
                }
                $duracao = $this->addZERO($valor[1]) . "H " . $this->addZERO($valor[2]) . "min";
                $total = 0;

                return array($total, $duracao);
            }
        }
    }
    
    
    
    public function real($valor) {
        if($valor<0){
            $valor=$valor*-1;
            $n=1;            
        }else{
            $n=0;
        }
        $x = explode(".", $valor);
        if (strstr($valor, '.')) {
            if($n==0){
                $prefixo = "R$ ";
            }else{
                $prefixo = "R$ -";
            }
            
            $sufixo = "";
            $x = explode(".", $valor);
            $y = strlen($x[1]);
            if ($y == 1) {
                $sufixo = "." . $x[1] . "0";
            }
        } else {

            if($n==0){
                $prefixo = "R$ ";
            }else{
                $prefixo = "R$ -";
            }
            $sufixo = ".00";
        }
        $k = strlen($x[0]);

        $valor = $x[0];
        if ($k > 3) {
            $z = 1;
            $r = "";
            $c = $this->gmp_div_qr($k, 3);
            $p = $c[1];
            $e = $c[0];
            $w = 0;
            $i = 0;
            if ($e > 0) {
                $r = substr($valor, $i, $e) . ".";
                $i = $e;
            }
            for ($p; $p > 0; $p--) {

                if ($p == 1) {
                    $r = $r . substr($valor, $i, 3);
                } else {

                    $r = $r . substr($valor, $i, 3) . ".";
                }
                $i = $i + 3;
            }
            $i = $k - 1;
        } else {
            $r = $valor;
        }
        $resultado = $prefixo . $r . $sufixo;
        return $resultado;
    }
    
    
    public function convercaoData($tipo,$data) {//1 entra data do banco //// 2 data convencional
        
        if($tipo==1){
            $x= explode("-", $data);
            $y=$x[2]."/".$x[1]."/".$x[0];
            return $y;
        }elseif($tipo==2){
            $x= explode("/", $data);
            $y=$x[2]."-".$x[1]."-".$x[0];
            return $y;
        }
    }
    public function addZERO($valor){
        if(strlen($valor)<2){
            if($valor<10){
                 $valor="0".$valor;
            }
        }
        
        return$valor;
    }

}
