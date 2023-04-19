<?php

class Zoo

{
    private $name;
    private $id;
    
    


    public function __construct(array $data)
    {
        if (isset($data['name'])){
            $this->setName($data['name']);
        }
        if (isset($data['id'])){
            $this->setId($data['id']);
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


// GETER et SETER name 
     public function setName($name)
     {
         $this->name = $name;
     }
 
     public function getName()
     {
         return $this->name;
     }

 
  

    
   /*  public function setEnclosure(Enclosures $enclosure)
    {
        $this->enclosures[] = $enclosure;
    }
    
    public function getEnclosures()
    {
        return $this->enclosures;
    }
    
    public function setEmployee(Employees $employee)
    {
        $this->employee = $employee;
    }
    
    public function getEmployee()
    {
        return $this->employee;
    }
    
    public function feedAllAnimals()
    {
        foreach ($this->enclosures as $enclosure) {
            $enclosure->feedAnimals();
        }
    } */
    
/* 
    public function transferAnimal(Animals $animal, Enclosures $enclosure)
    {
        $sourceEnclosure = $this->findEnclosure($animal);
        if ($sourceEnclosure === null) {
            throw new Exception('Animal not found in any enclosure');
        }
        $sourceEnclosure->removeAnimal($animal);
        $enclosure->addAnimal($animal);
    }
    
    public function cleanAllEnclosures()
    {
        foreach ($this->enclosures as $enclosure) {
            $enclosure->cleanEnclosure();
        }
    }
    
    private function findEnclosure(Animals $animal)
    {
        foreach ($this->enclosures as $enclosure) {
            if ($enclosure->containsAnimal($animal)) {
                return $enclosure;
            }
        }
        return null;
    } */
}

?>
