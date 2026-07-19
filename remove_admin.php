<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer - Administratif</title>
    <link rel="stylesheet" href="remove_admin.css">
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
$row = null;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_charge_admin = intval($_POST['id_charge_admin']);

    if (!empty($_POST['confirmer'])) {
        $sql = "DELETE FROM departement_administratif WHERE id_charge_admin = $id_charge_admin";
        if (mysqli_query($conn, $sql)) {
            header("Location: tableau_administratif.php");
            exit();
        } else {
            $message = "Erreur SQL : " . mysqli_error($conn);
        }
    } else {
        $result = mysqli_query($conn, "SELECT * FROM departement_administratif WHERE id_charge_admin = $id_charge_admin");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            $message = "ID non trouvÃ©.";
        }
    }
}
?>

<?php if ($message): ?>
<p><?php echo $message; ?></p>
<?php endif; ?>
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
        <legend>Supprimer un administratif</legend>
        <?php if ($row): ?>
        <h3>Voulez-vous vraiment supprimer cet employÃ© ?</h3>
        <table>
            <tr><td><strong>Nom</strong></td><td><?php echo $row['nom']; ?></td></tr>
            <tr><td><strong>PrÃ©nom</strong></td><td><?php echo $row['prenom']; ?></td></tr>
            <tr><td><strong>Email</strong></td><td><?php echo $row['email']; ?></td></tr>
            <tr><td><strong>Salaire</strong></td><td><?php echo $row['salaire']; ?> â‚¬</td></tr>
        </table>
        <form action="remove_admin.php" method="post" style="margin-top:20px;">
            <input type="hidden" name="id_charge_admin" value="<?php echo $row['id_charge_admin']; ?>">
            <a href="tableau_administratif.php" class="btn-retour">Annuler</a>
            <input type="submit" name="confirmer" value="Supprimer" style="background:linear-gradient(135deg,#dc2626,#ef4444);color:#fff;margin-left:10px;">
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
