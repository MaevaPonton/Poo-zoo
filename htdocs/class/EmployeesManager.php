<?php


class EmployeesManager { 

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



    public function add(Employees $employee) // Fonction pour ajouter les nouveaux employés en base de données :
    {
        $pseudo = $employee->getPseudo();
        $gender = $employee->getGender();
        $age = $employee->getAge();
        $zoo_id = $employee->getZooId();

        $requete = $this->pdo->prepare("INSERT INTO Employees (pseudo, gender, age, zoo_id) VALUES (:pseudo, :gender, :age, :zoo_id)");
        $requete->bindParam(':pseudo', $pseudo);
        $requete->bindParam(':gender', $gender);
        $requete->bindParam(':age', $age);
        $requete->bindParam(':zoo_id', $zoo_id);
        $requete->execute();
        $employee->setId($this->pdo->lastInsertId());

    }


   
    public function delete(Employees $employee) {
        $this->pdo->exec('DELETE FROM Employees WHERE id = '.$employee->getId());
      }




    public function getEmployeeById($employee_id)
    {
        $request = $this->pdo->prepare('SELECT * FROM Employees WHERE id = :id');
        $request->bindValue(':id', $employee_id, PDO::PARAM_INT);
        $request->execute();
        $resultat = $request->fetch(PDO::FETCH_ASSOC);

        if (!$resultat) {
            return null; // Employé non trouvé
        }

        $employee = new Employees([
            'id' => $resultat['id'],
            'zoo_id' => $resultat['zoo_id'],
            'pseudo' => $resultat['pseudo'],
            'gender' => $resultat['gender'],
            'age' => $resultat['age'],
        ]);
        return $employee;
    }

    public function getEmployeesByZooId($zoo_id)
{
    $stmt = $this->pdo->prepare('SELECT * FROM Employees WHERE zoo_id = :zoo_id');
    $stmt->execute(['zoo_id' => $zoo_id]);

    $employees = array();
    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $employee = new Employees($data);
        $employee->setId($data['id']);
        $employees[] = $employee;
    }

    return $employees;
}


    public function getAllEmployees()
    {
        $request = $this->pdo->query('SELECT * FROM Employees');
        $employees = array();
        foreach ($request->fetchAll(PDO::FETCH_ASSOC) as $data) {
            $employee = new Employees($data);
            $employee->setId($data['id']);
            $employees[] = $employee;
        }
        
        return $employees;
    }


    public function update(Employees $employee) {
        $req = $this->pdo->prepare('UPDATE Employees SET zoo_id = :zoo_id, pseudo = :pseudo, gender = :gender, age = :age WHERE id = :id');
        $req->bindParam(':zoo_id', $employee->getZooId(), PDO::PARAM_INT);
        $req->bindParam(':pseudo', $employee->getPseudo(), PDO::PARAM_STR);
        $req->bindParam(':gender', $employee->getGender(), PDO::PARAM_STR);
        $req->bindParam(':age', $employee->getAge(), PDO::PARAM_INT);
        $req->bindParam(':id', $employee->getId(), PDO::PARAM_INT);
        $req->execute();
      }

    public function deleteEmployee($id)
      {
          $request = $this->pdo->prepare('DELETE FROM Employees WHERE id = ?');
          $request->execute([$id]);
          return $request->rowCount();
      }
      

      public function countEnclosuresToEmployees($employee_id)
      {
          $request = $this->pdo->prepare('SELECT COUNT(*) FROM Enclosures WHERE employee_id = :employee_id');
          $request->bindValue(':employee_id', $employee_id, PDO::PARAM_INT);
          $request->execute();
          $resultat = $request->fetch(PDO::FETCH_COLUMN);
          return $resultat;
      }

      public function countAnimalsToEmployees($employee_id)
      {
          $request = $this->pdo->prepare('SELECT COUNT(*) FROM Animals WHERE employee_id = :employee_id');
          $request->bindValue(':employee_id', $employee_id, PDO::PARAM_INT);
          $request->execute();
          $resultat = $request->fetch(PDO::FETCH_COLUMN);
          return $resultat;
      }
}