<?php

//pif.php : Donne un chiffre entre 1 (ou le chiffre sp�cifi�)
//et le chiffre sp�cifi�

//r�cup�re les chiffres envoy�s en param�tres $incparam
if(strpos($incparam, ",")!==false){
$coup=explode(",",$incparam);
}
else{
//si ya qu'un chiffre, on consid�re que c'est la limite haute
//on met le premier chiffre � 1
$coup[0]=1;
$coup[1]=$incparam;
}

if (is_numeric($coup[0]) && is_numeric($coup[1])) {
// echo "nombres ! on calcule !";
$reponsebot=$coup2[0].mt_rand($coup[0],$coup[1]).$coup2[1];
}
else{
// echo "pas nombres ! on saute !";
$stoplecture=false;
$reponsebot="";
}

// $reponsebot="lol";

?>