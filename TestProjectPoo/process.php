<?php
require 'db.php';
require 'Recours.php';
require 'Student.php';
?>


<a href="PageAddETD.php" class="redirect">Ajouter un etudiant</a>
<a href="PageListing.php" class="redirect-listing">Listes des étudiants</a>
<a href="PageAddRecours.php" class="redirect-recours">Add Recours</a>




    <!-- Page d'ajout de recours -->
<div class="container mt-4">
    <h2>Ajouter un recours</h2>
    <?php
        // Traitement du formulaire d'ajout de recours
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_recours"])) {
            // Inclure les fichiers nécessaires
            require_once 'db.php';
            require_once 'recours.php';

            // Créer une instance de la classe Recours
            $recours = new Recours();

            // Récupérer les données du formulaire
            $id_student = $_POST["id_student"]; // Cette valeur doit être fournie par le formulaire d'une manière ou d'une autre
            $module = $_POST["module"];
            $nature = $_POST["nature"];
            $note_affiche = $_POST["note_affiche"];
            $note_reel = $_POST["note_reel"];
            $status = $_POST["status"];

            // Ajouter le recours à la base de données
            $recours->addRecours($id_student, $module, $nature, $note_affiche, $note_reel, $status);

            // Afficher un message de succès
            echo "<p class='text-success'>Recours ajouté avec succès!</p>";
        }
    ?>

    <!-- Formulaire d'ajout de recours -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <!-- Ici, vous pouvez ajouter une liste déroulante ou une autre méthode pour sélectionner l'étudiant -->
        <!-- Par exemple, si vous avez une liste déroulante de tous les étudiants -->
        <label for="id_student">Sélectionner l'étudiant:</label>
        <select name="id_student" required>
            <?php
                // Récupérer la liste des étudiants depuis la base de données
                $student = new Student();
                $students = $student->getStudents();

                // Afficher les options de la liste déroulante
                while ($row = $students->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['nom']} {$row['prenom']}</option>";
                }
            ?>
        </select>

        <label for="module">Module:</label>
        <input type="text" name="module" required>

        <label for="nature">Nature du recours:</label>
        <input type="text" name="nature" required>

        <label for="note_affiche">Note affichée:</label>
        <input type="text" name="note_affiche" required>

        <label for="note_reel">Note réelle:</label>
        <input type="text" name="note_reel" required>

        <label for="status">Statut du recours (1: favorable, 2: défavorable):</label>
        <input type="text" name="status" required>

        <button type="submit" name="add_recours" class="btn btn-primary">Ajouter</button>
    </form>
</div>


<!-- Filtre de recherche -->
<div class="container mt-4">
    <h2>Filtrer les étudiants</h2>
    <?php
        // Traitement du formulaire de filtre
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["filter_students"])) {
            // Inclure les fichiers nécessaires
            require_once 'db.php';
            require_once 'Student.php';
            require_once 'Recours.php';

            // Créer une instance de la classe Student
            $student = new Student();

            // Récupérer le terme de recherche du formulaire
            $search_term = $_POST["search"];

            // Rechercher les étudiants par nom, prénom ou email
            $filtered_students = $student->filterStudents($search_term);

            // Afficher les résultats
            
                while ($row = $filtered_students->fetch_assoc()) {
                    echo "<li>- Nom : {$row['nom']} - Prenom: {$row['prenom']} - Email : {$row['email']} - Groupe: {$row['groupe']} - Status : ";
                    if ($row['status'] == 1) {
                        echo "Favorable";
                    } elseif ($row['status'] == 2) {
                        echo "Défavorable";
                    } else {
                        echo "Non défini";
                    }   
                    "</li>";
                }
                
            
            }
        
    ?>

    <!-- Formulaire de filtre de recherche -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="search">Rechercher par nom, prénom ou email:</label>
        <input type="text" name="search" required>

        <button type="submit" name="filter_students" class="btn btn-primary">Rechercher</button>
    </form>
</div>

