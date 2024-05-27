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
    
<h2>Bienvenue sur la page du responsable logistique</h2>
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
$dsn = "mysql:host=" . $servername . ";" . "dbname=" . $dbname;

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Requête SQL pour la table 'camion'
$sql = "SELECT * FROM camion";

$reponse = $conn->query($sql);

// Données à afficher dans le tableau
$donnees = array();
while ($tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
    $donnees[] = array($tableau['immatriculation'], $tableau['longitude'], $tableau['latitude'], $tableau['temperature']);
}

// En-têtes du tableau pour la table 'camion'
$entetesCamion = array("immatriculation", "longitude", "latitude", "temperature");

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
            echo "<td><a href='localisation.php?longitude=$longitude&latitude=$latitude'>$cellule</a></td>";
        } else {
            echo "<td>$cellule</td>";
        }
    }
    echo "</tr>";
}
echo "</table><br/>";

echo"<br/>";
echo"<br/>";





// Requête SQL pour la table 'actif' 
$sql = "SELECT * FROM actif ";

$reponse = $conn->query($sql);

// Données à afficher dans le tableau pour la table 'actif'
$donneesActif = array();
while ($tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
    $beaconValue = isset($tableau['beacon']) ? $tableau['beacon'] : ""; // Vérification de l'existence de l'index 'beacon'
    $donneesActif[] = array($tableau['nom'], $beaconValue );
}

// En-têtes du tableau pour la table 'actif'
$entetesActif = array("actifs", "beacon");

// Affichage du tableau pour la table 'actif'
echo "<table>";
echo "<tr>";
foreach ($entetesActif as $entete) {
    echo "<th>$entete</th>";
}
echo "</tr>";

foreach ($donneesActif as $ligne) {
    echo "<tr>";
    foreach ($ligne as $cellule) {
        echo "<td>$cellule</td>";
    }
    echo "</tr>";
}
echo "</table>";


// Fermer la connexion à la base de données
$conn = null;

?>

</body>
</html>
