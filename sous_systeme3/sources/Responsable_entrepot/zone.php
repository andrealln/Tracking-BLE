<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zone</title>
  
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

<h2>Zone</h2>

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
$dsn = "mysql:host=". $servername . ";" . "dbname=" .  $dbname;




$conn = new PDO($dsn, $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




// Requête SQL pour la table 'actif' 
$sql = "SELECT * FROM actif , beacon";
$reponse = $conn->query($sql);

// Données à afficher dans le tableau pour la table 'actif'
$donneesActif = array();
while ($tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
  
    $donneesActif[] = array( $tableau['major'], $tableau['minor'],$tableau['nom'],$tableau['DateHeure'] );
}

// En-têtes du tableau pour la table 'actif'
$entetesActif = array("major","minor","actifs","Date heure");

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
