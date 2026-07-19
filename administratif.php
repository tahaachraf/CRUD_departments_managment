<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DÃ©partment administratif</title>
    <link rel="stylesheet" href="administratif.css">
</head>
<body>
<?php
    $serveur = "localhost";
    $utilisateur = "root"; 
    $motdepasse = ""; 
    $base_de_donnees = "ma_bd";     
    $conn = mysqli_connect($serveur, $utilisateur, $motdepasse, $base_de_donnees);
    
    // VÃ©rifier la connexion
    if (!$conn) {
        die("âŒ Ã‰chec de la connexion : " . mysqli_connect_error());
    }
    
    // Initialisation des variables
    $message = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Ajout d'un employÃ© au dÃ©partement administratif
        if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email'])) {
            $nom = mysqli_real_escape_string($conn, $_POST['nom']);
            $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
            $age = intval($_POST['age']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
            $date_recrutement = mysqli_real_escape_string($conn, $_POST['date_recrutement']);
            $salaire = floatval($_POST['salaire']);    
            $sql = "INSERT INTO departement_administratif (nom, prenom, age, email, adresse, date_recrutement, salaire) 
                    VALUES ('$nom', '$prenom', '$age', '$email', '$adresse', '$date_recrutement', '$salaire')";
    
            if (mysqli_query($conn, $sql)) {
                $message = "âœ… EmployÃ© ajoutÃ© avec succÃ¨s !";
            } else {
                $message = "âŒ Erreur : " . mysqli_error($conn);
            }
        }
    }
   
    mysqli_close($conn);
    ?>
    <header>
        <ul class="navbar1">
            <li><img src="logo.png" alt="Logo" width="250px" height="82px"></li>
            <li class="gi">Groupe industriel</li>
            <li><a href="devis.php">Devis</a></li>
        </ul>
        <nav class="navbar2">
            <div class="hamburger" id="hamburger">
                <span></span><span></span><span></span>
            </div>
            <ul class="nav-links" id="navLinks">
                <li><a href="index.html">Accueil</a></li>
                <li><a href="achat.php">Département d'achat</a></li>
                <li><a href="production.php">Département de production</a></li>
                <li><a href="cometmkg.php">Commercial & marketing</a></li>
                <li><a href="administratif.php">Département administratif</a></li>
            </ul>
            <div class="nav-search">
                <input type="text" placeholder="Rechercher">
            </div>
        </nav>
    </header>
 
    <fieldset>
        <legend>Ajouter au dÃ©partement administratif</legend>
        <form action="administratif.php" method="post">
            <table>
            <tr>
                <td><label for="nom">Nom:</label></td>
                <td><input type="text" name="nom"></td>
            </tr>
            <tr>
                <td><label for="prenom">PrÃ©nom:</label></td>
                <td><input type="text" name="prenom"></td>
            </tr>
            <tr>
                <td><label for="age">Age:</label></td>
                <td><input type="text" name="age"></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td><label for="adresse">Adresse:</label></td>
                <td><input type="text" name="adresse"></td>
            </tr>
            <tr>
                <td><label for="date_recrutement">Date de recrutement:</label></td>
                <td><input type="date" name="date_recrutement" required></td>
            </tr>

            <tr>
                <td><label for="salaire">Salaire:</label></td>
                <td><input type="text" name="salaire"></td>
            </tr>
            <tr>
                <td><input type="reset" value="annuler"></td>
                <td><input type="submit" value="Enregistrer"></td>
            </tr>
            </table>
        </form>
        <a href="tableau_administratif.php">Voir le tableau du dÃ©partement administratif</a>
    </fieldset>  
    <footer>
        <ul class="contact">
            <li>Avenue Habib bourgiba 4000 Sousse</li>
            <li>contact@groupe_fadhloune.com</li>
            <li>+21673123456</li>
        </ul>
    </footer>  
    <script>
    document.getElementById('hamburger').addEventListener('click', function() {
        this.classList.toggle('active');
        document.getElementById('navLinks').classList.toggle('show');
    });
    </script>
</body>
</html>