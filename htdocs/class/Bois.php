<?php

class Bois extends Enclosures {

 

    public function __construct(array $data) 
    {
        parent::__construct($data);
    }



    public function pretyDump($data){
      highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
    }

    public function countAnimalsInEnclosure($enclosure_id, PDO $pdo)
    {
        $request = $pdo->prepare('SELECT COUNT(*) FROM Animals WHERE enclosure_id = :enclosure_id');
        $request->bindValue(':enclosure_id', $enclosure_id, PDO::PARAM_INT);
        $request->execute();
        $resultat = $request->fetch(PDO::FETCH_COLUMN);
        return $resultat;
    }

    public function afficherImage() {
        return "./images/foret.png";
    }

}

?>