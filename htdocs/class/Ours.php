<?php

class Ours extends Animals {

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



    public function getVagabonde(){
        return $this->vagabonde;
    }
    public function setVagabonde($vagabonde){
        $this->vagabonde = $vagabonde;
    }

    public function getFaim()  {
        return $this->faim;
    }
    public function setFaim($faim){
        $this->faim = $faim;
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




    public function vagabonder()  {
        echo "{$this->getName()} se promène dans son bois.";
    }

    public function emettreSon() {
        echo "{$this->getName()} grogne.";
    }

    public function manger() {
        echo "{$this->getName()} mange des végétaux.";
    }

    public function dormir() {
        echo "{$this->getName()} a une insomnie.";
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
        return "./images/ours.jpeg";
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
    
    public function nourrirAnimal() {
        echo "<script>alert('Bravo ! Tu as donné à manger à ton animal');</script>";
      }
    }
   


?>