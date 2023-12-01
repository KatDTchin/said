<?php

class Recours {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addRecours($id_student, $module, $nature, $note_affiche, $note_reel, $status) {
        $conn = $this->db->connect();
        $query = "INSERT INTO recours (id_student, module, nature, note_affiche, note_reel, status) VALUES ('$id_student', '$module', '$nature', '$note_affiche', '$note_reel', '$status')";
        $conn->query($query);
        $conn->close();
    }

    public function getRecoursByStudentId($id_student) {
        $conn = $this->db->connect();
        $query = "SELECT * FROM recours WHERE id_student = '$id_student'";
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }
}

?>