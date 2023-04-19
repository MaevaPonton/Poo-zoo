<?php


class AnimalsManager { 

// Création d'une propriété privée $db qui est une instance de PDO
    private $pdo;


    // on passe la connection PDO à la base de données
    public function __construct(PDO $pdo)
    {
        $this->setPdo ($pdo);
    }

    public function setPdo ($pdo)
    {
        $this -> pdo = $pdo;
    }

    public function pretyDump($data){
      highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
    }



    public function add(Animals $animal) // Fonction pour ajouter les nouveaux animaux en base de données :
    {
        $max_animals = 6; 
        $name = $animal->getName();
        $species = $animal->getSpecies();
        $size = $animal->getSize();
        $weight = $animal->getWeight();
        $age = $animal->getAge();
        $enclosure_id = $animal->getEnclosureId();
        $zoo_id = $animal->getZooId();
        $employee_id = $animal->getEmployeeId();

        $count = $this->pdo->query("SELECT COUNT(*) FROM Animals WHERE enclosure_id = $enclosure_id AND zoo_id = $zoo_id")->fetchColumn();

        if ($count >= $max_animals) {
          echo "<script>alert('Le nombre maximum d\'animaux est atteint.');</script>";
          echo "<script>window.history.back();</script>";
          exit(); 
        } 
        
        $requete = $this->pdo->prepare("INSERT INTO Animals (name, species, size, weight, age, enclosure_id, zoo_id, employee_id) VALUES (:name, :species, :size, :weight, :age, :enclosure_id,:zoo_id,:employee_id)");
        $requete->bindParam(':name', $name);
        $requete->bindParam(':species', $species);
        $requete->bindParam(':size', $size);
        $requete->bindParam(':weight', $weight);
        $requete->bindParam(':age', $age);
        $requete->bindParam(':enclosure_id', $enclosure_id);
        $requete->bindParam(':zoo_id', $zoo_id);
        $requete->bindParam(':employee_id', $employee_id);
        $requete->execute();

        $animal->setId($this->pdo->lastInsertId());
    }



    public function findAllAnimalsByEnclosureId($data) {
      $query = "SELECT * FROM Animals WHERE enclosure_id = :enclosure_id";
      $request = $this->pdo->prepare($query);
      $request->execute(['enclosure_id' => $data]);
      $results = $request->fetchAll(PDO::FETCH_ASSOC);
      $animals = [];
    
      foreach($results as $result) {

        switch($result['species']) {
          case 'Aigle':
            $animal = new Aigles($result);
            break;
          case 'Ours':
            $animal = new Ours($result);
            break;
          case 'Poisson':
            $animal = new Poissons($result);
            break;
          case 'Tigre':
            $animal = new Tigres($result);
            break;
        }
        array_push($animals, $animal);
      }
    
      return $animals;
    }

 
    
    public function getAnimalById($animal_id) 
    {
        $request = $this->pdo->prepare('SELECT * FROM Animals WHERE id = :id');
        $request->bindValue(':id', $animal_id, PDO::PARAM_INT);
        $request->execute();
        $resultat = $request->fetch(PDO::FETCH_ASSOC);

        if (!$resultat) {
            return null; // Animal non trouvé
        }
        $data = [
                    'id' => $resultat['id'],
                    'name' => $resultat['name'],
                    'species' => $resultat['species'],
                    'size' => $resultat ['size'],
                    'weight' => $resultat ['weight'],
                    'age' => $resultat ['age'],
                    'enclosure_id' => $resultat ['enclosure_id'],
                    'zoo_id' => $resultat ['zoo_id'],
                    'employee_id' => $resultat ['employee_id'],
                    'faim' => $resultat ['faim']
        ];
      switch($data['species']) {
        case 'Aigle':
          $animal = new Aigles($data);
          break;
        case 'Ours':
          $animal = new Ours($data);
          break;
        case 'Poisson':
          $animal = new Poissons($data);
          break;
        case 'Tigre':
          $animal = new Tigres($data);
          break;
      }

        return $animal; 
    } 


    public function delete($id) {
      $query = "DELETE FROM Animals WHERE id = :id";
      $request = $this->pdo->prepare($query);
      $request->bindParam(':id', $id, PDO::PARAM_INT);
      return $request->execute();
  }

    public function nourrirAnimal(Animals $animal)
    {
        $query = $this->pdo->prepare('UPDATE Animals SET faim = 100 WHERE id = :id');
        $query->bindParam(':faim', $animal->getFaim(), PDO::PARAM_INT);
        $query->execute();
    }

    public function countAnimalsInEnclosure($enclosure_id)
    {
        $request = $this->pdo->prepare('SELECT COUNT(*) FROM Animals WHERE enclosure_id = :enclosure_id');
        $request->bindValue(':enclosure_id', $enclosure_id, PDO::PARAM_INT);
        $request->execute();
        $result = $request->fetch(PDO::FETCH_COLUMN);
        return $result;
    }

    public function diminuerFaim()
    {
        $stmt = $this->pdo->prepare('UPDATE animal SET faim = faim - 1 WHERE faim > 0');
        $stmt->execute();
    }



}
