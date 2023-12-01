<?php
require 'db.php';
require 'Student.php';
?>
<!-- Page de listing des étudiants -->
<div class="container mt-4">
    <h2>Liste des étudiants</h2>
    <?php
        // Utilisez la classe Student pour récupérer la liste des étudiants depuis la base de données
        $student = new Student();
        $students = $student->getStudents();

        // Affichez la liste des étudiants
        if ($students->num_rows > 0) {
            echo "<ul>";
            while ($row = $students->fetch_assoc()) {
                echo "<li>{$row['nom']} {$row['prenom']} - {$row['email']} - Groupe: {$row['groupe']}</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Aucun étudiant trouvé.</p>";
        }
    ?>
</div>

