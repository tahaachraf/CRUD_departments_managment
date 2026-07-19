<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="tableau_mkg.css">
</head>
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
  
    <h2>Liste des employÃ©s du dÃ©partement marketing</h2>

    <?php
        $serveur = "localhost";
        $utilisateur = "root";
        $motdepasse = "";
        $base_de_donnees = "ma_bd";
        $conn = mysqli_connect($serveur, $utilisateur, $motdepasse, $base_de_donnees);
        if (!$conn) {
            die("Ã‰chec de la connexion : " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM departement_mkg";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr>
                    <th>Nom</th>
                    <th>PrÃ©nom</th>
                    <th>Ã‚ge</th>
                    <th>Email</th>
                    <th>Adresse</th>
                    <th>Date de recrutement</th>
                    <th>Nombre de clients</th>
                    <th>Salaire</th>
                    <th>Actions</th>
                  </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id_charge_mkg'];
                echo "<tr>
                        <td>" . $row['nom'] . "</td>
                        <td>" . $row['prenom'] . "</td>
                        <td>" . $row['age'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['adresse'] . "</td>
                        <td>" . $row['date_recrutement'] . "</td>
                        <td>" . $row['nombre_des_clients'] . "</td>
                        <td>" . $row['salaire'] . " â‚¬</td>
                        <td class=\"actions-cell\">
                            <form action=\"edit_mkg.php\" method=\"post\" class=\"action-form\">
                                <input type=\"hidden\" name=\"id_charge_mkg\" value=\"{$id}\">
                                <button type=\"submit\" class=\"action-btn edit-btn\" title=\"Modifier\">
                                    <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M17 3a2.85 2.85 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z\"/><path d=\"m15 5 4 4\"/></svg>
                                </button>
                            </form>
                            <form action=\"remove_mkg.php\" method=\"post\" class=\"action-form\">
                                <input type=\"hidden\" name=\"id_charge_mkg\" value=\"{$id}\">
                                <button type=\"submit\" class=\"action-btn delete-btn\" title=\"Supprimer\">
                                    <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M3 6h18\"/><path d=\"M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6\"/><path d=\"M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2\"/><line x1=\"10\" x2=\"10\" y1=\"11\" y2=\"17\"/><line x1=\"14\" x2=\"14\" y1=\"11\" y2=\"17\"/></svg>
                                </button>
                            </form>
                        </td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Aucun employÃ© trouvÃ© dans le dÃ©partement marketing.</p>";
        }

        mysqli_close($conn);
    ?>

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
