<?php
header ('Content-Type: text/html; charset=utf-8');
?>
<head>
<link href="../assets/css/bootstrap.css" rel="stylesheet">
<link href="../assets/css/app.css" rel="stylesheet">

    <style>
      body {
      	visibility: hidden;
        padding-top: 60px;
      }
    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
<script language="JavaScript"> 
	window.onload = function() {
   document.getElementById('input').focus(); 
   document.getElementById('sauveinput').value="";  
<?php   
  print "document.getElementById('input').value=\"".$_POST['sauveinput']."\";"; 
?>   
   }

var verif = window.setInterval(validation,1800000); //180s

function validation()
{
document.getElementById('sauveinput').value=document.getElementById('input').value; 
document.getElementById('autorefresh').value="TRUE";
document.getElementById('input').value=""; 
    document.forms['form_parler'].submit();   
}

function envoiemot(mot)
{
document.getElementById('input').value=mot; 
    document.forms['form_parler'].submit();   
}
</script>
</head> 
<body link="#336600">
<?php  
error_reporting(E_ALL); 
$temps_debut =array_sum(explode(' ', microtime())); 

//echo$_SERVER["REMOTE_ADDR"]; 
//print "<a href=\"logs/".$_SERVER["REMOTE_ADDR"].".htm\">Votre historique</a><br><br><br>";
$stoplecture=false; 
$stoplecturegen=false; 
$continueanalyse=true; 
$jok=array();  
//si pas de cerveau défini 
if (!isset($_POST['cerveau'])) 
{
$_POST['cerveau']="AR.txt";
$_POST['noreut']="";
$_POST['vraiesvars']="";
$_POST['nom']="";
$_POST['var']="";
$_POST['vartemp']="";
$_POST['rappel']="";
$correction="";
	if (file_exists("logs/".$_SERVER["REMOTE_ADDR"].".htm")){
	}
	else{
	//creation d'un log avec l'ip du visiteur
	$logvisiteur = fopen("logs/".$_SERVER["REMOTE_ADDR"].".htm","w");
	fwrite($logvisiteur, "<head><meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\"/>");

	fclose($logvisiteur);
	}
}
$cerveau=$_POST['cerveau'];
if(isset($_POST['autorefresh'])){
if($_POST['autorefresh'] == "TRUE")
{
$cerveau="autorefresh.txt";
$_POST['usersay']=" ";
}
else
{
//$cerveau="AR.txt";
}}
//echo"Cerveau : ".$cerveau;
if (@$_POST['usersay']!=null){
	if (@$_POST['usersay']=="reset"){
	$jok[20];
	$_POST['var']="";
	$_POST['vartemp']="";
	$_POST['cerveau']=null;
	$_POST['nom']="";
	$_POST['noreut']="";
	$_POST['vraiesvars']="";
	$_POST['rappel']="";
	//echo"RESET !";
	$reponsebot="";
	$_POST['vartemp']=stripslashes($_POST['vartemp']);
	$_POST['var']=stripslashes($_POST['var']);
	$_POST['noreut']=stripslashes($_POST['noreut']);
	$_POST['vraiesvars']=stripslashes($_POST['vraiesvars']);
	$_POST['rappel']=stripslashes($_POST['rappel']);
	$_POST['nom']=stripslashes($_POST['nom']);
	$_POST['usersay']=stripslashes($_POST['usersay']);
	die("<br><br><br><form method=\"POST\" action=\"index.php\">"."<INPUT NAME=\"usersay\" autocomplete=\"off\" id=\"input\" size=60%\"><INPUT NAME=\"sauveinput\" id=\"sauveinput\" TYPE=\"HIDDEN\" ><INPUT NAME=\"var\" value=\"".$_POST['var']."\" id=\"var\" TYPE=\"HIDDEN\" ><INPUT NAME=\"vartemp\" value=\"".$_POST['vartemp']."\" id=\"vartemp\" TYPE=\"HIDDEN\" ><INPUT NAME=\"cerveau\" value=\"".$_POST['cerveau']."\" id=\"cerveau\" TYPE=\"HIDDEN\" ><INPUT NAME=\"vraiesvars\" value=\"".$_POST['vraiesvars']."\" id=\"vraiesvars\" TYPE=\"HIDDEN\" ><INPUT NAME=\"nom\" value=\"".$_POST['nom']."\" id=\"nom\" TYPE=\"HIDDEN\" ><INPUT NAME=\"noreut\" value=\"".$_POST['noreut']."\" id=\"noreut\" TYPE=\"HIDDEN\" ><INPUT NAME=\"vraiesvars\" value=\"".$_POST['vraiesvars']."\" id=\"vraiesvars\" TYPE=\"HIDDEN\" ><INPUT NAME=\"rappel\" value=\"".$_POST['rappel']."\" id=\"rappel\" TYPE=\"HIDDEN\" ><INPUT NAME=\"autorefresh\" id=\"autorefresh\" TYPE=\"HIDDEN\" value=\"FALSE\"><input type=submit  value=\"Parler\">"."<b><br>Version Alpha.<br><font color=\"#C0000\"> BIG BROTHER WARNING : </font>Toutes les conversations seront <a href=\"logs/logs.php\">stock&eacute;es</a> et analys&eacute;es amoureusement.</b><br>");
	}
$correction="";	
$_POST['vartemp']=stripslashes($_POST['vartemp']);
$_POST['var']=stripslashes($_POST['var']);
$_POST['noreut']=stripslashes($_POST['noreut']);
$_POST['vraiesvars']=stripslashes($_POST['vraiesvars']);
$_POST['rappel']=stripslashes($_POST['rappel']);
$_POST['nom']=stripslashes($_POST['nom']);
$_POST['usersay']=stripslashes($_POST['usersay']);	
$numlignelog=0;
//echo"<br>liste des log spéciaux :".$_POST['var'];
//echo"<bR>la variable temporaire actuelle : ".$_POST['vartemp'];
//echo"<br>Nom ?".$_POST['nom'];
//echo"<br> ne pas réutiliser les phrases : " . $_POST['noreut'];
//echo"<br>vraies vars :".$_POST['vraiesvars'];
//echo"<br>rappels : ".$_POST['rappel'];
//echo"<br><br>Vous : ".$_POST['usersay'];
//$_POST['usersay']=strtolower($_POST['usersay']);
$_POST['usersay']=htmlspecialchars($_POST['usersay']);
$_POST['vartemp']=htmlspecialchars($_POST['vartemp']);
$_POST['var']=htmlspecialchars($_POST['var']);
//la conversion se fait lorsqu'on le stocke dans la mémoire...mais dans un 2e temps les specialchars sont reconvertis....finalement, on met un htmlspecialchars($_POST['noreut']) quand on teste
$_POST['noreut']=htmlspecialchars($_POST['noreut']); 
$_POST['vraiesvars']=htmlspecialchars($_POST['vraiesvars']);
$_POST['rappel']=htmlspecialchars($_POST['rappel']);
$_POST['nom']=htmlspecialchars($_POST['nom']);
$majUsersay=$_POST['usersay'];
$_POST['usersay']=mb_convert_case($_POST['usersay'], MB_CASE_LOWER, "utf-8");
//$titre = htmlspecialchars($titre, ENT_QUOTES);

if($_POST['rappel']!=""){
//echo"Il y a des rappels, on cherche si ca correspond à ".date("H:i");
$result=strpos($_POST['rappel'],date("H:i"));
	if($result!==false){
	//echo"ça colle. RAPPEL !";
	////echosubstr($_POST['rappel'],$result);
	$coup=explode(",", substr($_POST['rappel'],$result));
	//echo"CHOSE à rap :".$coup[1];
	$jok[1]=$coup[1];
	$_POST['usersay']="rappel";
	$_POST['rappel']=str_replace("|".date("H:i").",".$coup[1], "", $_POST['rappel']);
	//echo"<EMBED SRC=\"alarme.wav\" AUTOSTART=\"true\" WIDTH=0 HEIGHT=0 LOOP=TRUE>";	
	$cerveau="autorefresh.txt";
	}
}

$lecture = fopen($cerveau,"r");
//echo"<br>on teste si il y a un mot à remplacer dans la question de l'user";
	$lecturecorrectionuser = fopen("correction.txt","r");
	while (!feof ($lecturecorrectionuser)) {	
	$lignecorrectionuser= fgets($lecturecorrectionuser, 1024);
	$lignecorrectionuser=mb_convert_case($lignecorrectionuser, MB_CASE_LOWER, "utf-8");
	//echo"<br>".$lignecorrectionuser;
		$result=strrpos($lignecorrectionuser, "=");
		$coup[0]=substr($lignecorrectionuser,0,$result);
		if ($coup[0]!=""){
		$result=strpos($_POST['usersay'], $coup[0]);}
		//echo$result;
		if($result !== false){
		//on efface le debut de la ligne, jusqu'à jocker, et remplace avec le reste
		$lignecorrectionuser=str_replace($coup[0]."=", "", $lignecorrectionuser);			
		$lignecorrectionuser=str_replace("\r", "", $lignecorrectionuser);
		$lignecorrectionuser=str_replace("\n", "", $lignecorrectionuser);
		//echo"=>trouvé. on remplace ".$coup[0]." par ".$lignecorrectionuser;
		$correction=$correction." -corrig&eacute; '".$coup[0]."' en '".$lignecorrectionuser."'";
		$_POST['usersay']=str_replace($coup[0], $lignecorrectionuser, $_POST['usersay']);	
		}
		else
		{
		//echo"=>Non.";
		}
	}
$reponsebotcomplet="";	
while (!feof ($lecture) && $stoplecture==false) {
$numlignelog=$numlignelog+1;
$continueanalyse=true;
$logspetemp="";
$ligne= fgets($lecture, 1024);
$lignemaj=$ligne;
//$ligne=strtolower($ligne);
$ligne=mb_convert_case($ligne, MB_CASE_LOWER, "utf-8");
//echo"<br><br>ANALYSE DE :".$ligne."<br>";
//echo"<br>on vérifie si la ligne est un commentaire...";
$result = strpos($ligne, "//");
//echo$result;
	if ($result<4 && $result!==false)
	{
	//echo"=>oui. on stoppe.";
	$continueanalyse=false;
	}
//echo"<br>on vérifie si la ligne ne demande pas une condition d'horaire";
$result = strpos($ligne, "{heure ");
	if ($result!==false)
	{
	$coup2=explode("{heure ", $ligne);
	$coup2=explode("-", $coup2[1]);
	//echo"<br>on teste si".date("H")."est superieur ou égal à".$coup2[0];
		if (date("H") < $coup2[0]){
		//echo"=>Inferieur, on arrête.";
		$continueanalyse=false;
		}
		else
		{
		//echo"=>C'est bon, il est superieur ou égal.";
		$coup2=explode("}", $ligne);
		$coup2=explode("-", $coup2[0]);		
		//echo"<br>on teste si".$coup2[1]."est superieur à".date("H");	
			if ($coup2[1] > date("H")){
			//echo"=>Strictement superieur, c'est bon.<bR>";
			$coup2=explode("}", $ligne);
			$ligne=$coup2[1];
			}
			else{
			//echo"Egal ou inferieur, on arrete tout.<bR>";
			$continueanalyse=false;}
			
		}
	}

	//echo"<br>on regarde si la ligne demande pas qu'une variable soit à une valeur spécifique";
	$coup=explode("=", $ligne);
	$result = strpos($coup[0],":>"); 
	if ($result!==false)
	{
	$coup=explode(":>", $ligne);
	$coup2=explode("}", $coup[1]);
	$coup=explode("{var ", $coup[0]);	
	//echo"<bR>=>oui, faut vérifier que ".$coup[1]." vaut bien ".$coup2[0];
	$result=strpos($_POST['vraiesvars'], $coup[1]."=".$coup2[0]."|");
	//echo$result;
		if($result!==false)
		{
		//echo"on continue en remplacant {var ".$coup[1].":>".$coup2[0]."}";
		$ligne=str_replace("{var ".$coup[1].":>".$coup2[0]."}", "", $ligne);		
		}
		else
		{
		//echo"Pas bon, on stoppe tout";
		$continueanalyse=false;		
		}
	
	}
	
	//echo"<br>on  regarde si il faut connaitre nom";
		$result = strpos($ligne,"{var nom}"); 
	if ($result!==false)
	{
	//echo"=>oui";
		if($_POST['nom'] == null){
		//echo"Pas bon, on stoppe tout";
		$continueanalyse=false;
		
		}
		else
		{
		$ligne=str_replace("{var nom}", "", $ligne);	
		}
	}
	
	//echo"on  regarde si il faut pas connaitre nom";
		$result = strpos($ligne,"{nulle var nom}"); 
	if ($result!==false)
	{
	//echo"=>oui";
		if($_POST['nom'] == null){
		
		$ligne=str_replace("{nulle var nom}", "", $ligne);
		}
		else
		{
		//echo"Pas bon, on stoppe tout";
		$continueanalyse=false;
			
		}
	}

	//echo"<br>on regarde si il faut connaitre une variable";
	$result = strpos($ligne,"{var ");	
	while ($result!==false && $continueanalyse!=false)
	{
	//echo"On cherche après{ var => ".substr($ligne, $result);
	$coup=explode("}", substr($ligne, $result+5));
	//echo"<bR>On coupe avant } et on vérifique que"."|".$coup[0]."="."existe dans".$_POST['vraiesvars'];
	$result=strpos($_POST['vraiesvars'],"|".$coup[0]."=");
		if($result===false){
		//echo"=>La variable n'existe pas, on annule tout.<br>";
		$continueanalyse=false;
		}
		else
		{
		//echo"=>La variable existe. On la vire de la ligne et on continue";
		$ligne=str_replace("{var ".$coup[0]."}", "", $ligne);
		}
		$result = strpos($ligne,"{var ");	
	}	
	
	//echo"<br>on regarde si il faut PAS connaitre une variable";
	$result = strpos($ligne,"{nulle var ");	
	while ($result!==false && $continueanalyse!=false)
	{
	//echo"On cherche après{ var => ".substr($ligne, $result+11);
	$coup=explode("}", substr($ligne, $result+11));
	//echo"<bR>On coupe avant } et on vérifique que"."|".$coup[0]."="."existe dans".$_POST['vraiesvars'];
	$result=strpos($_POST['vraiesvars'],"|".$coup[0]."=");
		if($result===false){
		//echo"=>La variable n'existe pas, on la vire et continue<br>";
		$ligne=str_replace("{nulle var ".$coup[0]."}", "", $ligne);
		}
		else
		{
		//echo"=>La variable existe. On annule";
		$continueanalyse=false;
		}
		$result = strpos($ligne,"{var ");	
	}	
	
	//flemme de me faire chier et ca coute autant de ressources machines que de bidouiller la chaine	
// //echo"<br>on teste si faut remplacer un jocker dans ".$reponsebot;
// $result = strpos($reponsebot,"(*");	
// while ($result!==false){
// //echo"Le jocker est".substr($reponsebot, $result, 4);
// $coup=explode("\(\*",substr($reponsebot, $result, 4));
// $coup=explode("\)",$coup[1]);
// //echo"numero de jocker :".$coup[0];
	// if($result!=false){
	// //echo"=>oui.".$result ;
	// $reponsebot=str_replace("(*".$coup[0].")", $jok[$coup[0]], $reponsebot);
	// //echo"La réponse du bot devient : ".$reponsebot;
	// }else
	// {
	// //echo"=>non";
	// }
// $result = strpos($reponsebot,"(*");		
// }	
/////
	
	// on  regarde si il y a un log spécialà ne pas avoir
	$result = strpos($ligne, "{nulle "); 
	while ($result!==false && $continueanalyse!=false)

	{

	//echo"<br>on vérifie si la ligne ".$ligne." ne demande pas une condition de log temporaire à ne pas avoir";
	$result = strpos(substr($ligne, $result+7), "temp:");

	if ($result===0){
	 //echo"=>Oui, il faut vérifier la vartemp";
		$result = strpos($ligne, "{nulle "); 
		$coup=explode("}", substr($ligne, $result+7));

		if ($_POST['vartemp']=="{".$coup[0]."}"){
		//echo"<br>var temp {".$coup[0]."} juste. On arrête.";
		$continueanalyse=false;
		}
		else
		{
		 //echo"<bR>var temp ".$coup[0]." fausse, on continue.";
		$ligne=str_replace("{nulle ".$coup[0]."}", "", $ligne);

		}
	}
	else{
// VA FALLOIR AUTORISER PLUSIEURS CONDITIONS EN MEME TEMPS ET UTILISER STRPOS PARTOUT, DANS TOUS LES TESTS	...normalement c'est ok ...ben non
	//echo"=>Non, c'est un log spécial à ne pas avoir.";
	$result = strpos($ligne, "{nulle "); 
	$coup=explode("}", substr($ligne, $result+7));	
	//echo"<bR> On cherche si ce log spécial {".$coup[0]."} a été mémorisé...";
	$result = strpos($_POST['var'], "{".$coup[0]."}");

		if ($result!==false){
		//echo"=>oui. On arrête.";
		$continueanalyse=false;
		}
		else
		{		
		$ligne=str_replace("{nulle ".$coup[0]."}", "", $ligne);		
		//echo"=>non, on continue. La ligne devient :".$ligne;

		}
	}
	$result = strpos($ligne, "{nulle "); 
	}
	
	//on  regarde si il y a un log spécial à avoir	
	$result = strpos($ligne, "{"); 
	while ($result!==false && $continueanalyse!=false)
	{
	$coup=explode("}", $ligne);
	//echo"on vérifie si la ligne ".$ligne." ne demande pas une condition de log temporaire";
	$result = strpos($coup[0],"{temp:");
	if ($result!==false){
	//echo"=>Oui, il faut vérifier la vartemp".$coup[0];
		if ($_POST['vartemp']==$coup[0]."}"){
		//echo"<br>var temp juste. On modifie la ligne pour exclure ce log temp"."{".$coup[0]."}";		
		}
		else
		{
		//echo"<bR>var temp fausse, on arrête l'analyse de cette ligne.";
		$continueanalyse=false;
		}
	}
	else{
	//echo"=>Non, c'est un log spécial. <bR> On cherche si ce log spécial".$coup[0]."} a été mémorisé...";
	$result = strpos($_POST['var'], $coup[0]."}");
		if ($result!==false){
		//echo"=>oui. On modifie la ligne pour exclure ce log spécial."."{".$coup[0]."}";
		}
		else
		{
		//echo"=>non, fin de l'analyse.";
		$continueanalyse=false;
		}
	}
	$ligne=str_replace($coup[0]."}", "", $ligne);
	$result = strpos($ligne, "{");
	}
	
//trouver un moyen pour avoir d'autres variables...Un tableau avec d'un coté le nom de variable et de l'autre la valeur ? (<=c'est fait, voir modvar)
if ($continueanalyse==true){	
$coup=explode("=", $ligne);
	//echo"<br>on teste si il faut pas remplacer le nom dans ".$coup[0];
	//seulement s'il existe
	if ($_POST['nom']!=""){
	$result = strpos($coup[0], "<-nom->");
		if ($result!==false){
		//echo"=>Il faut.";
			if ($_POST['nom'] != null){
			$ligne=str_replace("<-nom->", $_POST['nom'], $ligne);	
			}
		}	
	}
}

if ($continueanalyse==true){	
//seulement si on a des vars
if($_POST['vraiesvars']!=""){
	$coup=explode("=", $ligne);
	//echo"<br>on teste si il faut pas remplacer une variable à la façon moyennement ancienne dans ".$coup[0];
	$result = strpos($coup[0], "<-var ");
		while($result!==false){
		//echo"=>Il faut.";
		$coup=explode("<-var ",$ligne);
		$coup=explode("->",$coup[1]);
		//echo"La variable à remplacer est ".$coup[0];
		$coup2=explode("|".$coup[0],$_POST['vraiesvars']);
		if (strpos($coup2[1], "=")!==false){
		$coup2=explode("=",$coup2[1]);
		$coup2=explode("|",$coup2[1]);
		//echo"<bR>sa valeur est ".$coup2[0];
			if($coup2[0]!="" && $coup2[0]!=null){
			$ligne=str_replace("<-var ".$coup[0]."->", $coup2[0], $ligne);
			}
			else
			{
			//echo"=>var vide, fin de l'analyse.";
			$continueanalyse=false;		
			$ligne=str_replace("<-var ".$coup[0]."->", $coup2[0], $ligne);
			}
		}
		else
		{
		//echo"=>var vide, fin de l'analyse.";
		$continueanalyse=false;		
		$ligne=str_replace("<-var ".$coup[0]."->", $coup2[0], $ligne);
		}		
		$coup=explode("=", $ligne);
		$result = strpos($coup[0], "<-var ");
		}

		
	//echo"<br>on teste si il faut pas remplacer une variable dans ".$coup[0];
	$result = strpos($coup[0], "<-var(");
		while($result!==false){
		//echo"=>Il faut.";
		$coup=explode("<-var(",$ligne);
		$coup=explode(")->",$coup[1]);
		//echo"La variable à remplacer est ".$coup[0];
		$coup2=explode("|".$coup[0],$_POST['vraiesvars']);
		$coup2=explode("=",$coup2[1]);
		$coup2=explode("|",$coup2[1]);
		//echo"<bR>sa valeur est ".$coup2[0];
			if($coup2[0]!="" && $coup2[0]!=null){
			$ligne=str_replace("<-var(".$coup[0].")->", $coup2[0], $ligne);
			}
			else
			{
			//echo"=>var vide, fin de l'analyse.";
			$continueanalyse=false;		
			$ligne=str_replace("<-var(".$coup[0].")->", $coup2[0], $ligne);
			}
		$coup=explode("=", $ligne);
		$result = strpos($coup[0], "<-var(");
		}	
	}
}

if ($continueanalyse==true){
$coup=explode("=", $ligne);
//echo"<br>on teste si il y a un log spécial à sauver dans ".$coup[0];
$result = strpos($coup[0], "]");
	if ($result!==false){
	//echo"=>Oui, il y en a un.";
	$coup=explode("[", $ligne);
	$coup=explode("]", $coup[1]);
	$logspetemp=$coup[0];
	//echo"on garde ".$logspetemp." sous le coude, sans savoir s'il est temporaire ou pas. On récupère ce qu'il y a avant [.";
	$coup=explode("[", $ligne);
	}
	
//echo"<br>on teste si c'est une ligne générique ".$coup[0];	
$result = strpos($coup[0], "~");
	if ($result!==false){
	//echo"=>oui.";
	$stoplecturegen=false;
	//on fait un mini test sur les bouts de phrases pour voir si c'est pertinent de tester chaque truc générique
	$coup2=explode("~", $coup[0]);//modifié pour prendre en compte les "tu es ~super~sympa" et "tu es ~super~|"
	$coup2[0]=str_replace("|", "", $coup2[0]);
	$coup2[2]=str_replace("|", "", $coup2[2]);	
	// echo "on teste si'".$coup2[0]."' et '".$coup2[2]."' sont dans '".$_POST['usersay']."'";
	if($coup2[0]!=""){
	$result = strpos($_POST['usersay'], $coup2[0]);
	// echo $result;
	if ($result === false){
	// echo "Non, ça sert à rien de se prendre la tête à lire les fichiers gen";
	$stoplecturegen=true;
	}
	}
	if($coup2[2]!=""){
	$result = strpos($_POST['usersay'], $coup2[2]);
	// echo $result;
	if ($result === false){
	// echo "Non, ça sert à rien de se prendre la tête à lire les fichiers gen";
	$stoplecturegen=true;
	}
	}
	
	$coup2=explode("~", $ligne);
	$coup2=explode("~", $coup2[1]);
	$nomfichiergen=$coup2[0];
	//echo"on cherche ".$nomfichiergen.".txt";
	//ATTENTION AU SENS DU SLASH SELON SERVEUR WINDOWS/LINUX
		$lecturegen = fopen("gen/".$nomfichiergen.".txt","r");
		while (!feof ($lecturegen) && $stoplecturegen==false) {
		$lignegen= fgets($lecturegen, 1024);
		//$lignegen=strtolower($lignegen);
		$lignegen=mb_convert_case($lignegen, MB_CASE_LOWER, "utf-8");
		//echo"<br>...Teste dans le fichier gen : ".$lignegen;
			//echo"<br>on teste si il y a une limite de coté dans ".$lignegen;	
			
$result = strpos($lignegen, "|");
	if ($result!==false){
	//echo"=> oui.";		
		$coup2=explode("|", $lignegen);
			if($coup2[0] == "")
			{
			$genlimiteok=false;
			//echo"<br>La limite de la ligne gen est à gauche.";
			$coup2[1]=str_replace("\r\n", "", $coup2[1]);
			//echo"<br>Teste si ".$coup2[1]." correspond au début de ".$_POST['usersay'];
			$result=strpos($_POST['usersay'], $coup2[1]);
			//echo$result;
				if($result===false)
				{
				//echo"<br>Rien ne correspond....";
				//echo"=>fin de l'analyse.";
				$genlimiteok=false;				
				}
				if($result==0 && $result !== false )
				{
				//echo"<br>C'est bien juste le début.";
				$genlimiteok=true;
				}
				if($result>0)
				{
				//echo"<br>C'est pas le début.";
				//echo"=>fin de l'analyse.";
				$genlimiteok=false;		
				}				
			}
			$coup2=explode("|", $lignegen);
			//echo$coup2[count($coup2)-2];			
			if($coup2[count($coup2)-2] != "" && $genlimiteok !== false)
			{
			//echo"<br>La limite de la ligne gen est à droite.";
			// echo"<br>Teste si la longueur de ".$_POST['usersay']." correspond à l'endroit où on a trouvé ".$coup2[count($coup2)-2]."moins la taille de ".$coup2[count($coup2)-2];
			$result=strpos($_POST['usersay'], $coup2[count($coup2)-2]);
			//echo $result;
				if($result===false)
				{
				//echo"<br>Rien ne correspond....";
				//echo"=>fin de l'analyse.";
				$genlimiteok=false;			
				}
				else{
					//si usersay est égal à la position où on a détecté le début de la ligne plus la chaine à chercher
					if(strlen($_POST['usersay'])==$result+strlen($coup2[count($coup2)-2])){
					//echo"<br>C'est bien la fin.";
					$genlimiteok=true;
					}
					else
					{
					//echo"=>Nope, fin de l'analyse.";
					$genlimiteok=false;		
					}
				}
			}
		
		
		if($genlimiteok==true){
		// echo"Trouv&eacute; avec les limites de coté !";
		$coup2=explode("~", $coup[0]);
		$lignegen=str_replace("\r", "", $lignegen);
		$lignegen=str_replace("\n", "", $lignegen);		
		$coup[0]=$coup2[0].$lignegen.$coup2[2];//pour arrêter l'analyse
		// echo "Ca fait comme si on avait dans le cerveau la ligne ".$coup[0];
		$coup[0]=$_POST['usersay'];//à repenser
		$stoplecturegen=true;		
			$coup2=explode("~", $coup[0]);
			$coup2[0]=str_replace("|", "", $coup2[0]);
			$coup2[2]=str_replace("|", "", $coup2[2]);
			$coup2[0]=str_replace("\(\*\)", "", $coup2[0]);
			$coup2[2]=str_replace("\(\*\)", "", $coup2[2]);		
			$usersaycoupcherche=str_replace("|", "", $lignegen);//on sauve comme un joker, pour retenir un adjectif par exemple
			// echo str_replace("\r", "", $lignegen);
		}
	}
		else{//echo"...pas de limites de coté.";
		}
		
	
			$lignegen=str_replace("\r", "", $lignegen);
			$lignegen=str_replace("\n", "", $lignegen);////////////////////////////////////////////////////////////
			$coup2=explode("~", $coup[0]);//modifié pour prendre en compte les "tu es ~super~sympa" et "tu es ~super~|"
			$coup2[0]=str_replace("|", "", $coup2[0]);
			$coup2[2]=str_replace("|", "", $coup2[2]);
			$coup2[0]=str_replace("\(\*\)", "", $coup2[0]);
			$coup2[2]=str_replace("\(\*\)", "", $coup2[2]);
			$result = strpos($_POST['usersay'], $coup2[0].$lignegen.$coup2[2]);			
			//echo "on teste <br>".$_POST['usersay'].".....".$coup2[0].$lignegen.$coup2[2];
			//echo "RESULTAT".$result."AA";
			if ($result === false){
			//echo"(sans prendre en compte le résultat des limites de coté)Ne correspond pas.";
			}else
			{
			//echo"<br>Ca correspond !";			
			// $coup[0]=$_POST['usersay']; //modifié pour prendre en compte les "tu es ~super~sympa" et
			$usersaycoupcherche=$lignegen;//on sauve comme un joker, pour retenir un adjectif par exemple
			$coup2=explode("~", $coup[0]);
			$coup[0]=$coup2[0].$lignegen.$coup2[2];
			$stoplecturegen=true;
			}
		}
		if(feof($lecturegen)){
		//echo"FIN DU FICHIER";
		}
		rewind($lecturegen);
		fclose($lecturegen);		
	}	
	else
	{
	//echo"=>non.";
	}

// echo"<br>on teste si il y a une limite de coté dans ".$coup[0];		
$result = strpos($coup[0], "|");
	if ($result!==false){
	//echo"=> oui.";
	//echo"<br>on teste si il y a un jocker en plus de la limite de coté";	
		$result = strpos($coup[0], "(*)");
		if ($result>0){
		//echo"=> oui.";
			$coup2=explode("|", $coup[0]);
			if($coup2[0] == "")
			{
			//echo"<br>La limite est à gauche. On coupe avant le jocker et teste normalement.";
			$coup2=explode("(*)", $coup2[1]);
			//echo"<br>Teste si ".$coup2[0]." correspond au début de ".$_POST['usersay'];
			$result=strpos($_POST['usersay'], $coup2[0]);
			//echo$result;
				if($result===false)
				{
				//echo"<br>Rien ne correspond....";
				//echo"=>fin de l'analyse.";
				$continueanalyse=false;				
				}
				if($result==0 && $result !== false )
				{
				//echo"<br>C'est bien juste le début.";
				}
				if($result>0)
				{
				//echo"<br>C'est pas le début.";
				//echo"=>fin de l'analyse.";
				$continueanalyse=false;	
				}
			}
			$coup2=explode("|", $coup[0]);
			if($coup2[count($coup2)-1] == "")
			{
			//echo"<br>La limite est à droite. On coupe après le jocker et teste normalement.";
			$coup2=explode("(*)", $coup2[count($coup2)-2]);
			//echo"<br>Teste si la longueur de ".$_POST['usersay']." correspond à l'endroit où on a trouvé ".$coup2[count($coup2)-1]."moins la taille de ".$coup2[count($coup2)-2];			
			$result=strpos($_POST['usersay'], $coup2[count($coup2)-1]);
			//echo$result;
				if($result===false)
				{
				//echo"<br>Rien ne correspond....";
				//echo"=>fin de l'analyse.";
				$continueanalyse=false;				
				}
				//echo strlen($_POST['usersay']);
				//echo$result+strlen($coup2[count($coup2)-1]);
				//si usersay est égal à la position où on a détecté le début de la ligne plus la chaine à chercher
				if(strlen($_POST['usersay'])==$result+strlen($coup2[count($coup2)-1])){
				//echo"<br>C'est bien la fin.";
				}
				else
				{
				//echo"=>Nope, fin de l'analyse.";
				$continueanalyse=false;	
				}
			}
			
		}
		else{
		//echo"=>Non.";
		$coup2=explode("|", $coup[0]);
			if($coup2[0] == "")
			{
			//echo"<br>La limite est à gauche.";
			//echo"<br>Teste si ".$coup2[1]." correspond au début de ".$_POST['usersay'];
			$result=strpos($_POST['usersay'], $coup2[1]);
			//echo$result;
				if($result===false)
				{
				//echo"<br>Rien ne correspond....";
				//echo"=>fin de l'analyse.";
				$continueanalyse=false;				
				}
				if($result==0 && $result !== false )
				{
				//echo"<br>C'est bien juste le début.";
				}
				if($result>0)
				{
				//echo"<br>C'est pas le début.";
				//echo"=>fin de l'analyse.";
				$continueanalyse=false;	
				}				
			}
			$coup2=explode("|", $coup[0]);			
			if($coup2[count($coup2)-1] == "")
			{
			//echo"<br>La limite est à droite.";
			//echo"<br>Teste si la longueur de ".$_POST['usersay']." correspond à l'endroit où on a trouvé ".$coup2[count($coup2)-2]." moins la taille de ".$coup2[count($coup2)-2];
			$result=strpos($_POST['usersay'], $coup2[count($coup2)-2]);
			//echo$result;
				if($result===false)
				{
				//echo"<br>Rien ne correspond....";
				//echo"=>fin de l'analyse.";
				$continueanalyse=false;				
				}
				//si usersay est égal à la position où on a détecté le début de la ligne plus la chaine à chercher
				//echo strlen($_POST['usersay']);
				//echo$result+strlen($coup2[count($coup2)-2]);
				if(strlen($_POST['usersay'])==$result+strlen($coup2[count($coup2)-2])){
				//echo"<br>C'est bien la fin.";
				}
				else
				{
				//echo"=>Nope, fin de l'analyse.";
				$continueanalyse=false;	
				}
			}
		}
		
		$coup[0]=str_replace("|", "", $coup[0]);
	}
}	

if ($continueanalyse==true){	
// echo"<br>on teste si il y a un jocker dans ".$coup[0];	
$result = strpos($coup[0], "(*)");
	if ($result!==false){
	// echo"=> oui.";
	$coup=explode("(*)", $coup[0]);
	$usersaycoupcherche=$_POST['usersay'];
	// echo"usersaycoupcherche=".$usersaycoupcherche;
		for ($i=0; $i<count($coup); $i++)
		{
		// echo"<br>on teste si ::".$coup[$i].":: est contenu dans ::".$usersaycoupcherche."::";
		//$result=ereg ($usersaycoupcherche,$coup[$i]);
		//cherche la position de  $coup[$i] dans $usersaycoupcherche
		if($coup[$i]==""){
		// echo"<br>plus rien après ce jocker...";
		$jok[$i]=$usersaycoupcherche;
		// echo"<br>on met le dernier bout de phrase dans jok[dernierjok]";
		// echo"<br>jok".$i."=".$jok[$i]."<br>";
		}
		else{
		$result=strpos($usersaycoupcherche,$coup[$i]);
		if($result===false){
		//echo"=>non, fin de l'analyse.";
		$i=count($coup);
		$continueanalyse=false;
		}
		else{
			// echo"trouvé position ".$result." plus ".strlen($coup[$i]);
			$result=$result+strlen($coup[$i]);		
				// echo"on met dans jok[i] la partie de la phrase avant".$usersaycoupcherche;
				$coupjok=explode($coup[$i], $usersaycoupcherche);
				// echo "<br>faudra sauver :".$coupjok[0];
				//$jok[$i]=$coupjok[count($coupjok)-2];<=pourquoi j'avais mit -2...?
				$jok[$i]=$coupjok[0];
				// echo"<br>jok".$i."=".$jok[$i]."<br>";			
				if($i!=count($coup)-1)
				{	
				$usersaycoupcherche=substr($usersaycoupcherche, $result);
				//echo$usersaycoupcherche."AAAH";
				}
				else
				{
				//pour pas sauver le jocker même si il avait quelque chose après                           |FEV09 je comprends pas la ligne à gauche
				//echo"Il y a un signe après le jocker, on sauve pas ce qu'il y a après ce signe";|FEV09 je comprends pas non plus cette ligne à gauche
				//$coup2=explode($coup[count($coup)-1], $usersaycoupcherche);|FEV09 je supprime, ça pose problème avec "je suis (*) et" si on tape "je suis bleu *et* rouge *et* vert"
				//$usersaycoupcherche=$coup2[count($coup2)-2];|FEV09 ...il répond "ok tu es rouge" au lieu de bleu
				$usersaycoupcherche=$coupjok[0];
					//laisser ces remplacements ou pas....?
					//c'est un peu chiant si l'utilisateur dit "j'aime les crèmes au chocolat "->"c'est bon les cretes au chocolat ?")
				// $coupjok[0]=str_replace("mon ", "ton ", $coupjok[0]);
				// $coupjok[0]=str_replace("ma ", "ta ", $coupjok[0]);
				// $coupjok[0]=str_replace("mes ", "tes ", $coupjok[0]);
				// $coupjok[0]=str_replace("ton ", "mon ", $coupjok[0]);
				// $coupjok[0]=str_replace("ta ", "ma ", $coupjok[0]);
				// $coupjok[0]=str_replace("tes ", "mes ", $coupjok[0]);

				}
			}
			
		}
		}

	}
	else
	{
	//echo"=> non, alors on analyse simplement.";	

//echo"<br>on teste si ".$coup[0]." est contenu dans ".$_POST['usersay'];
if ($coup[0]==""){
//echo"...dans...euh, ya rien à tester dans le cerveau, donc ok.";
}
else{		
$result = strpos($_POST['usersay'], $coup[0]);
//echo$result;
	if ($result !== false){
	//echo"=>Oui";
	}
	else
	{
	//echo"=>Non, fin de l'analyse.";
	$continueanalyse=false;
	}
}	
}
}	

if ($continueanalyse==true){
$coup=explode("=", $lignemaj);
$stoplecture=true;
//on suppose que c'est pas réutilisable
$reponsenonreut=true;
$lignequestioncomplete=$coup[0];
//si c'est pas vide (je sais même plus ce que c'est...), rajoute en juin2010 )our supprimer affichage "Undefined offset"
if(empty($coup[1])==false){
$lignereponsecomplete=$coup[1];}
$lignereponsecomplete=str_replace("\n", "", $lignereponsecomplete);
$lignereponsecomplete=str_replace("\r", "", $lignereponsecomplete);
while($reponsenonreut==true){
$lignereponsecomplete=str_replace("||", "|", $lignereponsecomplete);
// //echo "<br>On teste :".$lignereponsecomplete;
$coup=explode("|", $lignereponsecomplete);
//si ya rien avant le premier |, on le vire
if($coup[0]==""){
// //echo"<br>Il y a un | vide au début de ".$lignereponsecomplete;
$coup[0]=$lignequestioncomplete."=".$lignereponsecomplete;
// //echo$coup[0];
$coup=explode("=|", $coup[0]);

//rajouté ce truc empty ya pas longtemps pour supprimer affichage "Undefined offset", peut poser problèeme php5...?
if(empty($coup[1])){
$lignereponsecomplete="";}
else{$lignereponsecomplete=$coup[1];}


}
// //echo "on teste si ".$lignereponsecomplete." est vide";
if($lignereponsecomplete=="")
{
// //echo "Réponse vide, en fait";
$lignereponsecomplete="<-ignorer->";
$reponsenonreut=false;	
}
//echo"<br>La ligne de réponse est : ".$lignereponsecomplete.". On coupe aux | et on renvoie ";
$coup=explode("|", $lignereponsecomplete);
//si ya rien après le dernier |, pareil, il dégage
if($coup[count($coup)-1]==""){
$pif=mt_rand(0,count($coup)-2);
}
else{
$pif=mt_rand(0,count($coup)-1);
}
//echo$coup[$pif];
//echo"<br>on vérifie si ".$coup[$pif]." n'existe pas dans les réponses non reutilisables ".$_POST['noreut'];
$result = strpos($_POST['noreut'], "".htmlspecialchars($coup[$pif])."|");
//echo$result;
		if($result !==false){
		//echo"=>Il ne fallait pas l'utiliser. On l'enlève de la réponse.";
		$reponsenonreut=true;
		$lignereponsecomplete=str_replace($coup[$pif], "", $lignereponsecomplete);
		}
		else
		{
		//echo"=>C'est bon, on peut l'utiliser.";
		$reponsenonreut=false;		
		}
}
//echo"<br>on teste si il ne faut plus jamais réutiliser cette réponse dans ".$reponsebot;
$result = strpos($coup[$pif], "<NOREUT>");	
//echo$result;
	if($result!==false){
	//echo"=>Il ne faut plus l'utiliser.";
	$coup2=explode("=", $lignemaj);
	$_POST['noreut']=$_POST['noreut']."|".htmlspecialchars($coup[$pif])."|";
	}
	
//echo"<br>on teste si il ne faut plus jamais réutiliser cette réponse dans ".$reponsebot;
$result = strpos($coup[$pif], "<-noreut->");	
//echo$result;
	if($result!==false){
	//echo"=>Il ne faut plus l'utiliser.";
	$coup2=explode("=", $lignemaj);
	$_POST['noreut']=$_POST['noreut']."|".htmlspecialchars($coup[$pif])."|";
	$coup[$pif]=str_replace("<-noreut->", "", $coup[$pif]);
	}
	
//echo"<br>on teste si il faut traiter cette réponse, mais ne pas s'arrêter dessus";
$result = strpos($coup[$pif], "<-continuer->");	
//echo$result;
	if($result!==false){
	//echo"=>Faut continuer";
	$coup2=explode("<-continuer->", $coup[$pif]);
	//pourquoi j'utilise pas replace ici ?
	$coup[$pif]=$coup2[0].$coup2[1];
	$stoplecture=false;
	}
else
{
//si on ne continue pas, et si on ignore pas non plus, on efface la var temp ! ajouté le 03/06/2010, à tester...si j'ai de sproblèmes de var temp ça vient de là..j'en ai eu, et au juste remplacé lignereponsecomplete par couppif, j'ai du me gourer
//echo "Si '".$coup[$pif]."' est différent de IGNORER, on efface la var temp";
	if($coup[$pif]!="<IGNORER>" && $coup[$pif]!="<-ignorer->"){
	//echo "=>on efface la var temp";
	$_POST['vartemp']="";}
}
	
$reponsebot=$coup[$pif];	
//echo"<br>on teste si il y a un log spécial à sauver dans la réponse ".$reponsebot;
$result = strpos($reponsebot, "]");
//echo$result;
	while ($result!==false){
	$coup=explode("[", $reponsebot);
	$coup=explode("]", $coup[1]);
	//echo"<br>on stocke ::".$coup[0]."::";
	$result = strpos($coup[0], "temp:");
		if ($result!==false){
		//echo" dans les vartemps.";
		$_POST['vartemp']="{".mb_convert_case($coup[0], MB_CASE_LOWER, "utf-8")."}";
		//echo"et on remplace "."[temp:".$coup[0]."] dans".$reponsebot;
		$reponsebot=str_replace("[".$coup[0]."]","",$reponsebot);
		}
		else{
		//echo"dans les log spéciaux non temporaires.";
		$_POST['var']=$_POST['var']."{".$coup[0]."}";
		$reponsebot=str_replace("[".$coup[0]."]","",$reponsebot);
		}
		$result = strpos($reponsebot, "]");
	}


	if($logspetemp!=""){
		$result = strpos($logspetemp, "temp:");
		//echo"<br>le log spécial (".$logspetemp.") de la question était ";
		if ($result!==false){
		//echo"temporaire. On le met dans la vartemp.";
		$_POST['vartemp']="{".$logspetemp."}";
		}
		else{
		//echo"pas temporaire.<br>on sauve le log spécial = " .$logspetemp;
		$_POST['var']=$_POST['var']."{".$logspetemp."}";
		//echo$_POST['var'];
		}

	}
//echo"<br>on teste si il faut ignorer cette réponse";
$result = strpos($reponsebot, "<IGNORER>");	
	if($result!==false){
	//echo"=>Oui, tout ça pour rien.";
	$stoplecture=false;
	}
//echo"<br>on teste si il faut ignorer cette réponse";
$result = strpos($reponsebot, "<-ignorer->");	
	if($result!==false){
	//echo"=>Oui, tout ça pour rien.";
	$stoplecture=false;
	}

//echo"<br>on teste si faut remplacer un jocker dans la réponse";
$result = strpos($reponsebot, "(*)");	
	if($result!==false){
	//echo"=>oui.";
	$reponsebot=str_replace("(*)", $usersaycoupcherche, $reponsebot);
	//echo"La réponse du bot devient : ".$reponsebot;
	}else
	{
	//echo"=>non";
	}	
	
//echo"<br>on teste si faut remplacer un jocker à chiffre dans ".$reponsebot;
$result = strpos($reponsebot,"(*");	
while ($result!==false){
//echo"Le jocker est".substr($reponsebot, $result, 4);
$coup=explode("(*",substr($reponsebot, $result, 4));
$coup=explode(")",$coup[1]);
//echo"numero de jocker :".$coup[0];
	if($result!==false){
	//echo"=>oui.".$result ;
	$reponsebot=str_replace("(*)", $usersaycoupcherche, $reponsebot);
	$reponsebot=str_replace("(*".$coup[0].")", $jok[$coup[0]], $reponsebot);
	//echo"La réponse du bot devient : ".$reponsebot;
	}else
	{
	//echo"=>non";
	}
$result = strpos($reponsebot,"(*");		
}		

//echo"<br>on vérifie s'il faut pas modifier une variable à l'ancienne façon";		
//->modvar uservabien:>oui<-		
$result = strpos($reponsebot, "->modvar");
	while($result!==false){
	$varchangee=false;		
	$coup=explode("->modvar ", $reponsebot);
	$coup=explode(":>", $coup[1]);
	//echo"=>Oui, il faut modifier ".$coup[0];
	//echo"<br>on cherche ".$coup[0]." dans ".$_POST['vraiesvars'];
	$result = strpos($_POST['vraiesvars'], $coup[0]);
		if($result===false)
		{
		//echo"On créé une nouvelle variable. à la suite.";
		$_POST['vraiesvars']=$_POST['vraiesvars']."|".$coup[0]."=";
		$reponsebot=str_replace("->modvar ".$coup[0].":>", "",$reponsebot);
		$coup=explode("<-", $coup[1]);	
		$_POST['vraiesvars']=$_POST['vraiesvars'].$coup[0]."|";
		$reponsebot=str_replace($coup[0]."<-", "",$reponsebot);
		//echo"<br>Les variables deviennent :".$_POST['vraiesvars'];
		}
		else
		{
		//echo"trouvé position ".$result;
		//echo"en premiere position dans la ligne ".substr($_POST['vraiesvars'], $result);
		$coup2=explode("|", substr($_POST['vraiesvars'], $result));	
		//echo"il faut changer ".$coup2[0];
		$_POST['vraiesvars']=str_replace("|".$coup2[0]."|","",$_POST['vraiesvars']);
		//echo"On créé une nouvelle variable. à la suite.";
		$_POST['vraiesvars']=$_POST['vraiesvars']."|".$coup[0]."=";
		$reponsebot=str_replace("->modvar ".$coup[0].":>", "",$reponsebot);
		$coup=explode("<-", $coup[1]);	
		$_POST['vraiesvars']=$_POST['vraiesvars'].$coup[0]."|";
		$reponsebot=str_replace($coup[0]."<-", "",$reponsebot);
		//echo"<br>Les variables deviennent :".$_POST['vraiesvars'];		
		}
		$result = strpos($reponsebot, "->modvar");
	}
	
//echo"<br>on vérifie s'il faut pas modifier une variable";		
//->modvar uservabien:>oui<-		
//<-modvar(nomuser,(*))->
$result = strpos($reponsebot, "<-modvar(");
	while($result!==false){
	$varchangee=false;		
	$coup=explode("<-modvar(", $reponsebot);
	$coup=explode(",", $coup[1]);
	//echo"=>Oui, il faut modifier '".$coup[0];
	//echo"<br>on cherche ".$coup[0]." dans ".$_POST['vraiesvars'];
	$result = strpos($_POST['vraiesvars'], $coup[0]);
		if($result===false)
		{
		//echo"...dans rien, pas de variables enregistrees. On cree une nouvelle variable a la suite.";
		//echo"On modifie'".$coup[0];
		$_POST['vraiesvars']=$_POST['vraiesvars']."|".$coup[0]."=";
		$coup2=explode($coup[0].",", $reponsebot); //modvar($a,|bla)->
		$coup2=explode(")->", $coup2[1]); //bla|)->
		$_POST['vraiesvars']=$_POST['vraiesvars'].$coup2[0]."|";
		//echo "' avec '".$coup2[0]."'<br>";
		$reponsebot=str_replace("<-modvar(".$coup[0].",".$coup2[0].")->", "",$reponsebot);
		//echo"<br>Les variables deviennent : '".$_POST['vraiesvars']."'";
		}
		else
		{
		//echo"trouvé position ".$result;
		//echo"en premiere position dans la ligne '".substr($_POST['vraiesvars'], $result)."'";
		$coup2=explode("|", substr($_POST['vraiesvars'], $result));	
	    //echo"il faut changer ".$coup2[0];
		$_POST['vraiesvars']=str_replace("|".$coup2[0]."|","",$_POST['vraiesvars']);
		//echo"On créé une nouvelle variable. à la suite.";
		$_POST['vraiesvars']=$_POST['vraiesvars']."|".$coup[0]."=";
		$coup2=explode($coup[0].",", $reponsebot); //modvar($a,|bla)->
		$coup2=explode(")->", $coup2[1]); //bla|)->		
		$_POST['vraiesvars']=$_POST['vraiesvars'].$coup2[0]."|";
		$reponsebot=str_replace("<-modvar(".$coup[0].",".$coup2[0].")->", "",$reponsebot); //PROBLEME AVEC LA VIRGULE ICI
		//echo"<br>Les variables deviennent :".$_POST['vraiesvars'];
		}
		//echo "la reponse devient :'".$reponsebot."'";
		$result = strpos($reponsebot, "<-modvar(");
	}

//echo"<br>On teste si il y a un changement de cerveau";	
$result = strpos($reponsebot, "chgcerva:");	
	if($result!==false){
	//echo"=>oui, changement vers ";
	$coup=explode("chgcerva:",$reponsebot);
	$coup=explode(">",$coup[1]);
	//echo$coup[0];	
	$_POST['cerveau']=$coup[0];
	}

//echo"<br>on teste si il faut pas sauver le nom";
$result = strpos($reponsebot, "->savvar nom<-");	
	if($result!==false){
	//echo"=>oui. Le nom est ".$usersaycoupcherche;
	$_POST['nom']=$usersaycoupcherche;	
	$reponsebot=str_replace("->savvar nom<-", "", $reponsebot);		
	}
//echo"<br>on teste si il faut pas réutiliser le nom";
$result = strpos($reponsebot, "<-nom->");	
	if($result!==false){
	//echo"=>oui. On réutilise ".$_POST['nom'];
	$reponsebot=str_replace("<-nom->", $_POST['nom'], $reponsebot);		
	}
//echo"<br>on teste si il faut utiliser l'heure";
$result = strpos($reponsebot, "<-heure->");	
	if($result!==false){
	//echo"=>oui.";
	$reponsebot=str_replace("<-heure->", date("H:i"), $reponsebot);		
	}	

//echo"<br>on teste si il faut utiliser la date";
$result = strpos($reponsebot, "<-date->");	
	if($result!==false){
	//echo"=>oui.";
	$reponsebot=str_replace("<-date->", date("d/n/Y"), $reponsebot);		
	}		

//echo"<br>on teste si il faut pas traiter une url";
$result = strpos($reponsebot, "<-url");	
	while($result!==false){
		$coup=explode("<-url(", $reponsebot);	
		$coup=explode(",", $coup[1]);	
		$coup2=explode(")->", $coup[1]);
		//echo"L'url est ".$coup[0].", l'intitulé est ".$coup2[0];
		$reponsebot=str_replace("<-url(".$coup[0].",".$coup2[0].")->","<a target=\"_blank\" href=\"".$coup2[0]."\">".$coup[0]."</a>", $reponsebot);		

		$result = strpos($reponsebot, "<-url");	
	}		
	
//echo"<br>on teste si il faut pas traiter une réponse cliquable";
$result = strpos($reponsebot, "<-clicrep");	
	while($result!==false){
		$coup=explode("<-clicrep(", $reponsebot);	
		$coup=explode(",", $coup[1]);	
		$coup2=explode(")->", $coup[1]);
		//echo"L'url est ".$coup[0].", l'intitulé est ".$coup2[0];
		$reponsebot=str_replace("<-clicrep(".$coup[0].",".$coup2[0].")->","<a onClick=\"envoiemot('".$coup2[0]."')\" href=\"javascript:;\">".$coup[0]."</a>", $reponsebot);		
		$result = strpos($reponsebot, "<-clicrep");	
	}		

	//fait direct dans le bot
// //echo"<br>on teste si il faut pas définir un mot";
// $result = ereg("<-define", $reponsebot);	
	// while($result>0){
	// //echo"=>oui. il faut définir ".$usersaycoupcherche;
		// //echo"<br>teste s'il faut nommer l'url spécialement...";
		// $result = ereg("<-define:", $reponsebot);	
		// if($result>0){
		// $coup=explode("<-define:", $reponsebot);	
		// $coup=explode("->", $coup[1]);	
		// //echo"=>Oui, le lien s'intitule ".substr($coup[0], -4);
		// $reponsebot=str_replace("<-define:".substr($coup[0], -4)."->","<a href=\"http://fr.wiktionary.org/wiki/".$usersaycoupcherche."\">".substr($coup[0], -4)."</a>", $reponsebot);		
		// }
		// else{
		// $reponsebot=str_replace("<-define->","<a href=\"http://fr.wiktionary.org/wiki/".$usersaycoupcherche."\">".$usersaycoupcherche."</a>", $reponsebot);		
		// }
		// $result = ereg("<-define", $reponsebot);	
	// }





//echo"<br>on teste si il y a un rappel";
$result = strpos($reponsebot, "<-rappel");
//echo$result;
	if($result!==false){
	$coup=explode("<-rappel(",$reponsebot);
	$coup=explode(")->",$coup[1]);
	$coup=explode(",",$coup[0]);
	//echo"=>Oui. Rappel dans ".$coup[0]." mn de ".$coup[1];
	//echo"Le rappel sera à ".date("H:i:s",mktime(date("h"), date("i")+$coup[0], 0, date("s")  , date("d"), date("Y")));
	$_POST['rappel']=$_POST['rappel']."|".date("H:i",mktime(date("H"), date("i")+$coup[0], 0, date("s")  , date("d"), date("Y"))).",".$coup[1];
	$reponsebot=str_replace("<-rappel(".$coup[0].",".$coup[1].")->", "", $reponsebot);		
	}	
	
//echo"<br>on teste si il y a un rappel de rappel";
$result = strpos($reponsebot, "<-?rappel->");
//echo$result;
	if($result!==false){
	//echo"=>Oui. Rappel dans ".$coup[0]." mn de ".$coup[1];
	//echo"Le rappel sera à ".date("H:i:s",mktime(date("h"), date("i")+$coup[0], 0, date("s")  , date("d"), date("Y")));
	$reponsebot=str_replace("<-?rappel->", $_POST['rappel'], $reponsebot);		
	}	
	
//echo"<br>on teste si on demande d'afficher une variable de la façon moyennement ancienne";	
$result = strpos($reponsebot, "<-var ");
while($result!==false){
	$coup=explode("<-var ",$reponsebot);
	$coup=explode("->",$coup[1]);
	//echo"<br>=>ouila variable à afficher est ".$coup[0];
	$result=strpos($_POST['vraiesvars'], "|".$coup[0]);
	$coup2=explode("|", substr($_POST['vraiesvars'], $result));
	$coup2=explode("=", $coup2[1]);
	//echo"valeur = ".$coup2[1];
	$reponsebot=str_replace("<-var ".$coup[0]."->", $coup2[1], $reponsebot);
	$result = strpos($reponsebot, "<-var ");
}

//echo"<br>on teste si on demande d'afficher une variable";	
$result = strpos($reponsebot, "<-var(");
while($result!==false){
	$coup=explode("<-var(",$reponsebot);
	$coup=explode(")->",$coup[1]);
	//echo"<br>=>ouila variable à afficher est ".$coup[0];
	$result=strpos($_POST['vraiesvars'], "|".$coup[0]);
	$coup2=explode("|", substr($_POST['vraiesvars'], $result));
	$coup2=explode("=", $coup2[1]);
	//echo"valeur = ".$coup2[1];
	$reponsebot=str_replace("<-var(".$coup[0].")->", $coup2[1], $reponsebot);
	$result = strpos($reponsebot, "<-var(");
}

//pas la bonne technique. Il faut que je lise la chaine et résolve au fur et à mesure. 1+2+4-6+4+2-3 etc, en ayant traités les multiplications et divisions avant
//echo"<br>on teste si il faut compter dans".$reponsebot;
$result = strpos($reponsebot, "<-compter(");
if ($result!==false)
{
$coup=explode("<-compter(",$reponsebot);
$coup=explode(")->",$coup[1]);
$coup[1]=$coup[0];
//echo"Il faut compter ".$coup[0];
	  $coup[0] = str_replace("x", "*", $coup[0]);
	  $coup[0] = str_replace(".-", "-", $coup[0]);
      $coup[0] = preg_replace("/[^0-9+\-.*\/()%]/","",$coup[0]);
      $coup[0] = preg_replace("/([+-])([0-9]+)(%)/","*(1\$1.\$2)",$coup[0]);
	  $coup[0] = preg_replace("/([0-9]+)(%)/",".\$1",$coup[0]);
	  //echo"AAA".$coup[0];
	  $result = strpos($coup[0], "+");
	  //echo"<br>taille du calcul".strlen($coup[0]);
	  //echo"<br>dernier + trouvé à".$result;
		if($result===0 || $result==strlen($coup[0])-1 || substr($coup[0], 0, 1)=="+"|| substr($coup[0], 0, 1)=="-"|| substr($coup[0], 0, 1)=="*"|| substr($coup[0], 0, 1)=="/"){
		//echo"Mauvais calcul";
		$coup[0] ="";
		}		
		if ( $coup[0] == "" ) {
        //echo"Mauvais calcul";
		$stoplecture=false;
		$_POST['usersay']="errcalc";
		} else {
              eval("\$coup[0]=" . $coup[0] . ";" );
			  //echo"resultat de ".$coup[1]."=".$coup[0];
		}		
		$reponsebot=str_replace("<-compter(".$coup[1].")->", $coup[0], $reponsebot);
	
	// $coup=explode("<-compter(",$reponsebot);
	// //echo"Addition";
	// $result = strpos($coup[1], "+");
		// if ($result!==false){
		// $coup=explode(")->",$coup[1]);
		// $coup2=explode("+",$coup[0]);
		// //echo"AAAAH = ".$coup[0];
		// $result=0;
			// for ($i=0; $i<=count($coup2); $i++)
			// {
			// élimine toutes les lettres
			// //echo$coup2[$i];
			// $result=$result+preg_replace("[\D]", "", $coup2[$i]);
			// }
		// //echo"résultat =".$result;	
		// $reponsebot=str_replace("<-compter(".$coup[0].")->", $result, $reponsebot);			
		// }	
	
	// //echo"soustraction";
	// $result = strpos($coup[1], "-");
		// if ($result!==false){
		// $coup=explode(")->",$coup[1]);
		// $coup2=explode("-",$coup[0]);
		// //echo"AAAAH = ".$coup[0];
		// $result=preg_replace("[\D]", "", $coup2[0]);
			// for ($i=1; $i<count($coup2); $i++)
			// {
			// élimine toutes les lettres
			// //echo"soustraction de ".$coup2[$i]."du total actual qui est".$result;
			// $result=$result-preg_replace("[\D]", "", $coup2[$i]);
			// }
		// //echo"résultat =".$result;	
		// $reponsebot=str_replace("<-compter(".$coup[0].")->", $result, $reponsebot);			
		// }			
		

}

//echo"<br>on teste si il faut pas inclure un script externe";	
$result = strpos($reponsebot, "<-inc(");
while($result!==false){
//reset des parametres eventuels
$incparam="";
	//on coupe jusqu'au <-inc( détecté avant
	$coup2[0]=substr($reponsebot,0,$result);
	// echo "<br>A garder:".$coup2[0];
	//on coupe depuis le )->+3 jusqu'à la fin
	$coup2[1]=substr($reponsebot,(strpos($reponsebot, ")->"))+3);
	// echo "<br>A garder a droite :".$coup2[1];
	//on coupe depuis le <-inc( détecté avant jusqu'à )-> moins ce qu'on a eu avant
	$coup[1]=substr($reponsebot,$result,(strpos($reponsebot, ")->"))-strlen($coup2[0]));
	// echo "<br>A utiliser:".$coup[1];
	//on garde à partir d'après <-inc( soit 6 char
	$coup[1]=substr($coup[1],6);
    // echo"<br>=>oui le script avec les parametres éventuels est ".$coup[1];
		if(strpos($coup[1], ",")!==false){
		
		
		$incparam=substr($coup[1],strpos($coup[1], ",")+1);	
		 // echo "<br>Il y a des parametres, qui sont ".$incparam;	
		$coup[1]=substr($coup[1],0,strpos($coup[1], ","));
		// echo "<br>Le script &agrave; appeller est donc ".$coup[1];
		}
	if (file_exists($coup[1])){
	$reponsebot=$coup2[0].$coup2[1];
	//le script s'execute et fait ce qu'il veut
	//avec reponsebot qu'on a prédécoupé gentiement
	//en $coup2[0] à gauche et $coup2[1] à droite.
	include ($coup[1]);
	$result = strpos($reponsebot, "<-inc(");}
	else{$reponsebot="(Erreur : ".$coup[1]." introuvable.) ".$reponsebot;
	$result =false;}
	//
	//on coupe depuis )->
	
	

}

//on vire les ignorer des noreut et ignorer

$reponsebot=str_replace("<-ignorer->", "", $reponsebot);

//echo"<br>on teste si il y a un mot à remplacer dans la réponse du robot";
	$lecturecorrectionbot = fopen("correctionbot.txt","r");
	while (!feof ($lecturecorrectionbot)) {
	$lignecorrectionbot= fgets($lecturecorrectionbot, 1024);
	//echo"<br>".$lignecorrectionbot;
		$result=strpos($lignecorrectionbot, "=");
		$coup[0]=substr($lignecorrectionbot,0,$result);
		$result=strpos($reponsebot, $coup[0]);
		//echo$result;
		if($result !== false){
		//on efface le debut de la ligne, jusqu'à jocker, et remplace avec le reste
		$lignecorrectionbot=str_replace($coup[0]."=", "", $lignecorrectionbot);	
		$lignecorrectionbot=str_replace("\n", "", $lignecorrectionbot);
		$lignecorrectionbot=str_replace("\r", "", $lignecorrectionbot);	
		//echo"=>trouvé. on remplace ".$coup[0]." par ".$lignecorrectionbot;
		$reponsebot=str_replace($coup[0], $lignecorrectionbot, $reponsebot);
		}
	}
}
else{
//si on a pas trouvé de phrase correspondante, on vide $reponsebot
$reponsebot="";
}


		
////echo"<hr>"	;
//echo "réponse complete =".$reponsebotcomplet;
$reponsebotcomplet=$reponsebotcomplet.$reponsebot;
}
 fclose($lecture); 
 //echo"liste des variables :".$_POST['var'];
//echo"<bR>la variable temporaire actuelle : ".$_POST['vartemp'];
//echo"<br>vraies vars :".$_POST['vraiesvars'];
//echo"rappels : ".$_POST['rappel'];
$logvisiteur = fopen("logs/".$_SERVER["REMOTE_ADDR"].".htm","a");
$coup=explode("=",$ligne);
	$temps_fin =array_sum(explode(' ', microtime())); 

fwrite($logvisiteur, "le ".date("d-m-Y")." - ".date("H:i:s")." ".$_SERVER['HTTP_USER_AGENT']."<br>Utilisateur : ".$majUsersay."<br> LymOS : ".$reponsebotcomplet."<br>(d&eacute;tect&eacute; ligne ".$numlignelog." : ".$coup[0]." ".$correction.")<br>".$_POST['vartemp']." ".round($temps_fin - $temps_debut, 4).'s'."<br><br>");
 fclose($logvisiteur); 

print "<br><br>Utilisateur : ".$majUsersay;
print "<br>LymOS : <span id=\"reponse_ia\">".$reponsebotcomplet."</span>";
//print "<br>LymOS : ". $reponsebotcomplet;
}
?>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">LymOS</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="../">Home</a></li>

			  <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Monitor<span class="caret"></span> &zwnj;<ul class="dropdown-menu">
  				<li><a tabindex="-1" href="../info_ls.php">LymOS</a></li>
  				<li><a tabindex="-1" href="../info">Server</a></li>
			    </ul></a></li>

              <li><a href="../login">Login</a></li>
              <li class="active"><a href="#">Talk</a></li>
              <li><a href="../error">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

<?php
print "<form method=\"POST\" action=\"index.php\" id=\"form_parler\">";
print "<bR><INPUT NAME=\"usersay\" autocomplete=\"off\" id=\"input\" size=60%\"><INPUT NAME=\"sauveinput\" id=\"sauveinput\" TYPE=\"HIDDEN\" ><INPUT NAME=\"var\" value=\"".$_POST['var']."\" id=\"var\" TYPE=\"HIDDEN\" ><INPUT NAME=\"vartemp\" value=\"".$_POST['vartemp']."\" id=\"vartemp\" TYPE=\"HIDDEN\" ><INPUT NAME=\"cerveau\" value=\"".$_POST['cerveau']."\" id=\"cerveau\" TYPE=\"HIDDEN\" ><INPUT NAME=\"vraiesvars\" value=\"".$_POST['vraiesvars']."\" id=\"vraiesvars\" TYPE=\"HIDDEN\" ><INPUT NAME=\"nom\" value=\"".$_POST['nom']."\" id=\"nom\" TYPE=\"HIDDEN\" ><INPUT NAME=\"noreut\" value=\"".$_POST['noreut']."\" id=\"noreut\" TYPE=\"HIDDEN\" ><INPUT NAME=\"vraiesvars\" value=\"".$_POST['vraiesvars']."\" id=\"vraiesvars\" TYPE=\"HIDDEN\" ><INPUT NAME=\"rappel\" value=\"".$_POST['rappel']."\" id=\"rappel\" TYPE=\"HIDDEN\" ><INPUT NAME=\"autorefresh\" id=\"autorefresh\" TYPE=\"HIDDEN\" value=\"FALSE\"><input type=submit  value=\"Parler\">";
echo"<title>LymOS</title>";
echo"<br><br>";
if (file_exists("AR.txt")) {
    echo"<br>Derni&egrave;re modification du core principal : " . date ("d/m/Y H:i:s.", filemtime("AR.txt"));
	echo"<br>Derni&egrave;re modification du systeme : " . date ("d/m/Y H:i:s.", filemtime("index.php"));
	echo"<br>Mail de l'administrateur : lymdun@protonmail.com";
	echo"<br><br>Toutes vos conversations sont enregistrées dans l'unique but d'analyse pour améliorer LymOS et ne sont pas utilisées à d'autres fins.";
}
?> 
</div>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.js"></script>