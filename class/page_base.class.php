<?php
class page_base {
	
	private $style=array('styles', 'wickedpicker');
	private $script=array('TP2Ex2', 'datepicker-fr', 'jquery.validate.min', 'wickedpicker');
	private $titre;
	private $corps;
	
	public function __construct($t){
		$this->titre = $t;
	}

	
	public function __set($propriete, $valeur){
		switch ($propriete){
			case 'style':{
				$this->style[count($this->style)] = $valeur;
		break;
			}
			case 'script':{
				$this->script[count($this->script)] = $valeur;
		break;
			}
			case 'titre':{
				$this->titre = $valeur;
				break;
			}
			case 'corps':{
				$this->corps = $valeur;
				break;
			}
		}
	}

public function __get($propriete){
		switch ($propriete){
			case 'corps':{
				return $this->corps ;
				break;
			}
			default:
			{
				echo 'Accès Impossible à '.$propriete.' : elle est en private dans la class' ;
				break;
			}
		}
	}
	
	
	/******************************Gestion des styles **********************************************/
	/* Insertion des feuilles de style */
	private function affiche_style(){
		echo "	<link href ='http://fonts.googleapis.com/css?family=Archivo+Narrow:400|Overlock+SC' rel='stylesheet' type ='text/css'/>\n";
		foreach ($this->style as $s){
			echo "<link rel='stylesheet' type='text/css' href='../css/".$s.".css'/>\n";                        
		}
                echo "<link rel='stylesheet' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css' type='text/css' media='all' />\n";
                echo "<link rel='stylesheet' href='http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css' type='text/css' media='all' /\n>";
	}
	/******************************Gestion des scripts **********************************************/
	/* Insertion des script JAVASCRIPT */
	private function affiche_script() {
                echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js' type='text/javascript'></script>\n";
                echo "<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js' type='text/javascript'></script>\n";
		foreach ($this->script as $s) {
			echo "<script type='text/javascript' src='../js/".$s.".js'></script>\n";
                }
	}
	/******************************Gestion de l'entete **********************************************/
	private function affiche_entete() {
		echo '<header>BTS S.I.O (Services Informatiques aux Organisations)</header>';
		echo '<h1>
					<span>TP2 JavaScript Exercice 1</span>
				</h1>
				<p class="sous-titre">
				<strong>TP2 Exercice 1 : exemple de soumission d’un formulaire</strong>
				</p>
				';
		}
	/******************************Gestion de l'entete **********************************************/
	private function affiche_pied_page() {
		echo '';
		}
	
	/******************************Gestion de l'affichage global **********************************************/
	public function afficher(){
	?>
	<!DOCTYPE html>
	<html lang='fr'>
	<head>
	<title> <?php echo $this->titre;?> </title>
	<meta charset="UTF-8" />
	<meta name="keywords" lang="fr" content="BTS,SIO,javascript, formulaire" />
	<meta name="description" content="Valider un formulaire en javascript" />
	<?php $this->affiche_style();?>
	<?php $this->affiche_script();?>
    </head>
    <body>
	
    <section id="global">
	<div id="entete"><?php $this->affiche_entete();?></div>
	<div id="centre">
		<div id="navigation">
					
		</div>
		<div id="contenu">
			<?php echo $this->corps;?>
			<?php $this->affiche_pied_page();?>
		</div>
		
	</div>
</section>
</body>
</html>
	<?php 
	}
}