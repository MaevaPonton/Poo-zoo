<?php

class Employees {

    private $pseudo;
    private $gender;
    private $age;
    private $id;
    private $zoo_id;
    private $employee_id;
    private $enclosure_id;


    public function __construct(array $data)
    {
        if (isset($data['pseudo'])){
            $this->setPseudo($data['pseudo']);
        }
        if (isset($data['id'])){
            $this->setId($data['id']);
        }
        if (isset($data['gender'])){
            $this->setGender($data['gender']);
        }
        if (isset($data['age'])){
            $this->setAge($data['age']);
        }
        if (isset($data['zoo_id'])){
            $this->setZooId($data['zoo_id']);
        }
       
     
    }


    // GETER et SETER id 
                public function setId($id)
                {
                    $this->id = $id;
                }

                public function getId()
                {
                    return $this->id;
                }

    // GETER et SETER zoo_id 
                public function setZooId($zoo_id)
                {
                    $this->zoo_id = $zoo_id;
                }

                public function getZooId()
                {
                    return $this->zoo_id;
                }

  

    // GETER et SETER pseudo 
                public function setPseudo($pseudo)
                {
                    $this->pseudo = $pseudo;
                }
            
                public function getPseudo()
                {
                    return $this->pseudo;
                }


    // GETER et SETER gender 
                public function setGender($gender)
                {
                    $this->gender = $gender;
                }

                public function getGender()
                {
                    return $this->gender;
                }

    // GETER et SETER age 
                public function setAge($age)
                {
                    $this->age = $age;
                }
            
                public function getAge()
                {
                    return $this->age;
                }
    

public function examinerEnclos($enclos) {
        $animaux = $enclos->getAnimaux();
        $nomEnclos = $enclos->getName();
        $typeEnclos = $enclos->getType();
        echo "Enclos $nomEnclos ($typeEnclos)";
        foreach($animaux as $animal) {
            $animal->etat();
        }
}
                

public function nettoyerEnclos($enclos) {
        if($enclos->estSale() && $enclos->estVide()) {
            $enclos->nettoyer();
            echo "Enclos nettoyé avec succès !\n";
        } else {
            echo "Impossible de nettoyer l'enclos.\n";
        }
}
                

public function nourrirAnimaux($enclos) {
        if (!$enclos->dorment()) {
            $enclos->nourrirAnimaux();
            echo "Les animaux ont été nourris.\n";
        } else {
            echo "Les animaux dorment, impossible de les nourrir.\n";
        }
}
                

public function ajouterAnimal($animal, $enclos) {
        if ($enclos->ajouterAnimal($animal)) {
            echo "L'animal a été ajouté à l'enclos.\n";
        } else {
            echo "Impossible d'ajouter l'animal à l'enclos.\n";
        }
}

                
public function leverAnimal($animal, $enclos) {
        if ($enclos->leverAnimal($animal)) {
            echo "L'animal a été levé de l'enclos.\n";
        } else {
            echo "Impossible de lever l'animal de l'enclos.\n";
        }
}


public function transfererAnimal($animal, $enclosDepart, $enclosArrivee) {
        if ($enclosDepart->leverAnimal($animal) && $enclosArrivee->ajouterAnimal($animal)) {
            echo "L'animal a été transféré avec succès.\n";
        } else {
            echo "Impossible de transférer l'animal.\n";
        }
}
            
    
}
        
            
            
            
            
            