<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier - Fournisseur</title>
    <link rel="stylesheet" href="edit_fournisseur.css">
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
    if (!empty($_POST['nom_fournisseur']) && !empty($_POST['email_fournisseur'])) {
        $id_fournisseur = intval($_POST['id_fournisseur']);
        $nom_fournisseur = mysqli_real_escape_string($conn, $_POST['nom_fournisseur']);
        $email_fournisseur = mysqli_real_escape_string($conn, $_POST['email_fournisseur']);
        $id_charge_achat = intval($_POST['id_charge_achat']);

        $check_sql = "SELECT * FROM fournisseurs WHERE id_fournisseur = $id_fournisseur";
        $result = mysqli_query($conn, $check_sql);
        
        if (mysqli_num_rows($result) > 0) {
            $sql = "UPDATE fournisseurs SET 
                        nom_fournisseur='$nom_fournisseur', 
                        email_fournisseur='$email_fournisseur', 
                        id_charge_achat='$id_charge_achat' 
                    WHERE id_fournisseur=$id_fournisseur"; 
            if (mysqli_query($conn, $sql)) {
                $message = "Modification enregistrÃ©e avec succÃ¨s !";
                $success = true;
            } else {
                $message = "Erreur SQL : " . mysqli_error($conn);
            }
        } else {
            $message = "ID non trouvÃ©.";
        }
    } elseif (!empty($_POST['id_fournisseur']) && empty($_POST['nom_fournisseur'])) {
        $id = intval($_POST['id_fournisseur']);
        $result = mysqli_query($conn, "SELECT * FROM fournisseurs WHERE id_fournisseur = $id");
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
        <legend>Modifier les donnÃ©es d'un fournisseur</legend>
        <?php if ($success): ?>
        <div class="success-card">
            <div class="success-icon">&#10004;</div>
            <h2><?php echo $message; ?></h2>
            <a href="tableau_fournisseurs.php" class="btn-voir-tableau">Voir le tableau</a>
        </div>
        <?php else: ?>
        <?php if ($message): ?>
        <p class="error-msg"><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="edit_fournisseur.php" method="post">
            <table>
                <input type="hidden" name="id_fournisseur" value="<?php echo $row ? $row['id_fournisseur'] : ''; ?>">
                <tr>
                    <td><label>Nom du fournisseur</label></td>
                    <td><input type="text" name="nom_fournisseur" value="<?php echo $row ? $row['nom_fournisseur'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><label>Email fournisseur</label></td>
                    <td><input type="text" name="email_fournisseur" value="<?php echo $row ? $row['email_fournisseur'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><label>ID chargÃ© achat</label></td>
                    <td><input type="text" name="id_charge_achat" value="<?php echo $row ? $row['id_charge_achat'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><a href="tableau_fournisseurs.php" class="btn-retour">Retour</a></td>
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
