<?php
 
date_default_timezone_set('America/Sao_Paulo');
 
function logs($msg){
 
$data = date("d-m-y");
$hora = date("H:i:s");

//Nome do arquivo:
$arquivo = "logs_$data.txt";
 
//Texto a ser impresso no log:
$texto = "[$hora]> $msg \n";
 
$manipular = fopen("../infos/$arquivo", "a+b");
fwrite($manipular, $texto);
fclose($manipular);
}

?>