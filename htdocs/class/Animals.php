<?php

abstract class Animals {

    private $name;
    private $weight;
    private $size;
    private $age;
    private $id;
    private $species;
    private $faim;
    private $sommeil;
    private $malade;
    private $enclosure_id;
    private $zoo_id;
    private $employee_id;
    
    public function pretyDump($data){
        highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
      }

    // constructeur qui reprend les colonnes de la base de données sous forme d'un tableau data :
            public function __construct(array $data) 
            {
                
                if (isset($data['name'])){
                    $this->setName($data['name']);
                }
                if (isset($data['species'])){
                    $this->setSpecies($data['species']);
                }
                if (isset($data['weight'])){
                    $this->setWeight($data['weight']);
                }
                if (isset($data['id'])){
                    $this->setId($data['id']);
                }
                if (isset($data['size'])){
                    $this->setSize($data['size']);
                }
                if (isset($data['age'])){
                    $this->setAge($data['age']);
                }
                if (isset($data['enclosure'])){
                    $this->setEnclosureId($data['enclosure']);
                }
                if (isset($data['faim'])){
                    $this->setFaim($data['faim']);
                }
                if (isset($data['sommeil'])){
                    $this->setSommeil($data['sommeil']);
                }
                if (isset($data['malade'])){
                    $this->setMalade($data['malade']);
                }
                if (isset($data['zoo_id'])){
                    $this->setZooId($data['zoo_id']);
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

// GETER et SETER enclosure_id 
            public function setEnclosureId($enclosure_id)
            {
                $this->enclosure_id = $enclosure_id;
            }

            public function getEnclosureId()
            {
                return $this->enclosure_id;
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



    // GETER et SETER species 
            public function setSpecies($species)
            {
                $this->species = $species;
            }

            public function getSpecies()
            {
                return $this->species;
            }


            
    // GETER et SETER weight 
            public function setWeight($weight)
            {
                $this->weight = $weight;
            }

            public function getWeight()
            {
                return $this->weight;
            }


    // GETER et SETER size 
            public function setSize($size)
            {
                $this->size = $size;
            }

            public function getSize()
            {
                return $this->size;
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

// GETER et SETER faim 
            public function setFaim($faim)
            {
                $this->faim = $faim;
            }

            public function getFaim()
            {
                return $this->faim;
            }

// GETER et SETER sommeil 
            public function setSommeil($sommeil)
            {
                $this->sommeil = $sommeil;
            }

            public function getSommeil()
            {
                return $this->sommeil;
            }

    // GETER et SETER malade 
            public function setMalade($malade)
            {
                $this->malade = $malade;
            }

            public function getMalade()
            {
                return $this->malade;
            }
    
   
            



// Fonction manger() :
   public function manger()
   {
    echo "{$this->getName()} mange.\n";
   } 

// Fonction malade() :
public function malade()
{
    echo "{$this->getName()} est en bonne santé.\n";
} 



// Fonction etreSoigner() :
   public function etreSoigne()
   {
        echo "L'animal est soigné.</br>";
        $this -> malade = false;

   }



// Fonction dormir() :
     public function dormir()
     {
        echo " L'animal dort.</br>";
        $this -> sommeil = true;
  
     }


// Fonction se réveiller() :
   public function seReveiller()
   {
        echo " L'animal se réveille.</br>";
        $this -> sommeil = false;      
   } 
    
// Fonction etat : 
   public function etat()
   {
       echo "Espèce : " . $this-> species . "<br> Age : " . $this->age . " ans <br> Taille : " . $this->size . "m <br> Poids : " . $this->weight . "kg<br>";
       
       if ($this->faim) {
           echo "<br>".$this -> name." a faim.";
       } else {
        echo "<br>".$this -> name." n'a pas faim.";
       }
       
       if ($this->malade) {
        echo "<br>".$this -> name." est malade.";
       } else {
        echo "<br>".$this -> name." n'est pas malade.";
       }
       
       
   }


   
   
}