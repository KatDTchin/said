<?php
require 'db.php';
require 'Student.php';
require 'Recours.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

        <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-">
            <div class="container-fluid">
                <div class="logo navbar-brand d-flex align-items-center">
                    <img src="./images/icons8-university-50.png" class="img-fluid" alt="UMBB School Logo">
                    <h1 class="d-inline">
                        <span class=" text-primary">UMBB</span>-School
                    </h1>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Home" data-bs-animation="true">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Link" data-bs-animation="true">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Dropdown" data-bs-animation="true">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Disabled" data-bs-animation="true">Disabled</a>
                        </li>
                    </ul>

                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
                <div class="container-fluid main-container">
                    <div class="row">
                        <div class="right col-md-6 m-5 p-5 ms-0">
                            
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="col-md-6 m-5">
                            <h3 class="d-inline">
                                <span class="text-primary">Inscrit</span>-Vous:
                            </h3><br>
                            <div class="form-floating mb-3">
                               <!-- <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Nom</label>-->
                                <label for="floatingInput"></label>
                            <select  name="id_student" class="form-control"id="floatingInput" required>
                             <option selected>Selectioner l'etudiant </option>
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
                              </div>
                            
                              <select class="form-select mb-3" name="module"aria-label="Default select example" id="floatingInput" required>
                                <option selected>Module</option>
                                <option value="SID">Système d'information distribué</option>
                                <option value="SAD">Système d'aide à la décision</option>
                                <option value="GL">Génie Logiciel</option>
                                <option value="IHM">Interface Homme Machine</option>
                                <option value="ASI">Administration des Systèmes d'information</option>
                                <option value="PAW">Programmation avancée pour le Web</option>
                                <option value="ECO NUM">Economie numérique et veille stratégique</option>
                                
                            </select>
                                <select class="form-select mb-3" aria-label="Default select example" name="nature" required>
                                    <option selected>Type de recour</option>
                                    <option value="1">CC</option>
                                    <option value="2">Examen</option>
                                </select>
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="note_affiche" required>
                                    <label for="floatingInput">Note afficher</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="note_reel" required>
                                    <label for="floatingInput">Note reel</label>
                                </div>
                                <div class="form-floating mb-3">
                                  <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="status" required>
                                  <label for="floatingInput">Statut du recours (1: favorable, 2: défavorable)</label>
                                </div>
                              
                            <input type="submit" name="add_recours"class="btn btn-primary"value="Lancer un recour"></input>
                            <button type="button" class="btn btn-secondary">Ajouter Etudient</button>
                    


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

</form>


                </div>



            </div>
      <footer class="footer mt-5 py-3 bg-dark text-light">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h5>Liens Utiles</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#">Cours</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5>Contactez-nous</h5>
                    <address>
                        <strong>UMBB School</strong><br>
                        Boumerdes centre<br>
                        Boumerdes, Algerie<br>
                        <abbr title="Phone">Tél:</abbr> (023) 53-8728
                    </address>
                </div>
            </div>
        </div>
        <div class="text-center text-muted mt-3">
            <p>&copy; 2023 UMBB School. Tous droits réservés.</p>
        </div>
    </footer>

</body>
<script src="js/bootstrap.bundle.js"></script>
</html>