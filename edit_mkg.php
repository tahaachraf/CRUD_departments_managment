<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier - Marketing</title>
    <link rel="stylesheet" href="edit_mkg.css">
</head>
<body>
<?php
$serveur = "localhost";
$utilisateur = "root"; 
$motdepasse = ""; 
$base_de_donnees = "ma_bd";     
$conn = mysqli_connect($serveur, $utilisateur, $motdepasse, $base_de_donnees);

if (!$conn) {
    die("Ã‰chec de la connexion : " . mysqli_connect_error());
}

$message = "";
$success = false;
$row = null;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email'])) {
        $id_charge_mkg = intval($_POST['id_charge_mkg']);
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
        $age = intval($_POST['age']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
        $date_recrutement = mysqli_real_escape_string($conn, $_POST['date_recrutement']);
        $nombre_des_clients = intval($_POST['nombre_des_clients']);
        $salaire = floatval($_POST['salaire']);

        $check_sql = "SELECT * FROM departement_mkg WHERE id_charge_mkg = $id_charge_mkg";
        $result = mysqli_query($conn, $check_sql);
        
        if (mysqli_num_rows($result) > 0) {
            $sql = "UPDATE departement_mkg SET 
                        nom='$nom', prenom='$prenom', age=$age, 
                        email='$email', adresse='$adresse', 
                        date_recrutement='$date_recrutement',
                        nombre_des_clients='$nombre_des_clients',
                        salaire=$salaire 
                    WHERE id_charge_mkg=$id_charge_mkg"; 
            if (mysqli_query($conn, $sql)) {
                $message = "Modification enregistrÃ©e avec succÃ¨s !";
                $success = true;
            } else {
                $message = "Erreur SQL : " . mysqli_error($conn);
            }
        } else {
            $message = "ID non trouvÃ©.";
        }
    } elseif (!empty($_POST['id_charge_mkg']) && empty($_POST['nom'])) {
        $id = intval($_POST['id_charge_mkg']);
        $result = mysqli_query($conn, "SELECT * FROM departement_mkg WHERE id_charge_mkg = $id");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            $message = "ID non trouvÃ©.";
        }
    } else {
        $message = "Tous les champs obligatoires doivent Ãªtre remplis.";
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
        <legend>Modifier les donnÃ©es d'un chargÃ© marketing</legend>
        <?php if ($success): ?>
        <div class="success-card">
            <div class="success-icon">&#10004;</div>
            <h2><?php echo $message; ?></h2>
            <a href="tableau_mkg.php" class="btn-voir-tableau">Voir le tableau</a>
        </div>
        <?php else: ?>
        <?php if ($message): ?>
        <p class="error-msg"><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="edit_mkg.php" method="post">
            <table>
                <input type="hidden" name="id_charge_mkg" value="<?php echo $row ? $row['id_charge_mkg'] : ''; ?>">
                <tr>
                    <td><label>Nom:</label></td>
                    <td><input type="text" name="nom" value="<?php echo $row ? $row['nom'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><label>PrÃ©nom:</label></td>
                    <td><input type="text" name="prenom" value="<?php echo $row ? $row['prenom'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><label>Age:</label></td>
                    <td><input type="text" name="age" value="<?php echo $row ? $row['age'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><label>Email:</label></td>
                    <td><input type="text" name="email" value="<?php echo $row ? $row['email'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><label>Adresse:</label></td>
                    <td><input type="text" name="adresse" value="<?php echo $row ? $row['adresse'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><label>Date de recrutement</label></td>
                    <td><input type="date" name="date_recrutement" value="<?php echo $row ? $row['date_recrutement'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><label>Nombre des clients</label></td>
                    <td><input type="text" name="nombre_des_clients" value="<?php echo $row ? $row['nombre_des_clients'] : ''; ?>"></td>
                </tr>                
                <tr>
                    <td><label>Salaire</label></td>
                    <td><input type="text" name="salaire" value="<?php echo $row ? $row['salaire'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><a href="tableau_mkg.php" class="btn-retour">Retour</a></td>
                    <td><input type="submit" value="Enregistrer"></td>
                </tr>   
            </table>
        </form>
        <?php endif; ?>
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
