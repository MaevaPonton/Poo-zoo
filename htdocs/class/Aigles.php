<?php

class Aigles extends Animals {

    private $vagabonde;
    private $emettreSon;
    private $manger;
    private $faim;
    private $dormir;


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
        if (isset($data['dormir'])){
            $this->setDormir($data['dormir']);
        }
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

    public function getDormir() {
        return $this->dormir;
    }

    public function setDormir($dormir) {
        $this->dormir = $dormir;
    }





    public function vagabonder() {
        echo "{$this->getName()} survole le zoo.";
    }

    public function emettreSon(): void {
        echo "{$this->getName()} glatit.";
    }


    public function manger() {
        echo "{$this->getName()} mange des petits rongeurs.";
    }

    public function dormir() {
        echo "{$this->getName()} aimerait bien dormir.";
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
        return "./images/aigle.png";
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