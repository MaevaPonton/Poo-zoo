<?php


class ZooManager
{
// Création d'une propriété privée $pdo qui est une instance de PDO
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


    public function addZoo(Zoo $zoo)
    {
        $name = $zoo->getName();
     
        // Vérifier si le zoo existe déjà dans la base de données : 
        $query = $this->pdo->prepare("SELECT COUNT(*) AS count FROM Zoo WHERE name = :name");
        $query->bindParam(':name', $name);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
    
        if ($data['count'] > 0) {
            echo "<div class = 'ZooExist'>Zoo déjà crée, sélectionne-le en dessous !</div>";
            return;
        } 
        $requete = $this ->pdo->prepare("INSERT INTO Zoo (name) VALUES (:name)");
        $requete->bindParam(':name', $name);
        $requete->execute();
        $zoo->setId($this->pdo->lastInsertId());
    }



    public function getAllZoos()
    {
        $request = $this->pdo->query('SELECT * FROM Zoo');
        $zoos = array();
        foreach ($request->fetchAll(PDO::FETCH_ASSOC) as $data) {
            $zoo = new Zoo($data);
            $zoo->setId($data['id']);
            $zoos[] = $zoo;
        }
        
        return $zoos;
    }



    public function getZooById($zoo_id)
    {
        $request = $this->pdo->prepare('SELECT * FROM Zoo WHERE id = :id');
        $request->bindValue(':id', $zoo_id, PDO::PARAM_INT);
        $request->execute();
        $resultat = $request->fetch(PDO::FETCH_ASSOC);

        if (!$resultat) {
            return null; // Zoo non trouvé
        }

        $zoo = new Zoo([
            'id' => $resultat['id'],
            'name' => $resultat['name'],
        ]);
        return $zoo;
    }

    

   
    public function updateZoo($id, $name)
    {
        $request = $this->pdo->prepare('UPDATE Zoo SET name = ? WHERE id = ?');
        $request->execute([$name, $id]);
        return $request->rowCount();
    }



    public function deleteZoo($id)
    {
        $request = $this->pdo->prepare('DELETE FROM Zoo WHERE id = ?');
        $request->execute([$id]);
        return $request->rowCount();
    }

    public function countAnimalsInZoo($zoo_id)
    {
        $request = $this->pdo->prepare('SELECT COUNT(*) FROM Animals WHERE zoo_id = :zoo_id');
        $request->bindValue(':zoo_id', $zoo_id, PDO::PARAM_INT);
        $request->execute();
        $resultat = $request->fetch(PDO::FETCH_COLUMN);
        return $resultat;
    }

    public function countEnclosuresInZoo($zoo_id)
    {
        $request = $this->pdo->prepare('SELECT COUNT(*) FROM Enclosures WHERE zoo_id = :zoo_id');
        $request->bindValue(':zoo_id', $zoo_id, PDO::PARAM_INT);
        $request->execute();
        $resultat = $request->fetch(PDO::FETCH_COLUMN);
        return $resultat;
    }

    public function countEmployeesInZoo($zoo_id)
    {
        $request = $this->pdo->prepare('SELECT COUNT(*) FROM Employees WHERE zoo_id = :zoo_id');
        $request->bindValue(':zoo_id', $zoo_id, PDO::PARAM_INT);
        $request->execute();
        $resultat = $request->fetch(PDO::FETCH_COLUMN);
        return $resultat;
    }

 
}
