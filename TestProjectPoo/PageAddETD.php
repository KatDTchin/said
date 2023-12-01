<?php
require 'db.php';
require 'Student.php';
?>

<!-- Page d'ajout d'étudiant -->
<div class="container mt-4">
    <h2>Ajouter un étudiant</h2>
    <?php
        // Traitement du formulaire d'ajout d'étudiant
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_student"])) {
            // Inclure les fichiers nécessaires
            require_once 'db.php';
            require_once 'Student.php';

            // Créer une instance de la classe Student
            $student = new Student();

            // Récupérer les données du formulaire
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $email = $_POST["email"];
            $groupe = $_POST["groupe"];

            // Ajouter l'étudiant à la base de données
            $student->addStudent($nom, $prenom, $email, $groupe);

            // Afficher un message de succès
            echo "<p class='text-success'>Étudiant ajouté avec succès!</p>";
        }
    ?>

    <!-- Formulaire d'ajout d'étudiant -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" required>

        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="groupe">Groupe:</label>
        <input type="text" name="groupe" required>

        <button type="submit" name="add_student" class="btn btn-primary">Ajouter</button>
    </form>
</div>




 