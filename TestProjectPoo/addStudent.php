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
                                <input type="text" name="nom" class="form-control" required id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Nom</label>
                              </div>
                              <div class="form-floating mb-3">
                                <input type="text" name="prenom"class="form-control"required id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Prenom</label>
                              </div>
                              <div class="form-floating mb-3">
                                <input type="email" name="email"class="form-control" required id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                              </div>
                              <div class="form-floating mb-3">
                                <input type="number" name="groupe"class="form-control" required id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Groupe</label>
                              </div>
                            <input type="submit" class="btn btn-primary"name="add_student"value="Ajouter etudiant"></input>
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='PageAddRecours.php'">Lance un recours</button>
                    


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