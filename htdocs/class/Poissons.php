<?php

class Poissons extends Animals {

    private $vagabonde;
    private $emettreSon;
    private $manger;
    private $faim;


    public function __construct(array $data) 
    {
        parent::__construct($data);
        if (isset($data['vagabonde'])){
            $this->setVagabonde($data['vagabonde']);
        }
        if (isset($data['emettreSon'])){
            $this->setEmettreSon($data['emettreSon']);
        }
        if (isset($data['manger'])){
            $this->setManger($data['manger']);
        }
        $this->faim = 100 ;
    }




    public function getVagabonde(): bool {
        return $this->vagabonde;
    }

    public function setVagabonde(bool $vagabonde): void {
        $this->vagabonde = $vagabonde;
    }

    public function getFaim() : int {
        return $this->faim;
    }
    public function setFaim($faim){
        $this->faim = $faim;
    } 



    public function getEmettreSon() {
        return $this->emettreSon;
    }

    public function setEmettreSon( $emettreSon) {
        $this->emettreSon = $emettreSon;
    }

    public function getManger() {
        return $this->manger;
    }

    public function setManger($manger) {
        $this->manger = $manger;
    }




    public function vagabonder() {
        echo "{$this->getName()} fait des ronds dans son bocal carré.";
    }

    public function emettreSon() {
        echo "{$this->getName()} bulle.";
    }


    public function manger() {
        echo "{$this->getName()} mange du plancton.";
    }

    public function dormir() {
        echo "{$this->getName()} ronfle comme une baleine.";
    }

    public function etat(){
        parent::etat();
        echo "<br>";
        $this->emettreSon();
        echo "<br>";
        $this->vagabonder();
        echo "<br>";
        $this->manger();
        echo "<br>";
        $this->dormir();
    }

    public function afficherImage() {
        return "./images/poisson.jpeg";
    }




    public function afficherBarreEnergie() {
        $barre = '';
        $energie = $this->getFaim();
        for ($i = 0; $i < 10; $i++) {
            if ($energie >= 10) {
                $barre .= '<span style="color:green">█</span>'; 
            } else if ($energie >= 5) {
                $barre .= '<span style="color:orange">█</span>'; 
            } else {
                $barre .= '<span style="color:red">█</span>'; 
            }
            $energie -= 10;
        }
        echo " {$barre}\n";
    }
    
    function nourrirAnimal($animal) {
        $animal->augmenterEnergie(10);
      }
    
}


?>