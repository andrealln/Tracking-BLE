


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
// ajouter un camion
if(isset($_POST['ajouter']))
{
   $immatriculation = $_POST['immatriculation'];
$beacon = $_POST['beacon'];
   $query = "INSERT INTO camion (immatriculation) VALUES ('$immatriculation')";
   if(!$resultat = $mysqli->query($query))
   {
      echo "Erreur de requête : ".$mysqli->error;
      exit();
   }
      $query = "UPDATE beacon SET id_BEACON = (SELECT id_BEACON FROM camion WHERE immatriculation = '$immatriculation') WHERE minor = '$beacon'";
      echo $query;
   if(!$resultat = $mysqli->query($query))
   {
      echo "Erreur de requête : ".$mysqli->error;
      exit();
   }
}

// supprimer touts les camions
if(isset($_POST['vider']))
{
   $query = "DELETE FROM camion";
   if(!$resultat = $mysqli->query($query))
   {
      echo "Erreur de requête : ".$mysqli->error;
      exit();
   }
}

// supprimer un camion
if(isset($_POST['supprimer']) && isset($_POST['immatriculation']))
{
   $immatriculation = $_POST['immatriculation'];
   $query = "DELETE FROM camion WHERE immatriculation='$immatriculation'";
   if(!$resultat = $mysqli->query($query))
   {
      echo "Erreur de requête : ".$mysqli->error;
      exit();
   }
}

   $query = "SELECT minor FROM beacon" ;
   if($resultat = $mysqli->query($query))
   {
      $lesBeacons = array();
      while($unBeacon = $resultat->fetch_assoc()) 
      {
         $lesBeacons[] = $unBeacon;
      }
      $resultat->free();
   }
   else
   {
      echo "Erreur de requête : ".$mysqli->error;
      exit();
   }

// formulaire pour ajouter un camion
echo "<p><form method='post'>";
echo "<h3>Ajouter un camion</h3>";
echo "<p>Immatriculation : <input type='text' size='10' maxlength='40' name='immatriculation' /></p>";
echo "beacon :<SELECT id='beacon' name='beacon'>";
   foreach($lesBeacons as $unBeacon)
   {
      $minor = $unBeacon['minor'];
      echo "<OPTION>$minor";
   }
   echo "</SELECT>\t";
echo "<p><input type='submit' name='ajouter' value='Ajouter le camion' /></p>";
echo "</form></p>";

// afficher le tableau des camions
$query = "SELECT immatriculation,beacon.minor AS minor_beacon FROM camion JOIN beacon ON camion.id_CAMION = beacon.id_CAMION";
if($resultat = $mysqli->query($query))
{
   // tableau PHP contenant les en-têtes de colonnes
   $entetes = ["Immatriculation", "beacon","Supprimer"];
   // tableau des camions
   $donnees = array();
   // pour chaque enregistrement
   while($ligne = $resultat->fetch_assoc()) 
   {
      $immatriculation = $ligne['immatriculation'];
      $beacon = $ligne['minor_beacon'];
      $formulaire_supprimer = "<form method='post'><input type='submit' class='bouton_croix' onclick=\"if(!confirm('Voulez-vous supprimer le camion $immatriculation ?')) return false;\"  name='supprimer' value='' /><input type='hidden' name='immatriculation' value='$immatriculation'></form>";
      $donnees[] = [$immatriculation, $beacon,$formulaire_supprimer];
   }
   $resultat->free();
   echo "<hr style='border-top:1px dotted #000;'' />";
   echo "<h3>camion enregistrés</h3>";
   AfficherTableau($entetes, $donnees, $centrer=true);

   echo "<p><form method='post'>";
   echo "<input type='submit' name='vider' onclick=\"if(!confirm('Voulez-vous supprimer tous les camions ?')) return false;\" value='Supprimer tous les camions' />";
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
          location.href = "responsable_logistique.php";
        }
     </script>


</body>

</html>
