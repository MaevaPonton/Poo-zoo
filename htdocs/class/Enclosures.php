<?php

class Enclosures {
    private $id;
    private $zoo_id;
    private $employee_id;
    private $name;
    private $cleanliness;
    private $type;
    private $animals = array();


     // constructeur qui reprend les colonnes de la base de données sous forme d'un tableau data :
        public function __construct(array $data) 
        {

            if (isset($data['name'])){
                $this->setName($data['name']);
            }
            if (isset($data['cleanliness'])){
                $this->setCleanliness($data['cleanliness']);
            }
            if (isset($data['animals'])){
                $this->setAnimals($data['animals']);
            }
            if (isset($data['id'])){
                $this->setId($data['id']);
            }
            if (isset($data['zoo_id'])){
                $this->setZooId($data['zoo_id']);
            }
            if (isset($data['type'])){
                $this->setType($data['type']);
            }
            if (isset($data['employee_id'])){
                $this->setEmployeeId($data['employee_id']);
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


    // GETER et SETER employee_id 
                public function setEmployeeId($employee_id)
                {
                    $this->employee_id = $employee_id;
                }

                public function getEmployeeId()
                {
                    return $this->employee_id;
                }

                
    // GETER et SETER name 
                public function setName($name)
                {
                    $this->name = $name;
                }
            
                public function getName()
                {
                    return $this->name;
                }


                
    // GETER et SETER type 
      public function setType($type)
      {
          $this->type = $type;
      }

      public function getType()
      {
          return $this->type;
      }



    // GETER et SETER cleanliness 
                public function setCleanliness($cleanliness)
                {
                    $this->cleanliness = $cleanliness;
                }

                public function getCleanliness()
                {
                    return $this->cleanliness;
                }

    // GETER et SETER animals 
                public function setAnimals($animals)
                {
                    $this->animals = $animals;
                }
            
                public function getAnimals()
                {
                    return $this->animals;
                }


    




public function afficherCaracteristiques() {
    echo "Nom de l'enclos : " . $this->name . "<br>";
    echo "Type de l'enclos : " . $this->type . "<br>";
    echo "Propreté de l'enclos : " . $this->cleanliness . "<br>";
    echo "Animaux dans l'enclos : " . $this->animals . "<br>";
}


// ajouter un animal dans l'enclos :
public function addAnimal($animal) {
    if (count($this->animals) < 6) {
        array_push($this->animals, $animal);
        echo "{$animal->getName()} a bien été ajouté à votre enclos.";
    } else {
        echo "L'enclos est complet.";
    }
}

// supprimer un animal de l'enclos :
public function removeAnimal($animal) {
    $index = array_search($animal, $this->animals);
    if ($index !== false) {
        array_splice($this->animals, $index, 1);
        echo "{$animal->getName()} a bien été retiré de votre enclos.";
    } else {
        echo "{$animal->getName()} ne se trouve pas dans l'enclos.";
    }
}

}
            
         
     
            
            
            
            
    