<?php

function listing($repertoire){

$fichier = array();

if (is_dir($repertoire)){

$dir = opendir($repertoire); //ouvre le repertoire courant désigné par la variable
while(false!==($file = readdir($dir))){ //on lit tout et on récupere tout les fichiers dans $file

if(!in_array($file, array('.','..'))){ //on eleve le parent et le courant '. et ..'
$page = $file; //sort l'extension du fichier
$page = explode('.', $page);
//$page = date("AAAAMMJJ").$page;
$nb = count($page);
$nom_fichier = $page[0];
for ($i = 1; $i < $nb-1; $i++){
$nom_fichier .= '.'.$page[$i];
}
if(isset($page[1])){
$ext_fichier = $page[$nb-1];
if(!is_file($file)) { $file = '/'.$file; }
}
else {
if(!is_file($file)) { $file = '/'.$file; } //on rajoute un "/" devant les dossier pour qu'ils soient triés au début
$ext_fichier = '';
}

if($ext_fichier != 'php' and $ext_fichier != 'html') { //utile pour exclure certains types de fichiers à ne pas lister
array_push($fichier, $file);
}
}
}
}

$nb = count($fichier); //ajout perso : ajoute la date au fichier
for ($i = 0; $i < $nb; $i++){
$fichier[$i]= "(".date ("y.m.d.H.i.s", filemtime($fichier[$i])).")".$fichier[$i];
}

//natcasersort($fichier); //la fonction natcasesort( ) est la fonction de tri standard sauf qu'elle ignore la casse
rsort($fichier); //ajout perso:changé par rsort pour sort à l'envers et fonction moins lourde

$nb = count($fichier); //ajout perso : on vire la date des fichiers maintenant qu'ils sont classés
for ($i = 0; $i < $nb; $i++){
$coup=explode(')', $fichier[$i]);
$fichier[$i]=$coup[1];
}

foreach($fichier as $value) {
echo '<a href="'.rawurlencode($repertoire).'/'.rawurlencode(str_replace ('/', '', $value)).'">'.$value.'</a><br />';
}
} 
 //exemple d'utilisation :

listing('.'); //chemin du dossier


#?>