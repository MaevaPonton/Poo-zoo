<?php

class Tigres extends Animals {


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
    public function setFaim($nouvelleEnergie){
        $this->faim = $nouvelleEnergie;
    } 


    public function getEmettreSon() {
        return $this->emettreSon;
    }

    public function setEmettreSon( $emettreSon): void {
        $this->emettreSon = $emettreSon;
    }

    public function getManger(): bool {
        return $this->manger;
    }

    public function setManger($manger): void {
        $this->manger = $manger;
    }




    public function vagabonder() {
        echo "{$this->getName()} ronfle au soleil.\n";
    }

    public function emettreSon() {
        echo "{$this->getName()} rugit.\n";
    }



    public function manger() {
        echo "{$this->getName()} mange de la viande crue.\n";
    }

    public function dormir() {
        echo "{$this->getName()} dort, Chuuuuuut !";
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
        return "./images/tigre.jpeg";
    }

    
    public function afficherImage2() {
        return "./images/tigreanime.gif";
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