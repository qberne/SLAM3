<?php

require_once 'myPDO.class.php';

class connexion {    
    private $PARAM_hote='192.168.152.2';
    private $PARAM_utilisateur='bd_slam3_tennis';
    private $PARAM_mot_passe='Azerty123';
    private $PARAM_nom_bd='bd_slam3_tennis'; //nom de la base de données
    private $IDconnexion;

    public function __construct() {
        try {
            $this->IDconnexion = new MyPDO('mysql:host='.$this->PARAM_hote.';dbname='.
            $this->PARAM_nom_bd, $this->PARAM_utilisateur, $this->PARAM_mot_passe);
            //Il faut ajouter pour gerer les accents et caractères non utf8
            $this->IDconnexion->exec("SET NAMES 'utf8'");
        }
        catch (PDOException $e) {
            echo 'hote: '.$this->PARAM_hote.' '.$_SERVER['DOCUMENT_ROOT'].'<br />';
            echo 'Erreur : '.$e->getMessage().'<br />';
            echo 'N° : '.$e->getCode();
            $this->IDconnexion=false;
            echo '<script>alert ("ERREUR lien BDD");</script>';
        }        
    }
    public function __get($propriete) {
        switch ($propriete) {
            case 'IDconnexion' :
            {
                return $this->IDconnexion;
                break;
            }
        }
    }
}