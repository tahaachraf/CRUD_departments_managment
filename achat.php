<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DÃ©partment d'achat</title>
    <link rel="stylesheet" href="achat.css">
</head>
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
    
    $message = "";
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Ajout d'un employÃ© au dÃ©partement d'achat
        if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email'])) {
            $nom = mysqli_real_escape_string($conn, $_POST['nom']);
            $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
            $age = intval($_POST['age']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
            $date_recrutement = mysqli_real_escape_string($conn, $_POST['date_recrutement']);
            $nombre_des_fournisseurs= intval($_POST['nombre_des_fournisseurs']);
            $salaire = floatval($_POST['salaire']);    
    
            $sql = "INSERT INTO departement_achat (nom, prenom, age, email, adresse, date_recrutement, salaire) 
                    VALUES ('$nom', '$prenom', '$age', '$email', '$adresse', '$date_recrutement', '$salaire')";
    
            if (mysqli_query($conn, $sql)) {
                $message = "âœ… EmployÃ© ajoutÃ© avec succÃ¨s !";
            } else {
                $message = "âŒ Erreur : " . mysqli_error($conn);
            }
        } elseif (!empty($_POST['nom_fournisseur']) && !empty($_POST['email_fournisseur']) && !empty($_POST['id_charge_achat'])) {
            // Ajout d'un fournisseur
            $nom_fournisseur = mysqli_real_escape_string($conn, $_POST['nom_fournisseur']);
            $email_fournisseur = mysqli_real_escape_string($conn, $_POST['email_fournisseur']);
            $id_charge_achat = intval($_POST['id_charge_achat']);
    
            $sql = "INSERT INTO fournisseurs (nom_fournisseur, email_fournisseur, id_charge_achat)
                    VALUES ('$nom_fournisseur', '$email_fournisseur', '$id_charge_achat')";
    
            if (mysqli_query($conn, $sql)) {
                $message = "âœ… Fournisseur ajoutÃ© avec succÃ¨s !";
            } else {
                $message = "âŒ Erreur : " . mysqli_error($conn);
            }
        } else {
            $message = "âŒ Tous les champs obligatoires doivent Ãªtre remplis.";
        }
    }
    
    mysqli_close($conn);
    
    ?>
<body>
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
        <legend>Ajouter au dÃ©partement d'achat</legend>
        <form action="achat.php" method="post">
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
                <td><label for="date_recrutement">Date de rÃ©crutement:</label></td>
                <td><input type="date" name="date_recrutement"></td>
            </tr>
            <tr>
                <td><label for="nbr_fournisseurs">Nombre de fournisseurs:</label></td>
                <td><input type="text" name="nbr_fournisseurs"></td>
            </tr>
            <tr>
                <td><label for="salaire">Salaire:</label></td>
                <td><input type="text" name="salaire"></td>
            </tr>
            <tr>
                <td><input type="reset" value="Annuler"></td>
                <td><input type="submit" value="Enregistrer"></td>
            </tr>
            </table>
        </form>
        <a href="tableau_achat.php">Voir le tableau de chargÃ©s d'achat</a>
    </fieldset>
    <fieldset>
        <legend>Ajouter un fournisseur</legend>
        <form action="achat.php" method="post">
            <table>
                <tr>
                    <td><label for="nom_fournisseur">Nom de fournisseur:</label></td>
                    <td><input type="text" name="nom_fournisseur"></td>
                </tr>
                <tr>
                    <td><label for="email_fournisseur">Email de fournisseur</label></td>
                    <td><input type="text" name="email_fournisseur"></td>
                </tr>  
                <tr>
                    <td><label for="id_charge_achat">ID chargÃ© d'achat</label></td>
                    <td><input type="text" name="id_charge_achat"></td>
                </tr>  
                <tr>
                    <td><input type="reset" value="annuler"></td>
                    <td><input type="submit" value="Enregistrer"></td>
                </tr>
          </table>
        </form>
        <a href="tableau_fournisseurs.php">Voir le tableau des fournisseurs</a> 
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