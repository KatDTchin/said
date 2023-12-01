<?php

class Student {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addStudent($nom, $prenom, $email, $groupe) {
        $conn = $this->db->connect();
        $query = "INSERT INTO students (nom, prenom, email, groupe) VALUES ('$nom', '$prenom', '$email', '$groupe')";
        $conn->query($query);
        $conn->close();
    }

    public function getStudents() {
        $conn = $this->db->connect();
        $query = "SELECT * FROM students";
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }
    public function filterStudents($search_term) {
        $conn = $this->db->connect();
        $query = "SELECT students.*,recours.status
                  FROM students
                  LEFT JOIN recours ON students.id = recours.id_student
                  WHERE students.nom LIKE '%$search_term%'
                    OR students.prenom LIKE '%$search_term%'
                    OR students.email LIKE '%$search_term%'";
                    
        $result = $conn->query($query);

        // Vérifier si la requête a réussi
        if (!$result) {
            die("Erreur dans la requête: " . $conn->error);
        }

        $conn->close();
        return $result;
    }
}



?>