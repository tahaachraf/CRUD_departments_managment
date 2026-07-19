<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DÃ©partment de production</title>
    <link rel="stylesheet" href="production.css">
</head>
<body>
<?php
    $serveur = "localhost";
    $utilisateur = "root"; 
    $motdepasse = ""; 
    $base_de_donnees = "ma_bd";     
    $conn = mysqli_connect($serveur, $utilisateur, $motdepasse, $base_de_donnees);

    
    
    // Initialisation des variables 
    $message = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Ajout d'un employÃ© au dÃ©partement de production 
        if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email'])) {
            $nom = mysqli_real_escape_string($conn, $_POST['nom']);
            $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
            $age = intval($_POST['age']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
            $date_recrutement = mysqli_real_escape_string($conn, $_POST['date_recrutement']);
            $salaire = floatval($_POST['salaire']);  
            $groupe=$_POST['groupe']; 
            $sql = "INSERT INTO departement_production (nom, prenom, age, email, adresse, date_recrutement, salaire, groupe) 
                    VALUES ('$nom', '$prenom', '$age', '$email', '$adresse', '$date_recrutement', '$salaire', '$groupe')";
    
            if (mysqli_query($conn, $sql)) {
                $message = "âœ… EmployÃ© ajoutÃ© avec succÃ¨s !";
            } else {
                $message = "âŒ Erreur : " . mysqli_error($conn);
            }
        } elseif (!empty($_POST['nom_produit']) && !empty($_POST['model']) && !empty($_POST['cout']) && !empty($_POST['prix_de_vente']) && !empty($_POST['quantite_en_stock']) && !empty($_POST['quantite_vendue'])) {
            $nom_produit= mysqli_real_escape_string($conn, $_POST['nom_produit']);
            $model= mysqli_real_escape_string($conn, $_POST['model']);
            $cout= intval($_POST['cout']);
            $prix_de_vente= intval($_POST['prix_de_vente']);
            $quantite_en_stock= intval($_POST['quantite_en_stock']);
            $quantite_vendue= intval($_POST['quantite_vendue']);
            $groupe= mysqli_real_escape_string($conn, $_POST['groupe']);
            $sql= "INSERT INTO produits(nom_produit, model, cout, prix_de_vente, quantite_en_stock, quantite_vendue, groupe)
                   VALUES('$nom_produit', '$model', '$cout', '$prix_de_vente', '$quantite_en_stock', '$quantite_vendue', '$groupe')";
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
    <header>
        <ul class="navbar1">
            <li><img src="logo.png" alt="Logo" width="250px" height="82px"></li>
            <li class="gi">Groupe industriel</li>
            <li><a href="devis.php">Ajouter un devis</a></li>
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
        <legend>Ajouter au dÃ©partement de production</legend>
        <form action="production.php" method="post">
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
                <td><label for="salaire">Salaire:</label></td>
                <td><input type="text" name="salaire"></td>
            </tr>
            <tr>
                <td><label for="groupe">Groupe:</label></td>
                <td><select name="groupe" id="">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                    </select></td>
            </tr>
            <tr>
                <td><input type="reset" value="Annuler"></td>
                <td><input type="submit" value="Enregistrer"></td>
            </tr>
            </table>
        </form>
        <a href="producteurs.php">Voir le tableau des producteurs</a>
    </fieldset>
    <fieldset>
        <fieldset>Ajouter un produit</fieldset>
        <form action="production.php" method="post">
            <table>
                <tr>
                    <td><label for="pronom_produit">Produit:</label></td>
                    <td><input type="text" name="nom_produit"></td>
                </tr>
                <tr>
                    <td><label for="model">ModÃ¨l:</label></td>
                    <td><input type="text" name="model"></td>
                </tr>
                <tr>
                    <td><label for="cout">CoÃ»t</label></td>
                    <td><input type="text" name="cout"></td>
                </tr> 
                <tr>
                    <td><label for="prix_de_vente">Prix de vente</label></td>
                    <td><input type="text" name="prix_de_vente"></td>
                </tr>   
                <tr>
                <td><label for="groupe">Groupe:</label></td>
                <td><select name="groupe" id="">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                    </select></td>
                </tr> 
                <tr>
                    <td><label for="quantite_en_stock">QuantitÃ© en stock</label></td>
                    <td><input type="text" name="quantite_en_stock"></td>
                </tr>   
                <tr>
                    <td><label for="quantite_vendue">QuantitÃ© vendue</label></td>
                    <td><input type="text" name="quantite_vendue"></td>
                </tr>                        
                <tr>
                    <td><input type="reset" value="Annuler"></td>
                    <td><input type="submit" value="Enregistrer"></td>
                </tr>
            </table>
        </form>
        <a href="tableau_produits.php">Voir le tableau des produits</a>
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