<?php

class EnclosuresManager {

    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->setPdo($pdo);
    }

    public function setPdo($pdo)
    {
        $this->pdo = $pdo;
    }

    public function pretyDump($data){
      highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
    }

    public function add(Enclosures $enclosure)
    {
        
        $name = $enclosure->getName();
        $type = $enclosure->getType();
        $zoo_id = $enclosure->getZooId();
        $employee_id = $enclosure->getEmployeeId();

        $request = $this->pdo->prepare("INSERT INTO Enclosures (name, type, zoo_id, employee_id) VALUES (:name, :type,:zoo_id, :employee_id)");
        $request->bindParam(':name', $name);
        $request->bindParam(':type', $type);
        $request->bindParam(':zoo_id', $zoo_id);
        $request->bindParam(':employee_id', $employee_id);
        $request->execute();
        $enclosure->setId($this->pdo->lastInsertId());
    }


    public function getEnclosureById($enclosure_id)
    {
        $request = $this->pdo->prepare('SELECT * FROM Enclosures WHERE id = :id');
        $request->bindValue(':id', $enclosure_id, PDO::PARAM_INT);
        $request->execute();
        $resultat = $request->fetch(PDO::FETCH_ASSOC);

        if (!$resultat) {
            return null; // Enclos non trouvé
        }

        $enclosure = new Enclosures([
            'id' => $resultat['id'],
            'zoo_id' => $resultat['zoo_id'],
            'employee_id' => $resultat['employee_id'],
            'name' => $resultat['name'],
            'type' => $resultat['type'],
            'cleanliness' => $resultat['cleanliness'],
        ]);
        return $enclosure;
    }


    public function getAllEnclosures()
    {
        $request = $this->pdo->query('SELECT * FROM Enclosures');
        $enclosures = array();
        foreach ($request->fetchAll(PDO::FETCH_ASSOC) as $data) {
            $enclosure = new Enclosures($data);
            $enclosure->setId($data['id']);
            $enclosures[] = $enclosure;
        }
        
        return $enclosures;
    }


    public function update($data) {
      $query = "UPDATE Enclosures SET zoo_id = :zoo_id, employee_id = :employee_id, name = :name, type = :type, cleanliness = :cleanliness WHERE id = :id";
      $request = $this->pdo->prepare($query);
      $request->bindParam(':zoo_id', $data['zoo_id'], PDO::PARAM_INT);
      $request->bindParam(':employee_id', $data['employee_id'], PDO::PARAM_INT);
      $request->bindParam(':name', $data['name'], PDO::PARAM_STR);
      $request->bindParam(':type', $data['type'], PDO::PARAM_STR);
      $request->bindParam(':cleanliness', $data['cleanliness'], PDO::PARAM_INT);
      $request->bindParam(':id', $data['id'], PDO::PARAM_INT);
      return $request->execute();
  }

  

    public function delete($id) {
      $query = "DELETE FROM Enclosures WHERE id = :id";
      $request = $this->pdo->prepare($query);
      $request->bindParam(':id', $id, PDO::PARAM_INT);
      return $request->execute();
  }


  
    public function findAllEnclosuresByEmployeId($data) {
        $query = "SELECT * FROM Enclosures WHERE employee_id = :employee_id";
        $request = $this->pdo->prepare($query);
        $request->execute(['employee_id' => $data]);
        $results = $request->fetchAll(PDO::FETCH_ASSOC);
        $enclosures = [];
      
        foreach($results as $result) {
          switch($result['type']) {
            case 'Parc':
              $enclosure = new Parc($result);
              break;
            case 'Bois':
              $enclosure = new Bois($result);
              break;
            case 'Volière':
              $enclosure = new Volière($result);
              break;
            case 'Aquarium':
              $enclosure = new Aquarium($result);
              break;
          }
          array_push($enclosures, $enclosure);
        }
      
        return $enclosures;
      }
      

    public function find($id)
    {
        $request = $this->pdo->prepare('SELECT * FROM Enclosures WHERE id = :id');
        $request->bindValue(':id', $id, PDO::PARAM_INT);
        $request->execute();
        $resultat = $request->fetch(PDO::FETCH_ASSOC);

        if (!$resultat) {
            return null;
        }

        $enclosure = new Enclosures([
            'id' => $resultat['id'],
            'name' => $resultat['name'],
            'type' => $resultat['type'],
            'cleanliness' => $resultat ['cleanliness'],
            'employee_id' => $resultat ['id_employee']
        ]);
        return $enclosure;
    }


    public function countAnimalsInEnclosure($enclosure_id)
    {
        $request = $this->pdo->prepare('SELECT COUNT(*) FROM Animals WHERE enclosure_id = :enclosure_id');
        $request->bindValue(':enclosure_id', $enclosure_id, PDO::PARAM_INT);
        $request->execute();
        $result = $request->fetch(PDO::FETCH_COLUMN);
        return $result;
    }



}