<?php 

class Personnage{
    // ATRIBUTS
    private $_force = 40;
    private $_classe = "Plombier";
    private $_couleurCasquette = "Rouge";
    private $_vie = 100;
    private $_nom = "Unknown";
    // private $_degats = 0;

    // CONSTRUCTEUR
    public function __construct($nom, $force, $couleur){
        // "this" personnage de la classe
        $this->_nom = $nom;  
        $this->setForce($force);  
        $this->setCouleurCasquette($couleur);
    }

    // METHODES (simple function)
    public function getForce() {
        return $this->_force;
    }
    public function setForce($force) {
        $this->_force = $force;
    }
    public function getCouleurCasquette() {
        return $this->_couleurCasquette;
    }
    public function setCouleurCasquette($couleur) {
        $this->_couleurCasquette = $couleur;
    }
    public function getClasse() {
        return $this->_classe;
    }
    public function getInfo() {
        return "<p>".$this->_nom." à une force de ".$this->_force." est de classe ".$this->_classe." et a une casquette de couleur ".$this->_couleurCasquette.".</p>";
    }
    public function frapper(Personnage $personnage) {
        return $personnage->recevoirDegats($this->_force);
    }
    public function recevoirDegats($force) {
        $this->_vie =  $this->_vie - $force;

        if ($this->_vie <= 0) {
            echo "<p>".$this->_nom." a perdu ".$force." points de vie. Il vient de succonber à ses blessures.</p>";
        } else{
           echo "<p>".$this->_nom." a perdu ".$force." points de vie. Il lui reste ".$this->_vie." points.</p>"; 
        }
    }
}

$mario = new Personnage("Mario", 45, "Rouge");
$luigi = new Personnage("Luigi" , 40, "Verte");

// echo $mario->getForce();

// $mario->setForce(10);

// echo $mario->getForce();
// echo $mario->getClasse();

// echo "Mario à une force de : ".$mario->getForce()."<br>"."Il est de la classe : ".$mario->getClasse()."<br>"."Et à une couleur de casquette : ".$mario->getCouleurClasse()."<br>";

echo $mario->getInfo();
echo $luigi->getInfo();
$mario->frapper($luigi);
$luigi->frapper($mario);
$mario->frapper($luigi);
$luigi->frapper($mario);
$mario->frapper($luigi);
?>
