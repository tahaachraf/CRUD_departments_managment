<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier - Produit</title>
    <link rel="stylesheet" href="edit_produit.css">
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
    if (!empty($_POST['nom_produit']) && !empty($_POST['model'])) {
        $id_produit = intval($_POST['id_produit']);
        $nom_produit = mysqli_real_escape_string($conn, $_POST['nom_produit']);
        $model = mysqli_real_escape_string($conn, $_POST['model']);
        $cout = intval($_POST['cout']);
        $prix_de_vente = intval($_POST['prix_de_vente']);
        $groupe = mysqli_real_escape_string($conn, $_POST['groupe']);
        $quantite_en_stock = intval($_POST['quantite_en_stock']);
        $quantite_vendue = intval($_POST['quantite_vendue']);

        $check_sql = "SELECT * FROM produits WHERE id_produit = $id_produit";
        $result = mysqli_query($conn, $check_sql);
        
        if (mysqli_num_rows($result) > 0) {
            $sql = "UPDATE produits SET 
                        nom_produit='$nom_produit',
                        model='$model', 
                        cout='$cout',
                        prix_de_vente='$prix_de_vente',
                        groupe='$groupe',
                        quantite_en_stock='$quantite_en_stock',
                        quantite_vendue='$quantite_vendue'
                    WHERE id_produit=$id_produit"; 
            if (mysqli_query($conn, $sql)) {
                $message = "Modification enregistrÃ©e avec succÃ¨s !";
                $success = true;
            } else {
                $message = "Erreur SQL : " . mysqli_error($conn);
            }
        } else {
            $message = "ID non trouvÃ©.";
        }
    } elseif (!empty($_POST['id_produit']) && empty($_POST['nom_produit'])) {
        $id = intval($_POST['id_produit']);
        $result = mysqli_query($conn, "SELECT * FROM produits WHERE id_produit = $id");
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
        <legend>Modifier les donnÃ©es d'un produit</legend>
        <?php if ($success): ?>
        <div class="success-card">
            <div class="success-icon">&#10004;</div>
            <h2><?php echo $message; ?></h2>
            <a href="tableau_produits.php" class="btn-voir-tableau">Voir le tableau</a>
        </div>
        <?php else: ?>
        <?php if ($message): ?>
        <p class="error-msg"><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="edit_produit.php" method="post">
            <table>
                <input type="hidden" name="id_produit" value="<?php echo $row ? $row['id_produit'] : ''; ?>">
                <tr>
                    <td><label>Nom de produit:</label></td>
                    <td><input type="text" name="nom_produit" value="<?php echo $row ? $row['nom_produit'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><label>Model:</label></td>
                    <td><input type="text" name="model" value="<?php echo $row ? $row['model'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><label>Cout:</label></td>
                    <td><input type="text" name="cout" value="<?php echo $row ? $row['cout'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><label>Prix de vente:</label></td>
                    <td><input type="text" name="prix_de_vente" value="<?php echo $row ? $row['prix_de_vente'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><label>Groupe:</label></td>
                    <td>
                    <select name="groupe">
                        <option value="A" <?php echo ($row && $row['groupe'] == 'A') ? 'selected' : ''; ?>>A</option>
                        <option value="B" <?php echo ($row && $row['groupe'] == 'B') ? 'selected' : ''; ?>>B</option>
                        <option value="C" <?php echo ($row && $row['groupe'] == 'C') ? 'selected' : ''; ?>>C</option>
                        <option value="D" <?php echo ($row && $row['groupe'] == 'D') ? 'selected' : ''; ?>>D</option>
                        <option value="E" <?php echo ($row && $row['groupe'] == 'E') ? 'selected' : ''; ?>>E</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td><label>QuantitÃ© en stock</label></td>
                    <td><input type="text" name="quantite_en_stock" value="<?php echo $row ? $row['quantite_en_stock'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><label>QuantitÃ© vendue</label></td>
                    <td><input type="text" name="quantite_vendue" value="<?php echo $row ? $row['quantite_vendue'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td><a href="tableau_produits.php" class="btn-retour">Retour</a></td>
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
