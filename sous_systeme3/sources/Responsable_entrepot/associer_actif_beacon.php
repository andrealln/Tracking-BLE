<?php
include("../top.php");
include("../param.inc.php");
include("../fonctions_tableaux.php");

?>

<body style="padding: 0;">
<?php
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE,PORT);
if ($mysqli -> connect_errno)
{
   echo "<p>Erreur de connexion : ".$mysqli->connect_error."</p>";
      exit();
}



// on a cliqué sur le bouton associer : requete INSERT pour associer un beacon a un actif
if(isset($_POST['associer']))
{
   $minor = $_POST['minor'];
   $actif = $_POST['actif'];
   //update dans la table actif
    $query = "UPDATE actif SET id_BEACON =(SELECT id_BEACON FROM beacon WHERE minor='$minor') WHERE nom = '$actif'";
    echo $query;
   if(!$resultat = $mysqli->query($query))
   {
      echo "Erreur de requête : ".$mysqli->error;
      exit();
   }
}

//on a cliqué sur le bouton vider 
if(isset($_POST['vider']))
{
    //requete update pour mettre null dans la clef etrangère de la table actif pour tout les enregistrements
   $query = "UPDATE actif SET id_BEACON = NULL";
   if(!$resultat = $mysqli->query($query))
   {
      echo "Erreur de requête : ".$mysqli->error;
      exit();
   }
}

// on a cliqué sur un bouton supprimer 
if(isset($_POST['supprimer']) && isset($_POST['actif']))
{
   $actif = $_POST['actif'];
     //requete update pour mettre null dans la clef etrangère de la table actif 
  
   $query = "UPDATE actif SET id_BEACON = NULL WHERE nom = '$actif'";
   if(!$resultat = $mysqli->query($query))
   {
      echo "Erreur de requête : ".$mysqli->error;
      exit();
   }
}


//requete pour lire la liste des beacons
$query = "SELECT minor FROM beacon" ;
if($resultat = $mysqli->query($query))
{
  $lesbeacons = array();
  while($unbeacon = $resultat->fetch_assoc()) 
  {
     $lesbeacons[] = $unbeacon;
  }
  $resultat->free();
}
else
{
  echo "Erreur de requête : ".$mysqli->error;
  exit();
}

//requete pour lire la liste des actifs 

$query = "SELECT nom FROM actif" ;
if($resultat = $mysqli->query($query))
{
  $lesactifs = array();
  while($unactif = $resultat->fetch_assoc()) 
  {
     $lesactifs[] = $unactif;
  }
  $resultat->free();
}
else
{
  echo "Erreur de requête : ".$mysqli->error;
  exit();
}

// formulaire pour associer un actif a un beacon
echo "<p><form method='post'>";
echo "<h3>Associer un beacon a un actif</h3>";
echo "actif :<SELECT id='actif' name='actif'>";
   foreach($lesactifs as $unactif)
   {
      $nom = $unactif['nom'];
      echo "<OPTION>$nom";
   }
   echo "</SELECT>\t";

   echo "beacon :<SELECT id='minor' name='minor'>";
   foreach($lesbeacons as $unbeacon)
   {
      $minor = $unbeacon['minor'];
      echo "<OPTION>$minor";
   }
   echo "</SELECT>\t";

echo "<p><input type='submit' name='associer' value='Associer actif-beacon' /></p>";
echo "</form></p>";

// afficher le tableau des association actif-beacon
$query = "SELECT nom,minor FROM actif JOIN beacon ON actif.id_BEACON = beacon.id_BEACON";
if($resultat = $mysqli->query($query))
{
   // tableau PHP contenant les en-têtes de colonnes
   $entetes = ["Actifs", "Beacons","Supprimer"];
   // tableau des actifs
   $donnees = array();
   // pour chaque enregistrement
   while($ligne = $resultat->fetch_assoc()) 
   {
      $minor = $ligne['minor'];
      $actif = $ligne['nom'];
      $formulaire_supprimer = "<form method='post'><input type='submit' class='bouton_croix' onclick=\"if(!confirm('Voulez-vous supprimer l'association $actif ?')) return false;\"  name='supprimer' value='' /><input type='hidden' name='actif' value='$actif'></form>";
      $donnees[] = [$actif, $minor,$formulaire_supprimer];
   }
   $resultat->free();
   echo "<hr style='border-top:1px dotted #000;'' />";
   echo "<h3>associations enregistrées</h3>";
   AfficherTableau($entetes, $donnees, $centrer=true);

   echo "<p><form method='post'>";
   echo "<input type='submit' name='vider' onclick=\"if(!confirm('Voulez-vous supprimer toutes les associations ?')) return false;\" value='Supprimer toutes les associations' />";
   echo "</form></p>";
}
else
   echo "Erreur de requête : ".$mysqli->error;

$mysqli->close();
?>

</head>


    <div class="button-container">
        <div>
            <button onclick="Retour()">Retour</button>
            
        </div>

    </div>

    <script>
        function Retour() {
          location.href = "responsable_entrepot.php";
        }
     </script>

</body>

</html>
