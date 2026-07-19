<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier - Client</title>
    <link rel="stylesheet" href="edit_client.css">
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
    if (!empty($_POST['nom_client']) && !empty($_POST['email_client'])) {
        $id_client = intval($_POST['id_client']);
        $nom_client = mysqli_real_escape_string($conn, $_POST['nom_client']);
        $email_client = mysqli_real_escape_string($conn, $_POST['email_client']);
        $id_charge_mkg = intval($_POST['id_charge_mkg']);

        $check_sql = "SELECT * FROM clients WHERE id_client = $id_client";
        $result = mysqli_query($conn, $check_sql);
        
        if (mysqli_num_rows($result) > 0) {
            $sql = "UPDATE clients SET 
                        nom_client='$nom_client', 
                        email_client='$email_client',
                        id_charge_mkg='$id_charge_mkg'
                    WHERE id_client=$id_client"; 
            if (mysqli_query($conn, $sql)) {
                $message = "Modification enregistrÃ©e avec succÃ¨s !";
                $success = true;
            } else {
                $message = "Erreur SQL : " . mysqli_error($conn);
            }
        } else {
            $message = "ID non trouvÃ©.";
        }
    } elseif (!empty($_POST['id_client']) && empty($_POST['nom_client'])) {
        $id = intval($_POST['id_client']);
        $result = mysqli_query($conn, "SELECT * FROM clients WHERE id_client = $id");
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
        <legend>Modifier les donnÃ©es d'un client</legend>
        <?php if ($success): ?>
        <div class="success-card">
            <div class="success-icon">&#10004;</div>
            <h2><?php echo $message; ?></h2>
            <a href="clients.php" class="btn-voir-tableau">Voir le tableau</a>
        </div>
        <?php else: ?>
        <?php if ($message): ?>
        <p class="error-msg"><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="edit_client.php" method="post">
            <table>
                <input type="hidden" name="id_client" value="<?php echo $row ? $row['id_client'] : ''; ?>">
                <tr>
                    <td><label>Nom du client:</label></td>
                    <td><input type="text" name="nom_client" value="<?php echo $row ? $row['nom_client'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><label>Email client:</label></td>
                    <td><input type="text" name="email_client" value="<?php echo $row ? $row['email_client'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><label>ID chargÃ© marketing</label></td>
                    <td><input type="text" name="id_charge_mkg" value="<?php echo $row ? $row['id_charge_mkg'] : ''; ?>"></td>
                </tr>              
                <tr>
                    <td><a href="clients.php" class="btn-retour">Retour</a></td>
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
