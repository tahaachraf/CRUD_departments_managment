<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DÃ©partment comercial & marketing</title>
    <link rel="stylesheet" href="cometmkg.css">
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
        $message = "";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Ajout d'un employÃ© 
        if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email'])) {
            $nom = mysqli_real_escape_string($conn, $_POST['nom']);
            $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
            $age = intval($_POST['age']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
            $date_recrutement = mysqli_real_escape_string($conn, $_POST['dr']); // Correction ici
            $nombre_des_clients = intval($_POST['nombre_des_clients']);
            $salaire = floatval($_POST['salaire']);    
    
            $sql = "INSERT INTO departement_mkg (nom, prenom, age, email, adresse, date_recrutement, nombre_des_clients, salaire) 
                    VALUES ('$nom', '$prenom', '$age', '$email', '$adresse', '$date_recrutement', '$nombre_des_clients', '$salaire')";
    
            if (mysqli_query($conn, $sql)) {
                $message = "âœ… EmployÃ© ajoutÃ© avec succÃ¨s !";
            } else {
                $message = "âŒ Erreur : " . mysqli_error($conn);
            }
        } 
        
        // Ajout d'un client
        elseif (!empty($_POST['nom_client']) && !empty($_POST['email_client']) && !empty($_POST['nombre_de_commandes'])) {
            $nom_client = mysqli_real_escape_string($conn, $_POST['nom_client']);
            $email_client = mysqli_real_escape_string($conn, $_POST['email_client']);
            $nombre_de_commandes = intval($_POST['nombre_de_commandes']);
            $id_charge_mkg = intval($_POST['id_charge_mkg']); // Ajout pour Ã©viter un champ vide
    
            $sql = "INSERT INTO clients (nom_client, email_client, nombre_de_commandes, id_charge_mkg) 
                    VALUES ('$nom_client', '$email_client', '$nombre_de_commandes', '$id_charge_mkg')";
    
            if (mysqli_query($conn, $sql)) {
                $message = "âœ… Client ajoutÃ© avec succÃ¨s !";
            } else {
                $message = "âŒ Erreur : " . mysqli_error($conn);
            }
        }
    }
    
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
        <legend>Ajouter au dÃ©partement comercial & marketing</legend>
        <form action="cometmkg.php" method="post">
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
                <td><label for="dr">Date de rÃ©crutement:</label></td>
                <td><input type="date" name="dr"></td>
            </tr>
            <tr>
                <td><label for="nombre_des_clients">Nombre des clients</label></td>
                <td><input type="text" name="nombre_des_clients"></td>
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
            <a href="tableau_mkg.php">Voir le tableau de commercants</a>
        </form>
    </fieldset>
    <fieldset>
        <legend>Ajouter un client</legend>
        <form action="cometmkg.php" method="post">
            <table>
                <tr>
                    <td><label for="nom_client">Nom de client:</label></td>
                    <td><input type="text" name="nom_client"></td>
                </tr>
                <tr>
                    <td><label for="email_client">Email de client</label></td>
                    <td><input type="text" name="email_client"></td>
                </tr>   
                <tr>
                    <td><label for="nombre_de_commandes">Nombre de commandes</label></td>
                    <td><input type="text" name="nombre_de_commandes"></td>
                </tr> 
                <tr>
                    <td><label for="id_charge_mkg">ID commercant</label></td>
                    <td><input type="text" name="id_charge_mkg"></td>
                </tr>
                <tr>
                    <td><input type="reset" value="annuler"></td>
                    <td><input type="submit" value="Enregistrer"></td>
                </tr>
          </table>
        </form>
        <a href="clients.php">Voir le tableau de clients</a>
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