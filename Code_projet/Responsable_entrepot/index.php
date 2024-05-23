<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsable_entrepot</title>
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
            color:white;
        }
    </style>

<h2>Bienvenue sur la page du responsable entrepot</h2>

</head>
<body>


<h2>Saisie des informations pour un beacon</h2>
    <form action="traitement.php" method="post">
        <label for="major">Major :</label>
        <input type="text" id="major" name="major" required><br><br>

        <label for="minor">Minor :</label>
        <input type="text" id="minor" name="minor" required><br><br>

        <label for="id_ACTIF">ID de l'actif associé :</label>
        <input type="text" id="id_ACTIF" name="id_ACTIF" required><br><br>

        <input type="submit" value="Enregistrer">
    </form>
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);



// Connexion à la base de données
$servername = "ll440466-001.privatesql:35312";
$username = "trackingble2024";
$password = "track1ngBle2o24";
$dbname = "Trackingble2024";
$dsn = "mysql:host=". $servername . ";" . "dbname=" .  $dbname;

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Échec de connexion : " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs envoyées par le formulaire
    $major = $_POST['major'];
    $minor = $_POST['minor'];
    $id_ACTIF = $_POST['id_ACTIF'];

    // Requête SQL pour insérer les données dans la base de données
    $sql = "INSERT INTO beacon (major, minor) VALUES (:major, :minor)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':major', $major);
    $stmt->bindParam(':minor', $minor);
    
    if ($stmt->execute()) {
        $last_id = $conn->lastInsertId();
        // Insérer l'ID de l'actif associé dans la table actif
        $sql_actif = "UPDATE actif SET id_BEACON = :last_id WHERE id_ACTIF = :id_ACTIF";
        $stmt_actif = $conn->prepare($sql_actif);
        $stmt_actif->bindParam(':last_id', $last_id);
        $stmt_actif->bindParam(':id_ACTIF', $id_ACTIF);
        
        if ($stmt_actif->execute()) {
            echo "Enregistrement réussi.";
        } else {
            echo "Erreur : " . $sql_actif . "<br>" . $conn->error;
        }
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}






// Requête SQL pour la recherche
$sql = "SELECT * FROM beacon ";
$stmt = $conn->prepare($sql);

$stmt->execute();

// Données à afficher dans le tableau
$donnees = array();
while ($tableau = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $donnees[] = array($tableau['major'], $tableau['minor'], $tableau['RSSI'], $tableau['DateHeure']);
}

// En-têtes du tableau
$entetes = array("Major", "Minor", "RSSI", "Date/Heure");

// Affichage du tableau
echo "<table>";
echo "<tr>";
foreach ($entetes as $entete) {
    echo "<th>$entete</th>";
}
echo "</tr>";

foreach ($donnees as $ligne) {
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


</body>
</html>
