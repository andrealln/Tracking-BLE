
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
// ajouter une gateway
if(isset($_POST['ajouter']))
{
   $adresseMac = $_POST['MAC'];
$zone = $_POST['zone'];
   $query = "INSERT INTO gateway (MAC) VALUES ('$adresseMac')";
   if(!$resultat = $mysqli->query($query))
   {
      echo "Erreur de requête : ".$mysqli->error;
      exit();
   }
      $query = "UPDATE zone SET id_GATEWAY = (SELECT id_GATEWAY FROM gateway WHERE MAC = '$adresseMac') WHERE nom = '$zone'";
      echo $query;
   if(!$resultat = $mysqli->query($query))
   {
      echo "Erreur de requête : ".$mysqli->error;
      exit();
   }
}

// supprimer toutes les gateways
if(isset($_POST['vider']))
{
   $query = "DELETE FROM gateway";
   if(!$resultat = $mysqli->query($query))
   {
      echo "Erreur de requête : ".$mysqli->error;
      exit();
   }
}

// supprimer une gateway
if(isset($_POST['supprimer']) && isset($_POST['MAC']))
{
   $adresseMac = $_POST['MAC'];
   $query = "DELETE FROM gateway WHERE MAC='$adresseMac'";
   if(!$resultat = $mysqli->query($query))
   {
      echo "Erreur de requête : ".$mysqli->error;
      exit();
   }
}

   $query = "SELECT nom FROM zone" ;
   if($resultat = $mysqli->query($query))
   {
      $lesZones = array();
      while($uneZone = $resultat->fetch_assoc()) 
      {
         $lesZones[] = $uneZone;
      }
      $resultat->free();
   }
   else
   {
      echo "Erreur de requête : ".$mysqli->error;
      exit();
   }

// formulaire pour ajouter une gateway
echo "<p><form method='post'>";
echo "<h3>Ajouter une gateway</h3>";
echo "<p>Adresse MAC : <input type='text' size='10' maxlength='40' name='MAC' /></p>";
echo "zone :<SELECT id='zone' name='zone'>";
   foreach($lesZones as $uneZone)
   {
      $nom = $uneZone['nom'];
      echo "<OPTION>$nom";
   }
   echo "</SELECT>\t";
echo "<p><input type='submit' name='ajouter' value='Ajouter la gateway' /></p>";
echo "</form></p>";

// afficher le tableau des gateway
$query = "SELECT MAC,zone.nom AS nom_zone FROM gateway JOIN zone ON gateway.id_GATEWAY = zone.id_GATEWAY";
if($resultat = $mysqli->query($query))
{
   // tableau PHP contenant les en-têtes de colonnes
   $entetes = ["Adresse MAC", "Zone","Supprimer"];
   // tableau des gateways
   $donnees = array();
   // pour chaque enregistrement
   while($ligne = $resultat->fetch_assoc()) 
   {
      $adresseMac = $ligne['MAC'];
      $zone = $ligne['nom_zone'];
      $formulaire_supprimer = "<form method='post'><input type='submit' class='bouton_croix' onclick=\"if(!confirm('Voulez-vous supprimer la gateway $adresseMac ?')) return false;\"  name='supprimer' value='' /><input type='hidden' name='MAC' value='$adresseMac'></form>";
      $donnees[] = [$adresseMac, $zone,$formulaire_supprimer];
   }
   $resultat->free();
   echo "<hr style='border-top:1px dotted #000;'' />";
   echo "<h3>gateways enregistrées</h3>";
   AfficherTableau($entetes, $donnees, $centrer=true);

   echo "<p><form method='post'>";
   echo "<input type='submit' name='vider' onclick=\"if(!confirm('Voulez-vous supprimer tous les gateways ?')) return false;\" value='Supprimer toutes les gateways' />";
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
