<?php

//Ce script ouvre google news, récupère les gros titres et les affiche là
//où le script a été appelé dans le cerveau.
//Toutes les variables du cerveau sont accessibles ici.

//var pour stocker la portion de page lue
$lignewebpage="";
//var pour stocker l'adresse du lien de la new
$adressewebpage="";

//ouvre le rss google news
$webpage=fopen("http://news.google.fr/news?pz=1&cf=all&ned=fr&hl=fr&output=rss", "r");

//variable pour savoir quel numero de news prendre
if ($incparam==""){$incparam=0;}

while ( ! feof($webpage) &&  $lignewebpage!="on degage"){
//lit et stocke dans $lignewebpage
$lignewebpage=fgets($webpage, 2048 );
// echo $lignewebpage."<hr>";

//si on trouve title
    if (strpos($lignewebpage, '<item><title>')!==false){
		//si le numero de news est inférieur à 1, on prend cette news
		
		if ($incparam<1){
		//on découpe la portion stockée pour choper titre et adresse
		$coup=explode('<item><title>', $lignewebpage);
		$coup=explode('<link>', $coup[1]);
		$coup=explode('</link>', $coup[1]);
		$adressewebpage=$coup[0];
		$coup=explode('<item><title>', $lignewebpage);
		$lignewebpage=$coup[1];
		$coup=explode('</title>', $lignewebpage);
		$lignewebpage=$coup[0];
		
		//on transforme la réponse du bot
		$reponsebot=$coup2[0].'<a target="_blank" href="'.$adressewebpage.'">'.$lignewebpage.'</a>'.$coup2[1];
		
		$lignewebpage="on degage";
		}
		else{
		//sinon on baisse le numero et on continue 
		$incparam=$incparam-1;
		}
	}	
}


?>