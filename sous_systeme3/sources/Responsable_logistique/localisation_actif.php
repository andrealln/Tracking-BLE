<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsable_logistique</title>
    <style>
        table {
            border-collapse: collapse;
            width: 75%;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #1966B6;
            color: white;
        }
    </style>
</head>
<body>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Connexion à la base de données
$servername = "ll440466-001.privatesql:35312";
$username = "trackingble2024";
$password = "track1ngBle2o24";
$dbname = "Trackingble2024";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête pour lire la liste des actifs
$query = "SELECT nom FROM actif";
$lesactifs = array();

if ($resultat = $conn->query($query)) {
    while ($unactif = $resultat->fetch_assoc()) {
        $lesactifs[] = $unactif;
    }
    $resultat->free();
} else {
    echo "Erreur de requête : " . $conn->error;
    exit();
}

// Formulaire pour identifier le camion d’un actif
echo "<p><form method='post'>";
echo "<h3>Identifier le camion d’un actif</h3>";
echo "Actif :<select id='actif' name='actif'>";
foreach ($lesactifs as $unactif) {
    $nom = $unactif['nom'];
    echo "<option value='$nom'>$nom</option>";
}
echo "</select>";
echo "<p><input type='submit' name='Identifier' value='Identifier le camion' /></p>";
echo "</form></p>";

// On a cliqué sur le bouton identifier
if (isset($_POST['Identifier'])) {
    $nom = $conn->real_escape_string($_POST['actif']);

    // Requête SQL pour la table 'actif'
    $sql = "SELECT longitude, latitude, immatriculation FROM actif JOIN beacon ON actif.id_BEACON = beacon.id_BEACON JOIN camion ON beacon.id_CAMION = camion.id_CAMION WHERE actif.nom = '$nom'";
    $reponse = $conn->query($sql);

    if (!$reponse) {
        echo "Erreur de requête : " . $conn->error;
        exit();
    }

    // Données à afficher dans le tableau
    $donnees = array();
    while ($tableau = $reponse->fetch_assoc()) {
        $donnees[] = array($tableau['immatriculation'], $tableau['longitude'], $tableau['latitude']);
    }

    // En-têtes du tableau pour la table 'camion'
    $entetesCamion = array("immatriculation", "longitude", "latitude");

    // Affichage du tableau pour la table 'camion'
    echo "<table>";
    echo "<tr>";
    foreach ($entetesCamion as $entete) {
        echo "<th>$entete</th>";
    }
    echo "</tr>";

    foreach ($donnees as $ligne) {
        echo "<tr>";
        foreach ($ligne as $index => $cellule) {
            if ($entetesCamion[$index] == "immatriculation") {
                $longitude = $ligne[1];
                $latitude = $ligne[2];
                echo "<td><a href='localisation_actif2.php?longitude=$longitude&latitude=$latitude'>$cellule</a></td>";
            } else {
                echo "<td>$cellule</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table><br/>";
}

echo "<br/>";
echo "<br/>";

// Fermer la connexion à la base de données
$conn->close();
?>

</body>
</html>
